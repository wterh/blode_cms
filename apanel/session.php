<?php
session_start();
if(!@$_SESSION['blonde'])
{
	require('enter.php'); exit;
}
?>