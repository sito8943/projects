<?php

namespace App\Http\Controllers;

use App\Models\Project;

class WelcomeController extends Controller
{
    function __invoke()
    {
        $recentProjects = cache()->remember('welcome_page_recent_projects', 0, function () {
            return Project::query()
                ->select('id', 'author_id', 'leading', 'published_at', 'name', 'slug', 'reviews:stars')
                ->with('author:id,name', 'tags', 'media')
                ->whereNotNull('published_at')
                ->latest('published_at')
                ->take(4)
                ->get();
        });

        $mostRecentProject = $recentProjects->shift();

        $trendingProjects = cache()->remember('welcome_page_trending_projects', 3600, function () {
            return Project::query()
                ->select('id', 'author_id', 'leading', 'published_at', 'name', 'slug')
                ->with('author:id,name', 'author.media', 'tags', 'media')
                ->withCount('reviews')
                ->whereNotNull('published_at')
                ->orderByDesc('reviews_count')
                ->latest('published_at')
                ->take(6)
                ->get();
        });

        return view('welcome', compact('mostRecentProject', 'recentProjects', 'trendingProjects'));
    }
}
