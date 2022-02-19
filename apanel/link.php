<?php
// Название программы: Белая CMS
// Версия: v.1.7.2 Free
// URL: http://BlondeCMS.ru
?>

<head>
<meta charset="UTF-8">
<style>
*:focus {outline: none}
*{margin: 0; padding: 0px; font:normal 12px verdana}
.pole{width:800px; margin:3px 0 0 ; padding:2px 5px 5px; border:2px solid #e3e3e3; font:normal 14px verdana}
.button{margin: 10px 5px; padding:2px 10px; background:url(images/okk.png); border:1px solid #e3e3e3; cursor:pointer}
</style>
 </head>
<body>
 <table border="0" >
	<tr>
		<td>
 Введите адрес ссылки:
 <p>
	<form action="<?=($_SERVER['PHP_SELF']);?>" method="post">
		<input type="text" name="text" class="pole">
<br>
		<input type="submit" name="submit" value="ОК" class="button">
		<input type="reset" value="Очистить" class="button">
  </form>
 </p>

<?
error_reporting(0);
$text = $_POST['text'];

 if($text == '') {
  die("<p>Заполните форму!</p>");
}
 $text = urldecode(stripslashes($text));
 $orig_text = $text;
 echo("<p>Скопируйте код ссылки:</p>");

 $text = base64_encode($text);

//вывод ссылки
$site="http://".$_SERVER['SERVER_NAME'];
echo("<input type=\"text\" class=\"pole\" value=\"$site/engine/go.php?url=$text\">");

?>
		</td>
	</tr>
	</table>

</body>
</html>