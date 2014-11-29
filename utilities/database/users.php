<?php

require_once 'database.php';

class Utilisateur {

    public $login;
    public $mdp;
    public $nom;
    public $prenom;
    public $promo;
    public $email;
    public $admin; //les hcamps correspondent à cexu de la base de données utilisateurs.

    public function _toString() {
        if ($this->promo % 2 == 0) {
            $color = 'rouge';
        } else {
            $color = 'jaune';
        }
        return "$this->prenom $this->nom (<span class='$color'>X$this->promo</span>)";
    }

    public static function insererUtilisateur($login, $mdp, $nom, $prenom, $promo, $email, $admin) {//inère l'utilisateur dans la base de données
        // opérations sur la base
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `promo`, `email`, `admin`) VALUES(?,SHA1(?),?,?,?,?,?)");
        $sth->execute(array($login, $mdp, $nom, $prenom, $promo, $email, $admin));
        $dbh = null; // Déconnexion de MySQL
    }

    public static function getUtilisateur($login) {//retourne l'utilisateur repéré par le $login
        $dbh = Database::connect();
        $query = "SELECT * FROM `utilisateurs` WHERE login='$login' ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute();
        $user = $sth->fetch();
        $sth->closeCursor();
        if (empty($user)) {
            return null;
        } else {
            return $user;
        }
    }

    public static function testmdp($user, $mdp) {//vérifie si l'utilisateur est bien dans la base de données et que les mots de passe concordent.
        if ($user == null) {
            return false;
        } else {
            return (sha1($mdp) == $user->mdp);
        }
    }

    public static function changermdp($login, $new) {
        // opérations sur la base
        $dbh = Database::connect();
        $sth = $dbh->prepare("UPDATE `utilisateurs` SET mdp=SHA1('$new') WHERE login='$login'");
        $sth->execute();
        $dbh = null; // Déconnexion de MySQL
    }

    public static function supprimercompte($login) {
        // opérations sur la base
        $dbh = Database::connect();
        $sth = $dbh->prepare("DELETE FROM `utilisateurs` WHERE login='$login'");
        $sth->execute();
        $dbh = null; // Déconnexion de MySQL
    }

}
