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
    }
}
