<?php
require_once "Ayarlar/settings.php";
require_once "Ayarlar/sitesayfalari.php";

$kayitTarihi = $kullanici["KayitTarihi"];
$kayitIpAdresi = $kullanici["KayitIpAdresi"];

if (isset($_SESSION["Kullanici"])) {
    ?>
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
        <tr>
            <td width="500" valign="top">
                <form action="index.php?SK=52" method="post">
                    <table width="500" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 20px; ">
                        <tr height="40">
                            <td style="color:#FF9900;"><h3>Hesabım ve Üyelik Bilgilerim</h3></td>
                        </tr>
                        <tr height="30">
                            <td valign="top" style="border-bottom: 1px dashed #CCC">Bilgilerinize aşağıdan
                                ulaşabilirsiniz.
                            </td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom">Email Adresi</td>
                        </tr>
                        <tr height="30">
                            <td valign="top"><input class="InputAlanlari" type="email" name="EmailAdresi"
                                                    value="<?php echo $emailAdresi; ?>">
                            </td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom">Şifre</td>
                        </tr>
                        <tr height="30">
                            <td valign="top"><input class="InputAlanlari" type="password" name="Sifre"
                                                    value="EskiSifre"></td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom">Şifre Tekrarı</td>
                        </tr>
                        <tr height="30">
                            <td valign="top"><input class="InputAlanlari" type="password"
                                                    name="SifreTekrar" value="EskiSifre"></td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom">İsim Soyisim</td>
                        </tr>
                        <tr height="30">
                            <td valign="top"><input class="InputAlanlari" type="text" name="IsımSoyisim"
                                                    value="<?php echo $isimSoyisim; ?>">
                            </td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom">Telefon Numarası</td>
                        </tr>
                        <tr height="30">
                            <td valign="top"><input class="InputAlanlari" type="text" name="TelefonNumarasi"
                                                    maxlength="10" value="<?php echo $telefonNumarasi; ?>">
                            </td>
                        </tr>
                        <tr height=" 30">
                            <td valign="bottom">Cinsiyet</td>
                        </tr>
                        <tr height="30">
                            <td valign="top">
                                <select name="Cinsiyet" class="SelectAlanlari">
                                    <option value="Erkek" <?php if ($cinsiyet == 'Erkek') { ?>
                                        selected="selected"<?php } ?>>Erkek
                                    </option>
                                    <option value="Kadın" <?php if ($cinsiyet == 'Kadın') { ?>
                                        selected="selected"<?php } ?>>Kadın</option>
                                </select>
                            </td>
                        </tr>
                        <tr height="5">
                            <td >&nbsp;</td>
                        </tr>
                        <tr height="30">
                            <td ><input class="YesilButon" type="submit" value="GÜNCELLE"></td>
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