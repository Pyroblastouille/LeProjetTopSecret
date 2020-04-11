<?php
$json_str = file_get_contents('php://input');

$json_obj = json_decode($json_str);
$newFileName = $json_obj->file;
if(isset($json_obj->create) && $json_obj->create){
    $i = 0;
    while(file_exists($newFileName)){
        $i++;
        $newFileName = str_replace('.json',"($i).json",$json_obj->file);
    }
}
$file = fopen($newFileName,"w+");

fwrite($file,json_encode($json_obj->data));

fclose($file);
?>
<!DOCTYPE html>
<html>

</html>