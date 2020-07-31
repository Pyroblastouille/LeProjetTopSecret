<?php
$json_str = file_get_contents('php://input');

$json_obj = json_decode($json_str);
$newFileName = $json_obj->file;
if (isset($json_obj->create) && $json_obj->create) {
    if (strpos($newFileName, '.json') == false) {
        $newFileName .=".json";
    }
    $i = 1;
    if (file_exists($newFileName)){
        $newFileName = str_replace('.json', "($i).json", $newFileName);
    }
        while (file_exists($newFileName)) {
            $i2 = $i+1;
            $newFileName = str_replace("($i).json", "($i2).json",$newFileName);
            $i++;
        }
}
$file = fopen($newFileName, "w+");

fwrite($file, json_encode($json_obj->data,JSON_PRETTY_PRINT));

fclose($file);
?>
<!DOCTYPE html>
<html>

</html>