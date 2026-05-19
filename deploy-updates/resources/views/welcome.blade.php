<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }} — {{ $siteSettings['site_tagline_ar'] ?? 'رحلاتك بين يديك' }}</title>
    @if(!empty($siteSettings['site_favicon']))
        <link rel="icon" href="{{ Storage::disk('public')->url($siteSettings['site_favicon']) }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --sky:      {{ $siteSettings['primary_color'] ?? '#2563eb' }};
            --sky-dark: color-mix(in srgb, {{ $siteSettings['primary_color'] ?? '#2563eb' }} 80%, black);
            --sky-lt:   color-mix(in srgb, {{ $siteSettings['primary_color'] ?? '#2563eb' }} 12%, white);
            --navy:     #020817;
            --navy-2:   #0f172a;
            --gold:     #f59e0b;
            --gold-lt:  #fef3c7;
            --ink:      #0f172a;
            --ink-2:    #334155;
            --ink-3:    #64748b;
            --sand:     #f8fafc;
            --white:    #ffffff;
            --radius:   16px;
            --shadow:   0 4px 32px rgba(0,0,0,0.1);
            --shadow-lg: 0 20px 60px rgba(0,0,0,0.18);
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Tajawal', sans-serif; background: var(--sand); color: var(--ink); overflow-x: hidden; }

        /* ── NAV ── */
        nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 3rem;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            position: sticky; top: 0; z-index: 200;
            box-shadow: 0 1px 20px rgba(0,0,0,0.06);
        }
        .logo {
            font-family: 'DM Serif Display', serif;
            font-size: 1.7rem; color: var(--sky); letter-spacing: -0.5px;
            text-decoration: none; display: flex; align-items: center; gap: 8px;
        }
        .logo-dot { width: 8px; height: 8px; background: var(--gold); border-radius: 50%; display: inline-block; margin-bottom: 2px; }
        nav ul { list-style: none; display: flex; gap: 0.2rem; }
        nav ul li a {
            text-decoration: none; color: var(--ink-2); font-size: 0.9rem;
            font-weight: 500; padding: 0.4rem 0.9rem; border-radius: 8px; transition: all 0.2s;
        }
        nav ul li a:hover { background: var(--sky-lt); color: var(--sky); }
        .lang-switch { display: flex; gap: 4px; }
        .lang-btn {
            border: 1.5px solid #e2e8f0; background: none; border-radius: 8px;
            padding: 5px 12px; font-size: 0.82rem; cursor: pointer;
            color: var(--ink-2); font-family: 'Tajawal', sans-serif; font-weight: 500; transition: all 0.2s;
        }
        .lang-btn.active, .lang-btn:hover { background: var(--sky); color: var(--white); border-color: var(--sky); }

        /* ── HERO ── */
        .hero {
            min-height: 92vh;
            background: linear-gradient(135deg, #020817 0%, #0c1445 45%, #1e1040 100%);
            position: relative; overflow: hidden;
            display: grid; grid-template-columns: 1fr 1fr; align-items: center;
        }
        /* Star dots */
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background-image:
                radial-gradient(1.5px 1.5px at 8%  15%, rgba(255,255,255,0.5) 0%, transparent 0%),
                radial-gradient(1px   1px   at 20% 40%, rgba(255,255,255,0.3) 0%, transparent 0%),
                radial-gradient(1.5px 1.5px at 35% 8%,  rgba(255,255,255,0.4) 0%, transparent 0%),
                radial-gradient(1px   1px   at 50% 55%, rgba(255,255,255,0.25)0%, transparent 0%),
                radial-gradient(2px   2px   at 65% 22%, rgba(255,255,255,0.5) 0%, transparent 0%),
                radial-gradient(1px   1px   at 78% 70%, rgba(255,255,255,0.3) 0%, transparent 0%),
                radial-gradient(1.5px 1.5px at 90% 12%, rgba(255,255,255,0.4) 0%, transparent 0%),
                radial-gradient(1px   1px   at 15% 80%, rgba(255,255,255,0.3) 0%, transparent 0%),
                radial-gradient(2px   2px   at 42% 88%, rgba(255,255,255,0.2) 0%, transparent 0%),
                radial-gradient(1px   1px   at 72% 45%, rgba(255,255,255,0.35)0%, transparent 0%),
                radial-gradient(1.5px 1.5px at 55% 72%, rgba(255,255,255,0.4) 0%, transparent 0%),
                radial-gradient(1px   1px   at 28% 62%, rgba(255,255,255,0.25)0%, transparent 0%),
                radial-gradient(2px   2px   at 85% 88%, rgba(255,255,255,0.3) 0%, transparent 0%),
                radial-gradient(1px   1px   at 5%  50%, rgba(255,255,255,0.4) 0%, transparent 0%),
                radial-gradient(1.5px 1.5px at 95% 55%, rgba(255,255,255,0.3) 0%, transparent 0%);
        }
        /* Glow blobs */
        .hero::after {
            content: '';
            position: absolute; inset: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 40% 60% at 20% 60%, rgba(37,99,235,0.25) 0%, transparent 70%),
                radial-gradient(ellipse 30% 50% at 80% 30%, rgba(139,92,246,0.18) 0%, transparent 70%),
                radial-gradient(ellipse 25% 40% at 50% 90%, rgba(245,158,11,0.08) 0%, transparent 60%);
        }
        .hero-text {
            padding: 5rem 4rem 5rem 5rem;
            position: relative; z-index: 1;
            animation: fadeUp 0.9s cubic-bezier(0.16,1,0.3,1) both;
        }
        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(245,158,11,0.15); border: 1px solid rgba(245,158,11,0.3);
            color: var(--gold); font-size: 0.82rem; font-weight: 600;
            padding: 6px 16px; border-radius: 30px; margin-bottom: 1.8rem; letter-spacing: 0.5px;
        }
        .hero h1 {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2.8rem, 5vw, 4.8rem);
            line-height: 1.1; color: var(--white); margin-bottom: 1.4rem;
            letter-spacing: -1px;
        }
        .hero h1 em { font-style: italic; color: var(--gold); }
        .hero-sub {
            font-size: 1.1rem; color: rgba(255,255,255,0.65);
            line-height: 1.75; max-width: 460px; margin-bottom: 2.8rem; font-weight: 300;
        }
        .hero-cta { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn-hero {
            background: var(--sky); color: var(--white); border: none;
            border-radius: var(--radius); padding: 0.95rem 2.2rem;
            font-size: 1.05rem; font-family: 'Tajawal', sans-serif; font-weight: 600;
            cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.25s; box-shadow: 0 4px 20px rgba(37,99,235,0.4);
        }
        .btn-hero:hover { transform: translateY(-3px); box-shadow: 0 8px 30px rgba(37,99,235,0.5); }
        .btn-ghost {
            background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.9);
            border: 1.5px solid rgba(255,255,255,0.2); border-radius: var(--radius);
            padding: 0.95rem 2.2rem; font-size: 1.05rem; font-family: 'Tajawal', sans-serif;
            font-weight: 500; cursor: pointer; text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.25s; backdrop-filter: blur(8px);
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.18); border-color: rgba(255,255,255,0.4); transform: translateY(-2px); }

        /* Trust indicators */
        .hero-trust {
            display: flex; align-items: center; gap: 1.5rem; margin-top: 3rem;
            padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);
        }
        .trust-item { display: flex; align-items: center; gap: 0.5rem; color: rgba(255,255,255,0.55); font-size: 0.82rem; }
        .trust-dot { width: 6px; height: 6px; background: var(--gold); border-radius: 50%; }

        /* ── HERO CARDS ── */
        .hero-visual {
            position: relative; z-index: 1; padding: 3rem 3rem 3rem 1rem;
            display: flex; align-items: center; justify-content: center;
            animation: fadeIn 1.2s cubic-bezier(0.16,1,0.3,1) both 0.2s;
        }
        .card-stack { position: relative; width: 340px; height: 420px; }
        .flight-card {
            position: absolute; border-radius: 20px; padding: 1.5rem;
            width: 310px; backdrop-filter: blur(20px);
        }
        .flight-card:nth-child(1) {
            top: 0; left: 20px; transform: rotate(3deg);
            background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12);
        }
        .flight-card:nth-child(2) {
            top: 70px; left: 0; z-index: 2; transform: rotate(-1.5deg);
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
        }
        .flight-card:nth-child(3) {
            top: 145px; left: 12px; z-index: 3;
            background: rgba(255,255,255,0.95); border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }
        .fc-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.2rem; }
        .fc-airline { font-size: 0.72rem; font-weight: 600; letter-spacing: 1px; text-transform: uppercase; }
        .fc-type { font-size: 0.7rem; padding: 2px 8px; border-radius: 10px; font-weight: 500; }
        .fc-route { display: flex; align-items: center; gap: 8px; margin-bottom: 1rem; }
        .fc-airport { text-align: center; }
        .fc-code { font-weight: 700; font-size: 1.3rem; line-height: 1; }
        .fc-city { font-size: 0.72rem; margin-top: 2px; }
        .fc-line { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 3px; }
        .fc-duration { font-size: 0.68rem; }
        .fc-path { display: flex; align-items: center; width: 100%; gap: 4px; }
        .fc-dash { flex: 1; border-top: 1.5px dashed; }
        .fc-plane-ico { font-size: 13px; }
        .fc-stops { font-size: 0.65rem; }
        .fc-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 0.8rem; padding-top: 0.8rem; border-top: 1px solid; }
        .fc-price-label { font-size: 0.68rem; }
        .fc-price { font-family: 'DM Serif Display', serif; font-size: 1.7rem; line-height: 1; }
        .fc-badge { font-size: 0.68rem; padding: 3px 9px; border-radius: 10px; font-weight: 600; }

        /* Card 1 & 2 (dark/glass) */
        .flight-card:nth-child(1) .fc-airline,
        .flight-card:nth-child(2) .fc-airline { color: rgba(255,255,255,0.7); }
        .flight-card:nth-child(1) .fc-code,
        .flight-card:nth-child(2) .fc-code { color: var(--white); }
        .flight-card:nth-child(1) .fc-city,
        .flight-card:nth-child(2) .fc-city { color: rgba(255,255,255,0.5); }
        .flight-card:nth-child(1) .fc-duration,
        .flight-card:nth-child(2) .fc-duration { color: rgba(255,255,255,0.5); }
        .flight-card:nth-child(1) .fc-dash,
        .flight-card:nth-child(2) .fc-dash { border-color: rgba(255,255,255,0.2); }
        .flight-card:nth-child(1) .fc-plane-ico,
        .flight-card:nth-child(2) .fc-plane-ico { color: rgba(255,255,255,0.5); }
        .flight-card:nth-child(1) .fc-stops,
        .flight-card:nth-child(2) .fc-stops { color: rgba(255,255,255,0.4); }
        .flight-card:nth-child(1) .fc-footer,
        .flight-card:nth-child(2) .fc-footer { border-color: rgba(255,255,255,0.1); }
        .flight-card:nth-child(1) .fc-price-label,
        .flight-card:nth-child(2) .fc-price-label { color: rgba(255,255,255,0.5); }
        .flight-card:nth-child(1) .fc-price,
        .flight-card:nth-child(2) .fc-price { color: var(--gold); }
        .flight-card:nth-child(1) .fc-type,
        .flight-card:nth-child(2) .fc-type { background: rgba(37,99,235,0.3); color: #93c5fd; }
        /* Card 3 (white) */
        .flight-card:nth-child(3) .fc-airline { color: var(--ink-3); }
        .flight-card:nth-child(3) .fc-code { color: var(--ink); }
        .flight-card:nth-child(3) .fc-city { color: var(--ink-3); }
        .flight-card:nth-child(3) .fc-duration { color: var(--ink-3); }
        .flight-card:nth-child(3) .fc-dash { border-color: #cbd5e1; }
        .flight-card:nth-child(3) .fc-plane-ico { color: var(--sky); }
        .flight-card:nth-child(3) .fc-stops { color: #10b981; font-weight: 600; }
        .flight-card:nth-child(3) .fc-footer { border-color: #f1f5f9; }
        .flight-card:nth-child(3) .fc-price-label { color: var(--ink-3); font-size: 0.68rem; }
        .flight-card:nth-child(3) .fc-price { color: var(--sky); }
        .flight-card:nth-child(3) .fc-type { background: #dcfce7; color: #15803d; }
        .flight-card:nth-child(3) .fc-badge { background: #fef3c7; color: #b45309; }

        /* ── STATS ── */
        .stats {
            background: var(--navy-2);
            display: flex; justify-content: center; gap: 0;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .stat-item {
            flex: 1; text-align: center; padding: 2rem 1.5rem;
            border-left: 1px solid rgba(255,255,255,0.06);
            max-width: 200px;
        }
        .stat-item:last-child { border-left: none; }
        [dir="rtl"] .stat-item { border-left: none; border-right: 1px solid rgba(255,255,255,0.06); }
        [dir="rtl"] .stat-item:last-child { border-right: none; }
        .stat-num { font-family: 'DM Serif Display', serif; font-size: 2.4rem; color: var(--gold); line-height: 1; }
        .stat-lbl { font-size: 0.82rem; color: rgba(255,255,255,0.45); margin-top: 0.4rem; letter-spacing: 0.3px; }

        /* ── FEATURES ── */
        .features-section { padding: 6rem 4rem; max-width: 1200px; margin: 0 auto; }
        .section-eyebrow { font-size: 0.78rem; color: var(--sky); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 0.8rem; }
        .section-title { font-family: 'DM Serif Display', serif; font-size: 2.6rem; color: var(--ink); margin-bottom: 0.8rem; line-height: 1.2; }
        .section-sub { font-size: 1rem; color: var(--ink-3); max-width: 480px; line-height: 1.7; margin-bottom: 3.5rem; }
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        .feature-card {
            background: var(--white); border: 1px solid #e2e8f0; border-radius: 20px;
            padding: 2rem; transition: all 0.3s; position: relative; overflow: hidden;
        }
        .feature-card::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, var(--sky-lt), transparent);
            opacity: 0; transition: opacity 0.3s;
        }
        .feature-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); border-color: var(--sky); }
        .feature-card:hover::before { opacity: 1; }
        .feature-ico-wrap {
            width: 52px; height: 52px; border-radius: 14px; background: var(--sky-lt);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; margin-bottom: 1.2rem; transition: transform 0.3s;
            position: relative; z-index: 1;
        }
        .feature-card:hover .feature-ico-wrap { transform: scale(1.1) rotate(-5deg); }
        .feature-title { font-weight: 700; font-size: 1.05rem; margin-bottom: 0.5rem; position: relative; z-index: 1; }
        .feature-desc { font-size: 0.9rem; color: var(--ink-3); line-height: 1.65; position: relative; z-index: 1; }

        /* ── HOW IT WORKS ── */
        .how-section { padding: 5rem 4rem; background: var(--navy-2); }
        .how-inner { max-width: 1000px; margin: 0 auto; }
        .how-steps { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 3.5rem; position: relative; }
        .how-steps::before {
            content: ''; position: absolute; top: 28px; left: 16%; right: 16%;
            height: 2px; background: linear-gradient(90deg, var(--sky), var(--gold));
            opacity: 0.3;
        }
        [dir="rtl"] .how-steps::before { left: 16%; right: 16%; }
        .how-step { text-align: center; position: relative; }
        .step-num {
            width: 56px; height: 56px; border-radius: 50%; background: var(--sky);
            color: var(--white); font-family: 'DM Serif Display', serif; font-size: 1.4rem;
            display: flex; align-items: center; justify-content: center; margin: 0 auto 1.2rem;
            box-shadow: 0 4px 20px rgba(37,99,235,0.35);
        }
        .step-title { font-size: 1rem; font-weight: 600; color: var(--white); margin-bottom: 0.5rem; }
        .step-desc { font-size: 0.88rem; color: rgba(255,255,255,0.45); line-height: 1.6; }

        /* ── FOOTER ── */
        footer { background: #020817; color: rgba(255,255,255,0.5); padding: 4rem 4rem 2rem; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 3rem; margin-bottom: 3rem; max-width: 1200px; margin-left: auto; margin-right: auto; }
        .footer-brand .logo { color: var(--white); font-size: 1.8rem; margin-bottom: 1rem; display: inline-block; }
        .footer-brand p { font-size: 0.88rem; line-height: 1.7; max-width: 260px; color: rgba(255,255,255,0.4); }
        .footer-col h4 { font-size: 0.78rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: rgba(255,255,255,0.7); margin-bottom: 1.2rem; }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.7rem; }
        .footer-col ul li a { color: rgba(255,255,255,0.45); text-decoration: none; font-size: 0.88rem; transition: color 0.2s; }
        .footer-col ul li a:hover { color: var(--sky); }
        .footer-bottom { max-width: 1200px; margin: 0 auto; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.07); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem; font-size: 0.82rem; }
        .footer-bottom a { color: rgba(255,255,255,0.4); text-decoration: none; }
        .footer-bottom a:hover { color: var(--sky); }
        .badge-partner { display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 4px 12px; font-size: 0.78rem; color: rgba(255,255,255,0.4); }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) { .footer-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 768px) {
            .hero { grid-template-columns: 1fr; min-height: auto; }
            .hero-visual { display: none; }
            .hero-text { padding: 4rem 1.5rem 3rem; }
            nav { padding: 1rem 1.5rem; }
            nav ul { display: none; }
            .features-section { padding: 4rem 1.5rem; }
            .features-grid { grid-template-columns: 1fr; }
            .how-section { padding: 4rem 1.5rem; }
            .how-steps { grid-template-columns: 1fr; }
            .how-steps::before { display: none; }
            footer { padding: 3rem 1.5rem 1.5rem; }
            .footer-grid { grid-template-columns: 1fr; gap: 2rem; }
            .footer-bottom { flex-direction: column; text-align: center; }
        }
        [data-lang="en"] .ar { display: none; }
        [data-lang="ar"] .en { display: none; }
    </style>
</head>
<body data-lang="ar">

@include('partials.analytics')
@include('partials.announcement_banner')

{{-- NAV --}}
<nav>
    <a href="/" class="logo">
        @if(!empty($siteSettings['site_logo']))
            <img src="{{ Storage::disk('public')->url($siteSettings['site_logo']) }}"
                 alt="{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}"
                 style="height:36px;object-fit:contain;vertical-align:middle">
        @else
            {{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}<span class="logo-dot"></span>
        @endif
    </a>
    <ul>
        <li><a href="/" class="ar">الرئيسية</a><a href="/" class="en">Home</a></li>
        <li><a href="/search" class="ar">رحلات</a><a href="/search" class="en">Flights</a></li>
        <li><a href="/deals" class="ar">العروض</a><a href="/deals" class="en">Deals</a></li>
        <li><a href="/about" class="ar">من نحن</a><a href="/about" class="en">About</a></li>
        <li><a href="/contact" class="ar">تواصل معنا</a><a href="/contact" class="en">Contact</a></li>
    </ul>
    <div class="lang-switch">
        <button class="lang-btn" onclick="setLang('ar')">العربية</button>
        <button class="lang-btn" onclick="setLang('en')">English</button>
    </div>
</nav>

{{-- HERO --}}
<section class="hero">
    <div class="hero-text">
        <div class="hero-eyebrow ar">✦ أفضل أسعار الطيران مضمونة</div>
        <div class="hero-eyebrow en">✦ Best Flight Prices Guaranteed</div>

        <h1 class="ar">{!! nl2br(e($siteSettings['hero_title_ar'] ?? 'رحلتك القادمة')) !!}<br><em>تبدأ من هنا</em></h1>
        <h1 class="en">{!! nl2br(e($siteSettings['hero_title_en'] ?? 'Your next journey')) !!}<br><em>starts here</em></h1>

        <p class="hero-sub ar">{{ $siteSettings['hero_sub_ar'] ?? 'قارن أسعار مئات شركات الطيران في ثوانٍ، واحجز بأفضل سعر مضمون من أكبر منصات الحجز العالمية.' }}</p>
        <p class="hero-sub en">{{ $siteSettings['hero_sub_en'] ?? 'Compare hundreds of airlines in seconds and book at the best guaranteed price from the world\'s leading booking platforms.' }}</p>

        <div class="hero-cta">
            <a href="/search" class="btn-hero ar">ابحث عن رحلتك ←</a>
            <a href="/search" class="btn-hero en">Search Flights →</a>
            <a href="/deals" class="btn-ghost ar">🔥 عروض حصرية</a>
            <a href="/deals" class="btn-ghost en">🔥 Exclusive Deals</a>
        </div>

        <div class="hero-trust">
            <div class="trust-item"><span class="trust-dot"></span><span class="ar">500+ شركة طيران</span><span class="en">500+ Airlines</span></div>
            <div class="trust-item"><span class="trust-dot"></span><span class="ar">حجز آمن 100%</span><span class="en">100% Secure</span></div>
            <div class="trust-item"><span class="trust-dot"></span><span class="ar">دعم 24/7</span><span class="en">24/7 Support</span></div>
        </div>
    </div>

    <div class="hero-visual">
        <div class="card-stack">
            {{-- Card 1 --}}
            <div class="flight-card">
                <div class="fc-header">
                    <span class="fc-airline">Emirates</span>
                    <span class="fc-type">Business</span>
                </div>
                <div class="fc-route">
                    <div class="fc-airport"><div class="fc-code">DXB</div><div class="fc-city">Dubai</div></div>
                    <div class="fc-line">
                        <div class="fc-duration">7h 20m</div>
                        <div class="fc-path"><div class="fc-dash"></div><div class="fc-plane-ico">✈</div><div class="fc-dash"></div></div>
                        <div class="fc-stops">Direct</div>
                    </div>
                    <div class="fc-airport"><div class="fc-code">LHR</div><div class="fc-city">London</div></div>
                </div>
                <div class="fc-footer">
                    <div><div class="fc-price-label">يبدأ من</div><div class="fc-price">$342</div></div>
                </div>
            </div>
            {{-- Card 2 --}}
            <div class="flight-card">
                <div class="fc-header">
                    <span class="fc-airline">Turkish Airlines</span>
                    <span class="fc-type">Economy</span>
                </div>
                <div class="fc-route">
                    <div class="fc-airport"><div class="fc-code">BGW</div><div class="fc-city">Baghdad</div></div>
                    <div class="fc-line">
                        <div class="fc-duration">2h 45m</div>
                        <div class="fc-path"><div class="fc-dash"></div><div class="fc-plane-ico">✈</div><div class="fc-dash"></div></div>
                        <div class="fc-stops">Direct</div>
                    </div>
                    <div class="fc-airport"><div class="fc-code">IST</div><div class="fc-city">Istanbul</div></div>
                </div>
                <div class="fc-footer">
                    <div><div class="fc-price-label">يبدأ من</div><div class="fc-price">$189</div></div>
                </div>
            </div>
            {{-- Card 3 (featured) --}}
            <div class="flight-card">
                <div class="fc-header">
                    <span class="fc-airline" style="color:#334155">Saudia</span>
                    <span class="fc-type">أرخص سعر</span>
                </div>
                <div class="fc-route">
                    <div class="fc-airport"><div class="fc-code">RUH</div><div class="fc-city">Riyadh</div></div>
                    <div class="fc-line">
                        <div class="fc-duration">5h 55m</div>
                        <div class="fc-path"><div class="fc-dash"></div><div class="fc-plane-ico">✈</div><div class="fc-dash"></div></div>
                        <div class="fc-stops">مباشر</div>
                    </div>
                    <div class="fc-airport"><div class="fc-code">CDG</div><div class="fc-city">Paris</div></div>
                </div>
                <div class="fc-footer">
                    <div><div class="fc-price-label">يبدأ من</div><div class="fc-price">$510</div></div>
                    <span class="fc-badge">🔥 عرض اليوم</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STATS --}}
<div class="stats">
    <div class="stat-item"><div class="stat-num">500+</div><div class="stat-lbl ar">شركة طيران</div><div class="stat-lbl en">Airlines</div></div>
    <div class="stat-item"><div class="stat-num">2M+</div><div class="stat-lbl ar">رحلة متاحة يومياً</div><div class="stat-lbl en">Daily Flights</div></div>
    <div class="stat-item"><div class="stat-num">98%</div><div class="stat-lbl ar">رضا العملاء</div><div class="stat-lbl en">Satisfaction Rate</div></div>
    <div class="stat-item"><div class="stat-num">24/7</div><div class="stat-lbl ar">دعم فوري</div><div class="stat-lbl en">Live Support</div></div>
</div>

{{-- FEATURES --}}
<section class="features-section">
    <div class="section-eyebrow ar">لماذا {{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}</div>
    <div class="section-eyebrow en">Why {{ $siteSettings['site_name_en'] ?? 'SkyRoute' }}</div>
    <h2 class="section-title ar">كل ما تحتاجه في مكان واحد</h2>
    <h2 class="section-title en">Everything you need in one place</h2>
    <p class="section-sub ar">منصة متكاملة تجمع أسعار مئات شركات الطيران لتوفير أفضل تجربة حجز.</p>
    <p class="section-sub en">A complete platform aggregating hundreds of airlines to deliver the best booking experience.</p>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-ico-wrap">🔍</div>
            <div class="feature-title ar">بحث ذكي وفوري</div><div class="feature-title en">Smart Instant Search</div>
            <div class="feature-desc ar">قارن آلاف الرحلات من مئات المصادر في ثوانٍ بخوارزمية ذكية.</div>
            <div class="feature-desc en">Compare thousands of flights from hundreds of sources in seconds with smart algorithms.</div>
        </div>
        <div class="feature-card">
            <div class="feature-ico-wrap">💰</div>
            <div class="feature-title ar">أفضل سعر مضمون</div><div class="feature-title en">Best Price Guaranteed</div>
            <div class="feature-desc ar">نضمن لك دائماً أقل سعر متاح في السوق أو نعوضك الفرق.</div>
            <div class="feature-desc en">We always guarantee the lowest available market price or we'll cover the difference.</div>
        </div>
        <div class="feature-card">
            <div class="feature-ico-wrap">⚡</div>
            <div class="feature-title ar">حجز في ثوانٍ</div><div class="feature-title en">Book in Seconds</div>
            <div class="feature-desc ar">واجهة سلسة وسريعة تأخذك من البحث إلى الحجز في خطوات بسيطة.</div>
            <div class="feature-desc en">A smooth, fast interface takes you from search to booking in simple steps.</div>
        </div>
        <div class="feature-card">
            <div class="feature-ico-wrap">🌍</div>
            <div class="feature-title ar">تغطية عالمية</div><div class="feature-title en">Global Coverage</div>
            <div class="feature-desc ar">رحلات إلى أكثر من 190 دولة ومئات المطارات حول العالم.</div>
            <div class="feature-desc en">Flights to over 190 countries and hundreds of airports worldwide.</div>
        </div>
        <div class="feature-card">
            <div class="feature-ico-wrap">🔒</div>
            <div class="feature-title ar">دفع آمن 100%</div><div class="feature-title en">100% Secure Payment</div>
            <div class="feature-desc ar">بياناتك محمية بتشفير SSL وشراكات موثوقة مع أكبر بوابات الدفع.</div>
            <div class="feature-desc en">Your data is protected with SSL encryption and trusted payment gateway partnerships.</div>
        </div>
        <div class="feature-card">
            <div class="feature-ico-wrap">📱</div>
            <div class="feature-title ar">متاح دائماً</div><div class="feature-title en">Always Available</div>
            <div class="feature-desc ar">استخدم الموقع من أي جهاز في أي وقت، بتصميم متجاوب مثالي.</div>
            <div class="feature-desc en">Use the site from any device at any time with a perfectly responsive design.</div>
        </div>
    </div>
</section>

{{-- HOW IT WORKS --}}
<section class="how-section">
    <div class="how-inner">
        <div style="text-align:center">
            <div class="section-eyebrow ar" style="color:#93c5fd">كيف يعمل</div>
            <div class="section-eyebrow en" style="color:#93c5fd">How it works</div>
            <h2 class="section-title ar" style="color:var(--white)">ثلاث خطوات للحجز</h2>
            <h2 class="section-title en" style="color:var(--white)">Three steps to book</h2>
        </div>
        <div class="how-steps">
            <div class="how-step">
                <div class="step-num">١</div>
                <div class="step-title ar">ادخل وجهتك</div><div class="step-title en">Enter Destination</div>
                <div class="step-desc ar">حدد المطار والتاريخ وعدد المسافرين</div>
                <div class="step-desc en">Select airport, date and passengers</div>
            </div>
            <div class="how-step">
                <div class="step-num">٢</div>
                <div class="step-title ar">قارن الأسعار</div><div class="step-title en">Compare Prices</div>
                <div class="step-desc ar">نعرض لك أسعار جميع المصادر دفعة واحدة</div>
                <div class="step-desc en">We show you all source prices at once</div>
            </div>
            <div class="how-step">
                <div class="step-num">٣</div>
                <div class="step-title ar">احجز مباشرة</div><div class="step-title en">Book Directly</div>
                <div class="step-desc ar">اختر أفضل سعر واحجز مع الشركة مباشرة</div>
                <div class="step-desc en">Pick the best price and book directly</div>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <div class="footer-grid">
        <div class="footer-brand">
            <a href="/" class="logo">{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}<span class="logo-dot"></span></a>
            <p class="ar">{{ $siteSettings['site_tagline_ar'] ?? 'رحلاتك بين يديك' }} — منصة مقارنة أسعار الطيران الأولى عربياً.</p>
            <p class="en">{{ $siteSettings['site_tagline_en'] ?? 'Your flights at your fingertips' }} — The #1 Arabic flight price comparison platform.</p>
        </div>
        <div class="footer-col">
            <h4 class="ar">الموقع</h4><h4 class="en">Site</h4>
            <ul>
                <li><a href="/" class="ar">الرئيسية</a><a href="/" class="en">Home</a></li>
                <li><a href="/search" class="ar">ابحث عن رحلة</a><a href="/search" class="en">Search Flights</a></li>
                <li><a href="/deals" class="ar">العروض الحصرية</a><a href="/deals" class="en">Exclusive Deals</a></li>
                <li><a href="/about" class="ar">من نحن</a><a href="/about" class="en">About Us</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4 class="ar">الدعم</h4><h4 class="en">Support</h4>
            <ul>
                <li><a href="/contact" class="ar">تواصل معنا</a><a href="/contact" class="en">Contact Us</a></li>
                <li><a href="/privacy" class="ar">سياسة الخصوصية</a><a href="/privacy" class="en">Privacy Policy</a></li>
                <li><a href="/terms" class="ar">شروط الاستخدام</a><a href="/terms" class="en">Terms of Use</a></li>
                <li><a href="/blog" class="ar">المدونة</a><a href="/blog" class="en">Blog</a></li>
            </ul>
        </div>
        <div class="footer-col" style="grid-column: span 1">
            <h4 class="ar">النشرة البريدية</h4><h4 class="en">Newsletter</h4>
            <p class="ar" style="font-size:0.82rem;color:rgba(255,255,255,0.4);margin-bottom:0.8rem;line-height:1.6">احصل على أفضل عروض الطيران مباشرة في بريدك.</p>
            <p class="en" style="font-size:0.82rem;color:rgba(255,255,255,0.4);margin-bottom:0.8rem;line-height:1.6">Best flight deals straight to your inbox.</p>
            @if(session('newsletter_success'))
                <p style="color:#86efac;font-size:0.82rem;margin-bottom:0.5rem">✓ <span class="ar">تم الاشتراك!</span><span class="en">Subscribed!</span></p>
            @endif
            <form action="/newsletter/subscribe" method="POST" style="display:flex;flex-direction:column;gap:0.5rem">
                @csrf
                <input type="email" name="email" placeholder="بريدك الإلكتروني / Email"
                    style="padding:0.6rem 1rem;border-radius:8px;border:1px solid rgba(255,255,255,0.12);background:rgba(255,255,255,0.06);color:#fff;font-family:'Tajawal',sans-serif;font-size:0.88rem;outline:none"
                    required>
                <button type="submit"
                    style="padding:0.6rem 1rem;background:var(--sky);color:#fff;border:none;border-radius:8px;font-family:'Tajawal',sans-serif;font-size:0.88rem;cursor:pointer;font-weight:600">
                    <span class="ar">اشترك</span><span class="en">Subscribe</span>
                </button>
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <span>© {{ date('Y') }} {{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}. <span class="ar">جميع الحقوق محفوظة.</span><span class="en">All rights reserved.</span></span>
        <span class="badge-partner">✈ Travelpayouts Partner</span>
    </div>
</footer>

<script>
function setLang(lang) {
    document.body.setAttribute('data-lang', lang);
    document.documentElement.setAttribute('lang', lang === 'ar' ? 'ar' : 'en');
    document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
    document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
    event.target.classList.add('active');
}
document.querySelector('.lang-btn').classList.add('active');
</script>
</body>
</html>
