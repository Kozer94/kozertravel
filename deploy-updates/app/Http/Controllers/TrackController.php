<?php

namespace App\Http\Controllers;

use App\Models\AffiliateClick;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function click(Request $request)
    {
        $request->validate([
            'source'      => 'required|string|max:100',
            'origin'      => 'nullable|string|size:3',
            'destination' => 'nullable|string|size:3',
        ]);

        AffiliateClick::create([
            'source_name' => $request->source,
            'origin'      => $request->origin ? strtoupper($request->origin) : null,
            'destination' => $request->destination ? strtoupper($request->destination) : null,
            'ip'          => $request->ip(),
        ]);

        return response()->json(['ok' => true]);
    }
}
