<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function results(Request $request)
    {
        $city     = $request->input('city', '');
        $checkIn  = $request->input('check_in', '');
        $checkOut = $request->input('check_out', '');
        $guests   = $request->input('guests', 2);

        $affiliateUrl = '';
        if ($city) {
            $affiliateUrl = "https://www.hotellook.com/search?location=" . urlencode($city)
                . "&checkIn={$checkIn}&checkOut={$checkOut}&adults={$guests}"
                . "&marker=" . config('services.travelpayouts.hotel_marker', '');
        }

        return view('hotels.results', compact('city', 'checkIn', 'checkOut', 'guests', 'affiliateUrl'));
    }
}
