<?php

require_once 'database.php';
require_once 'videos.php';

class Similaire {

    public $video;
    public $similaire;

    public function __toString() {
        return $this->similaire;
    }

    public static function insererSimilaire($video, $similaire) {//insère un tag pour une vidéo dans la base de données
        // opérations sur la base
        if (Video::exists($video) && Video::exists($similaire)) {
            $dbh = Database::connect();
            $sth = $dbh->prepare("INSERT INTO `similaires` (video,similaire) VALUES(?,?)");
            $sth->execute(array($video, $similaire));
            $dbh = null; // Déconnexion de MySQL
            return true;
        } else {
            return false;
        }
    }

    public static function deleteSimilairesFromVideo($video) {//supprime toutes les catégories associées à une vidéo (utile pour la mise à jour)
        // opérations sur la base
        $dbh = Database::connect();
        $sth = $dbh->prepare("DELETE FROM `similaires` WHERE video=?");
        $sth->execute(array($video));
        $dbh = null; // Déconnexion de MySQL
    }

    public static function getSimilairesFromVideo($video) {//retourne tous les tags pour une vidéo donnée
        $dbh = Database::connect();
        $query = "SELECT similaire FROM `similaires` WHERE video=? ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Similaire');
        $sth->execute(array($video));
        $i = 0;
        while ($similaire = $sth->fetch()) {
            $similaires[$i] = $similaire;
            $i++;
        }
        $sth->closeCursor();
        if (empty($similaires)) {
            return null;
        } else {
            return $similaires;
        }
    }

}
