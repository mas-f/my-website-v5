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
        ->assertSee('Profil publik & CV');
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
