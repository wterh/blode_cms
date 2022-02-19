<?php
// Название программы: Белая CMS
// Версия: v.1.7 Free
// URL: http://BlondeCMS.ru

require('header.php');
if(!isset($_GET['id'])) die('Не задана страница для удаления');
if(unlink('../engine/content/'.$_GET['id'].'.dat'))
{
	echo '<b style="color:#ff0000">Страница '.$_GET['id'].' успешно удалена.</b><br />';
	
	$csvcont=''; 
	$menu_file = file("../engine/menu.csv");
	foreach($menu_file as $line)
	{
		$elem = explode("<!>",$line);
		if ( $elem[0] != $_GET['id']) $csvcont = $csvcont.$line;
	}
	if($csvcont!='')
	{
		if(!file_put_contents('../engine/menu.csv', $csvcont)) die('Ошибка записи меню');
	}
	else
	{
		$fs=fopen('../engine/menu.csv', 'w');
		fclose($fs);
	}
	// если удалось записать, то перекидываем
	echo ("<script type=\"text/javascript\">setTimeout('location.replace(\"page.php\")', 1000);</script>");
	
}
else echo 'Ошибка удаления...';

require('footer.php');
?>