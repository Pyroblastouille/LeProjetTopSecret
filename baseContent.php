<?php
require_once('./_func/func.inc.php');

if (isset($_SESSION['logged'])) {
    $imgUrl = getLatestNSFW();
} else {
    $imgUrl = getLatestSFW();
}
?>

<h1>C'est mon site à moi d'abord</h1>
<?php
$files = glob('*', GLOB_ONLYDIR);
foreach ($files as $key => $value) :
    if ((substr($value, 0, 1) != '_' && substr($value, 0, 1) != '-') || (substr($value, 0, 1) == '-' && isset($_SESSION['logged']))) :
        if ($value != 'gameDB') : ?>
            <a class="card" href="#" onclick="link('./<?= str_replace(' ', '%20', $value) ?>');"><?= $value ?></a>
<?php endif;
    endif;
endforeach;
?>
<a class="card" href="https://app.roll20.net/campaigns/details/4996081/pyropartie">Roll20</a>