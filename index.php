<?php
// Название программы: Белая КМС
// Версия: v.1.7 Free ||| 05.07.2014
// URL: http://BlondeCMS.ru

error_reporting(E_ALL);
if(strpos($_SERVER['REQUEST_URI'],'?')) die();
if(strpos($_SERVER['REQUEST_URI'],'php')) die();
require('settings.dat');
if($ie_bloc == '1'){
	function BlocIE(){
	    $user_agent = $_SERVER['HTTP_USER_AGENT'];
	    $IEshka = false;
		if(stristr($user_agent, 'MSIE 8.0')) $IEshka = true;
	    if(stristr($user_agent, 'MSIE 7.0')) $IEshka = true;
	    if(stristr($user_agent, 'MSIE 6.0')) $IEshka = true;
	    if(stristr($user_agent, 'MSIE 5.0')) $IEshka = true;
	    return $IEshka;
	}
	if (BlocIE()){
	echo ' У вас запрещённый во многих странах браузер! <a href="http://www.mozilla.org/ru/firefox/fx/">Установи нормальный браузер!</a>'; 
	Exit;
	}
}
if($mysite <> ''){
	if($mysite <> $_SERVER['SERVER_NAME']) {die('Адрес сайта не соответствует настройкам');}
	$site = $mysite;
}else{
	$site = $_SERVER['SERVER_NAME'];
}
require('modules/i.dat');
?>
