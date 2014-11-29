 <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="http://www.binet-jtx.com">Site du JTX</a>
                </div>

                <!-- Collect the nav links, forms, and other content for to-->
                <div class="nav">
                    <ul class="nav navbar-nav">
                        <li><a href="http://wikix.polytechnique.org/JTX">Page WikiX du JTX</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php
                        if (isset($_SESSION['loggedIn'])&&$_SESSION['loggedIn']) {//les boutons diffèrent selon que l'on soit connecté ou pas.
                            echo "<li><a href='index.php?page=compte'>{$_SESSION['usertext']}</a></li>";
                            echo "<li><a href='index.php?page=ajout'>Ajouter une vidéo</a></li>";
                            echo "<li><a href='index.php?page=accueil&todo=logout'>Se déconnecter</a></li>";
                        } else {
                            echo "<li><a href='index.php?page=login'>Se connecter</a></li>";
                        }       
                        ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
