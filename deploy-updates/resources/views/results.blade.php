<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }} — نتائج البحث</title>
    @include('partials.analytics')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --ink: #0f172a; --ink-2: #334155; --ink-3: #64748b;
            --sky: {{ $siteSettings['primary_color'] ?? '#2563eb' }};
            --sky-lt: color-mix(in srgb, {{ $siteSettings['primary_color'] ?? '#2563eb' }} 10%, white);
            --sand: #f8fafc; --white: #ffffff; --radius: 16px;
            --gold: #f59e0b; --navy: #020817;
        }
        body { font-family: 'Tajawal', sans-serif; background: var(--sand); color: var(--ink); min-height: 100vh; }

        /* NAV */
        nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 3rem; background: rgba(255,255,255,0.92); backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0,0,0,0.06); position: sticky; top: 0; z-index: 200;
            box-shadow: 0 1px 20px rgba(0,0,0,0.06);
        }
        .logo { font-family: 'DM Serif Display', serif; font-size: 1.55rem; color: var(--sky); text-decoration: none; }
        .lang-switch { display: flex; gap: 4px; }
        .lang-btn {
            border: 1.5px solid #e2e8f0; background: none; border-radius: 8px;
            padding: 5px 12px; font-size: 0.82rem; cursor: pointer;
            color: var(--ink-2); font-family: 'Tajawal', sans-serif; font-weight: 500; transition: all 0.2s;
        }
        .lang-btn.active, .lang-btn:hover { background: var(--sky); color: var(--white); border-color: var(--sky); }

        /* Search summary bar */
        .search-bar {
            background: linear-gradient(135deg, #020817 0%, #0c1445 100%);
            padding: 1.2rem 3rem; display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .route-pill {
            background: rgba(255,255,255,0.12); color: var(--white);
            border: 1px solid rgba(255,255,255,0.2); border-radius: 30px;
            padding: 7px 18px; font-size: 1.05rem; font-weight: 600; letter-spacing: 0.5px;
        }
        .edit-search {
            background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.85);
            border: 1px solid rgba(255,255,255,0.2); border-radius: 10px;
            padding: 7px 16px; font-size: 0.85rem;
            cursor: pointer; font-family: 'Tajawal', sans-serif; font-weight: 500;
            text-decoration: none; display: inline-block; transition: all 0.2s;
        }
        .edit-search:hover { background: rgba(255,255,255,0.2); color: var(--white); }
        .search-meta { color: rgba(255,255,255,0.55); font-size: 0.88rem; }
        .trip-type-tag {
            background: rgba(245,158,11,0.2); color: var(--gold);
            border: 1px solid rgba(245,158,11,0.3); border-radius: 20px;
            padding: 4px 12px; font-size: 0.8rem; font-weight: 500;
        }

        /* Results container */
        .container { max-width: 940px; margin: 2.5rem auto; padding: 0 1.5rem 5rem; }

        .results-header {
            margin-bottom: 1.8rem;
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
        }
        .results-title { font-size: 1.15rem; font-weight: 500; color: var(--ink-2); }
        .results-title strong { color: var(--sky); font-weight: 700; }
        .results-sub { font-size: 0.82rem; color: var(--ink-3); margin-top: 2px; }

        /* Source cards */
        .source-card {
            background: var(--white); border: 1.5px solid #e2e8f0;
            border-radius: 20px; padding: 1.6rem 2rem;
            margin-bottom: 1rem; display: flex;
            align-items: center; justify-content: space-between;
            transition: all 0.25s; text-decoration: none; color: inherit;
            animation: slideUp 0.45s cubic-bezier(0.16,1,0.3,1) both;
            position: relative; overflow: hidden;
        }
        /* Left color accent bar */
        .source-card::before {
            content: ''; position: absolute; top: 0; right: 0; bottom: 0;
            width: 5px; border-radius: 0 20px 20px 0;
            background: var(--card-color, #2563eb);
            transition: width 0.25s;
        }
        [dir="rtl"] .source-card::before { right: auto; left: 0; border-radius: 20px 0 0 20px; }
        .source-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.1); border-color: var(--sky); }
        .source-card:hover::before { width: 7px; }

        /* Best value badge */
        .source-card.best-value { border-color: var(--gold); }
        .best-label {
            position: absolute; top: -1px; left: 50%; transform: translateX(-50%);
            background: linear-gradient(90deg, var(--gold), #e07c00);
            color: var(--white); font-size: 0.7rem; font-weight: 700;
            padding: 3px 14px; border-radius: 0 0 10px 10px; letter-spacing: 0.5px;
            white-space: nowrap;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(22px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .source-card:nth-child(1) { animation-delay: 0.04s; }
        .source-card:nth-child(2) { animation-delay: 0.1s; }
        .source-card:nth-child(3) { animation-delay: 0.16s; }
        .source-card:nth-child(4) { animation-delay: 0.22s; }
        .source-card:nth-child(5) { animation-delay: 0.28s; }
        .source-card:nth-child(6) { animation-delay: 0.34s; }

        .source-left { display: flex; align-items: center; gap: 1.3rem; }
        .source-icon {
            width: 54px; height: 54px; border-radius: 14px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 1.05rem; color: var(--white);
            box-shadow: 0 4px 14px rgba(0,0,0,0.2);
        }
        .source-info {}
        .source-name { font-weight: 700; font-size: 1.1rem; margin-bottom: 3px; color: var(--ink); }
        .source-label { font-size: 0.83rem; color: var(--ink-3); line-height: 1.4; }
        .source-desc { font-size: 0.78rem; color: var(--ink-3); margin-top: 3px; display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
        .source-tag { background: #f1f5f9; color: var(--ink-3); border-radius: 6px; padding: 1px 8px; font-size: 0.72rem; font-weight: 500; }

        .source-right { display: flex; align-items: center; gap: 1.8rem; }
        .source-trust { text-align: center; }
        .trust-stars { color: var(--gold); font-size: 0.78rem; letter-spacing: 1px; }
        .trust-label { font-size: 0.7rem; color: var(--ink-3); margin-top: 1px; }

        .book-btn {
            padding: 0.75rem 2rem; border-radius: 12px; border: none;
            font-size: 1rem; font-family: 'Tajawal', sans-serif;
            font-weight: 700; cursor: pointer; color: var(--white);
            transition: all 0.25s; white-space: nowrap; display: flex; align-items: center; gap: 6px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.2);
        }
        .book-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.25); filter: brightness(1.08); }
        .book-btn .btn-arrow { transition: transform 0.2s; }
        .source-card:hover .btn-arrow { transform: translateX(-4px); }
        [dir="rtl"] .source-card:hover .btn-arrow { transform: translateX(4px); }

        .disclaimer {
            text-align: center; color: var(--ink-3); font-size: 0.8rem;
            margin-top: 2.5rem; line-height: 1.7;
            background: var(--white); border-radius: 12px; padding: 1rem 1.5rem;
            border: 1px solid #e2e8f0;
        }

        /* FILTER BAR */
        .filter-strip {
            background: var(--white); border-radius: 14px; padding: 1rem 1.5rem;
            margin-bottom: 1.5rem; border: 1.5px solid #e2e8f0;
            display: flex; align-items: center; gap: 0.8rem; flex-wrap: wrap;
        }
        .filter-label-sm { font-size: 0.78rem; color: var(--ink-3); font-weight: 600; margin-left: 0.2rem; }
        .filter-chip {
            background: #f1f5f9; border: 1.5px solid #e2e8f0; border-radius: 20px;
            padding: 5px 16px; font-size: 0.85rem; cursor: pointer;
            font-family: 'Tajawal', sans-serif; color: var(--ink-2); transition: all 0.2s;
        }
        .filter-chip.active { background: var(--sky); color: #fff; border-color: var(--sky); }
        .filter-chip:hover:not(.active) { border-color: var(--sky); color: var(--sky); }

        /* TIPS */
        .tip-box {
            background: linear-gradient(135deg, #0c1445 0%, #1e1040 100%);
            border-radius: 14px; padding: 1.4rem 1.8rem;
            margin-top: 2rem; color: rgba(255,255,255,0.85); font-size: 0.88rem; line-height: 1.7;
        }
        .tip-box h4 { color: #fff; font-size: 1rem; margin-bottom: 0.5rem; }
        .tip-list { list-style: none; }
        .tip-list li::before { content: '💡 '; }

        [data-lang="en"] .ar { display: none; }
        [data-lang="ar"] .en { display: none; }

        @media (max-width: 600px) {
            .source-card { flex-direction: column; align-items: flex-start; gap: 1.2rem; }
            .source-right { width: 100%; justify-content: space-between; }
            .book-btn { flex: 1; justify-content: center; }
            nav, .search-bar { padding: 1rem 1.2rem; }
        }
    </style>
</head>
<body data-lang="ar">

<nav>
    <a href="/" class="logo">
        @if(!empty($siteSettings['site_logo']))
            <img src="{{ Storage::disk('public')->url($siteSettings['site_logo']) }}"
                 alt="{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}"
                 style="height:34px;object-fit:contain;vertical-align:middle">
        @else
            {{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}
        @endif
    </a>
    <div class="lang-switch">
        <button class="lang-btn active" onclick="setLang('ar')">العربية</button>
        <button class="lang-btn" onclick="setLang('en')">English</button>
    </div>
</nav>

<div class="search-bar">
    <div class="route-pill">{{ $origin }} {{ $tripType === 'roundtrip' ? '⇄' : '✈' }} {{ $destination }}</div>
    @if($tripType === 'roundtrip')
    <div class="trip-type-tag">
        <span class="ar">ذهاب وإياب</span><span class="en">Round Trip</span>
    </div>
    @endif
    <div class="search-meta">
        {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
        @if($tripType === 'roundtrip' && $returnDate)
        → {{ \Carbon\Carbon::parse($returnDate)->format('d M Y') }}
        @endif
        · {{ $adults }} <span class="ar">بالغ</span><span class="en">adult(s)</span>
    </div>
    <a href="/search?origin={{ $origin }}&destination={{ $destination }}&date={{ $date }}&adults={{ $adults }}&trip_type={{ $tripType }}{{ $returnDate ? '&return_date='.$returnDate : '' }}"
       class="edit-search">
        <span class="ar">✏ تعديل البحث</span>
        <span class="en">✏ Edit Search</span>
    </a>
</div>

<div class="container">
    <!-- Filter strip -->
    <div class="filter-strip">
        <span class="filter-label-sm ar">ترتيب حسب:</span>
        <span class="filter-label-sm en">Sort by:</span>
        <button class="filter-chip active" onclick="sortCards('popular')">
            <span class="ar">الأكثر بحثاً</span><span class="en">Most Popular</span>
        </button>
        <button class="filter-chip" onclick="sortCards('name')">
            <span class="ar">الاسم</span><span class="en">Name</span>
        </button>
        <button class="filter-chip" onclick="sortCards('rating')">
            <span class="ar">التقييم</span><span class="en">Rating</span>
        </button>
    </div>

    <div class="results-header">
        <div>
            <div class="results-title ar">
                وجدنا <strong>{{ count($sources) }}</strong> مصادر لرحلة {{ $origin }} {{ $tripType === 'roundtrip' ? '⇄' : '←' }} {{ $destination }}
                @if($tripType === 'roundtrip')<span style="font-size:0.82rem;color:var(--ink-3)"> · ذهاب وإياب</span>@endif
            </div>
            <div class="results-title en">
                Found <strong>{{ count($sources) }}</strong> sources for {{ $origin }} {{ $tripType === 'roundtrip' ? '⇄' : '→' }} {{ $destination }}
            </div>
            <div class="results-sub ar">اختر أفضل سعر واحجز مباشرة مع الشركة</div>
            <div class="results-sub en">Pick the best price and book directly with the provider</div>
        </div>
    </div>

    @php
        $sourceDescriptions = [
            'Aviasales'    => ['ar' => 'محرك بحث رائد للرحلات الرخيصة · مقارنة فورية', 'en' => 'Leading cheap flight search · Instant comparison'],
            'Skyscanner'   => ['ar' => 'أكبر موقع مقارنة طيران في العالم', 'en' => 'World\'s largest flight comparison site'],
            'Booking.com'  => ['ar' => 'منصة حجز عالمية موثوقة لملايين المسافرين', 'en' => 'Trusted global booking platform for millions'],
            'Kiwi.com'     => ['ar' => 'خبراء الرحلات متعددة المحطات والأسعار الذكية', 'en' => 'Multi-stop flight experts & smart pricing'],
            'Google Flights'=> ['ar' => 'بحث جوجل المتقدم لأفضل أسعار الطيران', 'en' => 'Google\'s advanced flight search tool'],
            'Expedia'      => ['ar' => 'وكالة سفر متكاملة — طيران + فندق + سيارة', 'en' => 'Full travel agency — flights + hotel + car'],
        ];
        $sourceTags = [
            'Aviasales'    => ['ar' => ['بحث سريع', 'مقارنة'], 'en' => ['Fast Search', 'Compare']],
            'Skyscanner'   => ['ar' => ['عالمي', 'موثوق'], 'en' => ['Global', 'Trusted']],
            'Booking.com'  => ['ar' => ['آمن', 'شامل'], 'en' => ['Secure', 'Complete']],
            'Kiwi.com'     => ['ar' => ['متعدد المحطات', 'ذكي'], 'en' => ['Multi-stop', 'Smart']],
            'Google Flights'=> ['ar' => ['بدون رسوم', 'دقيق'], 'en' => ['No fees', 'Accurate']],
            'Expedia'      => ['ar' => ['باقات سفر', 'خصومات'], 'en' => ['Travel bundles', 'Discounts']],
        ];
    @endphp

    @foreach($sources as $i => $source)
    @php $isFirst = $i === 0; @endphp
    <a href="{{ $source['url'] }}" target="_blank" rel="noopener"
       class="source-card {{ $isFirst ? 'best-value' : '' }}"
       style="--card-color: {{ $source['color'] }}"
       data-source="{{ $source['name'] }}"
       data-origin="{{ $origin }}"
       data-destination="{{ $destination }}"
       onclick="trackClick(this)">

        @if($isFirst)
        <div class="best-label ar">⭐ الأكثر بحثاً</div>
        <div class="best-label en">⭐ Most Searched</div>
        @endif

        <div class="source-left">
            <div class="source-icon" style="background: {{ $source['color'] }}">
                {{ strtoupper(substr($source['name'], 0, 2)) }}
            </div>
            <div class="source-info">
                <div class="source-name">{{ $source['name'] }}</div>
                <div class="source-label ar">{{ $source['label_ar'] }}</div>
                <div class="source-label en">{{ $source['label_en'] }}</div>
                <div class="source-desc">
                    <span class="ar">{{ $sourceDescriptions[$source['name']]['ar'] ?? '' }}</span>
                    <span class="en">{{ $sourceDescriptions[$source['name']]['en'] ?? '' }}</span>
                    @if(isset($sourceTags[$source['name']]))
                        @foreach($sourceTags[$source['name']]['ar'] ?? [] as $tag)
                            <span class="source-tag ar">{{ $tag }}</span>
                        @endforeach
                        @foreach($sourceTags[$source['name']]['en'] ?? [] as $tag)
                            <span class="source-tag en">{{ $tag }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="source-right">
            <div class="source-trust">
                <div class="trust-stars">★★★★★</div>
                <div class="trust-label ar">موثوق</div>
                <div class="trust-label en">Trusted</div>
            </div>
            <button class="book-btn" style="background: linear-gradient(135deg, {{ $source['color'] }}, {{ $source['color'] }}cc)">
                <span class="ar">احجز الآن</span>
                <span class="en">Book Now</span>
                <span class="btn-arrow">↗</span>
            </button>
        </div>
    </a>
    @endforeach

    <!-- Travel Tips -->
    <div class="tip-box">
        <h4 class="ar">💡 نصائح للحصول على أرخص الأسعار</h4>
        <h4 class="en">💡 Tips to Get the Cheapest Prices</h4>
        <ul class="tip-list">
            <li class="ar">احجز قبل 6-8 أسابيع للحصول على أفضل الأسعار</li>
            <li class="en">Book 6-8 weeks ahead for the best prices</li>
            <li class="ar">تواريخ الثلاثاء والأربعاء غالباً أرخص من العطلة</li>
            <li class="en">Tuesday and Wednesday are usually cheaper than weekends</li>
            <li class="ar">جرب الرحلات المتعددة المحطات للعثور على أسعار أقل</li>
            <li class="en">Try multi-stop flights to find lower fares</li>
        </ul>
    </div>

    <div class="disclaimer ar">
        🔒 روابط الحجز موثوقة وتحتوي على كود أفلييت خاص.<br>
        الأسعار المعروضة تقريبية وقد تختلف حسب التوافر وتاريخ الحجز.
    </div>
    <div class="disclaimer en">
        🔒 Booking links are trusted and contain affiliate tracking codes.<br>
        Shown prices are approximate and may vary based on availability and booking date.
    </div>
</div>

<script>
function setLang(lang) {
    document.body.setAttribute('data-lang', lang);
    document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
    document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
    event.target.classList.add('active');
}

function trackClick(el) {
    const data = {
        source:      el.dataset.source,
        origin:      el.dataset.origin,
        destination: el.dataset.destination,
        _token:      '{{ csrf_token() }}'
    };
    if (typeof gtag !== 'undefined') {
        gtag('event', 'affiliate_click', {
            'event_category': 'booking',
            'affiliate_name': data.source,
            'origin':         data.origin,
            'destination':    data.destination
        });
    }
    fetch('/track/click', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': data._token },
        body: JSON.stringify(data),
        keepalive: true
    }).catch(() => {});
}

function sortCards(by) {
    document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
    event.target.closest('.filter-chip').classList.add('active');
    const container = document.querySelector('.container');
    const cards = Array.from(container.querySelectorAll('.source-card'));
    cards.sort((a, b) => {
        if (by === 'name') return a.dataset.source.localeCompare(b.dataset.source);
        if (by === 'rating') return b.dataset.source.length - a.dataset.source.length;
        return parseInt(a.style.getPropertyValue('--i') || 0) - parseInt(b.style.getPropertyValue('--i') || 0);
    });
    cards.forEach(c => container.appendChild(c));
}
</script>
</body>
</html>