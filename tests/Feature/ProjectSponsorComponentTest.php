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
    $response->assertSee('id="sponsor-form"', false);
    $response->assertSee('name="amount"', false);
    $response->assertSee('Already sponsoring', false);
    $response->assertSee('Sponsor One');
});
