<?php
require_once 'utilities/search/search.php';
require_once 'utilities/misc.php'; //contient la fonction secure

if (isset($_GET['query'])) {
            $query = $_GET['query']; //pour éviter d'avoir à se traîner le $_GET partout
        } else {
            $query = Video::titreAleatoire(); //si le mec a magouillé et a supprimé le query= de l'URL on balance une vidéo aléatoire.
        }


if (isset($_SESSION['query']) && $_SESSION['query'] == $query) {//si la requête demandée a déjà été faite et que ses résultats sont déjà enregistrés, alors on ne les recalcule pas.
    $resultats = $_SESSION['resultats'];
} else {
    $_SESSION['query'] = $query; //on enregistre la requête qui vient d'être faite
    $resultatstitre = RequeteTitre($query); //on récupère les résultats de la recherche sur le titre
    $resultattstagstmp = RequeteTags($query); //et ceux de la recherche sur les tags
    $resultatstags = array();
    foreach ($resultattstagstmp as $item) {//la boucle sert à enlever les résultats « tags » qui sont déjà dans les résultats « titre »
        if (!in_array($item, $resultatstitre)) {
            $resultatstags[] = $item;
        }
    }
    $resultats = array_merge($resultatstitre, $resultatstags); //puis on fusionne
    $_SESSION['resultats'] = $resultats; //on stocke les résultats comme ça il les recalcule pas quand on change de page.
}
?>
<div class="container-fluid menufiltre">
    <p class="text-muted" style="margin-top:10px; margin-bottom:10px;">Ajouter un filtre :</p>
    <select id="selectajoutfiltre">
        <option disabled selected value="Type">Type</option>
        <option value="Catégorie">Catégorie</option>
        <option value="JTX">JTX</option>
        <option value="Promotion">Promotion</option>
        <option value="Année">Année</option>
    </select>
    <div class='input-group-sm ajoutfiltre divajoutfiltrage'>
        <input class='form-control' id="inputajoutfiltre"><!--Div modifié par une fonction javascript présente dans code.js-->
    </div>
    <div style='text-align:center' class="divajoutfiltrage">
        <button class='btn btn-primary btn-xs' type='submit' id="boutonajoutfiltre">Filtrer</button>
    </div>
    <hr style="margin-top:10px;margin-bottom:10px;">
    <?php
    require_once 'utilities/search/filtre.php'; //là on va construire le menu évolutif des filtres en cours sur la reqûete

    $tableaufiltresjtx = tableauFiltresJtx($query);
    if (!empty($tableaufiltresjtx)) {
        categorieFiltres("JTX", $tableaufiltresjtx);
    }
    $tableaufiltrespromotion = tableauFiltresPromotion($query);
    if (!empty($tableaufiltrespromotion)) {
        categorieFiltres("Promotions", $tableaufiltrespromotion);
    }
    $tableaufiltresannee = tableauFiltresAnnee($query);
    if (!empty($tableaufiltresannee)) {
        categorieFiltres("Années", $tableaufiltresannee);
    }
    $tableaufiltrescategorie = tableauFiltresCategorie($query);
    if (!empty($tableaufiltrescategorie)) {
        categorieFiltres("Catégories", $tableaufiltrescategorie);
    }
    ?>
    <div id="divsuppressionfiltrage">
        <button class='btn btn-primary btn-xs' type='submit' id="boutonsuppressionfiltre">Filtrer</button>
    </div>
</div>

<?php
echo "<div class='container-fluid' id='conteneurvideos'>"; //on ouvre le container des vidéos
require_once 'utilities/display/display.php';
$nombre = count($resultats);
if ($nombre == 0) {
    echo <<<EOF
        <div class="alert alert-danger" role="warining" style='text-align: center'>
            <span class="glyphicon glyphicon-ban-circle"></span>
            <span class="sr-only">Attention :</span>
            Aucune vidéo de la base de donnée ne correspond à tes critères...
        </div>
    </div>
EOF;
} else {
    if (!isset($_GET['numero'])) {//si jamais le numéro page est pas défini (ce qui ne devrait pas arriver sauf bidouille) on le met à 1
        $numeropage = 1;
    } else {
        $numeropage = $_GET['numero'];
    }
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

    
