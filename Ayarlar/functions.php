<?php
$ipAdresi = $_SERVER["REMOTE_ADDR"];
$zamanDamgasi = time();
$tarihSaat = date("d.m.Y H:i:s");

/**
 * @param timestamp $deger 
 * 
 * @return date
 */
function tarihBul($deger)
{

    return $tarihSaat = date("d.m.Y H:i:s", $deger);
}

function UcGunIleriTarihBul()
{
    global $zamanDamgasi;
    $birGun = 86400;
    $hesapla = $zamanDamgasi + (3 * $birGun);
    return $cevir = date("d.m.Y", $hesapla);
}

function rakamlarHaricTumKarakterleriSil($deger)
{
    $islem = preg_replace("/[^0-9]/", "", $deger);
    return $islem;
}

function guvenlik($deger)
{
    $boslukSil = trim($deger);
    $taglariTemizle = htmlspecialchars($boslukSil, ENT_QUOTES);
    return $etkisizYap = strip_tags($taglariTemizle);
}
/**
 * Numeric ifadeler dışında veri girişinin yapılmasını engeller
 * 
 * return string|string[]
 */
function SayiliIcerikleriFiltrele($deger)
{
    $boslukSil = trim($deger);
    $taglariTemizle = htmlspecialchars($boslukSil, ENT_QUOTES);
    $etkisizYap = strip_tags($taglariTemizle);
    $temizle = rakamlarHaricTumKarakterleriSil($etkisizYap);
    return $temizle;
}

function donusumleriGeriDondur($deger)
{
    $etkinlestir = htmlspecialchars_decode($deger, ENT_QUOTES);
    return $etkinlestir;
}
/**
 * Üyelik aktivasyon işlemleri için random kod üretir.
 * 
 * return string 
 */
function aktivasyonKoduUret()
{
    $ilkBesli = rand(10000, 99999);
    $ikinciBesli = rand(10000, 99999);
    $ucuncuBesli = rand(10000, 99999);
    $kod = $ilkBesli . "-" . $ikinciBesli . "-" . $ucuncuBesli;
    return $kod;
}

/**
 * Zaman damgalarını tarih formatını dönüştürür.
 * 
 * return string 
 */
function fiyatBicimlendir($deger)
{
    $bicimlendir = number_format($deger, "2", ",", ".");
    return $bicimlendir;
}
