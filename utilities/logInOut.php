<?php

require 'users.php';

function LogIn() {//authentifie l'utilisateur et modifie la session en conséquence
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $user = Utilisateur::getUtilisateur($login);
    if (isset($user) && Utilisateur::testmdp($user, $mdp)) {
        $_SESSION['loggedIn'] = true;
    }
}

function LogOut() {
    unset($_SESSION['loggedIn']);
}
