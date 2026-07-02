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
        User::updateOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name' => 'Owner',
                'password' => bcrypt('password'),
                'role' => 'owner',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir@example.com'],
            [
                'name' => 'Kasir',
                'password' => bcrypt('password'),
                'role' => 'kasir',
            ]
        );

        $this->call([
            CategorySeeder::class,
            IngredientSeeder::class,
            StockHistorySeeder::class,
        ]);
    }
}
