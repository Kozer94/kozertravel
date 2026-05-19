<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = ['origin', 'destination', 'date', 'return_date', 'adults', 'trip_type', 'ip'];

    protected $casts = ['date' => 'date', 'return_date' => 'date'];
}
