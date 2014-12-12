 <div class="container-fluid">
     <div class="container-fluid" id="cadrebarre">       
     <div class="page-header">
                <h1>Ajouter une vidéo</h1>
                <p>Tu peux ajouter ici une vidéo présente sur les serveurs du JTX à la base de données du moteur de recherche.</p>
            </div>
    
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="input-group">
                        
                        <span class="input-group-addon">Adresse sur le serveur</span>
                        <script  src="js/jqueryFileTree.js">
                        </script>
                        <input type="text" class="form-control" placeholder="ftp/Projections_JTX/JTX2012_18-06-14">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Parcourir</button>
                        </span>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-addon">Image d'affiche</span>
                        <input type="text" class="form-control" placeholder="Bureau/affiche.jpg">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Parcourir</button>
                        </span>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-addon">Description</span>
                        <input type="text" class="form-control" placeholder="Encore un clip mythissime du JTX !">
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="input-group">
                        <span class="input-group-addon">Tags</span>
                        <input type="text" class="form-control" placeholder="Random platal jtx">
                    </div>
                </li>
                
      
                <li class="list-group-item" style="text-align: center">
                    
                        <center>Datation</center>
                    
                
                
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">JTX</span>
                                <input type="text" class="form-control" placeholder="2012">
                                <span class="input-group-addon">
                                    <input type="checkbox">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">Année</span>
                                <input type="text" class="form-control" placeholder="2012">
                                <span class="input-group-addon">
                                    <input type="checkbox">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">Promotion(s)</span>
                                <input type="text" class="form-control" placeholder="X2012 ; X2013">
                                <span class="input-group-addon">
                                    <input type="checkbox">
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
                
                <li class="list-group-item" style="text-align: center" >
                    
                    Divers
                   
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">Catégories</span>
                                <input type="text" class="form-control" placeholder="Musical ; Binets">
                                <span class="input-group-addon">
                                    <input type="checkbox">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon">Clips similaires</span>
                                <input type="text" class="form-control" placeholder="Nom du clip">
                                <span class="input-group-addon">
                                    <input type="checkbox">
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
    
             <div class="row">
                <div class="col-md-6 col-md-offset-3" id="boutonsrecherche">
                    <a href="#" class="btn btn-success" role="button">Enregistrer la vidéo dans la base de données</a>
                </div>
            </div>
        </div>

        <div class="footer">
            <div  class="container" id="pied">
                <p class="text-muted">© JTX – 2014</p>        
            </div>
        </div>
     </div>
 