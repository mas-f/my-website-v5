<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteProfileRequest;
use App\Models\SiteProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteProfileController extends Controller
{
    public function edit(): View
    {
        return view('admin.profile.edit', [
            'profile' => SiteProfile::current(),
            'user' => Auth::user(),
        ]);
    }

    public function update(UpdateSiteProfileRequest $request): RedirectResponse
    {
        $profile = $this->profile();
        $data = $request->safe()->except(['cv', 'logo', 'photo']);
        $oldPaths = [];
        $logoFile = null;
        $logoPath = null;

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');

            $data['cv_path'] = $file->store('cv', 'public');
            $data['cv_original_name'] = $file->getClientOriginalName();
            $oldPaths[] = $profile->cv_path;
        }

        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoPath = $logoFile->store('branding/logo', 'public');

            $data['logo_path'] = $logoPath;
            $data['logo_original_name'] = $logoFile->getClientOriginalName();
            $oldPaths[] = $profile->logo_path;
            $oldPaths[] = $profile->faviconPath();
        }

        if ($request->hasFile('photo')) {
            $photoFile = $request->file('photo');
            $photoPath = $photoFile->store('profile/photo', 'public');

            $data['photo_path'] = $photoPath;
            $data['photo_original_name'] = $photoFile->getClientOriginalName();
            $oldPaths[] = $profile->photo_path;
        }

        $profile->update($data);

        if ($logoFile && $logoPath) {
            $this->storeFavicon($logoFile, $logoPath);
        }

        foreach (array_filter($oldPaths) as $path) {
            Storage::disk('public')->delete($path);
        }

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

    public function destroyLogo(): RedirectResponse
    {
        $profile = $this->profile();

        Storage::disk('public')->delete(array_filter([
            $profile->logo_path,
            $profile->faviconPath(),
        ]));

        $profile->update([
            'logo_path' => null,
            'logo_original_name' => null,
        ]);

        return back()->with('success', 'Logo situs berhasil dihapus.');
    }

    public function destroyPhoto(): RedirectResponse
    {
        $profile = $this->profile();

        if ($profile->photo_path) {
            Storage::disk('public')->delete($profile->photo_path);
        }

        $profile->update([
            'photo_path' => null,
            'photo_original_name' => null,
        ]);

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }

    private function storeFavicon(UploadedFile $file, string $logoPath): void
    {
        $contents = $this->generateFavicon($file->getRealPath());

        if ($contents === null) {
            return;
        }

        Storage::disk('public')->put(SiteProfile::faviconPathFor($logoPath), $contents);
    }

    private function generateFavicon(string $path): ?string
    {
        if (! function_exists('imagecreatefromstring')
            || ! function_exists('imagecreatetruecolor')
            || ! function_exists('imagecopyresampled')
            || ! function_exists('imagepng')) {
            return null;
        }

        $sourceContents = file_get_contents($path);

        if ($sourceContents === false) {
            return null;
        }

        $source = @imagecreatefromstring($sourceContents);

        if ($source === false) {
            return null;
        }

        $sourceWidth = imagesx($source);
        $sourceHeight = imagesy($source);

        if ($sourceWidth < 1 || $sourceHeight < 1) {
            imagedestroy($source);

            return null;
        }

        $size = 64;
        $favicon = imagecreatetruecolor($size, $size);

        if ($favicon === false) {
            imagedestroy($source);

            return null;
        }

        imagealphablending($favicon, false);
        imagesavealpha($favicon, true);
        $transparent = imagecolorallocatealpha($favicon, 0, 0, 0, 127);
        imagefilledrectangle($favicon, 0, 0, $size, $size, $transparent);

        $scale = min($size / $sourceWidth, $size / $sourceHeight);
        $targetWidth = max(1, (int) round($sourceWidth * $scale));
        $targetHeight = max(1, (int) round($sourceHeight * $scale));
        $targetX = (int) round(($size - $targetWidth) / 2);
        $targetY = (int) round(($size - $targetHeight) / 2);

        imagecopyresampled(
            $favicon,
            $source,
            $targetX,
            $targetY,
            0,
            0,
            $targetWidth,
            $targetHeight,
            $sourceWidth,
            $sourceHeight,
        );

        imagedestroy($source);

        ob_start();
        imagepng($favicon);
        $contents = ob_get_clean();
        imagedestroy($favicon);

        return is_string($contents) ? $contents : null;
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
