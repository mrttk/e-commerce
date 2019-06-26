<?php

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
if (isset($_POST["SozlesmeOnay"])) {
    $gelenSozlesmeOnay = guvenlik($_POST["SozlesmeOnay"]);
} else {
    $gelenSozlesmeOnay = "";
}


$aktivasyonKodu = aktivasyonKoduUret();
$md5liSifre = md5($gelenEmailSifre);

if (($gelenIsimSoyisim != "") and ($gelenEmailAdresi != "") and ($gelenEmailSifre != "") and ($gelenSifreTekrar != "") and
    ($gelenTelefonNumarasi != "") and ($gelenCinsiyet != "")) {
    if ($gelenSozlesmeOnay == 0) {
        header("Location:index.php?SK=29");
        exit();
    } else {
        if ($gelenSifreTekrar != $gelenEmailSifre) {
            header("Location:index.php?SK=28");
            exit();
        } else {
            $kontrolSorgusu = $dbConnection->prepare("select * from uyeler where EmailAdresi = ?");
            $kontrolSorgusu->execute([$gelenEmailAdresi]);
            $kullaniciSayisi = $kontrolSorgusu->rowCount();
            if ($kullaniciSayisi > 0) {
                header("Location:index.php?SK=27");
                exit();
            } else {
                $uyeEklemeSorgusu = $dbConnection->prepare("insert into uyeler (EmailAdresi, Sifre, IsimSoyisim, TelefonNumarasi, Cinsiyet, Durumu, KayitIpAdresi, KayitTarihi, AktivasyonKodu) values (?,?,?,?,?,?,?,?,?)");
                $uyeEklemeSorgusu->execute([
                    $gelenEmailAdresi,
                    $md5liSifre,
                    $gelenIsimSoyisim,
                    $gelenTelefonNumarasi,
                    $gelenCinsiyet,
                    0,
                    $ipAdresi,
                    $zamanDamgasi,
                    $aktivasyonKodu
                ]);
                $kayitKontrol = $uyeEklemeSorgusu->rowCount();
                if ($kayitKontrol > 0) {

                    $mailIcerigiHazirla = "Merhaba Sayın " . $gelenIsimSoyisim . ",<br/>";
                    $mailIcerigiHazirla .= "Sitemize yapımış olduğunuz üyelik kaydını tamamlamak için lütfen 
                    <a href='" . $siteLinki . "/aktivasyon.php?AktivasyonKodu=" . $aktivasyonKodu . "&Email=" .
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
                        $mailGonder->addAddress(donusumleriGeriDondur($gelenEmailAdresi), donusumleriGeriDondur($gelenIsimSoyisim));
                        $mailGonder->addReplyTo(donusumleriGeriDondur($siteEmail), donusumleriGeriDondur($siteName));


                        $mailGonder->isHTML(true);
                        $mailGonder->Subject = donusumleriGeriDondur($siteName) . ' İletişim Formu Mesajı';
                        $mailGonder->MsgHTML($mailIcerigiHazirla);
                        $mailGonder->send();
                        header("Location:index.php?SK=24");
                        exit();
                    } catch (Exception $e) {
                        header("Location:index.php?SK=25");
                        exit();
                    }
                } else {
                    header("Location:index.php?SK=25");
                    exit();
                }
            }
        }
    }
} else {
    header("Location:index.php?SK=26");
    exit();
}
?>