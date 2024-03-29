<?php
if (isset($_SESSION["Kullanici"])) {

    $stokIcinSepettekiUrunlerSorgusu = $dbConnection->prepare("select * from sepet where UyeId = ?");
    $stokIcinSepettekiUrunlerSorgusu->execute([$kullaniciId]);
    $stokIcinSepettekiUrunSayisi = $stokIcinSepettekiUrunlerSorgusu->rowCount();
    $stokIcinSepettekiKayitlar = $stokIcinSepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

    if ($stokIcinSepettekiUrunSayisi > 0) {

        foreach ($stokIcinSepettekiKayitlar as $stokIcinSepettekiSatirlar) {
            $stokIcinSepetIdsi = $stokIcinSepettekiSatirlar["id"];
            $stokIcinSepettekiUrununVaryantIdsi = $stokIcinSepettekiSatirlar["VaryantId"];
            $stokIcinSepettekiUrununAdedi = $stokIcinSepettekiSatirlar["UrunAdedi"];

            $stokIcinUrununVaryantBilgileriSorgusu = $dbConnection->prepare("select * from urunvaryantlari where id = ? limit 1");
            $stokIcinUrununVaryantBilgileriSorgusu->execute([$stokIcinSepettekiUrununVaryantIdsi]);
            $stokIcinVaryantKaydi = $stokIcinUrununVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
            $stokIcinUrununStokAdedi = $stokIcinVaryantKaydi["StokAdedi"];
            if ($stokIcinUrununStokAdedi == 0) {
                $sepetSilSorgusu = $dbConnection->prepare("delete from sepet where id = ? and UyeId = ? limit 1");
                $sepetSilSorgusu->execute([$stokIcinSepetIdsi, $kullaniciId]);
            } elseif ($stokIcinSepettekiUrununAdedi > $stokIcinUrununStokAdedi) {
                $sepetGuncellemeSorgusu = $dbConnection->prepare("update sepet set UrunAdedi = ? where id = ? and UyeId = ? limit 1");
                $sepetGuncellemeSorgusu->execute([$stokIcinUrununStokAdedi, $stokIcinSepetIdsi, $kullaniciId]);
            }
        }
    }
    ?>
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
        <tr>
            <td colspan="3">
                <hr />
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="UyelikBilgilerimMenu"><a href="index.php?SK=50">Üyelik Bilgilerim</a></td>
                        <td>&nbsp;</td>
                        <td class="UyelikBilgilerimMenu"><a href="index.php?SK=58">Adresler</a></td>
                        <td>&nbsp;</td>
                        <td class="UyelikBilgilerimMenu"><a href="index.php?SK=59">Favoriler</a></td>
                        <td>&nbsp;</td>
                        <td class="UyelikBilgilerimMenu"><a href="index.php?SK=60">Yorumlar</a></td>
                        <td>&nbsp;</td>
                        <td class="UyelikBilgilerimMenu"><a href="index.php?SK=61">Siparişler</a></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <hr />
            </td>
        </tr>
        <tr>
            <td width="750" valign="top">
                <table width="750" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr height="40">
                        <td style="color:#FF9900;">
                            <h3>Alışveriş Sepeti</h3>
                        </td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCC">Sepetinizdeki ürünlere buradan ulaşabilirsiniz.
                        </td>
                        <?php
                        $sepettekiUrunlerSorgusu = $dbConnection->prepare("select * from sepet where UyeId = ? order by id desc ");
                        $sepettekiUrunlerSorgusu->execute([$kullaniciId]);
                        $sepettekiUrunSayisi = $sepettekiUrunlerSorgusu->rowCount();
                        $sepettekiKayitlar = $sepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);
                        if ($sepettekiUrunSayisi > 0) {

                            $sepettekiToplamUrunSayisi = 0;
                            $sepettekiToplamFiyat = 0;

                            foreach ($sepettekiKayitlar as $sepetSatirlari) {
                                $sepetIdsi = $sepetSatirlari["id"];
                                $sepettekiUrununIdsi = $sepetSatirlari['UrunId'];
                                $urununVaryantIdsi = $sepetSatirlari['VaryantId'];
                                $sepettekiUrununAdedi = $sepetSatirlari['UrunAdedi'];

                                $urunBilgileriSorgusu = $dbConnection->prepare("select * from urunler where id = ? limit 1");
                                $urunBilgileriSorgusu->execute([$sepettekiUrununIdsi]);
                                $urunBilgisi = $urunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                                $urununTuru = $urunBilgisi['UrunTuru'];
                                $urununResmi = $urunBilgisi['UrunResmiBir'];
                                $urununAdi = $urunBilgisi['UrunAdi'];
                                $urununFiyati = $urunBilgisi['UrunFiyati'];
                                $urununParaBirimi = $urunBilgisi['ParaBirimi'];
                                $urununVaryantBasligi = $urunBilgisi['VaryantBasligi'];

                                $urunVaryantBilgileriSorgusu = $dbConnection->prepare("select * from urunvaryantlari where id = ? limit 1");
                                $urunVaryantBilgileriSorgusu->execute([$urununVaryantIdsi]);
                                $varyantBilgisi = $urunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                                $urununVaryantAdi = $varyantBilgisi['VaryantAdi'];
                                $urununStokAdedi = $varyantBilgisi['StokAdedi'];

                                if ($urununTuru == "Erkek Ayakkabısı") {
                                    $resimKlasoru = "Erkek";
                                } elseif ($urununTuru == "Kadın Ayakkabısı") {
                                    $resimKlasoru = "Kadin";
                                } else {
                                    $resimKlasoru = "Cocuk";
                                }

                                if ($urununParaBirimi == "EUR") {
                                    $urunFiyatiHesapla = $urununFiyati * $euroKuru * $sepettekiUrununAdedi;
                                    $urunFiyatiniBicimlendir = fiyatBicimlendir($urunFiyatiHesapla);
                                } elseif ($urununParaBirimi == "USD") {
                                    $urunFiyatiHesapla = $urununFiyati * $dolarKuru * $sepettekiUrununAdedi;
                                    $urunFiyatiniBicimlendir = fiyatBicimlendir($urunFiyatiHesapla);
                                } else {
                                    $urunFiyatiHesapla = $urununFiyati * $sepettekiUrununAdedi;
                                    $urunFiyatiniBicimlendir = fiyatBicimlendir($urunFiyatiHesapla);
                                }

                                $sepettekiToplamUrunSayisi += $sepettekiUrununAdedi;
                                $sepettekiToplamFiyat += $urunFiyatiHesapla;
                                ?>
                            <tr height="75">
                                <td align="left">
                                    <table width="750" align="center" border="0" cellspadding="0" cellspacing="0">
                                        <tr>
                                            <td style="border-bottom:1px dashed #ccc;" width="80">
                                                <img src="Resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo $urununResmi; ?>" border="0" width="60" height="80">
                                            </td>
                                            <td style="border-bottom:1px dashed #ccc;" width="40">
                                                <a href="index.php?SK=95&ID=<?php echo donusumleriGeriDondur($sepetIdsi) ?>"><img src="Resimler/SilDaireli20x20.png"></a>
                                            </td>
                                            <td style="border-bottom:1px dashed #ccc;" width="390">
                                                <?php echo donusumleriGeriDondur($urununAdi); ?>
                                                <?php echo donusumleriGeriDondur($urununVaryantBasligi); ?> :
                                                <?php echo donusumleriGeriDondur($urununVaryantAdi); ?>
                                            <td style="border-bottom:1px dashed #ccc;" width="120">
                                                <table width="90" align="center" border="0" cellspadding="0" cellspacing="0">
                                                    <tr>
                                                        <td width="30" align="center">
                                                            <?php if ($sepettekiUrununAdedi > 1) { ?>
                                                                <a href="index.php?SK=96&ID=<?php echo donusumleriGeriDondur($sepetIdsi) ?>">
                                                                    <img src="Resimler/AzaltDaireli20x20.png">
                                                                </a>
                                                            <?php } ?>
                                                        </td>
                                                        <td width="30" align="center"><?php echo donusumleriGeriDondur($sepettekiUrununAdedi); ?></td>
                                                        <td width="30" align="center">
                                                            <a href="index.php?SK=97&ID=<?php echo donusumleriGeriDondur($sepetIdsi) ?>">
                                                                <img src="Resimler/ArttirDaireli20x20.png">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td align="right" style="border-bottom:1px dashed #ccc;" width="120">
                                                <?php echo $urunFiyatiniBicimlendir; ?> TL
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr height="75">
                            <td align="left">Sepetinizde ürün bulunmuyor.</td>
                        </tr>
                    <?php } ?>
        </tr>
    </table>
    </td>
    <td width="15">&nbsp;</td>
    <td width="300" valign="top">
        <table width="300" align="center" border="0" cellspacing="0" cellpadding="0" style="padding:0px 20px;
                                                                                                                                                                                                    text-align:justify;margin-bottom: 20px; ">
            <tr height="40">
                <td style="color: #FF9900;" align="right">
                    <h3>Sipariş Özeti</h3>
                </td>
            </tr>
            <?php
            if (isset($sepettekiToplamUrunSayisi)) { ?>
                <tr height="30">
                    <td align="right" valign="top" style="border-bottom: 1px dashed #CCC">
                        Toplam <b> <?php echo $sepettekiToplamUrunSayisi; ?></b> adet ürün bulunmaktadır.
                    </td>
                </tr>
                <tr height="5">
                    <td>&nbsp;</td>
                </tr>
                <tr align="right">
                    <td>Ödenecek Toplam Tutar (KDV Dahil)</td>
                </tr>
                <tr align="right">
                    <td><?php echo fiyatBicimlendir($sepettekiToplamFiyat); ?></td>
                </tr>
                <tr height="5">
                    <td>&nbsp;</td>
                </tr>
                <tr align="center">
                    <td>
                        <div class="SepetIciDevamEt">
                            <a href="index.php?SK=98"><img src="Resimler/SepetBeyaz21x20.png"> DEVAM ET</a>
                        </div>
                    </td>
                </tr>
            <?php } else { ?>
                <tr height="30">
                    <td align="right" valign="top" style="border-bottom: 1px dashed #CCC">
                        Sepete ürün eklemeniz gerekmektedir.
                    </td>
                </tr>
            <?php } ?>
        </table>
    </td>
    </tr>
    </table>
<?php
} else {
    header("Location:index.php");
    exit();
}
?>