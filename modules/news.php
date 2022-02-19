<?php
// Название программы: Белая CMS
// Версия: v. 1.7
// URL: http://BlondeCMS.ru

error_reporting(E_ALL);
ob_start();
$data_blok = '0';
$page_h1 = 'Наши новости';
$page_title = 'Наши новости';
$page_descr = 'новости нашего сайта';
$page_keyws = 'новости нашего сайта';
$path = ' <small>&raquo;</small> <a href="">Наши новости</a>';

require("settings.dat");
$f = array_reverse(file("./engine/news.dat"));
foreach($f as $line)
{
	$el = explode("<!>",$line);
	if($num_data == '2') $leto=$el[1]; else $leto=$el[4]; 
	echo('<div class="dat">'.$leto.'</div>');
	echo('<div class="news"><p><b>'.$el[2].'</b></p>'.$el[3].'</div>');
	$subcontent = 'Все новости сайта';
}
$content = ob_get_contents();
ob_end_clean();
?>