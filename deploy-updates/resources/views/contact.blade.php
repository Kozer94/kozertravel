@extends('layouts.public')

@section('title')
<span class="ar">تواصل معنا</span><span class="en" style="display:none">Contact Us</span>
@endsection

@push('styles')
<style>
    .contact-grid { display: grid; grid-template-columns: 1fr 1.6fr; gap: 2rem; }
    .info-card { background: var(--white); border-radius: var(--radius); border: 1px solid #e8e4da; padding: 2rem; }
    .info-item { display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1.5rem; }
    .info-ico { width: 42px; height: 42px; background: var(--sky-lt); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .info-text h4 { font-size: 0.88rem; font-weight: 600; margin-bottom: 0.25rem; }
    .info-text p, .info-text a { font-size: 0.9rem; color: var(--ink-3); text-decoration: none; }
    .info-text a:hover { color: var(--sky); }
    @media(max-width:768px) { .contact-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')

<div class="page-hero">
    <h1 class="ar">تواصل معنا</h1>
    <h1 class="en">Contact Us</h1>
    <p class="ar">نحن هنا لمساعدتك — لا تتردد في التواصل معنا</p>
    <p class="en">We're here to help — don't hesitate to reach out</p>
</div>

<div class="page-content">

    @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    <div class="contact-grid">

        {{-- Info --}}
        <div class="info-card">
            <h3 style="font-family:'DM Serif Display',serif;font-size:1.3rem;margin-bottom:1.5rem" class="ar">معلومات التواصل</h3>
            <h3 style="font-family:'DM Serif Display',serif;font-size:1.3rem;margin-bottom:1.5rem" class="en">Contact Information</h3>

            @if(!empty($siteSettings['contact_email']))
            <div class="info-item">
                <div class="info-ico">📧</div>
                <div class="info-text">
                    <h4 class="ar">البريد الإلكتروني</h4><h4 class="en">Email</h4>
                    <a href="mailto:{{ $siteSettings['contact_email'] }}">{{ $siteSettings['contact_email'] }}</a>
                </div>
            </div>
            @endif

            <div class="info-item">
                <div class="info-ico">🕐</div>
                <div class="info-text">
                    <h4 class="ar">أوقات الرد</h4><h4 class="en">Response Time</h4>
                    <p class="ar">نرد خلال 24 ساعة في أيام العمل</p>
                    <p class="en">We respond within 24 hours on business days</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-ico">✈</div>
                <div class="info-text">
                    <h4 class="ar">للحجز والرحلات</h4><h4 class="en">For Bookings</h4>
                    <a href="/search" class="ar" style="color:var(--sky)">ابحث مباشرة عبر الموقع ←</a>
                    <a href="/search" class="en" style="color:var(--sky)">Search directly on site →</a>
                </div>
            </div>

            <div style="margin-top:2rem;padding-top:1.5rem;border-top:1px solid #e8e4da">
                <div style="font-size:0.82rem;color:var(--ink-3);margin-bottom:0.8rem" class="ar">{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}</div>
                <div style="font-size:0.82rem;color:var(--ink-3);margin-bottom:0.8rem" class="en">{{ $siteSettings['site_name_en'] ?? 'SkyRoute' }}</div>
                <div style="font-size:0.82rem;color:var(--ink-3)" class="ar">{{ $siteSettings['site_tagline_ar'] ?? 'رحلاتك بين يديك' }}</div>
                <div style="font-size:0.82rem;color:var(--ink-3)" class="en">{{ $siteSettings['site_tagline_en'] ?? 'Your flights at your fingertips' }}</div>
            </div>
        </div>

        {{-- Form --}}
        <div class="card">
            <h3 style="font-family:'DM Serif Display',serif;font-size:1.3rem;margin-bottom:1.5rem" class="ar">أرسل لنا رسالة</h3>
            <h3 style="font-family:'DM Serif Display',serif;font-size:1.3rem;margin-bottom:1.5rem" class="en">Send Us a Message</h3>

            <form method="POST" action="/contact">
                @csrf
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem" class="form-row">
                    <div class="form-group">
                        <label class="ar">الاسم الكامل</label>
                        <label class="en">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               placeholder="محمد أحمد">
                        @error('name')<div style="color:#dc2626;font-size:0.8rem;margin-top:0.3rem">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="ar">البريد الإلكتروني</label>
                        <label class="en">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               placeholder="example@mail.com">
                        @error('email')<div style="color:#dc2626;font-size:0.8rem;margin-top:0.3rem">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="ar">الموضوع</label>
                    <label class="en">Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" required
                           placeholder="...">
                    @error('subject')<div style="color:#dc2626;font-size:0.8rem;margin-top:0.3rem">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="ar">الرسالة</label>
                    <label class="en">Message</label>
                    <textarea name="message" required placeholder="...">{{ old('message') }}</textarea>
                    @error('message')<div style="color:#dc2626;font-size:0.8rem;margin-top:0.3rem">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
                    <span class="ar">إرسال الرسالة ←</span>
                    <span class="en">Send Message →</span>
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
