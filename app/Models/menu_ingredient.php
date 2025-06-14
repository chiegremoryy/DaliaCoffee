<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class menu_ingredient extends Model
{
    //
    protected $fillable = [
        'menu_id',
        'ingredient_id',
        'quantity',
    ];

    // Relasi
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function ingredient()
    {
        return $this->belongsTo(ingredients::class);
    }
}
