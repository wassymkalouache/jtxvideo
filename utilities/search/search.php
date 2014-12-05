<?php

require_once 'utilities/database/database.php';

$itemsparpage = 5;

function CreerRequete($query) {//cette fonction généère la requête à envoyer à MySQL
    //d'abord on cherche les correspondance sur le titre
    preg_match_all("/titre:\((.*)\)/i", $query, $matches, PREG_PATTERN_ORDER);
    $requete = "(SELECT videos.video FROM videos WHERE ";//d'abord on met les requêtes où le titre correspond.    
    foreach ($matches[1] as $titre) {
        $requete = $requete."titre LIKE '%$titre%' OR ";
    }
    $requete = $requete."false)";
    //là on fait la partie de la requête concernant les tags
    $termes = explode(' ',$query);//on prend séparément tous les mots de la requête
    $requete = $requete." UNION (SELECT videos.video FROM videos INNER JOIN tags ON videos.video = tags.video WHERE (";//on sélectionne la colonne 
    //vidéos depuis la jointure des tables tags et vidéos
    foreach ($termes as $terme) {
        $requete = $requete."tags.tag='{$terme}' OR ";//telles que les vidéos contiennent un des tags de la requête
    }
    $requete = $requete."false) GROUP BY videos.video ORDER BY COUNT(tags.tag) DESC)";//on regroupe les résultats par vidéo (une vidéo n'appparaît
    // qu'une seule fois et on trie par le nombre de tags associé à chaque vidéo
    return $requete;
}

function videoListFromQuery($query,$nombre) {
    global $itemsparpage;
    $dbh = Database::connect();
    $borneinf = $itemsparpage*$nombre;
    $bornesup = $itemsparpage*($nombre+1)-1;
    $requete = CreerRequete($query);
    $sth = $dbh->prepare($requete);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    return $results;
}
