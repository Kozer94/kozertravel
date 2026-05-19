<?php $__env->startSection('title'); ?>
    <span class="ar">نتائج الفنادق — <?php echo e($city); ?></span>
    <span class="en">Hotels in <?php echo e($city); ?></span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.hotel-hero {
    background: linear-gradient(135deg, #0a1628 0%, #1a3a5c 100%);
    padding: 4rem 2rem 3rem; text-align: center; color: #fff;
}
.hotel-hero h1 { font-family: 'DM Serif Display', serif; font-size: 2.4rem; margin-bottom: 0.5rem; }
.redirect-card {
    background: #fff; border-radius: 16px; padding: 3rem; text-align: center;
    border: 1px solid #e8e4da; max-width: 600px; margin: 3rem auto;
    box-shadow: 0 8px 32px rgba(0,0,0,0.08);
}
.redirect-card .big-icon { font-size: 3.5rem; margin-bottom: 1rem; }
.redirect-card h2 { font-size: 1.5rem; margin-bottom: 0.8rem; }
.redirect-card p { color: #666; margin-bottom: 1.5rem; line-height: 1.7; }
.countdown { font-size: 2rem; font-weight: 700; color: var(--sky); margin: 0.5rem 0 1.5rem; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="hotel-hero">
    <h1 class="ar">فنادق في <?php echo e($city); ?></h1>
    <h1 class="en">Hotels in <?php echo e($city); ?></h1>
    <p class="ar" style="opacity:0.8"><?php echo e($checkIn); ?> — <?php echo e($checkOut); ?> · <?php echo e($guests); ?> ضيف</p>
    <p class="en" style="opacity:0.8"><?php echo e($checkIn); ?> — <?php echo e($checkOut); ?> · <?php echo e($guests); ?> guests</p>
</div>

<div class="page-content">
    <?php if($affiliateUrl): ?>
    <div class="redirect-card">
        <div class="big-icon">🏨</div>
        <h2 class="ar">جاري البحث عن أفضل فنادق <?php echo e($city); ?></h2>
        <h2 class="en">Finding the Best Hotels in <?php echo e($city); ?></h2>
        <p class="ar">سيتم تحويلك إلى شريكنا Hotellook للعثور على أفضل الأسعار المتاحة.</p>
        <p class="en">You'll be redirected to our partner Hotellook to find the best available prices.</p>
        <div class="countdown" id="countdown">5</div>
        <a href="<?php echo e($affiliateUrl); ?>" target="_blank" class="btn btn-primary" style="margin-bottom:0.8rem;justify-content:center;width:100%">
            <span class="ar">اذهب إلى Hotellook الآن</span>
            <span class="en">Go to Hotellook Now</span>
        </a>
        <a href="/search#hotels" style="color:#888;font-size:0.88rem">
            <span class="ar">← بحث جديد</span>
            <span class="en">← New Search</span>
        </a>
    </div>
    <?php else: ?>
    <div class="redirect-card">
        <div class="big-icon">🔍</div>
        <h2 class="ar">ابحث عن فنادق</h2>
        <h2 class="en">Search for Hotels</h2>
        <p class="ar">أدخل وجهتك وتواريخ إقامتك للعثور على أفضل الفنادق.</p>
        <p class="en">Enter your destination and dates to find the best hotels.</p>
        <a href="/search#hotels" class="btn btn-primary" style="justify-content:center">
            <span class="ar">بحث جديد</span>
            <span class="en">New Search</span>
        </a>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php if($affiliateUrl): ?>
<script>
let s = 5;
const el = document.getElementById('countdown');
const t = setInterval(() => {
    s--;
    el.textContent = s;
    if (s <= 0) { clearInterval(t); window.location = '<?php echo e($affiliateUrl); ?>'; }
}, 1000);
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/hotels/results.blade.php ENDPATH**/ ?>