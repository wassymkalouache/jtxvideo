<?php

require_once 'utilities/database/users.php';

function Signup() {
    $form_values_valid = false;

    if (isset($_POST["login"]) && $_POST["login"] != "" &&
            isset($_POST["up"]) && $_POST["up"] != "" &&
            isset($_POST["up2"]) && $_POST["up2"] != "" &&
            isset($_POST["nom"]) && $_POST["nom"] != "" &&
            isset($_POST["prenom"]) && $_POST["prenom"] != "" &&
            isset($_POST["promotion"]) && $_POST["promotion"] != "" &&
            isset($_POST["email"]) && $_POST["email"] != "") {  // tous les champs requis cités ic
        if (empty(Utilisateur::getUtilisateur($_POST["login"])) && $_POST["up"] == $_POST["up2"]) {//vérifie que l'utilisateur n'existe pas et que les mots de passe sont identiques.
            $result = Utilisateur::insererUtilisateur($_POST["login"], $_POST["up"], $_POST["nom"], $_POST["prenom"], $_POST["promotion"], $_POST["email"], 0);
            $form_values_valid = true;
        }
    }

    if (!$form_values_valid) {//il s'agit de revenir sur la page d'enregistrement avec des champs déjà pré-remplis.
        //on teste si le prénom était défini
        if (isset($_POST["login"])) {
            $login = $_POST["login"];
        } else {
            $login = "";
        }
        if (isset($_POST["nom"])) {
            $nom = $_POST["nom"];
        } else {
            $nom = "";
        }
        if (isset($_POST["prenom"])) {
            $prenom = $_POST["prenom"];
        } else {
            $prenom = "";
        }
        if (isset($_POST["promotion"])) {
            $promotion = $_POST["promotion"];
        } else {
            $promotion = "";
        }
        if (isset($_POST["email"])) {
            $email= $_POST["email"];
        } else {
            $email = "";
        }//puis on redirige vers le formulaire d'enregistrement pré-complété.
        header("Location: index.php?page=enregistrement&login=$login&nom=$nom&prenom=$prenom&promotion=$promotion&email=$email&error=true");
        exit();
    }
}
