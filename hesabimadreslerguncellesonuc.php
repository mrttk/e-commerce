<?php
include_once "Ayarlar/settings.php";
include_once "Ayarlar/functions.php";
if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])) {
        $gelenId = guvenlik($_GET["ID"]);
    } else {
        $gelenId = "";
    }
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
    if (($gelenId != "") and ($gelenAdiSoyadi != "") and ($gelenAdres != "") and ($gelenIl != "") and
        ($gelenIlce != "") and ($gelenTelefonNumarasi != "")) {

        $adresGuncellemeSorgusu = $dbConnection->prepare("update adresler set AdiSoyadi = ?, Adres = ?,Il = ?, Ilce = ?, TelefonNumarasi = ? where id = ? and UyeId = ? limit 1");
        $adresGuncellemeSorgusu->execute([$gelenAdiSoyadi, $gelenAdres, $gelenIl, $gelenIlce, $gelenTelefonNumarasi,
            $gelenId, $kullaniciId]);
        $guncellemeKontrol = $adresGuncellemeSorgusu->rowCount();
        if ($guncellemeKontrol > 0) {
            header("Location:index.php?SK=64");
            exit();
        } else {
            header("Location:index.php?SK=65");
            exit();
        }
    } else {
        header("Location:index.php?SK=66");
        exit();
    }
} else {
    header("Location:index.php?SK=0");
    exit();
}
?>


