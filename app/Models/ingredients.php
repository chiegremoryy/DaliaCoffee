<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ingredients extends Model
{
    //
    protected $fillable = [
        'name',
        'unit',
        'stock',
    ];

    // Relasi
    public function menuIngredients()
    {
        return $this->hasMany(menu_ingredient::class);
    }

    public function stockHistories()
    {
        return $this->hasMany(stock_histories::class);
    }
}
