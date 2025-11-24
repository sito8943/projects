<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::query()
            ->select('id', 'author_id', 'leading', 'published_at', 'name')
            ->with('author:id,name', 'tags', 'media')
            ->where('is_published', true)
            ->paginate(10);

        return view('projects.index', compact('projects'));
    }

    public function show(int $projectId)
    {
        $project = Project::query()
            ->with(['author:id,name', 'tags', 'media', 'reviews.author:id,name'])
            ->findOrFail($projectId);

        $authorProjects = Project::query()
            ->select('id', 'author_id', 'leading', 'published_at', 'name')
            ->with(['author:id,name', 'media'])
            ->where('author_id', $project->author_id)
            ->where('is_published', true)
            ->where('id', '!=', $project->id)
            ->latest('published_at')
            ->take(6)
            ->get();

        $tagProjects = collect();
        $tag = null;
        if ($project->tags && $project->tags->isNotEmpty()) {
            $tag = $project->tags->first();
            $tagProjects = Project::query()
                ->select('id', 'author_id', 'leading', 'published_at', 'name')
                ->with(['author:id,name', 'media'])
                ->where('id', '!=', $project->id)
                ->where('is_published', true)
                ->whereHas('tags', function ($q) use ($tag) {
                    $q->where('tags.id', $tag->id);
                })
                ->latest('published_at')
                ->take(6)
                ->get();
        }

        return view('projects.show', compact('project', 'authorProjects', 'tagProjects', 'tag'));
    }
}
