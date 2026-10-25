<?php

namespace Database\Seeders;

use App\Models\SiteProfile;
use Illuminate\Database\Seeder;

class SiteProfileSeeder extends Seeder
{
    public function run(): void
    {
        SiteProfile::query()->firstOrCreate([], [
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
        ]);
    }
}
