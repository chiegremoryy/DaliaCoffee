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
        Schema::create('stock_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingredient_id')
                ->constrained('ingredients')
                ->onDelete('cascade'); // Foreign Key ke tabel 'ingredients'
            $table->enum('type', ['in', 'out']); // Tipe perubahan stok, 'in' untuk penambahan, 'out' untuk pengurangan
            $table->decimal('quantity', 10, 2); // Jumlah perubahan stok, bisa berupa angka desimal
            $table->string('description')->nullable(); // Deskripsi perubahan stok, bisa kosong
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_histories');
    }
};
