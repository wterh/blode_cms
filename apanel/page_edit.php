<?php
// Название программы: Белая CMS
// Версия: v.1.7 Free
// URL: http://BlondeCMS.ru

require('header.php');
if (isset($_GET['id'])) 
{
$id = $_GET['id'];
if (!file_exists('../engine/content/' . $id . '.dat')) die ('Искомой страницы не существует. <a href="index.php">На главную</a>');
require('../engine/content/' . $id . '.dat');
$file_menu = file('../engine/menu.csv');
foreach( $file_menu as $line )
{
	$elem = explode ('<!>', $line);
	if ( $elem[0] == $id ) 
	{
		$alias = $elem[1];
		$parent = trim($elem[3]);
		$link=$elem[2];
		$ch=$elem[4];
		$chm=$elem[5];
		$dd=$elem[6];
	}
}
?>
<h1>Редактирование страницы</h1>

<form action="page_edit.php" method="post">
<input type="hidden" name="action" value="do">
<input type="hidden" name="id" value="<?=$id;?>">

<div class="shirina"><textarea id='ckeditor1' name="text"><?=$content;?></textarea></div>
<br>
<h1>Дополнительное поле</h1>
<div class="shirina"><textarea id='ckeditor2' name="text2"><?=$subcontent;?></textarea></div>

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
    
        <section id="content1"><!-- // Вкладка Заголовки -->
<table id="polya">
<tr><td style="width:240px">Название страницы (title):</td><td><input name="title" type="text" value="<?=$page_title;?>"></td></tr>
<tr><td>Заголовок страницы (h1):</td><td><input name="h1" type="text" value="<?=$page_h1;?>"></td></tr>
<tr><td>Ссылка в меню:</td><td><input name="link" type="text" value="<?=$link;?>"></td></tr>
<tr><td>Псевдоним (alias):</td><td><input name="alias" type="text" value="<?=$alias;?>" style="width:465px"/>.html</td></tr>
<input style="display:none" name="dataleto" type="text" value="<?=$ddleto;?>">
<input style="display:none" name="data" type="text" value="<?=$dd;?>">
<tr><td>Родительская страница</td>
	<td>
  	<select name="parent">
<?
if ( $parent == 0 ) echo('<option value="0" selected>Корень меню</option>');
else echo('<option value="0">Корень меню</option>'); $k = 0;
foreach( $file_menu as $line )
{$elem[$k] = explode ("<!>", $line); $k++;}function tree($el,$parent,$ots,$count,$selected)
{for($j = 0; $j < $count; $j++){if( trim($el[$j][3]) == $parent ){if(trim($el[$j][0]) == $selected)
echo('<option value="'.$el[$j][0].'" selected>'.$ots.trim($el[$j][2]).'</option>');else	
echo('<option value="'.$el[$j][0].'">'.$ots.trim($el[$j][2]).'</option>');}}}	
tree($elem,0,"",count($file_menu),$parent);
?></select>
  </td>
</tr>
</table>

<table id="polya">
<tr><td style="width:240px; color:#777">Выбрать шаблон: <b>*</b></td><td>
<select name="tmpl">
<?
$templates=glob("../templates/*");
foreach($templates as $templ)
{
$template=str_replace('../templates/', '', $templ);
echo '<option ';
if($template == $templ) echo 'selected';
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
<b>*</b> - отключено в данной версии
<br>

       </section>  
       <section id="content2"><!-- // Вкладка Мета Теги -->
<h2>Мета Теги</h2><br>
<table id="polya">
<tr><td style="width:240px">Описание (description)<b>* </b></td><td><input name="descr" type="text" value="<?=$page_descr;?>"></td></tr>
<tr><td>Ключи (keywords)<b>* </b></td><td><input name="keyws" type="text" value="<?=$page_keyws;?>"></td></tr>
</table>
<br><br>
<b>*</b> Не обязательные поля, поисковики на них не обращяют внимания.
        </section> 
        <section id="content3"><!-- // Вкладка Магазин -->
<h2>Подключить магазин к странице</h2><br>
<table id="polya">
<tr><td style="width:120px">Включить: <b>*</b></td><td><input type="checkbox" style="width:20px"></td></tr>
<tr><td>Артикул: <b>*</b></td><td><input type="text" style="width:196px"></td></tr>
<tr><td>Цена за 1 ед.: <b>*</b></td><td><input type="text" style="width:196px"></td></tr>
</table>
        </section> 
        <section id="content4"><!-- // Вкладка Шифратор Ссылок -->
<iframe src="link.php" frameborder="0" width="100%" height="190px" marginwidth="0" marginheight="0"></iframe>
        </section>    
   </div>
</div>

<br><br>
<input type="submit" value="Сохранить изменения" class="okk">
</form>
<br>

<?
}
if (isset($_POST['action']))
{
	if (!isset($_POST['text']) || !isset($_POST['title']) || !isset ($_POST['link']) || !isset ($_POST['parent']) || !isset ($_POST['id']))
	{
		die ('Не указаны необходимые данные. <a href="index.php">На главную</a>');
	}

	$title = stripslashes($_POST['title']);
	$h1 = stripslashes($_POST['h1']);
	$descr = stripslashes($_POST['descr']);
	$keyws = stripslashes($_POST['keyws']);
	$text = stripslashes($_POST['text']);
	$text2 = stripslashes($_POST['text2']);
require('zamena.php');

	$content = "<?\r\n".
		"\$page_title = <<<EOT\r\n".$title."\r\n"."EOT;\r\n\r\n".
		"\$page_h1 = <<<EOT\r\n".$h1."\r\n"."EOT;\r\n\r\n".
		"\$page_descr = <<<EOT\r\n".$descr."\r\n"."EOT;\r\n\r\n".
		"\$page_keyws = <<<EOT\r\n".$keyws."\r\n"."EOT;\r\n\r\n".
		"\$dd = <<<EOT\r\n".$_POST['data']."\r\n"."EOT;\r\n\r\n".
		"\$ddleto = <<<EOT\r\n".$_POST['dataleto']."\r\n"."EOT;\r\n\r\n".
		"\$content = <<<EOT\r\n".$text."\r\n"."EOT;\r\n\r\n" .
		"\$subcontent = <<<EOT\r\n".$text2."\r\n"."EOT;\r\n?>";

	if (!file_put_contents("../engine/content/" . $_POST['id'] . ".dat", $content)) die ('Ошибка записи');
	else 
	{
		$csvcont='';
		$menu_file = file("../engine/menu.csv");
		$zap = false;
		foreach($menu_file as $line)
		{
			$elem = explode("<!>",$line);
			if ( $elem[0] == $_POST['id'])
			{
				$csvcont = $csvcont.$_POST['id']."<!>".$_POST['alias']."<!>".$_POST['link']."<!>".$_POST['parent']."<!><!><!>".$_POST['data']."<!>".$_POST['dataleto']."<!>\n";
				$zap = true;
			}
			else $csvcont = $csvcont.$line;
		}
		if ( !$zap ) $csvcont = $csvcont.$_POST['id']."<!>".$_POST['alias']."<!>".$_POST['link']."<!>".$_POST['parent']."<!><!><!>".$_POST['data']."<!>".$_POST['dataleto']."<!>\n";
		if(!file_put_contents('../engine/menu.csv', $csvcont)) die('Ошибка записи меню');
		echo ('<b style="color:#ff0000">Успешно изменено</b>');
		echo ('<script type="text/javascript">setTimeout(\'location.replace("page.php")\', 1000);</script>');
	}
}
require('footer.php');
?>