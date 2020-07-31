<?php
require_once('../_func/func.inc.php');
$persos = glob("perso/[a-zA-Z0-9\ ]*.json");
if($_SERVER['HTTP_HOST'] == "localhost"){
    $dh = opendir("./perso/");
    while(($file = readdir()) !== false){
        if(strpos($file,".json") !== false){
            array_push($persos,"perso/$file");
        }
    }
    
}

if (isset($_SESSION['logged'])) {
    $bg = getRandom('001');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Characters Creator</title>
    <meta name="generator" content="hosting-page-builder">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="og:locale" content="fr">
    <meta name="og:type" content="website">
    <link rel="stylesheet" href="https://assets.storage.infomaniak.com/fonts/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <style>
        .page {
            background-position-x: center;
            background-repeat: no-repeat;
            background-size: contain;
            <?= (isset($_SESSION['logged']) ? "background-image: url('" . $bg->path . "'), url('" . $bg->thumbs->original . "');" : "") ?>
        }

        form {
            margin: auto;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../_css/main.css" />
</head>

<body>
    <div id="page" class="page overlay-dark bg-position-middle">
        <div class="container">
            <div id="content">
                <h1>Caractères</h1>
                <div>
                    <?php
                    foreach ($persos as $key => $value) :
                        $fileName = explode('/', $value)[1];
                        $justName = explode('.', $fileName)[0];
                    ?>
                        <a class="card" href="./perso/?jsonFile=<?= $fileName ?>" alt="<?= $justName ?>"><?= $justName ?></a>
                    <?php endforeach; ?>
                </div>

                <div>
                    <div class="card" onclick="addJson()" id="add">+</div>
                </div>

                <div hidden id="dialog">
                    <div>Quel sera le nom du joueur ? </div>
                    <input type="text" value="<?= random_text(5); ?>" name="jsonFile" id="nameInput" />
                </div>
                <script>
                </script>
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
                    -
                    <a href="../">Retour à la page d'accueil</a>
                </p>
            </div>
            <video <?= (isset($_SESSION['mute']) && $_SESSION['mute'] ? "muted" : "") ?> class="son" hidden autoplay loop>
                <source src="../_sounds/sweden.mp3" type="audio/mpeg" />
            </video>
        </div>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script>
            function addJson() {
                $("#dialog").dialog({
                    autoOpen: true,
                    buttons: {
                        Assisté: function() {
                            console.log("bouloula");
                            let newName = nameInput.value.replace("/[\ \-]/g", '_');
                            if (newName == "") {
                                alert("Remplir le nom du joueur est nécessaire");
                            } else {
                                window.location = "./creation/?jsonFile=" + newName;
                            }
                        },
                        Normal: function() {
                            console.log("bouloulou");
                            let newName = nameInput.value.replace("/[\ \-]/g", '_');
                            if (newName == "") {
                                alert("Au vu de la précarité de votre demande, il nous faudrait des informations supplémentaires afin d'accéder au serveur central de la base du curicullum vitae de votre grand-mère");
                            } else {
                                window.location = "./creation/directCreation?jsonFile=" + newName;
                            }
                        }
                    }
                });
            }
        </script>
        <script src="../_js/script.js">
        </script>
        <script src="https://assets.storage.infomaniak.com/js/css_browser_selector.min.js"></script>
    </div>

</body>

</html>