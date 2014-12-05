<?php
require_once 'utilities/search/search.php';
$listevideos = videoListFromQuery($query,0); //on récupère les résultats sous forme d'un tableau contenant des tableaux dont le seul champ non vide est video et qui contient l'id de la vidéo
?>
<div class="container-fluid" id="content"><!-- cette page gère l'affichage des vidéos sur la page du site.-->
    <?php
    require_once 'utilities/display/display.php';
    $nombre = count($listevideos);
    if ($nombre == 0) {
    echo <<<EOF
        <div class='col-xs-offset-3 col-xs-6'>
        <div class="alert alert-danger" role="warining" style='text-align: center'>
            <span class="glyphicon glyphicon-ban-circle"></span>
            <span class="sr-only">Attention :</span>
            Aucune vidéo de la base de donnée ne correspond à tes critères...
        </div>
    </div>
EOF;
    }
    if ($nombre <= 5) {
        foreach ($listevideos as $item) {
            videoligne($item['video']); //$item['video'] est l'id de la vidéo.
        }
        echo "</div>";
    }

    //navigationpages(1, 5, 5);
    