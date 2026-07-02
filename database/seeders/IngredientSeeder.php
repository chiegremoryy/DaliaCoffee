<?php

namespace Database\Seeders;

use App\Models\ingredients;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Matikan pengecekan foreign key & hapus data lama jika diperlukan
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ingredients::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $ingredients = [
            ['name' => 'Beras', 'unit' => 'kg', 'stock' => 50],
            ['name' => 'Telur', 'unit' => 'kg', 'stock' => 20],
            ['name' => 'Minyak Goreng', 'unit' => 'liter', 'stock' => 30],
            ['name' => 'Mie Instan', 'unit' => 'pcs', 'stock' => 100],
            ['name' => 'Ayam Fillet', 'unit' => 'kg', 'stock' => 15],
            ['name' => 'Sosis Premium', 'unit' => 'pcs', 'stock' => 80],
            ['name' => 'Bakso Sapi', 'unit' => 'pcs', 'stock' => 150],
            ['name' => 'Teh Kering', 'unit' => 'kg', 'stock' => 5],
            ['name' => 'Jeruk', 'unit' => 'kg', 'stock' => 10],
            ['name' => 'Lemon', 'unit' => 'kg', 'stock' => 5],
            ['name' => 'Biji Kopi Robusta', 'unit' => 'kg', 'stock' => 8],
            ['name' => 'Susu Kental Manis', 'unit' => 'kaleng', 'stock' => 24],
            ['name' => 'Sirup Coco Pandan', 'unit' => 'botol', 'stock' => 12],
            ['name' => 'Roti Tawar', 'unit' => 'pack', 'stock' => 10],
            ['name' => 'Kentang', 'unit' => 'kg', 'stock' => 25],
            ['name' => 'Keju Cheddar', 'unit' => 'pack', 'stock' => 8],
            ['name' => 'Cokelat Meses', 'unit' => 'pack', 'stock' => 5],
            ['name' => 'Air Soda', 'unit' => 'botol', 'stock' => 36],
            ['name' => 'Dimsum Mix', 'unit' => 'pcs', 'stock' => 200],
            ['name' => 'Bola Ikan', 'unit' => 'pcs', 'stock' => 100],
        ];

        foreach ($ingredients as $item) {
            ingredients::create($item);
        }
    }
}
