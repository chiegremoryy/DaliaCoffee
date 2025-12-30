<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => bcrypt('password'), // Password: password
            'role' => 'owner',
        ]);

        User::factory()->create([
            'name' => 'Kasir',
            'email' => 'kasir@example.com',
            'password' => bcrypt('password'), // Password: password
            'role' => 'kasir',
        ]);
    }
}
