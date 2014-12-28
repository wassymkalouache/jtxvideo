<?php
if (!isset($_SESSION['loggedIn'])) {
    header('Location:index.php?page=erreur&error=forbidden');
    exit();
}
?>
<div class="container-fluid">
    <form method="POST" action="index.php?page=video&todo=ajout"><!-- Les données du formulaire sont envoyées au script ci-mentionné-->
        <div class='row'>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading"><center><h3 class=panel-title>Serveur JTX</h3></center></div>
                    <div class="panel-body">
                        <p class="text-muted">Localise la vidéo à ajouter sur le serveur du JTX. Si elle n'apparaît pas, c'est qu'elle est probablement déjà dans la base de données.</p>
                        <div id='arborescenceserveur'></div><!-- div rempli par une fonction dans code.js-->
                    </div>
                </div>
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
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading"><center><h3 class=panel-title>Lecteur vidéo</h3></center></div>
                    <div class="panel-body">
                        <p class="text-muted">Vérifie si la vidéo est la bonne puis taggue la tout en la regardant.</p>
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
                <div id="panelposter" class="panel panel-warning">
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
            <button type='submit' class='btn btn-danger'>Ajouter la vidéo</button>
            <button class='btn btn-success'>Prévisualiser la vidéo</button>
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
           tags
           description
           poster
    -->
</div>