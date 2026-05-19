@extends('admin.layout')
@section('title', 'لوحة التحكم')

@section('content')

{{-- Stats Grid --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">بحثات اليوم</div>
        <div class="stat-value">{{ number_format($searchesToday) }}</div>
        <div class="stat-sub">منذ منتصف الليل</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">بحثات الأسبوع</div>
        <div class="stat-value">{{ number_format($searchesWeek) }}</div>
        <div class="stat-sub">هذا الأسبوع</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">بحثات الشهر</div>
        <div class="stat-value">{{ number_format($searchesMonth) }}</div>
        <div class="stat-sub">هذا الشهر</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">نقرات أفلييت اليوم</div>
        <div class="stat-value" style="color:#f59e0b">{{ number_format($clicksToday) }}</div>
        <div class="stat-sub">إجمالي: {{ number_format($clicksTotal) }}</div>
    </div>
</div>

{{-- Chart --}}
<div class="chart-container">
    <div class="chart-title">📈 النشاط — آخر 7 أيام</div>
    @php
        $maxVal = max(collect($last7Days)->map(fn($d) => max($d['searches'], $d['clicks']))->max(), 1);
    @endphp
    <div class="bar-chart">
        @foreach($last7Days as $day)
        <div class="bar-col">
            <div class="bar-wrap">
                <div class="bar bar-s" style="height:{{ round(($day['searches']/$maxVal)*85) }}px" title="بحثات: {{ $day['searches'] }}"></div>
                <div class="bar bar-c" style="height:{{ round(($day['clicks']/$maxVal)*85) }}px" title="نقرات: {{ $day['clicks'] }}"></div>
            </div>
            <div class="bar-label">{{ $day['date'] }}</div>
        </div>
        @endforeach
    </div>
    <div class="chart-legend">
        <div class="legend-item"><div class="legend-dot" style="background:var(--sky)"></div> البحثات</div>
        <div class="legend-item"><div class="legend-dot" style="background:#f59e0b"></div> النقرات</div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">

    {{-- Top Routes --}}
    <div class="table-card">
        <div class="table-header">
            <h3>✈️ أكثر المسارات مطلوبة</h3>
        </div>
        <table>
            <thead><tr><th>#</th><th>المسار</th><th>عدد البحثات</th></tr></thead>
            <tbody>
                @forelse($topRoutes as $i => $r)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td><strong>{{ $r->route }}</strong></td>
                    <td><span class="badge badge-blue">{{ $r->total }}</span></td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center;color:#aaa;padding:2rem">لا توجد بيانات بعد</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Top Sources --}}
    <div class="table-card">
        <div class="table-header">
            <h3>👆 أكثر مصادر الأفلييت نقراً</h3>
        </div>
        <table>
            <thead><tr><th>#</th><th>المصدر</th><th>النقرات</th></tr></thead>
            <tbody>
                @forelse($topSources as $i => $s)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td><strong>{{ $s->source_name }}</strong></td>
                    <td><span class="badge badge-yellow">{{ $s->total }}</span></td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center;color:#aaa;padding:2rem">لا توجد بيانات بعد</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
