<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateClick;
use App\Models\Search;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $searchesToday   = Search::whereDate('created_at', today())->count();
        $searchesWeek    = Search::where('created_at', '>=', now()->startOfWeek())->count();
        $searchesMonth   = Search::where('created_at', '>=', now()->startOfMonth())->count();

        $clicksTotal     = AffiliateClick::count();
        $clicksToday     = AffiliateClick::whereDate('created_at', today())->count();

        // آخر 7 أيام للرسم البياني
        $last7Days = collect(range(6, 0))->map(function ($daysAgo) {
            $date = now()->subDays($daysAgo)->format('Y-m-d');
            return [
                'date'    => now()->subDays($daysAgo)->format('d/m'),
                'searches' => Search::whereDate('created_at', $date)->count(),
                'clicks'   => AffiliateClick::whereDate('created_at', $date)->count(),
            ];
        });

        // أكثر 5 مسارات مطلوبة
        $topRoutes = Search::select(
                DB::raw("origin || '-' || destination as route"),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('route')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // أكثر مصادر أفلييت نقراً
        $topSources = AffiliateClick::select('source_name', DB::raw('COUNT(*) as total'))
            ->groupBy('source_name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'searchesToday', 'searchesWeek', 'searchesMonth',
            'clicksTotal', 'clicksToday',
            'last7Days', 'topRoutes', 'topSources'
        ));
    }
}
