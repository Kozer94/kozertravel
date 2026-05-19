<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — الصفحة غير موجودة</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root { --sky: #1a5fff; --sand: #f5f0e8; --ink: #0d0d0d; --ink-3: #7a7a7a; --white: #fff; }
        body { font-family: 'Tajawal', sans-serif; background: var(--sand); color: var(--ink); min-height: 100vh; display: flex; flex-direction: column; }
        nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.2rem 3rem; background: var(--white);
            border-bottom: 1px solid #e8e4da;
        }
        .logo { font-family: 'DM Serif Display', serif; font-size: 1.6rem; color: var(--sky); text-decoration: none; }
        .main { flex: 1; display: flex; align-items: center; justify-content: center; padding: 4rem 2rem; text-align: center; }
        .code { font-family: 'DM Serif Display', serif; font-size: 8rem; color: var(--sky); line-height: 1; opacity: 0.15; position: absolute; }
        .content { position: relative; z-index: 1; max-width: 500px; }
        .plane { font-size: 4rem; margin-bottom: 1.5rem; animation: float 3s ease-in-out infinite; display: block; }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-12px)} }
        h1 { font-family: 'DM Serif Display', serif; font-size: 2.2rem; margin-bottom: 0.8rem; }
        p { color: var(--ink-3); font-size: 1rem; line-height: 1.7; margin-bottom: 2rem; }
        .btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
        .btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.75rem 1.8rem; border-radius: 12px; font-size: 0.95rem; font-family: 'Tajawal', sans-serif; font-weight: 500; text-decoration: none; transition: all 0.2s; }
        .btn-primary { background: var(--sky); color: #fff; }
        .btn-primary:hover { opacity: 0.88; transform: translateY(-2px); }
        .btn-outline { border: 1.5px solid #ccc; color: var(--ink); background: none; }
        .btn-outline:hover { border-color: var(--sky); color: var(--sky); }
        footer { text-align: center; padding: 2rem; background: #0d0d0d; color: #666; font-size: 0.85rem; }
        footer a { color: var(--sky); text-decoration: none; }
    </style>
</head>
<body>

<nav>
    <a href="/" class="logo">
        @php $siteName = \App\Models\SiteSetting::get('site_name_ar', 'SkyRoute'); @endphp
        {{ $siteName }}
    </a>
    <a href="/" style="font-size:0.9rem;color:#7a7a7a;text-decoration:none">← الرئيسية</a>
</nav>

<div class="main">
    <div class="code">404</div>
    <div class="content">
        <span class="plane">✈</span>
        <h1>الصفحة غير موجودة</h1>
        <p>يبدو أن هذه الصفحة أقلعت بدونك!<br>ربما تم نقل الرابط أو حذفه.</p>
        <div class="btns">
            <a href="/" class="btn btn-primary">🏠 الرئيسية</a>
            <a href="/search" class="btn btn-outline">✈ ابحث عن رحلة</a>
        </div>
    </div>
</div>

<footer>
    <p>© {{ date('Y') }} {{ $siteName }} · <a href="#">Travelpayouts Partner</a></p>
</footer>

</body>
</html>
