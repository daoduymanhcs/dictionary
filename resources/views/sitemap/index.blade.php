<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{env('APP_URL', 'Laravel')}}/sitemap/common</loc>
    </sitemap>
    @foreach ($alphabet as $letter)
    <sitemap>
        <loc>{{env('APP_URL', 'Laravel')}}/sitemap/alphabet/{{$letter}}</loc>
    </sitemap>
    @endforeach
</sitemapindex>