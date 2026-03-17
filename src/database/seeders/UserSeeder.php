<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@test.com'],
            ['name' => 'Admin Test', 'password' => Hash::make('admin'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'tecnico@test.com'],
            ['name' => 'Tecnico Test', 'password' => Hash::make('tecnico'), 'role' => 'tecnico']
        );
    }
}
