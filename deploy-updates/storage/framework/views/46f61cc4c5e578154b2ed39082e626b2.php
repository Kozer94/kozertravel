<?php
    $metaTitle    = $destination->meta_title;
    $metaDesc     = $destination->meta_description;
    $canonicalUrl = url('/flights/' . $destination->slug);
    $schemaType   = 'TouristDestination';
?>

<?php $__env->startSection('title', $destination->meta_title ?? $destination->labelAr()); ?>

<?php $__env->startPush('styles'); ?>
<style>
.dest-hero {
    background: linear-gradient(135deg, #020817 0%, #1e1040 60%, #0a1628 100%);
    padding: 5rem 2rem 4rem;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
}
.dest-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 60% 40% at 50% 60%, rgba(99,102,241,0.25) 0%, transparent 70%);
}
.dest-route {
    display: inline-flex; align-items: center; gap: 1rem;
    font-size: 2.6rem; font-family: 'DM Serif Display', serif;
    position: relative; z-index: 1; margin-bottom: 1rem;
}
.dest-route span.arrow { font-size: 2rem; opacity: 0.6; }
.dest-tags { display: flex; gap: 0.6rem; justify-content: center; flex-wrap: wrap; position: relative; z-index: 1; margin-bottom: 2rem; }
.dest-tag { background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 20px; padding: 0.35rem 1rem; font-size: 0.85rem; }
.dest-cta-btn {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: var(--sky); color: #fff; padding: 0.9rem 2.5rem;
    border-radius: 12px; text-decoration: none; font-size: 1.05rem; font-weight: 600;
    transition: all 0.2s; position: relative; z-index: 1;
}
.dest-cta-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(99,102,241,0.4); }
.dest-info { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin: 2.5rem 0; }
.info-card { background: #fff; border-radius: 14px; padding: 1.5rem; text-align: center; border: 1px solid #e8e4da; }
.info-icon { font-size: 2rem; margin-bottom: 0.5rem; }
.info-label { font-size: 0.8rem; color: #888; margin-bottom: 0.3rem; }
.info-value { font-size: 1.1rem; font-weight: 600; color: #0d0d0d; }
.desc-section { background: #fff; border-radius: 14px; padding: 2rem; border: 1px solid #e8e4da; margin-bottom: 1.5rem; line-height: 1.8; }
.search-box { background: linear-gradient(135deg, var(--sky) 0%, #6366f1 100%); border-radius: 16px; padding: 2.5rem; margin: 2rem 0; text-align: center; color: #fff; }
.search-box h2 { font-family: 'DM Serif Display', serif; font-size: 1.8rem; margin-bottom: 0.5rem; }
.search-box p { opacity: 0.85; margin-bottom: 1.5rem; }
@media(max-width:768px){ .dest-info{grid-template-columns:1fr}; .dest-route{font-size:1.8rem} }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="dest-hero">
    <div class="dest-route">
        <span class="ar"><?php echo e($destination->from_name_ar); ?></span>
        <span class="en"><?php echo e($destination->from_name_en); ?></span>
        <span class="arrow">✈</span>
        <span class="ar"><?php echo e($destination->to_name_ar); ?></span>
        <span class="en"><?php echo e($destination->to_name_en); ?></span>
    </div>
    <div class="dest-tags">
        <span class="dest-tag">✈ <?php echo e($destination->flight_duration); ?></span>
        <span class="dest-tag ar">🗓 <?php echo e($destination->best_time_ar); ?></span>
        <span class="dest-tag en">🗓 <?php echo e($destination->best_time_en); ?></span>
        <span class="dest-tag"><?php echo e($destination->from_code); ?> → <?php echo e($destination->to_code); ?></span>
    </div>
    <a href="/results?origin=<?php echo e($destination->from_code); ?>&destination=<?php echo e($destination->to_code); ?>&date=<?php echo e(now()->addWeek()->format('Y-m-d')); ?>&adults=1"
       class="dest-cta-btn">
        <span class="ar">ابحث عن أرخص الأسعار</span>
        <span class="en">Find the Cheapest Prices</span>
    </a>
</div>

<div class="page-content">
    <div class="dest-info">
        <div class="info-card">
            <div class="info-icon">⏱</div>
            <div class="info-label ar">مدة الرحلة</div>
            <div class="info-label en">Flight Duration</div>
            <div class="info-value"><?php echo e($destination->flight_duration); ?></div>
        </div>
        <div class="info-card">
            <div class="info-icon">📅</div>
            <div class="info-label ar">أفضل وقت للزيارة</div>
            <div class="info-label en">Best Time to Visit</div>
            <div class="info-value ar"><?php echo e($destination->best_time_ar); ?></div>
            <div class="info-value en"><?php echo e($destination->best_time_en); ?></div>
        </div>
        <div class="info-card">
            <div class="info-icon">🛫</div>
            <div class="info-label ar">رمز المطار</div>
            <div class="info-label en">Airport Codes</div>
            <div class="info-value"><?php echo e($destination->from_code); ?> → <?php echo e($destination->to_code); ?></div>
        </div>
    </div>

    <div class="desc-section">
        <p class="ar"><?php echo e($destination->description_ar); ?></p>
        <p class="en"><?php echo e($destination->description_en); ?></p>
    </div>

    <div class="search-box">
        <h2 class="ar">احجز رحلتك الآن</h2>
        <h2 class="en">Book Your Flight Now</h2>
        <p class="ar">قارن مئات شركات الطيران وابحث عن أفضل سعر لرحلتك</p>
        <p class="en">Compare hundreds of airlines and find the best price for your trip</p>
        <a href="/results?origin=<?php echo e($destination->from_code); ?>&destination=<?php echo e($destination->to_code); ?>&date=<?php echo e(now()->addWeek()->format('Y-m-d')); ?>&adults=1"
           style="display:inline-flex;align-items:center;gap:0.5rem;background:#fff;color:var(--sky);padding:0.9rem 2.5rem;border-radius:12px;font-weight:700;text-decoration:none;font-size:1.05rem;transition:all 0.2s"
           onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
            <span>✈</span>
            <span class="ar">ابحث الآن</span>
            <span class="en">Search Now</span>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/destinations/show.blade.php ENDPATH**/ ?>