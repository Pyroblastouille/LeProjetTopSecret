<?php
require_once('../_func/func.inc.php');
if (isset($_SESSION['logged'])) {
    $bg = getRandom('001');
}
$files = glob('*.json');

if ($_SERVER['HTTP_HOST'] == "localhost") {
    $dh = opendir("../");
    while (($file = readdir()) !== false) {
        if (strpos($file, ".json") !== false) {
            array_push($files, "$file");
        }
    }
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
    <link rel="stylesheet" type="text/css" href="../_css/main.css" />
    <style>
        .page {
            background-position-x: center;
            background-repeat: no-repeat;
            background-size: contain;
            <?= (isset($_SESSION['logged']) ? "background-image: url('" . $bg->path . "'), url('" . $bg->thumbs->original . "');" : "") ?>
        }

        #datas {
            margin: auto;
            background-color: white;
            color: black;
            border-collapse: collapse;
            overflow: visible;
        }

        th,
        td {
            border: 1px solid black;
        }

        form {
            margin: auto;
        }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <div id="page" class="page  overlay-dark bg-position-middle">
        <div class="container">
            <div id="content">
                <?php

                if (isset($_SESSION['logged'])) {
                    $imgUrl = getLatestNSFW();
                } else {
                    $imgUrl = getLatestSFW();
                }
                ?>

                <h1>Choisir un truc</h1>
                <?php
                foreach ($files as $key => $value) :
                    if ((substr($value, 0, 1) != '_' && substr($value, 0, 1) != '-') || (substr($value, 0, 1) == '-' && isset($_SESSION['logged']))) :
                        if ($value != 'gameDB') : ?>
                            <a class="card" href="#" onclick="loadDatas('<?= $value ?>')"><?= str_replace('.json', '', $value) ?></a>
                <?php endif;
                    endif;
                endforeach;
                ?>
                <a class="card" href="#" onclick="loadSortsClass('Barde')">Sorts Barde</a>
                <a class="card" href="#" onclick="loadSortsClass('Clerc')">Sorts Clerc</a>
                <a class="card" href="#" onclick="loadSortsClass('Druide')">Sorts Druide</a>
                <a class="card" href="#" onclick="loadSortsClass('Ensorceleur')">Sorts Ensorceleur</a>
                <a class="card" href="#" onclick="loadSortsClass('Magicien')">Sorts Magicien</a>
                <a class="card" href="#" onclick="loadSortsClass('Paladin')">Sorts Paladin</a>
                <a class="card" href="#" onclick="loadSortsClass('Rodeur')">Sorts Rodeur</a>
                <a class="card" href="#" onclick="loadSortsClass('Sorcier')">Sorts Sorcier</a>
                <table id="datas">
                </table>
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
                    <?php if (isset($_SESSION['logged'])) : ?>
                        <a href="<?= $bg->path ?>">Télécharger l'image</a>
                        -
                    <?php endif; ?>
                    <a href="#" onclick="mute()">Mute/Unmute</a>
                </p>
            </div>
            <video <?= (isset($_SESSION['mute']) && $_SESSION['mute'] ? "muted" : "") ?> class="son" hidden autoplay loop>
                <source src="../_sounds/sweden.mp3" type="audio/mpeg" />
            </video>
        </div>
        <script src="../_js/script.js"></script>
        <script src="https://assets.storage.infomaniak.com/js/css_browser_selector.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#datas').DataTable();
            });

            function loadDatas(path) {
                $.getJSON(path, function(json) {
                    var ordered = {};
                    Object.keys(json).sort().forEach(function(key) {
                        ordered[key] = json[key];
                    });


                    json = ordered;

                    var innerHTML = "";

                    $.each(json, function(index, value) {
                        innerHTML += "<tr>";
                        if (innerHTML == "<tr>") {
                            innerHTML += "<th>" + path.replace('.json', '') + "</th>";
                            $.each(value, function(index2, value2) {
                                innerHTML += "<th>" + index2 + "</th>";
                            });
                            innerHTML += "<tr>";
                        }
                        innerHTML += "<td>" + index + "</td>";
                        $.each(value, function(index2, value2) {
                            innerHTML += "<td>" + value2 + "</td>";
                        });
                        innerHTML += "</tr>";
                    });
                    datas.innerHTML = innerHTML;
                });
            }

            function loadSortsClass(uneClasse) {
                $.getJSON('sorts.json', function(json) {
                    var ordered = {};
                    Object.keys(json).sort().forEach(function(key) {
                        ordered[key] = json[key];
                    });

                    json = ordered;

                    var innerHTML = "";

                    $.each(json, function(index, value) {
                        if (innerHTML == "") {
                            innerHTML += "<thead>";
                            innerHTML += "<tr>";
                            innerHTML += "<th>Sorts</th>";
                            $.each(value, function(index2, value2) {
                                innerHTML += "<th>" + index2 + "</th>";
                            });
                            innerHTML += "</tr>";
                            innerHTML += "</thead>";
                            innerHTML += "<tbody>";
                        }
                        let bool = false;
                        if (value['classes'].includes(uneClasse)) {
                            innerHTML += "<tr>";
                            innerHTML += "<td>" + index + "</td>";
                            $.each(value, function(index2, value2) {
                                innerHTML += "<td>" + value2 + "</td>";
                            });
                            innerHTML += "</tr>";
                        }
                    });
                    innerHTML += "</tbody>";
                    datas.innerHTML = innerHTML;
                });
            }
        </script>

    </div>

</body>

</html>