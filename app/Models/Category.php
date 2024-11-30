<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function item()
    {
        return $this->hasMany(MenuItem::class); // Or use 'Item' if that's your model name
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
