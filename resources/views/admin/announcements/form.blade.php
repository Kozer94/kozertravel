@extends('admin.layout')
@section('title', $announcement ? 'تعديل إعلان' : 'إضافة إعلان جديد')

@section('content')

{{-- Page header --}}
<div style="display:flex;align-items:center;gap:0.8rem;margin-bottom:1.5rem">
    <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary btn-sm">← العودة</a>
    <div>
        <h2 style="font-size:1rem;font-weight:600;margin:0">
            {{ $announcement ? 'تعديل إعلان' : 'إضافة إعلان جديد' }}
        </h2>
        @if($announcement)
        <div style="font-size:0.8rem;color:#7a7a7a;margin-top:2px">{{ $announcement->title }}</div>
        @endif
    </div>
</div>

<div style="max-width:650px">
    <div class="form-card">
        <form method="POST" action="{{ $announcement ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}">
            @csrf
            @if($announcement) @method('PUT') @endif

            <div style="font-size:0.78rem;font-weight:600;color:#7a7a7a;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:1rem">محتوى الإعلان</div>

            <div class="form-group">
                <label class="form-label">عنوان الإعلان *</label>
                <input type="text" name="title" class="form-control"
                    value="{{ old('title', $announcement?->title) }}"
                    placeholder="عنوان الإعلان" required>
            </div>

            <div class="form-group">
                <label class="form-label">نص الإعلان *</label>
                <textarea name="content" class="form-control" rows="4"
                    placeholder="اكتب نص الإعلان هنا..." required>{{ old('content', $announcement?->content) }}</textarea>
            </div>

            <div style="font-size:0.78rem;font-weight:600;color:#7a7a7a;text-transform:uppercase;letter-spacing:0.5px;margin:1.2rem 0 1rem">إعدادات العرض</div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">نوع الإعلان *</label>
                    <select name="type" class="form-control" required>
                        <option value="banner" {{ old('type', $announcement?->type) === 'banner' ? 'selected' : '' }}>
                            📢 بانر (شريط علوي)
                        </option>
                        <option value="popup" {{ old('type', $announcement?->type) === 'popup' ? 'selected' : '' }}>
                            💬 بوب-أب (نافذة منبثقة)
                        </option>
                    </select>
                </div>
                <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:0.5rem">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $announcement?->is_active ?? true) ? 'checked' : '' }}>
                        <span>مفعّل الآن</span>
                    </label>
                </div>
            </div>

            <div style="font-size:0.78rem;font-weight:600;color:#7a7a7a;text-transform:uppercase;letter-spacing:0.5px;margin:1.2rem 0 1rem">جدول العرض (اختياري)</div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">تاريخ ووقت البداية</label>
                    <input type="datetime-local" name="starts_at" class="form-control"
                        value="{{ old('starts_at', $announcement?->starts_at?->format('Y-m-d\TH:i')) }}">
                </div>
                <div class="form-group">
                    <label class="form-label">تاريخ ووقت الانتهاء</label>
                    <input type="datetime-local" name="ends_at" class="form-control"
                        value="{{ old('ends_at', $announcement?->ends_at?->format('Y-m-d\TH:i')) }}">
                </div>
            </div>

            <div style="display:flex;gap:0.8rem;margin-top:1.5rem;padding-top:1rem;border-top:1px solid #f0ece4">
                <button type="submit" class="btn btn-primary">
                    {{ $announcement ? '💾 حفظ التعديلات' : '📢 نشر الإعلان' }}
                </button>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>

@endsection
