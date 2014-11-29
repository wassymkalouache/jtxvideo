<?php require_once 'utilities/display.php';

//attention la variable $video a été initialisée dans index.php via $_GET['video']. La fonction videopage 
//contient un module qui filtre $video et ne permet d'afficher quelque chose uniquement si $video correspond à une id de vidéo.
videopage($video);