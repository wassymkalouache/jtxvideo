<?php

require_once 'utilities/database/videos.php';
require_once 'utilities/database/tags.php';
require_once 'utilities/database/categories.php';
require_once 'utilities/database/promotions.php';
require_once 'utilities/database/similaires.php';
require_once 'utilities/database/users.php';

//==========================================
//===============Toutes les pages===========
//==========================================

function generateHTMLHeader($titre, $css) {//génère l'en-tête HTML commun à toutes les pages  du site
    echo <<<EOF
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8"/>
        <meta name="author" content="Denis Merigoux"/>
        <meta name="keywords" content="JTX search clips"/>
        <meta name="description" content="Le moteur de recherche de la base de données de vidéos du JTX"/>
       
        <!-- On charge jQuery -->
        <script type="text/javascript" src="js/jquery-1.11.2.js"></script>
        <!-- Javascript de Bootstrap -->
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <!-- Javascript de jQueryFileTree -->
        <script type="text/javascript" src="js/jqueryFileTree.js"></script>
        <!-- Javascript perso -->
        <script type="text/javascript" src="js/code.js"></script>
    
        <!-- CSS Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <!-- CSS Perso -->
        <link href="$css" rel="stylesheet" type="text/css">
        <!-- Custom styles for sticky footer -->
        <link href="css/sticky-footer.css" rel="stylesheet" type="text/css">
        <!-- CSS de jQueryFileTree -->
        <link href="css/jQueryFileTree.css" rel="stylesheet" type="text/css">
        
        <!-- Lien vers le favicon -->
        <link rel="shortcut icon" href="favicon.ico" />
        <title>$titre</title>
    </head>        
EOF;
}

function generatePageFooter() {//génère le pied de la page visible
    echo <<<EOF
    <div class="footer">
            <div  class="container" id="pied">
                <p class="text-muted"><small>© Denis Merigoux & Wassym Kalouache – JTX 2013</small></p>        
            </div>
    </div>
EOF;
}

function generateHTMLFooter() {//génère le pied de page html présent sur toutes les pages du site
    echo "</html>";
}

//==========================================
//===============Page de recherche===========
//==========================================

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
   <div class="media videoligne">
        <a class="media-left media-middle" href="index.php?page=video&video=$video->video">
            <img src="$video->poster" alt="$video->titre" width="200" />
        </a>
        <div class="media-body descriptionvideo">
            <h4 class="media-heading"><a href="index.php?page=video&video=$video->video">$video->titre</a></h4>
            <p class="text-muted">
                <a type="button" class="btn btn-xs btn-default" href="$video->proj">Page de la proj'</a>
                &nbsp;<small><span class="glyphicon glyphicon-time"></span></small>

EOF;
    if (!empty($video->jtx)) {

        $nouvellerequete = $_GET['query'] . " JTX $video->jtx";
        $lien = "index.php?page=recherche&query=$nouvellerequete&numero=1";
        echo "<a type='button' class='btn btn-xs btn-default' href='$lien'>JTX $video->jtx</a> ";
    }
    if (!empty($promotions)) {
        foreach ($promotions as $promotion) {//pour la ligne « datation », on met d'abord le JTX créateur, puis les promotions concernées et enfin l'année (s'il y en a).
            $nouvellerequete = $_GET['query'] . " X$promotion->promotion";
            $lien = "index.php?page=recherche&query=$nouvellerequete&numero=1"; //quand on clique sur le bouton ça renvoie une nouvelle requête avec le filtre correzspondant.
            echo "<a type='button' class='btn btn-xs btn-default' href='$lien'>X$promotion->promotion</a> ";
        }
    }
    if (!empty($video->annee)) {
        $nouvellerequete = $_GET['query'] . " $video->annee";
        $lien = "index.php?page=recherche&query=$nouvellerequete&numero=1";
        echo "<a type='button' class='btn btn-xs btn-default' href='$lien'>$video->annee</a> ";
    }
//    if (!empty($similaires)) {//j'ai désactivé l'affichage des clips similaires sur la page de recherche.
//        echo "&nbsp;<small><span class='glyphicon glyphicon-fast-forward'></span></small>&nbsp;";
//        foreach ($similaires as $similaire) {//on liste les catégories les unes après les autres sous forme de boutons
//            $similaire = Video::getVideoFromId($similaire->similaire);
//            echo "<a type='button' class='btn btn-xs btn-default boutontextearaccourcir' href='index.php?page=video&video=$similaire->video'>$similaire</a> ";
//        }
//    }
    if (!empty($categories)) {
        echo "&nbsp;<small><span class='glyphicon glyphicon-folder-open'> </span></small>&nbsp;&nbsp;";
        foreach ($categories as $categorie) {//on liste les catégories les unes après les autres sous forme de boutons
            $nouvellerequete = $_GET['query'] . " cat:($categorie->categorie)";
            $lien = "index.php?page=recherche&query=$nouvellerequete&numero=1";
            echo "<a type='button' class='btn btn-xs btn-default boutontextearaccourcir' href='$lien'>$categorie->categorie</a> ";
        }
    }
    $description = preg_replace("/\[\[([^\|\]]+)(?:\||)([^|]+|)\]\]/i", "<a target=\"_blank\" href=\"$1\">$2</a>", $video->description); //on transforme la syntaxe wiki des liens
    //en liens HTML
    echo <<<EOF
            </p>
            <p class="description">$description</p>
        </div>
    </div>
EOF;
}

function navigationpages($page, $nombre, $max, $query) {
    $pagemax = ceil($max / $_SESSION['itemsparpage']); //variable $itemsparpage initialisée dans search.php normalement.
    echo "<nav style='text-align: center'><!--bloc pour naviguer entre les pages-->" . PHP_EOL . "<ul class='pagination'>" . PHP_EOL;
    if ($page > $page - $nombre / 2 && $page != 1) {
        echo "<li><a href='index.php?page=recherche&query=$query&numero=1'>&laquo;</a></li>"; //on revient au premier
    }
    for ($j = max(floor($page - $nombre / 2), 1); $j < $page; $j++) {
        echo "<li><a href='index.php?page=recherche&query=$query&numero=$j'>$j</a></li>";
    }
    echo "<li class='active'><a>$page</a></li>";
    for ($j = $page + 1; $j <= min($page + $nombre / 2, $pagemax); $j++) {
        echo "<li><a href='index.php?page=recherche&query=$query&numero=$j'>$j</a></li>";
    }
    if ($page != $pagemax) {
        $apres = $page + 1;
        echo "<li><a href='index.php?page=recherche&query=$query&numero=$pagemax'>&raquo;</a></li>"; //on avance au dernier
    }
    echo "</ul>" . PHP_EOL . "</nav>";
}

//Fonctions d'affichage pour le menu de filtrage à droite
function itemFiltre($texte, $categorie) {
    if ($categorie === "Catégories") {//l'id à mettre pour que quand on coche ça mette bien cat:(truc) change,
        //pour les promotions et jtx c'est plus facile
        echo "<li><small>$texte&nbsp;&nbsp;<input class='itemfiltre' id='cat:($texte)' type='checkbox' checked></small></li>";
    } else {
        echo "<li><small>$texte&nbsp;&nbsp;<input class='itemfiltre' id='$texte' type='checkbox' checked></small></li>";
    }
}

function categorieFiltres($categorie, $filtres) {
    echo "<p class='text-muted categoriefiltre'>$categorie :</p>";
    echo "<ul class='categoriefiltre'>";
    foreach ($filtres as $filtre) {
        itemFiltre($filtre, $categorie);
    }
    echo "</ul>";
}

//==========================================
//===============Page d'une vidéo===========
//==========================================

function videopage($id, $format) {
    $video = Video::getVideoFromId($id); //charge la base de données
    $tags = Tag::getTagsFromVideo($id);
    $categories = Categorie::getCategoriesFromVideo($id);
    $promotions = Promotion::getPromotionsFromVideo($id);
    $similaires = Similaire::getSimilairesFromVideo($id);
    if (!isset($_SESSION['query'])) {//Si on arrive sur la vidéo sans recherche, j'initialise
        //quand même la variable qui contient la recherche précédente pour que les liens sur la page marchent.
        $_SESSION['query'] = "$video->titre";
    }
    if ($video === null) {
        echo "La vidéo que vous voulez afficher n'existe pas !";
        return; //n'affiche rien si la video n'existe pas.   
    }
    echo <<<EOF
    <div class="jumbotron" style="text-align:center">
        <video class="video-js vjs-default-skin" controls preload="metadata" width="800" autoplay poster="$video->poster">
            <source src="$video->adresse" type="video/$format" />
        </video>
    </div>
    <div class="container-fluid">
        <div class="btn-group boutonsvideo" role="group" aria-label="Actions video">
            <a type="button" class="btn btn-info" href="$video->proj">Page de la proj'</a>
            <a type="button" class="btn btn-default" href="$video->adresse" target="_blank">Télécharger la vidéo</a>
EOF;
    if (isset($_SESSION['loggedIn']) && isset($_SESSION['admin']) && $_SESSION['admin']) {//option accessible aux admins loggués
        echo "<a type=\"button\" class=\"btn btn-danger\" href=\"index.php?page=ajout&mode=update&video=$video->video\">Modifier la description</a>";
    }
    $description = preg_replace("/\[\[([^\|\]]+)(?:\||)([^|]+|)\]\]/i", "<a target=\"_blank\" href=\"$1\">$2</a>", $video->description); //on transforme la syntaxe wiki des liens
    //en liens HTML
    echo <<<EOF
        </div>
        <h1 class="media-heading">$video->titre</h1>
        <p>$description</p>
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
            $nouvellerequete = $_SESSION['query'] . " cat:($categorie->categorie)";
            $lien = "index.php?page=recherche&query=$nouvellerequete&numero=1";
            echo "<a type='button' class='btn btn-sm btn-warning' href='$lien'>$categorie->categorie</a> ";
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
        $nouvellerequete = $_SESSION['query'] . " JTX $video->jtx";
        $lien = "index.php?page=recherche&query=$nouvellerequete&numero=1";
        echo "<a type='button' class='btn btn-sm btn-success' href='$lien'>JTX $video->jtx</a> ";
    }
    if (!empty($promotions)) {
        foreach ($promotions as $promotion) {//pour la ligne « datation », on met d'abord le JTX créateur, puis les promotions concernées et enfin l'année (s'il y en a).
            $nouvellerequete = $_SESSION['query'] . " X$promotion->promotion";
            $lien = "index.php?page=recherche&query=$nouvellerequete&numero=1"; //quand on clique sur le bouton ça renvoie une nouvelle requête avec le filtre correzspondant.
            echo "<a type='button' class='btn btn-sm btn-success' href='$lien'>X$promotion->promotion</a> ";
        }
    }
    if (!empty($video->annee)) {
        $nouvellerequete = $_SESSION['query'] . " $video->annee";
        $lien = "index.php?page=recherche&query=$nouvellerequete&numero=1";
        echo "<a type='button' class='btn btn-sm btn-success' href='$lien'>$video->annee</a> ";
    }
    echo <<<EOF
                    </p>
EOF;
    if (!empty($similaires)) {
        echo<<<EOF
                    <p class="text-muted">
                        <span class="glyphicon glyphicon-fast-forward"></span>&nbsp;&nbsp;&nbsp;  
EOF;
        foreach ($similaires as $similaire) {//on liste les catégories les unes après les autres sous forme de boutons
            $similaire = Video::getVideoFromId($similaire->similaire);
            echo "<a type='button' class='btn btn-sm btn-primary' href='index.php?page=video&video=$similaire->video'>$similaire</a> ";
        }
        echo "</p>";
    }
    $lastUser = Utilisateur::getUtilisateur($video->login)->_toString(); //dernier utilisateur à avoir modifié les informations de la vidéo
    echo <<<EOF
                </div>
            </div>
            <p class="text-muted">Nombre de vues : $video->vues<span style="float:right">Dernière modification par $lastUser</span></p>
        </div>
    </div>
EOF;
}
