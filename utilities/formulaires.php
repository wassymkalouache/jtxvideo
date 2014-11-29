<?php

function printLoginForm() {
    echo <<<EOF
    <div class="container">
        <form class="form-signin" role="form" method="post" action="index.php">
            <h2 class="form-signin-heading">Connexion</h2>
            <p>Cette page est réservée aux admins du site. Si veux nous aider à améliorer le site ou gérer la base de données des vidéos, envoie un mail à <a href="mailto:denis.merigoux@gmail.com">denis.merigoux@polytechnique.edu</a>.</p>
            <input type="text" class="form-control" placeholder="Login" name="login" required autofocus>
            <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" required>
           <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
        </form>
    </div>
EOF;
}

