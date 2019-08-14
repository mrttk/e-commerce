<?php
if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])) {
        $gelenID = $_GET["ID"];
    } else {
        $gelenID = "";
    }
    if ($gelenID != "") {
        $sepetguncellemeSorgusu = $dbConnection->prepare("update sepet set UrunAdedi = UrunAdedi + 1 where id = ? and UyeId = ? limit 1");
        $sepetguncellemeSorgusu->execute([$gelenID, $kullaniciId]);
        $sepetGuncellemeSayisi = $sepetguncellemeSorgusu->rowCount();
        if ($sepetGuncellemeSayisi > 0) {
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
