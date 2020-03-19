<?php
require_once('./_func/func.inc.php');

if (isset($_SESSION['logged'])) {
    $imgUrl = getLatestNSFW();
} else {
    $imgUrl = getLatestSFW();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <meta name="generator" content="hosting-page-builder">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="og:locale" content="fr">
    <meta name="og:type" content="website">
    <link rel="stylesheet" href="https://assets.storage.infomaniak.com/fonts/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <link rel="stylesheet" type="text/css" href="./_css/main.css" />
    <style>
        .page {
            background-image: url("<?= $imgUrl->path ?>");
            background-position-x: center;
            background-repeat: no-repeat;
            background-size: contain;
        }

        form {
            margin: auto;
        }
    </style>
</head>

<body>
    <div id="page" class="page  overlay-dark bg-position-middle">
        <div class="container">
            <div id="content">

                <h1>C'est mon site à moi d'abord</h1>
                <?php
                $files = glob('*', GLOB_ONLYDIR);
                foreach ($files as $key => $value) :
                    if ((substr($value, 0, 1) != '_' && substr($value, 0, 1) != '-') || (substr($value, 0, 1) == '-' && isset($_SESSION['logged']))) :
                        if ($value != 'gameDB') : ?>
                            <a class="card" href="#" onclick="link('./<?= $value ?>');'"><?= $value ?></a>
                <?php endif;
                    endif;
                endforeach;
                ?>
                <a class="card" href="https://app.roll20.net/campaigns/details/4996081/pyropartie">Roll20</a>


            </div>
            <div class="social-links">
            </div>
            <div class="hosting-info">
                <p>
                    <?php if (isset($_SESSION['logged'])) : ?>
                        <a href="./_func/logout.php">Logout</a>
                    <?php else : ?>
                        <a href="./_func/login.php">Login</a>
                    <?php endif; ?>
                    -
                    <a href="#" onclick="toggleUI()">Cacher/Montrer l'UI</a>
                    -
                    <a href="#" onclick="mute()">Mute/Unmute</a>
                    -
                    <a onclick="link('pyroblastouille.site');">Retour à la page d'accueil</a>
                </p>
                <p>Si tu penses que ce fond est chaud, viens le prendre <a href="<?= $imgUrl->url ?>">à cette adresse</a>.</p>
            </div>
            <video <?= (isset($_SESSION['mute']) && $_SESSION['mute'] ? "muted" : "") ?> class="son" hidden autoplay loop>
                <source src="./_sounds/sweden.mp3" type="audio/mpeg" />
            </video>
        </div>
        <script src="./_js/script.js"></script>
        <script src="https://assets.storage.infomaniak.com/js/css_browser_selector.min.js"></script>


    </div>

</body>

</html>