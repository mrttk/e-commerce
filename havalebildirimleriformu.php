<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
    <tr>
        <td width="500" valign="top">
            <form action="index.php?SK=10" method="post">
                <table width="500" align="center" border="0" cellspacing="0" cellpadding="0"
                       style="margin-bottom: 20px; ">
                    <tr height="40">
                        <td style="color:#FF9900;"><h3>Havale Bildirimleri Formu</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCC">Tamamlanmış Olan Ödeme İşlemlerinizi
                            Aşağıdaki Formdan İletiniz.
                        </td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom">İsim Soyisim</td>
                    </tr>
                    <tr height="30">
                        <td valign="top"><input class="InputAlanlari" type="text" name="IsımSoyisim"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom">Email Adresi</td>
                    </tr>
                    <tr height="30">
                        <td valign="top"><input class="InputAlanlari" type="email" name="EmailAdresi"></td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom">Telefon Numarası</td>
                    </tr>
                    <tr height="30">
                        <td valign="top"><input class="InputAlanlari" type="text" name="TelefonNumarasi" maxlength="10">
                        </td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom">Ödeme Yapılan Banka</td>
                    </tr>
                    <tr height="30">
                        <td valign="top">
                            <select class="SelectAlanlari" name="BankaSecimi">
                                <option>Seçiniz</option>
                                <?php
                                $bankalarSorgusu = $dbConnection->prepare("select * from bankahesaplarimiz order by BankaAdi asc ");
                                $bankalarSorgusu->execute();
                                $bankaSayisi = $bankalarSorgusu->rowCount();
                                $bankaKayitlari = $bankalarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($bankaKayitlari as $bankalar) {


                                    ?>
                                    <option value="<?php echo $bankalar["id"]; ?>"><?php echo $bankalar["BankaAdi"];
                                        ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr height="30">
                        <td valign="bottom">Açıklama</td>
                    </tr>
                    <tr height="30">
                        <td valign="top">
                            <textarea class="TextareaAlanlari" name="Aciklama"></textarea>
                        </td>
                    </tr>
                    <tr height="30">
                        <td><input class="YesilButon" type="submit" value="Bildirimi Gönder" "></td>
                    </tr>
                </table>
            </form>
        </td>
        <td width="20">&nbsp;</td>
        <td width="545" valign="top">
            <table width="565" align="center" border="0" cellspacing="0" cellpadding="0" style="padding:0px 20px;
            text-align:justify;margin-bottom: 20px; ">
                <tr height="40">
                    <td scolspan="2" style="color: #FF9900;"><h3>İşleyiş</h3></td>
                </tr>
                <tr height="30">
                    <td colspan="2" style="border-bottom: 1px dashed #ccc;"><b>Havale / EFT İşlemlerinin
                            Kontrolü</b>
                    </td>
                </tr>
                <tr height="5">
                    <td colspan="2" height="5"></td>
                </tr>
                <tr height="30">
                    <td width="30"><img src="Resimler/Banka20x20.png" style="margin-top: 5px;"></td>
                    <td align="left" style="padding-left: 0px;"><b>Havale / EFT İşlemi</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2">
                        Müşteri tarafından banka hesapları arasında herhangi bir hesaba öncelikle ödeme işlemi
                        gerçekleştirilir.
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td width="30"><img src="Resimler/DokumanKirmiziKalemli20x20.png" style="margin-top: 5px;"></td>
                    <td align="left" style="padding-left: 0px;"><b>Bildirim İşlemi</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2">
                        Ödeme işlemini tamamladıktan sonra "Havale Bildirim Formu" sayfasından müşteri yapmış olduğu
                        ödeme için bilgisim formunu doldurarak gönderir.
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td width="30"><img src="Resimler/CarklarSiyah20x20.png" style="margin-top: 5px;"></td>
                    <td align="left" style="padding-left: 0px;"><b>Kontroller</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2">
                        Havele Bildirim formunuz tarafımıza ulaştıktan sonra ilgili departman tarafından incelenir.
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td width="30"><img src="Resimler/InsanlarSiyah20x20.png" style="margin-top: 5px;"></td>
                    <td align="left" style="padding-left: 0px;"><b>Onay / Red</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2">
                        Havale bildirimi geçerliyse yani hesaba ödeme geçmiş ise yönetici ödeme onayını vererek
                        siparişiniz teslimat birimine iletilir.
                    </td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr height="30">
                    <td width="30"><img src="Resimler/SaatEsnetikGri20x20.png" style="margin-top: 5px;"></td>
                    <td align="left" style="padding-left: 0px;"><b>Sipariş Hazırlama & Teslimat</b></td>
                </tr>
                <tr height="30">
                    <td colspan="2">
                        Yönetici ödeme onayından sonra sayfa üzerinden verilen sipariş en kısa sürede hazırlanarak
                        kargoya teslim edilir ve tarafınıza ulaştırılır.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>