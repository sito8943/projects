<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Purchase;
use App\Models\Tag;
use App\Models\User;

class ProjectController extends Controller
{
    public function index()
    {
        $query = Project::query()
            ->select('id', 'author_id', 'leading', 'published_at', 'name', 'slug')
            ->with([
                'author:id,name',
                'author.media',
                'tags:id,name,color',
                'media',
                // Only load what's needed for index stars
                'reviews:id,project_id,stars',
            ])
            ->whereNotNull('published_at');

        // Optional filter by tag via query string: /projects?tag={id}
        $tagId = request('tag');
        $activeTag = null;
        if (! is_null($tagId) && $tagId !== '') {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tags.id', (int) $tagId);
            });
            $activeTag = Tag::find((int) $tagId);
        }

        $projects = $query->paginate(10);

        return view('projects.index', compact('projects', 'activeTag'));
    }

    public function show(string $project)
    {
        $project = Project::query()
            ->with([
                'author:id,name',
                'author.media',
                'tags:id,name,color',
                'media',
                'reviews:id,project_id,author_id,stars,comment,created_at',
                'reviews.author:id,name',
                'reviews.author.media',
            ])
            ->where('slug', $project)
            ->firstOrFail();

        $authorProjects = Project::query()
            ->select('id', 'author_id', 'leading', 'published_at', 'name', 'slug')
            ->with([
                'reviews:id,project_id,stars',
                'media',
                'author:id,name',
                'author.media',
            ])
            ->where('author_id', $project->author_id)
            ->whereNotNull('published_at')
            ->where('id', '!=', $project->id)
            ->latest('published_at')
            ->take(6)
            ->get();

        $tagProjects = collect();
        $tag = null;
        if ($project->tags && $project->tags->isNotEmpty()) {
            $tag = $project->tags->first();
            $tagProjects = Project::query()
                ->select('id', 'author_id', 'leading', 'published_at', 'name', 'slug')
                ->with([
                    'author:id,name',
                    'author.media',
                    'reviews:id,project_id,stars',
                    'media',
                ])
                ->where('id', '!=', $project->id)
                ->whereNotNull('published_at')
                ->whereHas('tags', function ($q) use ($tag) {
                    $q->where('tags.id', $tag->id);
                })
                ->latest('published_at')
                ->take(6)
                ->get();
        }

        // If redirected after starting a sponsorship, show purchase state
        $activePurchase = null;
        $purchaseId = request('purchase');
        if (! is_null($purchaseId) && $purchaseId !== '') {
            $activePurchase = Purchase::query()
                ->where('id', (int) $purchaseId)
                ->where('project_id', $project->id)
                ->when(auth()->check(), fn ($q) => $q->where('user_id', auth()->id()))
                ->first();
        }

        // Also indicate sponsorship if the project has any purchases (seeded data visibility)
        $projectHasAnyPurchase = Purchase::query()
            ->where('project_id', $project->id)
            ->exists();

        // Fetch paid sponsors (users) for chips in sponsor section
        $sponsors = User::query()
            ->select('id', 'name')
            ->with('media')
            ->whereIn('id', Purchase::query()
                ->select('user_id')
                ->where('project_id', $project->id)
                ->where('status', 'paid')
            )
            ->get();

        return view('projects.show', compact('project', 'authorProjects', 'tagProjects', 'tag', 'activePurchase', 'projectHasAnyPurchase', 'sponsors'));
    }
}
