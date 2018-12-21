<?php 
$xmldata = '<?xml version="1.0" encoding="UTF-8"?>'; 
$xmldata .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
 xmlns:xhtml="http://www.w3.org/1999/xhtml">';
foreach($list as $row) {
$xmldata .= '<url>';
    $xmldata .= '<loc>'.CHtml::encode($row['loc']).'</loc>';
    $xmldata .= '<xhtml:link rel="alternate" hreflang="az" href="http://kibrit.tech/az'.$row['path'].'" />';
    $xmldata .= '<xhtml:link rel="alternate" hreflang="en" href="http://kibrit.tech/en'.$row['path'].'" />';
    $xmldata .= '<xhtml:link rel="alternate" hreflang="ru" href="http://kibrit.tech/ru'.$row['path'].'" />';
    $xmldata .= '<changefreq>'.$row['frequency'].'</changefreq>';
    $xmldata .= '<priority>'.$row['priority'].'</priority>';
$xmldata .= '</url>';
}
$xmldata .= '</urlset>';
file_put_contents('sitemap.xml', $xmldata);
?>