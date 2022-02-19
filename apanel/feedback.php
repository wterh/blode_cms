<?php
// Название программы: Белая CMS
// Версия: v.1.7 Free
// URL: http://BlondeCMS.ru

require_once('header.php');
require_once('../settings.dat');

if (isset($_GET['id']) && !empty($_GET['id']))
{
	$f = file('../engine/messages.csv');
	$output = "";
	foreach($f as $line)
	{
		$el = explode("<!>", $line);
		if($_GET['id'] != trim($el[0])) $output .= $line; 
	}
	file_put_contents("../engine/messages.csv",$output);
}

?>

<h1>Обратная связь</h1>
<table width="100%">
<tr>
	<td width="80"><b>Дата</b></td>
	<td ><b>Имя</b></td>
	<td ><b>E-mail</b></td>
	<td ><b>Телефон</b></td>
	<td ><b>Сообщение</b></td>
	<td width="20">&nbsp;</td>
</tr>
<?php
$ff = file('../engine/messages.csv');
foreach($ff as $lin)
{
	$el = explode('<!>',$lin);
	$el[5] = str_replace("\r","<br>",$el[5]);
?>
<tr id="fontr" valign="top">
	<td><?=$el[1];?></td>
	<td><?=$el[2];?></td>
	<td><?=$el[3];?></td>
	<td><?=$el[4];?></td>
	<td style="max-width:450px; min-width:350px; padding:0 0 10px"><?=$el[5];?></td>
	<td><a href="feedback.php?id=<?=$el[0];?>"><img src="images/remove.png"></a></td>
</tr>
<?
}
echo('</table>');

require_once('footer.php');
?>