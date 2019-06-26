<?php
include_once "Ayarlar/settings.php";
include_once "Ayarlar/functions.php";
if (isset($_SESSION["Kullanici"])) {

    if (isset($_POST["AdiSoyadi"])) {
        $gelenAdiSoyadi = guvenlik($_POST["AdiSoyadi"]);
    } else {
        $gelenAdiSoyadi = "";
    }
    if (isset($_POST["Adres"])) {
        $gelenAdres = guvenlik($_POST["Adres"]);
    } else {
        $gelenAdres = "";
    }
    if (isset($_POST["Il"])) {
        $gelenIl = guvenlik($_POST["Il"]);
    } else {
        $gelenIl = "";
    }
    if (isset($_POST["Ilce"])) {
        $gelenIlce = guvenlik($_POST["Ilce"]);
    } else {
        $gelenIlce = "";
    }
    if (isset($_POST["TelefonNumarasi"])) {
        $gelenTelefonNumarasi = guvenlik($_POST["TelefonNumarasi"]);
    } else {
        $gelenTelefonNumarasi = "";
    }
    if (($gelenAdiSoyadi != "") and ($gelenAdres != "") and ($gelenIl != "") and ($gelenIlce != "") and ($gelenTelefonNumarasi != "")) {

        $adresEklemeSorgusu = $dbConnection->prepare("insert into adresler (UyeId, AdiSoyadi, Adres,Il, Ilce, TelefonNumarasi) values (?,?,?,?,?,?)");
        $adresEklemeSorgusu->execute([$kullaniciId, $gelenAdiSoyadi, $gelenAdres, $gelenIl, $gelenIlce, $gelenTelefonNumarasi]);
        $eklemeKontrol = $adresEklemeSorgusu->rowCount();
        if ($eklemeKontrol > 0) {
            header("Location:index.php?SK=72");
            exit();
        } else {
            header("Location:index.php?SK=73");
            exit();
        }
    } else {
        header("Location:index.php?SK=74");
        exit();
    }
} else {
    header("Location:index.php?SK=0");
    exit();
}
?>


