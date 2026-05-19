@extends('admin.layout')
@section('title', $route ? 'تعديل وجهة' : 'إضافة وجهة جديدة')

@section('content')

{{-- Page header --}}
<div style="display:flex;align-items:center;gap:0.8rem;margin-bottom:1.5rem">
    <a href="{{ route('admin.routes.index') }}" class="btn btn-secondary btn-sm">← العودة</a>
    <div>
        <h2 style="font-size:1rem;font-weight:600;margin:0">
            {{ $route ? 'تعديل وجهة' : 'إضافة وجهة جديدة' }}
        </h2>
        @if($route)
        <div style="font-size:0.8rem;color:#7a7a7a;margin-top:2px">
            {{ $route->origin }} ✈ {{ $route->destination }} — {{ $route->label_ar }}
        </div>
        @endif
    </div>
</div>

<div style="max-width:600px">
    <div class="form-card">
        <form method="POST" action="{{ $route ? route('admin.routes.update', $route) : route('admin.routes.store') }}">
            @csrf
            @if($route) @method('PUT') @endif

            <div style="font-size:0.78rem;font-weight:600;color:#7a7a7a;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:1rem">رموز المطارات</div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">رمز مطار المغادرة (IATA) *</label>
                    <input type="text" name="origin" class="form-control" maxlength="3"
                        value="{{ old('origin', $route?->origin) }}"
                        placeholder="مثال: CAI"
                        style="text-transform:uppercase;font-family:monospace;font-size:1.1rem;letter-spacing:2px" required>
                </div>
                <div class="form-group">
                    <label class="form-label">رمز مطار الوصول (IATA) *</label>
                    <input type="text" name="destination" class="form-control" maxlength="3"
                        value="{{ old('destination', $route?->destination) }}"
                        placeholder="مثال: DXB"
                        style="text-transform:uppercase;font-family:monospace;font-size:1.1rem;letter-spacing:2px" required>
                </div>
            </div>

            <div style="font-size:0.78rem;font-weight:600;color:#7a7a7a;text-transform:uppercase;letter-spacing:0.5px;margin:1.2rem 0 1rem">اسم الوجهة</div>

            <div class="form-group">
                <label class="form-label">الاسم بالعربية *</label>
                <input type="text" name="label_ar" class="form-control"
                    value="{{ old('label_ar', $route?->label_ar) }}"
                    placeholder="القاهرة — دبي" required>
            </div>

            <div class="form-group">
                <label class="form-label">الاسم بالإنجليزية *</label>
                <input type="text" name="label_en" class="form-control"
                    value="{{ old('label_en', $route?->label_en) }}"
                    placeholder="Cairo — Dubai" required>
            </div>

            <div style="font-size:0.78rem;font-weight:600;color:#7a7a7a;text-transform:uppercase;letter-spacing:0.5px;margin:1.2rem 0 1rem">إعدادات العرض</div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">الترتيب</label>
                    <input type="number" name="sort_order" class="form-control"
                        value="{{ old('sort_order', $route?->sort_order ?? 0) }}" min="0">
                </div>
                <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:0.5rem">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $route?->is_active ?? true) ? 'checked' : '' }}>
                        <span>مفعّل (ظاهر في الموقع)</span>
                    </label>
                </div>
            </div>

            <div style="display:flex;gap:0.8rem;margin-top:1.5rem;padding-top:1rem;border-top:1px solid #f0ece4">
                <button type="submit" class="btn btn-primary">
                    {{ $route ? '💾 حفظ التعديلات' : '+ إضافة الوجهة' }}
                </button>
                <a href="{{ route('admin.routes.index') }}" class="btn btn-secondary">إلغاء</a>
            </div>
        </form>
    </div>
</div>

@endsection
