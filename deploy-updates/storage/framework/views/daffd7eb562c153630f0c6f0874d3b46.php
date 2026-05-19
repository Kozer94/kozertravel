<?php $gaId = config('services.google.analytics_id'); ?>
<?php if($gaId): ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($gaId); ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo e($gaId); ?>', { 'anonymize_ip': true });
</script>
<?php endif; ?>
<?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/partials/analytics.blade.php ENDPATH**/ ?>