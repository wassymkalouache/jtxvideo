<?php

require_once 'utilities/search/search.php';

function tableauFiltresJtx($query) {//permet de créer le tableau des filtres liés aux JTX à partir de la requête
    global $pattern_jtx;
    $filtresjtx = null;
    preg_match_all("/" . $pattern_jtx . "/i", $query, $matches); //d'abord les jtx
    foreach ($matches[1] as $jtx) {
        $filtresjtx[] = "JTX $jtx";
    }
    if (!empty($filtresjtx)) {
        return array_unique($filtresjtx);
    }
    return null;
}

function tableauFiltresPromotion($query) {//permet de créer le tableau des filtres liés aux promotions à partir de la requête
    global $pattern_promotion;
    $filtrespromotion = null;
    preg_match_all("/" . $pattern_promotion . "/i", $query, $matches);
    foreach ($matches[1] as $promotion) {
        $filtrespromotion[] = "X$promotion";
    }
    if (!empty($filtrespromotion)) {
        return array_unique($filtrespromotion);
    }
    return null;
}

function tableauFiltresAnnee($query) {//permet de créer le tableau des filtres liés aux années à partir de la requête
    global $pattern_annee;
    $filtresannee = null;
    preg_match_all("/" . $pattern_annee . "/i", $query, $matches);
    foreach ($matches[1] as $annee) {
        $filtresannee[] = $annee;
    }
    if (!empty($filtresannee)) {
        return array_unique($filtresannee);
    }
    return null;
}

function tableauFiltresCategorie($query) {//permet de créer le tableau des filtres liés aux catégories à partir de la requête
    global $pattern_categorie;
    $filtrescategorie = null;
    preg_match_all("/" . $pattern_categorie . "/i", $query, $matches);
    foreach ($matches[1] as $chaine) {
        $categories = explode(', ', $chaine); //on récupère tous les catégories à l'intérieur de chaque bloc sous forme d'un tableau
        foreach ($categories as $categorie) {
            if (trim($categorie)) {//si la catégorie n'est pas une chaîne vide
            $filtrescategorie[] = $categorie;
            }
        }
    }
    if (!empty($filtrescategorie)) {
        return array_unique($filtrescategorie);
    }
    return null;
}
