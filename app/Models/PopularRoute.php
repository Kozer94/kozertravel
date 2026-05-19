<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopularRoute extends Model
{
    protected $fillable = ['origin', 'destination', 'label_ar', 'label_en', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
