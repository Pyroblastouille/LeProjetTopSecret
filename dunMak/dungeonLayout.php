<?php
require_once('../_func/func.inc.php');
require_once('dndLayout.func.php');


if (!isset($_SESSION['logged'])) {
    $imgUrl = "";
} else {
    $imgUrl = getRandomTrans();
}
$damage = filter_input(INPUT_GET, 'damage');
$difficulty = filter_input(INPUT_GET, 'difficulty');
$enemyType = filter_input(INPUT_GET, 'enemyType');
$groupSize = filter_input(INPUT_GET, 'groupSize');
$NPCType = filter_input(INPUT_GET, 'NPCType');

$layout = createLayout();
$layoutJson = json_encode($layout);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Welcome to pyroblastouille.site</title>
    <meta name="generator" content="hosting-page-builder">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="og:locale" content="fr">
    <meta name="og:type" content="website">
    <link rel="stylesheet" href="https://assets.storage.infomaniak.com/fonts/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <link rel="stylesheet" type="text/css" href="../_css/main.css" />
    <link rel="stylesheet" type="text/css" href="../_css/dungeonMaker.css" />
    <style>
        img {
            position: absolute;
            width: 128px;
            height: 128px;
        }

        img.small {
            width: 64px;
            height: 64px;
        }

        .page {
            background-image: url("<?= $imgUrl->path ?>");
        }
    </style>
</head>

<body>
    <div id="page" class="page  overlay-dark bg-position-middle">
        <div class="container">
            <div class="content">
                <table>
                    <tr>
                        <th>Map</th>
                        <td>Area <input oninput="changeMap()" type="number" min="1" max="1" id="actualArea" value="1">/<span id="total">0</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="map"></td>
                    </tr>
                </table>


                <script src="data/func.js"></script>
                <script src="data/layout.js"></script>
                <script src="data/plot.js"></script>
                <script src="data/whoHere.js"></script>
                <script>
                    //What's the plot
                    var plotHook, location, variation, backstory;

                    //Who lives here
                    var boss, lair;
                    var areaId = 0;

                    //layout
                    var layout;
                    validateChoice();

                    function validateChoice() {
                        layout = JSON.parse('<?= $layoutJson ?>');
                        total.innerHTML = layout.length;
                        actualArea.max = layout.length;
                        console.log(layout);
                        changeMap();
                    }

                    function changeMap() {
                        let val = actualArea.value

                        var drawedMap = "";
                        let posXMin = 0,posYMin = 0;
                        layout[actualArea.value - 1].forEach(element => {
                            if (element.position[0] < posXMin){
                                posXMin = element.position[0];
                            }
                            if (element.position[1] < posYMin){
                                posYMin = element.position[1];
                            }
                        });

                        layout[actualArea.value - 1].forEach(arrayArea => {
                            let left = (posXMin + arrayArea.position[0]) * 128/12;
                            let top = (posYMin + arrayArea.position[1]) * 128/12;
                            arrayArea.pages.forEach(el => {
                                if (el.includes("LBD")) {
                                    drawedMap += '<img style="transform:translate(' + left + 'px,' + top + 'px);" class="small" src="tiles/' + el + '.jpg" alt="' + el + '"/>';
                                    left += 64;
                                } else {
                                    drawedMap += '<img style="transform:translate(' + left + 'px,' + top + 'px);" src="tiles/' + el + '.jpg" alt="' + el + '"/>';
                                    left += 128;
                                }
                            });
                        });

                        map.innerHTML = drawedMap;
                    }
                </script>
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
                    <a href="http://pyroblastouille.site">Retour à la page d'accueil</a>
                </p>
                <p>Si tu penses que ce fond est chaud, viens le prendre <a href="<?= $imgUrl->url ?>">à cette adresse</a>.</p>
            </div>
            <video <?= (isset($_SESSION['mute']) && $_SESSION['mute'] ? "muted" : "") ?> class="son" hidden autoplay loop>
                <source src="../_sounds/sweden.mp3" type="audio/mpeg" />
            </video>
        </div>
        <script src="../_js/script.js"></script>
        <script src="https://assets.storage.infomaniak.com/js/css_browser_selector.min.js"></script>


    </div>

</body>

</html>