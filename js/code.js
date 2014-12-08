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
        $("#requete").val($("#requete").val() + " " + $("#listedates").val());
        $("#listetags").val("");
    });
});

$(document).ready(function () {
    $("#formrecherche").submit(function () {
        if ($("#requete").val() === "") {
            $("#requete").val($("#requete").attr('placeholder'));
        }
    });
});