<?php

use App\Models\Project;

test('sitemap includes static pages and published projects', function () {
    $published = Project::factory()->create([
        'title' => 'Project Publik',
        'slug' => 'project-publik',
    ]);

    $draft = Project::factory()->draft()->create([
        'title' => 'Project Draft',
        'slug' => 'project-draft',
    ]);

    $response = $this->get(route('sitemap'));

    $response
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->assertSee(route('home'), false)
        ->assertSee(route('projects.show', $published), false)
        ->assertDontSee(route('projects.show', $draft), false);
});
