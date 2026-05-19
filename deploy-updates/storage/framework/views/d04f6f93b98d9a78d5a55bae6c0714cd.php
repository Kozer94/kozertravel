<?php $__env->startSection('title', 'المشتركون في النشرة'); ?>

<?php $__env->startSection('content'); ?>
<div class="table-card">
    <div class="table-header">
        <h3>المشتركون (<?php echo e($subscribers->total()); ?>)</h3>
        <a href="<?php echo e(route('admin.subscribers.export')); ?>" class="btn btn-success">⬇ تصدير CSV</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>البريد الإلكتروني</th>
                <th>عنوان IP</th>
                <th>تاريخ الاشتراك</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $subscribers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($s->id); ?></td>
                <td><?php echo e($s->email); ?></td>
                <td style="direction:ltr;text-align:left"><?php echo e($s->ip); ?></td>
                <td><?php echo e($s->created_at->format('Y-m-d H:i')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="4" style="text-align:center;padding:2rem;color:#888">لا يوجد مشتركون بعد</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if($subscribers->hasPages()): ?>
    <div style="padding:1rem"><?php echo e($subscribers->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/admin/subscribers/index.blade.php ENDPATH**/ ?>