<?php
// Название программы: Белая КМС
// Версия: v.1.7 Free ||| URL: http://BlondeCMS.ru

require_once('header.php');
?>
	<script type="text/javascript" src="jscripts/size.js"></script>
	<h1>Редактирование шаблона</h1>
<?
echo "Редактирование шаблона /templates/<b>$mytmpl/skin.html</b><br><br>";
$myskin = file_get_contents('../templates/' .$mytmpl. '/skin.html');
if (isset($_POST['templates'])){
	$skin = stripslashes($_POST['skin']);
	if (!file_put_contents('../templates/' .$mytmpl. '/skin.html', $skin)) die ('Ошибка записи');
		else 
		{
			echo '<h1 style="color:#f00">Изменения сохранены</h1>';
			echo '<a href="">продолжить</a>';
			echo '<script type="text/javascript">setTimeout(\'location.replace("templates.php")\', 1000);</script>';
		}
	}
	else {
?>
		<form action="" method="post">
		<div class="shirina"><textarea class="bloki" id="skin" tabindex="4" name="skin"><?=$myskin;?></textarea></div><br><br>
		<input type="submit" name="templates" class="okk">
		</form>
<?
}

echo "<br>Редактирование стилей /templates/<b>$mytmpl/style.css</b><br><br>";
$mystyle = file_get_contents('../templates/' .$mytmpl. '/style.css');
if (isset($_POST['action_mystyle'])){
	$fstyles = stripslashes($_POST['fstyle']);
	if (!file_put_contents('../templates/' .$mytmpl. '/style.css', $fstyles)) die ('Ошибка записи');
		else 
		{
			echo '<h1 style="color:#f00">Изменения сохранены</h1>';
			echo '<a href="">продолжить</a>';
			echo '<script type="text/javascript">setTimeout(\'location.replace("templates.php")\', 1000);</script>';
		}
	}
	else {
?>
		<form action="" method="post">
		<div class="shirina"><textarea class="bloki" id="fstyle" tabindex="4" name="fstyle"><?=$mystyle;?></textarea></div><br><br>
		<input type="submit" name="action_mystyle" class="okk">
		</form>
<?
}

echo "<br>Редактирование меню /templates/<b>$mytmpl/menu.css</b><br><br>";
$mymenu = file_get_contents('../templates/' .$mytmpl. '/menu.css');
if (isset($_POST['action_mymenu'])){
	$fmmenu = stripslashes($_POST['fmenu']);
	if (!file_put_contents('../templates/' .$mytmpl. '/menu.css', $fmmenu)) die ('Ошибка записи');
		else 
		{
			echo '<h1 style="color:#f00">Изменения сохранены</h1>';
			echo '<a href="">продолжить</a>';
			echo '<script type="text/javascript">setTimeout(\'location.replace("templates.php")\', 1000);</script>';
		}
	}
	else {
?>
		<form action="" method="post">
		<div class="shirina"><textarea class="bloki" id="fmenu" tabindex="4" name="fmenu"><?=$mymenu;?></textarea></div><br><br>
		<input type="submit" name="action_mymenu" class="okk">
		</form>
<?
}

require_once('footer.php');
?>