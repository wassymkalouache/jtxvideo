<?php

require_once 'utilities/search/search.php';

if (isset($_SESSION['query']) && $_SESSION['query'] == $query) {//si la requête demandée a déjà été faite et que ses résultats sont déjà enregistrés, alors on ne les recalcule pas.
    $resultats = $_SESSION['resultats'];
} else {
    $_SESSION['query'] = $query; //on enregistre la requête qui vient d'être faite
    $resultatstitre = videoListFromQuerySQL(CreerRequeteTitre($query)); //on récupère les résultats de la recherche sur le titre
    $resultattstagstmp = videoListFromQuerySQL(CreerRequeteTags($query)); //et ceux de la recherche sur les tags
    $resultatstags = array();
    foreach ($resultattstagstmp as $item) {//la boucle sert à enlever les résultats « tags » qui sont déjà dans les résultats « titre »
        if (!in_array($item, $resultatstitre)) {
            $resultatstags[] = $item;
        }
    }
    $resultats = array_merge($resultatstitre, $resultatstags); //puis on fisionne
    $_SESSION['resultats'] = $resultats; //on stocke les résultats comme ça il les recalcule pas quand on change de page.
}


echo "<div class='container-fluid' id='content'>"; //on ouvre le container des vidéos
require_once 'utilities/display/display.php';
$nombre = count($resultats);
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
} else {
    $numeropage = $_GET['numero'];
    $offset = ($numeropage - 1) * $itemsparpage; //$offset est le numéro de la ligne SQL du résultat à partir de laquelle on part
    for ($i = $offset; $i <= min(count($resultats) - 1, $offset + $itemsparpage - 1); $i++) {//attention les pages commencent à 1 mais le tableau des résltats est indexé à partir de 0.
        if (isset($resultats[$i])) {//a cause du dédoublonnage qui supprime des entrées,
            $item = $resultats[$i];
            videoligne($item['video']); //$item['video'] est l'id de la vidéo.
        }
    }
    echo "</div>"; //on ferme le container des vidéos

    navigationpages($numeropage, 5, count($resultats), $query);
}

    