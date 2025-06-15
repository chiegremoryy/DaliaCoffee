<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_code',
        'total_amount',
        'payment_method',
        'cashier_id',
        'order_date',
    ];

    protected $casts = [
        'order_date' => 'date',
    ];

    // --- Relasi ---

    /**
     * Sebuah order dibuat oleh satu user (kasir).
     */
    public function cashier()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Sebuah order bisa memiliki banyak order item.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
