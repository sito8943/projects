<?php

use App\Models\Project;
use App\Models\Purchase;
use App\Models\User;

it('renders the sponsor component on the project page', function () {
    $author = User::factory()->create();

    $project = Project::factory()->create([
        'author_id' => $author->id,
        'published_at' => now(),
        'name' => 'Test Project',
    ]);

    // A paid sponsor to appear in the list
    $sponsor = User::factory()->create(['name' => 'Sponsor One']);
    Purchase::factory()->create([
        'user_id' => $sponsor->id,
        'project_id' => $project->id,
        'status' => 'paid',
        'amount_cents' => 500,
    ]);

    $response = $this->get(route('projects.show', ['project' => $project->slug]));

    $response->assertSuccessful();
    $response->assertSee("Don't be afraid to be a sponsor", false);
    $response->assertSee('id="sponsor-form"', false);
    $response->assertSee('name="amount"', false);
    $response->assertSee('Already sponsoring', false);
    $response->assertSee('Sponsor One');
});

it('shows the new sponsor immediately after redirect even before webhook', function () {
    $author = User::factory()->create();
    $current = User::factory()->create(['name' => 'New Sponsor']);

    $project = Project::factory()->create([
        'author_id' => $author->id,
        'published_at' => now(),
        'name' => 'Project X',
    ]);

    $purchase = Purchase::factory()->create([
        'user_id' => $current->id,
        'project_id' => $project->id,
        'status' => 'pending',
        'amount_cents' => 700,
    ]);

    $response = $this->actingAs($current)->get(route('projects.show', ['project' => $project->slug, 'purchase' => $purchase->id]));

    $response->assertSuccessful();
    // Optimistic display of the sponsor chip even before webhook marks it paid
    $response->assertSee('Already sponsoring', false);
    $response->assertSee('New Sponsor');
});
