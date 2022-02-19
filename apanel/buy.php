<?php
// Название программы: Белая CMS
// Версия: v.1.7 Free
// URL: http://BlondeCMS.ru

require_once('header.php');
require_once('../settings.dat');
?>
	<h1>Список заказов</h1>
<table width="100%">
<tr>
	<td width="80"><b>Дата</b></td>
	<td width="90"><b>Ф.И.О.</b></td>
	<td width="150"><b>Наименование</b></td>
	<td width="67"><b>Артикул</b></td>
	<td width="30"><b>Кол</b></td>
	<td width="50"><b>Цена.</b></td>
	<td width="100"><b>E-mail</b></td>
	<td width="110"><b>Телефон</b></td>
	<td ><b>Сообщение по заказу</b></td>
	<td width="20"><img src="images/remove.png"></td>
</tr>
</table>

<br><br>
	<h1>Добавление текста на страницу оформления заказа</h1>

<form method="post" action="#">

	<script src="jscripts/ckeditor/ckeditor.js"></script>
	<div class="shirina"><textarea id='editor1' name="content"><h1 style="color:#f00">В данной версии модуль отключен</h1></textarea></div>
<br>
<script>
var ckeditor1 = CKEDITOR.replace('editor1');
DjenxExplorer.init({
	returnTo: ckeditor1,
	lang : 'ru'
});
</script>
		<br><br>
		<input type="" value="Сохранить" class="okk" style="width:90px;">
		</form>
<?
require_once('footer.php');
?>