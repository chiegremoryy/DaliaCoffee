<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade'); // Foreign Key ke tabel 'menus'
            $table->foreignId('ingredient_id')->constrained('ingredients')->onDelete('cascade'); // Foreign Key ke tabel 'ingredients'
            $table->decimal('quantity', 10, 2); // Jumlah bahan yang digunakan dalam menu, bisa berupa angka desimal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_ingredients');
    }
};
