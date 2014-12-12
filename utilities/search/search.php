<?php

require_once 'utilities/database/database.php';

$itemsparpage = $_SESSION['itemsparpage']; //Attention définition globale, peut-être à mettre à un autre endroit pour modification par exemple dans $_SESSION.
//définissons d'abord les patterns des expressions régulières utilisées
$pattern_tags = "\&quot;(((?!\&quot;).)*)(\&quot;|$)"; //les tags sont délimités par des ""
$pattern_jtx = "JTX\s{0,1}([0-9]{4})"; //JTX 2013 ou JTX2013
$pattern_promotion = "(?<=^|[^T])(?:X|X\s)([0-9]{4})"; //X2013 ou X 2013 mais pas JTX2013 ou JTX 2013
$pattern_annee = "(?:^|[^X\s]|[^X]\s)([0-9]{4})"; //série de 4 chiffres mais ni X2013 ni X 2013 ni JTX 2013 ni JTX2013
$pattern_categorie = "cat\:\(([^\)]*)(\)|$)"; //un truc du genre cat:(machin truc).

function cleanQuery ($query) {//uniformise le contenu de la query par rapport aux filtres temporels, de catégorie, etc.
    global $pattern_jtx, $pattern_annee, $pattern_promotion;
    $result = preg_replace("/".$pattern_jtx."/i","JTX $1",$query);//corrige les JTX
    $result = preg_replace("/".$pattern_promotion."/i","X$1",$result);//corrige les promotions
    $result = preg_replace("/cat\:\(\s*(.*)\s*\)/i","cat:($1)",$result);//corrige les categories
    $result = preg_replace("/cat\:\((.*),\s*(.*)\)/i","cat:($1, $2)",$result);//corrige les categories
    return $result;
}

function CreerRequeteDate($query) {
    global $pattern_jtx, $pattern_annee, $pattern_promotion;
    //cette fonction généère les conditions temporelles utilisées dans les autres requêtes MySQL. $query a été préalablement sécurisé.
    //le principe de la recherche est le suivant : d'abord on recherche la correspondance au niveau des titres, puis au niveau des tags.
    //Que ce soit pour les titres ou les tags, on ne prend que les vidéos correspondant à l'un des paramètres temporels donnés.
    //commençons par extraire les paramètres temporels et les concaténer comme une série de conditions reliées par des OR    
    $requetedate = "";
    unset($matches);
    preg_match_all("/" . $pattern_jtx . "/i", $query, $matches); //d'abord les jtx
    foreach ($matches[1] as $jtx) {
        $requetedate .= "videos.jtx = $jtx OR ";
    }
    unset($matches);
    preg_match_all("/" . $pattern_promotion . "/i", $query, $matches); //ensuite les promotions
    foreach ($matches[1] as $promotion) {
        $requetedate .= "promotions.promotion = $promotion OR videos.jtx = $promotion OR "; //quand quelqu'un entre X2012 ça veut peut-être dire JTX 2012...
    }
    unset($matches);
    preg_match_all("/" . $pattern_annee . "/i", $query, $matches); //et enfin les annees
    foreach ($matches[1] as $annee) {
        $requetedate .= "videos.annee = $annee OR ";
    }
    if ($requetedate == "") {//Cette chaîne de OR va être utilisée avec un AND ;
        $requetedate .= "true"; //si elle est vide, pour ne pas influer sur le AND, on la remplit avec true
    } else {
        $requetedate .= "false"; //si elle contient quelque chose, on la termine par un false qui est l'élément neutre du OR
    }
    return $requetedate;
}

function CreerRequeteCategorie($query) {
    global $pattern_categorie;
    //cette fonction génère la condition MySQL que l'on va mettre pour filter selon la bonne catégorie dans les requête MySQL
    $requetecategorie = "";
    unset($matches);
    preg_match_all("/" . $pattern_categorie . "/i", $query, $matches); //on récupère tous les blocs de catégorie
    foreach ($matches[1] as $chaine) {
        $categories = explode(', ', $chaine); //on récupère tous les catégories à l'intérieur de chaque bloc sous forme d'un tableau
        foreach ($categories as $categorie) {
            $requetecategorie .= "categories.categorie = '$categorie' OR "; //et on met une condition par catégorie
        }
    }
    if ($requetecategorie == "") {//Cette chaîne de OR va être utilisée avec un AND ;
        $requetecategorie .= "true"; //si elle est vide, pour ne pas influer sur le AND, on la remplit avec true
    } else {
        $requetecategorie .= "false"; //si elle contient quelque chose, on la termine par un false qui est l'élément neutre du OR
    }
    return $requetecategorie;
}

function RequeteTitre($query) {
    global $pattern_jtx, $pattern_annee, $pattern_promotion, $pattern_tags, $pattern_categorie;
    //Cherchons maintenant les correspondances dans les titres
    $querytitre = preg_replace("/(\s*$pattern_tags|\s*$pattern_jtx|\s*$pattern_annee|\s*$pattern_promotion|\s*$pattern_categorie)/i", '', $query);
    //il faut enlever de la recherche sur le titre tout ce qui sert aux tags et à la datation, et qui est donné par la regexp ci-dessus.
    $requetedate = CreerRequeteDate($query);
    $requetecategorie = CreerRequeteCategorie($query);
    if ($querytitre == "") {
        //si pas de requête sur le titre on enlève ce critère de recherche
        $requetetitre = "SELECT videos.video FROM videos WHERE false";
    } elseif ($querytitre == "*") {
        //si étoile on prend tout
        $requetetitre = "SELECT videos.video FROM videos LEFT JOIN promotions ON videos.video = promotions.video LEFT JOIN categories ON categories.video = videos.video"
                . " WHERE (($requetedate) AND ($requetecategorie)) GROUP BY videos.video";
    } else {
        $requetetitre = "SELECT videos.video FROM videos LEFT JOIN promotions ON videos.video = promotions.video LEFT JOIN categories ON categories.video = videos.video"
                . " WHERE ((videos.titre LIKE ?) AND ($requetedate) AND ($requetecategorie)) GROUP BY videos.video";
        //la requete doit tenir compte de la table videos et promotions; LEFT JOIN pour ne pas exclure les vidéos ne possédant pas d'entrée dans la table promotion.
    }//Maintenant que la requête est construite, on la soumet à la base de donnée
    $dbh = Database::connect();
    $sth = $dbh->prepare($requetetitre);
    $sth->execute(array('%'.$querytitre.'%'));
    $results = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    return $results;
}

function RequeteTags($query) {
    global $pattern_jtx, $pattern_annee, $pattern_promotion, $pattern_tags, $pattern_categorie;
    //là on fait la partie de la requête concernant les tags
    $querytitre = preg_replace("/(\s*$pattern_tags\s*|\s*$pattern_jtx\s*|\s*$pattern_annee\s*|\s*$pattern_promotion\s*|\s*$pattern_categorie\s*)/i", '', $query);
    //il faut enlever de la recherche sur le titre tout ce qui sert aux tags et à la datation, et qui est donné par la regexp ci-dessus.
    $requetetags = "SELECT videos.video FROM videos INNER JOIN tags ON videos.video = tags.video "
            . "LEFT JOIN promotions ON videos.video = promotions.video "
            . "LEFT JOIN categories ON categories.video = videos.video "
            . "WHERE (("; //on sélectionne la colonne vidéos depuis la jointure des tables tags et vidéos et promotions
    preg_match_all("/" . $pattern_tags . "/i", $query, $matches, PREG_PATTERN_ORDER); //récupère toutes les listes de tags entre "".
    foreach ($matches[1] as $listetags) {
        $termes = explode(' ', $listetags); //on prend séparément tous les mots de la requête
        foreach ($termes as $terme) {
            $terme = iconv('UTF-8', 'ASCII//TRANSLIT', $terme); //comme les tags sont enregistrés sans accents, on les enlève de la requête grâce à ça
            $terme = preg_replace("/[^a-z0-9]/i", '', $terme); //mais malheureusement la fonction au dessus remplace ô par ^o donc il faut enlever la merde
            $requetetags .= "tags.tag='{$terme}' OR tags.tag='{$terme}s' OR "; //telles que les vidéos contiennent un des tags de la requête
        }
    }
    $requetedate = CreerRequeteDate($query);
    $requetecategorie = CreerRequeteCategorie($query);
    $requetetags .= "false) AND ($requetedate) AND ($requetecategorie)) GROUP BY videos.video ORDER BY COUNT(tags.tag) DESC"; //on regroupe les résultats par vidéo (une vidéo n'appparaît
    // qu'une seule fois et on trie par le nombre de tags associé à chaque vidéo
    $dbh = Database::connect();//maintenant on soumet la requête à la BDD. Comme les tags sont en ASCII et que $_GET a été sécurisé, pas de risques d'injection SQL.
    $sth = $dbh->prepare($requetetags);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    return $results;
}