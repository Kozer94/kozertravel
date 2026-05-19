<?php
    $metaTitle = 'المدونة — ' . ($siteSettings['site_name_ar'] ?? 'SkyRoute');
    $metaDesc  = 'مقالات ونصائح السفر للمسافرين العرب';
?>

<?php $__env->startSection('title', 'المدونة'); ?>

<?php $__env->startPush('styles'); ?>
<style>
.blog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.8rem; margin-top: 2rem; }
.blog-card { background: #fff; border-radius: 14px; overflow: hidden; border: 1px solid #e8e4da; text-decoration: none; color: inherit; transition: all 0.2s; display: flex; flex-direction: column; }
.blog-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.1); }
.blog-card-img { width: 100%; height: 180px; object-fit: cover; background: linear-gradient(135deg, var(--sky) 0%, #6366f1 100%); display: flex; align-items: center; justify-content: center; font-size: 3rem; }
.blog-card-body { padding: 1.4rem; flex: 1; display: flex; flex-direction: column; }
.blog-card-meta { font-size: 0.78rem; color: #888; margin-bottom: 0.6rem; }
.blog-card-title { font-size: 1.05rem; font-weight: 600; line-height: 1.5; margin-bottom: 0.7rem; }
.blog-card-excerpt { font-size: 0.88rem; color: #666; line-height: 1.6; flex: 1; }
.blog-card-link { color: var(--sky); font-size: 0.85rem; font-weight: 500; margin-top: 1rem; text-decoration: none; }
.empty-state { text-align: center; padding: 5rem 2rem; }
.empty-state .icon { font-size: 4rem; margin-bottom: 1rem; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hero" style="background: linear-gradient(135deg, #020817 0%, #1e1040 100%)">
    <h1 class="ar">المدونة</h1>
    <h1 class="en">Blog</h1>
    <p class="ar">نصائح وإرشادات السفر للمسافرين العرب</p>
    <p class="en">Travel tips and guides for Arab travelers</p>
</div>

<div class="page-content">
    <?php if($posts->count()): ?>
    <div class="blog-grid">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="/blog/<?php echo e($post->slug); ?>" class="blog-card">
            <?php if($post->og_image): ?>
                <img src="<?php echo e($post->og_image); ?>" alt="<?php echo e($post->title); ?>" class="blog-card-img" loading="lazy">
            <?php else: ?>
                <div class="blog-card-img">✍️</div>
            <?php endif; ?>
            <div class="blog-card-body">
                <div class="blog-card-meta"><?php echo e($post->published_at?->format('d M Y')); ?></div>
                <div class="blog-card-title"><?php echo e($post->title); ?></div>
                <div class="blog-card-excerpt"><?php echo e($post->excerptOrTruncated()); ?></div>
                <span class="blog-card-link ar">اقرأ أكثر ←</span>
                <span class="blog-card-link en">Read more →</span>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div style="margin-top:2rem"><?php echo e($posts->links()); ?></div>
    <?php else: ?>
    <div class="empty-state">
        <div class="icon">📝</div>
        <h2 class="ar">لا توجد مقالات حتى الآن</h2>
        <h2 class="en">No posts yet</h2>
        <p class="ar" style="color:#888;margin-top:0.5rem">سيتم نشر المقالات قريباً</p>
        <p class="en" style="color:#888;margin-top:0.5rem">Articles will be published soon</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/blog/index.blade.php ENDPATH**/ ?>