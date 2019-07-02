<?php
if (isset($_REQUEST["MenuID"])) {
    $gelenMenuId        =    SayiliIcerikleriFiltrele(Guvenlik($_REQUEST["MenuID"]));
} else {
    $gelenMenuId        =    "";
}
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
                                <td><a href="index.php?SK=84" style="text-decoration: none; <?php if ($GelenMenuId == "") { ?>color: #FF9900;<? } else { ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;Tüm Ürünler (XXX)</a></td>
                            </tr>
                            <?php
                            $MenulerSorgusu        =    $dbConnection->prepare("SELECT * FROM menuler WHERE UrunTuru = 'Erkek Ayakkabısı' ORDER BY MenuAdi ASC");
                            $MenulerSorgusu->execute();
                            $MenuKayitSayisi    =    $MenulerSorgusu->rowCount();
                            $MenuKayitlari        =    $MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($MenuKayitlari as $Menu) {
                                ?>
                                <tr height="30">
                                    <td><a href="index.php?SK=84&MenuID=<?php echo $Menu["id"]; ?>" style="text-decoration: none; <?php if ($GelenMenuId == $Menu["id"]) { ?>color: #FF9900;<? } else { ?>color: #646464;<?php } ?> font-weight: bold;">&nbsp;<?php echo DonusumleriGeriDondur($Menu["MenuAdi"]); ?> (<?php echo DonusumleriGeriDondur($Menu["UrunSayisi"]); ?>)</a></td>
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
            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div class="AramaAlani">
                            <form action="index.php?SK=84" method="post">
                                <div class="AramaAlaniButonKapsamaAlani"> 
                                    <input type="submit" value="" class="AramaAlaniButonu">
                                </div>
                                <div class="AramaAlaniInputKapsamaAlani">
                                    <input type="text" name="Arama" class="AramaAlaniInputu">
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>
        </td>


    </tr>
</table>