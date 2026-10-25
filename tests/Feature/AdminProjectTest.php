<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    Storage::fake('public');
});

function adminProjectPayload(array $overrides = []): array
{
    return array_merge([
        'title' => 'Sistem Arsip Digital',
        'slug' => '',
        'summary' => 'Sistem untuk mengelola arsip digital dengan alur yang jelas.',
        'description' => 'Catatan teknis tentang struktur data, otorisasi, dan alur kerja sistem arsip.',
        'problem_statement' => 'Arsip tersebar di banyak folder dan sulit ditemukan kembali.',
        'solution' => 'Satu sumber data dengan pencarian, kategori, dan hak akses yang jelas.',
        'category' => 'Web App',
        'features' => "Pencarian arsip\nKategori dokumen\nHak akses admin",
        'technologies' => 'Laravel, MySQL, Tailwind CSS',
        'live_url' => '',
        'repository_url' => '',
        'status' => 'published',
        'is_featured' => '1',
        'is_placeholder' => '0',
        'sort_order' => 3,
    ], $overrides);
}

test('admin project index and create pages render', function () {
    $this->actingAs($this->admin)
        ->get(route('admin.projects.index'))
        ->assertOk();

    $this->actingAs($this->admin)
        ->get(route('admin.projects.create'))
        ->assertOk();
});

test('admin can create a project', function () {
    $response = $this->actingAs($this->admin)
        ->post(route('admin.projects.store'), adminProjectPayload());

    $project = Project::query()->firstOrFail();

    $response->assertRedirect(route('admin.projects.edit', $project));

    expect($project->title)->toBe('Sistem Arsip Digital')
        ->and($project->slug)->toBe('sistem-arsip-digital')
        ->and($project->features)->toBe(['Pencarian arsip', 'Kategori dokumen', 'Hak akses admin'])
        ->and($project->technologies)->toBe(['Laravel', 'MySQL', 'Tailwind CSS'])
        ->and($project->isPublished())->toBeTrue()
        ->and($project->published_at)->not->toBeNull();
});

test('admin project validation rejects incomplete data', function () {
    $this->actingAs($this->admin)
        ->post(route('admin.projects.store'), [])
        ->assertSessionHasErrors(['title', 'summary', 'description', 'category', 'status', 'sort_order']);

    expect(Project::query()->count())->toBe(0);
});

test('admin can update a project and change its publication status', function () {
    $project = Project::factory()->create([
        'title' => 'Judul Lama',
        'slug' => 'judul-lama',
        'status' => 'published',
    ]);

    $response = $this->actingAs($this->admin)
        ->patch(route('admin.projects.update', $project), adminProjectPayload([
            'title' => 'Judul Baru',
            'slug' => 'judul-baru',
            'status' => 'draft',
        ]));

    $project->refresh();

    $response->assertRedirect(route('admin.projects.edit', $project));

    expect($project->title)->toBe('Judul Baru')
        ->and($project->slug)->toBe('judul-baru')
        ->and($project->isDraft())->toBeTrue()
        ->and($project->published_at)->toBeNull();
});

test('admin can upload a thumbnail and gallery images', function () {
    $thumbnail = UploadedFile::fake()->image('thumbnail.jpg', 1200, 800);
    $galleryOne = UploadedFile::fake()->image('gallery-one.jpg', 1200, 800);
    $galleryTwo = UploadedFile::fake()->image('gallery-two.jpg', 1200, 800);

    $this->actingAs($this->admin)
        ->post(route('admin.projects.store'), adminProjectPayload([
            'thumbnail' => $thumbnail,
            'gallery' => [$galleryOne, $galleryTwo],
        ]))
        ->assertRedirect();

    $project = Project::query()->firstOrFail();

    expect($project->thumbnail_path)->not->toBeNull()
        ->and($project->images)->toHaveCount(2);

    Storage::disk('public')->assertExists($project->thumbnail_path);

    foreach ($project->images as $image) {
        Storage::disk('public')->assertExists($image->image_path);
    }
});

test('admin can add and remove gallery images from the edit page', function () {
    $project = Project::factory()->create();

    $this->actingAs($this->admin)
        ->post(route('admin.projects.images.store', $project), [
            'images' => [UploadedFile::fake()->image('new-image.jpg', 1200, 800)],
        ])
        ->assertRedirect();

    $image = $project->images()->firstOrFail();

    Storage::disk('public')->assertExists($image->image_path);

    $this->actingAs($this->admin)
        ->delete(route('admin.projects.images.destroy', [$project, $image]))
        ->assertRedirect();

    $this->assertDatabaseMissing('project_images', ['id' => $image->id]);
    Storage::disk('public')->assertMissing($image->image_path);
});

test('admin can delete a project with its media', function () {
    $project = Project::factory()->create([
        'thumbnail_path' => 'projects/thumbnails/thumb.jpg',
    ]);

    Storage::disk('public')->put($project->thumbnail_path, 'thumbnail');

    $this->actingAs($this->admin)
        ->delete(route('admin.projects.destroy', $project))
        ->assertRedirect(route('admin.projects.index'));

    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    Storage::disk('public')->assertMissing($project->thumbnail_path);
});

test('non-admin users cannot create projects', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('admin.projects.store'), adminProjectPayload())
        ->assertForbidden();

    expect(Project::query()->count())->toBe(0);
});
