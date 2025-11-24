<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of authors with at least one project.
     */
    public function index()
    {
        $authors = User::withCount('projects')
            ->whereHas('projects')
            ->with([
                'projects' => function ($q) {
                    $q->latest('published_at')
                        ->where('is_published', true)
                        ->take(3)
                        ->with('media');
                }
            ])
            ->paginate(10);

        return view('authors.index', compact('authors'));
    }

    /**
     * Display the specified author and their projects.
     */
    public function show(int $author)
    {
        $author = User::withCount('projects')
            ->whereHas('projects')
            ->findOrFail($author);

        $projects = $author->projects()
            ->with(['author', 'tags', 'media'])
            ->where('is_published', true)
            ->paginate(10);

        return view('authors.show', compact('author', 'projects'));
    }
}
