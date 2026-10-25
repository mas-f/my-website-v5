<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectImage>
 */
class ProjectImageFactory extends Factory
{
    protected $model = ProjectImage::class;

    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'image_path' => 'projects/'.fake()->uuid().'.jpg',
            'alt_text' => fake()->sentence(6),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
