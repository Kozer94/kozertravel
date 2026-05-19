<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'from_code','from_name_ar','from_name_en',
        'to_code','to_name_ar','to_name_en',
        'slug','description_ar','description_en',
        'best_time_ar','best_time_en','flight_duration',
        'meta_title','meta_description','og_image',
        'is_active','sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function labelAr(): string
    {
        return "{$this->from_name_ar} — {$this->to_name_ar}";
    }

    public function labelEn(): string
    {
        return "{$this->from_name_en} — {$this->to_name_en}";
    }
}
