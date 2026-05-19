@extends('admin.layout')
@section('title', $post ? 'تعديل مقال' : 'مقال جديد')

@push('styles')
<style>
.editor-wrap { border: 1px solid #d0ccc4; border-radius: 7px; overflow: hidden; }
.editor-toolbar { background: #f8f6f2; border-bottom: 1px solid #d0ccc4; padding: 0.5rem 0.8rem; display: flex; gap: 0.4rem; flex-wrap: wrap; }
.editor-toolbar button { border: 1px solid #d0ccc4; background: #fff; border-radius: 5px; padding: 0.3rem 0.6rem; cursor: pointer; font-size: 0.82rem; font-family: inherit; transition: all 0.15s; }
.editor-toolbar button:hover { background: var(--sky); color: #fff; border-color: var(--sky); }
#content-area { width: 100%; min-height: 320px; padding: 1rem; border: none; outline: none; font-family: 'Tajawal', sans-serif; font-size: 0.95rem; line-height: 1.8; resize: vertical; }
</style>
@endpush

@section('content')
<div style="max-width:760px">
<form method="POST" action="{{ $post ? route('admin.posts.update', $post) : route('admin.posts.store') }}">
    @csrf
    @if($post) @method('PUT') @endif

    <div class="form-card" style="margin-bottom:1.5rem">
        <div class="form-group">
            <label class="form-label">العنوان *</label>
            <input class="form-control" name="title" value="{{ old('title', $post?->title) }}" required placeholder="عنوان المقال">
        </div>

        <div class="form-group">
            <label class="form-label">المحتوى *</label>
            <div class="editor-wrap">
                <div class="editor-toolbar">
                    <button type="button" onclick="fmt('bold')"><b>B</b></button>
                    <button type="button" onclick="fmt('italic')"><i>I</i></button>
                    <button type="button" onclick="insertHeading()">H2</button>
                    <button type="button" onclick="fmt('insertUnorderedList')">• قائمة</button>
                    <button type="button" onclick="fmt('insertOrderedList')">1. قائمة</button>
                    <button type="button" onclick="insertLink()">رابط</button>
                    <button type="button" onclick="insertImg()">صورة</button>
                </div>
                <div id="content-area" contenteditable="true">{!! old('content', $post?->content) !!}</div>
            </div>
            <input type="hidden" name="content" id="content-hidden">
        </div>

        <div class="form-group">
            <label class="form-label">مقتطف (اختياري)</label>
            <textarea class="form-control" name="excerpt" rows="3" placeholder="ملخص قصير للمقال (يظهر في قوائم المدونة)">{{ old('excerpt', $post?->excerpt) }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">وصف SEO (اختياري، حتى 160 حرف)</label>
            <input class="form-control" name="meta_description" value="{{ old('meta_description', $post?->meta_description) }}" maxlength="160">
        </div>

        <div class="form-check">
            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $post?->is_published) ? 'checked' : '' }}>
            <label for="is_published">نشر المقال الآن</label>
        </div>
    </div>

    <div style="display:flex;gap:0.8rem">
        <button type="submit" class="btn btn-primary">{{ $post ? 'حفظ التغييرات' : 'نشر المقال' }}</button>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">إلغاء</a>
    </div>
</form>
</div>
@endsection

@push('scripts')
<script>
function fmt(cmd) { document.execCommand(cmd, false, null); }
function insertHeading() {
    const sel = window.getSelection().toString();
    document.execCommand('insertHTML', false, `<h2>${sel || 'العنوان'}</h2>`);
}
function insertLink() {
    const url = prompt('أدخل الرابط:');
    if (url) document.execCommand('createLink', false, url);
}
function insertImg() {
    const url = prompt('أدخل رابط الصورة:');
    if (url) document.execCommand('insertImage', false, url);
}
document.querySelector('form').addEventListener('submit', function() {
    document.getElementById('content-hidden').value = document.getElementById('content-area').innerHTML;
});
</script>
@endpush
