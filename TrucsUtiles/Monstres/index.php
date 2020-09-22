<?php
require_once('../../_func/func.inc.php');
$mName = filter_input(INPUT_GET, "nom");
$monstres = file_get_contents("../MonstresUTF8.json");

$ms = json_decode($monstres, true, 512, JSON_THROW_ON_ERROR);
$m = $ms[$mName];


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>StatBloc - <?=$mName?></title>
    <meta name="generator" content="hosting-page-builder">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="og:locale" content="fr">
    <meta name="og:type" content="website">
    <link rel="stylesheet" href="https://assets.storage.infomaniak.com/fonts/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <link rel="stylesheet" type="text/css" href="../../_css/main.css" />
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
        th{
            vertical-align: top;
        }
        tbody {
            border-top: 2px solid red;
        }

        .content {
            margin: auto;
        }
    </style>
    <script src="https://www.pyroblastouille.site/js/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://www.pyroblastouille.site/js/jquery.tablesorter.min.js"></script>
    <script src="../../_js/script.js"></script>
    <script src="https://assets.storage.infomaniak.com/js/css_browser_selector.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://www.pyroblastouille.site/css/theme.default.css">
</head>

<body>
    <div id="page" class="page  overlay-dark bg-position-middle">
        <div class="container">
            <div id="content">
                <table id="datas">
                    <thead>
                        <tr>
                            <th colspan="6"><h1><span id="nom"><?= $mName ?></span><?= ($m['nomAlternatif'] != $mName ? "/" . $m['nomAlternatif'] : "") ?> - <span id="name"><?= $m['nomVO'] ?></span></h1></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>CR : </strong><span id="cr"><?= $m['puissance'] ?></span></td>
                            <td colspan="5"><span id="type"><?= $m['type'] ?></span> de taille <span id="taille"><?= $m['taille'] ?></span>, <span id="alignement"><?= $m['alignement'] ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>Classe d'Armure :</strong> <br><span id="ca"><?= $m['ca'] ?></span></td>
                            <td colspan="2"><strong>PV : </strong> <br><span id="pv"><?= $m['pv'] ?></span></td>
                            <td colspan="2"><strong>Speed : </strong> <br><span id="speed"><?= $m['vitesse'] ?></span></td>
                        </tr>
                        <tr>
                            <td><strong>FOR</strong><br><span id="FOR"><?= $m['FOR'] ?></span></td>
                            <td><strong>DEX</strong><br><span id="DEX"><?= $m['DEX'] ?></span></td>
                            <td><strong>CON</strong><br><span id="CON"><?= $m['CON'] ?></span></td>
                            <td><strong>INT</strong><br><span id="INT"><?= $m['INT'] ?></span></td>
                            <td><strong>SAG</strong><br><span id="SAG"><?= $m['SAG'] ?></span></td>
                            <td><strong>CHA</strong><br><span id="CHA"><?= $m['CHA'] ?></span></td>
                        </tr>

                    </tbody>
                    <tbody>
                        <?php if ($m['JdS'] != "") : ?>
                            <tr>
                                <th colspan="1">Jets de Sauvegarde</th>
                                <td colspan="5"><?= $m['JdS'] ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($m['competences'] != "") : ?>
                            <tr>
                                <th colspan="1">Compétences</th>
                                <td colspan="5"><?= $m['competences'] ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($m['sens'] != "") : ?>
                            <tr>
                                <th colspan="1">Sens</th>
                                <td colspan="5"><?= $m['sens'] ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($m['langues'] != "") : ?>
                            <tr>
                                <th colspan="1">Langues</th>
                                <td colspan="5"><?= $m['langues'] ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($m['resistance'] != "") : ?>
                            <tr>
                                <th colspan="1">Résistances</th>
                                <td colspan="5"><?= $m['resistance'] ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($m['immunitesDegats'] != "") : ?>
                            <tr>
                                <th colspan="1">Immunités de Dégâts</th>
                                <td colspan="5"><?= $m['immunitesDegats'] ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($m['immunitesConditions'] != "") : ?>
                            <tr>
                                <th colspan="1">Immunités d'Etats</th>
                                <td colspan="5"><?= $m['immunitesConditions'] ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($m['vulnerabilites'] != "") : ?>
                            <tr>
                                <th colspan="1">Vulnérabilités</th>
                                <td colspan="5"><?= $m['vulnerabilites'] ?></td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                    <?php if (count($m['traits']) != 0) : ?>
                        <tbody>
                            <?php foreach ($m['traits'] as $th => $tr) : ?>
                                <tr>
                                    <th colspan="1"><?= $th ?></th>
                                    <td colspan="5"><?= $tr ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                    <?php if (count($m['action']) != 0) : ?>
                        <tbody>
                            <tr><th colspan="6">Actions</th></tr>
                            <?php foreach ($m['action'] as $th => $tr) : ?>
                                <tr>
                                    <th colspan="1"><?= $th ?></th>
                                    <td colspan="5"><?= $tr ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                    <?php if (count($m['reaction']) != 0) : ?>
                        <tbody>
                            <tr><th colspan="6">Réactions</th></tr>
                            <?php foreach ($m['reaction'] as $th => $tr) : ?>
                                <tr>
                                    <th colspan="1"><?= $th ?></th>
                                    <td colspan="5"><?= $tr ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>
                    <?php if (count($m['actionsLegendaire']) != 0) : ?>
                        <tbody>
                            <tr><th colspan="6">Actions Légendaires</th></tr>
                            <tr><td colspan="6"><?=$m['actionsLegendaireDesc']?></td></tr>
                            <?php foreach ($m['actionsLegendaire'] as $th => $tr) : ?>
                                <tr>
                                    <th colspan="1"><?= $th ?></th>
                                    <td colspan="5"><?= $tr ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    <?php endif; ?>

                    <tr>
                        <td colspan="6">Source : <i><?=$m['source']?></i></td>
                    </tr>
                </table>

            </div>
            <div class="social-links">
            </div>
            <div class="hosting-info">
                <p>
                    <?php if (isset($_SESSION['logged'])) : ?>
                        <a href="../../_func/logout.php">Logout</a>
                    <?php else : ?>
                        <a href="../../_func/login.php">Login</a>
                    <?php endif; ?>
                    -
                    <a href="#" onclick="toggleUI()">Cacher/Montrer l'UI</a>
                    <a href="https://pyroblastouille.site/LeProjetTopSecret/TrucsUtiles">Retour</a>
                </p>
            </div>
        </div>
        <script>
            //load monsters datas
        </script>

    </div>

</body>

</html>