<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'name',
    'role',
    'location',
    'email',
    'github_url',
    'linkedin_url',
    'cv_path',
    'cv_original_name',
    'logo_path',
    'logo_original_name',
])]
class SiteProfile extends Model
{
    use HasFactory;

    protected function cvUrl(): Attribute
    {
        return Attribute::get(
            fn (): ?string => $this->cv_path
                ? Storage::disk('public')->url($this->cv_path)
                : null,
        );
    }

    protected function logoUrl(): Attribute
    {
        return Attribute::get(
            fn (): ?string => $this->logo_path
                ? Storage::disk('public')->url($this->logo_path)
                : null,
        );
    }

    protected function faviconUrl(): Attribute
    {
        return Attribute::get(function (): ?string {
            if (! $this->logo_path) {
                return null;
            }

            $faviconPath = $this->faviconPath();

            return $faviconPath !== null && Storage::disk('public')->exists($faviconPath)
                ? Storage::disk('public')->url($faviconPath)
                : Storage::disk('public')->url($this->logo_path);
        });
    }

    public static function faviconPathFor(string $logoPath): string
    {
        $directory = pathinfo($logoPath, PATHINFO_DIRNAME);
        $filename = pathinfo($logoPath, PATHINFO_FILENAME);

        return ($directory !== '.' ? $directory.'/' : '').$filename.'-favicon.png';
    }

    public static function current(): self
    {
        return static::query()->first() ?? new static([
            'name' => 'Fikri Amrullah',
            'role' => 'Full Stack Developer',
            'location' => 'Garut, Indonesia',
            'email' => 'fikri.amrulloh15@gmail.com',
            'github_url' => 'https://github.com/massiki',
        ]);
    }

    public function hasCv(): bool
    {
        return filled($this->cv_path);
    }

    public function hasLogo(): bool
    {
        return filled($this->logo_path);
    }

    public function faviconPath(): ?string
    {
        return $this->logo_path ? static::faviconPathFor($this->logo_path) : null;
    }

    public function hasGeneratedFavicon(): bool
    {
        $faviconPath = $this->faviconPath();

        return $faviconPath !== null && Storage::disk('public')->exists($faviconPath);
    }
}
