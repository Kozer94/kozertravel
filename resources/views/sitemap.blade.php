<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>{{ url('/') }}</loc><changefreq>daily</changefreq><priority>1.0</priority></url>
    <url><loc>{{ url('/search') }}</loc><changefreq>daily</changefreq><priority>0.9</priority></url>
    <url><loc>{{ url('/deals') }}</loc><changefreq>daily</changefreq><priority>0.8</priority></url>
    <url><loc>{{ url('/blog') }}</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ url('/about') }}</loc><changefreq>monthly</changefreq><priority>0.5</priority></url>
    <url><loc>{{ url('/contact') }}</loc><changefreq>monthly</changefreq><priority>0.4</priority></url>
    <url><loc>{{ url('/privacy') }}</loc><changefreq>yearly</changefreq><priority>0.3</priority></url>
    <url><loc>{{ url('/terms') }}</loc><changefreq>yearly</changefreq><priority>0.3</priority></url>
    @foreach($destinations as $dest)
    <url>
        <loc>{{ url('/flights/' . $dest->slug) }}</loc>
        <lastmod>{{ ($dest->updated_at ?? now())->format('Y-m-d') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
    @foreach($posts as $post)
    <url>
        <loc>{{ url('/blog/' . $post->slug) }}</loc>
        <lastmod>{{ ($post->published_at ?? now())->format('Y-m-d') }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>
