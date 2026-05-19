@extends('admin.layout')
@section('title', 'رسالة: ' . $message->subject)

@section('content')
<div style="max-width:680px">
    <div class="form-card">
        <div style="margin-bottom:1.5rem;padding-bottom:1.2rem;border-bottom:1px solid #e0dbd0">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem">
                <div>
                    <div class="filter-label">الاسم</div>
                    <div style="font-weight:600">{{ $message->name }}</div>
                </div>
                <div>
                    <div class="filter-label">البريد الإلكتروني</div>
                    <div style="direction:ltr;text-align:left"><a href="mailto:{{ $message->email }}" style="color:var(--sky)">{{ $message->email }}</a></div>
                </div>
                <div>
                    <div class="filter-label">الموضوع</div>
                    <div style="font-weight:600">{{ $message->subject }}</div>
                </div>
                <div>
                    <div class="filter-label">التاريخ</div>
                    <div>{{ $message->created_at->format('Y-m-d H:i') }}</div>
                </div>
            </div>
        </div>
        <div>
            <div class="filter-label" style="margin-bottom:0.6rem">نص الرسالة</div>
            <div style="background:#f8f6f2;border-radius:8px;padding:1.2rem;line-height:1.8;white-space:pre-wrap">{{ $message->message }}</div>
        </div>
        <div style="margin-top:1.5rem;display:flex;gap:0.8rem">
            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary">رد بالبريد</a>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">← العودة</a>
        </div>
    </div>
</div>
@endsection
