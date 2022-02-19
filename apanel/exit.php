<?php
session_start();
$_SESSION['blonde'] = "";
session_destroy();
header("Location: ../");
?>