<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'title',
    'slug',
    'summary',
    'description',
    'problem_statement',
    'solution',
    'category_id',
    'features',
    'technologies',
    'thumbnail_path',
    'live_url',
    'repository_url',
    'status',
    'is_featured',
    'is_placeholder',
    'sort_order',
    'published_at',
])]
class Project extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'technologies' => 'array',
            'status' => ProjectStatus::class,
            'is_featured' => 'boolean',
            'is_placeholder' => 'boolean',
            'sort_order' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', ProjectStatus::Published);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('published_at');
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::get(
            fn (): ?string => $this->thumbnail_path
                ? Storage::disk('public')->url($this->thumbnail_path)
                : null,
        );
    }

    public function isPublished(): bool
    {
        return $this->status === ProjectStatus::Published;
    }

    public function isDraft(): bool
    {
        return $this->status === ProjectStatus::Draft;
    }
}
