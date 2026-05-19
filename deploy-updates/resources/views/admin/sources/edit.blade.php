@extends('admin.layout')
@section('title', 'تعديل: ' . $source->name)

@section('content')

{{-- Page header --}}
<div style="display:flex;align-items:center;gap:0.8rem;margin-bottom:1.5rem">
    <a href="{{ route('admin.sources.index') }}" class="btn btn-secondary btn-sm">← العودة</a>
    <div>
        <h2 style="font-size:1rem;font-weight:600;margin:0">تعديل مصدر الأفلييت</h2>
        <div style="font-size:0.8rem;color:#7a7a7a;margin-top:2px">{{ $source->name }}</div>
    </div>
    <span class="color-swatch" style="background:{{ $source->color }};width:28px;height:28px;border-radius:6px;border:1px solid rgba(0,0,0,0.1);display:inline-block;margin-right:auto"></span>
</div>

<div style="max-width:680px">
    <form method="POST" action="{{ route('admin.sources.update', $source) }}">
        @csrf
        @method('PUT')

        <div class="form-card" style="margin-bottom:1rem">
            <div style="font-size:0.78rem;font-weight:600;color:#7a7a7a;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:1rem">معلومات المصدر</div>

            <div class="form-group">
                <label class="form-label">اسم المصدر *</label>
                <input type="text" name="name" class="form-control"
                    value="{{ old('name', $source->name) }}" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">التسمية بالعربية</label>
                    <input type="text" name="label_ar" class="form-control"
                        value="{{ old('label_ar', $source->label_ar) }}"
                        placeholder="مثال: أفضل سعر مباشر">
                </div>
                <div class="form-group">
                    <label class="form-label">التسمية بالإنجليزية</label>
                    <input type="text" name="label_en" class="form-control"
                        value="{{ old('label_en', $source->label_en) }}"
                        placeholder="Best direct price">
                </div>
            </div>

            <div style="display:grid;grid-template-columns:140px 1fr auto;gap:1rem;align-items:flex-end">
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">اللون</label>
                    <div style="display:flex;align-items:center;gap:0.5rem">
                        <input type="color" name="color" id="colorPicker"
                            value="{{ old('color', $source->color) }}"
                            class="form-control" style="height:42px;padding:3px;cursor:pointer;width:60px"
                            oninput="document.getElementById('colorHex').value=this.value;document.getElementById('colorPreview').style.background=this.value">
                        <input type="text" id="colorHex" maxlength="7"
                            value="{{ old('color', $source->color) }}"
                            class="form-control" style="font-family:monospace;font-size:0.85rem"
                            oninput="if(/^#[0-9a-fA-F]{6}$/.test(this.value)){document.getElementById('colorPicker').value=this.value;document.getElementById('colorPreview').style.background=this.value}">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0">
                    <label class="form-label">الترتيب</label>
                    <input type="number" name="sort_order" class="form-control"
                        value="{{ old('sort_order', $source->sort_order) }}" min="0">
                </div>
                <div style="padding-bottom:0.3rem">
                    <label class="form-check">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $source->is_active) ? 'checked' : '' }}>
                        <span style="font-size:0.88rem">مفعّل</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- URL Template section --}}
        <div class="form-card" style="margin-bottom:1rem">
            <div style="font-size:0.78rem;font-weight:600;color:#7a7a7a;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:1rem">قالب رابط الحجز</div>

            {{-- Variable tags --}}
            <div style="background:#f8f6f2;border:1px solid #e0dbd0;border-radius:8px;padding:1rem;margin-bottom:0.9rem">
                <div style="font-size:0.8rem;color:#3a3a3a;font-weight:500;margin-bottom:0.6rem">
                    📋 استخدم هذه المتغيرات في الرابط — انقر لنسخ:
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:0.45rem;margin-bottom:0.8rem">
                    @php
                    $vars = [
                        'origin'             => 'رمز مطار المغادرة',
                        'destination'        => 'رمز مطار الوصول',
                        'date_short'         => 'تاريخ الذهاب Ymd',
                        'date_dashes'        => 'تاريخ الذهاب Y-m-d',
                        'return_date_short'  => 'تاريخ العودة Ymd',
                        'return_date_dashes' => 'تاريخ العودة Y-m-d',
                        'adults'             => 'عدد البالغين',
                        'marker'             => 'معرف الأفلييت',
                    ];
                    @endphp
                    @foreach($vars as $var => $desc)
                    <button type="button"
                        title="{{ $desc }}"
                        onclick="copyVar(this, '{{ $var }}')"
                        style="background:#fff;border:1px solid #d0ccc4;border-radius:6px;padding:4px 11px;font-size:0.8rem;font-family:monospace;cursor:pointer;color:#1a5fff;transition:all 0.15s">
                        {{"{"}}{{ $var }}{{"}"}}
                    </button>
                    @endforeach
                </div>
                <div style="font-size:0.72rem;color:#aaa;border-top:1px solid #e8e4da;padding-top:0.6rem">
                    <strong>قيم الاختبار:</strong>
                    origin=<code>BGW</code> · destination=<code>IST</code> · date=<code>2026-06-15</code> · adults=<code>1</code> · marker=<code>633503</code>
                </div>
            </div>

            <div class="form-group" style="margin-bottom:0.7rem">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.4rem">
                    <label class="form-label" style="margin:0">قالب الرابط</label>
                    <button type="button" onclick="fillExample()" style="font-size:0.75rem;color:#7a7a7a;background:none;border:1px dashed #d0ccc4;border-radius:5px;padding:2px 8px;cursor:pointer">
                        ⚡ مثال Aviasales
                    </button>
                </div>
                <textarea id="urlTemplate" name="url_template" class="form-control"
                    rows="3" oninput="updatePreview()"
                    placeholder="https://example.com/search/{origin}/{destination}?adults={adults}&ref={marker}"
                    style="font-family:monospace;font-size:0.82rem;direction:ltr;text-align:left">{{ old('url_template', $source->url_template) }}</textarea>
            </div>

            {{-- Live preview --}}
            <div style="background:#f0f7ff;border:1px solid #bfdbfe;border-radius:8px;padding:0.9rem">
                <div style="font-size:0.75rem;color:#6b7280;font-weight:500;margin-bottom:0.4rem">🔍 معاينة بالقيم التجريبية:</div>
                <code id="urlPreview" style="font-size:0.74rem;color:#1a5fff;word-break:break-all;line-height:1.6;display:block;direction:ltr;min-height:20px">
                    {{ $source->url_template ? '...' : '—' }}
                </code>
                <div style="margin-top:0.7rem">
                    <button type="button" id="testBtn"
                        style="display:none"
                        class="btn btn-sm btn-success">
                        🚀 اختبر الرابط في تاب جديد
                    </button>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display:flex;gap:0.8rem">
            <button type="submit" class="btn btn-primary">💾 حفظ التعديلات</button>
            <a href="{{ route('admin.sources.index') }}" class="btn btn-secondary">إلغاء</a>
        </div>

    </form>
</div>

@push('scripts')
<script>
const TEST = {
    origin: 'BGW', destination: 'IST',
    date_short: '20260615', date_dashes: '2026-06-15',
    return_date_short: '20260622', return_date_dashes: '2026-06-22',
    adults: '1', marker: '633503',
};

function resolve(tpl) {
    return tpl
        .replace(/\{origin\}/g,             TEST.origin)
        .replace(/\{destination\}/g,         TEST.destination)
        .replace(/\{date_short\}/g,          TEST.date_short)
        .replace(/\{date_dashes\}/g,         TEST.date_dashes)
        .replace(/\{return_date_short\}/g,   TEST.return_date_short)
        .replace(/\{return_date_dashes\}/g,  TEST.return_date_dashes)
        .replace(/\{adults\}/g,              TEST.adults)
        .replace(/\{marker\}/g,              TEST.marker);
}

function updatePreview() {
    const tpl = document.getElementById('urlTemplate').value.trim();
    const preview = document.getElementById('urlPreview');
    const btn = document.getElementById('testBtn');
    if (!tpl) { preview.textContent = '—'; btn.style.display = 'none'; return; }
    const resolved = resolve(tpl);
    preview.textContent = resolved;
    btn.style.display = 'inline-flex';
    btn.onclick = () => window.open(resolved, '_blank');
}

function copyVar(el, v) {
    navigator.clipboard.writeText('{' + v + '}').then(() => {
        const orig = el.textContent;
        el.textContent = '✓ تم';
        el.style.cssText += ';background:#dcfce7;color:#16a34a;border-color:#86efac';
        setTimeout(() => {
            el.textContent = orig;
            el.style.background = '';
            el.style.color = '#1a5fff';
            el.style.borderColor = '';
        }, 1300);
    });
}

function fillExample() {
    document.getElementById('urlTemplate').value =
        'https://www.aviasales.com/search/{origin}{date_short}{destination}{adults}?marker={marker}&utm_source=affiliate';
    updatePreview();
}

// Init preview on page load
document.addEventListener('DOMContentLoaded', updatePreview);
</script>
@endpush

@endsection
