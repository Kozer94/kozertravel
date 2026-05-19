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

        $origin      = $request->origin ? strtoupper($request->origin) : null;
        $destination = $request->destination ? strtoupper($request->destination) : null;
        $ip           = $request->ip();

        // Dedup بسيط لتقليل التلاعب/التكرار
        // (نفس مصدر/origin/destination/ip خلال نفس اليوم)
        $now = now();
        $existing = AffiliateClick::query()
            ->where('source_name', $request->source)
            ->where('origin', $origin)
            ->where('destination', $destination)
            ->where('ip', $ip)
            ->whereDate('created_at', $now->toDateString())
            ->first();


        if (!$existing) {
            AffiliateClick::create([
                'source_name' => $request->source,
                'origin'      => $origin,
                'destination' => $destination,
                'ip'          => $ip,
            ]);
        }


        return response()->json(['ok' => true]);
    }
}
