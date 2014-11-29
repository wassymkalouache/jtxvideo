<?php require_once 'database.php';

class Tag {
    public $video;
    public $tag;

    public function __toString() {
        return $this->tag;
    }

    public static function insererTag($video,$tag) {//insère un tag pour une vidéo dans la base de données
        // opérations sur la base
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `tags` (video,tag) VALUES(?,?)");
        $sth->execute(array($video,$tag));
        $dbh = null; // Déconnexion de MySQL
    }

    public static function getTagsFromVideo($video) {//retourne tous les tags pour une vidéo donnée
        $dbh = Database::connect();
        $query = "SELECT tag FROM `tags` WHERE video='$video' ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Tag');
        $sth->execute();
        $i=0;
        while ($tag = $sth->fetch()) {
            $tags[$i] = $tag ;
            $i++;
        }
        $sth->closeCursor();
        if (empty($tags)) {
            return null;
        } else {
            return $tags;
        }
    }
}