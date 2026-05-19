<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'لوحة التحكم') — {{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }} Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --sky: #1a5fff; --sky-dark: #1448cc; --sky-lt: #e8efff;
            --sand: #f5f0e8; --sand-dark: #ede8df;
            --ink: #0d0d0d; --ink-2: #3a3a3a; --ink-3: #7a7a7a;
            --white: #ffffff; --radius: 10px;
            --sidebar-w: 240px;
            --success: #16a34a; --danger: #dc2626; --warning: #d97706;
        }
        body { font-family: 'Tajawal', sans-serif; background: #f0ece4; color: var(--ink); min-height: 100vh; display: flex; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-w); background: var(--sky); color: var(--white);
            min-height: 100vh; display: flex; flex-direction: column;
            position: fixed; right: 0; top: 0; z-index: 100;
        }
        .sidebar-logo {
            padding: 1.4rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.15);
            font-size: 1.3rem; font-weight: 700; letter-spacing: -0.5px;
        }
        .sidebar-logo span { opacity: 0.7; font-weight: 400; }
        .sidebar-nav { flex: 1; padding: 1rem 0; }
        .nav-section { padding: 0.5rem 1.5rem 0.3rem; font-size: 0.7rem; opacity: 0.5; text-transform: uppercase; letter-spacing: 1px; }
        .nav-link {
            display: flex; align-items: center; gap: 0.7rem;
            padding: 0.6rem 1.5rem; color: rgba(255,255,255,0.8);
            text-decoration: none; font-size: 0.9rem; transition: all 0.15s;
        }
        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.15); color: var(--white);
        }
        .nav-link.active { border-right: 3px solid var(--white); }
        .nav-icon { font-size: 1rem; width: 20px; text-align: center; }
        .sidebar-footer {
            padding: 1rem 1.5rem; border-top: 1px solid rgba(255,255,255,0.15);
            font-size: 0.82rem; opacity: 0.7;
        }
        .sidebar-footer a { color: rgba(255,255,255,0.8); text-decoration: none; }
        .sidebar-footer a:hover { color: var(--white); }

        /* Main content */
        .main { margin-right: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        /* Top bar */
        .topbar {
            background: var(--white); border-bottom: 1px solid #e0dbd0;
            padding: 0.9rem 2rem; display: flex; align-items: center;
            justify-content: space-between; position: sticky; top: 0; z-index: 50;
        }
        .topbar-title { font-size: 1.1rem; font-weight: 600; }
        .topbar-admin { font-size: 0.85rem; color: var(--ink-3); }

        /* Content */
        .content { padding: 2rem; flex: 1; }

        /* Cards / Stats */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem; }
        .stat-card {
            background: var(--white); border-radius: var(--radius);
            padding: 1.4rem; border: 1px solid #e0dbd0;
        }
        .stat-label { font-size: 0.8rem; color: var(--ink-3); margin-bottom: 0.4rem; }
        .stat-value { font-size: 2rem; font-weight: 700; color: var(--sky); }
        .stat-sub { font-size: 0.78rem; color: var(--ink-3); margin-top: 0.2rem; }

        /* Tables */
        .table-card { background: var(--white); border-radius: var(--radius); border: 1px solid #e0dbd0; overflow: hidden; }
        .table-header { padding: 1rem 1.5rem; border-bottom: 1px solid #e0dbd0; display: flex; align-items: center; justify-content: space-between; }
        .table-header h3 { font-size: 1rem; font-weight: 600; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f6f2; padding: 0.7rem 1rem; text-align: right; font-size: 0.82rem; color: var(--ink-3); font-weight: 500; border-bottom: 1px solid #e0dbd0; }
        td { padding: 0.75rem 1rem; border-bottom: 1px solid #f0ece4; font-size: 0.88rem; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #faf8f5; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 1rem; border-radius: 7px; font-size: 0.88rem; font-family: 'Tajawal', sans-serif; font-weight: 500; cursor: pointer; text-decoration: none; border: none; transition: all 0.15s; }
        .btn-primary { background: var(--sky); color: var(--white); }
        .btn-primary:hover { background: var(--sky-dark); }
        .btn-danger { background: #fee2e2; color: var(--danger); }
        .btn-danger:hover { background: #fecaca; }
        .btn-sm { padding: 0.3rem 0.7rem; font-size: 0.8rem; }
        .btn-secondary { background: var(--sand-dark); color: var(--ink-2); }
        .btn-secondary:hover { background: #ddd7cd; }
        .btn-success { background: #dcfce7; color: var(--success); }
        .btn-success:hover { background: #bbf7d0; }

        /* Badges */
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 0.75rem; font-weight: 500; }
        .badge-green { background: #dcfce7; color: var(--success); }
        .badge-red { background: #fee2e2; color: var(--danger); }
        .badge-blue { background: var(--sky-lt); color: var(--sky); }
        .badge-yellow { background: #fef3c7; color: var(--warning); }

        /* Forms */
        .form-card { background: var(--white); border-radius: var(--radius); border: 1px solid #e0dbd0; padding: 2rem; }
        .form-group { margin-bottom: 1.2rem; }
        .form-label { display: block; font-size: 0.88rem; font-weight: 500; margin-bottom: 0.4rem; color: var(--ink-2); }
        .form-control {
            width: 100%; padding: 0.6rem 0.9rem; border: 1px solid #d0ccc4;
            border-radius: 7px; font-size: 0.9rem; font-family: 'Tajawal', sans-serif;
            background: var(--white); color: var(--ink); transition: border-color 0.15s;
        }
        .form-control:focus { outline: none; border-color: var(--sky); box-shadow: 0 0 0 3px rgba(26,95,255,0.1); }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-check { display: flex; align-items: center; gap: 0.5rem; }
        .form-check input { width: 16px; height: 16px; cursor: pointer; accent-color: var(--sky); }

        /* Alerts */
        .alert { padding: 0.8rem 1rem; border-radius: 7px; margin-bottom: 1rem; font-size: 0.9rem; }
        .alert-success { background: #dcfce7; color: var(--success); border: 1px solid #86efac; }
        .alert-error { background: #fee2e2; color: var(--danger); border: 1px solid #fca5a5; }

        /* Filters */
        .filter-bar { background: var(--white); border: 1px solid #e0dbd0; border-radius: var(--radius); padding: 1rem 1.5rem; margin-bottom: 1.5rem; display: flex; gap: 0.8rem; flex-wrap: wrap; align-items: flex-end; }
        .filter-group { display: flex; flex-direction: column; gap: 0.3rem; }
        .filter-label { font-size: 0.78rem; color: var(--ink-3); font-weight: 500; }
        .filter-input { padding: 0.45rem 0.7rem; border: 1px solid #d0ccc4; border-radius: 6px; font-size: 0.85rem; font-family: 'Tajawal', sans-serif; }

        /* Pagination */
        .pagination { display: flex; gap: 0.3rem; justify-content: center; padding: 1rem 0; }
        .pagination a, .pagination span { padding: 0.4rem 0.8rem; border-radius: 6px; font-size: 0.85rem; text-decoration: none; border: 1px solid #e0dbd0; color: var(--ink-2); }
        .pagination span.active-page { background: var(--sky); color: var(--white); border-color: var(--sky); }
        .pagination a:hover { background: var(--sky-lt); border-color: var(--sky); }

        /* Chart */
        .chart-container { background: var(--white); border-radius: var(--radius); border: 1px solid #e0dbd0; padding: 1.5rem; margin-bottom: 2rem; }
        .chart-title { font-size: 0.95rem; font-weight: 600; margin-bottom: 1rem; }
        .bar-chart { display: flex; align-items: flex-end; gap: 6px; height: 120px; }
        .bar-col { display: flex; flex-direction: column; align-items: center; flex: 1; gap: 4px; }
        .bar-wrap { display: flex; align-items: flex-end; gap: 2px; height: 90px; width: 100%; }
        .bar { width: 50%; border-radius: 4px 4px 0 0; min-height: 2px; transition: opacity 0.15s; }
        .bar:hover { opacity: 0.8; }
        .bar-s { background: var(--sky); }
        .bar-c { background: #f59e0b; }
        .bar-label { font-size: 0.65rem; color: var(--ink-3); }
        .chart-legend { display: flex; gap: 1rem; margin-top: 0.8rem; }
        .legend-item { display: flex; align-items: center; gap: 0.4rem; font-size: 0.78rem; color: var(--ink-3); }
        .legend-dot { width: 10px; height: 10px; border-radius: 50%; }

        /* Color swatch */
        .color-swatch { width: 20px; height: 20px; border-radius: 4px; display: inline-block; border: 1px solid rgba(0,0,0,0.1); }

        /* Toggle */
        .toggle { position: relative; display: inline-block; width: 44px; height: 24px; }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider {
            position: absolute; cursor: pointer; inset: 0;
            background: #cbd5e1; border-radius: 24px; transition: 0.3s;
        }
        .toggle-slider:before {
            content: ''; position: absolute; width: 18px; height: 18px;
            right: 3px; top: 3px; background: white; border-radius: 50%; transition: 0.3s;
        }
        .toggle input:checked + .toggle-slider { background: var(--sky); }
        .toggle input:checked + .toggle-slider:before { transform: translateX(-20px); }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-right: 0; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        @if(!empty($siteSettings['site_logo']))
            <img src="{{ Storage::disk('public')->url($siteSettings['site_logo']) }}"
                 alt="{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}"
                 style="height:28px;object-fit:contain;vertical-align:middle;filter:brightness(10)">
        @else
            {{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}
        @endif
        <small style="font-size:0.65rem;opacity:0.6;">Admin</small>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">الرئيسية</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="nav-icon">📊</span> لوحة التحكم
        </a>

        <div class="nav-section" style="margin-top:0.5rem">الإحصائيات</div>
        <a href="{{ route('admin.searches.index') }}" class="nav-link {{ request()->routeIs('admin.searches.*') ? 'active' : '' }}">
            <span class="nav-icon">🔍</span> البحثات
        </a>
        <a href="{{ route('admin.clicks.index') }}" class="nav-link {{ request()->routeIs('admin.clicks.*') ? 'active' : '' }}">
            <span class="nav-icon">👆</span> النقرات
        </a>

        <div class="nav-section" style="margin-top:0.5rem">الإعدادات</div>
        <a href="{{ route('admin.routes.index') }}" class="nav-link {{ request()->routeIs('admin.routes.*') ? 'active' : '' }}">
            <span class="nav-icon">✈️</span> الوجهات الشائعة
        </a>
        <a href="{{ route('admin.sources.index') }}" class="nav-link {{ request()->routeIs('admin.sources.*') ? 'active' : '' }}">
            <span class="nav-icon">🔗</span> مصادر الأفلييت
        </a>
        <a href="{{ route('admin.announcements.index') }}" class="nav-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
            <span class="nav-icon">📢</span> الإعلانات
        </a>

        <div class="nav-section" style="margin-top:0.5rem">المحتوى</div>
        <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
            <span class="nav-icon">📝</span> المدونة
        </a>
        <a href="{{ route('admin.subscribers.index') }}" class="nav-link {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
            <span class="nav-icon">📧</span> المشتركون
        </a>
        <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
            <span class="nav-icon">💬</span> الرسائل
        </a>

        <div class="nav-section" style="margin-top:0.5rem">الموقع</div>
        <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <span class="nav-icon">⚙️</span> إعدادات الموقع
        </a>
    </nav>
    <div class="sidebar-footer">
        {{ session('admin_name', 'المدير') }}
        &nbsp;·&nbsp;
        <a href="{{ route('admin.logout') }}">تسجيل خروج</a>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <div class="topbar-title">@yield('title', 'لوحة التحكم')</div>
        <div class="topbar-admin">👤 {{ session('admin_name', 'المدير') }}</div>
    </div>
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
            </div>
        @endif
        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
