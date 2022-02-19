<?php
// Название программы: Белая CMS
// Версия: v.1.7 Free
// URL: http://BlondeCMS.ru

require_once('header.php');
if (!isset($_POST['action'])){
?>
	<h1>Редактирование настроек</h1>
<div id="as">
<form action="" method="post">
<input type="hidden" name="action" value="do">
<table id="ast">
<tr id="fontr">
	<td>URL домена / пример: <?=$_SERVER['SERVER_NAME'];?> </td>
	<td style="width:260px">
<? if($mysite == ''){$mysite = $_SERVER['SERVER_NAME'];} ?>
	<input name="mysite" type="text" value='<?=$mysite;?>'></td>
</tr>
<tr id="fontr">
	<td>Используемый шаблон по умолчанию:</td><td>
<select name="tmpl">

<?
$templates=glob("../templates/*");
foreach($templates as $templ){
$template=str_replace('../templates/', '', $templ);
echo '<option ';
if($template == $mytmpl) echo 'selected';
echo '>';
echo $template;
echo '</option>';
}
?>
</select></td>
</tr>
<tr id="fontr"> <? $ip = $_SERVER["REMOTE_ADDR"]; $ip2 = explode(".", $ip); if($myip == ''){$myip = "$ip2[0].$ip2[1].";}?>
	<td>Доступ в Админ Панель по IP / текущий IP <?=$ip;?></td>
	<td>
		<select name="ip_ok">
		<option <?=($ip_ok == 1?'selected':'')?> value="1">Проверять IP</option>
		<option <?=($ip_ok == 2?'selected':'')?> value="2">Не проверять</option>
		</select>
	</td>
</tr>
<tr id="fontr">
	<td>Так как IP обычно плавающий, то IP проверяется по подсети до второй точки <?=$ip2[0].'.'.$ip2[1].'.';?></td>
	<td>
	<input name="myip" type="text" value='<?=$myip;?>'></td>
</tr>
<tr id="fontr">
	<td>Количество кратких описаний статьи на страницу: <b>*</b></td>
	<td>
	<input name="article_sort" type="text" value='10'></td>
</tr>
<tr id="fontr">
	<td>Выводить на сайте блок последних статей (выводится на всех страницах сайта) <b>*</b></td>
	<td>
		<select name="art_bloc">
		<option value="1">Выводить</option>
		<option value="2">Не выводить</option>
		</select>
	</td>
</tr>
<tr id="fontr">
	<td>Количество ссылок на статьи в блоке последних статей <b>*</b></td>
	<td>
	<input name="art_bloc_sort" type="text" value='3'></td>
</tr>
<tr id="fontr">
	<td>Блокировать посетителей с браузером IE до 9 версии</td>
	<td>
		<select name="ie_bloc">
		<option <?=($ie_bloc == 1?'selected':'')?> value="1">Блокировать</option>
		<option <?=($ie_bloc == 2?'selected':'')?> value="2">Не блокировать</option>
		</select>
	</td>
</tr>
<tr id="fontr">
	<td>Дата выводимая на страницах сайта</td>
	<td>
		<select name="num_data">
		<option <?=($num_data == 1?'selected':'')?> value="1">Дата от С.М.З.Х.</option>
		<option <?=($num_data == 2?'selected':'')?> value="2">Дата от обрезания Х.</option>
		</select>
	</td>
</tr>
<tr id="fontr">
	<td>Имя Администратора:</td>
	<td>
	<input name="aut_name" type="text" value='<?=$aut_name;?>'></td>
</tr>
<tr id="fontr">
	<td>E-mail администратора:</td>
	<td><input name="admin_email" type="text" value='<?=$admin_email;?>'></td>
</tr>
</table>
<br>
<b>*</b> - Не доступно в данной версии
<br><br>
<input type="submit" value="Cохранить изменения" class="okk">
</form>
</div>

<?
}
else
{
	if (!isset($_POST['aut_name']) || !isset($_POST['admin_email']) || empty($_POST['aut_name']) || empty($_POST['admin_email']))
	{
		echo ("Некоторые из настроек пропущены. <a href='settings.php'>Ввести ещё раз</a>"); require("footer.php"); exit;
	}
	if (!file_exists("../templates/" . $_POST['tmpl'] . "/skin.html")) die ("Файл skin.html указанного шаблона не найден. <a href='settings.php'>Ввести ещё раз</a>");

	$aaut_name = stripslashes($_POST['aut_name']);
	$acopy = stripslashes($_POST['copy']);
	$set = "<?
\$mysite='" . $_POST['mysite'] . "';
\$mytmpl='" . $_POST['tmpl'] . "';
\$ip_ok='".$_POST['ip_ok']."';
\$myip='".$_POST['myip']."';
\$ie_bloc='".$_POST['ie_bloc']."';
\$num_data='".$_POST['num_data']."';
\$aut_name = <<<EOT\r\n".$aaut_name."\r\n"."EOT;
\$admin_email = '".$_POST['admin_email']."'; 
?>";
	if (!file_put_contents("../settings.dat", $set)) 
	{
		echo('Запись в файл не удалась. <a href="index.php">На главную</a>');
	}
	else 
	{
		echo('Настройки записаны успешно. <a href="index.php">На главную</a>');	
		echo ('<script type="text/javascript">setTimeout(\'location.replace("settings.php")\', 1000);</script>');
	}
}

require('footer.php');
?>
