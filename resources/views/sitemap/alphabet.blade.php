<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:xhtml="http://www.w3.org/1999/xhtml">
    @foreach ($data as $word)
        <url>
            <loc>{{env('APP_URL', 'Laravel')}}/{!!html_entity_decode($word->core_name)!!}</loc>
            <lastmod>{{ $word->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>