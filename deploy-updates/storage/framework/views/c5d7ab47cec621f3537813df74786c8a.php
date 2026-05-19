<?php $__env->startSection('title'); ?>
<span class="ar">من نحن</span><span class="en" style="display:none">About Us</span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center; margin-bottom: 3rem; }
    .stat-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 3rem; }
    .stat-box { background: var(--white); border: 1px solid #e8e4da; border-radius: var(--radius); padding: 1.5rem; text-align: center; }
    .stat-num { font-family: 'DM Serif Display', serif; font-size: 2.2rem; color: var(--sky); }
    .stat-lbl { font-size: 0.85rem; color: var(--ink-3); margin-top: 0.3rem; }
    .features-list { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
    .feature-item { display: flex; gap: 1rem; align-items: flex-start; }
    .feature-ico { font-size: 1.5rem; flex-shrink: 0; }
    .feature-text h4 { font-size: 0.95rem; font-weight: 600; margin-bottom: 0.3rem; }
    .feature-text p { font-size: 0.88rem; color: var(--ink-3); line-height: 1.6; }
    @media(max-width:768px) {
        .about-grid { grid-template-columns: 1fr; gap: 1.5rem; }
        .stat-row { grid-template-columns: repeat(2,1fr); }
        .features-list { grid-template-columns: 1fr; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="page-hero">
    <h1 class="ar">من نحن</h1>
    <h1 class="en">About Us</h1>
    <p class="ar"><?php echo e($siteSettings['site_name_ar'] ?? 'SkyRoute'); ?> — منصتك الموثوقة لمقارنة أسعار الطيران</p>
    <p class="en"><?php echo e($siteSettings['site_name_en'] ?? 'SkyRoute'); ?> — Your trusted platform for comparing flight prices</p>
</div>

<div class="page-content">

    
    <div class="about-grid">
        <div>
            <div style="font-size:0.82rem;color:var(--sky);font-weight:500;text-transform:uppercase;letter-spacing:1px;margin-bottom:0.5rem" class="ar">قصتنا</div>
            <div style="font-size:0.82rem;color:var(--sky);font-weight:500;text-transform:uppercase;letter-spacing:1px;margin-bottom:0.5rem" class="en">Our Story</div>
            <h2 style="font-family:'DM Serif Display',serif;font-size:2rem;margin-bottom:1rem;line-height:1.3" class="ar">نجعل السفر أسهل وأرخص</h2>
            <h2 style="font-family:'DM Serif Display',serif;font-size:2rem;margin-bottom:1rem;line-height:1.3" class="en">Making travel easier & cheaper</h2>
            <p style="color:var(--ink-3);line-height:1.8;margin-bottom:1rem" class="ar">
                <?php echo e($siteSettings['site_name_ar'] ?? 'SkyRoute'); ?> هي منصة متخصصة في مقارنة أسعار تذاكر الطيران من مئات شركات الطيران ووكالات السفر العالمية.
                هدفنا أن نوفر لك أفضل سعر ممكن في أقل وقت.
            </p>
            <p style="color:var(--ink-3);line-height:1.8;margin-bottom:1rem" class="en">
                <?php echo e($siteSettings['site_name_en'] ?? 'SkyRoute'); ?> is a specialized platform for comparing flight ticket prices from hundreds of airlines and global travel agencies.
                Our goal is to get you the best price in the least time.
            </p>
            <a href="/search" class="btn btn-primary ar">ابحث عن رحلتك ←</a>
            <a href="/search" class="btn btn-primary en">Search Flights →</a>
        </div>
        <div style="background:linear-gradient(135deg,var(--sky),#0f3fcf);border-radius:20px;padding:3rem;color:#fff;text-align:center">
            <div style="font-size:4rem;margin-bottom:1rem">✈</div>
            <div style="font-family:'DM Serif Display',serif;font-size:1.6rem;margin-bottom:0.5rem" class="ar">رحلتك تبدأ هنا</div>
            <div style="font-family:'DM Serif Display',serif;font-size:1.6rem;margin-bottom:0.5rem" class="en">Your journey starts here</div>
            <div style="opacity:0.8;font-size:0.95rem" class="ar"><?php echo e($siteSettings['site_tagline_ar'] ?? 'رحلاتك بين يديك'); ?></div>
            <div style="opacity:0.8;font-size:0.95rem" class="en"><?php echo e($siteSettings['site_tagline_en'] ?? 'Your flights at your fingertips'); ?></div>
        </div>
    </div>

    
    <div class="stat-row">
        <div class="stat-box"><div class="stat-num">500+</div><div class="stat-lbl ar">شركة طيران</div><div class="stat-lbl en">Airlines</div></div>
        <div class="stat-box"><div class="stat-num">2M+</div><div class="stat-lbl ar">رحلة متاحة</div><div class="stat-lbl en">Available Flights</div></div>
        <div class="stat-box"><div class="stat-num">98%</div><div class="stat-lbl ar">رضا العملاء</div><div class="stat-lbl en">Satisfaction</div></div>
        <div class="stat-box"><div class="stat-num">24/7</div><div class="stat-lbl ar">دعم فوري</div><div class="stat-lbl en">Live Support</div></div>
    </div>

    
    <div class="card" style="margin-bottom:2rem">
        <h3 style="font-family:'DM Serif Display',serif;font-size:1.5rem;margin-bottom:1.5rem" class="ar">لماذا <?php echo e($siteSettings['site_name_ar'] ?? 'SkyRoute'); ?>؟</h3>
        <h3 style="font-family:'DM Serif Display',serif;font-size:1.5rem;margin-bottom:1.5rem" class="en">Why <?php echo e($siteSettings['site_name_en'] ?? 'SkyRoute'); ?>?</h3>
        <div class="features-list">
            <div class="feature-item">
                <div class="feature-ico">🔍</div>
                <div class="feature-text">
                    <h4 class="ar">بحث ذكي وسريع</h4><h4 class="en">Smart & Fast Search</h4>
                    <p class="ar">نقارن آلاف الرحلات من مئات المصادر في ثوانٍ</p>
                    <p class="en">We compare thousands of flights from hundreds of sources in seconds</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-ico">💰</div>
                <div class="feature-text">
                    <h4 class="ar">أفضل سعر مضمون</h4><h4 class="en">Best Price Guaranteed</h4>
                    <p class="ar">نضمن لك دائماً أقل سعر متاح في السوق</p>
                    <p class="en">We always guarantee you the lowest available market price</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-ico">🌍</div>
                <div class="feature-text">
                    <h4 class="ar">تغطية عالمية</h4><h4 class="en">Global Coverage</h4>
                    <p class="ar">رحلات إلى أكثر من 190 دولة حول العالم</p>
                    <p class="en">Flights to more than 190 countries around the world</p>
                </div>
            </div>
            <div class="feature-item">
                <div class="feature-ico">🔒</div>
                <div class="feature-text">
                    <h4 class="ar">آمن وموثوق</h4><h4 class="en">Safe & Trusted</h4>
                    <p class="ar">شريك معتمد مع كبرى منصات الحجز العالمية</p>
                    <p class="en">Certified partner with leading global booking platforms</p>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/about.blade.php ENDPATH**/ ?>