<?php

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
if (isset($_GET["AktivasyonKodu"])) {
    $gelenAktivasyonKodu = $_GET["AktivasyonKodu"];
} else {
    $gelenAktivasyonKodu = "";
}
if (isset($_GET["Email"])) {
    $gelenEmail = $_GET["Email"];
} else {
    $gelenEmail = "";
}
if (($gelenEmailSifre != "") and ($gelenSifreTekrar != "") and ($gelenAktivasyonKodu != "") and ($gelenEmail != "")) {
    if ($gelenSifreTekrar != $gelenEmailSifre) {
        header("Location:index.php?SK=47");
        exit();
    } else {
        $md5liSifre = (string)md5($gelenEmailSifre);
        $uyeGuncellemeSorgusu = $dbConnection->prepare("update uyeler set Sifre = ? where EmailAdresi = ? and AktivasyonKodu = ? limit 1");
        $uyeGuncellemeSorgusu->execute([$md5liSifre, $gelenEmail, $gelenAktivasyonKodu]);
        $uyeGuncellemeSorgusu->fetch(PDO::FETCH_ASSOC);
        $kontrolSayisi = $uyeGuncellemeSorgusu->rowCount();
        if ($kontrolSayisi > 0) {
            header("Location:index.php?SK=45");
            exit();
        } else {
            header("Location:index.php?SK=46");
            exit();
        }
    }
} else {
    header("Location:index.php?SK=48");
    exit();
}
?>