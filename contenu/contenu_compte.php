<?php require_once 'utilities/database/users.php'; ?>
<div class="container-fluid">
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <h2>Informations personnelles</h2>
            <ul class='list-group'>
                <?php $user = Utilisateur::getUtilisateur($_SESSION['login']) ?>
                <li class='list-group-item'>Login : <span style='float:right'><?php echo "$user->login" ?></span></li>
                <li class='list-group-item'>Nom : <span style='float:right'><?php echo "$user->nom" ?></span></li>
                <li class='list-group-item'>Prénom : <span style='float:right'><?php echo "$user->prenom" ?></span></li>
                <li class='list-group-item'>Promotion : <span style='float:right'><?php echo "$user->promo" ?></span></li>
                <li class='list-group-item'>E-mail : <span style='float:right'><?php echo "$user->email" ?></span></li>
        </div>
    </div>
</div>


<form class="form-signup" role="form" method="post" action="index.php?todo=changemdp" oninput="up2.setCustomValidity(new.value != new2.value ? 'Les mots de passe diffèrent.' : '')">
    <h2 class="form-signin-heading">Changer le mot de passe</h2>
    <p>Si tu as perdu ton mot de passe, <a href="mailto:denis.merigoux@polytechnique.edu">envoie un mail</a>.</p>
    <?php
    if (isset($_GET['error']) && $_GET['error'] == "old") {
        echo <<<EOF
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Erreur :</span>
                    L'ancien mot de passe n'est pas le bon.
                </div>
EOF;
    }
    if (isset($_GET['error']) && $_GET['error'] == "new") {
        echo <<<EOF
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Erreur :</span>
                    Les deux nouveaux mots de passe ne sont pas les mêmes.
                </div>
EOF;
    }
    ?>
    <input type="password" class="form-control" placeholder="Ancien mot de passe" name="old" required>
    <input type="password" class="form-control" placeholder="Nouveau mot de passe" name="new" required>
    <input type="password" class="form-control" placeholder="Confirmer le nouveau mot de passe" name="new2" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
</form>

<form class="form-signup" role="form" method="post" action="index.php?todo=deleteuser">
    <h2 class="form-signin-heading">Supprimer le compte</h2>
    <p>Attention, cette action est irréversible.</p>
    <?php
    if (isset($_GET['error']) && $_GET['error'] == "old") {
        echo "<p>Ton mot de passe est incorrect.</p>";
    }
    ?>
    <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Valider</button>
</form>
