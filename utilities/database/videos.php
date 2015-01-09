<?php

require_once 'database.php';

class Video {

    public $video;
    public $titre;
    public $adresse;
    public $poster;
    public $proj;
    public $description;
    public $jtx;
    public $annee;
    public $format;
    public $login; //les champs correspondent à cexu de la base de données utilisateurs.
    public $vues;

    public function __toString() {
        return $this->titre;
    }

    public static function insererVideo($titre, $adresse, $proj, $description, $jtx, $annee, $login) {//inère la vidéo dans la base de données
        // opérations sur la base
        preg_replace("/(<script>|</script>)/i", '', $description); //la description peut contenir du HTML mais on enlève les balises script pour pas
        //qu'il y ait trop de failles de sécurité.
        if (Video::getVideoFromAdress($adresse) === null) {//vérifie si la vidéo n'est déjà pas référencée.
            $dbh = Database::connect();
            $sth = $dbh->prepare("INSERT INTO `videos` (titre, adresse, proj, poster, description, jtx, annee, login) VALUES(?,?,?,?,?,?,?,?)");
            if ($jtx == "0") {//si jamais le paramètre est pas spécifié, POST met 0 mais en SQL o'est NULL
                $jtx = NULL;
            }
            if ($annee == "0") {//si jamais le paramètre est pas spécifié, POST met 0 mais en SQL c'est NULL
                $annee = NULL;
            }
            $sth->execute(array($titre, $adresse, $proj, '', $description, $jtx, $annee, $login));
            $dbh = null; // Déconnexion de MySQL
            return true;
        } else {
            return false;
        }
    }

    public static function updateVideo($id, $titre, $adresse, $proj, $description, $jtx, $annee, $login) {
        // opérations sur la base
        preg_replace("/(\<script\>|\<\/script\>)/i", '', $description); //la description peut contenir du HTML mais on enlève les balises script pour pas
        //qu'il y ait trop de failles de sécurité.
        if (!(Video::getVideoFromAdress($adresse) === null)) {//vérifie si la vidéo est bien référencée.
            $dbh = Database::connect();
            $sth = $dbh->prepare("UPDATE `videos` SET titre=?, adresse=?, proj=?, description=?, jtx=?, annee=?, login=? WHERE video=?");
            if ($jtx == "0") {//si jamais le paramètre est pas spécifié, POST met 0 mais en SQL o'est NULL
                $jtx = NULL;
            }
            if ($annee == "0") {//si jamais le paramètre est pas spécifié, POST met 0 mais en SQL c'est NULL
                $annee = NULL;
            }
            $sth->execute(array($titre, $adresse, $proj, $description, $jtx, $annee, $login, $id));
            $dbh = null; // Déconnexion de MySQL
            return true;
        } else {
            return false;
        }
    }

    public static function updatePoster($id, $poster) {
        // opérations sur la base
        $dbh = Database::connect();
        $sth = $dbh->prepare("UPDATE `videos` SET poster=? WHERE video=?");
        $sth->execute(array($poster, $id));
        $dbh = null; // Déconnexion de MySQL
    }

    public static function getVideoFromAdress($adresse) {//retourne la vidéo repéré par le $login
        $dbh = Database::connect();
        $query = "SELECT * FROM `videos` WHERE adresse=? ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Video');
        $sth->execute(array($adresse));
        $video = $sth->fetch();
        $sth->closeCursor();
        if (empty($video)) {
            return null;
        } else {
            return $video;
        }
    }

    public static function getVideoFromId($id) {//retourne la vidéo repéré par le $login
        $dbh = Database::connect();
        $query = "SELECT * FROM `videos` WHERE video=? ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Video');
        $sth->execute(array($id));
        $video = $sth->fetch();
        $sth->closeCursor();
        if (empty($video) || $sth->rowCount() != 1) {
            return null;
        } else {
            return $video;
        }
    }

    public static function exists($video) {
        return (!(Video::getVideoFromId($video) === null));
    }

    public static function titreAleatoire() {
        $dbh = Database::connect();
        $query = "SELECT titre FROM videos ORDER BY RAND() LIMIT 1";
        $sth = $dbh->prepare($query);
        $sth->execute();
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $titre = $sth->fetch();
        echo $titre['titre'];
    }

    public static function ajouterVue($video) {
        // opérations sur la base
        $dbh = Database::connect();
        $sth = $dbh->prepare("UPDATE `videos` SET vues=vues+1 WHERE video=?");
        $sth->execute(array($video));
        $dbh = null; // Déconnexion de MySQL
    }
}
