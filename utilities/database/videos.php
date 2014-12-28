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
    public $format; //les hcamps correspondent à cexu de la base de données utilisateurs.

    public function __toString() {
        return $this->titre;
    }

    public static function insererVideo($titre, $adresse, $proj, $poster, $description, $jtx, $annee) {//inère la vidéo dans la base de données
        // opérations sur la base
        if (Video::getVideoFromAdress($adresse) === null) {//vérifie si la vidéo n'est déjà pas référencée.
            $dbh = Database::connect();
            $sth = $dbh->prepare("INSERT INTO `videos` (titre, adresse, proj, poster, description, jtx, annee) VALUES(?,?,?,?,?,?,?)");
            if ($jtx == "0") {//si jamais le paramètre est pas spécifié, POST met 0 mais en SQL o'est NULL
                $jtx = NULL;
            }
            if ($annee == "0") {//si jamais le paramètre est pas spécifié, POST met 0 mais en SQL c'est NULL
                $annee = NULL;
            }
            $sth->execute(array($titre, $adresse, $proj, $poster, $description, $jtx, $annee));
            $dbh = null; // Déconnexion de MySQL
            return true;
        } else {
            return false;
        }
    }

    public static function getVideoFromAdress($adresse) {//retourne la vidéo repéré par le $login
        $dbh = Database::connect();
        $query = "SELECT * FROM `videos` WHERE adresse='$adresse' ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Video');
        $sth->execute();
        $video = $sth->fetch();
        $sth->closeCursor();
        if (empty($video)) {
            return null;
        } else {
            return $video;
        }
    }

    public static function getVideoFromId($video) {//retourne la vidéo repéré par le $login
        $dbh = Database::connect();
        $query = "SELECT * FROM `videos` WHERE video='$video' ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Video');
        $sth->execute();
        $video = $sth->fetch();
        $sth->closeCursor();
        if (empty($video) || $sth->rowCount() != 1) {
            return null;
        } else {
            return $video;
        }
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

}
