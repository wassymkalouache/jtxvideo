<?php
if (isset($_GET['error'])&&$_GET['error']&&isset($_GET['login'])&&isset($_GET['nom'])&&isset($_GET['prenom'])&&isset($_GET['promotion'])&&isset($_GET['email'])) {
    echo <<<EOF
    <div class="container">
        <form class="form-signup" role="form" method="post" action="?todo=signup" oninput="up2.setCustomValidity(up2.value != up.value ? 'Les mots de passe diffèrent.' : '')">
            <h2 class="form-signin-heading">Enregistrement</h2>
            <p>Un autre utilisateur possède déjà le même login. Choisis-en un autre.</p>
            <input type="text" class="form-control" placeholder="Login" name="login" value={$_GET['login']} required>
            <input type="password" class="form-control" placeholder="Mot de passe" name="up" required>
            <input type="password" class="form-control" placeholder="Confirmer le mot de passe" name="up2" required>
            <input type="text" class="form-control" placeholder="Nom" name="nom" value={$_GET['nom']} required>
            <input type="text" class="form-control" placeholder="Prénom" name="prenom" value={$_GET['prenom']}required>
            <input type="number" class="form-control" placeholder="Promotion (sur 4 chiffres)" name="promotion" value={$_GET['promotion']} required>
            <input type="email" class="form-control" placeholder="E-mail" name="email" value={$_GET['email']} required>
           <button class="btn btn-lg btn-primary btn-block" type="submit">S'enregistrer</button>
        </form>
    </div>
EOF;
    
} else {
    echo <<<EOF
    <div class="container">
        <form class="form-signup" role="form" method="post" action="?todo=signup" oninput="up2.setCustomValidity(up2.value != up.value ? 'Les mots de passe diffèrent.' : '')">
            <h2 class="form-signin-heading">Enregistrement</h2>
            <input type="text" class="form-control" placeholder="Login" name="login" required>
            <input type="password" class="form-control" placeholder="Mot de passe" name="up" required>
            <input type="password" class="form-control" placeholder="Confirmer le mot de passe" name="up2" required>
            <input type="text" class="form-control" placeholder="Nom" name="nom" required>
            <input type="text" class="form-control" placeholder="Prénom" name="prenom" required>
            <input type="number" class="form-control" placeholder="Promotion (sur 4 chiffres)" name="promotion" required>
            <input type="email" class="form-control" placeholder="E-mail" name="email" required>
           <button class="btn btn-lg btn-primary btn-block" type="submit">S'enregistrer</button>
        </form>
    </div>
EOF;
}
