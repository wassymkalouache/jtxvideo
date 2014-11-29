<?php require_once 'database.php';

class Categorie {
    public $video;
    public $categorie;

    public function __toString() {
        return $this->categorie;
    }

    public static function insererCategorie($video,$categorie) {//insère un tag pour une vidéo dans la base de données
        // opérations sur la base
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `categories` (video,categorie) VALUES(?,?)");
        $sth->execute(array($video,$categorie));
        $dbh = null; // Déconnexion de MySQL
    }

    public static function getCategoriesFromVideo($video) {//retourne tous les tags pour une vidéo donnée
        $dbh = Database::connect();
        $query = "SELECT categorie FROM `categories` WHERE video='$video' ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        $sth->execute();
        $i=0;
        while ($categorie = $sth->fetch()) {
            $categories[$i] = $categorie ;
            $i++;
        }
        $sth->closeCursor();
        if (empty($categories)) {
            return null;
        } else {
            return $categories;
        }
    }
}