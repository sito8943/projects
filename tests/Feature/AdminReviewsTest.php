<?php

use App\Models\Project;
use App\Models\Review;
use App\Models\User;

it('renders admin reviews when related models are soft-deleted', function () {
    // Admin user to access admin area
    $admin = User::factory()->create(['is_admin' => true]);

    // Create author and project, then a review linking them
    $author = User::factory()->create();
    $project = Project::factory()->create(['author_id' => $author->id]);

    $review = Review::create([
        'comment' => 'Great project',
        'stars' => 5,
        'author_id' => $author->id,
        'project_id' => $project->id,
    ]);

    // Soft-delete related models to simulate production edge cases
    $author->delete();
    $project->delete();

    $this->actingAs($admin);

    $response = $this->get(route('admin.reviews.index'));

    $response->assertSuccessful()
        ->assertSee('Deleted user')
        ->assertSee('Deleted project');
});
