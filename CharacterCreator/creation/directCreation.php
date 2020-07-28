<?php
require_once('../../_func/func.inc.php');
$val = file('../perso/_empty.json');

$newFileName = '../perso/'.(isset($_GET['jsonFile']) ? $_GET['jsonFile'] : "unknown");

while(file_exists($newFileName)){
    $i++;
    $newFileName = str_replace('.json',"($i).json",$json_obj->file);
}
file_put_contents($newFileName,$val);



header("Location: https://www.pyroblastouille.site/LeProjetTopSecret/CharacterCreator/perso/?jsonFile=$newFileName.json");
?>