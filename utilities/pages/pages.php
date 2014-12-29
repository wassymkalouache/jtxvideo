<?php

function checkpage($askedPage) {//vérifie si la page demandée est accessible
    //Chargement du fichier
    $xml = simplexml_load_file("utilities/pages/pages.xml");
    //Recuperation de l'ensemble des noeuds correspondant aux balises "note"
    $page_list = $xml;
    foreach ($page_list as $page) {
        if ($page->name == $askedPage) {
            return true;
        }
    }
    return false;
}

function getPageTitle($askedpage) {//vérifie si la page demandée est accessible
    //Chargement du fichier
    $xml = simplexml_load_file("utilities/pages/pages.xml");
    //Recuperation de l'ensemble des noeuds correspondant aux balises "note"
    $page_list = $xml;
    foreach ($page_list as $page) {
        if ($page->name == $askedpage) {
            return $page->title;
        }
    }
    return "Erreur !";
}
