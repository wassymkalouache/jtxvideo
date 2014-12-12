//-------------------------------------------------------------------
//-------------------------Page d'accueil----------------------------

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
//-------------------------Page de recherche---------------------------

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

//---------------------Menu de filtrage------------------------------------

$(document).ready(function () {//fonction permettant d'ajouter et d'enelver les filtres de promotion
    $(".itemfiltre").change(function () {
        var pattern = new RegExp("\\s*" + $(this).attr("id"), "i");
        if ($(this).is(":checked")) {//la partie suivante se déclenche quand on coche la case
            if (!pattern.test($("#barrerecherche").val())) {//teste si la requête de la barre de recherche contient le pattern
                $("#barrerecherche").val($("#barrerecherche").val() + " " + $(this).attr("id"));
            }
        } else {//la partie suivante se déclenche quand on déchoche la case
            //$("body").html("Blah !");
            $("#barrerecherche").val($("#barrerecherche").val().replace(pattern, ""));
        }
    });
});