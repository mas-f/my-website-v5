<?php

use App\Models\SiteProfile;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->profile = SiteProfile::factory()->create();
    Storage::fake('public');
});

test('admin can view the profile settings page', function () {
    $this->actingAs($this->admin)
        ->get(route('admin.profile.edit'))
        ->assertOk()
        ->assertSee('Profil publik & CV')
        ->assertSee('Foto profil')
        ->assertSee('Logo situs');
});

test('admin can update the public profile and upload a cv', function () {
    $cv = UploadedFile::fake()->create('cv-fikri.pdf', 100, 'application/pdf');

    $this->actingAs($this->admin)
        ->patch(route('admin.profile.update'), [
            'profile' => [
                'name' => 'Fikri Amrullah',
                'role' => 'Laravel Developer',
                'location' => 'Garut, Indonesia',
                'email' => 'fikri@example.com',
                'github_url' => 'https://github.com/massiki',
                'linkedin_url' => '',
            ],
            'cv' => $cv,
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    $this->profile->refresh();

    expect($this->profile->role)->toBe('Laravel Developer')
        ->and($this->profile->email)->toBe('fikri@example.com')
        ->and($this->profile->cv_path)->not->toBeNull()
        ->and($this->profile->cv_original_name)->toBe('cv-fikri.pdf');

    Storage::disk('public')->assertExists($this->profile->cv_path);
});

test('admin can delete the public cv', function () {
    $this->profile->update([
        'cv_path' => 'cv/current-cv.pdf',
        'cv_original_name' => 'current-cv.pdf',
    ]);

    Storage::disk('public')->put($this->profile->cv_path, 'pdf');

    $this->actingAs($this->admin)
        ->delete(route('admin.profile.cv.destroy'))
        ->assertRedirect();

    $this->profile->refresh();

    expect($this->profile->cv_path)->toBeNull()
        ->and($this->profile->cv_original_name)->toBeNull();

    Storage::disk('public')->assertMissing('cv/current-cv.pdf');
});

test('admin profile shows the current logo and delete control', function () {
    $this->profile->update([
        'logo_path' => 'branding/logo/current-logo.png',
        'logo_original_name' => 'current-logo.png',
    ]);
    Storage::disk('public')->put(SiteProfile::faviconPathFor($this->profile->logo_path), 'png');

    $this->actingAs($this->admin)
        ->get(route('admin.profile.edit'))
        ->assertOk()
        ->assertSee($this->profile->logo_url)
        ->assertSee($this->profile->favicon_url)
        ->assertSee('type="image/png"', false)
        ->assertSee('current-logo.png')
        ->assertSee('Hapus logo');
});

test('admin can upload a site logo in an allowed format', function (string $name) {
    $logo = UploadedFile::fake()->image($name, 512, 512);

    $this->actingAs($this->admin)
        ->patch(route('admin.profile.update'), [
            'profile' => [
                'name' => 'Fikri Amrullah',
                'role' => 'Laravel Developer',
                'location' => 'Garut, Indonesia',
                'email' => 'fikri@example.com',
                'github_url' => 'https://github.com/massiki',
                'linkedin_url' => '',
            ],
            'logo' => $logo,
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    $this->profile->refresh();

    expect($this->profile->logo_path)->not->toBeNull()
        ->and($this->profile->logo_original_name)->toBe($name);

    Storage::disk('public')->assertExists($this->profile->logo_path);
    Storage::disk('public')->assertExists(SiteProfile::faviconPathFor($this->profile->logo_path));

    $favicon = Storage::disk('public')->get(SiteProfile::faviconPathFor($this->profile->logo_path));
    $dimensions = getimagesizefromstring($favicon) ?: [];

    expect($dimensions)->not->toBeEmpty()
        ->and($dimensions[0] ?? null)->toBe(64)
        ->and($dimensions[1] ?? null)->toBe(64)
        ->and($dimensions['mime'] ?? null)->toBe('image/png');
})->with([
    'jpg' => 'logo.jpg',
    'jpeg' => 'logo.jpeg',
    'png' => 'logo.png',
    'webp' => 'logo.webp',
]);

test('admin can replace the site logo and the old file is deleted', function () {
    $this->profile->update([
        'logo_path' => 'branding/logo/old-logo.png',
        'logo_original_name' => 'old-logo.png',
    ]);

    Storage::disk('public')->put($this->profile->logo_path, 'old');
    Storage::disk('public')->put(SiteProfile::faviconPathFor($this->profile->logo_path), 'old favicon');

    $logo = UploadedFile::fake()->image('new-logo.png', 512, 512);

    $this->actingAs($this->admin)
        ->patch(route('admin.profile.update'), [
            'profile' => [
                'name' => 'Fikri Amrullah',
                'role' => 'Laravel Developer',
                'location' => 'Garut, Indonesia',
                'email' => 'fikri@example.com',
                'github_url' => 'https://github.com/massiki',
                'linkedin_url' => '',
            ],
            'logo' => $logo,
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    $this->profile->refresh();

    expect($this->profile->logo_path)->not->toBe('branding/logo/old-logo.png')
        ->and($this->profile->logo_original_name)->toBe('new-logo.png');

    Storage::disk('public')->assertMissing('branding/logo/old-logo.png');
    Storage::disk('public')->assertMissing(SiteProfile::faviconPathFor('branding/logo/old-logo.png'));
    Storage::disk('public')->assertExists($this->profile->logo_path);
    Storage::disk('public')->assertExists(SiteProfile::faviconPathFor($this->profile->logo_path));
});

test('admin can delete the site logo', function () {
    $this->profile->update([
        'logo_path' => 'branding/logo/current-logo.png',
        'logo_original_name' => 'current-logo.png',
    ]);

    Storage::disk('public')->put($this->profile->logo_path, 'logo');
    Storage::disk('public')->put(SiteProfile::faviconPathFor($this->profile->logo_path), 'favicon');

    $this->actingAs($this->admin)
        ->delete(route('admin.profile.logo.destroy'))
        ->assertRedirect();

    $this->profile->refresh();

    expect($this->profile->logo_path)->toBeNull()
        ->and($this->profile->logo_original_name)->toBeNull();

    Storage::disk('public')->assertMissing('branding/logo/current-logo.png');
    Storage::disk('public')->assertMissing(SiteProfile::faviconPathFor('branding/logo/current-logo.png'));
});

test('site logo validation rejects svg uploads', function () {
    $logo = UploadedFile::fake()->create('logo.svg', 10, 'image/svg+xml');

    $this->actingAs($this->admin)
        ->patch(route('admin.profile.update'), [
            'profile' => [
                'name' => 'Fikri Amrullah',
                'role' => 'Laravel Developer',
                'location' => 'Garut, Indonesia',
                'email' => 'fikri@example.com',
                'github_url' => 'https://github.com/massiki',
                'linkedin_url' => '',
            ],
            'logo' => $logo,
        ])
        ->assertSessionHasErrors([
            'logo' => 'Logo harus berupa gambar berformat JPEG, JPG, PNG, atau WebP.',
        ], null, 'updateProfile');
});

test('admin profile shows the current photo and delete control', function () {
    $this->profile->update([
        'photo_path' => 'profile/photo/current-photo.jpg',
        'photo_original_name' => 'current-photo.jpg',
    ]);
    Storage::disk('public')->put($this->profile->photo_path, 'photo');

    $this->actingAs($this->admin)
        ->get(route('admin.profile.edit'))
        ->assertOk()
        ->assertSee($this->profile->photo_url)
        ->assertSee('current-photo.jpg')
        ->assertSee('Hapus foto');
});

test('admin can upload a profile photo in an allowed format', function (string $name) {
    $photo = UploadedFile::fake()->image($name, 800, 1000);

    $this->actingAs($this->admin)
        ->patch(route('admin.profile.update'), [
            'profile' => [
                'name' => 'Fikri Amrullah',
                'role' => 'Laravel Developer',
                'location' => 'Garut, Indonesia',
                'email' => 'fikri@example.com',
                'github_url' => 'https://github.com/massiki',
                'linkedin_url' => '',
            ],
            'photo' => $photo,
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    $this->profile->refresh();

    expect($this->profile->photo_path)->not->toBeNull()
        ->and($this->profile->photo_original_name)->toBe($name)
        ->and($this->profile->hasPhoto())->toBeTrue();

    Storage::disk('public')->assertExists($this->profile->photo_path);
})->with([
    'jpg' => 'photo.jpg',
    'jpeg' => 'photo.jpeg',
    'png' => 'photo.png',
    'webp' => 'photo.webp',
]);

test('admin can replace the profile photo and the old file is deleted', function () {
    $this->profile->update([
        'photo_path' => 'profile/photo/old-photo.jpg',
        'photo_original_name' => 'old-photo.jpg',
    ]);

    Storage::disk('public')->put($this->profile->photo_path, 'old');

    $photo = UploadedFile::fake()->image('new-photo.jpg', 800, 1000);

    $this->actingAs($this->admin)
        ->patch(route('admin.profile.update'), [
            'profile' => [
                'name' => 'Fikri Amrullah',
                'role' => 'Laravel Developer',
                'location' => 'Garut, Indonesia',
                'email' => 'fikri@example.com',
                'github_url' => 'https://github.com/massiki',
                'linkedin_url' => '',
            ],
            'photo' => $photo,
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors();

    $this->profile->refresh();

    expect($this->profile->photo_path)->not->toBe('profile/photo/old-photo.jpg')
        ->and($this->profile->photo_original_name)->toBe('new-photo.jpg');

    Storage::disk('public')->assertMissing('profile/photo/old-photo.jpg');
    Storage::disk('public')->assertExists($this->profile->photo_path);
});

test('admin can delete the profile photo', function () {
    $this->profile->update([
        'photo_path' => 'profile/photo/current-photo.jpg',
        'photo_original_name' => 'current-photo.jpg',
    ]);

    Storage::disk('public')->put($this->profile->photo_path, 'photo');

    $this->actingAs($this->admin)
        ->delete(route('admin.profile.photo.destroy'))
        ->assertRedirect();

    $this->profile->refresh();

    expect($this->profile->photo_path)->toBeNull()
        ->and($this->profile->photo_original_name)->toBeNull()
        ->and($this->profile->hasPhoto())->toBeFalse();

    Storage::disk('public')->assertMissing('profile/photo/current-photo.jpg');
});

test('profile photo validation rejects svg uploads', function () {
    $photo = UploadedFile::fake()->create('photo.svg', 10, 'image/svg+xml');

    $this->actingAs($this->admin)
        ->patch(route('admin.profile.update'), [
            'profile' => [
                'name' => 'Fikri Amrullah',
                'role' => 'Laravel Developer',
                'location' => 'Garut, Indonesia',
                'email' => 'fikri@example.com',
                'github_url' => 'https://github.com/massiki',
                'linkedin_url' => '',
            ],
            'photo' => $photo,
        ])
        ->assertSessionHasErrors([
            'photo' => 'Foto profil harus berupa gambar berformat JPEG, JPG, PNG, atau WebP.',
        ], null, 'updateProfile');
});

test('profile validation uses the update profile error bag', function () {
    $this->actingAs($this->admin)
        ->patch(route('admin.profile.update'), ['profile' => []])
        ->assertSessionHasErrors(['name', 'role', 'location', 'email'], null, 'updateProfile');
});

test('admin can update account credentials', function () {
    $this->actingAs($this->admin)
        ->patch(route('admin.account.update'), [
            'name' => 'Admin Diperbarui',
            'email' => 'admin-diperbarui@example.com',
        ])
        ->assertRedirect(route('admin.profile.edit'))
        ->assertSessionHasNoErrors();

    $this->admin->refresh();

    expect($this->admin->name)->toBe('Admin Diperbarui')
        ->and($this->admin->email)->toBe('admin-diperbarui@example.com');
});

test('account validation uses the update account error bag', function () {
    $this->actingAs($this->admin)
        ->patch(route('admin.account.update'), [])
        ->assertSessionHasErrors(['name', 'email'], null, 'updateAccount');
});

test('admin can update their password', function () {
    $this->actingAs($this->admin)
        ->put(route('admin.account.password.update'), [
            'current_password' => 'password',
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ])
        ->assertRedirect()
        ->assertSessionHasNoErrors('updatePassword');

    expect(Hash::check('NewPassword123!', $this->admin->refresh()->password))->toBeTrue();
});

test('password update validates the current password', function () {
    $this->actingAs($this->admin)
        ->put(route('admin.account.password.update'), [
            'current_password' => 'password-salah',
            'password' => 'NewPassword123!',
            'password_confirmation' => 'NewPassword123!',
        ])
        ->assertSessionHasErrors('current_password', null, 'updatePassword');
});
