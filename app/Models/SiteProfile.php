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
}
