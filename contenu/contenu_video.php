<?php

require_once 'utilities/display/display.php';
require_once 'utilities/database/videos.php';

//attention la variable $video a été initialisée dans index.php via $_GET['video']. La fonction videopage 
//contient un module qui filtre $video et ne permet d'afficher quelque choses uniquement si $video correspond à une id de vidéo.
        videopage($video, Video::getVideoFromId($video)->format);
