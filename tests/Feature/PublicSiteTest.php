<?php

use App\Models\Project;
use App\Models\SiteProfile;

beforeEach(function () {
    SiteProfile::factory()->create();
});

test('public pages render successfully', function (string $routeName) {
    $this->get(route($routeName))->assertOk();
})->with([
    'home',
    'about',
    'skills',
    'projects.index',
    'services',
    'contact.create',
]);

test('project index only shows published projects', function () {
    $published = Project::factory()->create([
        'title' => 'Project Publik',
        'slug' => 'project-publik',
    ]);

    $draft = Project::factory()->draft()->create([
        'title' => 'Project Draft',
        'slug' => 'project-draft',
    ]);

    $this->get(route('projects.index'))
        ->assertOk()
        ->assertSee($published->title)
        ->assertDontSee($draft->title);
});

test('published project detail is visible', function () {
    $project = Project::factory()->create([
        'title' => 'Sistem Inventaris',
        'slug' => 'sistem-inventaris',
        'summary' => 'Ringkasan project yang dipublikasikan.',
    ]);

    $this->get(route('projects.show', $project))
        ->assertOk()
        ->assertSee($project->title)
        ->assertSee($project->summary);
});

test('draft project returns not found by direct slug', function () {
    $draft = Project::factory()->draft()->create([
        'slug' => 'draft-rahasia',
    ]);

    $this->get('/projects/'.$draft->slug)->assertNotFound();
});

test('cv link is hidden until a cv is uploaded', function () {
    $profile = SiteProfile::current();

    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('Unduh CV');

    $profile->update([
        'cv_path' => 'cv/fikri-amrullah.pdf',
        'cv_original_name' => 'CV-Fikri-Amrullah.pdf',
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Unduh CV');
});

test('linkedin link is hidden when no linkedin url is set', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('LinkedIn');

    SiteProfile::current()->update([
        'linkedin_url' => 'https://www.linkedin.com/in/fikri-amrullah',
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('LinkedIn');
});

test('home page marks placeholder projects', function () {
    Project::factory()->create([
        'title' => 'Project Contoh',
        'is_placeholder' => true,
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Project Contoh')
        ->assertSee('Contoh');
});
