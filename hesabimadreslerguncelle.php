<?php
include_once "Ayarlar/settings.php";
include_once "Ayarlar/functions.php";
if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])) {
        $gelenId = guvenlik($_GET["ID"]);
    } else {
        $gelenId = "";
    }
    if ($gelenId != "") {
        $adresSorgusu = $dbConnection->prepare("select * from adresler where id = ? and UyeId = ? limit 1");
        $adresSorgusu->execute([$gelenId, $kullaniciId]);
        $adresSayisi = $adresSorgusu->rowCount();
        $kayitBilgisi = $adresSorgusu->fetch();
        if ($adresSayisi > 0) {
            ?>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
                <tr>
                    <td width="1065" valign="top">
                        <form action="index.php?SK=63&ID=<?php echo $gelenId; ?>" method="post">
                            <table width="1065" align="center" border="0" cellspacing="0" cellpadding="0"
                                   style="margin-bottom: 20px; ">
                                <tr height="40">
                                    <td colspan="2" style="color:#FF9900;"><h3>Yeni Adres Ekle</h3></td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="top" style="border-bottom: 1px dashed #CCC">Adres ekleme
                                        işlemlerinizi buradan yapabilirsiniz.
                                    </td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="bottom">Ad Soyad</td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="top"><input class="InputAlanlari" type="text"
                                                                        name="AdiSoyadi"
                                                                        value="<?php echo $kayitBilgisi["AdiSoyadi"];
                                                                        ?>">
                                    </td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="bottom">Adres</td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="top"><input class="InputAlanlari" type="text" name="Adres"
                                                                        value="<?php echo $kayitBilgisi["Adres"]; ?>">
                                    </td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="bottom">İl</td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="top"><input class="InputAlanlari" type="text" name="Il"
                                                                        value="<?php echo $kayitBilgisi["Il"]; ?>">
                                    </td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="bottom">İlçe</td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="top"><input class="InputAlanlari" type="text" name="Ilce"
                                                                        value="<?php echo $kayitBilgisi["Ilce"]; ?>">
                                    </td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="bottom">Telefon Numarası</td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2" valign="top"><input class="InputAlanlari" type="text"
                                                                        name="TelefonNumarasi"
                                                                        maxlength="10"
                                                                        value="<?php echo $kayitBilgisi["TelefonNumarasi"]; ?>">
                                    </td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr height="30">
                                    <td colspan="2"><input class="YesilButon" type="submit" value="Adres Ekle"></td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </table>
            <?php

        } else {
            header("Location:index.php?SK=65");
            exit();
        }
    } else {
        header("Location:index.php?SK=65");
        exit();
    }
} else {
    header("Location:index.php?SK=0");
    exit();
}
?>