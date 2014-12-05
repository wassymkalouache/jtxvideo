<div class="container">
    <form class="form-signin" role="form" method="post" action="?todo=login">
        <h2 class="form-signin-heading">Connexion</h2>
        <p>Cette page est réservée aux admins du site. Si veux nous aider à améliorer le site ou gérer la base de données des vidéos, envoie un mail à <a href="mailto:denis.merigoux@gmail.com">denis.merigoux@polytechnique.edu</a>.</p>
        <?php
        if (isset($_GET['error']) && $_GET['error'] = "invalid") {
            echo <<<EOF
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Erreur :</span>
                    Le mot de passe et/ou le nom d'utilisateur sont invalides.
                </div>
EOF;
        }
        ?>
        <input type="text" class="form-control" placeholder="Login" name="login" required autofocus>
        <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
        <br>
        <p>Pas de compte utilisateur ? Enregistre-toi <a href="index.php?page=enregistrement">ici</a> !
    </form>
</div>
