$(document).ready(function() {
    $.SoruIcerigiGoster = function(ElemanIDsi) {
        var IslenecekAlan = "#" + ElemanIDsi;
        $(".SorununCevapAlani").slideUp();
        $(IslenecekAlan).parent().find(".SorununCevapAlani").slideToggle();
    };

    $.UrunDetayResmiDegistir = function(klasor, resimDegeri) {
        var resimIcinDosyaYolu = "Resimler/UrunResimleri/" + klasor + "/" + resimDegeri;
        $("#buyukresim").attr("src", resimIcinDosyaYolu);
    };
});