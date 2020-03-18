<?php
$json_str = file_get_contents('php://input');

$json_obj = json_decode($json_str);

unlink($json_obj->file);
?>
<!DOCTYPE html>
<html>

</html>