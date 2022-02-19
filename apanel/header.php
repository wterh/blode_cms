<?php
// Название программы: Белая CMS
// Версия: v.1.7 Free
// URL: http://BlondeCMS.ru

$site = $_SERVER['SERVER_NAME'];
$_r = $_SERVER['REQUEST_URI'];
$_s = 'strpos';
$_a = 'class="active"';
$hm = array(':', '..', '//', '(', '[', '{', '%', '@', '#', '$', '!');
foreach ($hm as $rezult){
	if($_s($_r,$rezult)) die ('<h1>ДА ладно ... )))</h1>');
}

require_once('session.php');
require_once('../settings.dat');
setlocale(LC_ALL, 'ru_RU.UTF-8');
?>
	
<!DOCTYPE HTML>
<head>
<title>АДМИН-ПАНЕЛЬ</title>
	<meta charset="UTF-8">
	<LINK rel="stylesheet" href="skin/style.css">
	<link rel="stylesheet" href="skin/faq.css">
	<script src="//code.jquery.com/jquery-latest.min.js"></script>
	<script src="jscripts/custom.js"></script>
	<link rel="icon" href="//<?=$site;?>/favicon.ico" type="image/x-icon"> 
	<link rel="shortcut icon" href="//<?=$site;?>/favicon.ico" type="image/x-icon">
</head>

<body>
<div id="main">
	<div id="main_top">
<img width="46" height="43" src="images/admin.png" align="left"> <strong>ПАНЕЛЬ УПРАВЛЕНИЯ</strong> 
<div style="float:right; margin:7px -3px 0 0">
<a href="../" target="_blank" class="ok" title="НА САЙТ"><img src="images/glaz.png"> Сайт</a>
<a href="exit.php" class="ok" title="ВЫХОД"><img src="images/remove.png"> Выход</a>
</div>
<br>
Здравствуйте, <b><?=$aut_name?></b>
	</div>
	<div id="menu">
	<table id="menu_img">
		<tr align="center">
			<td width="11%"><a href="index.php"><img src="images/index.png"><p <?if($_s($_r,'index.php'))echo $_a;?>>Главная</p></a></td>
			<td width="11%"><a href="page.php"><img src="images/page.png"><p <?if($_s($_r,'page'))echo $_a;?>>Страницы</p></a></td>
			<td width="11%"><a href="article.php"><img src="images/articles.png"><p <?if($_s($_r,'article'))echo $_a;?>>Статьи</p></a></td>
			<td width="11%"><a href="news.php"><img src="images/news.png"><p <?if($_s($_r,'news'))echo $_a;?>>Новости</p></a></td>
			<td width="11%"><a href="site_blok.php"><img src="images/blok.png"><p <?if($_s($_r,'site_blok'))echo $_a;?>>Блоки</p></a></td>
			<td width="11%"><a href="buy.php"><img src="images/magaz.png"><p <?if($_s($_r,'buy'))echo $_a;?>>Магазин</p></a></td>
			<td width="11%"><a href="feedback.php"><img src="images/pisma.png"><p <?if($_s($_r,'feedback'))echo $_a;?>>Нам пишут</p></a></td>
			<td width="11%"><a href="templates.php"><img src="images/shablon.png"><p <?if($_s($_r,'templates'))echo $_a;?>>Шаблон</p></a></td>
			<td width="11%"><a href="settings.php"><img src="images/shesternya.png"><p <?if($_s($_r,'settings'))echo $_a;?>>Настройки</p></a></td></tr>
	</table>
	</div>
<br>
