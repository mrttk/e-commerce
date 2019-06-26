<?php
include_once "Ayarlar/settings.php";
include_once "Ayarlar/functions.php";
if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])) {
        $gelenID = $_GET["ID"];
    } else {
        $gelenID = "";
    }
    if ($gelenID != "") {
        $adresSilmeSorgusu = $dbConnection->prepare("delete from adresler where id = ?");
        $adresSilmeSorgusu->execute([$gelenID]);
        $adresSilmeSayisi = $adresSilmeSorgusu->rowCount();
        if ($adresSilmeSayisi > 0) {
            header("Location:index.php?SK=68");
            exit();
        } else {
            header("Location:index.php?SK=69");
            exit();
        }
    } else {
        header("Location:index.php?SK=69");
        exit();
    }
} else {
    header("Location:index.php?SK=0");
    exit();
}
?>


