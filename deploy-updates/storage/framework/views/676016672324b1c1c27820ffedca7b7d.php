<?php
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
?>

<meta name="description" content="<?php echo e($metaDesc); ?>">
<meta name="robots" content="index, follow">
<link rel="canonical" href="<?php echo e($canonicalUrl); ?>">

<meta property="og:type"        content="website">
<meta property="og:title"       content="<?php echo e($metaTitle); ?>">
<meta property="og:description" content="<?php echo e($metaDesc); ?>">
<meta property="og:url"         content="<?php echo e($canonicalUrl); ?>">
<meta property="og:site_name"   content="<?php echo e($siteSettings['site_name_ar'] ?? 'SkyRoute'); ?>">
<?php if($metaImage): ?>
<meta property="og:image"       content="<?php echo e($metaImage); ?>">
<?php endif; ?>

<meta name="twitter:card"        content="summary_large_image">
<meta name="twitter:title"       content="<?php echo e($metaTitle); ?>">
<meta name="twitter:description" content="<?php echo e($metaDesc); ?>">
<?php if($metaImage): ?>
<meta name="twitter:image"       content="<?php echo e($metaImage); ?>">
<?php endif; ?>

<script type="application/ld+json"><?php echo json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?></script>
<?php /**PATH C:\Users\kozer\Desktop\KozerTravel\resources\views/partials/seo.blade.php ENDPATH**/ ?>