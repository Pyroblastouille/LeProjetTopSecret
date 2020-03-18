<?php
require_once('func.inc.php');
var_dump($_SESSION['mute']);
if(isset($_SESSION['mute']) && $_SESSION['mute']){
    $_SESSION['mute'] = false;
}else{
    $_SESSION['mute'] = true;
}
?>  