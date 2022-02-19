<?php
require_once("session.php");

	$text = str_replace('.jpg"><img','.jpg" class="highslide" onclick="return hs.expand(this)"><img',$text);
	$text = str_replace('.jpeg"><img','.jpeg" class="highslide" onclick="return hs.expand(this)"><img',$text);
	$text = str_replace('.png"><img','.png" class="highslide" onclick="return hs.expand(this)"><img',$text);
	$text = str_replace('.gif"><img','.gif" class="highslide" onclick="return hs.expand(this)"><img',$text);
	$text = str_replace('.bmp"><img','.bmp" class="highslide" onclick="return hs.expand(this)"><img',$text);

	$text2 = str_replace('.jpg"><img','.jpg" class="highslide" onclick="return hs.expand(this)"><img',$text2);
	$text2 = str_replace('.jpeg"><img','.jpeg" class="highslide" onclick="return hs.expand(this)"><img',$text2);
	$text2 = str_replace('.png"><img','.png" class="highslide" onclick="return hs.expand(this)"><img',$text2);
	$text2 = str_replace('.gif"><img','.gif" class="highslide" onclick="return hs.expand(this)"><img',$text2);
	$text2 = str_replace('.bmp"><img','.bmp" class="highslide" onclick="return hs.expand(this)"><img',$text2);

	$descr = str_replace('"','*',$descr);
	$descr = str_replace("'",'*',$descr);
	$keyws = str_replace('"','*',$keyws);
	$keyws = str_replace("'",'*',$keyws);

?>
