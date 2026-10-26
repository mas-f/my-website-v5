<?php

namespace Database\Factories;

use App\Enums\ProjectStatus;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $title = fake()->unique()->sentence(4);

        return [
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->numberBetween(100, 999),
            'summary' => fake()->paragraph(2),
            'description' => fake()->paragraphs(4, true),
            'problem_statement' => fake()->paragraph(3),
            'solution' => fake()->paragraph(3),
            'category_id' => Category::factory(),
            'features' => ['Fitur contoh satu', 'Fitur contoh dua', 'Fitur contoh tiga'],
            'technologies' => ['Laravel', 'MySQL', 'Tailwind CSS'],
            'thumbnail_path' => null,
            'live_url' => null,
            'repository_url' => null,
            'status' => ProjectStatus::Published,
            'is_featured' => false,
            'is_placeholder' => false,
            'sort_order' => fake()->numberBetween(1, 20),
            'published_at' => now(),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => ProjectStatus::Draft,
            'published_at' => null,
        ]);
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
