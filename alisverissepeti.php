<?php

if (isset($_SESSION["Kullanici"])) {
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
                <table width="750" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 20px; ">
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
                                $urununParaBirimi = $urunBilgisi['ParaBirimi'];
                                $urununVaryantBasligi = $urunBilgisi['VaryantBasligi'];

                                $urunVaryantBilgileriSorgusu = $dbConnection->prepare("select * from urunvaryantlari where UrunId = ? limit 1");
                                $urunVaryantBilgileriSorgusu->execute([$sepettekiUrununIdsi]);
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

                                ?>
                            <tr height="75">
                                <td align="left">
                                    <table width="800" align="center" border="0" cellspadding="0" cellspacing="0">
                                        <tr>
                                            <td style="border-bottom:1px dashed #ccc;" width="80">
                                                <img src="Resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo $urununResmi; ?>" border="0" width="60" height="80">
                                            </td>
                                            <td style="border-bottom:1px dashed #ccc;" width="40">
                                                <a href="index.php?SK?95&ID=<?php echo donusumleriGeriDondur($sepetIdsi)?>"><img src="Resimler/SilDaireli20x20.png"></a>
                                            </td>
                                            <td style="border-bottom:1px dashed #ccc;" width="630">
                                                    <?php echo donusumleriGeriDondur($urununAdi);?>
                                                    <?php echo donusumleriGeriDondur($urununVaryantBasligi);?> :
                                                    <?php echo donusumleriGeriDondur($urununVaryantAdi);?>
                                            <td style="border-bottom:1px dashed #ccc;" width="50">
                                                Fiyat
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
                <td style="color: #FF9900;">
                    <h3>Alışveriş Özeti</h3>
                </td>
            </tr>
            <tr height="30">
                <td valign="top" style="border-bottom: 1px dashed #CCC"> Özet bilgilere aşağıdan
                    ulaşabilirsiniz.
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
?>