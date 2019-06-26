<?php
include_once "Ayarlar/settings.php";
include_once "Ayarlar/functions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Frameworks/PHPMailer/src/Exception.php';
require 'Frameworks/PHPMailer/src/PHPMailer.php';
require 'Frameworks/PHPMailer/src/SMTP.php';

if (isset($_POST["Sifre"])) {
    $gelenSifre = guvenlik($_POST["Sifre"]);
} else {
    $gelenSifre = "";
}
if (isset($_POST["EmailAdresi"])) {
    $gelenEmailAdresi = guvenlik($_POST["EmailAdresi"]);
} else {
    $gelenEmailAdresi = "";
}
$md5liSifre = (string)md5($gelenSifre);
//echo $gelenEmailAdresi . " " . $gelenSifre . " " . $md5liSifre;die();

if (($gelenEmailAdresi != "") and ($gelenSifre != "")) {
    $kontrolSorgusu = $dbConnection->prepare("select * from uyeler where EmailAdresi = ? and Sifre = ?");
    $kontrolSorgusu->execute([$gelenEmailAdresi, $md5liSifre]);
    $kullaniciSayisi = $kontrolSorgusu->rowCount();
    $kullaniciKaydi = $kontrolSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($kullaniciSayisi > 0) {
        if ($kullaniciKaydi["Durumu"] == 1) {
            $_SESSION["Kullanici"] = $gelenEmailAdresi;
            if ($_SESSION["Kullanici"] == $gelenEmailAdresi) {
                header("Location:index.php?SK=50");
                exit();
            } else {
                header("Location:index.php?SK=33");
                exit();
            }
        } else {
            $mailIcerigiHazirla = "Merhaba Sayın " . $kullaniciKaydi["IsimSoyisim"] . "<br/>";
            $mailIcerigiHazirla .= "Sitemize yapmış olduğunuz üyelik kaydını aktif etmek için lütfen 
            <a href='" . $siteLinki . "/aktivasyon.php?AktivasyonKodu=" . $kullaniciKaydi["AktivasyonKodu"] . "&Email="
                . $kullaniciKaydi["EmailAdresi"] . "'>buraya tıklayınız</a>. <br/><br/>Saygılarımızla, iyi çalışmalar<br/>";
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
                $mailGonder->addAddress(donusumleriGeriDondur($kullaniciKaydi["EmailAdresi"]), donusumleriGeriDondur
                ($siteName));
                $mailGonder->addReplyTo(donusumleriGeriDondur($siteEmail), donusumleriGeriDondur($siteName));

                $mailGonder->isHTML(true);
                $mailGonder->Subject = donusumleriGeriDondur($siteName) . ' - Üyelik Aktivasyonu ';
                $mailGonder->MsgHTML($mailIcerigiHazirla);
                $mailGonder->send();
                header("Location:index.php?SK=36");
                exit();
            } catch (Exception $exception) {
                header("Location:index.php?SK=33");
                exit();
            }
        }
    } else {
        header("Location:index.php?SK=34");
    }
} else {
    header("Location:index.php?SK=35");
    exit();
}
?>


