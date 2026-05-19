<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateSource extends Model
{
    protected $fillable = ['name', 'label_ar', 'label_en', 'color', 'url_template', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean'];
}
