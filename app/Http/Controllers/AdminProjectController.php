<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminProjectController extends Controller
{
    public function index()
    {
        $query = Project::with('author', 'tags', 'media');

        $user = auth()->user();
        if ($user && ! $user->is_admin) {
            $query->where('author_id', $user->id);
        }

        $projects = $query->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $authUser = auth()->user();

        $users = ($authUser && $authUser->is_admin)
            ? User::all()
            : User::where('id', optional($authUser)->id)->get();

        return view('admin.projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'header_image' => ['nullable', 'image', 'max:'.config('uploads.max_image_kb', 2048)],
            'leading' => ['nullable', 'string'],
            'tags' => ['nullable'],
            'content' => ['nullable', 'string'],
            'github_repo_url' => ['nullable', 'url', 'regex:/^https:\/\/github\.com\/.+\/.+$/'],
        ]);

        $authUser = auth()->user();

        // forcing author_id to auth user if is not an admin
        if ($authUser && ! $authUser->is_admin) {
            $validated['author_id'] = $authUser->id;
        } else {
            $validated['author_id'] = $request->input('author_id');
        }

        // Parse optional GitHub URL
        $githubUrl = $validated['github_repo_url'] ?? null;
        $owner = null;
        $repo = null;
        if (is_string($githubUrl) && $githubUrl !== '') {
            // Expecting https://github.com/{owner}/{repo}[...]
            $parts = parse_url($githubUrl);
            if (is_array($parts) && isset($parts['host']) && $parts['host'] === 'github.com' && ! empty($parts['path'])) {
                // Trim leading slash and explode
                $path = ltrim((string) $parts['path'], '/');
                $segments = explode('/', $path);
                if (count($segments) >= 2) {
                    $owner = $segments[0];
                    $repo = $segments[1];
                }
            }
        }

        // Optionally fetch README if content not provided
        $fetchedReadme = null;
        if (($validated['content'] ?? null) === null || trim((string) $validated['content']) === '') {
            if ($owner && $repo) {
                try {
                    $github = app(\App\Services\GitHubService::class);
                    $fetchedReadme = $github->getRepositoryReadme($owner, $repo);
                    if (is_string($fetchedReadme) && $fetchedReadme !== '') {
                        $validated['content'] = $fetchedReadme;
                    }
                } catch (\Throwable $e) {
                    // Non-blocking: ignore failures
                }
            }
        }

        // Apply parsed GitHub metadata
        if ($owner && $repo && $githubUrl) {
            $validated['github_owner'] = $owner;
            $validated['github_repo'] = $repo;
            $validated['github_url'] = $githubUrl;
        }

        // validated so it will be removed after media processed
        $project = Project::create(collect($validated)->except('header_image', 'github_repo_url')->toArray());

        if (
            $request->hasFile('header_image')
        ) {
            $project->addMediaFromRequest('header_image')->toMediaCollection();
        }

        if ($request->has('tags')) {
            $project->tags()->sync($validated['tags']);
            unset($validated['tags']);
        } else {
            $project->tags()->sync([]);
        }

        $this->flushWelcomeCaches();

        return redirect('/admin/projects');
    }

    public function edit(int $id)
    {
        $project = Project::with('author', 'tags', 'media')->find($id);

        $authUser = auth()->user();
        if (! $project || ! $project->canBeManagedBy($authUser)) {
            abort(403);
        }

        $users = ($authUser && $authUser->is_admin)
            ? User::with('media')->get()
            : User::with('media')->where('id', $authUser->id)->get();

        return view('admin.projects.edit', compact(['project', 'users']));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'header_image' => ['nullable', 'image', 'max:'.config('uploads.max_image_kb', 2048)],
            'leading' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'tags' => ['nullable'],
        ]);

        $project = Project::find($id);

        $authUser = auth()->user();
        if (! $project || ! $project->canBeManagedBy($authUser)) {
            abort(403);
        }

        $removeHeader = $request->boolean('header_image_remove');
        if ($removeHeader) {
            $project->media->each->delete();
        }

        if (
            $request->hasFile('header_image')
        ) {
            $project->media->each->delete();
            $project->addMediaFromRequest('header_image')->toMediaCollection();
            unset($validated['header_image']);
        }

        // forcing author_id to auth user if is not an admin
        if ($authUser && ! $authUser->is_admin) {
            $validated['author_id'] = $authUser->id;
        } else {
            $validated['author_id'] = $request->input('author_id');
        }

        if ($request->has('tags')) {
            $project->tags()->sync($validated['tags']);
            unset($validated['tags']);
        } else {
            $project->tags()->sync([]);
        }

        // Handle publish toggle using published_at
        $shouldPublish = $request->boolean('is_published');
        $currentPublishedAt = $project->published_at;
        $validated['published_at'] = $shouldPublish
            ? ($currentPublishedAt ?: now())
            : null;

        $project->update($validated);

        $this->flushWelcomeCaches();

        return redirect('/admin/projects');
    }

    public function destroy(int $id)
    {
        $project = Project::findOrFail($id);

        $authUser = auth()->user();
        if (! $project->canBeManagedBy($authUser)) {
            abort(403);
        }
        // Free slug uniqueness then soft-delete
        $project->markAsDeleted();

        $this->flushWelcomeCaches();

        return redirect('/admin/projects');
    }

    private function flushWelcomeCaches(): void
    {
        Cache::forget('welcome_page_recent_projects');
        Cache::forget('welcome_page_trending_projects');
    }
}
