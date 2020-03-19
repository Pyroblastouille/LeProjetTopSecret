<?php
require_once('../_func/func.inc.php');
if (isset($_SESSION['logged'])) {
    $imgUrl = getRandomChubby();
} else {
    $imgUrl = getRandomSFW();
}

$files = glob('[a-zA-Z0-9\ ]*.pdf');
?>

<h1>Characters</h1>
<?php
foreach ($files as $key => $value) :
    $justName = substr($value, 0, -4);
?>
    <a class="card" style="width:300px" href="pyroblastouille.site/LeProjetTopSecret/Stock Character Sheets/<?= $value ?>"><?= $justName ?></a>
<?php
endforeach;
?>