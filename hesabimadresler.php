<?php
require_once "Ayarlar/settings.php";

$kayitTarihi = $kullanici["KayitTarihi"];
$kayitIpAdresi = $kullanici["KayitIpAdresi"];

if (isset($_SESSION["Kullanici"])) {
    ?>
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
        <tr>
            <td>
                <hr/>
            </td>
        </tr>
        <tr>
            <td>
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
            <td>
                <hr/>
            </td>
        </tr>
        <tr>
            <td width="1065" valign="top">
                <table width="1065" align="center" border="0" cellspacing="0" cellpadding="0"
                       style="margin-bottom: 20px; ">
                    <tr height="40">
                        <td colspan="5" style="color:#FF9900;"><h3>Hesabım > Adres Bilgilerim</h3></td>
                    </tr>
                    <tr height="30">
                        <td colspan="5" valign="top" style="border-bottom: 1px dashed #CCC">Adres bilgilerinize
                            aşağıdan
                            ulaşabilir ya da güncelleyebilirsiniz.
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="5" class="UyelikBilgilerimMenu" style="background-color: #CCC;
                        padding: 5px
                        0;text-align: left;"><a href="index.php?SK=70">+ Adres
                                bilgisi ekle</a></td>
                    </tr>
                    <?php
                    $adreslerSorgusu = $dbConnection->prepare("select * from adresler where UyeId = ?");
                    $adreslerSorgusu->execute([$kullaniciId]);
                    $adresKayitlari = $adreslerSorgusu->fetchAll();
                    $adreslerSayisi = $adreslerSorgusu->rowCount();

                    $birinciRenk = "#FFFFFF";
                    $ikinciRenk = "#F1F1F1";
                    $renkSayisi = 1;
                    if ($adreslerSayisi > 0) {
                        foreach ($adresKayitlari as $adresler) {
                            if ($renkSayisi % 2) {
                                $arkaplanRengi = $birinciRenk;
                            } else {
                                $arkaplanRengi = $ikinciRenk;
                            }
                            $renkSayisi++;
                            ?>
                            <tr height="50" bgcolor="<?php echo $arkaplanRengi; ?>">
                                <td align="left">
                                    <b><?php echo $adresler["AdiSoyadi"]; ?></b> - <?php echo
                                    $adresler["Adres"]; ?> <?php echo $adresler["Ilce"]; ?>
                                    /<?php echo $adresler["Il"]; ?>
                                </td>
                                <td><img src="Resimler/Guncelleme20x20.png"></td>
                                <td><a href="index.php?SK=62&ID=<?php echo $adresler["id"]; ?>">Güncelle</a></td>
                                <td><img src="Resimler/Sil20x20.png"></td>
                                <td><a href="index.php?SK=67&ID=<?php echo $adresler["id"]; ?>">Sil</a></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5" align="left">Sisteme kayıtlı adresiniz bulunmamaktadır.</td>
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