@extends('admin.layout')

@section('title', 'إعدادات الموقع')

@section('content')

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    @php
        $groupLabels = [
            'general'    => ['icon' => '🌐', 'label' => 'إعدادات عامة'],
            'appearance' => ['icon' => '🎨', 'label' => 'المظهر والهوية'],
            'hero'       => ['icon' => '🏠', 'label' => 'الصفحة الرئيسية'],
            'footer'     => ['icon' => '📄', 'label' => 'التذييل'],
        ];
    @endphp

    @foreach($groupLabels as $groupKey => $meta)
        @if(isset($settings[$groupKey]))
        <div class="form-card" style="margin-bottom:1.5rem">
            <div style="display:flex;align-items:center;gap:0.6rem;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid #e0dbd0">
                <span style="font-size:1.3rem">{{ $meta['icon'] }}</span>
                <h3 style="font-size:1rem;font-weight:600">{{ $meta['label'] }}</h3>
            </div>

            <div class="form-row" style="grid-template-columns: repeat(auto-fit, minmax(280px,1fr))">
                @foreach($settings[$groupKey] as $setting)
                <div class="form-group">
                    <label class="form-label">{{ $setting->label }}</label>

                    @if($setting->type === 'textarea')
                        <textarea name="{{ $setting->key }}" class="form-control" rows="3">{{ old($setting->key, $setting->value) }}</textarea>

                    @elseif($setting->type === 'color')
                        <div style="display:flex;align-items:center;gap:0.7rem">
                            <input type="color" name="{{ $setting->key }}"
                                   value="{{ old($setting->key, $setting->value ?: '#1a5fff') }}"
                                   style="width:48px;height:40px;border:1px solid #d0ccc4;border-radius:7px;cursor:pointer;padding:2px">
                            <input type="text" id="color_text_{{ $setting->key }}"
                                   value="{{ old($setting->key, $setting->value ?: '#1a5fff') }}"
                                   class="form-control" style="width:120px"
                                   oninput="document.querySelector('[name=\'{{ $setting->key }}\']').value=this.value">
                        </div>
                        <script>
                            document.querySelector('[name="{{ $setting->key }}"]').addEventListener('input', function(){
                                document.getElementById('color_text_{{ $setting->key }}').value = this.value;
                            });
                        </script>

                    @elseif($setting->type === 'image')
                        <div class="image-upload-wrap" style="border:2px dashed #d0ccc4;border-radius:10px;padding:1.2rem;text-align:center;cursor:pointer"
                             onclick="document.getElementById('file_{{ $setting->key }}').click()">

                            @if($setting->value)
                                <img id="preview_{{ $setting->key }}"
                                     src="{{ Storage::disk('public')->url($setting->value) }}"
                                     style="max-height:80px;max-width:200px;object-fit:contain;margin-bottom:0.5rem;display:block;margin:0 auto 0.5rem">
                            @else
                                <div id="preview_{{ $setting->key }}" style="font-size:2rem;margin-bottom:0.3rem">🖼</div>
                            @endif

                            <div style="font-size:0.82rem;color:#7a7a7a">اضغط لرفع صورة · PNG, JPG · حد أقصى 2MB</div>
                            <input type="file" id="file_{{ $setting->key }}" name="{{ $setting->key }}"
                                   accept="image/*" style="display:none"
                                   onchange="previewImage(this,'preview_{{ $setting->key }}')">
                        </div>

                        @if($setting->value)
                            <div style="margin-top:0.5rem;font-size:0.78rem;color:#7a7a7a">
                                الملف الحالي:
                                <a href="{{ Storage::disk('public')->url($setting->value) }}" target="_blank" style="color:var(--sky)">عرض</a>
                            </div>
                        @endif

                    @else
                        <input type="text" name="{{ $setting->key }}"
                               value="{{ old($setting->key, $setting->value) }}"
                               class="form-control">
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @endforeach

    <div style="position:sticky;bottom:0;background:linear-gradient(transparent,#f0ece4 40%);padding:1rem 0;text-align:left">
        <button type="submit" class="btn btn-primary" style="padding:0.7rem 2.5rem;font-size:1rem">
            💾 حفظ جميع الإعدادات
        </button>
    </div>
</form>

@push('scripts')
<script>
function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style = 'max-height:80px;max-width:200px;object-fit:contain;margin:0 auto 0.5rem;display:block';
                img.id = previewId;
                preview.replaceWith(img);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

@endsection
