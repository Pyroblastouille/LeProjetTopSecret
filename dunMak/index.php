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
    <title>dungeonMaker</title>
    <meta name="generator" content="hosting-page-builder">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="og:locale" content="fr">
    <meta name="og:type" content="website">
    <link rel="stylesheet" href="https://assets.storage.infomaniak.com/fonts/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <link rel="stylesheet" type="text/css" href="../_css/main.css" />
    <link rel="stylesheet" type="text/css" href="../_css/dungeonMaker.css" />
    <style>
        .page {
            background-image: url("<?= $imgUrl ?>");
            background-size: contain;
            background-position-x: center;
        }

        table {
            color: black;
            margin: auto;
            border: 1px solid #000;
            width: 20em;
            background-color: #fffa;
            padding: 5px;
        }

        td {
            text-align: left;
        }

        .text-align-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="page" class="page  overlay-dark bg-position-middle">
        <div class="container">
            <div class="content">

                <form action="dungeonLayout.php" method="GET">
                    <table>
                        <tr>
                            <th colspan="2" class="text-align-center">
                                <h1>Dungeon Options</h1>
                            </th>
                        </tr>
                        <tr>
                            <td>Damage</td>
                            <td>
                                <select name="damage" id="damage">
                                    <option value="minor" selected>Minor</option>
                                    <option value="light">Light</option>
                                    <option value="major">Major</option>
                                    <option value="lethal">Lethal</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Difficulty</td>
                            <td>
                                <select name="difficulty" id="difficulty">
                                    <option value="simple" selected>Simple</option>
                                    <option value="routine">Routine</option>
                                    <option value="difficult">Difficult</option>
                                    <option value="veryDifficult">Very Difficult</option>
                                    <option value="nearImpossible">Near Impossible</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Enemy Type</td>
                            <td>
                                <select name="enemyType" id="enemyType">
                                    <option value="beast" selected>Beast</option>
                                    <option value="denizen">Denizen</option>
                                    <option value="monster">Monsters</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Group Sizes</td>
                            <td>
                                <select name="groupSize" id="groupSize">
                                    <option value="lone" selected>Lone</option>
                                    <option value="pair">Pair</option>
                                    <option value="small">Small</option>
                                    <option value="equal">Equal</option>
                                    <option value="large">Large</option>
                                    <option value="veryLarge">Very Large</option>
                                    <option value="horde">Horde</option>
                                    <option value="beyondCount">Beyond Count</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>NPC Types</td>
                            <td>
                                <select name="NPCType" id="NPCType">
                                    <option value="cleric" selected>Cleric</option>
                                    <option value="commoner">Commoner</option>
                                    <option value="performer">Performer</option>
                                    <option value="ranger">Ranger</option>
                                    <option value="rogue">Rogue</option>
                                    <option value="scholar">Scholar</option>
                                    <option value="warrior">Warrior</option>
                                    <option value="wizard">Wizard</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-align-center"><input type="submit" value="Validation des choix"></td>
                        </tr>
                    </table>
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
                <p>Si tu penses que ce fond est chaud, viens le prendre <a href="<?= $imgUrl ?>">à cette adresse</a>.</p>
            </div>
            <video <?= (isset($_SESSION['mute']) && $_SESSION['mute'] ? "muted" : "") ?>class="son" hidden autoplay loop>
                <source src="../_sounds/sweden.mp3" type="audio/mpeg" />
            </video>
        </div>
        <script src="../_js/script.js"></script>
        <script src="https://assets.storage.infomaniak.com/js/css_browser_selector.min.js"></script>


    </div>

</body>

</html>