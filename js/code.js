//-------------------------------------------------------------------
//-------------------------Page d'accueil----------------------------
//-------------------------------------------------------------------

$(document).ready(function () {//sur la page d'accueil, affiche ou masque le panneau des options avancée
    $("#cadreoptions").toggle();
    $("#boutonoptions").click(function () {
        $("#cadreoptions").slideToggle("slow");
    });
});

$(document).ready(function () {//permet l'ajout de tags via la barre des options avancées
    $("#boutonajouttags").click(function () {
        $("#requete").val($("#requete").val() + " " + '"' + $("#listetags").val() + '"');
        $("#listetags").val("");
    });
});

$(document).ready(function () {
    $("#boutonajoutdates").click(function () {//permet l'ajout d'options de datations via la barre des options de recherche avancée.
        if (!$("#requete").val().trim()) {//si la requete est vide ou remplie d'espace, on rajoute *
            $("#requete").val($("#requete").val() + "*");
        }
        $("#requete").val($("#requete").val() + " " + $("#listedates").val());
        $("#listedates").val("");
    });
});

$(document).ready(function () {
    $("#boutonajoutcategories").click(function () {//permet l'ajout d'options de categories via la barre des options de recherche avancée.
        if (!$("#requete").val().trim()) {//si la requete est vide ou remplie d'espace, on rajoute *
            $("#requete").val($("#requete").val() + "*");
        }
        $("#requete").val($("#requete").val() + " cat:(" + $("#listecategories").val() + ")");
        $("#listecategories").val("");
    });
});

$(document).ready(function () {//lorsque la requête est vide, on la remplace par le placholder (acutellement un clip aléatoire)
    $("#formrecherche").submit(function () {
        if ($("#requete").val() === "") {
            $("#requete").val($("#requete").attr('placeholder'));
        }
    });
});

//-------------------------------------------------------------------
//-------------------------Page de recherche-------------------------
//-------------------------------------------------------------------

$(document).ready(function () {//pour tronquer les descriptions trop longues
    // on sélectionne tous les div avec la classe zoneTexte et on les parcourt
    $("p.description").each(function (i) {
        // on récupère la longueur du texte et on coupe à la longueur 100 (s'il est aussi long)
        var contenu = $(this).html();
        var longueur = contenu.length;
        if (longueur > 150) {
            var debut = contenu.substr(0, 150);
            $(this).html(debut);
            $(this).append("...");
        }
    });
});

$(document).ready(function () {//pour tronquer les boutons dont le texte est trop long
    // on sélectionne tous les div avec la classe zoneTexte et on les parcourt
    $("a.boutontextearaccourcir").each(function (i) {
        // on récupère la longueur du texte et on coupe à la longueur 100 (s'il est aussi long)
        var contenu = $(this).html();
        var longueur = contenu.length;
        if (longueur > 15) {
            var debut = contenu.substr(0, 15);
            $(this).html(debut);
            $(this).append("...");
        }
    });
});

//-------------------------------------------------------------------
//---------------------Menu de filtrage------------------------------
//-------------------------------------------------------------------

//---------------------Gestion des filtres existants-----------------

$(document).ready(function () {//fonction permettant d'ajouter et d'enelver les filtres de promotion
    //gère aussi l'affichage du bouton filtrer en dessous de la liste des filtres
    $("#divsuppressionfiltrage").hide();
    $(".itemfiltre").change(function () {
        var testcat = /cat\:\((.*)\)/i;//on teste d'abord si l'élément à filtrer estune catégorie
        if (testcat.test($(this).attr("id"))) {//si c'est le cas, le truc à enlever ou ajouter est la chaine à 
            //l'intérieur de cat:()
            var enlever = $(this).attr("id").replace(testcat, '$1');
        } else {//sinon la chaine à ajouter ou retirer c'est juts l'id
            var enlever = $(this).attr("id");
        }
        var pattern = new RegExp("\\s*" + enlever, "i");//ensuite on définit le pattern de la chaine à retirer
        if ($(this).is(":checked")) {//la partie suivante se déclenche quand on coche la case
            if (!pattern.test($("#barrerecherche").val())) {//teste si la requête de la barre de recherche contient le pattern
                $("#barrerecherche").val($("#barrerecherche").val() + " " + $(this).attr("id"));
                //onrajoute 
            }
        } else {//la partie suivante se déclenche quand on déchoche la case
            $("#barrerecherche").val($("#barrerecherche").val().replace(pattern, ""));
        }
        $("#divsuppressionfiltrage").show();
    });
});

$(document).ready(function () {//fonctionnement du bouton filtrer en dessous de la liste des filtres
    $("#boutonsuppressionfiltre").click(function () {
        window.location.href = encodeURI('index.php?page=recherche&query=' + $("#barrerecherche").val());//recharge la page avec la requête actualisée
    });
});

//-------------------------------Ajout de filtres-----------------------------------------

$(document).ready(function () {//affiche un input pour 
//ajouter un filtre avec le formattage qui va bien selon la catégories de filtres demandée.
    $(".divajoutfiltrage").hide();
    $("#selectajoutfiltre").change(function () {
        if ($("#selectajoutfiltre").val() === "JTX") {
            $("#inputajoutfiltre").attr({
                placeholder: "2013",
                type: "number"
            });
        }
        if ($("#selectajoutfiltre").val() === "Catégorie") {
            $("#inputajoutfiltre").attr({
                placeholder: "Musical",
                type: "text"
            });
        }
        if ($("#selectajoutfiltre").val() === "Année") {
            $("#inputajoutfiltre").attr({
                placeholder: "2015",
                type: "number"
            });
        }
        if ($("#selectajoutfiltre").val() === "Promotion") {
            $("#inputajoutfiltre").attr({
                placeholder: "2013",
                title: "number"
            });
        }
        $(".divajoutfiltrage").show();
    });

});

$(document).ready(function () {//fonction qui ajoute le filtre à la query quand on clique sur le bouton d'ajout de filtres
    $("#boutonajoutfiltre").click(function () {
        var addquery;
        if ($("#selectajoutfiltre").val() === "JTX") {
            addquery = " JTX " + $("#inputajoutfiltre").val();
        }
        if ($("#selectajoutfiltre").val() === "Catégorie") {
            addquery = " cat:(" + $("#inputajoutfiltre").val() + ")";
        }
        if ($("#selectajoutfiltre").val() === "Année") {
            addquery = " " + $("#inputajoutfiltre").val();
        }
        if ($("#selectajoutfiltre").val() === "Promotion") {
            addquery = " X" + $("#inputajoutfiltre").val();
        }
        var pattern = new RegExp("\\s*" + addquery, "i");//ensuite on définit le pattern pour tester si la requete contient déjà le filtre
        if (!pattern.test($("#barrerecherche").val())) {//teste si la requête de la barre de recherche contient le pattern
            $("#barrerecherche").val($("#barrerecherche").val() + addquery);
            //onrajoute 
        }
        window.location.href = encodeURI('index.php?page=recherche&query=' + $("#barrerecherche").val());//recharge la page avec la requête actualisée
    });
});

//-------------------------------------------------------------------
//------------------------Page d'ajout des vidéos--------------------
//-------------------------------------------------------------------

$(document).ready(function () {//active l'arborescence des fichiers et déclenche l'affichage de la vidéo quand on clique dessus
    $('#arborescenceserveur').fileTree({root: 'videosjtx/', script: 'jqueryFileTree.php', multiFolder: false}, function (file) {
        $("#lecteurvideo source").attr({
            "src": file,
            "type": "video/" + /[^.]+$/.exec(file)//extrait l'extension de la vidéo.
        });//on change la source
        $("#lecteurvideo")[0].load();//on charge la nouvelle vidéo.
        $("#adressevideo").html(file);//les trois lignes suivantes actualisent les informations du panel vidéo choisie
        $("#extensionvideo").html(/[^.]+$/.exec(file));
        $("#panelvideochoisie").attr("class","panel panel-success");
    });
});