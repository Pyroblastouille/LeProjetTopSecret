<?php
define("PASSWORD", 'Super'.date("Y"));

require_once('func.inc.php');
if (filter_input(INPUT_POST, 'submit') == "Soumettre") {
    if (
        filter_input(INPUT_POST, 'mdp') == PASSWORD
    ) {
        $_SESSION['logged'] = true;
        header("Location: " . filter_input(INPUT_POST, 'redirect'));

    }else{
        $_SESSION['redirect'] = filter_input(INPUT_POST, 'redirect');
        header("Location: login.php?error=Mot de passe ou nom d'utilisateur incorrect");
    }
}else{
    header("Location: " . filter_input(INPUT_POST, 'redirect'));
}
