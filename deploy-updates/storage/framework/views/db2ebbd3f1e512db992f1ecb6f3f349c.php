<?php $__env->startSection('title', 'المدونة'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem">
    <h2 style="font-size:1.2rem">مقالات المدونة (<?php echo e($posts->total()); ?>)</h2>
    <a href="<?php echo e(route('admin.posts.create')); ?>" class="btn btn-primary">+ مقال جديد</a>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>العنوان</th>
                <th>الحالة</th>
                <th>تاريخ النشر</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($post->id); ?></td>
                <td>
                    <strong><?php echo e($post->title); ?></strong><br>
                    <small style="color:#888">/blog/<?php echo e($post->slug); ?></small>
                </td>
                <td>
                    <?php if($post->is_published): ?>
                        <span class="badge badge-green">منشور</span>
                    <?php else: ?>
                        <span class="badge badge-yellow">مسودة</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($post->published_at?->format('Y-m-d') ?? '—'); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.posts.edit', $post)); ?>" class="btn btn-sm btn-secondary">تعديل</a>
                    <form method="POST" action="<?php echo e(route('admin.posts.destroy', $post)); ?>" style="display:inline" onsubmit="return confirm('حذف هذا المقال؟')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-danger">حذف</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" style="text-align:center;padding:2rem;color:#888">لا توجد مقالات بعد</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($posts->hasPages()): ?>
    <div style="padding:1rem"><?php echo e($posts->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/admin/posts/index.blade.php ENDPATH**/ ?>