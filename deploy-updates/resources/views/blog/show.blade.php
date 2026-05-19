@extends('layouts.public')

@php
    $metaTitle    = $post->title . ' — ' . ($siteSettings['site_name_ar'] ?? 'SkyRoute');
    $metaDesc     = $post->meta_description ?: $post->excerptOrTruncated();
    $metaImage    = $post->og_image ?? '';
    $canonicalUrl = url('/blog/' . $post->slug);
    $schemaType   = 'Article';
@endphp

@section('title', $post->title)

@push('styles')
<style>
.post-hero { background: linear-gradient(135deg, #020817 0%, #1e1040 100%); padding: 5rem 2rem 3rem; text-align: center; color: #fff; }
.post-hero h1 { font-family: 'DM Serif Display', serif; font-size: 2.4rem; max-width: 760px; margin: 0 auto 1rem; line-height: 1.3; }
.post-meta { font-size: 0.88rem; opacity: 0.7; }
.post-body { background: #fff; border-radius: 14px; padding: 2.5rem; border: 1px solid #e8e4da; margin-top: 2rem; }
.post-body p  { line-height: 1.9; margin-bottom: 1.2rem; color: #333; }
.post-body h2 { font-size: 1.4rem; font-weight: 700; margin: 2rem 0 0.8rem; color: #0d0d0d; }
.post-body h3 { font-size: 1.1rem; font-weight: 600; margin: 1.5rem 0 0.6rem; }
.post-body ul, .post-body ol { padding-right: 1.5rem; margin-bottom: 1.2rem; }
.post-body li { line-height: 1.8; color: #333; margin-bottom: 0.3rem; }
.post-body img { max-width: 100%; border-radius: 10px; margin: 1rem 0; }
.post-body blockquote { border-right: 3px solid var(--sky); padding: 0.8rem 1.2rem; background: var(--sky-lt); border-radius: 0 10px 10px 0; margin: 1.5rem 0; }
.back-link { color: var(--sky); text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.3rem; margin-bottom: 1rem; }
</style>
@endpush

@section('content')
<div class="post-hero">
    @if($post->og_image)
        <img src="{{ $post->og_image }}" alt="{{ $post->title }}" style="max-height:260px;border-radius:12px;margin-bottom:1.5rem;object-fit:cover" loading="lazy">
    @endif
    <h1>{{ $post->title }}</h1>
    <p class="post-meta">{{ $post->published_at?->format('d M Y') }}</p>
</div>

<div class="page-content" style="max-width:760px">
    <a href="/blog" class="back-link ar">← العودة إلى المدونة</a>
    <a href="/blog" class="back-link en">← Back to Blog</a>

    <div class="post-body">
        {!! $post->content !!}
    </div>
</div>
@endsection
