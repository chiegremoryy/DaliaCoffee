<?php

namespace Database\Seeders;

use App\Models\ingredients;
use App\Models\stock_histories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        stock_histories::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Ambil semua bahan baku yang telah diseed
        $ingredients = ingredients::all();

        foreach ($ingredients as $ingredient) {
            // 1. Catat penambahan stok awal (in) sesuai dengan stok saat ini di tabel ingredients
            stock_histories::create([
                'ingredient_id' => $ingredient->id,
                'type' => 'in',
                'quantity' => $ingredient->stock,
                'description' => 'Stok awal sistem',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ]);

            // 2. Berikan beberapa transaksi acak / contoh pengurangan stok (out)
            // Misalnya untuk Beras, Telur, Minyak Goreng, dsb.
            if (in_array($ingredient->name, ['Beras', 'Telur', 'Minyak Goreng', 'Mie Instan', 'Susu Kental Manis'])) {
                // Catat pengurangan stok
                $outQty = rand(1, 5);
                stock_histories::create([
                    'ingredient_id' => $ingredient->id,
                    'type' => 'out',
                    'quantity' => $outQty,
                    'description' => 'Digunakan untuk pembuatan menu',
                    'created_at' => now()->subDays(2),
                    'updated_at' => now()->subDays(2),
                ]);

                // Kurangi stok di tabel ingredients agar sinkron dengan histori
                $ingredient->decrement('stock', $outQty);
            }
        }
    }
}
