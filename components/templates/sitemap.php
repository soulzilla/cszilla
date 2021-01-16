<?php

/* @var $items app\models\Sitemap[] */
/* @var $host string */

use app\enums\SitemapEnum;
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach (SitemapEnum::keys() as $key): ?>
        <url>
            <loc><?= $host . $key; ?></loc>
        </url>
    <?php endforeach; ?>
    <?php if (sizeof($items)): ?>
        <?php foreach($items as $item): ?>
            <url>
                <loc><?= $host . $item->url; ?></loc>
                <lastmod><?= $item->last_mod; ?></lastmod>
            </url>
        <?php endforeach; ?>
    <?php endif; ?>
</urlset>
