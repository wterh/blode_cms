<?
// Название программы: BlondeCMS
// Версия: v.1.0
// Автор - Uhty, 2002 г.) , CMS доработана с разрешения автора
// URL: http://BlondeCMS.ru
?>
<?php
$url = rawurldecode ( $_GET['url'] );
$url = @base64_decode ( $url );
$url = str_replace ( "&amp;", "&", $url );
header("HTTP/1.1 404 Moved Permanently");
header('Location:' . $url);
exit();
?>