<?php
if (!isset($_SESSION['loggedIn'])) {
    header('Location:index.php?page=erreur&error=forbidden');
    exit();
}
?>
<div class="container-fluid">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><center><h3 class=panel-title>Serveur JTX</h3></center></div>
            <div class="panel-body">
                <p class="text-muted">Localise la vidéo à ajouter parmi la structure du serveur du JTX.</p>
                <div id='arborescenceserveur'></div><!-- div rempli par une fonction dans code.js-->
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading"><center><h3 class=panel-title>Vidéo choisie</h3></center></div>
            <div class="panel-body">
                <p> Adresse : <span id="adressevideo" style='float:right'></span></p>
                <p>Extension : <span id="extensionvideo" style='float:right'></span></p>
            </div>
        </div>

    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
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
    </div>
</div>