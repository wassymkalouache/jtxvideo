<?php

require_once 'utilities/database/database.php';

$itemsparpage = $_SESSION['itemsparpage']; //Attention définition globale, peut-être à mettre à un autre endroit pour modification par exemple dans $_SESSION.

function CreerRequete($query) {//cette fonction généère la requête à envoyer à MySQL. $query a été préalablement sécurisé.
    //définissons d'abord les patterns des expressions régulières utilisées
    $pattern_tags = "\&quot;(((?!\&quot;).)*)\&quot;"; //les tags sont délimités par des ""
    $pattern_jtx = "JTX(?:\s|)([0-9]{4})"; //JTX 2013 ou JTX2013
    $pattern_promotion = "(?:^|[^T])(?:X|X\s)([0-9]{4})"; //X2013 ou X 2013 mais pas JTX2013 ou JTX 2013
    $pattern_annee = "(?:^|[^X\s]|[^X]\s)([0-9]{4})"; //série de 4 chiffres mais ni X2013 ni X 2013 ni JTX 2013 ni JTX2013
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
        $requetedate .= "promotions.promotion = $promotion OR videos.jtx = $promotion";//quand quelqu'un entre X2012 ça veut peut-être dire JTX 2012...
    }
    unset($matches);
    preg_match_all("/" . $pattern_annee . "/i", $query, $matches); //et enfin les annees
    foreach ($matches[1] as $annee) {
        $requetedate .= "video.annee = $annee OR ";
    }
    if ($requetedate == "") {//Cette chaîne de OR va être utilisée avec un AND ;
        $requetedate .= "true"; //si elle est vide, pour ne pas influer sur le AND, on la remplit avec true
    } else {
        $requetedate .= "false"; //si elle contient quelque chose, on la termine par un false qui est l'élément neutre du OR
    }

    //Cherchons maintenant les correspondances dans les titres
    $querytitre = preg_replace("/(\s*$pattern_tags\s*|\s*$pattern_jtx\s*|\s*$pattern_annee\s*|\s*$pattern_promotion\s*)/i", '', $query);
    //il faut enlever de la recherche sur le titre tout ce qui sert aux tags et à la datation, et qui est donné par la regexp ci-dessus.
    if ($querytitre == "") {
        //si pas de requête sur le titre on enlève ce critère de recherche
        $requetetitre = "SELECT videos.video FROM videos WHERE false";
    } else {
        $requetetitre = "SELECT videos.video FROM videos LEFT JOIN promotions ON videos.video = promotions.video WHERE ((videos.titre LIKE '%$querytitre%') AND ($requetedate))";
        //la requete doit tenir compte de la table videos et promotions; LEFT JOIN pour ne pas exclure les vidéos ne possédant pas d'entrée dans la table promotion.
    }


    //là on fait la partie de la requête concernant les tags
    $requetetags = "SELECT videos.video FROM videos INNER JOIN tags ON videos.video = tags.video "
            . "LEFT JOIN promotions ON videos.video = promotions.video "
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
    $requetetags .= "false) AND ($requetedate)) GROUP BY videos.video ORDER BY COUNT(tags.tag) DESC"; //on regroupe les résultats par vidéo (une vidéo n'appparaît
    // qu'une seule fois et on trie par le nombre de tags associé à chaque vidéo

    $requete = "(" . $requetetitre . ") UNION (" . $requetetags . ")"; //on construit finalement la requête.
    return $requete;
}

function videoListFromQuery($query) {//cette fonction exécute la requête et en limite les résultats pour une affichage par pages.
    global $itemsparpage;
    $dbh = Database::connect();
    $requete = CreerRequete($query);
    $sth = $dbh->prepare($requete);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    return $results;
}
