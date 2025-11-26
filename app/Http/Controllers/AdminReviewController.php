<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['author:id,name', 'project:id,name'])
            ->latest()
            ->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Display the specified resource.
     */
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'comment' => ['nullable', 'string'],
            'stars' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $review = Review::findOrFail($id);
        $review->update($validated);

        return redirect('/admin/reviews');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect('/admin/reviews');
    }
}
