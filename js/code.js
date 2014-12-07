$(document).ready(function () {
    $("#cadreoptions").toggle();
    $("#boutonoptions").click(function () {
        $("#cadreoptions").slideToggle("slow");
    });
});

$(document).ready(function () {
   $("#boutonajouttags").click(function() {
      $("#requete").val($("#requete").val()+" "+'"'+$("#listetags").val()+'"'); 
   });
});

$(document).ready(function () {
   $("#boutonajoutdates").click(function() {
      $("#requete").val($("#requete").val()+" "+$("#listedates").val()); 
   });
});

$(document).ready(function () {
   $("#formrecherche").submit(function() {
      if ($("#requete").val() === "") {
          $("#requete").val($("#requete").attr('placeholder'));
      } 
   });
});