<?php require_once 'utilities/database/videos.php' ?>
<header id="logoaccueil">
    <img alt="Logo de JtxVidéo" width="400" src="media/logojtxvideo.svg">
</header>
<div class="container-fluid" id="cadrebarre">
    <form role="search" method="get" action="index.php" id="formrecherche">
        <div class="row" id="barrerechercheaccueil">
            <div class="col-md-6 col-md-offset-3">
                <input type='hidden' name='page' value='recherche' /><!-- Champ caché qui permet de dire qu'il faut aller sur la page de recherche-->
                <input type='hidden' name='numero' value='1' /><!-- Champ caché qui permet de dire qu'on veut afficher la première page des résultats-->
                <input type="text" class="form-control" id="requete" name="query" placeholder="<?php Video::titreAleatoire() ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3" id="boutonsrecherche">
                <button class="btn btn-default" type="submit" role="button"><span class="glyphicon glyphicon-search"></span>&nbsp;Recherche sur JtxVidéo</button>
                <a class="btn btn-default" role="button" id="boutonoptions"><span class="glyphicon glyphicon-question-sign"></span>&nbsp;Aide</a>
            </div>
        </div>
    </form>
    <div class="col-md-4 col-md-offset-4" id="cadreoptions">
        <p class="text-muted">La recherche porte par défaut sur le titre des vidéos. Néanmoins tu peux ajouter des résultats en recherchant des tags, et les filtrer avec des conditions temporelles.</p>
        <p class="text-muted">* permet de rechercher toutes les vidéos avec les filtres sur les dates ou les catégories.</p>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Tags</span>
                <input type="text" class="form-control" id="listetags" placeholder="truc machin bidule">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="boutonajouttags" type="button">Ajouter</button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Datation</span>
                <input type="text" class="form-control" id="listedates" placeholder="X2010 JTX 2010 2012">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="boutonajoutdates" type="button">Ajouter</button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">Catégories</span>
                <input type="text" class="form-control" id="listecategories" placeholder="Musical, Humoristique">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="boutonajoutcategories" type="button">Ajouter</button>
                </span>
            </div>
        </div>
    </div>
</div>