<?php
    $metaTitle = 'سياسة الخصوصية — ' . ($siteSettings['site_name_ar'] ?? 'SkyRoute');
    $metaDesc  = 'سياسة الخصوصية وحماية البيانات لموقع ' . ($siteSettings['site_name_ar'] ?? 'SkyRoute');
?>

<?php $__env->startSection('title', 'سياسة الخصوصية'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-hero" style="background: linear-gradient(135deg, #020817 0%, #1e1040 100%)">
    <h1 class="ar">سياسة الخصوصية</h1>
    <h1 class="en">Privacy Policy</h1>
    <p class="ar">آخر تحديث: <?php echo e(now()->format('d M Y')); ?></p>
    <p class="en">Last updated: <?php echo e(now()->format('d M Y')); ?></p>
</div>

<div class="page-content" style="max-width:760px">
    <div class="card" style="line-height:1.9;color:#333">
        <div class="ar">
            <h2 style="font-size:1.3rem;margin-bottom:1rem;color:#0d0d0d">1. جمع المعلومات</h2>
            <p>نجمع المعلومات التي تقدمها طوعياً عند استخدام خدماتنا، مثل عمليات البحث عن الرحلات، والتسجيل في النشرة البريدية، وإرسال رسائل التواصل.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">2. استخدام المعلومات</h2>
            <p>نستخدم معلوماتك لتحسين تجربتك على الموقع، وإرسال عروض السفر عبر البريد الإلكتروني إذا اشتركت في نشرتنا البريدية، والرد على استفساراتك.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">3. ملفات تعريف الارتباط (Cookies)</h2>
            <p>نستخدم ملفات تعريف الارتباط لتحليل حركة الزيارات وتحسين الموقع. يمكنك تعطيل هذه الملفات من إعدادات المتصفح.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">4. روابط الأفيلييت</h2>
            <p>يحتوي الموقع على روابط أفيلييت مع شركاء مثل Travelpayouts. عند الضغط على هذه الروابط والحجز، قد نحصل على عمولة دون أي تكلفة إضافية عليك.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">5. التواصل</h2>
            <p>لأي استفسارات تتعلق بالخصوصية، تواصل معنا عبر <a href="/contact" style="color:var(--sky)">صفحة التواصل</a>.</p>
        </div>

        <div class="en">
            <h2 style="font-size:1.3rem;margin-bottom:1rem;color:#0d0d0d">1. Information Collection</h2>
            <p>We collect information you voluntarily provide when using our services, such as flight searches, newsletter sign-ups, and contact form submissions.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">2. Use of Information</h2>
            <p>We use your information to improve your experience, send travel deals via email if you subscribed to our newsletter, and respond to your inquiries.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">3. Cookies</h2>
            <p>We use cookies to analyze traffic and improve the site. You can disable them in your browser settings.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">4. Affiliate Links</h2>
            <p>The site contains affiliate links with partners like Travelpayouts. When you click and book through these links, we may earn a commission at no extra cost to you.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">5. Contact</h2>
            <p>For privacy-related inquiries, contact us via our <a href="/contact" style="color:var(--sky)">contact page</a>.</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/legal/privacy.blade.php ENDPATH**/ ?>