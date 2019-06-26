<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
    <tr height="100" bgcolor="#FF9900">
        <td style="color: white;"><h3>Banka Hesaplarımız</h3></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Ödemeleriniz için çalışmakta olduğumuz tüm banka bilgileri aşağıdadır.</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <?php
                    $bankalarSorgusu = $dbConnection->prepare("select * from bankahesaplarimiz");
                    $bankalarSorgusu->execute();
                    $bankaSayisi = $bankalarSorgusu->rowCount();
                    $bankaKayitlari = $bankalarSorgusu->fetchAll(PDO::FETCH_ASSOC);
                    $donguSayisi = 1;
                    $sutunSayisiAdedi = 3;

                    foreach ($bankaKayitlari

                    as $kayit) {
                    ?>
                    <td width="340">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid
                        #ccc; margin-bottom: 20px;">
                            <!--
                            <tr height="40">
                                <td colspan="4" align="center"><img src="Resimler/CardFinans78x12.png"></td>
                            </tr>
                            -->
                            <tr height="25">
                                <td width="5">&nbsp;</td>
                                <td width="80">Banka Adı</td>
                                <td width="10">:</td>
                                <td width="245"><?php echo $kayit["BankaAdi"]; ?></td>
                            </tr>
                            <tr height="25">
                                <td width="5">&nbsp;</td>
                                <td width="80">Konum</td>
                                <td width="10">:</td>
                                <td width="245"><?php echo $kayit["KonumSehir"]; ?>/<?php echo $kayit["KonumUlke"]; ?></td>
                            </tr>
                            <tr height="25">
                                <td width="5">&nbsp;</td>
                                <td width="80">Şube</td>
                                <td width="10">:</td>
                                <td width="245"><?php echo $kayit["SubeAdi"]; ?>/<?php echo $kayit["SubeKodu"]; ?></td>
                            </tr>
                            <tr height="25">
                                <td width="5">&nbsp;</td>
                                <td width="80">Birim</td>
                                <td width="10">:</td>
                                <td width="245"><?php echo $kayit["ParaBirimi"]; ?></td>
                            </tr>
                            <tr height="25">
                                <td width="5">&nbsp;</td>
                                <td width="100">Hesap Sahibi</td>
                                <td width="10">:</td>
                                <td width="225"><?php echo $kayit["HesapSahibi"]; ?></td>
                            </tr>
                            <tr height="25">
                                <td width="5">&nbsp;</td>
                                <td width="80">IBAN</td>
                                <td width="10">:</td>
                                <td width="245"><?php echo $kayit["IbanNumarası"]; ?></td>
                            </tr>
                        </table>
                    </td>
                    <?php
                    if ($donguSayisi < $sutunSayisiAdedi) {
                        ?>
                        <td width="20px">&nbsp;</td>
                        <?php
                        $donguSayisi++;
                    } else {
                    ?>
                </tr>
                <tr>
                    <?php
                    $donguSayisi = 1;
                    }
                    }
                    ?>
            </table>
        </td>
    </tr>
</table>