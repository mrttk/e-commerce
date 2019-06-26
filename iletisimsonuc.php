<?php
include_once "Ayarlar/settings.php";
include_once "Ayarlar/functions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Frameworks/PHPMailer/src/Exception.php';
require 'Frameworks/PHPMailer/src/PHPMailer.php';
require 'Frameworks/PHPMailer/src/SMTP.php';

if (isset($_POST["IsımSoyisim"])) {
    $gelenIsimSoyisim = guvenlik($_POST["IsımSoyisim"]);
} else {
    $gelenIsimSoyisim = "";
}
if (isset($_POST["EmailAdresi"])) {
    $gelenEmailAdresi = guvenlik($_POST["EmailAdresi"]);
} else {
    $gelenEmailAdresi = "";
}
if (isset($_POST["TelefonNumarasi"])) {
    $gelenTelefonNumarasi = guvenlik($_POST["TelefonNumarasi"]);
} else {
    $gelenTelefonNumarasi = "";
}
if (isset($_POST["Mesaj"])) {
    $gelenMesaj = guvenlik($_POST["Mesaj"]);
} else {
    $gelenMesaj = "";
}

if (($gelenIsimSoyisim != "") and ($gelenEmailAdresi != "") and ($gelenTelefonNumarasi != "") and ($gelenMesaj != "")) {
    $mailIcerigiHazirla = "İsim Soyisim :" . $gelenIsimSoyisim . "<br/>" . "Email :" . $gelenEmailAdresi . "<br/>" .
        "Telefon :" . $gelenTelefonNumarasi .
        "<br/>" . "Mesaj :" . $gelenMesaj;
    $mailGonder = new PHPMailer(true);
    try {
        $mailGonder->SMTPDebug = 0;
        $mailGonder->isSMTP();
        $mailGonder->Host = donusumleriGeriDondur($siteEmailHostAdresi);
        $mailGonder->SMTPAuth = true;
        $mailGonder->CharSet = 'UTF-8';
        $mailGonder->Username = donusumleriGeriDondur($siteEmail);
        $mailGonder->Password = donusumleriGeriDondur($siteEmailPassword);
        $mailGonder->SMTPSecure = 'tls';
        $mailGonder->Port = 587;
        $mailGonder->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mailGonder->setFrom(donusumleriGeriDondur($siteEmail), donusumleriGeriDondur($siteName));
        $mailGonder->addAddress(donusumleriGeriDondur($siteEmail), donusumleriGeriDondur($siteName));
        $mailGonder->addReplyTo($gelenEmailAdresi, $gelenIsimSoyisim);

        $mailGonder->isHTML(true);
        $mailGonder->Subject = donusumleriGeriDondur($siteName) . ' İletişim Formu Mesajı';
        $mailGonder->MsgHTML($mailIcerigiHazirla);
        $mailGonder->send();
        header("Location:index.php?SK=18");

        exit();
    } catch (Exception $e) {
        header("Location:index.php?SK=19");
        exit();
    }
} else {
    header("Location:index.php?SK=20");
    exit();
}
?>