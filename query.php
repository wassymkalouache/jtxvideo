<?php

require_once 'utilities/users.php';
require_once 'utilities/tags.php';
require_once 'utilities/display.php';
require_once 'utilities/categories.php';
require_once 'utilities/.php';

generateHTMLHeader("Test", 'css/perso.css');
echo Utilisateur::getUtilisateur("denis.merigoux");

//Similaire::insererSimilaire(1,3);