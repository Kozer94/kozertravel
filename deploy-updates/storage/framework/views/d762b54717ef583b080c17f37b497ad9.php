<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title', $siteSettings['site_name_ar'] ?? 'SkyRoute'); ?> — <?php echo e($siteSettings['site_name_ar'] ?? 'SkyRoute'); ?></title>
    <?php if(!empty($siteSettings['site_favicon'])): ?>
        <link rel="icon" href="<?php echo e(Storage::disk('public')->url($siteSettings['site_favicon'])); ?>">
    <?php endif; ?>
    <?php echo $__env->make('partials.analytics', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('partials.seo', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --ink: #0d0d0d; --ink-2: #3a3a3a; --ink-3: #7a7a7a;
            --sky: <?php echo e($siteSettings['primary_color'] ?? '#1a5fff'); ?>;
            --sky-lt: <?php echo e($siteSettings['primary_color'] ?? '#1a5fff'); ?>22;
            --sand: #f5f0e8; --white: #ffffff; --radius: 14px;
            --success: #16a34a;
        }
        body { font-family: 'Tajawal', sans-serif; background: var(--sand); color: var(--ink); min-height: 100vh; display: flex; flex-direction: column; }

        /* NAV */
        nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.2rem 3rem; background: var(--white);
            border-bottom: 1px solid #e8e4da; position: sticky; top: 0; z-index: 100;
        }
        .logo { font-family: 'DM Serif Display', serif; font-size: 1.6rem; color: var(--sky); text-decoration: none; letter-spacing: -0.5px; }
        nav ul { list-style: none; display: flex; gap: 2rem; }
        nav ul li a { text-decoration: none; color: var(--ink-2); font-size: 0.95rem; transition: color 0.2s; }
        nav ul li a:hover, nav ul li a.active { color: var(--sky); }
        .lang-switch { display: flex; gap: 6px; align-items: center; }
        .lang-btn {
            border: 1px solid #ddd; background: none; border-radius: 6px;
            padding: 4px 10px; font-size: 0.82rem; cursor: pointer;
            color: var(--ink-2); font-family: 'Tajawal', sans-serif; transition: all 0.2s;
        }
        .lang-btn.active, .lang-btn:hover { background: var(--sky); color: var(--white); border-color: var(--sky); }

        /* PAGE HERO */
        .page-hero {
            background: var(--sky); padding: 4rem 2rem;
            text-align: center; color: var(--white);
        }
        .page-hero h1 { font-family: 'DM Serif Display', serif; font-size: 2.6rem; margin-bottom: 0.6rem; }
        .page-hero p { font-size: 1.05rem; opacity: 0.85; max-width: 540px; margin: 0 auto; line-height: 1.7; }

        /* CONTENT */
        .page-content { max-width: 960px; margin: 3rem auto; padding: 0 1.5rem; flex: 1; width: 100%; }

        /* CARDS */
        .card { background: var(--white); border-radius: var(--radius); border: 1px solid #e8e4da; padding: 2rem; }
        .cards-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem; }

        /* FORM */
        .form-group { margin-bottom: 1.2rem; }
        label { display: block; font-size: 0.88rem; font-weight: 500; margin-bottom: 0.4rem; color: var(--ink-2); }
        input, textarea, select {
            width: 100%; padding: 0.7rem 1rem; border: 1.5px solid #e0dbd0;
            border-radius: 10px; font-size: 0.95rem; font-family: 'Tajawal', sans-serif;
            background: var(--white); color: var(--ink); transition: border-color 0.2s; outline: none;
        }
        input:focus, textarea:focus, select:focus { border-color: var(--sky); box-shadow: 0 0 0 3px <?php echo e($siteSettings['primary_color'] ?? '#1a5fff'); ?>18; }
        textarea { resize: vertical; min-height: 120px; }
        .btn {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 2rem; border-radius: 10px; font-size: 1rem;
            font-family: 'Tajawal', sans-serif; font-weight: 500;
            cursor: pointer; text-decoration: none; border: none; transition: all 0.2s;
        }
        .btn-primary { background: var(--sky); color: var(--white); }
        .btn-primary:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-outline { background: none; border: 1.5px solid var(--sky); color: var(--sky); }
        .btn-outline:hover { background: var(--sky); color: var(--white); }

        /* ALERT */
        .alert-success { background: #dcfce7; color: var(--success); border: 1px solid #86efac; padding: 0.9rem 1.2rem; border-radius: 10px; margin-bottom: 1.5rem; }
        .alert-error   { background: #fee2e2; color: #dc2626; border: 1px solid #fca5a5; padding: 0.9rem 1.2rem; border-radius: 10px; margin-bottom: 1.5rem; }

        /* FOOTER */
        footer { background: #0d0d1a; color: #888; margin-top: auto; }
        .footer-main { max-width: 1100px; margin: 0 auto; padding: 3.5rem 2rem 2rem; display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 3rem; }
        .footer-brand .f-logo { font-family: 'DM Serif Display', serif; font-size: 1.8rem; color: #fff; display: block; margin-bottom: 0.8rem; }
        .footer-brand p { font-size: 0.88rem; line-height: 1.7; color: #888; max-width: 240px; }
        .footer-col h4 { color: #ccc; font-size: 0.9rem; font-weight: 600; margin-bottom: 1rem; letter-spacing: 0.5px; }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 0.55rem; }
        .footer-col ul li a { color: #888; text-decoration: none; font-size: 0.88rem; transition: color 0.2s; }
        .footer-col ul li a:hover { color: var(--sky); }
        .footer-newsletter input { background: #1a1a2e; border-color: #333; color: #ccc; }
        .footer-newsletter input::placeholder { color: #555; }
        .footer-newsletter .btn-primary { width: 100%; justify-content: center; margin-top: 0.6rem; }
        .footer-bottom { border-top: 1px solid #1e1e2e; text-align: center; padding: 1.4rem 2rem; font-size: 0.82rem; color: #555; }
        .footer-bottom a { color: #666; text-decoration: none; }
        .footer-bottom a:hover { color: var(--sky); }

        /* LANG TOGGLE */
        [data-lang="en"] .ar { display: none; }
        [data-lang="ar"] .en { display: none; }

        /* LAZY IMAGES */
        img[loading="lazy"] { transition: opacity 0.4s; }

        @media (max-width: 900px) {
            .footer-main { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 768px) {
            nav { padding: 1rem 1.5rem; }
            nav ul { display: none; }
            .page-hero { padding: 3rem 1.5rem; }
            .page-hero h1 { font-size: 2rem; }
            .page-content { padding: 0 1rem; }
            .footer-main { grid-template-columns: 1fr; gap: 2rem; }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body data-lang="ar">

<?php echo $__env->make('partials.announcement_banner', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<nav>
    <a href="/" class="logo">
        <?php if(!empty($siteSettings['site_logo'])): ?>
            <img src="<?php echo e(Storage::disk('public')->url($siteSettings['site_logo'])); ?>"
                 alt="<?php echo e($siteSettings['site_name_ar'] ?? 'SkyRoute'); ?>"
                 style="height:36px;object-fit:contain;vertical-align:middle">
        <?php else: ?>
            <?php echo e($siteSettings['site_name_ar'] ?? 'SkyRoute'); ?>

        <?php endif; ?>
    </a>
    <ul>
        <li><a href="/" class="ar <?php echo e(request()->is('/') ? 'active' : ''); ?>">الرئيسية</a><a href="/" class="en <?php echo e(request()->is('/') ? 'active' : ''); ?>">Home</a></li>
        <li><a href="/search" class="ar <?php echo e(request()->is('search') ? 'active' : ''); ?>">الرحلات</a><a href="/search" class="en <?php echo e(request()->is('search') ? 'active' : ''); ?>">Flights</a></li>
        <li><a href="/deals" class="ar <?php echo e(request()->is('deals') ? 'active' : ''); ?>">العروض</a><a href="/deals" class="en <?php echo e(request()->is('deals') ? 'active' : ''); ?>">Deals</a></li>
        <li><a href="/blog" class="ar <?php echo e(request()->is('blog*') ? 'active' : ''); ?>">المدونة</a><a href="/blog" class="en <?php echo e(request()->is('blog*') ? 'active' : ''); ?>">Blog</a></li>
        <li><a href="/contact" class="ar <?php echo e(request()->is('contact') ? 'active' : ''); ?>">تواصل معنا</a><a href="/contact" class="en <?php echo e(request()->is('contact') ? 'active' : ''); ?>">Contact</a></li>
    </ul>
    <div class="lang-switch">
        <button class="lang-btn active" onclick="setLang('ar')">العربية</button>
        <button class="lang-btn" onclick="setLang('en')">English</button>
    </div>
</nav>

<?php echo $__env->yieldContent('content'); ?>

<footer>
    <div class="footer-main">
        <div class="footer-brand">
            <span class="f-logo"><?php echo e($siteSettings['site_name_ar'] ?? 'SkyRoute'); ?></span>
            <p class="ar">محرك بحث السفر الأول للمسافرين العرب. قارن أسعار الطيران واحجز بأفضل الأسعار.</p>
            <p class="en">The #1 travel search engine for Arab travelers. Compare flights and book at the best prices.</p>
        </div>
        <div class="footer-col">
            <h4 class="ar">روابط سريعة</h4>
            <h4 class="en">Quick Links</h4>
            <ul>
                <li><a href="/"><span class="ar">الرئيسية</span><span class="en">Home</span></a></li>
                <li><a href="/search"><span class="ar">بحث رحلات</span><span class="en">Search Flights</span></a></li>
                <li><a href="/deals"><span class="ar">العروض</span><span class="en">Deals</span></a></li>
                <li><a href="/blog"><span class="ar">المدونة</span><span class="en">Blog</span></a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4 class="ar">عن الموقع</h4>
            <h4 class="en">About</h4>
            <ul>
                <li><a href="/about"><span class="ar">من نحن</span><span class="en">About Us</span></a></li>
                <li><a href="/contact"><span class="ar">تواصل معنا</span><span class="en">Contact</span></a></li>
                <li><a href="/privacy"><span class="ar">سياسة الخصوصية</span><span class="en">Privacy Policy</span></a></li>
                <li><a href="/terms"><span class="ar">شروط الاستخدام</span><span class="en">Terms of Use</span></a></li>
            </ul>
        </div>
        <div class="footer-col footer-newsletter">
            <h4 class="ar">النشرة البريدية</h4>
            <h4 class="en">Newsletter</h4>
            <p class="ar" style="font-size:0.83rem;color:#666;margin-bottom:0.8rem;line-height:1.6">احصل على أفضل عروض السفر مباشرة في بريدك.</p>
            <p class="en" style="font-size:0.83rem;color:#666;margin-bottom:0.8rem;line-height:1.6">Get the best travel deals straight to your inbox.</p>
            <?php if(session('newsletter_success')): ?>
                <p style="color:#16a34a;font-size:0.85rem;margin-bottom:0.5rem">✓ <span class="ar">تم الاشتراك بنجاح!</span><span class="en">Subscribed!</span></p>
            <?php endif; ?>
            <form action="/newsletter/subscribe" method="POST">
                <?php echo csrf_field(); ?>
                <input type="email" name="email" placeholder="البريد الإلكتروني / Email" required style="margin-bottom:0.5rem">
                <button type="submit" class="btn btn-primary" style="padding:0.65rem 1.5rem;font-size:0.9rem">
                    <span class="ar">اشترك</span><span class="en">Subscribe</span>
                </button>
            </form>
        </div>
    </div>
    <div class="footer-bottom">
        <span>© <?php echo e(date('Y')); ?> <?php echo e($siteSettings['site_name_ar'] ?? 'SkyRoute'); ?> ·
            <a href="/privacy"><span class="ar">الخصوصية</span><span class="en">Privacy</span></a> ·
            <a href="/terms"><span class="ar">الشروط</span><span class="en">Terms</span></a>
        </span>
    </div>
</footer>

<script>
function setLang(lang) {
    document.body.setAttribute('data-lang', lang);
    document.querySelectorAll('.lang-btn').forEach(b => b.classList.remove('active'));
    event.target.classList.add('active');
    document.documentElement.setAttribute('lang', lang === 'ar' ? 'ar' : 'en');
    document.documentElement.setAttribute('dir', lang === 'ar' ? 'rtl' : 'ltr');
}
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/layouts/public.blade.php ENDPATH**/ ?>