<?php

if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])) {
        $gelenID = $_GET["ID"];
    } else {
        $gelenID = "";
    }
    if ($gelenID != "") {
        $favoriKontrolSorgusu = $dbConnection->prepare("select * from favoriler where UrunId = ? and UyeId = ? limit 1");
        $favoriKontrolSorgusu->execute([$gelenID, $kullaniciId]);
        $favoriKontrolSayisi = $favoriKontrolSorgusu->fetch(PDO::FETCH_ASSOC);
        if ($favoriKontrolSayisi > 0) {
            header("Location:index.php?SK=90");
            exit();
        } else {
            $favoriEklemeSorgusu = $dbConnection->prepare("insert into favoriler (UrunId, UyeId) values (?,?)");
            $favoriEklemeSorgusu->execute([$gelenID, $kullaniciId]);
            $favoriEklemeSayisi = $favoriEklemeSorgusu->rowCount();
            if ($favoriEklemeSayisi > 0) {
                header("Location:index.php?SK=88");
                exit();
            } else {
                header("Location:index.php?SK=89");
                exit();
            }
        }
    } else {
        header("Location:index.php");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}