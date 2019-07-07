<?php

if (isset($_GET["ID"])) {
    $gelenId        =    SayiliIcerikleriFiltrele(guvenlik($_REQUEST["ID"]));

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
                                        <td width="108">
                                            <img src="Resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo $urunSorgusuKaydi['UrunResmiIki'] ?>" width="108" height="144" style="border:1px solid #ccc;" onClick="$.UrunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo $urunSorgusuKaydi["UrunResmiIki"]; ?>');">
                                        </td>
                                        <td width="10">&nbsp;</td>
                                        <td width="108"><img src="Resimler/UrunResimleri/<?php echo $resimKlasoru; ?>/<?php echo $urunSorgusuKaydi['UrunResmiUc'] ?>" width="108" height="144" style="border:1px solid #ccc;" onClick="$.UrunDetayResmiDegistir('<?php echo $resimKlasoru; ?>', '<?php echo $urunSorgusuKaydi["UrunResmiUc"]; ?>');"></td>
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