<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@ftunsur.ac.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => Role::SUPER_ADMIN,
                'is_active' => true,
            ]
        );
    }
}
