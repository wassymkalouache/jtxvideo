<?php

require_once 'utilities/database/database.php';

$itemsparpage = 5;

function CreerRequete($query) {
    $termes = explode(' ',$query);//on prend séparément tous les mots de la requête
    $requete = "SELECT videos.video, COUNT(tags.tag) AS nombredetags FROM videos INNER JOIN tags ON videos.video = tags.video WHERE (";
    foreach ($termes as $terme) {
        $requete = $requete."tags.tag='{$terme}' OR ";
    }
    $requete = $requete."false) GROUP BY videos.video ORDER BY nombredetags DESC";
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
