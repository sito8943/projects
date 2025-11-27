<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class AdminProjectController extends Controller
{
    public function index()
    {
        $query = Project::with('author', 'tags', 'media');

        $user = auth()->user();
        if ($user && !$user->is_admin) {
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
            "header_image" => ['nullable', 'image'],
            "leading" => ['nullable', 'string'],
            'tags' => ['nullable'],
            'content' => ['nullable', 'string']
        ]);

        $authUser = auth()->user();

        // forcing author_id to auth user if is not an admin
        if ($authUser && !$authUser->is_admin) {
            $validated['author_id'] = $authUser->id;
        } else {
            $validated['author_id'] = $request->input('author_id');
        }

        // validated so it will be removed after media processed
        $project = Project::create(collect($validated)->except('header_image')->toArray());

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

        return redirect('/admin/projects');
    }

    public function edit(int $id)
    {
        $project = Project::with('author', 'tags', 'media')->find($id);

        $authUser = auth()->user();
        if (!$project || !$project->canBeManagedBy($authUser)) {
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
            "header_image" => ['nullable', 'image'],
            "leading" => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'tags' => ['nullable'],
        ]);

        $project = Project::find($id);

        $authUser = auth()->user();
        if (!$project || !$project->canBeManagedBy($authUser)) {
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
        if ($authUser && !$authUser->is_admin) {
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

        return redirect('/admin/projects');
    }

    public function destroy(int $id)
    {
        $project = Project::findOrFail($id);

        $authUser = auth()->user();
        if (!$project->canBeManagedBy($authUser)) {
            abort(403);
        }
        $project->delete();

        return redirect('/admin/projects');
    }
}
