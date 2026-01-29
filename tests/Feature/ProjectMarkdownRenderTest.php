<?php

use App\Models\Project;
use App\Models\User;

it('renders markdown content on project show', function () {
    $user = User::factory()->create();
    $project = Project::factory()->create([
        'author_id' => $user->id,
        'content' => "# Title\n\nSome **bold** and *italic* with `code`.\n\n[Link](https://example.com)",
        'published_at' => now(),
    ]);

    $response = $this->get(route('projects.show', ['project' => $project->slug]));

    $response->assertOk();
    $response->assertSee('<h1>Title</h1>', false);
    $response->assertSee('<strong>bold</strong>', false);
    $response->assertSee('<em>italic</em>', false);
    $response->assertSee('<code>code</code>', false);
    $response->assertSee('<a href="https://example.com"', false);
});
