<?php

if (isset($_GET["ID"])) {
    $gelenId        =    SayiliIcerikleriFiltrele(guvenlik($_REQUEST["ID"]));

    $hitGuncelle = $dbConnection->prepare("update urunler set ToplamGoruntulenmeSayisi = ToplamGoruntulenmeSayisi + 1 where id = ? and durumu = ? limit 1");
    $hitGuncelle->execute([$gelenId,1]);

    $urunSorgusu = $dbConnection->prepare("select * from urunler where id =? and Durumu = ? limit 1");
    $urunSorgusu->execute([$gelenId, 1]);
    $urunSayisi = $urunSorgusu->rowCount();
    $urunSorgusuKaydi = $urunSorgusu->fetch(PDO::FETCH_ASSOC);
    if ($urunSayisi > 0) {
        $urunTuru = $urunSorgusuKaydi['UrunTuru'];
        if ($urunTuru == "Erkek Ayakkabısı") {
            $resimKlasoru = "Erkek";
        } elseif ($urunTuru == "Kadın Ayakkabısı") {
            $resimKlasoru = "Kadin";
        } else {
            $resimKlasoru = "Cocuk";
        }

        $urununFiyati = donusumleriGeriDondur($urunSorgusuKaydi['UrunFiyati']);
        $urununParaBirimi = donusumleriGeriDondur($urunSorgusuKaydi['ParaBirimi']);

        if ($urununParaBirimi == "USD") {
            $urunFiyatiniHesapla = $urununFiyati * $dolarKuru;
        } elseif ($urununParaBirimi == "EUR") {
            $urunFiyatiniHesapla = $urununFiyati * $euroKuru;
        } else {
            $urunFiyatiniHesapla = $urununFiyati;
        }

        ?>

        <table width="1065" align="center" cellpaddign="0" cellspacing="0">
            <tr>


                <td width="350" valign="top">
                    <table width="350" align="center" border="0" cellspacing="0">

                        <tr>
                            <td align="center" width="350" style="border:1px solid #ccc;"><img id="buyukresim" src="Resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo $urunSorgusuKaydi['UrunResmiBir'] ?>" border="0" width="330" height="440"></td>
                        </tr>
                        <tr height="5">
                            <td style="font-size:5px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="350" align="center" border="0" cellspacing="0">
                                    <tr>
                                        <td width="108">
                                            <img src="Resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo $urunSorgusuKaydi['UrunResmiBir'] ?>" width="108" height="144" style="border:1px solid #ccc;" onClick="$.UrunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo $urunSorgusuKaydi["UrunResmiBir"]; ?>');">
                                        </td>
                                        <td width="10">&nbsp;</td>
                                        <td width="108"><?php if ($urunSorgusuKaydi['UrunResmiIki'] != null) { ?>
                                                <img src="Resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo $urunSorgusuKaydi['UrunResmiIki'] ?>" width="108" height="144" style="border:1px solid #ccc;" onClick="$.UrunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo $urunSorgusuKaydi["UrunResmiIki"]; ?>');">
                                            <?php } else { ?>&nbsp;<?php } ?>
                                        </td>
                                        <td width="10">&nbsp;</td>
                                        <td width="108">
                                            <?php if ($urunSorgusuKaydi['UrunResmiUc'] != null) { ?>
                                                <img src="Resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo $urunSorgusuKaydi['UrunResmiUc'] ?>" width="108" height="144" style="border:1px solid #ccc;" onClick="$.UrunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo $urunSorgusuKaydi["UrunResmiUc"]; ?>');">
                                            <?php } else { ?>&nbsp;<?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <table width="350" align="center" border="0" cellpadding="0" cellspacing="0">
                                    <tr height="50">
                                        <td bgcolor="#F1F1F1"><b>REKLAMLAR</b></td>
                                    </tr>
                                    <?php
                                    $BannerSorgusu        =    $dbConnection->prepare("SELECT * FROM bannerlar WHERE BannerAlani = 'Urun Detay' ORDER BY GosterimSayisi ASC LIMIT 1");
                                    $BannerSorgusu->execute();
                                    $BannerSayisi        =    $BannerSorgusu->rowCount();
                                    $BannerKaydi        =    $BannerSorgusu->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <tr height="350">
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
                <td width="10" valign="top">&nbsp;</td>
                <td width="705" valign="top">
                    <table width="705" border="0" cellpadding="0" cellspacing="0">
                        <tr height="35" valign="top">
                            <td style="text-align: left; font-size: 18px; font-weight: 600"><?php echo $urunSorgusuKaydi['UrunAdi']; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <form action="index.php?SK=91&ID=<?php echo $urunSorgusuKaydi['id']; ?>" method="POST">
                                    <table width="705" border="0" cellpadding="0" cellspacing="0">
                                        <tr height="45">
                                            <td width="30">
                                                <a href="<?php echo $SosyalLinkFacebook; ?>" target="_blank">
                                                    <img src="Resimler/Facebook24x24.png">
                                                </a>
                                            </td>
                                            <td width="30">
                                                <a href="<?php echo $SosyalLinkTwitter; ?>" target="_blank">
                                                    <img src="Resimler/Twitter24x24.png">
                                                </a></td>
                                            <td width="30">
                                                <?php if (isset($kullaniciId)) { ?>
                                                    <a href="index.php?SK=87&ID=<?php echo $urunSorgusuKaydi['id']; ?>">
                                                        <img src="Resimler/KalpKirmiziDaireliBeyaz24x24.png">
                                                    </a>
                                                <?php
                                                } else {
                                                    ?>
                                                    <p>&nbsp;</p>
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td width="10">&nbsp;</td>
                                            <td width="605">
                                                <input type="submit" value="SEPETE EKLE" class="SepeteEkleButonu">
                                            </td>
                                        </tr>
                                        <tr height="45">
                                            <td colspan="5">
                                                <table width="705" border="0" cellpadding="0" cellspacing="0">
                                                    <tr height="45">
                                                        <td width="500" align="left">
                                                            <select name="varyant" class="SelectAlanlari">
                                                                <option value="">Lütfen <?php echo $urunSorgusuKaydi['VaryantBasligi']; ?> Seçiniz</option>
                                                                <?php
                                                                $varyantSorgusu = $dbConnection->prepare("select * from urunvaryantlari where UrunId = ? and StokAdedi > 0 order by VaryantAdi asc ");
                                                                $varyantSorgusu->execute([
                                                                    $urunSorgusuKaydi['id']
                                                                ]);
                                                                $varyantSayisi = $varyantSorgusu->rowCount();
                                                                $varyantKayitlari = $varyantSorgusu->fetchAll(PDO::FETCH_ASSOC);
                                                                if ($varyantSayisi > 0) {
                                                                    foreach ($varyantKayitlari as $varyantlar) {
                                                                        ?>
                                                                        <option value="<?php echo donusumleriGeriDondur($varyantlar['id']); ?>"><?php echo donusumleriGeriDondur($varyantlar['VaryantAdi']); ?>
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td width="205" align="right" style="font-size: 24; color:black;font-weight: bold"><?php echo fiyatBicimlendir($urunFiyatiniHesapla); ?> TL</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <table width="705" border="0" cellpadding="0" cellspacing="0">
                                    <tr height="30">
                                        <td>
                                            <img src="Resimler/SaatEsnetikGri20x20.png" border="0">
                                        </td>
                                        <td>Siparişiniz <?php echo UcGunIleriTarihBul(); ?> tarihinde kargoya verilecektir.</td>
                                    </tr>
                                    <tr height="30">
                                        <td>
                                            <img src="Resimler/SaatHizCizgiliLacivert20x20.png" border="0">
                                        </td>
                                        <td>ilgili ürün süper hızlı gönderi kapsamındadır. Aynı gün teslimat yapılabilir. </td>
                                    </tr>
                                    <tr height="30">
                                        <td>
                                            <img src="Resimler/KrediKarti20x20.png" border="0">
                                        </td>
                                        <td>Tüm bankaların kredi kartları ile ödeme yapabilirsiniz. </td>
                                    </tr>
                                    <tr height="30">
                                        <td>
                                            <img src="Resimler/Banka20x20.png" border="0">
                                        </td>
                                        <td>Tüm bankalardan havale ya da eft yapabilirsiniz.</td>
                                    </tr>
                                    <tr height="35">
                                        <td colspan="2" style="color:white; background:#ff9900; font-weight: bold;">Ürün Açıklaması</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding:5px 0px;"><?php echo $urunSorgusuKaydi['UrunAciklamasi']; ?></td>
                                    </tr>
                                    <tr height="35">
                                        <td colspan="2" style="color:white; background:#ff9900; font-weight: bold;">Ürün Yorumları
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <div style="width:705px; max-width: 705px; height: 300px; max-height: 300px; overflow-y : scroll; padding:5px 0px; ">
                                                <table width="685" border="0" align="left" cellpadding="0" cellspacing="0">
                                                    <?php

                                                    $yorumlarSorgusu = $dbConnection->prepare("select * from yorumlar where UrunId = ? order by YorumTarihi desc");
                                                    $yorumlarSorgusu->execute([
                                                        $urunSorgusuKaydi['id']
                                                    ]);
                                                    $yorumSayisi = $yorumlarSorgusu->rowCount();
                                                    $yorumKayitlari = $yorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);
                                                    if ($yorumSayisi > 0) {
                                                        foreach ($yorumKayitlari as $yorumlar) {
                                                            $yorumPuani = $yorumlar['Puan'];

                                                            if ($yorumPuani == 1) {
                                                                $yorumPuanResmi = "YildizBirDolu.png";
                                                            } elseif ($yorumPuani == 2) {
                                                                $yorumPuanResmi = "YildizIkiDolu.png";
                                                            } elseif ($yorumPuani == 3) {
                                                                $yorumPuanResmi = "YildizUcDolu.png";
                                                            } elseif ($yorumPuani == 4) {
                                                                $yorumPuanResmi = "YildizDortDolu.png";
                                                            } else {
                                                                $yorumPuanResmi = "YildizBesDolu.png";
                                                            }

                                                            $yorumIcinUyeSorgusu = $dbConnection->prepare("select * from uyeler where id = ? limit 1");
                                                            $yorumIcinUyeSorgusu->execute([$yorumlar["UyeId"]]);
                                                            $uyeIsimSoyisim = $yorumIcinUyeSorgusu->fetch(PDO::FETCH_ASSOC);

                                                            ?>
                                                            <tr>
                                                                <td width="64"><img src="Resimler/<?php echo $yorumPuanResmi; ?>"></td>
                                                                <td width="10">&nbsp;</td>
                                                                <td width="451"><?php echo $uyeIsimSoyisim['IsimSoyisim']; ?></td>
                                                                <td width="10">&nbsp;</td>
                                                                <td align="right" width="150"><?php echo tarihBul($yorumlar['YorumTarihi']); ?></td>
                                                                <td width="10">&nbsp;</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="6" style="border-bottom: 1px dashed #ccc; padding-top:5px;"><?php echo $yorumlar['YorumMetni']; ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td width="10">Bu ürün için henüz yorum yapılmamış. </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <?php
    } else {
        header("Location:index.php");
        exit();
    }
} else {
    header("Location:index.php");
    exit();
}
?>