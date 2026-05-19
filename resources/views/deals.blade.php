@extends('layouts.public')

@section('title')
<span class="ar">العروض</span><span class="en" style="display:none">Deals</span>
@endsection

@push('styles')
<style>
    .deal-card {
        background: var(--white); border-radius: var(--radius);
        border: 1px solid #e8e4da; overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s; text-decoration: none; display: block; color: inherit;
    }
    .deal-card:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(0,0,0,0.1); border-color: var(--sky); }
    .deal-top {
        background: linear-gradient(135deg, var(--sky) 0%, #0f3fcf 100%);
        padding: 1.5rem; color: var(--white); position: relative; overflow: hidden;
    }
    .deal-top::after {
        content: '✈'; position: absolute; font-size: 4rem;
        right: -10px; bottom: -10px; opacity: 0.15;
    }
    .deal-route { display: flex; align-items: center; gap: 0.6rem; font-size: 1.05rem; font-weight: 600; }
    .deal-arrow { opacity: 0.7; font-size: 0.9rem; }
    .deal-code { font-size: 0.72rem; opacity: 0.75; margin-top: 2px; letter-spacing: 1px; }
    .deal-body { padding: 1.2rem 1.5rem; }
    .deal-label { font-size: 0.82rem; color: var(--ink-3); margin-bottom: 0.8rem; }
    .deal-action { display: flex; align-items: center; justify-content: space-between; }
    .deal-badge { background: #e8fff3; color: #15803d; font-size: 0.75rem; font-weight: 500; padding: 3px 10px; border-radius: 20px; }
    .deal-btn {
        background: var(--sky); color: var(--white); border: none;
        border-radius: 8px; padding: 0.45rem 1.1rem; font-size: 0.85rem;
        font-family: 'Tajawal', sans-serif; cursor: pointer; text-decoration: none; font-weight: 500;
        transition: opacity 0.2s;
    }
    .deal-btn:hover { opacity: 0.85; }
    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-state .icon { font-size: 3rem; margin-bottom: 1rem; }
    .empty-state h3 { font-size: 1.2rem; color: var(--ink-2); margin-bottom: 0.5rem; }
    .empty-state p { color: var(--ink-3); font-size: 0.95rem; margin-bottom: 1.5rem; }
    .section-eyebrow { font-size: 0.82rem; color: var(--sky); font-weight: 500; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
    .section-title { font-family: 'DM Serif Display', serif; font-size: 2rem; color: var(--ink); margin-bottom: 2rem; }
</style>
@endpush

@section('content')

<div class="page-hero">
    <h1 class="ar">✈ أفضل عروض الطيران</h1>
    <h1 class="en">✈ Best Flight Deals</h1>
    <p class="ar">وجهات مميزة بأسعار لا تفوّتها — قارن واحجز في ثوانٍ</p>
    <p class="en">Top destinations at unbeatable prices — compare and book in seconds</p>
</div>

<div class="page-content">

    @if($routes->isNotEmpty())
        <div class="section-eyebrow ar">وجهات مختارة</div>
        <div class="section-eyebrow en">Featured Destinations</div>
        <h2 class="section-title ar">رحلات موصى بها</h2>
        <h2 class="section-title en">Recommended Flights</h2>

        <div class="cards-grid">
            @foreach($routes as $route)
            <a href="/search?origin={{ $route->origin }}&destination={{ $route->destination }}" class="deal-card">
                <div class="deal-top">
                    <div class="deal-route">
                        <div>
                            <div>{{ $route->origin }}</div>
                            <div class="deal-code">{{ $route->origin }}</div>
                        </div>
                        <div class="deal-arrow">→</div>
                        <div>
                            <div>{{ $route->destination }}</div>
                            <div class="deal-code">{{ $route->destination }}</div>
                        </div>
                    </div>
                </div>
                <div class="deal-body">
                    <div class="deal-label ar">{{ $route->label_ar ?? $route->origin . ' ← ' . $route->destination }}</div>
                    <div class="deal-label en">{{ $route->label_en ?? $route->origin . ' → ' . $route->destination }}</div>
                    <div class="deal-action">
                        <span class="deal-badge ar">🔥 عرض مميز</span>
                        <span class="deal-badge en">🔥 Hot Deal</span>
                        <a href="/search?origin={{ $route->origin }}&destination={{ $route->destination }}" class="deal-btn ar">ابحث الآن</a>
                        <a href="/search?origin={{ $route->origin }}&destination={{ $route->destination }}" class="deal-btn en">Search Now</a>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

    @else
        <div class="card empty-state">
            <div class="icon">✈</div>
            <h3 class="ar">العروض قريباً</h3>
            <h3 class="en">Deals Coming Soon</h3>
            <p class="ar">نعمل على تجميع أفضل العروض لك. ابحث عن رحلتك الآن!</p>
            <p class="en">We're curating the best deals for you. Search for your flight now!</p>
            <a href="/search" class="btn btn-primary ar">ابحث عن رحلتك ←</a>
            <a href="/search" class="btn btn-primary en">Search Flights →</a>
        </div>
    @endif

    {{-- CTA strip --}}
    <div class="card" style="margin-top:2.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;background:linear-gradient(135deg,var(--sky),#0f3fcf);border:none;color:#fff">
        <div>
            <div style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-bottom:0.3rem" class="ar">لم تجد وجهتك؟</div>
            <div style="font-family:'DM Serif Display',serif;font-size:1.4rem;margin-bottom:0.3rem" class="en">Didn't find your destination?</div>
            <div style="opacity:0.85;font-size:0.95rem" class="ar">ابحث عن أي رحلة مباشرة</div>
            <div style="opacity:0.85;font-size:0.95rem" class="en">Search for any flight directly</div>
        </div>
        <a href="/search" class="btn" style="background:#fff;color:var(--sky);font-weight:600">
            <span class="ar">بحث متقدم ←</span>
            <span class="en">Advanced Search →</span>
        </a>
    </div>

</div>
@endsection
