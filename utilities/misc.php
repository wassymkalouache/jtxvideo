<?php

function secure($tab){//transforme les caractères spéciaux de PHP et HTML en des expressions innofensives.
    foreach ($tab as $cle => $valeur){
        $tab[$cle]=  htmlspecialchars($valeur);
    }
    return $tab;
}