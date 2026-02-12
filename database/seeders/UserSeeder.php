<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'role' => 'admin',
            'password' => bcrypt('adminPassword'),
        ]);
        $user = User::query()->create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'password' => bcrypt('userPassword'),
        ]);

        if (! $admin->exists || ! $user->exists) {
            throw new RuntimeException('Failed to seed default users.');
        }
    }
}
