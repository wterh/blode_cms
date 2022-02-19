<?php
// Название программы:  Белая CMS
// Версия: v.1.5.4
// URL: http://BlondeCMS.ru

ob_start();
$data_blok = '0';
$page_h1 = 'Карта сайта';
$page_title = 'Карта сайта';
$page_descr = 'Карта сайта';
$page_keyws = 'Карта сайта';
$path = ' <small>&raquo;</small> <a href="">карта сайта</a>';
$subcontent = 'Все страницы сайта';
$fm = file("engine/menu.csv");
	$k = 0;
	foreach($fm as $line){
		$elem[$k] = explode ("<!>", $line);
		$k++;
	}   
	function tree($it,$parent,$pm,$count){
		for($j = 0; $j < $count; $j++){
			if(trim($it[$j][3]) == $parent){
				if ($it[$j][4]!=on) echo "<a href=".$it[$j][1].".html>".$pm.trim($it[$j][2])."</a><br />";
				tree($it,$it[$j][0],$pm."<small>&raquo;</small> ",$count);
			}
		}
	}
?>
<div style="margin:15px 20px">
<?
@tree($elem,0,"",count($fm));
echo '<a href="./news.html">Новости</a><br />';
echo '<a href="./feedback.html">Контакты</a><br />';
echo '<a href="./map.html">Карта сайта</a><br /><br />';
?>
</div>
<?
$content = ob_get_contents();
ob_end_clean();
?>