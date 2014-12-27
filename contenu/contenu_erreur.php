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
            } else {
                echo "Une erreur est survenue. Clique sur le logo en haut à droite pour revenir à la page d'accueil du site.";
            }
            ?>
        </div>
    </div>
</div>

