<?php
require_once('func.inc.php');
unset($_SESSION['logged']);
header("Location: ".$_SERVER['HTTP_REFERER']);
?>
