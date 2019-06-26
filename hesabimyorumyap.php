<?php

if (isset($_SESSION["Kullanici"])) {
    ?>
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
        <tr>
            <td width="500" valign="top">
                <form action="index.php?SK=52" method="post">
                    <table width="500" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 20px; ">
                        <tr height="40">
                            <td style="color:#FF9900;"><h3>Hesabım > Yorum Yap</h3></td>
                        </tr>
                        <tr height="30">
                            <td valign="top" style="border-bottom: 1px dashed #CCC">Satın almış olduğunuz ürün ile
                                alakalı aşağıdan yorum yapabilirsiniz.
                            </td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom">Puanlama</td>
                        </tr>
                        <tr height="30">
                            <td valign="top"><input class="InputAlanlari" type="email" name="EmailAdresi"
                                                    value="<?php echo $emailAdresi; ?>">
                            </td>
                        </tr>
                        <tr height="5">
                            <td >&nbsp;</td>
                        </tr>
                        <tr height="30">
                            <td ><input class="YesilButon" type="submit" value="Yorumu Gönder"></td>
                        </tr>
                    </table>
                </form>
            </td>
            <td width="20">&nbsp;</td>
            <td width="545" valign="top">
                <table width="565" align="center" border="0" cellspacing="0" cellpadding="0" style="padding:0px 20px;
            text-align:justify;margin-bottom: 20px; ">
                    <tr height="40">
                        <td style="color: #FF9900;"><h3>Reklam</h3></td>
                    </tr>
                    <tr height="30">
                        <td style="border-bottom: 1px dashed #ccc;"><b>Extra Eğitim Reklamları</b>
                        </td>
                    </tr>
                    <tr height="5">
                        <td height="5"></td>
                    </tr>
                    <tr>
                        <td><img src="Resimler/MNGKargo156x30.png" style="margin-top: 5px;"></td>
                    </tr>
                    <tr>
                        <td>
                            Adres: Ayazağa Mah. Cendere Cad. 1B, Bulvar Ofis No:109/B, Kat: 3<br/> Sarıyer/
                            İSTANBUL<br/>
                        </td>
                    </tr>
                    <tr height="5">
                        <td height="5">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            Tel: (0212) 366 55 55 pbx<br/>
                            Çağrı Merkezi: 0850 222 06 06<br/>
                            Fax: (0212) 366 55 60<br/>
                            E-Mail: info@mngkargo.com.tr<br/>
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