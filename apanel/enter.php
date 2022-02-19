<?php
// Название программы: Белая CMS
// Версия: v.1.7.2 Free
// URL: http://BlondeCMS.ru

error_reporting(E_ALL);
if(strpos($_SERVER['REQUEST_URI'],'admin')) die('<h2>Не допустимый адрес Админ Панели, переименуйте папку</h2>');
$site = $_SERVER['SERVER_NAME'];

$prava = array('../settings.dat', '../engine/menu.csv', '../engine/messages.csv', '../engine/news.dat', '../engine/pagenomer.dat', '../engine/site_blok.dat', '../engine/usernomer.dat', '../engine/content', '../engine/content/start.dat');
$pr = '';
foreach($prava as $fail){
	if(!is_writable($fail)) $pr .= $fail.'<br>';
}
if($pr != ''){
	$pr = str_replace('..',$site,$pr);
	echo '<p style="margin:0; padding:0; font:18px verdana">Нет прав записи в:<br>'.$pr.'</p>';	exit;
}

require_once('../engine/usernomer.dat');
if($uservhod == '' or $uservhod <= '0' or $uservhod > '5') die('<h1>Заблокировано</h1> <a href="//'.$site.'/info.htm">Читаем FAQ по разблокировке</a>');

$apanelpage = array('article', 'buy', 'exit', 'feedback', 'footer', 'header', 'index', 'link', 'news', 'page', 'page_delete', 'page_edit', 'page_edit_start', 'page_new', 'session', 'settings', 'site_blok', 'templates', 'user_pass', 'zamena');
$ap = '';
foreach($apanelpage as $fail){
	if(!file_exists($fail.'.php')) $ap .= $fail.'.php<br>';
}
if($ap != ''){
	echo '<p style="margin:0; padding:0; font:18px verdana">Нет файла админ панели:<br>'.$ap.'</p>';	exit;
}

require_once('../settings.dat');
$ip = explode('.', $_SERVER["REMOTE_ADDR"]);
$ip = "$ip[0].$ip[1].";
if($myip == '') $myip = '127.0.0.1';
$i = explode('.', $myip);
$i = "$i[0].$i[1].";

if($_SERVER["REMOTE_ADDR"] <> '127.0.0.1'){
	if ($ip_ok == 1 and $myip <> ''){
		if($ip <> $i) die ('Ошибка подключения к MySQL');
	}
}
require('user_pass.php');
if(isset($_POST['login'])){
	if($_POST['login'] <> $login or $_POST['pass'] <> $pass){
		if($uservhod <> '0' or $uservhod <> ''){
			$uservhod = $uservhod - 1;
			$nomer = "<?php\r\n//	Поставьте 1 - 5 попыток \r\n\$uservhod = '$uservhod'; \r\n\r\n?>";
			if(!file_put_contents('../engine/usernomer.dat', $nomer)) die('Ошибка записи в usernomer.dat');
			if($uservhod == '0') die('<h1>Заблокировано</h1> <a href="//'.$site.'/info.htm">Читаем FAQ по разблокировке</a>');
			elseif($uservhod == '1'){
			$uservhod = '<h2>До блокировки осталась '.$uservhod.' попытка</h2>';
			}
			else{
				$uservhod = '<h2>До блокировки осталось '.$uservhod.' попытки</h2>';
			}
		}
		die('Вы ошиблись, <a href="enter.php">попробуйте ещё</a>. '.$uservhod );
	}
	else{
		$nomer = "<?php \$uservhod = '5'; ?>";
		if(!file_put_contents('../engine/usernomer.dat', $nomer)) die('Ошибка записи в usernomer.dat');
		$_SESSION['blonde'] = true;
		header('Location: index.php');
	}
}else{
	require_once('enter.html');
	die();
}

?>
