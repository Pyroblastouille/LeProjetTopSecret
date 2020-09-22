<?php
require_once('./func.inc.php');

if(isset($_SESSION['logged'])){
    echo getRandomPornGIF();
}else{
    echo getRandomGIF();
}