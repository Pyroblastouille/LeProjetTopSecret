<?php
require_once('../_func/func.inc.php');
$persos = glob("perso/[a-zA-Z0-9\ ]*.json");
if(isset($_SESSION['logged'])){
    $imgUrl = getRandomFantasyArtNSFW();
}else{
    $imgUrl = getRandomDnD();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>deuneudeu</title>
    <meta name="generator" content="hosting-page-builder">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="og:locale" content="fr">
    <meta name="og:type" content="website">
    <link rel="stylesheet" href="https://assets.storage.infomaniak.com/fonts/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <link rel="stylesheet" type="text/css" href="../_css/main.css" />
    <link rel="stylesheet" type="text/css" href="../_css/deuneudeu.css" />
    <style>
        .page {
            background-image: url("<?= $imgUrl->path ?>");
            background-repeat: no-repeat;
            background-position-x: center;
            background-size: contain;
        }
    </style>
</head>

<body>

    <div id="page" class="page  overlay-dark bg-position-middle">
        <div class="container">
            <div class="content">
                <h1>Caractères</h1>
                <div>
                    <?php
                    foreach ($persos as $key => $value) :
                        $fileName = explode('/',$value)[1];
                        $justName = explode('.',$fileName) [0];
                    ?>
                        <a class="card" href="perso/?jsonFile=<?= $fileName ?>" alt="<?= $justName ?>"><?= $justName ?></a>
                    <?php endforeach; ?>
                </div>

                <div>
                    <div class="card" onclick="addJson()" id="add">+</div>
                </div>

                <form hidden id="hiddenForm" action="perso/" method="GET">
                    <input type="text" value="" name="jsonFile" id="nameInput" />
                    <button id="btnSubmit"></button>
                </form>
            </div>
            <div class="social-links">
            </div>
            <div class="hosting-info">
            <p>
                <?php if (isset($_SESSION['logged'])) : ?>
                    <a href="../_func/logout.php">Logout</a>
                <?php else : ?>
                    <a href="../_func/login.php">Login</a>
                <?php endif; ?>
                -
                <a href="#" onclick="toggleUI()">Cacher/Montrer l'UI</a>
                    -
                    <a href="#" onclick="mute()">Mute/Unmute</a>
                -
                <a href="http://pyroblastouille.site">Retour à la page d'accueil</a>
            </p>
                <p>Si tu penses que ce fond est chaud, viens le prendre <a href="<?= $imgUrl->url ?>">à cette adresse</a>.</p>
            </div>
        </div>
        <script src="../_js/script.js"></script>
        <video <?=(isset($_SESSION['mute']) && $_SESSION['mute'] ? "muted" : "" )?> class="son" hidden autoplay>
            <source src="../_sounds/rpg.mp3" type="audio/mpeg" />
        </video>
        <script>
            function addJson() {
                let newName = prompt("Pour quel joueur ?");
                newName = newName.replace("/[\ \-]/g", '_');
                if (newName != null) {
                    nameInput.value =  newName + '.json';
                    hiddenForm.submit();
                }
            }
        </script>

    </div>
</body>

</html>