<?php

use App\Models\Project;
use App\Models\SiteProfile;
use Illuminate\Support\Facades\Storage;

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

test('site logo replaces the fa monogram when it is present', function () {
    $profile = SiteProfile::current();

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('data-logo-fallback')
        ->assertSee('favicon.svg');

    $profile->update([
        'logo_path' => 'branding/logo/logo.png',
    ]);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee($profile->logo_url)
        ->assertDontSee('data-logo-fallback');
});

test('site favicon uses the generated logo favicon when available', function () {
    Storage::fake('public');

    $profile = SiteProfile::current();
    $profile->update([
        'logo_path' => 'branding/logo/logo.webp',
    ]);

    Storage::disk('public')->put(SiteProfile::faviconPathFor($profile->logo_path), 'png');

    $this->get(route('home'))
        ->assertOk()
        ->assertSee($profile->favicon_url)
        ->assertSee('type="image/png"', false);
});

test('home shows the profile photo when it is uploaded', function () {
    Storage::fake('public');

    $profile = SiteProfile::current();
    $profile->update([
        'photo_path' => 'profile/photo/fikri.jpg',
        'photo_original_name' => 'fikri.jpg',
    ]);
    Storage::disk('public')->put($profile->photo_path, 'photo');

    $this->get(route('home'))
        ->assertOk()
        ->assertSee($profile->photo_url)
        ->assertSee('Foto '.$profile->name)
        ->assertDontSee('Foto belum diunggah');
});

test('home shows a photo placeholder when no profile photo is uploaded', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Foto belum diunggah');
});

test('home shows the sdlc process map', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Peta proses / SDLC')
        ->assertSee('Empat fase, satu putaran umpan balik.')
        ->assertSee('Umpan balik')
        ->assertSee('ITERASI BERLANJUT');
});

test('home presents the four work phases', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Empat fase yang bisa diperiksa')
        ->assertSee('Perencanaan')
        ->assertSee('Menganalisis kebutuhan pengguna')
        ->assertSee('Analisis')
        ->assertSee('Memetakan proses bisnis saat ini')
        ->assertSee('Desain')
        ->assertSee('Merancang arsitektur sistem')
        ->assertSee('Implementasi')
        ->assertSee('Melatih pengguna agar sistem dapat dioperasikan dengan baik');
});

test('skills page lists the expanded toolkit', function () {
    $this->get(route('skills'))
        ->assertOk()
        ->assertSee('Node.js')
        ->assertSee('PostgreSQL')
        ->assertSee('Livewire')
        ->assertSee('Bootstrap')
        ->assertSee('TypeScript')
        ->assertSee('React')
        ->assertSee('Next.js')
        ->assertSee('Figma')
        ->assertSee('Runtime JavaScript untuk tooling build dan layanan sisi server.')
        ->assertSee('Basis data relasional: tabel, relasi, query, dan migrasi.')
        ->assertSee('Komponen interaktif Laravel yang tetap berjalan di atas Blade.')
        ->assertSee('Grid, komponen, dan utilitas untuk antarmuka yang konsisten.')
        ->assertSee('Tipe statis untuk kontrak data, props komponen, dan refactor yang lebih aman.')
        ->assertSee('Antarmuka berbasis komponen, state, dan props untuk halaman yang interaktif.')
        ->assertSee('Routing, rendering, dan optimasi halaman React.')
        ->assertSee('Wireframe, prototipe, dan handoff desain ke implementasi.')
        ->assertSee('Postman')
        ->assertSee('Trello')
        ->assertSee('Alat bantu untuk merancang, membangun, menguji, dan melacak pekerjaan.')
        ->assertSee('Koleksi request, pengujian endpoint, dan dokumentasi API.')
        ->assertSee('Papan tugas, prioritas, dan pelacakan progres pekerjaan.');
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
