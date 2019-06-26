<?php
include_once "Ayarlar/settings.php";

if (isset($_POST["EmailAdresi"])) {
    $gelenEmailAdresi = guvenlik($_POST["EmailAdresi"]);
} else {
    $gelenEmailAdresi = "";
}
if (isset($_POST["Sifre"])) {
    $gelenEmailSifre = guvenlik($_POST["Sifre"]);
} else {
    $gelenEmailSifre = "";
}
if (isset($_POST["SifreTekrar"])) {
    $gelenSifreTekrar = guvenlik($_POST["SifreTekrar"]);
} else {
    $gelenSifreTekrar = "";
}
if (isset($_POST["IsımSoyisim"])) {
    $gelenIsimSoyisim = guvenlik($_POST["IsımSoyisim"]);
} else {
    $gelenIsimSoyisim = "";
}
if (isset($_POST["TelefonNumarasi"])) {
    $gelenTelefonNumarasi = guvenlik($_POST["TelefonNumarasi"]);
} else {
    $gelenTelefonNumarasi = "";
}
if (isset($_POST["Cinsiyet"])) {
    $gelenCinsiyet = guvenlik($_POST["Cinsiyet"]);
} else {
    $gelenCinsiyet = "";
}


$md5liSifre = md5($gelenEmailSifre);

if (($gelenIsimSoyisim != "") and ($gelenEmailAdresi != "") and ($gelenEmailSifre != "") and ($gelenSifreTekrar != "") and
    ($gelenTelefonNumarasi != "") and ($gelenCinsiyet != "")) {
    if ($gelenSifreTekrar != $gelenEmailSifre) {
        header("Location:index.php?SK=57");
        exit();
    } else {
        if ($gelenEmailSifre == "EskiSifre") {
            $sifreDegistirmeDurumu = 0;
        } else {
            $sifreDegistirmeDurumu = 1;
        }
        if ($emailAdresi != $gelenEmailAdresi) {
            $kontrolSorgusu = $dbConnection->prepare("select * from uyeler where EmailAdresi = ?");
            $kontrolSorgusu->execute([$gelenEmailAdresi]);
            $kullaniciSayisi = $kontrolSorgusu->rowCount();
            if ($kullaniciSayisi > 0) {
                header("Location:index.php?SK=55");
                exit();
            }
            if ($sifreDegistirmeDurumu == 1) {
                $kullaniciGuncellemeSorgusu = $dbConnection->prepare("update uyeler set EmailAdresi = ?, Sifre = ?, IsimSoyisim = ?, TelefonNumarasi = ?, Cinsiyet = ? where id = ? limit 1");
                $kullaniciGuncellemeSorgusu->execute([
                    $gelenEmailAdresi,
                    $md5liSifre,
                    $gelenIsimSoyisim,
                    $gelenTelefonNumarasi,
                    $gelenCinsiyet,
                    $kullaniciId
                ]);
            } else {
                $kullaniciGuncellemeSorgusu = $dbConnection->prepare("update uyeler set EmailAdresi = ?, IsimSoyisim = ?, TelefonNumarasi = ?, Cinsiyet = ? where id = ? limit 1");
                $kullaniciGuncellemeSorgusu->execute([
                    $gelenEmailAdresi,
                    $gelenIsimSoyisim,
                    $gelenTelefonNumarasi,
                    $gelenCinsiyet,
                    $kullaniciId
                ]);
            }
            $kayitKontrol = $kullaniciGuncellemeSorgusu->rowCount();
            if ($kayitKontrol > 0) {
                $_SESSION["Kullanici"] = $gelenEmailAdresi;
                header("Location:index.php?SK=53"); //tamam
                exit();
            } else {
                header("Location:index.php?SK=54"); //hata
                exit();
            }
        }
    }
} else {
    header("Location:index.php?SK=56");
    exit();
}
?>