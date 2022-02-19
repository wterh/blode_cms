<?php
// Название программы: BlondeCMS
// Версия: v.1.7.3 ||| URL: http://BlondeCMS.ru

error_reporting(0);
ob_start();
session_start();
$data_blok = '0';
$page_h1 = 'Обратная связь';
$page_title = 'Напишите нам и мы ответить Вам в самое ближайшее время';
$page_descr = 'Обратная связь';
$page_keyws = 'Обратная связь';
$subcontent = '<p>Постарайтесь написать Ваше сообщение максимально информативно изложенным. <br>Мы ответим вам, как можно быстрее.</p>';
$path = ' &raquo; <a href="">Наши координаты, связь</a>';
$text=$name=$email=$_tel='';

if(isset($_POST['submit']))
{
	$error = "";
	if($_POST["name"]) $name = $_POST["name"]; else $error .= '<li style="color:#f00">Не введено имя</li>';
	if($_POST["email"]) $email = $_POST["email"]; else $error .= '<li style="color:#f00">Не введен E-mail</li>';
	if($_POST["_tel"]) $_tel = $_POST["_tel"]; // не проверяем телефон 	// else $error .= '<li style="color:#f00">Не введен номер телефона</li>';	
	if($_POST["text"]) $text = $_POST["text"]; else $error .= '<li style="color:#f00">Не введён текст сообщения</li>';

	if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring']);
		else $error .= '<li style="color:#f00">Не верный код с рисунка</li>';
		
	if(strlen($text) > 6000) $error.='<li>Максимальная длинна сообщения 3000 символов</li>';
	if(strlen($name) > 70) $error.='<li>Максимальная длинна имени 60 символов</li>';
	if(strlen($email) > 60) $error.='<li>Максимальная длинна Email 60 символов</li>';

	$text  = stripslashes(htmlspecialchars($text));
	$name  = stripslashes(htmlspecialchars($name));
	$email = stripslashes(htmlspecialchars($email));
	$_tel   = stripslashes(htmlspecialchars($_tel));
	$text = str_replace("<?","вопрос",$text);
	$text = str_replace("<iframe","фрейм",$text);
	$text = str_replace("$","toilet paper",$text);
	$text = str_replace("script","Скрипт",$text);
	$text = preg_replace('/([^\s]{40})/' , "$1 ", $text);
	$text = str_replace("\n","",$text);
	if ( !preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i",$email) && trim($email) != "" ) 
		$error = $error.'<li>Неправильно введён E-mail!</li>';
 	
 	if ($error) echo('<h3>Исправьте выделенные поля</h3><ul style="margin:10px 20px; padding:10px; border-left:5px solid #f00; background:#fafafa">'.$error.'</ul>');
	else // записываем в файл
	{
		// вычисляем номер последней записи
		$file = file('engine/messages.csv');
		$max = 0;
		foreach( $file as $line)
		{	
			if($line)
			{	
				$elem = explode('<!>',$line);
				if ( $elem[0] > $max) $max = $elem[0];	
			}
		}
		$max++;
		if (is_writeable('engine/messages.csv')){
	    	$d=date("d.m.Y H:i");
	    	$write_text = "$max<!>$d<!>$name<!>$email<!>$_tel<!>$text \n";
			file_put_contents('engine/messages.csv', $write_text, FILE_APPEND | LOCK_EX);
// отправдяем письмо
		$headers  = "Content-type: text/html; charset=UTF-8 \r\n";
		$headers .= "From: $email <$email>\r\n";

	$text = str_replace("\r","<br>",$text);
	$final_text = '<br><br><h2>Вы писали:</h2> <p style="margin:10px 20px; padding:10px; border-left:5px solid #00a000; background:#f5f5f5">'.$text.'</p>';

		if (!mail($admin_email,"Cообщение c $site"," Имя: " .$name."<br>Email: ".$email."<br>Тел: ".$_tel."<br><br>Текст сообщения: ".$text,$headers)){
    			echo('<br><b style="font:20px verdana; color:#009000">Сообщение сохранено! Спасибо!</b>');
				echo $final_text;
		}else{
				echo('<br><b style="font:20px verdana; color:#009000">Сообщение отправлено! Спасибо!</b>');
				echo $final_text;

		$mailtext= ("
<table width=\"100%\"><tr><td>
<img src=\"cid:my-attach\"></td>
<td align=\"right\"><div style=\"font-size:18px; font-family:verdana;\">BlondeCMS.ru<br>тел: +7 (xxx) xxx-xx-xx </div></td></tr></table>
<div style=\"padding:3px; background-color: #e2e2e2;\"><b>Здравствуйте, $name</b>!</div><br>
Мы получили ваше письмо.<br>
Вы писали:<br><br>
Имя: $name<br>
Email: $email<br>
Тел: $_tel<br>
Текст: $text<br><br>
==<br>
Это письмо создано автоматически, не нужно на него отвечать<br>
С уважением, Администратор <a href=\"http://$site\">$site</a><br> "); 

	require 'PHPMailer.php';
	require 'POP3.php';
	$mail = new PHPMailer();
	$mail->From = $admin_email;
	$mail->FromName = 'Админ';
	$mail->CharSet='UTF-8';  
	$mail->AddAddress($email, $name);
	$mail->IsHTML(true);        
	if (!$mail->AddEmbeddedImage('img/logo.jpg', 'my-attach', 'logo.jpg', 'base64', 'image/jpg')) die ($mail->ErrorInfo);
	$mail->Subject = 'Подтверждение';
	$mail->Body = $mailtext;
	$text='';
	if (!$mail->Send()) die ('Mailer Error: '.$mail->ErrorInfo);
	}
  }else echo('<br><b style="color:#f00">Не удалось записать в файл</b>');
  }
}
?>
<br><br>
<div id="forma">
<form action='' method='POST'>

<span style="color:#FF0000;font-size:10pt">*</span> Ваше Имя:
<input type="text" name="name" value="<?=$name;?>" maxlength="40" required>

<span style="color:#FF0000;font-size:10pt">*</span> Ваш E-mail:
<input type="text" name="email" value="<?=$email;?>" maxlength="30" required>

Ваш телефон:
<input type="text" name="_tel" value="<?=$_tel;?>" maxlength="20">

<span style="color:#FF0000;font-size:10pt">*</span> Текст сообщения:
<textarea name="text" maxlength="2000" required><?=$text;?></textarea>

<img style="float:left; margin:0 5px 0 0" src="./engine/cap.php?<?=session_name()?>=<?=session_id()?>">
<input style="float:left; width:120px" type="text" name="keystring" placeholder="Код с картинки" maxlength="5" required>

<input style="float:right" class="button" type="submit" value="Отправить сообщение" name="submit">
</form>
</div>
<?
$content = ob_get_contents();
ob_end_clean();
?>