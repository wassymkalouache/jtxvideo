<?php require_once 'utilities/database/users.php';

function Changemdp() {//teste si l'ancien mot de passe est le bon puis change le mot de passe
    if (isset($_SESSION['loggedIn'])&&$_SESSION['loggedIn']&&isset($_SESSION['login'])) {
        $user = Utilisateur::getUtilisateur($_SESSION['login']);
        if (!Utilisateur::testmdp($user, $_POST['old'])) {//si l'ancien mot de passe n'est pas bon on retombe sur la page de changement
            header('Location: index.php?page=compte&error=old');
            exit();
        }
        if ($_POST['new'] == $_POST['new2']) {
        Utilisateur::changermdp($_SESSION['login'], $_POST['new']);
        } else {
            header('Location: index.php?page=compte&error=new');
            exit();
        }
    }
}