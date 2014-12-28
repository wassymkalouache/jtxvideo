<div class='container-fluid'>
    <div class='col-xs-offset-3 col-xs-6'>
        <div class="alert alert-danger" role="alert" style='text-align: center'>
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Erreur :</span>
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 'forbidden') {
                echo "Tu n'as pas les droits requis pour afficher cette page. Contacte un administrateur du site si tu veux participer au projet.";
            } elseif (isset($_GET['error']) && $_GET['error'] == 'inexistent') {
                echo "La page que tu as demandée n'existe pas. Clique sur le logo en haut à droite pour revenir à la page d'accueil du site.";
            } elseif (isset($_GET['error']) && $_GET['error'] == 'videonotfound') {
                echo "La vidéo que tu essaye d'afficher n'existe pas. Clique sur le logo en haut à droite pour revenir à la page d'accueil du site.";
            } elseif (isset($_GET['error']) && $_GET['error'] == 'videonotspecified') {
                echo "Tu n'as pas spécifié de video à afficher. Clique sur le logo en haut à droite pour revenir à la page d'accueil du site.";
            } elseif (isset($_GET['error']) && $_GET['error'] == 'incorrectinput') {
                echo "Tu n'as pas rempli correctement le formulaire. Clique sur le logo en haut à droite pour revenir à la page d'accueil du site.";
            } elseif (isset($_GET['error']) && $_GET['error'] == 'updatenovideo') {
                echo "Tu n'as pas spécifié quelle vidéo tu voulais mettre à jour. Clique sur le logo en haut à droite pour revenir à la page d'accueil du site.";
            } else {
                echo "Une erreur est survenue. Clique sur le logo en haut à droite pour revenir à la page d'accueil du site.";
            }
            ?>
        </div>
    </div>
</div>

