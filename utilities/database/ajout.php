<?php

require_once 'videos.php';
require_once 'tags.php';
require_once 'promotions.php';
require_once 'categories.php';
require_once 'similaires.php';

//ce script est exécuté après pression du bouton « AJouter une vidéo »
// sur le formulaire d'ajout d'une vidéo. Il ajoute une vidéo dans la BDD à partir des paramètres passés en post qui ont été transformé en variable dans contenu_video :
//           adresse
//           extension
//           titre
//           proj
//           jtx
//           annee
//           promotions
//           categories
//           tags
//           description
//           poster
//Les filtres sur les inputs sont faits directement au niveau des fonctions d'ajout (voir fichiers correspondants).


Video::insererVideo($titre, $adresse, $proj, $description, $jtx, $annee, $_SESSION['login']);
$video = Video::getVideoFromAdress($adresse);
$id = $video->video;

$promotions = explode(';', $promotions); //$promotions contient un truc du genre X2012;X2013
foreach ($promotions as $promotion) {
    Promotion::insererPromotion($id, $promotion);
}

$categories = explode(';', $categories); //$categories contient un truc du genre Humoristique;Musical
foreach ($categories as $categorie) {
    Categorie::insererCategorie($id, $categorie);
}

$similaires = explode(';', $similaires); //$categories contient un truc du genre Humoristique;Musical
foreach ($similaires as $similaire) {
    Similaire::insererSimilaire($id, $similaire);
}

$tags = explode(' ', $tags); //$tags contient un truc du genre bob moule fist
foreach ($tags as $tag) {
    Tag::insererTag($id, $tag);
}

if (!$noposter && preg_match("/image/i", $typeFichier)) {
//ce qui suit concerne le poster si un fichier a été uploadé.
    $extension = preg_replace("/(.*)\.([^\.]+$)/i", '$2', basename($nomFichierOriginal)); //on récupère l'extension du fichier uploadé pour le poster
    move_uploaded_file($nomFichierServeur, "media/" . $id . "." . $extension); //on le déplace là où il faut
    Video::updatePoster($id, "media/" . $id . "." . $extension); //et on enregistre l'emplacement du poster dans la BDD;
}

unset($_SESSION['query']); //comme ça si la précédente requête devait afficher la nouvelle vidéo ça recalculer et ça la montre
header("Location:index.php?page=video&video=$id"); //ensuite on redirige vers l'affichage de la vidéo !
exit();




