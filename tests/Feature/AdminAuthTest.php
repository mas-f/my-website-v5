<?php

use App\Models\SiteProfile;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

test('admin login page renders', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertSee('Masuk.')
        ->assertDontSee('Daftar');
});

test('login page uses the uploaded site logo as favicon', function () {
    Storage::fake('public');

    $profile = SiteProfile::factory()->create([
        'logo_path' => 'branding/logo/logo.png',
    ]);
    Storage::disk('public')->put(SiteProfile::faviconPathFor($profile->logo_path), 'png');

    $this->get(route('login'))
        ->assertOk()
        ->assertSee($profile->favicon_url);
});

test('guests are redirected from the admin area', function () {
    $this->get(route('admin.dashboard'))
        ->assertRedirect(route('login'));
});

test('non-admin users receive forbidden responses', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

test('admin users can sign in', function () {
    $admin = User::factory()->admin()->create([
        'email' => 'admin@example.com',
    ]);

    $this->post(route('login'), [
        'email' => 'admin@example.com',
        'password' => 'password',
    ])->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($admin);
});

test('authenticated admins are redirected from the legacy dashboard route', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('dashboard'))
        ->assertRedirect('/admin');
});

test('admin users can sign out', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->post(route('admin.logout'))
        ->assertRedirect('/');

    $this->assertGuest();
});

test('authenticated admins are redirected away from the login page', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get(route('login'))
        ->assertRedirect(route('admin.dashboard'));
});

test('admin create command provisions an administrator', function () {
    $this->artisan('admin:create', [
        '--name' => 'Admin Baru',
        '--email' => 'admin-baru@example.com',
        '--password' => 'StrongPassword123!',
    ])->assertSuccessful();

    $admin = User::query()->where('email', 'admin-baru@example.com')->firstOrFail();

    expect($admin->name)->toBe('Admin Baru')
        ->and($admin->isAdmin())->toBeTrue()
        ->and($admin->email_verified_at)->not->toBeNull();
});
