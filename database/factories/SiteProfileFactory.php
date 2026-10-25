<?php

namespace Database\Factories;

use App\Models\SiteProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SiteProfile>
 */
class SiteProfileFactory extends Factory
{
    protected $model = SiteProfile::class;

    public function definition(): array
    {
        return [
            'name' => 'Fikri Amrullah',
            'role' => 'Full Stack Developer',
            'location' => 'Garut, Indonesia',
            'email' => 'fikri.amrulloh15@gmail.com',
            'github_url' => 'https://github.com/massiki',
            'linkedin_url' => null,
            'cv_path' => null,
            'cv_original_name' => null,
            'logo_path' => null,
            'logo_original_name' => null,
        ];
    }
}
