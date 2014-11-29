<?php require_once 'database.php';

class Promotion {
    public $video;
    public $promotion;

    public function __toString() {
        return $this->promotion;
    }

    public static function insererPromotion($video,$promotion) {//insère un tag pour une vidéo dans la base de données
        // opérations sur la base
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `promotions` (video,promotion) VALUES(?,?)");
        $sth->execute(array($video,$promotion));
        $dbh = null; // Déconnexion de MySQL
    }

    public static function getPromotionsFromVideo($video) {//retourne tous les tags pour une vidéo donnée
        $dbh = Database::connect();
        $query = "SELECT promotion FROM `promotions` WHERE video='$video' ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Promotion');
        $sth->execute();
        $i=0;
        while ($promotion = $sth->fetch()) {
            $promotions[$i] = $promotion ;
            $i++;
        }
        $sth->closeCursor();
        if (empty($promotions)) {
            return null;
        } else {
            return $promotions;
        }
    }
}