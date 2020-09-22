<?php
require_once('../_func/func.inc.php');

if(isset($_SESSION['logged'])){
    $img =  getRandomPornGIF();
}else{
    $img =  getRandomGIF();
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
        .container{
            background-position-x: center;
            background-repeat: no-repeat;
            background-size: contain;
            background-image: url('<?=$img?>');
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
                </p>
            </div>
        </div>
        <script src="../_js/script.js">
        </script>
        <script>
        </script>
        <script src="https://assets.storage.infomaniak.com/js/css_browser_selector.min.js"></script>


    </div>

</body>

</html>