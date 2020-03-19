<?php
require_once('../_func/func.inc.php');

if (!isset($_SESSION['logged'])) {
    $imgUrl = getRandomGif();
} else {

    $imgUrl = getRandomPornGIF();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>mastique ton bout</title>
    <meta name="generator" content="hosting-page-builder">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="og:locale" content="fr">
    <meta name="og:type" content="website">
    <link rel="stylesheet" href="https://assets.storage.infomaniak.com/fonts/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <link rel="stylesheet" type="text/css" href="../_css/main.css" />
    <style>
        .page {
            background-image: url("<?= $imgUrl ?>");
            background-size: contain;
            background-position-x: center;
        }
    </style>
</head>

<body>
    <div id="page" class="page  overlay-dark bg-position-middle">
        <div class="container">
            <div class="content"></div>
            <div class="hosting-info">
            <input type="button" onclick="getGif();" value="Changer d'image"/>
            </div>
        </div>
        <script src="../_js/script.js"></script>
        <script src="https://assets.storage.infomaniak.com/js/css_browser_selector.min.js"></script>
        <script>
            function getGif() {
                fetch('../_func/randomGif.php')
                    .then(function(resp) {
                        return resp.text();
                    }).then(function(resp) {
                        document.getElementById('page').style.backgroundImage = "url('" + resp + "')";
                    });
            }
        </script>

    </div>

</body>

</html>