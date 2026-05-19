<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateClick extends Model
{
    protected $fillable = ['source_name', 'origin', 'destination', 'ip'];
}
