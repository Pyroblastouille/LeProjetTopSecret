<?php
require_once('../_func/func.inc.php');
if (isset($_SESSION['logged'])) {
    $imgUrl = getRandomChubby();
} else {
    $imgUrl = getRandomSFW();
}

$files = glob('booked/[a-zA-Z0-9\ ]*.pdf');
?>

<h1>Books</h1>
<?php
foreach ($files as $key => $value) :
    $justName = substr(substr($value, 7), 0, -4);
?>
    <a class="card" href="http://pyroblastouille.site/LeProjetTopSecret/booky/<?= $value ?>"><?= $justName ?></a>
<?php
endforeach;
?>