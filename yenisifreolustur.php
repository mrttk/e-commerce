<?php
if (isset($_GET["AktivasyonKodu"])) {
    $gelenAktivasyonKodu = $_GET["AktivasyonKodu"];
} else {
    $gelenAktivasyonKodu = "";
}
if (isset($_GET["Email"])) {
    $gelenEmail = $_GET["Email"];
} else {
    $gelenEmail = "";
}

if (($gelenAktivasyonKodu != "") and ($gelenEmail != "")) {
    $kontrolSorgusu = $dbConnection->prepare("select * from uyeler where AktivasyonKodu=? and EmailAdresi=?");
    $kontrolSorgusu->execute([$gelenAktivasyonKodu, $gelenEmail]);
    $kontrolSayisi = $kontrolSorgusu->rowCount();
    $kullaniciKaydi = $kontrolSorgusu->fetch(PDO::FETCH_ASSOC);
    if ($kontrolSayisi > 0) {
        ?>
        <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
            <tr>
                <td width="500" valign="top">
                    <form action="index.php?SK=44&Email=<?php echo $gelenEmail; ?>&AktivasyonKodu=<?php echo
                    $gelenAktivasyonKodu; ?>"
                          method="post">
                        <table width="500" align="center" border="0" cellspacing="0" cellpadding="0"
                               style="margin-bottom: 20px; ">
                            <tr height="40">
                                <td colspan="2" style="color:#FF9900;"><h3>Şifre Sıfırlama</h3></td>
                            </tr>
                            <tr height="30">
                                <td colspan="2" valign="top" style="border-bottom: 1px dashed #CCC">Aşağıdan hesabına
                                    giriş
                                    şifrenizi değişitirebilirsiniz.
                                </td>
                            </tr>
                            <tr height="30">
                                <td colspan="2" valign="bottom">Şifre</td>
                            </tr>
                            <tr height="30">
                                <td colspan="2" valign="top"><input class="InputAlanlari" type="password" name="Sifre">
                                </td>
                            </tr>
                            <tr height="30">
                                <td colspan="2" valign="bottom">Şifre Tekrar</td>
                            </tr>
                            <tr height="30">
                                <td colspan="2" valign="top"><input class="InputAlanlari" type="password"
                                                                    name="SifreTekrar"></td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr height="30">
                                <td colspan="2"><input class="YesilButon" type="submit" value="Şifremi Güncelle"></td>
                            </tr>
                        </table>
                    </form>
                </td>
                <td width="20">&nbsp;</td>
                <td width="545" valign="top">
                    <table width="565" align="center" border="0" cellspacing="0" cellpadding="0" style="padding:0px 20px;
                text-align:justify;margin-bottom: 20px; ">
                        <tr height="40">
                            <td colspan="2" style="color: #FF9900;"><h3>Yeni Şifre Oluşturma</h3></td>
                        </tr>
                        <tr height="30">
                            <td colspan="2" style="border-bottom: 1px dashed #ccc;"><b>Çalışma ve İşleyiş Açıklaması</b>
                            </td>
                        </tr>
                        <tr height="5">
                            <td colspan="2" height="5"></td>
                        </tr>
                        <tr height="30">
                            <td width="30"><img src="Resimler/CarklarSiyah20x20.png" style="margin-top: 5px;"></td>
                            <td align="left" style="padding-left: 0px;">Bilgi Kontrolü</td>
                        </tr>
                        <tr height="30">
                            <td colspan="2">
                                Kullanıcının form alanına girmiş olduğu değer veya değerler veritabanımızda tam detaylı
                                olarak filtrelenerek kontrol edilir.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr height="30">
                            <td width="30"><img src="Resimler/CarklarSiyah20x20.png" style="margin-top: 5px;"></td>
                            <td align="left" style="padding-left: 0px;">Email Gönderimi & İçerik</td>
                        </tr>
                        <tr height="30">
                            <td colspan="2">
                                Bilgi kontrolü başarılı olursa kullanıcının veritabanımızda kayıtlı olan email adresine
                                yeni
                                sifre oluşturma içerikli bir mail gönderilir.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr height="30">
                            <td width="30"><img src="Resimler/CarklarSiyah20x20.png" style="margin-top: 5px;"></td>
                            <td align="left" style="padding-left: 0px;">Şifre Sıfırlama ve Oluşturma</td>
                        </tr>
                        <tr height="30">
                            <td colspan="2">
                                Kullanıcı kendisine iletilen mail içerisindeki yeni şifre oluştur metnine tıklayacak
                                olursa
                                site yeni şifre oluşturma sayfası açılır ve kullanıcıdan yeni hesap şifresini
                                oluşturması
                                istenir.
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr height="30">
                            <td width="30"><img src="Resimler/CarklarSiyah20x20.png" style="margin-top: 5px;"></td>
                            <td align="left" style="padding-left: 0px;">Sonuç</b></td>
                        </tr>
                        <tr height="30">
                            <td colspan="2">
                                Kullanıcı yeni oluşturmuş olduğu hesap şifresi ile giriş yapabilir.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <?php
    } else {
        header("Location:index.php?SK=0");
        exit();
    }
} else {
    header("Location:index.php?SK=0");
    exit();
}
?>