<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="http://www.binet-jtx.com">Site du JTX</a>
        </div>

        <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
                <input style="width:360px;" type="text" class="form-control" placeholder="Musical JTX 2010">
            </div>
            <button type="submit" class="btn btn-default">Rechercher</button>
        </form>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="nav navbar-nav navbar-right">
            <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {//les boutons diffèrent selon que l'on soit connecté ou pas.
                    echo "<li><a>{$_SESSION['user']}</a></li>";
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