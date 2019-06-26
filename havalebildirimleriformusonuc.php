<?php
include_once "Ayarlar/settings.php";
include_once "Ayarlar/functions.php";

if (isset($_POST["IsımSoyisim"])) {
    $gelenIsimSoyisim = guvenlik($_POST["IsımSoyisim"]);
} else {
    $gelenIsimSoyisim = "";
}
if (isset($_POST["EmailAdresi"])) {
    $gelenEmailAdresi = guvenlik($_POST["EmailAdresi"]);
} else {
    $gelenEmailAdresi = "";
}
if (isset($_POST["TelefonNumarasi"])) {
    $gelenTelefonNumarasi = guvenlik($_POST["TelefonNumarasi"]);
} else {
    $gelenTelefonNumarasi = "";
}
if (isset($_POST["BankaSecimi"])) {
    $gelenBankaSecimi = guvenlik($_POST["BankaSecimi"]);
} else {
    $gelenBankaSecimi = "";
}
if (isset($_POST["Aciklama"])) {
    $gelenAciklama = guvenlik($_POST["Aciklama"]);
} else {
    $gelenAciklama = "";
}

if (($gelenIsimSoyisim != "") and ($gelenEmailAdresi != "") and ($gelenTelefonNumarasi != "") and ($gelenBankaSecimi != "") and
    ($gelenAciklama != "")) {
    $havaleBildirimiKaydet = $dbConnection->prepare("insert into havalebildirimleri (BankaId,AdiSoyadi,EmailAdresi,TelefonNumarası,Aciklama, IslemTarihi, Durum) values (?,?,?,?,?,?,?)");
    $havaleBildirimiKaydet->execute([$gelenBankaSecimi, $gelenIsimSoyisim, $gelenEmailAdresi, $gelenTelefonNumarasi,
        $gelenAciklama, $zamanDamgasi, 0]);
    $havaleBildirimiKaydetKontrol = $havaleBildirimiKaydet->rowCount();

    if ($havaleBildirimiKaydetKontrol > 0) {
        header("Location:index.php?SK=11");
        exit();
    } else {
        header("Location:index.php?SK=12");
        exit();
    }
} else {
    header("Location:index.php?SK=13");
    exit();
}
?>