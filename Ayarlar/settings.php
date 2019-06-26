<?php
try {
    $dbConnection = new PDO("mysql:host=localhost;dbname=ecommerce;charset=UTF8", "root", "");
} catch (PDOException $exception) {
    //echo "Bağlantı hatalı</br>".$exception->getMessage();
    die();
}

$settingsQuery = $dbConnection->prepare("select * from settings limit 1");
$settingsQuery->execute();
$settingsRecord = $settingsQuery->fetch(PDO::FETCH_ASSOC);
$settingsRowCount = $settingsQuery->rowCount();

if ($settingsRowCount > 0) {
    $siteName = $settingsRecord["sitename"];
    $siteTitle = $settingsRecord["sitetitle"];
    $siteDescription = $settingsRecord["sitedescription"];
    $siteKeywords = $settingsRecord["sitekeywords"];
    $copyright = $settingsRecord["copyright"];
    $logo = $settingsRecord["logo"];
    $siteLinki = $settingsRecord["SiteLinki"];
    $siteEmail = $settingsRecord["siteemail"];
    $siteEmailPassword = $settingsRecord["siteemailpassword"];
    $siteEmailHostAdresi = $settingsRecord["SiteEmailHostAdresi"];
    $SosyalLinkFacebook = $settingsRecord["SosyalLinkFacebook"];
    $SosyalLinkTwitter = $settingsRecord["SosyalLinkTwitter"];
    $SosyalLinkInstagram = $settingsRecord["SosyalLinkInstagram"];
    $SosyalLinkLinkedIn = $settingsRecord["SosyalLinkLinkedIn"];
    $SosyalLinkYoutube = $settingsRecord["SosyalLinkYoutube"];
    $SosyalLinkPinterest = $settingsRecord["SosyalLinkPinterest"];
} else {
    //echo "Ayar Sorgusu Hatası!";
    die();
}


$metinlerSorgusu = $dbConnection->prepare("select * from sozlesmelervemetinler limit 1");
$metinlerSorgusu->execute();
$metinler = $metinlerSorgusu->fetch(PDO::FETCH_ASSOC);
$metinlerSayisi = $metinlerSorgusu->rowCount();

if ($metinlerSayisi > 0) {
    $hakkimizdaMetni = $metinler["HakkimizdaMetni"];
    $uyelikSozlesmesiMetni = $metinler["UyelikSozlesmesiMetni"];
    $kullanimKosullariMetni = $metinler["KullanimKosullariMetni"];
    $gizlilikSozlesmesiMetni = $metinler["GizlilikSozlesmesiMetni"];
    $mesafeliSatisSozlesmesiMetni = $metinler["MesafeliSatisSozlesmesiMetni"];
    $teslimatMetni = $metinler["TeslimatMetni"];
    $iptalIadeDegisimMetni = $metinler["IptalIadeDegisimMetni"];
} else {
    //echo "Ayar Sorgusu Hatası!";
    die();
}

if (isset($_SESSION["Kullanici"])) {
    $kullaniciSorgusu = $dbConnection->prepare("select * from uyeler where EmailAdresi = ? limit 1");
    $kullaniciSorgusu->execute([$_SESSION["Kullanici"]]);
    $kullaniciSayisi = $kullaniciSorgusu->rowCount();
    $kullanici = $kullaniciSorgusu->fetch(PDO::FETCH_ASSOC);
    if ($kullaniciSayisi > 0) {
        $kullaniciId = $kullanici["id"];
        $emailAdresi = $kullanici["EmailAdresi"];
        $sifre = $kullanici["Sifre"];
        $isimSoyisim = $kullanici["IsimSoyisim"];
        $telefonNumarasi = $kullanici["TelefonNumarasi"];
        $cinsiyet = $kullanici["Cinsiyet"];
        $durumu = $kullanici["Durumu"];
        $kayitTarihi = $kullanici["KayitTarihi"];
        $kayitIpAdresi = $kullanici["KayitIpAdresi"];
        $aktivasyonKodu = $kullanici["AktivasyonKodu"];
    } else {
        die();
    }

}