<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Developer
        User::create([
            'email' => 'dev@email.com',
            'username' => 'dev',
            'name' => 'Developer',
            'password' => bcrypt('dev'),
            'role' => 'DEVELOPER'
        ]);

        // Owner
        User::create([
            'email' => 'owner@email.com',
            'username' => 'owner',
            'name' => 'Owner',
            'password' => bcrypt('12345678'),
            'role' => 'OWNER'
        ]);

        // Admin
        User::create([
            'email' => 'admin@email.com',
            'username' => 'admin',
            'name' => 'Admin',
            'password' => bcrypt('12345678'),
            'role' => 'ADMIN'
        ]);

        // Developer
        User::create([
            'email' => 'staff@email.com',
            'username' => 'staff',
            'name' => 'Staff',
            'password' => bcrypt('12345678'),
            'role' => 'STAFF'
        ]);
    }
}
