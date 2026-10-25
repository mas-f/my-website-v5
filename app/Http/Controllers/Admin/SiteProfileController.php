<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteProfileRequest;
use App\Models\SiteProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteProfileController extends Controller
{
    public function edit(): View
    {
        return view('admin.profile.edit', [
            'profile' => SiteProfile::current(),
            'user' => auth()->user(),
        ]);
    }

    public function update(UpdateSiteProfileRequest $request): RedirectResponse
    {
        $profile = $this->profile();
        $data = $request->safe()->except('cv');

        if ($request->hasFile('cv')) {
            if ($profile->cv_path) {
                Storage::disk('public')->delete($profile->cv_path);
            }

            $file = $request->file('cv');

            $data['cv_path'] = $file->store('cv', 'public');
            $data['cv_original_name'] = $file->getClientOriginalName();
        }

        $profile->update($data);

        return back()->with('success', 'Profil publik berhasil diperbarui.');
    }

    public function destroyCv(): RedirectResponse
    {
        $profile = $this->profile();

        if ($profile->cv_path) {
            Storage::disk('public')->delete($profile->cv_path);
        }

        $profile->update([
            'cv_path' => null,
            'cv_original_name' => null,
        ]);

        return back()->with('success', 'CV berhasil dihapus.');
    }

    private function profile(): SiteProfile
    {
        return SiteProfile::query()->firstOrCreate([], [
            'name' => 'Fikri Amrullah',
            'role' => 'Full Stack Developer',
            'location' => 'Garut, Indonesia',
            'email' => 'fikri.amrulloh15@gmail.com',
            'github_url' => 'https://github.com/massiki',
        ]);
    }
}
