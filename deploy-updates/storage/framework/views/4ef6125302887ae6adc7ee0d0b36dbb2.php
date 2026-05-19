<?php
    use App\Models\Announcement;
    try {
        $banners = Announcement::where('is_active', true)
            ->where('type', 'banner')
            ->where(fn($q) => $q->whereNull('starts_at')->orWhere('starts_at', '<=', now()))
            ->where(fn($q) => $q->whereNull('ends_at')->orWhere('ends_at', '>=', now()))
            ->get();
    } catch (\Throwable) {
        $banners = collect();
    }
?>
<?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="ann-banner ann-<?php echo e($banner->type ?? 'info'); ?>" id="ann-<?php echo e($banner->id); ?>" style="display:flex;align-items:center;justify-content:center;gap:1rem;padding:0.65rem 1.5rem;font-size:0.9rem;position:relative;">
    <span><?php echo e($banner->message_ar ?? $banner->message ?? ''); ?></span>
    <button onclick="document.getElementById('ann-<?php echo e($banner->id); ?>').remove()" style="background:none;border:none;cursor:pointer;opacity:0.7;font-size:1.1rem;padding:0 0.3rem;line-height:1;" title="إغلاق">×</button>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if($banners->isNotEmpty()): ?>
<style>
.ann-banner{background:var(--sky);color:#fff}
.ann-banner.ann-warning{background:#d97706;color:#fff}
.ann-banner.ann-danger{background:#dc2626;color:#fff}
.ann-banner.ann-success{background:#16a34a;color:#fff}
</style>
<?php endif; ?>
<?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/partials/announcement_banner.blade.php ENDPATH**/ ?>