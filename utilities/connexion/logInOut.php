<?php

require 'utilities/database/users.php';

function LogIn() {//authentifie l'utilisateur et modifie la session en conséquence
    if (isset($_POST['login']) && isset($_POST['mdp'])) {
        $user = Utilisateur::getUtilisateur($_POST['login']);
        if (isset($user) && Utilisateur::testmdp($user, $_POST['mdp'])) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['login'] = $user->login;
            $_SESSION['usertext'] = $user->_toString();
        } else {
            echo "<script>alert('Le mot de passe et/ou le nom d\'utilisateur sont invalides !')</script>";
        }
    }
}

function LogOut() {
    unset($_SESSION['loggedIn']);
    unset($_SESSION['usertxt']);
    unset($_SESSION['login']);
    header("Location: index.php");
    exit();
}
