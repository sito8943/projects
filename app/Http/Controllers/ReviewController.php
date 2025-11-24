<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $project)
    {
        $project = Project::findOrFail($project);

        // Only non-author users can review
        if (auth()->id() === $project->author_id) {
            abort(403, 'Authors cannot review their own projects.');
        }

        $validated = $request->validate([
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:2000'],
        ]);

        Review::create([
            'author_id' => auth()->id(),
            'project_id' => $project->id,
            'stars' => $validated['stars'],
            'comment' => $validated['comment'] ?? null,
        ]);

        // after redirect scroll to #reviews section to see alert
        return redirect()->to(
            route('projects.show', $project->id) . '#reviews'
        )->with('status', 'Thanks for your review!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
