<?php
session_name("JtxVideo");
// ne pas mettre d'espace dans le nom de session !
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
}
// Décommenter la ligne suivante pour afficher le tableau $_SESSION pour le debuggage
// print_r($_SESSION);
$_SESSION['itemsparpage']=12;//variable globale définie ici.

require_once 'utilities/misc.php';//contient la fonction secure
$_GET = secure($_GET);//sécurise les inputs dans GET et POST.
$_POST = secure($_POST);

require_once 'utilities/connexion/logInOut.php';
if (isset($_GET['todo']) && $_GET['todo'] == "login") {//si l'on vient sur index.php depuis la page de connexion, ce paramtre est vrai. Sinon on ignore.
    LogIn();
}
if (isset($_GET['todo']) && $_GET['todo'] == "logout") {//permet la déconnexion
    LogOut();
}
require_once 'utilities/connexion/signup.php';
if (isset($_GET['todo']) && $_GET['todo'] == "signup") {//cette fonction s'éxécute si l'on provient de la page d'enregistrement
    Signup();
}
require_once 'utilities/connexion/changemdp.php';
if (isset($_GET['todo']) && $_GET['todo'] == "changemdp") {//cette fonction s'éxécute si l'on vient de la page compte et que l'on a rempli le formulaire
    Changemdp();
}
require_once 'utilities/connexion/deleteuser.php';
if (isset($_GET['todo']) && $_GET['todo'] == "deleteuser") {//cette fonction s'éxécute si l'on vient de la page compte et que l'on a rempli le formulaire
    SupprimerCompte();
}

require 'utilities/pages.php';
if (array_key_exists('page', $_GET)) {//il faut que la page existe et que l'utilisateur soit connecté
    $askedPage = $_GET['page'];
} else {
    $askedPage = "accueil";
}//cette condition récupère le nom de la page à afficher.
$authorized = checkpage($askedPage); //détermine si l'on peut afficher la page demandée(existe et a les droits d'accès)
if ($authorized) {
    $pageTitle = getPageTitle($askedPage);
} else {
    $pageTitle = "Erreur !";
}//Le titre de la page est dans $pageTitle
?>

<?php
require 'utilities/display/display.php';
if ($askedPage == "login" || $askedPage == "enregistrement" || $askedPage == "compte" || $askedPage=="ajout") {//si l'on veut la page de login, le style est différent.
    generateHTMLHeader($pageTitle, "css/signin.css");
} else {
    generateHTMLHeader($pageTitle, "css/perso.css");
}
?>
<body>
    <div id="header">
        <?php
        if ($authorized && ($askedPage == "accueil")) {
            require 'navbar/navbar_accueil.php';
        } else {
            require 'navbar/navbar.php';
        }//pour afficher la barre de navigation en haut.
        ?>
    </div>
    <?php
    if ($authorized) {
        if ($askedPage == "video") {
            $video = $_GET['video'];//la variable $video est réutilisée dans contenu_video
            require "contenu/contenu_video.php";
        } elseif ($askedPage == "recherche") {
            $query = $_GET['query'];//pour éviter d'avoir à se traîner le $_GET partout
            require "contenu/contenu_recherche.php";
        } else {
            require "contenu/contenu_{$askedPage}.php";
        }
    } else {
        require "contenu/contenu_erreur.php";
    }
    ?>
    <?php
    generatePageFooter();
    ?>
</body>
<?php
require_once 'utilities/display/display.php';
generateHTMLFooter();

