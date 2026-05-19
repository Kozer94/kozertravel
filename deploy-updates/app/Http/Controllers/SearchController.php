<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private string $marker = '633503';

    public function index()
    {
        return view('search');
    }

    public function results(Request $request)
    {
        $request->validate([
            'origin'      => 'required|string|size:3',
            'destination' => 'required|string|size:3',
            'date'        => 'required|date|after:today',
            'adults'      => 'required|integer|min:1|max:9',
            'trip_type'   => 'nullable|in:oneway,roundtrip',
            'return_date' => ['nullable', 'required_if:trip_type,roundtrip', 'date', 'after:date'],
        ]);

        $origin      = strtoupper($request->origin);
        $destination = strtoupper($request->destination);
        $date        = $request->date;
        $dateShort        = \Carbon\Carbon::parse($date)->format('Ymd'); // للمصادر الأخرى
        $aviasalesDate    = \Carbon\Carbon::parse($date)->format('dm'); // لـ Aviasales فقط: 2905
        $dateDashes       = \Carbon\Carbon::parse($date)->format('Y-m-d');
        $adults      = $request->adults;
        $marker      = $this->marker;

        $tripType    = $request->trip_type ?? 'oneway';
        $isRoundTrip = $tripType === 'roundtrip' && $request->return_date;
        $returnDate  = $isRoundTrip ? $request->return_date : null;
        $returnDateShort      = $isRoundTrip ? \Carbon\Carbon::parse($returnDate)->format('Ymd')  : null;
        $aviasalesReturnDate  = $isRoundTrip ? \Carbon\Carbon::parse($returnDate)->format('dm')   : null;
        $returnDateDashes = $isRoundTrip ? \Carbon\Carbon::parse($returnDate)->format('Y-m-d') : null;

        // Log the search
        try {
            Search::create([
                'origin'      => $origin,
                'destination' => $destination,
                'date'        => $date,
                'return_date' => $returnDate,
                'adults'      => $adults,
                'trip_type'   => $tripType,
                'ip'          => $request->ip(),
            ]);
        } catch (\Exception $e) {
            // Fail silently so search still works if DB issue
        }

        $sources = [
            [
                'name'    => 'Aviasales',
                'logo'    => 'https://pics.avs.io/200/50/aviasales.png',
                'color'   => '#FF6D00',
                'url'     => $isRoundTrip
                    ? "https://www.aviasales.com/search/{$origin}{$aviasalesDate}{$destination}{$aviasalesReturnDate}{$adults}?marker={$marker}"
                    : "https://www.aviasales.com/search/{$origin}{$aviasalesDate}{$destination}{$adults}?marker={$marker}",
                'label_ar' => 'أفضل سعر مباشر',
                'label_en' => 'Best direct price',
            ],
            [
                'name'    => 'Jetradar',
                'logo'    => null,
                'color'   => '#00AEEF',
                'url'     => $isRoundTrip
                    ? "https://www.jetradar.com/flights/?origin={$origin}&destination={$destination}&depart_date={$dateDashes}&return_date={$returnDateDashes}&adults={$adults}&marker={$marker}"
                    : "https://www.jetradar.com/flights/?origin={$origin}&destination={$destination}&depart_date={$dateDashes}&adults={$adults}&marker={$marker}",
                'label_ar' => 'بحث دولي للرحلات',
                'label_en' => 'International flight search',
            ],
            [
                'name'    => 'Hotellook',
                'logo'    => null,
                'color'   => '#4CAF50',
                'url'     => $isRoundTrip
                    ? "https://hotellook.com/search?destination={$destination}&checkIn={$dateDashes}&checkOut={$returnDateDashes}&adults={$adults}&marker={$marker}"
                    : "https://hotellook.com/search?destination={$destination}&checkIn={$dateDashes}&adults={$adults}&marker={$marker}",
                'label_ar' => 'أفضل أسعار الفنادق',
                'label_en' => 'Best hotel prices',
            ],
            [
                'name'    => 'Booking.com',
                'logo'    => null,
                'color'   => '#003580',
                'url'     => "https://search.hotellook.com/?destination={$destination}&checkIn={$dateDashes}&marker={$marker}",
                'label_ar' => 'مع إمكانية إلغاء مجاني',
                'label_en' => 'Free cancellation available',
            ],
            [
                'name'    => 'RentalCars',
                'logo'    => null,
                'color'   => '#E65100',
                'url'     => "https://www.rentalcars.com/?affiliateCode=travelpayouts&preflang=ar&location={$destination}&puDay={$dateDashes}&marker={$marker}",
                'label_ar' => 'استئجار سيارة بأفضل سعر',
                'label_en' => 'Best car rental price',
            ],
            [
                'name'    => 'Kiwi.com',
                'logo'    => null,
                'color'   => '#E4175B',
                'url'     => $isRoundTrip
                    ? "https://www.kiwi.com/en/search/results/{$origin}/{$destination}/{$dateDashes}/{$returnDateDashes}?affilid=travelpayouts{$marker}"
                    : "https://www.kiwi.com/en/search/results/{$origin}/{$destination}/{$dateDashes}?affilid=travelpayouts{$marker}",
                'label_ar' => 'رحلات متعددة المحطات',
                'label_en' => 'Multi-stop routes',
            ],
        ];

        return view('results', compact('sources', 'origin', 'destination', 'date', 'adults', 'tripType', 'returnDate'));
    }
}