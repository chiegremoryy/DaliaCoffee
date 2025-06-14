<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'status',
    ];

    // --- Relasi ---

    /**
     * Sebuah menu termasuk dalam satu kategori.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Sebuah menu bisa ada di banyak order item.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
