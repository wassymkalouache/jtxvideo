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

$video = Video::getVideoFromAdress($adresse);
$id = $video->video;
Video::updateVideo($id, $titre, $adresse, $proj, $description, $jtx, $annee);

Promotion::deletePromotionsFromVideo($id); //on supprime toutes les références pour les recréer après, parce que il faut mettre à jour un ensemble de lignes
$promotions = explode(';', $promotions); //$promotions contient un truc du genre X2012;X2013
foreach ($promotions as $promotion) {
    if (preg_match("/^[0-9]{4}$/i", $promotion)) {//mais on s'en assure quand même
        Promotion::insererPromotion($id, $promotion); //on récupère pas le X devant les chiffres
    }
}

Categorie::deleteCategoriesFromVideo($id);
$categories = explode(';', $categories); //$categories contient un truc du genre Humoristique;Musical
foreach ($categories as $categorie) {
    if (!$categorie == '') {
        Categorie::insererCategorie($id, $categorie);
    }
}

Similaire::deleteSimilairesFromVideo($id);
$similaires = explode(';', $similaires); //$categories contient un truc du genre Humoristique;Musical
foreach ($similaires as $similaire) {
    if (preg_match('/^[0-9]+$/', $similaire)) {
        Similaire::insererSimilaire($id, $similaire);
    }
}

Tag::deleteTagsFromVideo($id);
$tags = explode(' ', $tags); //$tags contient un truc du genre bob moule fist
foreach ($tags as $tag) {
    if (preg_match("/^[0-9A-Z]+$/i", $tag)) {//mais on s'en assure quand même
        Tag::insererTag($id, $tag);
    }
}

if (!$noposter && preg_match("/image/i", $typeFichier)) {
//ce qui suit concerne le poster si un fichier a été uploadé.
    print_r("Coucou j'update le poster");
    $extension = preg_replace("/(.*)\.([^\.]+$)/i", '$2', basename($nomFichierOriginal)); //on récupère l'extension du fichier uploadé pour le poster
    move_uploaded_file($nomFichierServeur, "media/" . $id . "." . $extension); //on le déplace là où il faut
    Video::updatePoster($id, "media/" . $id . "." . $extension); //et on enregistre l'emplacement du poster dans la BDD;
}

header("Location:index.php?page=video&video=$id"); //ensuite on redirige vers l'affichage de la vidéo !
exit();




