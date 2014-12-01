<?php

require_once 'utilities/database/videos.php';
require_once 'utilities/database/tags.php';
require_once 'utilities/database/categories.php';
require_once 'utilities/database/promotions.php';
require_once 'utilities/database/similaires.php';

function generateHTMLHeader($titre, $css) {//génère l'en-tête HTML commun à toutes les pages  du site
    echo <<<EOF
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8"/>
        <meta name="author" content="Denis Merigoux"/>
        <meta name="keywords" content="JTX search clips"/>
        <meta name="description" content="Le moteur de recherche de la base de données de vidéos du JTX"/>
        <!-- CSS Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Javascript de Bootstrap -->
        <script src="js/bootstrap.js"></script>
        <!-- CSS Perso -->
        <link href="$css" rel="stylesheet">
        <!-- Custom styles for sticky footer -->
        <link href="css/sticky-footer.css" rel="stylesheet">
        <title>$titre</title>
    </head>        
EOF;
}

function generatePageFooter() {//génère le pied de la page visible
    echo <<<EOF
    <div class="footer">
            <div  class="container" id="pied">
                <p class="text-muted">© Denis Merigoux – Respo archives du JTX 2013</p>        
            </div>
    </div>
EOF;
}

function generateHTMLFooter() {//génère le pied de page html présent sur toutes les pages du site
    echo "</html>";
}

function videoligne($id) {
    $video = Video::getVideoFromId($id); //charge la base de données
    $tags = Tag::getTagsFromVideo($id);
    $categories = Categorie::getCategoriesFromVideo($id);
    $promotions = Promotion::getPromotionsFromVideo($id);
    $similaires = Similaire::getSimilairesFromVideo($id);
    if ($video === null) {
        return;
    }
    echo <<<EOF
    <div class="media">
        <a href="index.php?page=video&video=$video->video" class="media-left media-middle">
            <img src="$video->poster" alt="$video->titre" width="500"></img>
        </a>
        <div class="media-body descriptionvideo">
            <div class="btn-group boutonsvideo" role="group" aria-label="Actions video">
                <a type="button" class="btn btn-primary" href="index.php?page=video&video=$video->video">Voir la vidéo</a>
                <a type="button" class="btn btn-info" href="$video->proj">Page de la proj'</a>
                <a type="button" class="btn btn-default" href="$video->adresse" target="_blank">Télécharger la vidéo</a>
            </div>
            <h1 class="media-heading">$video->titre</h1>
            <p>$video->description</p>
            <div class="row">
                <div class="col-xs-6">
                    <p class="text-muted">
                        <span class="glyphicon glyphicon-tags"> </span>&nbsp;&nbsp;
EOF;
    if (!empty($tags)) {
        foreach ($tags as $tag) {//on liste les tags les uns après les autres
            echo "$tag->tag ";
        }
    }
    echo <<<EOF
                    </p>
                    <p class="text-muted">
                        <span class="glyphicon glyphicon-folder-open"> </span>&nbsp;&nbsp;&nbsp;  
EOF;
    if (!empty($categories)) {
        foreach ($categories as $categorie) {//on liste les catégories les unes après les autres sous forme de boutons
            echo "<a type='button' class='btn btn-sm btn-warning' href='#'>$categorie->categorie</a>";
        }
    }
    echo <<<EOF
                    </p>
                </div>
                <div class="col-xs-6">
                    <p class="text-muted">
                        <span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;&nbsp; 
EOF;
    if (!empty($video->jtx)) {
        echo "<a type='button' class='btn btn-sm btn-success' href='#'>JTX $video->jtx</a> ";
    }
    if (!empty($promotions)) {
        foreach ($promotions as $promotion) {//pour la ligne « datation », on met d'abord le JTX créateur, puis les promotions concernées et enfin l'année (s'il y en a).
            echo "<a type='button' class='btn btn-sm btn-success' href='#'>$promotion->promotion</a> ";
        }
    }
    if (!empty($video->annee)) {
        echo "<a type='button' class='btn btn-sm btn-success' href='#'>$video->annee</a> ";
    }
    echo <<<EOF
                    </p>
                    <p class="text-muted">
                        <span class="glyphicon glyphicon-fast-forward"></span>&nbsp;&nbsp;&nbsp;  
EOF;
    if (!empty($similaires)) {
        foreach ($similaires as $similaire) {//on liste les catégories les unes après les autres sous forme de boutons
            $similaire = Video::getVideoFromId($similaire->similaire);
            echo "<a type='button' class='btn btn-sm btn-primary' href='index.php?page=video&video=$similaire->video'>$similaire</a> ";
        }
    }
    echo <<<EOF
                    </p>
                </div>
            </div>
        </div>
    </div>
EOF;
}

function videopage($id) {
    $video = Video::getVideoFromId($id); //charge la base de données
    $tags = Tag::getTagsFromVideo($id);
    $categories = Categorie::getCategoriesFromVideo($id);
    $promotions = Promotion::getPromotionsFromVideo($id);
    $similaires = Similaire::getSimilairesFromVideo($id);
    if ($video === null) {
        echo "La vidéo que vous voulez afficher n'existe pas !";
        return; //n'affiche rien si la video n'existe pas.   
    }
    echo <<<EOF
    <div class="jumbotron" style="text-align:center">
        <video id="spammemaybe" class="video-js vjs-default-skin" controls preload="metadata" width="800" poster="$video->poster">
            <source src="$video->adresse" type="video/webm" />
        </video>
    </div>
    <div class="container-fluid">
        <div class="btn-group boutonsvideo" role="group" aria-label="Actions video">
            <a type="button" class="btn btn-info" href="$video->proj">Page de la proj'</a>
            <a type="button" class="btn btn-default" href="$video->adresse" target="_blank">Télécharger la vidéo</a>
        </div>
        <h1 class="media-heading">$video->titre</h1>
        <p>$video->description</p>
         <div class="row">
                <div class="col-xs-6">
                    <p class="text-muted">
                        <span class="glyphicon glyphicon-tags"> </span>&nbsp;&nbsp;
EOF;
    if (!empty($tags)) {
        foreach ($tags as $tag) {//on liste les tags les uns après les autres
            echo "$tag->tag ";
        }
    }
    echo <<<EOF
                    </p>
                    <p class="text-muted">
                        <span class="glyphicon glyphicon-folder-open"> </span>&nbsp;&nbsp;&nbsp;  
EOF;
    if (!empty($categories)) {
        foreach ($categories as $categorie) {//on liste les catégories les unes après les autres sous forme de boutons
            echo "<a type='button' class='btn btn-sm btn-warning' href='#'>$categorie->categorie</a>";
        }
    }
    echo <<<EOF
                    </p>
                </div>
                <div class="col-xs-6">
                    <p class="text-muted">
                        <span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;&nbsp; 
EOF;
    if (!empty($video->jtx)) {
        echo "<a type='button' class='btn btn-sm btn-success' href='#'>JTX $video->jtx</a> ";
    }
    if (!empty($promotions)) {
        foreach ($promotions as $promotion) {//pour la ligne « datation », on met d'abord le JTX créateur, puis les promotions concernées et enfin l'année (s'il y en a).
            echo "<a type='button' class='btn btn-sm btn-success' href='#'>$promotion->promotion</a> ";
        }
    }
    if (!empty($video->annee)) {
        echo "<a type='button' class='btn btn-sm btn-success' href='#'>$video->annee</a> ";
    }
    echo <<<EOF
                    </p>
                    <p class="text-muted">
                        <span class="glyphicon glyphicon-fast-forward"></span>&nbsp;&nbsp;&nbsp;  
EOF;
    if (!empty($similaires)) {
        foreach ($similaires as $similaire) {//on liste les catégories les unes après les autres sous forme de boutons
            $similaire = Video::getVideoFromId($similaire->similaire);
            echo "<a type='button' class='btn btn-sm btn-primary' href='index.php?page=video&video=$similaire->video'>$similaire</a> ";
        }
    }
    echo <<<EOF
                    </p>
                </div>
            </div>
        </div>
    </div>
EOF;
}

function navigationpages($page, $nombre, $max) {
    echo "<nav style='text-align: center'><!--bloc pour naviguer entre les pages-->" . PHP_EOL . "<ul class='pagination'>" . PHP_EOL;
    if ($page > $page - $nombre / 2 && $page != 1) {
        echo "<li><a href='#'>&laquo;</a></li>";
    }
    for ($j = max(floor($page - $nombre / 2), 1); $j < $page; $j++) {
        echo "<li><a href='#'>$j</a></li>";
    }
    echo "<li class='active'><a href='#'>$page</a></li>";
    for ($j = $page + 1; $j <= min($page + $nombre / 2, $max); $j++) {
        echo "<li><a href='#'>$j</a></li>";
    }
    if ($page != $max) {
        echo "<li><a href='#'>&raquo;</a></li>";
    }
    echo "</ul>" . PHP_EOL . "</nav>";
}
