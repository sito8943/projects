<?php

use App\Models\Project;
use App\Models\Review;
use App\Models\User;

it('shows only own reviews to non-admins on admin index', function () {
    $me = User::factory()->create(['is_admin' => false]);
    $other = User::factory()->create(['is_admin' => false]);

    $projectA = Project::factory()->create(['author_id' => $me->id]);
    $projectB = Project::factory()->create(['author_id' => $other->id]);

    $mine = Review::create([
        'comment' => 'Mine only here',
        'stars' => 4,
        'author_id' => $me->id,
        'project_id' => $projectA->id,
    ]);

    $notMine = Review::create([
        'comment' => 'Should not be visible',
        'stars' => 5,
        'author_id' => $other->id,
        'project_id' => $projectB->id,
    ]);

    $this->actingAs($me);

    $response = $this->get(route('admin.reviews.index'));

    $response->assertSuccessful()
        ->assertSee($mine->comment)
        ->assertDontSee($notMine->comment);
});

it('shows all reviews to admins on admin index', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $project1 = Project::factory()->create(['author_id' => $user1->id]);
    $project2 = Project::factory()->create(['author_id' => $user2->id]);

    $r1 = Review::create([
        'comment' => 'Admin sees this 1',
        'stars' => 3,
        'author_id' => $user1->id,
        'project_id' => $project1->id,
    ]);
    $r2 = Review::create([
        'comment' => 'Admin sees this 2',
        'stars' => 5,
        'author_id' => $user2->id,
        'project_id' => $project2->id,
    ]);

    $this->actingAs($admin);

    $response = $this->get(route('admin.reviews.index'));

    $response->assertSuccessful()
        ->assertSee($r1->comment)
        ->assertSee($r2->comment);
});
