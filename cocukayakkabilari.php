<?php
include "Ayarlar/settings.php";
if (isset($_REQUEST["MenuID"])) {
    $gelenMenuId        =    SayiliIcerikleriFiltrele(guvenlik($_REQUEST["MenuID"]));
    $menuKosulu = "and MenuId = '$gelenMenuId'";
    $sayfalamaKosulu = "&MenuID=" . $gelenMenuId;
} else {
    $gelenMenuId        =    "";
    $menuKosulu = "";
    $sayfalamaKosulu = "";
}


if (isset($_REQUEST["AramaIcerigi"])) {
    $gelenAramaIcerigi       =    guvenlik($_REQUEST["AramaIcerigi"]);
    $aramaKosulu = "and UrunAdi like'%" . $gelenAramaIcerigi . "%'";
    $sayfalamaKosulu .= "&AramaIcerigi=" . $gelenAramaIcerigi;
} else {
    $aramaKosulu = "";
    $sayfalamaKosulu .= "";
}

/*Sayfalama Sorgu Başlangısı*/
$sayfalamaIcinSolveSagButonSayisi = 2;
$sayfaBasinaGosterilecekKayitSayisi = 10;
$toplamKayitSayisiSorgusu = $dbConnection->prepare("select * from urunler where UrunTuru ='Çocuk Ayakkabısı' and Durumu = '1'" . $menuKosulu . "" . $aramaKosulu . " order by id desc");
$toplamKayitSayisiSorgusu->execute();
$toplamKayitSayisi = $toplamKayitSayisiSorgusu->rowCount();
$sayfalamayaBaslanacakKayitSayisi = ($sayfalama * $sayfaBasinaGosterilecekKayitSayisi) - $sayfaBasinaGosterilecekKayitSayisi;
$bulunanSayfaSayisi = ceil($toplamKayitSayisi / $sayfaBasinaGosterilecekKayitSayisi);
$anaMenununTümUrunSayiSorgusu = $dbConnection->prepare("select sum(UrunSayisi) as MenununToplamUrunu from menuler where UrunTuru='Çocuk Ayakkabısı'");
$anaMenununTümUrunSayiSorgusu->execute();
$anaMenununTümUrunSayiSorgusu = $anaMenununTümUrunSayiSorgusu->fetch(PDO::FETCH_ASSOC);

/*Sayfalama Sorgu Sonu*/
?>
<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="250" align="left" valign="top">
            <table width="250" align="left" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="50">
                                <td bgcolor="#F1F1F1"><b>&nbsp;MENÜLER</b></td>
                            </tr>
                            <tr height="30">
                                <td><a href="index.php?SK=86" style="text-decoration: none; font-weight: bold; 
                                <?php if ($gelenMenuId == '') {
                                    echo 'color: #FF9900;';
                                } else {
                                    echo 'color: #646464;';
                                } ?> ">&nbsp;Tüm Ürünler (<?php echo $anaMenununTümUrunSayiSorgusu['MenununToplamUrunu']; ?>)</a></td>
                            </tr>
                            <?php
                            $MenulerSorgusu        =    $dbConnection->prepare("SELECT * FROM menuler WHERE UrunTuru = 'Çocuk Ayakkabısı' ORDER BY MenuAdi ASC");
                            $MenulerSorgusu->execute();
                            $MenuKayitSayisi    =    $MenulerSorgusu->rowCount();
                            $MenuKayitlari        =    $MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($MenuKayitlari as $Menu) {
                                ?>
                                <tr height="30">
                                    <td><a href="index.php?SK=86&MenuID=<?php echo $Menu["id"]; ?>" style="text-decoration: none; <?php if ($gelenMenuId == $Menu["id"]) { ?>color: #FF9900;<? } else { ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;<?php echo DonusumleriGeriDondur($Menu["MenuAdi"]); ?> (<?php echo DonusumleriGeriDondur($Menu["UrunSayisi"]); ?>)</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="50">
                                <td bgcolor="#F1F1F1"><b>&nbsp;REKLAMLAR</b></td>
                            </tr>
                            <?php
                            $BannerSorgusu        =    $dbConnection->prepare("SELECT * FROM bannerlar WHERE BannerAlani = 'Menu Altı' ORDER BY GosterimSayisi ASC LIMIT 1");
                            $BannerSorgusu->execute();
                            $BannerSayisi        =    $BannerSorgusu->rowCount();
                            $BannerKaydi        =    $BannerSorgusu->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr height="250">
                                <td><img src="Resimler/<?php echo $BannerKaydi["BannerResmi"]; ?>" border="0"></td>
                            </tr>
                            <?php
                            $BannerGuncelle        =    $dbConnection->prepare("UPDATE bannerlar SET GosterimSayisi=GosterimSayisi+1 WHERE id = ? LIMIT 1");
                            $BannerGuncelle->execute([$BannerKaydi["id"]]);
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <td width="11">&nbsp;</td>


        <td width="795" align="left" valign="top">
            <table width="795" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div class="AramaAlani">
                            <form action="<?php if ($menuKosulu != "") { ?>index.php?SK=86&MenuID=<?php echo $gelenMenuId;
                                                                                                    } else { ?>index.php?SK=86<?php } ?>" method="post">
                                <div class="AramaAlaniButonKapsamaAlani">
                                    <input type="submit" value="" class="AramaAlaniButonu">
                                </div>
                                <div class="AramaAlaniInputKapsamaAlani">
                                    <input type="text" name="AramaIcerigi" class="AramaAlaniInputu">
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>

                    <td>

                        <table align="left" border="0" cellpadding="0" cellspacing="0">
                            <tr>

                                <?php
                                $urunlerSorgusu = $dbConnection->prepare("select * from urunler where UrunTuru ='Çocuk Ayakkabısı' and Durumu = '1'" . $menuKosulu . "" . $aramaKosulu . " order by id desc limit $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
                                $urunlerSorgusu->execute();
                                $urunSayisi = $urunlerSorgusu->rowCount();
                                $urunKayitlari = $urunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);
                                $donguSayisi = 1;
                                $sutunSayisiAdedi = 4;

                                foreach ($urunKayitlari as $kayit) {

                                    $urununFiyati = donusumleriGeriDondur($kayit['UrunFiyati']);
                                    $urununParaBirimi = donusumleriGeriDondur($kayit['ParaBirimi']);

                                    if ($urununParaBirimi == "USD") {
                                        $urunFiyatiniHesapla = $urununFiyati * $dolarKuru;
                                    } elseif ($urununParaBirimi == "EUR") {
                                        $urunFiyatiniHesapla = $urununFiyati * $euroKuru;
                                    } else {
                                        $urunFiyatiniHesapla = $urununFiyati;
                                    }

                                    $urununToplamYorumSayisi = donusumleriGeriDondur($kayit['YorumSayisi']);
                                    $urununToplamYorumPuani = donusumleriGeriDondur($kayit['ToplamYorumPuani']);


                                    if ($urununToplamYorumSayisi > 0) {
                                        $puanHesapla =  number_format($urununToplamYorumPuani / $urununToplamYorumSayisi, 2, ".", "");
                                    } else {
                                        $puanHesapla = 0;
                                    }
                                    
                                    if ($puanHesapla == 0) {
                                        $puanResmi = "YildizCizgiliBos.png";
                                    } elseif ($puanHesapla > 0 & $puanHesapla <= 1) {
                                        $puanResmi = "YildizCizgiliBirDolu.png";
                                    } elseif ($puanHesapla > 1 & $puanHesapla <= 2) {
                                        $puanResmi = "YildizCizgiliBirDolu.png";
                                    } elseif ($puanHesapla > 2 & $puanHesapla <= 3) {
                                        $puanResmi = "YildizCizgiliIkiDolu.png";
                                    } elseif ($puanHesapla > 3 & $puanHesapla <= 4) {
                                        $puanResmi = "YildizCizgiliDortDolu.png";
                                    } else {
                                        $puanResmi = "YildizCizgiliBesDolu.png";
                                    }

                                    ?>
                                    <td width="191" valign="top">
                                        <table width="191" align="left" cellpadding="0" cellspacing="0" style="border: 1px solid #ccc; margin-bottom: 20px; padding-top: 2px">
                                            <tr>
                                                <td align="center" width="191">
                                                    <a href="index.php?SK=83&ID=<?php echo donusumleriGeriDondur($kayit['id']); ?>">
                                                        <img width="185" height="247" src="Resimler/UrunResimleri/Cocuk/<?php echo $kayit['UrunResmiBir']; ?>">
                                                    </a>
                                            </tr>
                                            <tr>
                                                <td align="center" width="191">
                                                    <a href="index.php?SK=83&ID=<?php echo $kayit['id']; ?>" style="color:#FF9900; font-weight: bold;text-decoration: none;">
                                                        Çocuk Ayakkabısı
                                                    </a>
                                            </tr>
                                            <tr height="25" align="center">
                                                <td width="191" style="color:#646464;">
                                                    <div style="width:191px;height:16px;">
                                                        <?php echo donusumleriGeriDondur($kayit['UrunAdi']); ?></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="191" align="center">
                                                    <a href="index.php?SK=83&ID=<?php echo donusumleriGeriDondur($kayit['id']); ?>">
                                                        <img src="Resimler/<?php echo $puanResmi; ?>">
                                                    </a>
                                            </tr>
                                            <tr>
                                                <td width="191" align="center">
                                                    <a href="index.php?SK=83&ID=<?php echo donusumleriGeriDondur($kayit['id']); ?>" style="text-decoration:none; color:#646464;">
                                                        <?php echo fiyatBicimlendir($urunFiyatiniHesapla); ?> TL
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="191" align="center">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    if ($donguSayisi < $sutunSayisiAdedi) { ?>
                                        <td width="10">&nbsp;</td>
                                    <?php
                                    }
                                    $donguSayisi++;
                                    if ($donguSayisi > $sutunSayisiAdedi) {
                                        echo "</tr><tr>";
                                    }
                                } ?>
                        </table>
                </tr>

                <?php if ($bulunanSayfaSayisi > 1) {
                    ?>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <td align="left">

                            <div class="SayfalamaAlaniKapsayicisi">
                                <div class="SayfalamaAlaniIcinMetinAlaniKapsayicisi" align="center">
                                    <p>Toplam <b><?php echo $bulunanSayfaSayisi; ?></b> sayfada,<b><?php echo $toplamKayitSayisi; ?></b> adet kayit bulunmaktadir.</p>
                                </div>
                                <div class="SayfalamaAlanıIcinNumaraAlaniKapsayicisi">
                                    <?php
                                    if ($sayfalama > 1) {
                                        echo "<span class='SayfalamaPasif'> <a href='index.php?SK=86" . $sayfalamaKosulu . "&SYF=1'> << </a></span>";
                                        $safalamaIcinSayfaDegeriniBirGeriAL = $sayfalama - 1;
                                        echo "<span class='SayfalamaPasif'><a href='index.php?SK=86" . $sayfalamaKosulu .  "&SYF=" . $safalamaIcinSayfaDegeriniBirGeriAL . "'> < </a></span>";
                                    }

                                    for (
                                        $sayfalamaIcinSayfaIndexDegeri = $sayfalama - $sayfalamaIcinSolveSagButonSayisi;
                                        $sayfalamaIcinSayfaIndexDegeri <= $sayfalama + $sayfalamaIcinSolveSagButonSayisi;
                                        $sayfalamaIcinSayfaIndexDegeri++
                                    ) {
                                        if (($sayfalamaIcinSayfaIndexDegeri > 0) and ($sayfalamaIcinSayfaIndexDegeri <= $bulunanSayfaSayisi)
                                        ) {
                                            if ($sayfalama == $sayfalamaIcinSayfaIndexDegeri) {
                                                echo "<span class='SayfalamaAktif'>$sayfalamaIcinSayfaIndexDegeri</span>";
                                            } else {
                                                echo "<span class='SayfalamaPasif'><a href='index.php?SK=86" . $sayfalamaKosulu . "&SYF=" . $sayfalamaIcinSayfaIndexDegeri . "'>
$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                            }
                                        }
                                    }


                                    if ($sayfalama != $bulunanSayfaSayisi) {
                                        $sayfalamaIcinSayfaDegeriniBirIleriAl = $sayfalama + 1;
                                        echo "<span class='SayfalamaPasif'><a href='index.php?SK=86" . $sayfalamaKosulu .  "&SYF=" .
                                            $sayfalamaIcinSayfaDegeriniBirIleriAl . "'> > </a></span>";
                                        echo "<span class='SayfalamaPasif'><a href='index.php?SK=86" . $sayfalamaKosulu .  "&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>



                <?php } ?>

        </td>
    </tr>


</table>
</td>


</tr>
</table>