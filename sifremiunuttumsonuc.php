<?php
include_once "Ayarlar/settings.php";
include_once "Ayarlar/functions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Frameworks/PHPMailer/src/Exception.php';
require 'Frameworks/PHPMailer/src/PHPMailer.php';
require 'Frameworks/PHPMailer/src/SMTP.php';

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

if (($gelenEmailAdresi != "") or ($gelenTelefonNumarasi != "")) {
    $kontrolSorgusu = $dbConnection->prepare("select * from uyeler where EmailAdresi = ? or TelefonNumarasi = ? limit 1");
    $kontrolSorgusu->execute([$gelenEmailAdresi, $gelenTelefonNumarasi]);
    $kayitSayisi = $kontrolSorgusu->rowCount();
    $kullaniciKaydi = $kontrolSorgusu->fetch(PDO::FETCH_ASSOC);
    if ($kayitSayisi > 0) {
        $mailIcerigiHazirla = "Merhaba Sayın " . $gelenIsimSoyisim . ",<br/>";
        $mailIcerigiHazirla .= "Sitemiz üzerinde bulunan hesabınızın şifresini sıfırlamak için lütfen 
                    <a href='" . $siteLinki . "/index.php?SK=43&AktivasyonKodu=" . $kullaniciKaydi["AktivasyonKodu"] .
            "&Email=" .
            $gelenEmailAdresi . "'>
                        buraya tıklayınız
                    </a>.";
        $mailIcerigiHazirla .= "Saygılarımızla, iyi çalışmalar.<br/>";

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
            $mailGonder->Subject = donusumleriGeriDondur($siteName) . ' Şifre Sıfırlama';
            $mailGonder->MsgHTML($mailIcerigiHazirla);
            $mailGonder->send();
            header("Location:index.php?SK=39");
            exit();
        } catch (Exception $e) {
            header("Location:index.php?SK=40");
            exit();
        }
    } else {
        header("Location:index.php?SK=41");
        exit();
    }
} else {
    header("Location:index.php?SK=42");
    exit();
}
?>


