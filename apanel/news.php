<?php
// Название программы: BlondeCMS
// Версия: v.1.7.3 Free
// URL: http://BlondeCMS.ru

require_once('header.php');

if(isset($_GET['id']) && !empty($_GET['id']) )
{
	$message_array = file('../engine/news.dat');
	$output = "";
	foreach( $message_array as $line )
	{
		$elem = explode('<!>', $line);
		if($_GET['id'] != trim($elem[0])) $output .= $line; 
	}
	file_put_contents('../engine/news.dat',$output);
}
?>
	<script src="jscripts/ckeditor/ckeditor.js"></script>
<h1>Страница добавления кратких новостей на сайт</h1>
<br>
<form action='' method='POST'>

<span style="color:#FF0000;">*</span> <b>Название новости</b>:<br>
<div class="shirina"><input type="text" name="name" id="inews"></div>
<br>
<span style="color:#FF0000;">*</span> <b>Текст новости</b>:
<br>
<input type="hidden" name="action" value="do">
<div class="shirina"><textarea id='ckeditor1' name="text"></textarea></div>
<br>
	<script> CKEDITOR.replace( 'ckeditor1' ,{
		filebrowserBrowseUrl : 'jscripts/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
		filebrowserUploadUrl : 'jscripts/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
		filebrowserImageBrowseUrl : 'jscripts/filemanager/dialog.php?type=1&editor=ckeditor&fldr=' }); 
	</script>

<input style="display:none" name="ddleto" id="slav-date" type="text">
<script src="jscripts/leto.js"></script>
<script>KrugoLet();</script>

<input type="submit" value="Опубликовать" name="submit" class="okk">
</form>
<br><br>

<?
if ( isset($_POST['submit']))
{
	$error = '';
	if ( isset($_POST["name"]) && !empty($_POST["name"])) $name = $_POST["name"]; else $error .= "<li>Не введено название новости</li>";
	if ( isset($_POST["text"]) && !empty($_POST["text"])) $text = $_POST["text"]; else $error .= "<li>Не введён текст новости</li>";

	$text = stripslashes($_POST['text']);
	$name = stripslashes($_POST['name']);
	$text = str_replace('<a href="/upload/file/','<a href="http://{SITE}/upload/file/',$text);
	$text = str_replace('<a href="/upload/','<a class="highslide" onclick="return hs.expand(this)" href="/upload/',$text);
	$text = str_replace("\n"," ",$text);
	$ddleto = stripslashes($_POST['ddleto']);
 	
 	if(!empty($error) ) echo("<ul style='color:red;'>".$error."</ul>");
	else
	{
		$file = file("../engine/news.dat");
		$max = 0;
		foreach( $file as $line)
		{	
			if ( !empty($line) )
			{	
				$elem = explode("<!>",$line);
				if ( $elem[0] > $max) $max = $elem[0];	
			}
		}
		$max++;
		if (is_writeable("../engine/news.dat"))
	   	{
	    	$d=date("d.m.Y");  
	    	$f=fopen("../engine/news.dat","a+");
	    	$write_text = "$max<!>$d<!>$name<!>$text<!>$ddleto<!> \n";
	    	fputs($f,$write_text);
	    	fclose($f);
	    	
	   }
	   else echo("<font color=red>Не удалось записать в файл</font>"); 
	}	
} 
?>
<h1>Опубликованные новости:</h1>
<table width="100%">
<tr>
	<td width="30px"><b>№</b></td>
	<td width="120px"><b>Дата от С.М.З.Х.</b></td>
	<td width="110px">Дата</td>
	<td width="250px"><b>Заголовок</b></td>
	<td ><b>Текст новости</b></td>
	<td width="20">&nbsp;</td>
</tr>
<?php
$newss = array_reverse(file("../engine/news.dat"));
foreach($newss as $line)
{
	$elem = explode("<!>",$line);
?>
<tr style="background-color:#f5f5f5">
	<td><?=$elem[0];?></td>
	<td><?=$elem[4];?> л&#1123;то</td>
	<td><?=$elem[1];?></td>
	<td><?=$elem[2];?></td>
	<td><?=$elem[3];?></td>
	<td><a href="news.php?id=<?=$elem[0];?>"><img src="images/remove.png"></a></td>
</tr>	
<?
}
echo('</table><br><br>');

require_once('footer.php');
?>