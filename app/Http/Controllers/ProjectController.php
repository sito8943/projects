<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Tag;

class ProjectController extends Controller
{
    public function index()
    {
        $query = Project::query()
            ->select('id', 'author_id', 'leading', 'published_at', 'name', 'slug')
            ->with('author:id,name', 'author.media', 'tags', 'media', 'reviews')
            ->whereNotNull('published_at');

        // Optional filter by tag via query string: /projects?tag={id}
        $tagId = request('tag');
        $activeTag = null;
        if (!is_null($tagId) && $tagId !== '') {
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
            ->with(['author:id,name', 'author.media', 'tags', 'media', 'reviews.author:id,name', 'reviews.author.media'])
            ->where('slug', $project)
            ->firstOrFail();

        $authorProjects = Project::query()
            ->select('id', 'author_id', 'leading', 'published_at', 'name', 'slug', 'reviews:stars')
            ->with(['reviews', 'media', 'author.media'])
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
                ->select('id', 'author_id', 'leading', 'published_at', 'name', 'slug', 'reviews:stars')
                ->with(['author:id,name', 'author.media', 'reviews', 'media'])
                ->where('id', '!=', $project->id)
                ->whereNotNull('published_at')
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
