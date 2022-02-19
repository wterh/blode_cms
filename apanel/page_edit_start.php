<?php
// Название программы: Белая CMS
// Версия: v.1.7.2 Free
// URL: http://BlondeCMS.ru

require_once('header.php');

if(!file_exists('../engine/content/start.dat')) die ('Искомой страницы не существует. <a href="index.php">На главную</a>');
require_once('../engine/content/start.dat');

if(isset($_POST['action'])){
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
		"\$dd = <<<EOT\r\n".$_POST['data']."\r\n"."EOT;\r\n\r\n".
		"\$ddleto = <<<EOT\r\n".$_POST['ddleto']."\r\n"."EOT;\r\n\r\n".
		"\$content = <<<EOT\r\n".$text."\r\n"."EOT;\r\n\r\n".
		"\$subcontent = <<<EOT\r\n".$text2."\r\n"."EOT;\r\n?>";

	if (!file_put_contents("../engine/content/start.dat", $content)) die ("Ошибка записи");
		echo '<b style="color:#f00">Успешно изменено</b>';
		echo '<script type="text/javascript">setTimeout(\'location.replace("page.php")\', 1000);</script>';
}else{
?>
<h1>Редактирование страницы</h1>

<form action="" method="post">
<input type="hidden" name="action">

<div class="shirina"><textarea id='ckeditor1' name="text"><?=$content;?></textarea></div>
<br>
<h1>Дополнительное поле</h1>
<div class="shirina"><textarea id='ckeditor2' name="text2"><?=$subcontent;?></textarea></div>
<br>
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
    
        <input id="tab4" type="radio" name="tabs">
        <label for="tab4">Шифратор</label>
    
        <section id="content1"><!-- // Вкладка Заголовки -->
<table id="polya">
<tr><td style="width:240px">Название страницы (title):</td><td><input name="title" type="text" value="<?=$page_title;?>"></td></tr>
<tr><td>Заголовок страницы (h1):</td><td><input name="h1" type="text" value="<?=$page_h1;?>"></td></tr>

<?
if($ddleto == '' or $dd == '') {$startddleto = 'id="slav-date"'; $dd = date("d.m.Y");}
?>

<input style="display:none" name="ddleto" type="text" <?=@$startddleto;?> value="<?=$ddleto;?>">
<input style="display:none" name="data" type="text" value="<?=$dd;?>">
<script src="jscripts/leto.js"></script>
<script>KrugoLet();</script>

</table>
<table id="polya">
<tr><td style="width:240px; color:#777">Выбрать шаблон: <b>*</b></td><td>
<select name="tmpl">
<?php
$templates=glob("../templates/*");
foreach($templates as $templ)
{
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
</table>
<br>
<font color="red"><b>*</b></font> - Обязательно для заполнения | <b>*</b> - отключено в данной версии
       </section>  
       <section id="content2"> <!-- // Вкладка Мета Теги -->
<h2>Мета Теги</h2><br>
<table id="polya">
<tr><td style="width:240px">Описание (description)<b>* </b></td><td><input name="descr" type="text" value="<?=$page_descr;?>"></td></tr>
<tr><td>Ключи (keywords)<b>* </b></td><td><input name="keyws" type="text" value="<?=$page_keyws;?>"></td></tr>
</table>
<br><br>
<b>*</b> Не обязательные поля, поисковики на них не обращяют внимания.
        </section> 
        <section id="content4"><!-- // Вкладка Шифратор Ссылок -->
<iframe src="link.php" frameborder="0" width="100%" height="190px" marginwidth="0" marginheight="0"></iframe>
        </section>    
   </div>
</div>



<br><input type="submit" value="Сохранить" class="okk">
</form>


<br>


<?
}
require('footer.php');
?>