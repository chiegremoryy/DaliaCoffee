<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_id',
        'quantity',
        'price_per_item',
        'subtotal',
    ];

    // --- Relasi ---

    /**
     * Sebuah order item termasuk dalam satu order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Sebuah order item mengacu pada satu menu.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}