<?php

namespace Database\Seeders;

use App\Models\AffiliateSource;
use Illuminate\Database\Seeder;

class AffiliateSourceSeeder extends Seeder
{
    public function run(): void
    {
        $sources = [
            [
                'name'         => 'Travelpayouts / Aviasales',
                'label_ar'     => 'أفضل سعر مباشر',
                'label_en'     => 'Best direct price',
                'color'        => '#FF6D00',
                'sort_order'   => 1,
                'url_template' => 'https://www.aviasales.com/search/{origin}{date_short}{destination}{adults}?marker={marker}&utm_source=affiliate',
            ],
            [
                'name'         => 'Skyscanner',
                'label_ar'     => 'قارن مئات الرحلات',
                'label_en'     => 'Compare hundreds of flights',
                'color'        => '#0770E3',
                'sort_order'   => 2,
                'url_template' => 'https://www.skyscanner.com/transport/flights/{origin}/{destination}/{date_short}/?adults={adults}&ref={marker}',
            ],
            [
                'name'         => 'Booking.com',
                'label_ar'     => 'مع إمكانية إلغاء مجاني',
                'label_en'     => 'Free cancellation available',
                'color'        => '#003580',
                'sort_order'   => 3,
                'url_template' => 'https://www.booking.com/flights/search.html?from={origin}&to={destination}&depart_date={date_dashes}&adults={adults}&aid=2311236',
            ],
            [
                'name'         => 'Kiwi.com',
                'label_ar'     => 'رحلات متعددة المحطات',
                'label_en'     => 'Multi-stop routes',
                'color'        => '#E4175B',
                'sort_order'   => 4,
                'url_template' => 'https://www.kiwi.com/en/search/results/{origin}/{destination}/{date_dashes}?adults={adults}&affilid={marker}',
            ],
            [
                'name'         => 'Google Flights',
                'label_ar'     => 'استكشف كل الخيارات',
                'label_en'     => 'Explore all options',
                'color'        => '#4285F4',
                'sort_order'   => 5,
                'url_template' => 'https://www.google.com/travel/flights#flt={origin}.{destination}.{date_dashes};c:USD;e:1;sd:1;t:f;q:{adults}',
            ],
            [
                'name'         => 'Expedia',
                'label_ar'     => 'عروض حصرية',
                'label_en'     => 'Exclusive deals',
                'color'        => '#FFC72C',
                'sort_order'   => 6,
                'url_template' => 'https://www.expedia.com/Flights-Search?flight-type=on&mode=search&trip=oneway&leg1=from:{origin},to:{destination},departure:{date_dashes}TANYT&passengers=adults:{adults}&affcid={marker}',
            ],
        ];

        foreach ($sources as $src) {
            AffiliateSource::updateOrCreate(
                ['name' => $src['name']],
                array_merge($src, ['is_active' => true])
            );
        }
    }
}
