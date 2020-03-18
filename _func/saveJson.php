<?php
$json_str = file_get_contents('php://input');

$json_obj = json_decode($json_str);


$file = fopen($json_obj->file,"w+");

fwrite($file,json_encode($json_obj->data));

fclose($file);
?>
<!DOCTYPE html>
<html>

</html>