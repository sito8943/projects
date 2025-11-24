<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    function index()
    {
        $projects = Project::with('author', 'tags', 'media')
            ->where('is_published', true)
            ->paginate(10);
        return view('projects.index', compact('projects'));
    }

    function show(int $projectId)
    {
        $project = Project::with(['author', 'tags', 'media', 'reviews.author'])
            ->findOrFail($projectId);

        $authorProjects = Project::with(['author', 'media'])
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
            $tagProjects = Project::with(['author', 'media'])
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
