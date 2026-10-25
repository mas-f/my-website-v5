<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(SiteProfileSeeder::class);

        if (app()->environment(['local', 'testing'])) {
            $this->call(DemoProjectSeeder::class);
        }

        User::query()->firstOrCreate([
            'email' => env('DATA_EMAIL'),
        ], [
            'name' => 'Fikri Amrullah',
            'email' => env('DATA_EMAIL'),
            'password' => bcrypt(env('DATA_PASSWORD')),
            'is_admin' => true
        ]);
    }
}
