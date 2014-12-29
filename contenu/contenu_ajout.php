<?php
if (!(isset($_SESSION['loggedIn']) && isset($_SESSION['admin']) && $_SESSION['admin'])) {//il faut être un admin conecté pour accéder à la page.
    header('Location:index.php?page=error&error=forbidden');
    exit();
}

$updatemode = (isset($_GET['mode']) && $_GET['mode'] == 'update'); //variable pour ne pas tout réecrire à chaque fois.

if ($updatemode && !isset($_GET['video'])) {
    header("Location:index.php?page=error&error=updatenovideo");
    exit();
}//À partir de maintenant si on est en $updatemode alors on sait quelle vidéo updater

if ($updatemode) {
    require_once 'utilities/database/videos.php';
    require_once 'utilities/database/tags.php';
    require_once 'utilities/database/promotions.php';
    require_once 'utilities/database/categories.php';
    require_once 'utilities/database/similaires.php';
    require_once 'utilities/misc.php';
    $video = Video::getVideoFromId($_GET['video']); //on récupère toutes les informations de la vidéo pour les mettre dans les inputs par la suite
    $tableautags = Tag::getTagsFromVideo($_GET['video']);
    $tags = '';
    if (!empty($tableautags)) {
        foreach ($tableautags as $tag) {
            $tags .= ' ' . $tag;
        }//$tags contient un truc du genre bob moule fist
    }
    $tableaupromotions = Promotion::getPromotionsFromVideo($_GET['video']);
    $promotions = '';
    if (!empty($tableaupromotions)) {
        if (count($tableaupromotions) == 1) {
            $promotions = $tableaupromotions[0];
        } else {
            foreach ($tableaupromotions as $promotion) {
                $promotions .= ';' . $promotion;
            }//$promotions contient un truc du genre 2012;2013
        }
    }
    $tableaucategories = Categorie::getCategoriesFromVideo($_GET['video']);
    $categories = '';
    if (!empty($tableaucategories)) {
        if (count($tableaucategories) == 1) {
            $categories = $tableaucategories[0];
        } else {
            foreach ($tableaucategories as $categorie) {
                $categories .= ';' . $categorie;
            }//$promotions contient un truc du genre Humoristique;Musical
        }
    }
    $tableausimilaires = Similaire::getSimilairesFromVideo($_GET['video']);
    $similaires = '';
    if (!empty($tableausimilaires)) {
        if (count($tableausimilaires) == 1) {
            $similaires = $tableausimilaires[0];
        } else {
            foreach ($tableausimilaires as $similaire) {
                $similaires .= ';' . $similaire;
            }//$promotions contient un truc du genre 1;256
        }
    }
//Maintenant on a tout ce qu'il faut pour remplir les inputs si on est en updatemode
}
?>
<div class="container-fluid">
    <?php
    if ($updatemode) {
        echo "<form  enctype='multipart/form-data' method='POST' action='index.php?page=video&todo=update'>";
    } else {
        echo "<form  enctype='multipart/form-data' method='POST' action='index.php?page=video&todo=insert'>"; //Les données du formulaire sont envoyées au script ci-mentionné
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
                <div id="panelvideochoisie" class="panel panel-danger">
EOF;
            } else {
                echo "<div id='panelvideochoisie' class='panel panel-success'>";
            }
            ?>
            <div class="panel-heading"><center><h3 class=panel-title>Vidéo choisie</h3></center></div>
            <div class="panel-body">
                <p> Adresse : <tt><span id="adressevideo" style='float:right'>
                        <?php
                        if ($updatemode) {
                            echo $video->adresse;
                        }
                        ?>
                    </span></tt></p>
                <input type='hidden' name='adresse' 
                <?php
                if ($updatemode) {
                    echo "value=\"$video->adresse\"";
                }
                ?>
                       id='formulaireadresse'/><!-- les inputs et les spans sont remplis par une fonction dans code.js en mode ajout des vidéos-->
                <p>Extension : <tt><span id="extensionvideo" style='float:right'>
                        <?php
                        if ($updatemode) {
                            echo $video->format;
                        }
                        ?>
                    </span></tt></p>
                <input type='hidden' name='extension'
                <?php
                if ($updatemode) {
                    echo "value=\"$video->format\"";
                }
                ?>
                       id='formulaireextension'/>
            </div>
        </div>  
        <div class="panel panel-default">
            <div class="panel-heading"><center><h3 class=panel-title>Métadonnées</h3></center></div>
            <div class="panel-body">
                <p class="text-muted">Inscris ici les métadonnées de la vidéo. Seul le titre est obligatoire, mais le mieux est de remplir le maximum de champs possibles.</p>
                <div class="input-group">
                    <span class="input-group-addon" id="titrevideo">Titre</span>
                    <input type="text" class="form-control" name="titre" 
                    <?php
                    if ($updatemode) {
                        echo "value=\"$video->titre\"";
                    }
                    ?>
                           placeholder="Nom du fichier ou nom d'usage du clip" aria-describedby="titrevideo">
                </div>
                <hr style='margin-top:10px;margin-bottom:10px'>
                <div class="input-group">
                    <span class="input-group-addon" id="projvideo">Proj'</span>
                    <input type="text" class="form-control" name="proj" 
                    <?php
                    if ($updatemode) {
                        echo "value='$video->proj'";
                    }
                    ?>
                           placeholder="URL de la page de la proj'" aria-describedby="projvideo">
                </div>
                <hr style='margin-top:10px;margin-bottom:10px'>
                <div class='row'>
                    <div class='col-md-6'>
                        <div class="input-group">
                            <span class="input-group-addon" id="jtxvideo">JTX</span>
                            <input type="number" name="jtx" class="form-control" 
                            <?php
                            if ($updatemode) {
                                echo "value=\"$video->jtx\"";
                            }
                            ?>
                                   placeholder="2013" aria-describedby="jtxvideo">
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class="input-group">
                            <span class="input-group-addon" id="anneevideo">Année</span>
                            <input type="number" name="annee" class="form-control" 
                            <?php
                            if ($updatemode) {
                                echo "value=\"$video->annee\"";
                            }
                            ?>
                                   placeholder="2013" aria-describedby="anneevideo">
                        </div>
                    </div>
                </div>
                <hr style='margin-top:10px;margin-bottom:10px'>
                <p class='text-muted'>Tu peux spécifier plusieurs promotions en les séparant par un point-virgule.</p>
                <div class="input-group">
                    <span class="input-group-addon" id="promotionsvideo">Promotion(s)</span>
                    <input type="text" name="promotions" class="form-control" 
                    <?php
                    if ($updatemode) {
                        echo "value=\"$promotions\"";
                    }
                    ?>
                           placeholder="2013;2012" aria-describedby="promotionsvideo">
                </div>
                <hr style='margin-top:10px;margin-bottom:10px'>
                <p class='text-muted'>Idem pour les catégories.</p>
                <div class="input-group">
                    <span class="input-group-addon" id="categoriesvideo">Catégorie(s)</span>
                    <input type="text" name="categories" class="form-control" 
                    <?php
                    if ($updatemode) {
                        echo "value=\"$categories\"";
                    }
                    ?>
                           placeholder="Humoristique;Musical" aria-describedby="categoriesvideo">
                </div>
                <hr style='margin-top:10px;margin-bottom:10px'>
                <p class='text-muted'>Pour spécificer les vidéos en relation avec celle que tu es en train d'ajouter, récupères 
                    les numéros desdites vidéos dans l'URL de leur page de lecture et inscris-les ici à la suite, séparés par des points-virgule.</p>
                <div class="input-group">
                    <span class="input-group-addon" id="similairesvideo">Similaire(s)</span>
                    <input type="text" name="similaires" class="form-control"
                    <?php
                    if ($updatemode) {
                        echo "value=\"$similaires\"";
                    }
                    ?>
                           placeholder="1;256" aria-describedby="similairevideo">
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
                    <video id="lecteurvideo" class="video-js vjs-default-skin"
                    <?php
                    if ($updatemode) {
                        echo "poster='$video->poster'";
                    }
                    ?>
                           controls preload="none" height="350">
                               <?php
                               if ($updatemode) {
                                   echo "<source src=\"$video->adresse\"/>";
                               } else {
                                   echo "<source src=''/>";
                               }
                               ?>
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
                    <input type="text" name="tags" class="form-control" 
                    <?php
                    if ($updatemode) {
                        echo "value=\"$tags\"";
                    }
                    ?>
                           placeholder="Listes de mots sans majuscules ni accents séparés par des espaces" aria-describedby="titrevideo">
                </div>
                <hr style='margin-top:10px;margin-bottom:10px'>
                <p class="text-muted">Écris la description du clip en texte plein. N'éhsites pas à ajouter des informations comme la source de la bande son, des anecdotes sur le tournage, etc.</p>
                <textarea name="description" class="form-control" row="3"><?php
                    if ($updatemode) {
                        echo $video->description; //enlève les espaces en trop au début de la description (bug ?);
                    }
                    ?></textarea>
            </div>
        </div>
        <div id="panelposter" class="panel panel-primary">
            <div class="panel-heading"><center><h3 class=panel-title>Choix du poster</h3></center></div>
            <div class="panel-body">
                <p class='text-muted'>Extrais une frame de la vidéo à l'aide du logiciel de ton choix puis uploade-là à l'aide du bouton « Parcourir » ci-dessous. L'image doit peser moins de 500 Ko et doit être dans une des extensions suivantes : <tt>.jpg</tt>, <tt>.png</tt>, <tt>.jpeg</tt>.</p>
                <div class="media">
                    <a class="media-left media-middle">
                        <?php
                        if ($updatemode) {
                            echo "<img src=\"$video->poster\" alt='Visualisation du poster' width='200'>";
                        } else {
                            echo "<img src='media/noimage.jpg' alt='Visualisation du poster' width='200'>";
                        }
                        ?>
                    </a>
                    <div class="media-body">
                        <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                        <input type="file" accept="image" name="poster">
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