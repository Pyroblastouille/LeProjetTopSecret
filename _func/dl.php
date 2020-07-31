<?php

$json_str = file_get_contents('php://input');

$json_obj = json_decode($json_str);

$imgs = glob('../_img/wallhaven-*');
foreach ($imgs as $img) {
    $id = explode('.',explode("-",$img)[1])[0];
    if(!file_exists("../_img/small-wallhaven-$id.jpg")){
        file_put_contents('../_img/small-wallhaven-'.$id.'.jpg',file_get_contents("https://th.wallhaven.cc/orig/".substr($id,0,2)."/$id.jpg"));
    }
}
foreach ($json_obj as $value) {
    $nm = end(explode('/',$value[0]));
    $id = explode('.',explode("-",$nm)[1])[0];
    if(!file_exists('../_img/'.$nm)){
        file_put_contents('../_img/'.$nm,file_get_contents($value[0]));
        file_put_contents('../_img/small-wallhaven-'.$id.'.jpg',file_get_contents($value[1]));
    }
}