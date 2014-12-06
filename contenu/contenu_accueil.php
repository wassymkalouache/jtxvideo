<header id="logoaccueil">
    <img alt="Logo de JtxVidéo" width="400" src="media/logojtxvideo.svg">
</header>
<div class="container-fluid" id="cadrebarre">
    <form role="search" method="get" action="index.php">
        <div class="row" id="barrerecherche">
            <div class="col-md-6 col-md-offset-3">
                <div class="input-group">
                    <input type='hidden' name='page' value='recherche' /><!-- Champ caché qui permet de dire qu'il faut aller sur la page de recherche-->
                    <input type='hidden' name='numero' value='1' /><!-- Champ caché qui permet de dire qu'on veut afficher la première page des résultats-->
                    <span class="input-group-addon glyphicon glyphicon-film"></span>
                    <input type="text" class="form-control" name="query" placeholder="Musical JTX 2010">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-3" id="boutonsrecherche">
                <button class="btn btn-default" type="submit" role="button">Recherche sur JtxVidéo</button>
                <a href="" class="btn btn-default" role="button">Options avancées</a>
            </div>
        </div>
    </form>
</div>