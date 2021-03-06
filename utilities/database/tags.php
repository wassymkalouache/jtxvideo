<?php

require_once 'database.php';

class Tag {

    public $video;
    public $tag;

    public function __toString() {
        return $this->tag;
    }

    public static function insererTag($video, $tag) {//insère un tag pour une vidéo dans la base de données
        // opérations sur la base
        $insertedtag = iconv('UTF-8', 'ASCII//TRANSLIT', $tag);
        $insertedtag = preg_replace("/[^\sa-z0-9]/i", '', $insertedtag); //on nettoie les tags proposés des termes accentués
        $insertedtag = strtolower($insertedtag); //on met tout en minuscule
        $insertedtag = preg_replace("/\s+/i", '', $insertedtag); //on s'assure qu'il n'y ait bien qu'un seul espace entre les tags
        if ($tags != '') {
            $dbh = Database::connect();
            $sth = $dbh->prepare("INSERT INTO `tags` (video,tag) VALUES(?,?)");
            $sth->execute(array($video, $tag));
            $dbh = null; // Déconnexion de MySQL
            return true;
        } else {
            return false;
        }
    }

    public static function deleteTagsFromVideo($video) {//supprime toutes les catégories associées à une vidéo (utile pour la mise à jour)
        // opérations sur la base
        $dbh = Database::connect();
        $sth = $dbh->prepare("DELETE FROM `tags` WHERE video=?");
        $sth->execute(array($video));
        $dbh = null; // Déconnexion de MySQL
    }

    public static function getTagsFromVideo($video) {//retourne tous les tags pour une vidéo donnée
        $dbh = Database::connect();
        $query = "SELECT tag FROM `tags` WHERE video=? ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Tag');
        $sth->execute(array($video));
        $i = 0;
        while ($tag = $sth->fetch()) {
            $tags[$i] = $tag;
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
