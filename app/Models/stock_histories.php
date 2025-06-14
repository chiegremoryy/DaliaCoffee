<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class stock_histories extends Model
{
    //
    protected $fillable = [
        'ingredient_id',
        'quantity',
        'type', // 'in' or 'out'
        'description',
    ];

    // Relasi
    public function ingredient()
    {
        return $this->belongsTo(ingredients::class);
    }
}
