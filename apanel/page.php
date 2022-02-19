<?php
// Название программы: Белая CMS
// Версия: v.1.7 Free
// URL: http://BlondeCMS.ru

require('header.php');
if(isset($_GET['action']) && !empty($_GET['action'])) 
{
	$action = trim($_GET['action']);
	if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = trim($_GET['id']);
		if($action == "up") 
		{
			$fi = file("../engine/menu.csv");
			$i = 1;
			foreach($fi as $line)
			{
				$el = explode("<!>",$line);
				if ($el[0] == $id) $key = $i;
				++$i;
			}
			if($key > 0 && $key != 1)
			{
					$key--;
					$contmenu = "";
					for($i = 0; $i <= $key - 2; $i++) 
					{
						$contmenu = $contmenu.$fi[$i];
					}
					$contmenu = $contmenu.$fi[$key];
					$contmenu = $contmenu.$fi[$key - 1];
					for($i = ($key + 1); $i < count($fi); $i++)
					{
						$contmenu = $contmenu.$fi[$i];	
					}
					if(!file_put_contents('../engine/menu.csv',$contmenu)) die('Ошибка записи меню');
			}
		}
		elseif($action == "down")
		{
			$fi = file("../engine/menu.csv");
			$i = 1;
			foreach($fi as $line)
			{
				$el = explode("<!>",$line);
				if ( $el[0] == $id) $key = $i;
				++$i;
			}
			if($key > 0 && $key < count($fi))
			{
					$key--;
					$contmenu = "";
					for($i = 0; $i <= $key - 1; $i++)
					{
						$contmenu = $contmenu.$fi[$i];
					}
					$contmenu = $contmenu.$fi[$key + 1];
					$contmenu = $contmenu.$fi[$key];
					for($i = ($key + 2); $i < count($fi); $i++)
					{
						$contmenu = $contmenu.$fi[$i];	
					}
					if(!file_put_contents('../engine/menu.csv',$contmenu)) die('Ошибка записи меню');
			}	
		}
	}
}
require('../engine/content/start.dat');
?>

<script type="text/javascript">
<!--
function confirmation(deletfile){
	var answer = confirm("Вы действительно хотите удалить страницу?");
	if (answer){
		window.location = "page_delete.php?id="+deletfile;
	}
}//-->
</script>
	<h1>Список созданных страниц</h1>

<table width="100%">
<tr>
	<td width="50">ID</td>
	<td width="120">Дата от С.М.З.Х</td>
	<td width="120">Дата</td>
	<td width="100">ID родителя</td>
	<td >Название ссылки в меню</td>
	<td width="19"></td>
	<td width="18"></td>
	<td width="18"></td>
	<td width="19"></td>
	<td width="19"></td>
	<td width="19"></td>
</tr>
<tr id="fontr">
	<td><p style="margin:3px">start</p></td>
	<td><?=$ddleto;?> л&#1123;то</td>
	<td><?=$dd;?> год</td>
	<td></td>
	<td>Главная</td>
	<td><a href=page_edit_start.php><img src="images/edit.png" title="Редактировать"></a></td>
	<td><img src=images/up.png style="opacity:0.2"/></td>
	<td><img src=images/down.png style="opacity:0.2"/></td>
	<td><img src=images/glaz.png title="Отображается в меню"></td>
	<td><img src=images/lamp.png title="Страница включена"></td>
	<td></td>
</tr>
<?
$fm = file("../engine/menu.csv");
	$k = 0;
	foreach($fm as $line){
		$elem[$k] = explode("<!>", $line);
		$k++;
	}
	function tree($it,$parent,$pm,$count){
		for($j = 0; $j < $count; $j++){
			if(trim($it[$j][3]) == $parent){
	if($it[$j][4]=='on'){
		$img1='hide.png'; 
		$tit1='Не отображается в меню';
		}else{
			$img1='glaz.png';
			$tit1='Отображается в меню';
			}
	if($it[$j][5]=='on'){
		$img2='lamp_off.png';
		$tit2='Страница отключена';
		}else{
			$img2='lamp.png';
			$tit2='Страница включена';
	}  
	if($it[$j][3]=='0'){
		$it[$j][3] = '';
	}
?>

<tr id="fontr">
	<td><p style="margin:3px"><?=$it[$j][0];?></p></td>
	<td><?=$it[$j][7];?></td>
	<td><?=$it[$j][6];?></td>
	<td><?=$it[$j][3];?></td>
	<td><a href="../<?=$it[$j][1];?>.html" target="_blank"><?=$pm.trim($it[$j][2]);?></a></td>
	<td><a href="page_edit.php?id=<?=$it[$j][0];?>"><img src="images/edit.png" title="Редактировать"></a></td>
	<td><a href="?action=up&id=<?=$it[$j][0];?>"><img src="images/up.png" title="Вверх"></td>
	<td><a href="?action=down&id=<?=$it[$j][0];?>"><img src="images/down.png" title="Вниз"></a></td>
	<td><img src="images/<?=$img1;?>" title="<?=$tit1;?>"></td>
	<td><img src="images/<?=$img2;?>" title="<?=$tit2;?>"></td>
	<td><a href="#" onclick="confirmation(<?=$it[$j][0];?>)"><img src="images/remove.png" title="Удалить страницу <?=$it[$j][0];?>"></a></td>
</tr>
<?
			tree($it,$it[$j][0],$pm."&nbsp; &nbsp; ",$count);
			}
		}
	}
	tree(@$elem,0,"",count($fm));
?>
</table>
<br />
<a href="page_new.php" class="ok"><img src="images/032.png"> Добавить страницу</a>

<?php
require('footer.php');	
?>