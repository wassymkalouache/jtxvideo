<?php
require_once 'utilities/connexion/logInOut.php';
require_once 'utilities/database/users.php';

function SupprimerCompte() {//teste si l'ancien mot de passe est le bon puis change le mot de passe
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] && isset($_SESSION['login'])) {
        $user = Utilisateur::getUtilisateur($_SESSION['login']);
        if (!Utilisateur::testmdp($user, $_POST['mdp'])) {//si l'ancien mot de passe n'est pas bon on retombe sur la page du compte
            header('Location: index.php?page=compte&error=suppr');
            exit();
        } else {
            Utilisateur::Supprimercompte($_SESSION['login']);
            LogOut();
            header('Location: index.php?page=accueil');
            exit();
        }
    }
}
