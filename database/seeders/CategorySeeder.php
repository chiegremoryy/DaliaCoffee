<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'name' => 'Makanan'],
            ['id' => 2, 'name' => 'Minuman'],
            ['id' => 3, 'name' => 'Snack'],
            ['id' => 5, 'name' => 'Milkshake'],
            ['id' => 6, 'name' => 'Coffee'],
            ['id' => 7, 'name' => 'Jus and Mix'],
            ['id' => 9, 'name' => 'Minuman Spesial'],
            ['id' => 10, 'name' => 'Seafood Bakar'],
            ['id' => 11, 'name' => 'New Snack'],
            ['id' => 12, 'name' => 'Mocktail'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['id' => $category['id']],
                ['name' => $category['name']]
            );
        }
    }
}
