<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function show(Destination $destination)
    {
        return view('destinations.show', compact('destination'));
    }
}
