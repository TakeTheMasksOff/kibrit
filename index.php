<?php
date_default_timezone_set('Asia/Baku');

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

//ЧПУ URL только в нижнем регистре
$lowerURI=strtolower($_SERVER['REQUEST_URI']);
$lang = substr($lowerURI, 0, 3);

if($_SERVER['REQUEST_URI']!=$lowerURI)
{
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] . $lowerURI);
die("Redirect");
}

// redirects from old pages
if(mb_strstr($lowerURI, 'getcontent4products') !== false || mb_strstr($lowerURI, 'getproducts') !== false || (mb_strstr($lowerURI, 'getcontent') !== false && mb_strstr($lowerURI, 'products') !== false) || mb_strstr($lowerURI, 'products#!') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/products/".$_GET['keyword']);
die("Redirect");
}

if(mb_strstr($lowerURI, 'services#!') !== false) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/services/".$_GET['keyword']);
    die("Redirect");
}

if(mb_strstr($lowerURI, 'works#!') !== false) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/portfolio/".$_GET['keyword']);
    die("Redirect");
}
    

if(mb_strstr($lowerURI, 'infrastructure&action=services') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/services/".$_GET['keyword']);
die("Redirect");
}

if(mb_strstr($lowerURI, 'bms_systems_development&action=services') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/services/".$_GET['keyword']);
die("Redirect");
}


if(mb_strstr($lowerURI, 'keyword=ministry_of_communication') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/portfolio/".$_GET['keyword']);
die("Redirect");
}

if(mb_strstr($lowerURI, 'keyword=ministry_of_taxes') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/portfolio/".$_GET['keyword']);
die("Redirect");
}

if(mb_strstr($lowerURI, 'keyword=ministry_of_education') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/portfolio/".$_GET['keyword']);
die("Redirect");
}

if(mb_strstr($lowerURI, 'keyword=baku_crystal_hall') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/portfolio/".$_GET['keyword']);
die("Redirect");
}

if(mb_strstr($lowerURI, 'keyword=esra_plaza') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/portfolio/".$_GET['keyword']);
die("Redirect");
}

if(mb_strstr($lowerURI, 'keyword=mobitel') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/portfolio/".$_GET['keyword']);
die("Redirect");
}

if(mb_strstr($lowerURI, 'getcontent4works?keyword=dsc') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/portfolio/".$_GET['keyword']);
die("Redirect");
}

if(mb_strstr($lowerURI, 'getcontent4works?keyword=simbrella') !== false) {
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://" . $_SERVER['HTTP_HOST'] .$lang."/portfolio/".$_GET['keyword']);
die("Redirect");
}

// Подключаем конфигурационный файл
$config=dirname(__FILE__).'/protected/config/main.php';
// Подключаем фреймворк Yii
$yii=dirname(__FILE__).'/yoo/framework/yii.php';
require_once($yii);
// Создаем экземпляр объекта веб-приложения и запускаем его
Yii::createWebApplication($config)->run();