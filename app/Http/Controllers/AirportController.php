<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AirportController extends Controller
{
    private string $token = '696ce9a5144bdc8212f5836c5e09c2dd';

    public function suggest(Request $request)
    {
        $query = trim($request->get('q', ''));
        $lang  = $request->get('lang', 'ar');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $cacheKey = "airports_{$lang}_" . strtolower($query);

        $results = Cache::remember($cacheKey, 3600, function () use ($query, $lang) {
            $response = Http::withoutVerifying()->timeout(5)->get('https://autocomplete.travelpayouts.com/places2', [
                'term'   => $query,
                'locale' => $lang,
                'types'  => 'airport,city',
            ]);

            if ($response->failed()) return [];

            return collect($response->json())
                ->filter(fn($p) => isset($p['code']) && isset($p['name']))
                ->take(8)
                ->map(fn($p) => [
                    'code'    => $p['code'],
                    'name'    => $p['name'],
                    'city'    => $p['city_name'] ?? $p['name'],
                    'country' => $p['country_name'] ?? '',
                    'type'    => $p['type'] ?? 'airport',
                ])
                ->values()
                ->toArray();
        });

        return response()->json($results);
    }
}
