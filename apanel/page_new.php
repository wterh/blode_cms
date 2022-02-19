<?php
// Название программы: Белая CMS
// Версия: v.1.7 Free
// URL: http://BlondeCMS.ru

require_once('header.php');
function translitIt($z){
	$rus = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');
	$lat = array('a','b','v','g','d','e','e','zh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sh','','y','','e','yu','ya','-');
	$z = mb_strtolower($z, 'UTF-8');
	$z = (string) $z;
	$z = strip_tags($z);
	$z = str_replace(array("\n", "\r"), " ", $z);
	$z = str_replace($rus, $lat, $z);
	$z = preg_replace("/[^0-9a-z-_ ]/i", "", $z);
	$z = preg_replace("/\s+/", ' ', $z);
	return trim($z,'-');
}
if(!isset($_POST['action']))
{
	$file_menu = file('../engine/menu.csv');
?>

<form action='' method='POST'>
<input type="hidden" name="action" value="do">
<input type="hidden" name="id" value="<?=$id;?>">

<h1>Добавить страницу</h1>
<div class="shirina"><textarea id='ckeditor1' name="text" required="required"></textarea></div>

<br>
<h1>Дополнительное поле (не обязательное)</h1>
<div class="shirina"><textarea id='ckeditor2' name="text2"></textarea></div><br>

	<script src="jscripts/ckeditor/ckeditor.js"></script>
	<script> CKEDITOR.replace( 'ckeditor1' ,{
		filebrowserBrowseUrl : 'jscripts/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
		filebrowserUploadUrl : 'jscripts/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
		filebrowserImageBrowseUrl : 'jscripts/filemanager/dialog.php?type=1&editor=ckeditor&fldr=' }); 
	</script>
	<script> CKEDITOR.replace( 'ckeditor2' ,{
		filebrowserBrowseUrl : 'jscripts/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
		filebrowserUploadUrl : 'jscripts/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
		filebrowserImageBrowseUrl : 'jscripts/filemanager/dialog.php?type=1&editor=ckeditor&fldr=' }); 
	</script>

<input style="display:none" name="ddleto" id="slav-date" type="text">
<script src="jscripts/leto.js"></script>
<script>KrugoLet();</script>

<div id="container">
    <div class="tabs">
        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1">Заголовки</label>
    
        <input id="tab2" type="radio" name="tabs">
        <label for="tab2">Мета теги</label>
    
        <input id="tab3" type="radio" name="tabs">
        <label for="tab3">Магазин</label>
    
        <input id="tab4" type="radio" name="tabs">
        <label for="tab4">Шифратор</label>

        <section id="content1"> <!-- // Вкладка Заголовки -->
<table id="polya">
<tr>
  <td style="width:240px">Название страницы (title): <font color="red"><b>*</b></font></td>
  <td><input name="title" type="text" class="" required></td>
</tr>
<tr><td>Заголовок страницы (h1): <font color="red"><b>*</b></font></td><td><input name="h1" type="text" required></td></tr>
<tr><td>Текст ссылки в меню: <font color="red"><b>*</b></font></td><td><input name="link" type="text" required></td></tr>
<tr><td>Псевдоним: (alias)</td><td><input name="alias" type="text" style="width:465px">.html</td></tr>
<tr><td>Родительская страница</td>
	<td>
<?
		$k = 0;
		foreach( $file_menu as $line )
		{
			$elem = explode ("<!>", $line);
			if ( trim($elem[3]) == 0 )
			{
				$l .= '<option value="'.$elem[0].'">'.trim($elem[2]).'</option>';	
				++$k;
			}
		    
		}
?>
  	<select name="parent">
		<option selected value="0">Корень меню</option>
		<?=$l; ?>
	</select>
  </td>
</tr>
</table>

<table id="polya">
<tr><td style="width:240px; color:#777">Выбрать шаблон для страницы: <b>*</b></td><td>
<select name="tmpl">
<?php
$templates=glob("../templates/*");
foreach($templates as $templ){
$template=str_replace('../templates/', '', $templ);
echo '<option ';
	if($template == $iimpl) echo 'selected';
echo'>';
echo $template;
echo '</option>';
}
?>
</select></td>
</tr>
<tr><td style="color:#777">Отключить страницу (черновик): <b>*</b></td><td><input type="checkbox" style="width:20px"></td></tr>
<tr><td style="color:#777">Не показывать страницу в меню: <b>*</b></td><td><input type="checkbox" style="width:20px"></td></tr>
</table>

<br>
<font color=red><b>*</b></font> - Обязательно для заполнения | <b>*</b> - отключено в данной версии
<br>
       </section>  
       <section id="content2"> <!-- // Вкладка Мета Теги -->
<h2>Мета Теги</h2><br>
<table id="polya">
<tr><td style="width:240px">Описание (description)<b>* </b></td><td><input name="descr" type="text"></td></tr>
<tr><td>Ключи (keywords)<b>* </b></td><td><input name="keyws" type="text"></td></tr>
</table>
<br><br>
<b>*</b> Не обязательные поля, поисковики на них не обращяют внимания.
        </section> 
        <section id="content3"> <!-- // Вкладка Магазин -->
			<h2>Подключить магазин к странице</h2><br>
			<table id="polya">
			<tr><td style="width:120px">Включить: <b>*</b></td><td><input type="checkbox" style="width:20px"></td></tr>
			<tr><td>Артикул: <b>*</b></td><td><input type="text" style="width:196px"></td></tr>
			<tr><td>Цена за 1 ед.: <b>*</b></td><td><input type="text" style="width:196px"></td></tr>
			</table>
			<br>
			<b>*</b> - отключено в данной версии
        </section> 
        <section id="content4"> <!-- // Вкладка Шифратор Ссылок -->
			<iframe src="link.php" frameborder="0" width="100%" height="190px" marginwidth="0" marginheight="0"></iframe>
        </section>    
   </div>
</div>

<br><br><input type="submit" value="Добавить" class="okk"><br><br>
</form>


<?
}
else
{
	require_once('../engine/pagenomer.dat');
	$n = $pagenomer + 1;

	if (!isset($_POST['alias']) || empty($_POST['alias']) ){
        $_POST['alias'] = translitIt($_POST['title']);
        $_POST['alias'] = preg_replace('/[^A-Za-z0-9_\-]/', '', $_POST['alias']);
  }
  $bb=file('../engine/menu.csv') ; 
  foreach ($bb as $key=>$value) {
    $al=explode('<!>', $value);
    if ($_POST['alias']==$al[1]){
	$_POST['alias'] = $n .'-'.$_POST['alias'];
    } 	
  }

	if (!isset($_POST['text']) || !isset($_POST['title']) || !isset($_POST['alias']) || !isset($_POST['link']) || !isset($_POST['parent']) || empty($_POST['text']) || empty($_POST['alias']) || empty($_POST['title']) || empty($_POST['link']) ) 
	{
		echo("<p>Необходимо заполнить все поля<br>Сейчас вы будете автоматически возвращены на предыдущую страницу</p>
				<html>
				<head>
					<meta http-equiv='Refresh' content='20; URL = page_new.php'>
				</head>");
	}
	else
	{
		$dd=date("d.m.Y");
		$title = stripslashes($_POST['title']);
		$h1 = stripslashes($_POST['h1']);
		$descr = stripslashes($_POST['descr']);
		$keyws = stripslashes($_POST['keyws']);
		$text = stripslashes($_POST['text']);
		$text2 = stripslashes($_POST['text2']);
require_once('zamena.php');

		$content = "<?\r\n".
		"\$page_title = <<<EOT\r\n".$title."\r\n"."EOT;\r\n\r\n".
		"\$page_h1 = <<<EOT\r\n".$h1."\r\n"."EOT;\r\n\r\n".
		"\$page_descr = <<<EOT\r\n".$descr."\r\n"."EOT;\r\n\r\n".
		"\$page_keyws = <<<EOT\r\n".$keyws."\r\n"."EOT;\r\n\r\n".
		"\$dd = <<<EOT\r\n".$dd."\r\n"."EOT;\r\n\r\n".
		"\$ddleto = <<<EOT\r\n".$_POST['ddleto']."\r\n"."EOT;\r\n\r\n".
		"\$content = <<<EOT\r\n".$text."\r\n"."EOT;\r\n\r\n" .
		"\$subcontent = <<<EOT\r\n".$text2."\r\n"."EOT;\r\n?>";

		if (!file_put_contents("../engine/content/" . $n . ".dat", $content))
		{
			die ('Ошибка записи');
		}
		else
		{
			$fs=fopen('../engine/menu.csv', 'a');
			if(!fwrite($fs, $n.'<!>'.$_POST['alias'].'<!>'.$_POST['link'].'<!>'.$_POST['parent'].'<!><!><!>'.$dd.'<!>'.$_POST['ddleto']."<!>\n"))
			die("Ошибка записи в меню. <a href='index.php'>вернуться на главную</a>");
			fclose($fs);
			$nomer = "<?php \$pagenomer = '".$n."'; ?>";
			if (!file_put_contents("../engine/pagenomer.dat", $nomer)) die ('Ошибка записи в файл pagenomer.dat');
			echo ('<b style="color:#ff0000">Страница создана</b>');
			echo ('<script>setTimeout(\'location.replace("page.php")\', 1000);</script>');
		}	
	}
}

require_once('footer.php');
?>