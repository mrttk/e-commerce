<?php
require_once "Ayarlar/settings.php";
require_once "Ayarlar/functions.php";

if (isset($_GET["AktivasyonKodu"])) {
    $gelenAktivasyonKodu = guvenlik($_GET["AktivasyonKodu"]);
} else {
    $gelenAktivasyonKodu = "";
}
if (isset($_GET["Email"])) {
    $gelenEmailAdresi = guvenlik($_GET["Email"]);
} else {
    $gelenEmailAdresi = "";
}

if (($gelenAktivasyonKodu != "") and ($gelenEmailAdresi != "")) {

    $kontrolSorgusu = $dbConnection->prepare("select * from uyeler where EmailAdresi = ? and AktivasyonKodu = ? and durumu = ?");
    $kontrolSorgusu->execute([$gelenEmailAdresi, $gelenAktivasyonKodu, 0]);
    $kullaniciSayisi = $kontrolSorgusu->rowCount();
    if ($kullaniciSayisi > 0) {
        $uyeGuncellemeSorgusu = $dbConnection->prepare("update uyeler set Durumu=?");
        $uyeGuncellemeSorgusu->execute([1]);
        $kontrol = $uyeGuncellemeSorgusu->rowCount();
        if ($kontrol > 0) {
            header("Location:index.php?SK=30");
            exit();
        } else {
            header("Location:" . $siteLinki);
            exit();
        }

    } else {
        header("Location:" . $siteLinki);
        exit();
    }
}
?>