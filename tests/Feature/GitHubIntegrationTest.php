<?php

use App\Models\Project;
use App\Models\User;
use App\Services\GitHubService;

use function Pest\Laravel\mock;

test('autofills content from GitHub README when content empty', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $readme = "# My Repo\n\nThis is the README.";
    mock(GitHubService::class)
        ->shouldReceive('getRepositoryReadme')
        ->once()
        ->with('laravel', 'laravel')
        ->andReturn($readme);

    $response = $this->actingAs($user)->post('/admin/projects', [
        'name' => 'Test Project',
        'leading' => 'Short intro',
        'content' => '',
        'github_repo_url' => 'https://github.com/laravel/laravel',
    ]);

    $response->assertRedirect('/admin/projects')->assertSessionHasNoErrors();

    $this->assertDatabaseHas('projects', [
        'name' => 'Test Project',
        'github_owner' => 'laravel',
        'github_repo' => 'laravel',
        'github_url' => 'https://github.com/laravel/laravel',
    ]);

    $project = Project::latest('id')->first();
    expect($project->content)->toBe($readme);
});

test('does not override provided content if present', function () {
    $user = User::factory()->create(['is_admin' => false]);

    mock(GitHubService::class)
        ->shouldReceive('getRepositoryReadme')
        ->never();

    $response = $this->actingAs($user)->post('/admin/projects', [
        'name' => 'Custom Content Project',
        'leading' => 'Intro',
        'content' => 'User provided content',
        'github_repo_url' => 'https://github.com/laravel/laravel',
    ]);

    $response->assertRedirect('/admin/projects')->assertSessionHasNoErrors();

    $project = Project::latest('id')->first();
    expect($project->content)->toBe('User provided content');
});

test('creates project even if GitHub fails, still saves link fields', function () {
    $user = User::factory()->create(['is_admin' => false]);

    mock(GitHubService::class)
        ->shouldReceive('getRepositoryReadme')
        ->once()
        ->andReturn(null);

    $response = $this->actingAs($user)->post('/admin/projects', [
        'name' => 'No Readme Project',
        'leading' => 'Intro',
        'content' => '',
        'github_repo_url' => 'https://github.com/octocat/Hello-World',
    ]);

    $response->assertRedirect('/admin/projects')->assertSessionHasNoErrors();

    $this->assertDatabaseHas('projects', [
        'name' => 'No Readme Project',
        'github_owner' => 'octocat',
        'github_repo' => 'Hello-World',
        'github_url' => 'https://github.com/octocat/Hello-World',
    ]);
});

test('rejects invalid github url domain', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->post('/admin/projects', [
        'name' => 'Invalid URL Project',
        'leading' => 'Intro',
        'github_repo_url' => 'https://gitlab.com/laravel/laravel',
    ]);

    $response->assertRedirect()->assertSessionHasErrors('github_repo_url');
});
