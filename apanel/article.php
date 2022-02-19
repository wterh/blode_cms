<?php
// Название программы: Белая CMS
// Версия: v.1.7 Free
// URL: http://BlondeCMS.ru

require('header.php');
?>
	<h1>Список созданных статей</h1>
	<b style="color:#ff0000">Модуль статей в данной версии отключен</b><br><br>

<table width="100%">
<tr>
	<td width="50"><b>ID</b></td>
	<td width="100"><b>Дата</b></td>
	<td ><b>Ссылка на полную статью</b></td>
	<td ><b>Заголовок статьи (H1)</b></td>
	<td width="19"><img src="images/edit.png" title="Редактировать"></td>
	<td width="19"><img src="images/remove.png" title="Удалить статью"></td>
</tr>
</table>

<br><br><br>
<a class="ok"><img src="images/032.png"> Добавить статью</a>

<?
require('footer.php');	
?>