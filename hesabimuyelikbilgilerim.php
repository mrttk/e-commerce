<?php
require_once "Ayarlar/settings.php";
require_once "Ayarlar/sitesayfalari.php";

$kayitTarihi = $kullanici["KayitTarihi"];
$kayitIpAdresi = $kullanici["KayitIpAdresi"];

if (isset($_SESSION["Kullanici"])) {
    ?>
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
        <tr>
            <td colspan="3">
                <hr/>
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
                <hr/>
            </td>
        </tr>
        <tr>
            <td width="500" valign="top">
                <table width="500" align="center" border="0" cellspacing="0" cellpadding="0"
                       style="margin-bottom: 20px; ">
                    <tr height="40">
                        <td style="color:#FF9900;"><h3>Hesabım ve Üyelik Bilgilerim</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCC">Bilgilerinize aşağıdan
                            ulaşabilirsiniz.
                        </td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom"><b>İsim Soyisim</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top"><?php echo $isimSoyisim; ?></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom"><b>Email Adresi</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top"><?php echo $emailAdresi; ?></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom"><b>Telefon Numarası</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top"><?php echo $telefonNumarasi; ?></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom"><b>Cinsiyet</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top"><?php echo $cinsiyet; ?></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom"><b>Durumu</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top"><?php if ($durumu == 1) echo "Aktif"; else echo "Pasif"; ?></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom"><b>Kayıt Tarihi</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top"><?php echo tarihBul($kayitTarihi); ?></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom"><b>Kayıt Ip Adresi</b></td>
                    </tr>
                    <tr height="30">
                        <td valign="top"><?php echo $kayitIpAdresi; ?></td>
                    </tr>
                    <tr height="30">
                        <td width="250"><a href="index.php?SK=51"><input type="submit" value="Üyelik Bilgilerimi Güncelle" class="YesilButon"></a></td>
                    </tr>
                </table>
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