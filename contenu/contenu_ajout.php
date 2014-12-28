<?php
if (!isset($_SESSION['loggedIn'])) {
    header('Location:index.php?page=error&error=forbidden');
    exit();
}

$updatemode = isset($_GET['mode']) && $_GET['mode'] == 'update'; //variable pour ne pas tout réecrire à chaque fois.

if ($updatemode && !isset($_GET['video'])) {
    header("Location:index.php?page=error&error=updatenovideo");
    exit();
}//À partir de maintenant si on est en $updatemode alors on sait quelle vidéo updater
?>
<div class="container-fluid">
    <?php
    if ($updatemode) {
        echo "<form method='POST' action='index.php?page=video&todo=update'>";
    } else {
        echo "<form method='POST' action='index.php?page=video&todo=insert'>"; //Les données du formulaire sont envoyées au script ci-mentionné
    }
    ?>
    <div class='row'>
        <div class="col-md-4">
            <?php
            //lorsque l'on met à jour une vidéo, pas besoin d'avoir le panneau pour choisir la vidéo sur le serveur.
            if (!$updatemode) {
                echo <<<EOF
                <div class="panel panel-primary">
                    <div class="panel-heading"><center><h3 class=panel-title>Serveur JTX</h3></center></div>
                    <div class="panel-body">
                        <p class="text-muted">Localise la vidéo à ajouter sur le serveur du JTX. Tu ne peux pas sélectionner des vidéos déjà ajoutées. Pour modifier, clic droit puis « Ouvrir le lien dans un nouvel onglet » puis modifie la description.</p>
                        <div id='arborescenceserveur'></div><!-- div rempli par une fonction dans code.js-->
                    </div>
                </div>  
EOF;
            }
            ?>
            <div id="panelvideochoisie" class="panel panel-danger">
                <div class="panel-heading"><center><h3 class=panel-title>Vidéo choisie</h3></center></div>
                <div class="panel-body">
                    <p> Adresse : <tt><span id="adressevideo" style='float:right'></span></tt></p>
                    <input type='hidden' name='adresse' id='formulaireadresse'/><!-- les inputs et les spans sont remplis par une fonction dans code.js-->
                    <p>Extension : <tt><span id="extensionvideo" style='float:right'></span></tt></p>
                    <input type='hidden' name='extension' id='formulaireextension'/>
                </div>
            </div>  
            <div class="panel panel-default">
                <div class="panel-heading"><center><h3 class=panel-title>Métadonnées</h3></center></div>
                <div class="panel-body">
                    <p class="text-muted">Inscris ici les métadonnées de la vidéo. Seul le titre est obligatoire, mais le mieux est de remplir le maximum de champs possibles.</p>
                    <div class="input-group">
                        <span class="input-group-addon" id="titrevideo">Titre</span>
                        <input type="text" class="form-control" name="titre" placeholder="Nom du fichier ou nom d'usage du clip" aria-describedby="titrevideo">
                    </div>
                    <hr style='margin-top:10px;margin-bottom:10px'>
                    <div class="input-group">
                        <span class="input-group-addon" id="projvideo">Proj'</span>
                        <input type="text" class="form-control" name="proj" placeholder="URL de la page de la proj'" aria-describedby="projvideo">
                    </div>
                    <hr style='margin-top:10px;margin-bottom:10px'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class="input-group">
                                <span class="input-group-addon" id="jtxvideo">JTX</span>
                                <input type="number" name="jtx" class="form-control" placeholder="2013" aria-describedby="jtxvideo">
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="input-group">
                                <span class="input-group-addon" id="anneevideo">Année</span>
                                <input type="number" name="annee" class="form-control" placeholder="2013" aria-describedby="anneevideo">
                            </div>
                        </div>
                    </div>
                    <hr style='margin-top:10px;margin-bottom:10px'>
                    <p class='text-muted'>Tu peux spécifier plusieurs promotions en les séparant par un point-virgule.</p>
                    <div class="input-group">
                        <span class="input-group-addon" id="promotionsvideo">Promotion(s)</span>
                        <input type="text" name="promotions" class="form-control" placeholder="2013;2012" aria-describedby="promotionsvideo">
                    </div>
                    <hr style='margin-top:10px;margin-bottom:10px'>
                    <p class='text-muted'>Idem pour les catégories.</p>
                    <div class="input-group">
                        <span class="input-group-addon" id="categoriesvideo">Catégorie(s)</span>
                        <input type="text" name="categories" class="form-control" placeholder="Humoristique;Musical" aria-describedby="categoriesvideo">
                    </div>
                    <hr style='margin-top:10px;margin-bottom:10px'>
                    <p class='text-muted'>Pour spécificer les vidéos en relation avec celle que tu es en train d'ajouter, récupères 
                        les numéros desdites vidéos dans l'URL de leur page de lecture et inscris-les ici à la suite, séparés par des points-virgule.</p>
                    <div class="input-group">
                        <span class="input-group-addon" id="similairesvideo">Similaire(s)</span>
                        <input type="text" name="similaires" class="form-control" placeholder="1;256" aria-describedby="similairevideo">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading"><center><h3 class=panel-title>Lecteur vidéo</h3></center></div>
                <div class="panel-body">
                    <p class="text-muted">Vérifie si la vidéo correspond bien au fichier puis taggue la tout en la regardant.</p>
                    <center>
                        <video id="lecteurvideo" class="video-js vjs-default-skin" controls preload="none" height="350">
                            <source src=''/>
                        </video>
                    </center>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading"><center><h3 class=panel-title>Tags et description</h3></center></div>
                <div class="panel-body">
                    <p class="text-muted">Aide toi du lecteur ci-dessus pour tagger la vidéo. Sont à inclure dans la mesure du possible :
                        les lieux montrés, les acteurs principaux, les thèmes de la vidéo, les binets ou associations impliqués, etc.</p>
                    <div class="input-group">
                        <span class="input-group-addon" id="titrevideo">Tags</span>
                        <input type="text" name="tags" class="form-control" placeholder="Listes de mots sans majuscules ni accents séparés par des espaces" aria-describedby="titrevideo">
                    </div>
                    <hr style='margin-top:10px;margin-bottom:10px'>
                    <p class="text-muted">Tu peux mettre en forme la description avec des balises HTML. Par exemple, on fait un lien avec <?php echo htmlspecialchars('<a href="URL du lien">Texte du lien</a>'); ?></p>
                    <textarea name="description" class="form-control" row="3"></textarea>
                </div>
            </div>
            <div id="panelposter" class="panel panel-primary">
                <div class="panel-heading"><center><h3 class=panel-title>Choix du poster</h3></center></div>
                <div class="panel-body">
                    <p class='text-muted'>Pour choisir l'image qui sera affichée pour représenter la vidéo, rentre le numéro d'une frame de
                        la vidéo et l'image sera extraite automatiquement.</p>
                    <div class="media">
                        <a class="media-left media-middle" href="#">
                            <img src="" alt="Visualisation du poster" width='400'>
                        </a>
                        <div class="media-body">
                            <div class="input-group">
                                <span class="input-group-addon" id="titrevideo">Frame</span>
                                <input type="text" class="form-control" placeholder="<minutes>:<secondes>:<numéro frame>" aria-describedby="titrevideo">
                            </div>
                            <br />
                            <button class='btn btn-primary'>Extraire la frame</button>
                            <input hidden name="poster" id="formulaireposter">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='well' style='text-align:center'>
        <?php
        if ($updatemode) {
            echo "<button type = 'submit' id = 'bouttonajoutvideo' class = 'btn btn-danger'>Mettre à jour les informations</button>";
        } else {
            echo "<button type = 'submit' id = 'bouttonajoutvideo' class = 'btn btn-danger'>Ajouter la vidéo</button>";
        }
        ?>
    </div>
</form><!-- voilà les différents items récoltés par le formulaire :
       adresse
       extension
       titre
       proj
       jtx
       annee
       promotions
       categories
       similaires
       tags
       description
       poster
-->
</div>