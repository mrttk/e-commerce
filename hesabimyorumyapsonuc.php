<?php
if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["UrunID"])) {
        $gelenUrunID = guvenlik($_GET["UrunID"]);
    } else {
        $gelenUrunID = "";
    }
    if (isset($_POST["Puan"])) {
        $gelenPuan = guvenlik($_POST["Puan"]);
    } else {
        $gelenPuan = "";
    }
    if (isset($_POST["Yorum"])) {
        $gelenYorum = guvenlik($_POST["Yorum"]);
    } else {
        $gelenYorum = "";
    }
    if (($gelenUrunID != "") and ($gelenPuan != "") and ($gelenYorum != "")) {
        $yorumEklemeSorgusu = $dbConnection->prepare("insert into yorumlar (UrunId, UyeId, Puan, YorumMetni, YorumTarihi, YorumIpAdresi) values (?, ?, ?, ?, ?, ?)");
        $yorumEklemeSorgusu->execute([$gelenUrunID, $kullaniciId, $gelenPuan, $gelenYorum, $zamanDamgasi, $ipAdresi  ]);
        $yorumKayitKontrol = $yorumEklemeSorgusu->rowCount();
        if ($yorumKayitKontrol > 0) {
            $urunGuncellemeSorgusu = $dbConnection->prepare("update urunler set YorumSayisi = YorumSayisi + 1, ToplamYorumPuani = ToplamYorumPuani + ? where id = ? limit 1");
            $urunGuncellemeSorgusu->execute([$gelenPuan, $gelenUrunID ]);
            $urunGuncellemeKontrol = $urunGuncellemeSorgusu->rowCount();
            if($urunGuncellemeKontrol > 0){
                header("Location:index.php?SK=77");
                exit();
            }else{
                header("Location:index.php?SK=78");
                exit();
            }
        }
    } else {
        header("Location:index.php?SK=79");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>