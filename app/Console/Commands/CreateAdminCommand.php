<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class CreateAdminCommand extends Command
{
    protected $signature = 'admin:create
                            {--name= : Nama admin}
                            {--email= : Email admin}
                            {--password= : Password admin (minimal 12 karakter)}';

    protected $description = 'Membuat atau mempromosikan akun admin tanpa registrasi publik';

    public function handle(): int
    {
        $name = $this->option('name') ?: $this->ask('Nama admin', 'Fikri Amrullah');
        $email = $this->option('email') ?: $this->ask('Email admin', 'fikri.amrulloh15@gmail.com');

        $password = $this->option('password');
        $generated = false;

        if (blank($password) && $this->input->isInteractive()) {
            $password = $this->secret('Password admin (kosongkan untuk dibuat otomatis)');
        }

        if (blank($password)) {
            $password = Str::password(20);
            $generated = true;
        }

        $validator = Validator::make(
            ['name' => $name, 'email' => $email, 'password' => $password],
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'password' => ['required', 'string', Password::min(12)],
            ],
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => $password,
                'is_admin' => true,
                'email_verified_at' => now(),
            ],
        );

        $this->info("Admin siap: {$user->email}");

        if ($generated) {
            $this->newLine();
            $this->line('Password sementara: '.$password);
            $this->warn('Simpan password ini, lalu ganti setelah login pertama.');
        }

        return self::SUCCESS;
    }
}
