<?php
// Название программы: Белая CMS
// Версия: v.1.7 Free
// URL: http://BlondeCMS.ru

require_once('header.php');

if (!file_exists('../engine/site_blok.dat')) die ('Искомой страницы не существует. <a href="index.php">На главную</a>');
require_once('../engine/site_blok.dat'); 
?>
	<h1><b>Блоки страницы</b> (Выводится на всех страницах сайта)</h1>
<?php

if (isset($_POST['action']))
{
	$head = stripslashes($_POST['head']);
	$stat = stripslashes($_POST['stat']);
	$contact = stripslashes($_POST['contact']);
	$text = stripslashes($_POST['text']);
	$text3 = stripslashes($_POST['text3']);
	$acopy = stripslashes($_POST['acopy']);
	$content = "<?\r\n\$head = <<<EOT\r\n" . $head . "\r\n" .
		"EOT;\r\n\r\n".
		"\$bot_menu = <<<EOT\r\n" . $text3 . "\r\n" .
			"EOT;\r\n\r\n" .
		"\$contact = <<<EOT\r\n" . $contact . "\r\n" .
			"EOT;\r\n\r\n" .
		"\$reklama = <<<EOT\r\n" . $text . "\r\n" .
			"EOT;\r\n\r\n" .
		"\$copy = <<<EOT\r\n" . $acopy . "\r\n" .
			"EOT;\r\n\r\n" .
		"\$stat = <<<EOT\r\n" . $stat . "\r\n" .
			"EOT;\r\n\r\n?>";

	if (!file_put_contents("../engine/site_blok.dat", $content)) die ("Ошибка записи");
	else 
	{
		echo 'Успешно изменено. <a href="site_blok.php">Продолжить редактирование</a>';
		echo '<script type="text/javascript">setTimeout(\'location.replace("site_blok.php")\', 1000);</script>';
	}
}else{?>

<form action="" method="post">

<h1>Блок для Скриптов и стилей (между &lt;head&gt; и &lt;/head&gt; ) / блок {HEAD}</h1>
<div class="shirina"><textarea name="head" class="bloki"><?=$head;?></textarea></div>

<br><br>
<h1>Реклама / блок {REKLAMA}</h1>
<div class="shirina"><textarea name="text" class="bloki"><?=$reklama;?></textarea></div>

<br><br>
<h1>Контактная информация / блок {CONTACT}</h1>
<div class="shirina"><textarea name="contact" class="bloki"><?=$contact;?></textarea></div>

<br><br>
<h1>Нижнее Меню сайта / блок {BOTMENU}</h1>
<div class="shirina"><textarea name="text3" class="bloki"><?=$bot_menu;?></textarea></div>

<br><br>
<h1>Копирайт &copy; / блок {COPY}</h1>
<div class="shirina"><textarea name="acopy" class="bloki"><?=$copy;?></textarea></div>

<br><br>
<h1>Кнопки, статистика / блок {STAT}</h1>
<div class="shirina"><textarea name="stat" class="bloki"><?=$stat;?></textarea></div>

<br><br>
<input type="submit" value="Сохранить блоки" class="okk" name="action">
</form>

<?
}
require_once('footer.php');
?>