@extends('layouts.public')

@php
    $metaTitle = 'شروط الاستخدام — ' . ($siteSettings['site_name_ar'] ?? 'SkyRoute');
    $metaDesc  = 'شروط وأحكام استخدام موقع ' . ($siteSettings['site_name_ar'] ?? 'SkyRoute');
@endphp

@section('title', 'شروط الاستخدام')

@section('content')
<div class="page-hero" style="background: linear-gradient(135deg, #020817 0%, #1e1040 100%)">
    <h1 class="ar">شروط الاستخدام</h1>
    <h1 class="en">Terms of Use</h1>
    <p class="ar">آخر تحديث: {{ now()->format('d M Y') }}</p>
    <p class="en">Last updated: {{ now()->format('d M Y') }}</p>
</div>

<div class="page-content" style="max-width:760px">
    <div class="card" style="line-height:1.9;color:#333">
        <div class="ar">
            <h2 style="font-size:1.3rem;margin-bottom:1rem;color:#0d0d0d">1. قبول الشروط</h2>
            <p>باستخدامك لهذا الموقع، فإنك توافق على الالتزام بهذه الشروط والأحكام. إذا كنت لا توافق على هذه الشروط، يرجى عدم استخدام الموقع.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">2. طبيعة الخدمة</h2>
            <p>{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }} هو محرك بحث للسفر يوجهك إلى مواقع شركاء خارجيين للحجز. نحن لسنا وكالة سفر ولا نتحكم في الأسعار المعروضة من الشركاء.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">3. دقة المعلومات</h2>
            <p>نسعى لتقديم معلومات دقيقة ومحدّثة، لكننا لا نضمن دقة أسعار الرحلات أو توافر المقاعد، إذ تتغير هذه المعلومات بشكل مستمر لدى شركات الطيران.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">4. الاستخدام المقبول</h2>
            <p>يُحظر استخدام الموقع لأغراض غير مشروعة أو إرسال بريد مزعج أو محاولة اختراق الأنظمة أو إساءة استخدام الخدمة بأي طريقة.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">5. تحديد المسؤولية</h2>
            <p>لا يتحمل الموقع أي مسؤولية عن الأضرار الناجمة عن استخدام الروابط الخارجية أو الحجوزات المُتمة عبر مواقع الشركاء.</p>
        </div>

        <div class="en">
            <h2 style="font-size:1.3rem;margin-bottom:1rem;color:#0d0d0d">1. Acceptance of Terms</h2>
            <p>By using this website, you agree to be bound by these terms and conditions. If you do not agree, please do not use the site.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">2. Nature of Service</h2>
            <p>{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }} is a travel search engine that directs you to external partner websites for booking. We are not a travel agency and do not control partner prices.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">3. Accuracy of Information</h2>
            <p>We strive to provide accurate and up-to-date information, but we cannot guarantee flight price accuracy or seat availability, as these change continuously with airlines.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">4. Acceptable Use</h2>
            <p>Using the site for illegal purposes, sending spam, attempting to breach systems, or otherwise misusing the service is strictly prohibited.</p>

            <h2 style="font-size:1.3rem;margin:1.5rem 0 1rem;color:#0d0d0d">5. Limitation of Liability</h2>
            <p>The site is not liable for any damages arising from external links or bookings completed through partner websites.</p>
        </div>
    </div>
</div>
@endsection
