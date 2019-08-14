<?php
if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])) {
        $gelenID = $_GET["ID"];
    } else {
        $gelenID = "";
    }
    if ($gelenID != "") {
        $sepetSilmeSorgusu = $dbConnection->prepare("delete from sepet where id = ? and UyeId = ? limit 1");
        $sepetSilmeSorgusu->execute([$gelenID, $kullaniciId]);
        $sepetSilmeSayisi = $sepetSilmeSorgusu->rowCount();
        if ($sepetSilmeSayisi > 0) {
            header("Location:index.php?SK=94");
            exit();
        } else {
            header("Location:index.php?SK=94");
            exit();
        }
    } else {
        header("Location:index.php?SK=94");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
