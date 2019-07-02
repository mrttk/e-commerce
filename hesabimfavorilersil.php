<?php

if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])) {
        $gelenID = guvenlik($_GET["ID"]);
    } else {
        $gelenID = "";
    }
    if ($gelenID != "") {
        $favoriSilmeSorgusu = $dbConnection->prepare("delete from favoriler where id = ? and UyeId = ? limit 1");
        $favoriSilmeSorgusu->execute([$gelenID, $kullaniciId]);
        $favoriSilmeSayisi = $favoriSilmeSorgusu->rowCount();

        if ($adresSilmeSayisi > 0) {
            header("Location:index.php?SK=59");
            exit();
        } else {
            header("Location:index.php?SK=81");
            exit();
        }
    } else {
        header("Location:index.php?SK=82");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
