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
var_dump($video);
$id = $video->video;

$promotions = explode(';', $promotions); //$promotions contient un truc du genre X2012;X2013
foreach ($promotions as $promotion) {
    if (preg_match("/^[0-9]{4}$/i", $promotion)) {//mais on s'en assure quand même
        Promotion::insererPromotion($id, $promotion); //on récupère pas le X devant les chiffres
    }
}

$categories = explode(';', $categories); //$categories contient un truc du genre Humoristique;Musical
foreach ($categories as $categorie) {
    if (!$categorie == '') {
        Categorie::insererCategorie($id, $categorie);
    }
}

$similaires = explode(';', $similaires); //$categories contient un truc du genre Humoristique;Musical
foreach ($similaires as $similaire) {
    if (preg_match('/^[0-9]+$/',$similaire)) {
        Similaire::insererSimilaire($id, $similaire);
    }
}

$tags = explode(' ', $tags); //$tags contient un truc du genre bob moule fist
var_dump($tags);
foreach ($tags as $tag) {
    if (preg_match("/^[0-9A-Z]+$/i", $tag)) {//mais on s'en assure quand même
        Tag::insererTag($id, $tag);
    }
}

header("Location:index.php?page=video&video=$id"); //ensuite on redirige vers l'affichage de la vidéo !
exit();




