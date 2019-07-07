<?php
session_start();
ob_start();
require_once "Ayarlar/settings.php";
require_once "Ayarlar/functions.php";
require_once "Ayarlar/sitesayfalari.php";
    if (isset($_REQUEST["SK"])) {
    $sayfaKoduDegeri = SayiliIcerikleriFiltrele($_REQUEST["SK"]);
} else {
    $sayfaKoduDegeri = 0;
}
if (isset($_REQUEST["SYF"])) {
    $sayfalama = SayiliIcerikleriFiltrele($_REQUEST["SYF"]);
} else {
    $sayfalama = 1;
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="revisit-after" content="7 Days">
    <link type="image/png" rel="icon" href="Resimler/Favicon.png">
    <title><?php echo SayiliIcerikleriFiltrele($siteTitle); ?></title>
    <meta name="description" content="<?php echo SayiliIcerikleriFiltrele($siteDescription); ?>">
    <meta name="keywords" content="<?php echo SayiliIcerikleriFiltrele($siteKeywords); ?>">
    <script language="JavaScript" type="text/javascript" src="Frameworks/JQuery/jquery-3.4.0.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="Ayarlar/functions.js"></script>
    <link type="text/css" rel="stylesheet" href="Ayarlar/style.css">
</head <body>
<table width="1065" height="100%" cellspacing="0" cellpadding="0" border="0" align="center">
    <tr height="40" bgcolor="#353745">
        <td><img src="Resimler/HeaderMesajResmi.png" border="0"></td>
    </tr>
    <tr height="110">
        <td>
            <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr bgcolor="#0088CC">
                    <td>&nbsp;</td>
                    <td width="20"><a href=""><img src="Resimler/KullaniciBeyaz16x16.png" border="0" style="margin-top: 5px;"></a></td>
                    <?php
                    if (isset($_SESSION["Kullanici"])) { ?>
                        <td width="70" class="MaviAlanMenusu"><a href="index.php?SK=50">Hesabım</a></td>
                        <td width="20"><a href=""><img src="Resimler/CikisBeyaz16x16.png" border="0" style="margin-top: 5px;"></a></td>
                        <td width="85" class="MaviAlanMenusu"><a href="index.php?SK=49">Çıkış Yap</a></td>
                        <td width="20"><a href=""><img src="Resimler/SepetBeyaz16x16.png" border="0" style="margin-top: 5px;"></a></td>
                    <?php } else { ?>
                        <td width="70" class="MaviAlanMenusu"><a href="index.php?SK=31">Giriş Yap</a></td>
                        <td width="20"><a href=""><img src="Resimler/KullaniciEkleBeyaz16x16.png" border="0" style="margin-top: 5px;"></a></td>
                        <td width="85" class="MaviAlanMenusu"><a href="index.php?SK=22">Yeni Üye Ol</a></td>
                        <td width="20"><a href=""><img src="Resimler/SepetBeyaz16x16.png" border="0" style="margin-top: 5px;"></a></td>
                    <?php } ?>
                    <td width="103" class="MaviAlanMenusu"><a href="">Alışveriş Sepeti</a></td>
                </tr>
            </table>
            <table width="1065" height="80" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="192"><a href="index.php?SK=0"><img src="Resimler/<?php echo $logo; ?>"></a></td>
                    <td>
                        <table width="873" height="30" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="314" class="AnaMenu">&nbsp;</td>
                                <td width="105" class="AnaMenu"><a href="index.php">Anasayfa</a></td>
                                <td width="158" class="AnaMenu"><a href="index.php?SK=84">Erkek
                                        Ayakkabıları</a></td>
                                <td width="158" class="AnaMenu"><a href="index.php?SK=85">Kadın
                                        Ayakkabıları</a></td>
                                <td width="138" class="AnaMenu"><a href="index.php?SK=86">Çocuk Ayakkabıları</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr valign="top">
        <td>
            <?php
            if ((!$sayfaKoduDegeri) or ($sayfaKoduDegeri == "") or ($sayfaKoduDegeri == 0)) {
                include $sayfa[0];
            } else {
                include $sayfa[$sayfaKoduDegeri];
            }
            ?>
        </td>
    </tr>
    <tr height="210">
        <td>
            <table width="1065" class="SiteHaritası" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
                <tr height="30">
                    <td width="" style="border-bottom: 1px solid #cccccc;"><b>Kurumsal</b></td>
                    <td width="">&nbsp;</td>
                    <td width="" style="border-bottom: 1px solid #cccccc;"><b>Üyelik ve Hizmetler</b></td>
                    <td width="">&nbsp;</td>
                    <td width="" style="border-bottom: 1px solid #cccccc;"><b>Sözleşmeler</b></td>
                    <td width="">&nbsp;</td>
                    <td width="" style="border-bottom: 1px solid #cccccc;"><b>Bizi Takip Edin</b></td>
                </tr>
                <tr height="30">
                    <td><a href="index.php?SK=1">Hakkımızda</a></td>
                    <td>&nbsp;</td>
                    <?php if (isset($_SESSION["Kullanici"])) {
                        ?>
                        <td><a href="index.php?SK=50">Hesabım</a></td>
                    <?php
                    } else {
                        ?>
                        <td><a href="index.php?SK=22">Yeni Üye Ol</a></td>
                    <?php
                    }
                    ?>
                    <td>&nbsp;</td>
                    <td><a href="index.php?SK=2"> Üyelik Sözleşmesi</a></td>
                    <td>&nbsp;</td>
                    <td>
                        <table>
                            <tr>
                                <td><img src="Resimler/Facebook16x16.png"></td>
                                <td><a href="<?php echo donusumleriGeriDondur($SosyalLinkFacebook);
                                                ?>" target="_blank">Facebook</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr height="30">
                    <td><a href="index.php?SK=8">Banka Hesaplarımız</a></td>
                    <td>&nbsp;</td>
                    <?php
                    if (isset($_SESSION["Kullanici"])) { ?>
                        <td><a href="index.php?SK=49">Çıkış Yap</a></td>
                    <?php } else { ?>
                        <td><a href="index.php?SK=31">Giriş Yap</a></td>
                    <?php } ?>
                    <td>&nbsp;</td>
                    <td><a href="index.php?SK=3">Kullanım Koşulları</a></td>
                    <td>&nbsp;</td>
                    <td>
                        <table>
                            <tr>
                                <td><img src="Resimler/Instagram16x16.png"></td>
                                <td><a href="<?php echo donusumleriGeriDondur($SosyalLinkInstagram);
                                                ?>" target="_blank">Instagram</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr height="30">
                    <td><a href="index.php?SK=9">Havale Bildirim Formu</a></td>
                    <td>&nbsp;</td>
                    <td><a href="index.php?SK=21">Sık Sorulan Sorular</a></td>
                    <td>&nbsp;</td>
                    <td><a href="index.php?SK=4">Gizlilik Sözleşmesi</td>
                    <td>&nbsp;</td>
                    <td>
                        <table>
                            <tr>
                                <td><img src="Resimler/Twitter16x16.png"></td>
                                <td><a href="<?php echo donusumleriGeriDondur($SosyalLinkTwitter);
                                                ?>" target="_blank">Twitter</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr height="30">
                    <td><a href="index.php?SK=14">Kargom Nerede?</a></td>
                    <td>&nbsp;</td>
                    <td><a href="index.php?SK=5">Mesafeli Satış Sözleşmesi</a></td>
                    <td>&nbsp;</td>
                    <td><a href="index.php?SK=6">Teslimat</a></td>
                    <td>&nbsp;</td>
                    <td>
                        <table>
                            <tr>
                                <td><img src="Resimler/YouTube16x16.png"></td>
                                <td>
                                    <a href="<?php echo donusumleriGeriDondur($SosyalLinkYoutube);
                                                ?>" target="_blank">YouTube</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr height="30">
                    <td><a href="index.php?SK=16">İletişim</a></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><a href="index.php?SK=7">İptal İade ve Değişim</a></td>
                    <td>&nbsp;</td>
                    <td>
                        <table>
                            <tr>
                                <td><img src="Resimler/Pinterest16x16.png"></td>
                                <td>
                                    <a href="<?php echo donusumleriGeriDondur($SosyalLinkPinterest);
                                                ?>" target="_blank">Pinterest</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr height="30" align="center">
        <td><?php echo donusumleriGeriDondur($copyright); ?></td>
    </tr>
    <tr height="30" align="center">
        <td>
            <table class="BankaKartlari" width="1065" height="30" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center">
                        <img src="Resimler/RapidSSL32x12.png">
                        <img src="Resimler/InternetteGuvenliAlisveris28x12.png">
                        <img src="Resimler/3DSecure14x12.png">
                        <img src="Resimler/BonusCard41x12.png">
                        <img src="Resimler/MaximumCard46x12.png">
                        <img src="Resimler/WorldCard48x12.png">
                        <img src="Resimler/CardFinans78x12.png">
                        <img src="Resimler/AxessCard46x12.png">
                        <img src="Resimler/ParafCard19x12.png">
                        <img src="Resimler/VisaCard37x12.png">
                        <img src="Resimler/MasterCard21x12.png">
                        <img src="Resimler/AmericanExpiress20x12.png"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>
<?php
$dbConnection = null;
ob_end_flush();
?>