@php
    $metaTitle    = $metaTitle    ?? ($siteSettings['site_name_ar'] ?? 'SkyRoute');
    $metaDesc     = $metaDesc     ?? ($siteSettings['site_description_ar'] ?? '');
    $metaImage    = $metaImage    ?? ($siteSettings['og_image'] ?? '');
    $canonicalUrl = $canonicalUrl ?? request()->url();
    $schemaType   = $schemaType   ?? 'WebSite';

    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type'    => $schemaType,
        'name'     => $metaTitle,
        'url'      => $canonicalUrl,
    ];
    if ($metaDesc)  $jsonLd['description'] = $metaDesc;
    if ($metaImage) $jsonLd['image']       = $metaImage;
    if ($schemaType === 'WebSite') {
        $jsonLd['potentialAction'] = [
            '@type'       => 'SearchAction',
            'target'      => url('/results') . '?origin={origin}&destination={destination}&date={date}',
            'query-input' => 'required name=origin required name=destination required name=date',
        ];
    }
@endphp

<meta name="description" content="{{ $metaDesc }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $canonicalUrl }}">

<meta property="og:type"        content="website">
<meta property="og:title"       content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDesc }}">
<meta property="og:url"         content="{{ $canonicalUrl }}">
<meta property="og:site_name"   content="{{ $siteSettings['site_name_ar'] ?? 'SkyRoute' }}">
@if($metaImage)
<meta property="og:image"       content="{{ $metaImage }}">
@endif

<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDesc }}">
@if($metaImage)
<meta name="twitter:image"       content="{{ $metaImage }}">
@endif

<script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}</script>
