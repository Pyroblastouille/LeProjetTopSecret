<?php
require_once('../_func/func.inc.php');
$persos = glob("perso/[a-zA-Z0-9\ ]*.json");
if (isset($_SESSION['logged'])) {
    $imgUrl = getRandomFantasyArtNSFW();
} else {
    $imgUrl = getRandomDnD();
}
?>

<style src="http://pyroblastouille.site/LeProjetTopSecret/_css/deuneudeu.css"></style>
<h1>Caractères</h1>
<div>
    <?php
    foreach ($persos as $key => $value) :
        $fileName = explode('/', $value)[1];
        $justName = explode('.', $fileName)[0];
    ?>
        <a class="card" href="pyroblastouille.site/LeProjetTopSecret/deuneudeu/perso/?jsonFile=<?= $fileName ?>" alt="<?= $justName ?>"><?= $justName ?></a>
    <?php endforeach; ?>
</div>

<div>
    <div class="card" onclick="addJson()" id="add">+</div>
</div>

<form hidden id="hiddenForm" action="perso/" method="GET">
    <input type="text" value="" name="jsonFile" id="nameInput" />
    <button id="btnSubmit"></button>
</form>
<script>
</script>