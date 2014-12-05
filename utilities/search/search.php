<?php

require_once 'utilities/database/database.php';

$itemsparpage = 5;

function videoListFromQuery($query,$nombre) {
    global $itemsparpage;
    $dbh = Database::connect();
    $bornesup = $itemsparpage*$nombre;
    $borneinf = $itemsparpage*($nombre+1)-1;
    $requete = "SELECT video from `videos` WHERE titre LIKE '%$query%' LIMIT $borneinf,$bornesup";
    $sth = $dbh->prepare($requete);
    $sth->execute();
    $results = $sth->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    return $results;
}
