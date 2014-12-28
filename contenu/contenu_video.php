<?php

require_once 'utilities/display/display.php';
require_once 'utilities/database/videos.php';

if (isset($_GET['todo']) && ($_GET['todo'] == 'insert' | $_GET['todo'] == 'update')) {//la partie suvante s'éxecute si jamais on veut ajouter ou modifier une vidéo
    $inputcorrect = true; //il faut vérifier si tous les paramètres sont bien définis, on définit au passage des variables utilisées dans ajout.php
    if (isset($_POST['adresse'])) {
        $adresse = $_POST['adresse'];
    } else {
        $inputcorrect = false;
    }
    if (isset($_POST['extension'])) {
        $extension = $_POST['extension'];
    } else {
        $inputcorrect = false;
    }
    if (isset($_POST['titre'])) {
        $titre = $_POST['titre'];
    } else {
        $inputcorrect = false;
    }
    if (isset($_POST['proj'])) {
        $proj = $_POST['proj'];
    } else {
        $inputcorrect = false;
    }
    if (isset($_POST['jtx'])) {
        $jtx = $_POST['jtx'];
    } else {
        $inputcorrect = false;
    }
    if (isset($_POST['annee'])) {
        $annee = $_POST['annee'];
    } else {
        $inputcorrect = false;
    }
    if (isset($_POST['promotions'])) {
        $promotions = $_POST['promotions'];
    } else {
        $promotions = false;
    }
    if (isset($_POST['categories'])) {
        $categories = $_POST['categories'];
    } else {
        $promotions = false;
    }
    if (isset($_POST['similaires'])) {
        $similaires = $_POST['similaires'];
    } else {
        $promotions = false;
    }
    if (isset($_POST['tags'])) {
        $tags = $_POST['tags'];
    } else {
        $promotions = false;
    }
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        $promotions = false;
    }
    if (isset($_POST['poster'])) {
        $poster = $_POST['poster'];
    } else {
        $promotions = false;
    }
    if ($inputcorrect) {
        if ($_GET['todo'] == 'insert') {
            require_once 'utilities/database/ajout.php';
        } elseif ($_GET['todo'] == 'update') {
            require_once 'utilities/database/update.php';
        }
    } else {
        header("Location:index.php?page=error&error=incorrectinput");
    }
}

$videoBDD = Video::getVideoFromId($video);
if (!$videoBDD == null) {
//attention la variable $video a été initialisée dans index.php via $_GET['video']. La fonction videopage 
//contient un module qui filtre $video et ne permet d'afficher quelque choses uniquement si $video correspond à une id de vidéo.
    videopage($video, $videoBDD->format);
} else {
    header("Location:index.php?page=error&error=videonotfound");
    exit();
}

