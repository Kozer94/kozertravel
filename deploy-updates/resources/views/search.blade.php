<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }} — ابحث عن رحلتك</title>
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
            padding: 1rem 3rem;
            background: rgba(255,255,255,0.92); backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0,0,0,0.06); position: sticky; top: 0; z-index: 200;
            box-shadow: 0 1px 20px rgba(0,0,0,0.06);
        }
        .logo { font-family: 'DM Serif Display', serif; font-size: 1.65rem; color: var(--sky); text-decoration: none; font-weight: 400; }
        .lang-switch { display: flex; gap: 4px; }
        .lang-btn {
            border: 1.5px solid #e2e8f0; background: none; border-radius: 8px;
            padding: 5px 12px; font-size: 0.82rem; cursor: pointer;
            color: var(--ink-2); font-family: 'Tajawal', sans-serif; font-weight: 500; transition: all 0.2s;
        }
        .lang-btn.active, .lang-btn:hover { background: var(--sky); color: var(--white); border-color: var(--sky); }

        /* HERO */
        .hero-bar {
            background: linear-gradient(160deg, #020817 0%, #0c1445 50%, #1e1040 100%);
            padding: 4rem 2rem 6rem; text-align: center; position: relative; overflow: hidden;
        }
        .hero-bar::before {
            content: '';
            position: absolute; inset: 0;
            background:
                radial-gradient(ellipse 50% 80% at 50% 110%, rgba(37,99,235,0.3) 0%, transparent 70%),
                radial-gradient(1.5px 1.5px at 15% 25%, rgba(255,255,255,0.5) 0%, transparent 0%),
                radial-gradient(1px   1px   at 35% 60%, rgba(255,255,255,0.3) 0%, transparent 0%),
                radial-gradient(2px   2px   at 65% 20%, rgba(255,255,255,0.4) 0%, transparent 0%),
                radial-gradient(1px   1px   at 80% 70%, rgba(255,255,255,0.25) 0%, transparent 0%),
                radial-gradient(1.5px 1.5px at 92% 40%, rgba(255,255,255,0.35) 0%, transparent 0%);
        }
        .hero-bar h1 {
            font-family: 'DM Serif Display', serif; font-size: clamp(2.2rem, 5vw, 3.8rem);
            color: var(--white); margin-bottom: 0.7rem; letter-spacing: -0.5px; position: relative;
        }
        .hero-bar p { color: rgba(255,255,255,0.65); font-size: 1.05rem; position: relative; font-weight: 300; }

        /* SEARCH CARD */
        .search-card {
            max-width: 920px; margin: -3rem auto 3rem;
            background: var(--white); border-radius: 24px;
            padding: 2.2rem 2.8rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.14), 0 4px 16px rgba(0,0,0,0.08);
            position: relative; z-index: 10;
            border: 1px solid rgba(255,255,255,0.8);
        }
        .tabs { display: flex; gap: 6px; margin-bottom: 1.8rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1rem; }
        .tab {
            background: none; border: 1.5px solid #e2e8f0; border-radius: 20px;
            padding: 7px 20px; font-size: 0.9rem; cursor: pointer;
            font-family: 'Tajawal', sans-serif; color: var(--ink-2); font-weight: 500; transition: all 0.2s;
        }
        .tab.active { background: var(--sky); color: var(--white); border-color: var(--sky); box-shadow: 0 4px 12px rgba(37,99,235,0.3); }
        .fields { display: grid; grid-template-columns: 1fr auto 1fr 1fr 1fr; gap: 14px; align-items: end; }

        /* Autocomplete */
        .ac-wrap { position: relative; display: flex; flex-direction: column; gap: 5px; }
        .ac-wrap label { font-size: 0.78rem; color: var(--ink-3); font-weight: 600; letter-spacing: 0.3px; }
        .ac-input-row {
            display: flex; align-items: center; border: 2px solid #e2e8f0; border-radius: 12px;
            background: var(--white); transition: all 0.2s; overflow: hidden;
        }
        .ac-input-row:focus-within { border-color: var(--sky); box-shadow: 0 0 0 4px color-mix(in srgb, {{ $siteSettings['primary_color'] ?? '#2563eb' }} 15%, white); }
        .ac-code {
            padding: 0 12px; font-size: 0.78rem; font-weight: 700; color: var(--sky);
            background: var(--sky-lt); height: 100%;
            display: flex; align-items: center; min-width: 46px;
            justify-content: center; border-left: 2px solid #e2e8f0; flex-shrink: 0;
        }
        html[dir="rtl"] .ac-code { border-left: none; border-right: 2px solid #e2e8f0; }
        .ac-text {
            border: none; outline: none; padding: 0.8rem 0.9rem;
            font-size: 0.95rem; font-family: 'Tajawal', sans-serif;
            color: var(--ink); background: transparent; width: 100%;
        }
        .ac-dropdown {
            position: absolute; top: calc(100% + 8px); left: 0; right: 0;
            background: var(--white); border: 1px solid #e2e8f0;
            border-radius: 16px; box-shadow: 0 12px 40px rgba(0,0,0,0.14);
            z-index: 200; overflow: hidden; display: none;
        }
        .ac-dropdown.open { display: block; }
        .ac-item { display: flex; align-items: center; gap: 10px; padding: 11px 16px; cursor: pointer; transition: background 0.15s; }
        .ac-item:hover, .ac-item.focused { background: var(--sky-lt); }
        .ac-item-code {
            background: var(--sky); color: var(--white);
            font-size: 0.72rem; font-weight: 700;
            padding: 3px 8px; border-radius: 7px; flex-shrink: 0;
        }
        .ac-item-name { font-size: 0.9rem; color: var(--ink); font-weight: 500; }
        .ac-item-country { font-size: 0.78rem; color: var(--ink-3); margin-top: 1px; }
        .ac-loading { padding: 14px 16px; font-size: 0.85rem; color: var(--ink-3); text-align: center; }

        /* Fields */
        .field { display: flex; flex-direction: column; gap: 5px; }
        .field label { font-size: 0.78rem; color: var(--ink-3); font-weight: 600; letter-spacing: 0.3px; }
        .field input, .field select {
            border: 2px solid #e2e8f0; border-radius: 12px;
            padding: 0.8rem 1rem; font-size: 0.95rem;
            font-family: 'Tajawal', sans-serif; color: var(--ink);
            background: var(--white); outline: none; transition: all 0.2s; width: 100%;
        }
        .field input:focus, .field select:focus { border-color: var(--sky); box-shadow: 0 0 0 4px color-mix(in srgb, {{ $siteSettings['primary_color'] ?? '#2563eb' }} 15%, white); }

        /* Swap */
        .swap-btn {
            width: 40px; height: 40px; background: var(--sky-lt); border: none; border-radius: 50%;
            cursor: pointer; font-size: 1.1rem; display: flex; align-items: center; justify-content: center;
            margin-bottom: 2px; transition: all 0.2s; flex-shrink: 0; color: var(--sky);
        }
        .swap-btn:hover { background: var(--sky); color: var(--white); transform: rotate(180deg); }

        /* Search btn */
        .search-btn {
            background: linear-gradient(135deg, var(--sky), color-mix(in srgb, var(--sky) 80%, #7c3aed));
            color: var(--white); border: none; border-radius: 14px;
            padding: 1rem 2.5rem; font-size: 1.08rem; font-family: 'Tajawal', sans-serif;
            font-weight: 600; cursor: pointer; width: 100%; margin-top: 1.4rem;
            transition: all 0.25s; box-shadow: 0 4px 20px rgba(37,99,235,0.35);
            letter-spacing: 0.3px;
        }
        .search-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(37,99,235,0.45); }

        /* Trip type */
        .trip-row { display: flex; gap: 8px; margin-bottom: 1.5rem; }
        .trip-btn {
            background: none; border: 1.5px solid #e2e8f0; border-radius: 20px;
            padding: 6px 20px; font-size: 0.88rem; cursor: pointer;
            font-family: 'Tajawal', sans-serif; color: var(--ink-2); font-weight: 500; transition: all 0.2s;
        }
        .trip-btn.active { background: var(--sky); color: var(--white); border-color: var(--sky); box-shadow: 0 3px 10px rgba(37,99,235,0.3); }
        .fields.roundtrip { grid-template-columns: 1fr auto 1fr 1fr 1fr 1fr; }

        /* Popular */
        .popular { max-width: 920px; margin: 0 auto 4rem; padding: 0 1rem; }
        .popular h3 {
            font-size: 0.82rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
            color: var(--ink-3); margin-bottom: 1rem;
        }
        .popular-grid { display: flex; flex-wrap: wrap; gap: 10px; }
        .popular-chip {
            background: var(--white); border: 1.5px solid #e2e8f0;
            border-radius: 30px; padding: 9px 18px; font-size: 0.88rem;
            color: var(--ink-2); cursor: pointer; transition: all 0.2s;
            font-family: 'Tajawal', sans-serif; font-weight: 500;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        .popular-chip:hover { border-color: var(--sky); color: var(--sky); background: var(--sky-lt); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(37,99,235,0.15); }

        /* HOTEL FORM */
        #hotelForm { display: none; }
        #hotelForm .fields { grid-template-columns: 1fr 1fr 1fr 1fr; }

        /* LOADING OVERLAY */
        .search-overlay {
            display: none; position: fixed; inset: 0; z-index: 9999;
            background: rgba(2,8,23,0.9); backdrop-filter: blur(6px);
            flex-direction: column; align-items: center; justify-content: center; gap: 1.5rem;
        }
        .search-overlay.active { display: flex; }
        .plane-loader {
            font-size: 3rem; animation: fly 1.2s ease-in-out infinite;
        }
        @keyframes fly {
            0%,100% { transform: translateY(0) rotate(-5deg); }
            50%      { transform: translateY(-20px) rotate(5deg); }
        }
        .loader-text { color: #fff; font-size: 1.1rem; font-weight: 500; }
        .loader-bar { width: 260px; height: 4px; background: rgba(255,255,255,0.15); border-radius: 4px; overflow: hidden; }
        .loader-fill { height: 100%; background: var(--sky); border-radius: 4px; animation: fillbar 2s ease-in-out infinite; }
        @keyframes fillbar { 0%{width:0%} 60%{width:85%} 100%{width:100%} }

        [data-lang="en"] .ar { display: none; }
        [data-lang="ar"] .en { display: none; }
        @media (max-width: 700px) {
            .fields, .fields.roundtrip { grid-template-columns: 1fr 1fr; }
            .swap-btn { display: none; }
            nav { padding: 1rem 1.2rem; }
            .search-card { margin: -2.5rem 1rem 2rem; padding: 1.5rem; }
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
<div class="hero-bar">
    <h1 class="ar">ابحث عن رحلتك</h1>
    <h1 class="en">Search Your Flight</h1>
    <p class="ar">قارن أسعار مئات شركات الطيران في ثوانٍ</p>
    <p class="en">Compare hundreds of airlines in seconds</p>
</div>
<div class="search-card">
    <div class="tabs" id="mainTabs">
        <button class="tab active" id="tabFlights" onclick="switchTab('flights')">
            <span class="ar">✈ طيران</span><span class="en">✈ Flights</span>
        </button>
        <button class="tab" id="tabHotels" onclick="switchTab('hotels')">
            <span class="ar">🏨 فنادق</span><span class="en">🏨 Hotels</span>
        </button>
    </div>
    <form action="/results" method="GET" id="searchForm">
        <input type="hidden" name="origin" id="originCode">
        <input type="hidden" name="destination" id="destinationCode">
        <input type="hidden" name="trip_type" id="tripType" value="oneway">
        <div class="trip-row">
            <button type="button" class="trip-btn active" data-trip="oneway" onclick="setTripType('oneway')">
                <span class="ar">ذهاب فقط</span><span class="en">One Way</span>
            </button>
            <button type="button" class="trip-btn" data-trip="roundtrip" onclick="setTripType('roundtrip')">
                <span class="ar">ذهاب وإياب</span><span class="en">Round Trip</span>
            </button>
        </div>
        <div class="fields">
            <div class="ac-wrap" id="fromWrap">
                <label class="ar">من</label>
                <label class="en">From</label>
                <div class="ac-input-row">
                    <input class="ac-text" type="text" id="fromText" placeholder="بغداد / Baghdad" autocomplete="off">
                    <div class="ac-code" id="fromCode">---</div>
                </div>
                <div class="ac-dropdown" id="fromDrop"></div>
            </div>
            <button type="button" class="swap-btn" onclick="swapAirports()" title="تبديل">⇄</button>
            <div class="ac-wrap" id="toWrap">
                <label class="ar">إلى</label>
                <label class="en">To</label>
                <div class="ac-input-row">
                    <input class="ac-text" type="text" id="toText" placeholder="إسطنبول / Istanbul" autocomplete="off">
                    <div class="ac-code" id="toCode">---</div>
                </div>
                <div class="ac-dropdown" id="toDrop"></div>
            </div>
            <div class="field">
                <label class="ar">تاريخ الذهاب</label>
                <label class="en">Departure</label>
                <input type="date" name="date" required
                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                    value="{{ request('date', date('Y-m-d', strtotime('+7 days'))) }}">
            </div>
            <div class="field" id="returnDateField" style="display:none">
                <label class="ar">تاريخ العودة</label>
                <label class="en">Return</label>
                <input type="date" name="return_date" id="returnDate"
                    min="{{ date('Y-m-d', strtotime('+2 days')) }}">
            </div>
            <div class="field">
                <label class="ar">المسافرون</label>
                <label class="en">Passengers</label>
                <select name="adults">
                    @for ($i = 1; $i <= 9; $i++)
                        <option value="{{ $i }}" {{ request('adults', 1) == $i ? 'selected' : '' }}>
                            {{ $i }} {{ $i == 1 ? 'بالغ' : 'بالغين' }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <button type="submit" class="search-btn" id="flightSearchBtn">
            <span class="ar">🔍 ابحث الآن</span>
            <span class="en">🔍 Search Now</span>
        </button>
    </form>

    <!-- Hotel search form -->
    <form action="/hotels/results" method="GET" id="hotelForm">
        <div class="fields" style="grid-template-columns:1fr 1fr 1fr 1fr">
            <div class="field">
                <label class="ar">المدينة / الفندق</label>
                <label class="en">City / Hotel</label>
                <input type="text" name="city" placeholder="دبي / Dubai" required value="{{ request('city') }}">
            </div>
            <div class="field">
                <label class="ar">تاريخ الوصول</label>
                <label class="en">Check-in</label>
                <input type="date" name="check_in" required
                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                    value="{{ request('check_in', date('Y-m-d', strtotime('+7 days'))) }}">
            </div>
            <div class="field">
                <label class="ar">تاريخ المغادرة</label>
                <label class="en">Check-out</label>
                <input type="date" name="check_out" required
                    min="{{ date('Y-m-d', strtotime('+2 days')) }}"
                    value="{{ request('check_out', date('Y-m-d', strtotime('+10 days'))) }}">
            </div>
            <div class="field">
                <label class="ar">الضيوف</label>
                <label class="en">Guests</label>
                <select name="guests">
                    @for($i=1;$i<=8;$i++)
                        <option value="{{ $i }}" {{ request('guests',2)==$i?'selected':'' }}>
                            {{ $i }} {{ $i==1?'ضيف':'ضيوف' }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <button type="submit" class="search-btn" style="margin-top:1.4rem">
            <span class="ar">🏨 ابحث عن فندق</span>
            <span class="en">🏨 Find Hotels</span>
        </button>
    </form>
</div>
<div class="popular">
    <h3 class="ar">وجهات شائعة</h3>
    <h3 class="en">Popular destinations</h3>
    <div class="popular-grid">
        <div class="popular-chip" onclick="fillSearch('BGW','بغداد','IST','إسطنبول')">بغداد ← إسطنبول</div>
        <div class="popular-chip" onclick="fillSearch('BGW','بغداد','DXB','دبي')">بغداد ← دبي</div>
        <div class="popular-chip" onclick="fillSearch('BGW','بغداد','LHR','لندن')">بغداد ← لندن</div>
        <div class="popular-chip" onclick="fillSearch('AMM','عمّان','DXB','دبي')">عمّان ← دبي</div>
        <div class="popular-chip" onclick="fillSearch('RUH','الرياض','IST','إسطنبول')">الرياض ← إسطنبول</div>
        <div class="popular-chip" onclick="fillSearch('CAI','القاهرة','CDG','باريس')">القاهرة ← باريس</div>
        <div class="popular-chip" onclick="fillSearch('DXB','دبي','JFK','نيويورك')">دبي ← نيويورك</div>
        <div class="popular-chip" onclick="fillSearch('BGW','بغداد','FRA','فرانكفورت')">بغداد ← فرانكفورت</div>
    </div>
</div>
<!-- Loading overlay -->
<div class="search-overlay" id="searchOverlay">
    <div class="plane-loader">✈️</div>
    <div class="loader-text ar">جاري البحث عن أفضل الأسعار...</div>
    <div class="loader-text en">Searching for the best prices...</div>
    <div class="loader-bar"><div class="loader-fill"></div></div>
</div>

<script>
let currentLang = 'ar';
let debounceTimers = {};
let currentTab = 'flights';

function switchTab(tab) {
    currentTab = tab;
    document.getElementById('tabFlights').classList.toggle('active', tab === 'flights');
    document.getElementById('tabHotels').classList.toggle('active', tab === 'hotels');
    document.getElementById('searchForm').style.display = tab === 'flights' ? '' : 'none';
    document.getElementById('hotelForm').style.display = tab === 'hotels' ? '' : 'none';
}

// Show loading overlay on form submit
document.getElementById('searchForm').addEventListener('submit', function(e) {
    const o = document.getElementById('originCode').value;
    const d = document.getElementById('destinationCode').value;
    if (!o || !d) return;
    if (typeof gtag !== 'undefined') {
        gtag('event', 'flight_search', {
            'event_category': 'search',
            'origin': o,
            'destination': d
        });
    }
    document.getElementById('searchOverlay').classList.add('active');
});
document.getElementById('hotelForm').addEventListener('submit', function() {
    document.getElementById('searchOverlay').classList.add('active');
});

// Pre-fill tab if #hotels in URL
if (location.hash === '#hotels') switchTab('hotels');

function setLang(lang) {
    currentLang = lang;
    document.body.setAttribute('data-lang', lang);
    document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
    document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
    event.target.classList.add('active');
}

function setupAC(inputId, dropId, codeDisplayId, hiddenId) {
    const input  = document.getElementById(inputId);
    const drop   = document.getElementById(dropId);
    const codeD  = document.getElementById(codeDisplayId);
    const hidden = document.getElementById(hiddenId);
    let focusIdx = -1;
    let items = [];

    input.addEventListener('input', () => {
        const q = input.value.trim();
        hidden.value = '';
        codeD.textContent = '---';
        focusIdx = -1;
        if (q.length < 2) { drop.classList.remove('open'); return; }
        clearTimeout(debounceTimers[inputId]);
        debounceTimers[inputId] = setTimeout(() => fetchAirports(q), 280);
    });

    async function fetchAirports(q) {
        drop.innerHTML = '<div class="ac-loading">جاري البحث...</div>';
        drop.classList.add('open');
        try {
            const res = await fetch('/api/airports?q=' + encodeURIComponent(q) + '&lang=' + currentLang);
            items = await res.json();
            renderItems();
        } catch(e) {
            drop.innerHTML = '<div class="ac-loading">خطأ في الاتصال</div>';
        }
    }

    function renderItems() {
        if (!items.length) {
            drop.innerHTML = '<div class="ac-loading">لا توجد نتائج</div>';
            return;
        }
        drop.innerHTML = items.map((item, i) =>
            '<div class="ac-item" data-i="' + i + '">' +
            '<span>' + (item.type === 'city' ? '🏙' : '✈') + '</span>' +
            '<span class="ac-item-code">' + item.code + '</span>' +
            '<div><div class="ac-item-name">' + item.name + '</div>' +
            '<div class="ac-item-country">' + item.country + '</div></div>' +
            '</div>'
        ).join('');

        drop.querySelectorAll('.ac-item').forEach(el => {
            el.addEventListener('mousedown', e => {
                e.preventDefault();
                selectItem(parseInt(el.dataset.i));
            });
        });
    }

    function selectItem(i) {
        const item = items[i];
        if (!item) return;
        input.value = item.name;
        hidden.value = item.code;
        codeD.textContent = item.code;
        drop.classList.remove('open');
        focusIdx = -1;
    }

    input.addEventListener('keydown', e => {
        const els = drop.querySelectorAll('.ac-item');
        if (e.key === 'ArrowDown') { e.preventDefault(); focusIdx = Math.min(focusIdx + 1, els.length - 1); }
        else if (e.key === 'ArrowUp') { e.preventDefault(); focusIdx = Math.max(focusIdx - 1, 0); }
        else if (e.key === 'Enter' && focusIdx >= 0) { e.preventDefault(); selectItem(focusIdx); return; }
        else if (e.key === 'Escape') { drop.classList.remove('open'); }
        els.forEach((el, i) => el.classList.toggle('focused', i === focusIdx));
        if (focusIdx >= 0) els[focusIdx] && els[focusIdx].scrollIntoView({ block: 'nearest' });
    });

    document.addEventListener('click', e => {
        if (!input.closest('.ac-wrap').contains(e.target)) drop.classList.remove('open');
    });
}

setupAC('fromText', 'fromDrop', 'fromCode', 'originCode');
setupAC('toText',   'toDrop',   'toCode',   'destinationCode');

document.getElementById('searchForm').addEventListener('submit', e => {
    const o = document.getElementById('originCode').value;
    const d = document.getElementById('destinationCode').value;
    if (!o) { e.preventDefault(); document.getElementById('fromText').focus(); return; }
    if (!d) { e.preventDefault(); document.getElementById('toText').focus(); return; }
    if (document.getElementById('tripType').value === 'roundtrip' && !document.getElementById('returnDate').value) {
        e.preventDefault(); document.getElementById('returnDate').focus();
    }
});

function setTripType(type) {
    document.getElementById('tripType').value = type;
    document.querySelectorAll('.trip-btn').forEach(b => b.classList.toggle('active', b.dataset.trip === type));
    const returnField = document.getElementById('returnDateField');
    const fields = document.querySelector('.fields');
    if (type === 'roundtrip') {
        returnField.style.display = 'flex';
        fields.classList.add('roundtrip');
        const depDate = document.querySelector('input[name="date"]').value;
        if (depDate) document.getElementById('returnDate').min = depDate;
    } else {
        returnField.style.display = 'none';
        fields.classList.remove('roundtrip');
    }
}

document.querySelector('input[name="date"]').addEventListener('change', function() {
    if (document.getElementById('tripType').value === 'roundtrip') {
        const ret = document.getElementById('returnDate');
        ret.min = this.value;
        if (ret.value && ret.value < this.value) ret.value = this.value;
    }
});

function swapAirports() {
    const fT = document.getElementById('fromText');
    const tT = document.getElementById('toText');
    const fC = document.getElementById('fromCode');
    const tC = document.getElementById('toCode');
    const fH = document.getElementById('originCode');
    const tH = document.getElementById('destinationCode');
    var tmp = fT.value; fT.value = tT.value; tT.value = tmp;
    tmp = fC.textContent; fC.textContent = tC.textContent; tC.textContent = tmp;
    tmp = fH.value; fH.value = tH.value; tH.value = tmp;
}

function fillSearch(fc, fn, tc, tn) {
    document.getElementById('fromText').value = fn;
    document.getElementById('originCode').value = fc;
    document.getElementById('fromCode').textContent = fc;
    document.getElementById('toText').value = tn;
    document.getElementById('destinationCode').value = tc;
    document.getElementById('toCode').textContent = tc;
}
</script>
</body>
</html>