<?php
require_once('func.inc.php');

$redirect = (isset($_SESSION['redirect']) ?$_SESSION['redirect']: $_SERVER['HTTP_REFERER']);
unset($_SESSION['redirect']);

$error = filter_input(INPUT_GET,'error');
if($error == false || is_null($error)){
    $error = "";
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="generator" content="hosting-page-builder">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="og:locale" content="fr">
    <meta name="og:type" content="website">
    <link rel="stylesheet" href="https://assets.storage.infomaniak.com/fonts/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
    <link rel="stylesheet" type="text/css" href="../_css/main.css" />
    <style>
        table{
            margin: auto;
            border: 1px solid #eeea;
            background-color: #fffa;
        }
        .text-align-center{
            text-align: center;
        }
        .error{
            color:red;
        }
    </style>
</head>

<body>
    <div id="page" class="page  overlay-dark bg-position-middle">
        <div class="container">
            <div class="content">
                <div class="error"><?=$error?></div>
                <form action="loginReturn.php" method="post">
                    <table>
                        <tr>
                            <th colspan="2"><h1>Login</h1></th>
                        </tr>
                        <tr>
                            <td>Nom utilisateur</td>
                            <td><input type="text" name="username" placeholder="Nom utilisateur" /></td>
                        </tr>
                        <tr>
                            <td>Mot de passe</td>
                            <td><input type="password" name="mdp" placeholder="Mot de passe" /></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-align-center"><input type="text" hidden name="redirect" value="<?= $redirect ?>" /><input type="submit" name="submit" value="Soumettre" /><input type="submit" name="submit" value="Retour" /></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="social-links">
            </div>
            <div class="hosting-info">
            </div>
            <video hidden autoplay loop>
                <source src="./_sounds/sweden.mp3" type="audio/mpeg" />
            </video>
        </div>
</body>

</html>