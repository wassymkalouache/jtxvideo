<nav class="navbar navbar-default" id="barrenavigation" position="" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="http://www.binet-jtx.com">Site du JTX</a>
        </div>

        <form class="navbar-form navbar-left" role="search" method="get" action="index.php">
            <div class="form-group">
                <input type='hidden' name='page' value='recherche' /><!-- Champ caché qui permet de dire qu'il faut aller sur la page de recherche-->
                <input type='hidden' name='numero' value='1' /><!-- Champ caché qui permet de dire qu'on veut afficher la première page des résultats-->
                <?php
                if (isset($_GET['query'])) {//si l'on a fait une recherche, elle s'affiche en haut;
                    echo <<<EOF
                    <input style='width:360px;' type='text' id="barrerecherche" class='form-control' name='query' value="{$_GET['query']}">
EOF;
                } elseif (isset($_SESSION['query'])) {//si l'on a fait une recherche avant, elle s'affiche en haut;
                    echo <<<EOF
                    <input style='width:360px;' type='text' id="barrerecherche" class='form-control' name='query' value="{$_SESSION['query']}">
EOF;
                } else    {
                    //ça affiche une vidéo aléatoire en placeholder
                    $videoalea = Video::titreAleatoire();
                    echo <<<EOF
                    <input style="width:360px;" type="text" id="barrerecherche" class="form-control" placeholder="$videoalea" name="query">
EOF;
                }
                ?>
            </div>
            <button type="submit" class="btn btn-default">Rechercher</button>
        </form>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="nav navbar-nav navbar-right">
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {//les boutons diffèrent selon que l'on soit connecté ou pas.
                    echo "<li><a href='index.php?page=compte'>{$_SESSION['usertext']}</a></li>";
                    echo "<li><a href='index.php?page=ajout'>Ajouter une vidéo</a></li>";
                    echo "<li><a href='index.php?page=accueil&todo=logout'>Se déconnecter</a></li>";
                } else {
                    echo "<li><a href='index.php?page=login'>Se connecter</a></li>";
                }
                ?>
                <li><a href="index.php?page=accueil" id="logocoincadre"><img src="media/logojtxvideo.svg" height="30" id="logocoin" alt="Logo JtxVidéo"/></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>