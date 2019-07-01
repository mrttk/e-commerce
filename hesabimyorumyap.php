<?php
if (isset($_SESSION["Kullanici"])) {
    if(isset($_GET['UrunID'])){
        $gelenUrunID = guvenlik($_GET['UrunID']);
    } else{
        $gelenUrunID = "";
    }

    if ($gelenUrunID !=""){
    ?>
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
        <tr>
            <td width="500" valign="top">
                <form action="index.php?SK=76&UrunID=<?php echo $gelenUrunID; ?>" method="post">
                    <table width="500" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 20px; ">
                        <tr height="40">
                            <td style="color:#FF9900;"><h3>Hesabım > Yorum Yap</h3></td>
                        </tr>
                        <tr height="30">
                            <td valign="top" style="border-bottom: 1px dashed #CCC">Satın almış olduğunuz ürün ile
                                alakalı aşağıdan yorum yapabilirsiniz.
                            </td>
                        </tr>
                        <tr height="5">
                            <td >&nbsp;</td>
                        </tr>
                        <tr height="30">
                            <td valign="bottom">Puanlama</td>
                        </tr>
                        <tr height="30">
                            <td valign="top">
                            <table width="360" align="left" border="0" cellspadding="0" cellspacing="0" >
                                <tr>
                                    <td width="64"><img src="Resimler/YildizBirDolu.png"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><img src="Resimler/YildizIkiDolu.png"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><img src="Resimler/YildizUcDolu.png"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><img src="Resimler/YildizDortDolu.png"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><img src="Resimler/YildizBesDolu.png"></td>
                                    <td></td>
                                </tr>
                                <tr align="center">
                                    <td width="64"><input type="radio" name="Puan" value="1"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><input type="radio" name="Puan" value="2"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><input type="radio" name="Puan" value="3"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><input type="radio" name="Puan" value="4"></td>
                                    <td width="10">&nbsp;</td>
                                    <td width="64"><input type="radio" name="Puan" value="5"></td>
                                    <td></td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        <tr height="5">
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top">
                                <textarea  class="YorumIcınTextareaAlanlari" name="Yorum" id="yorum" cols="30" rows="10"></textarea>
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
    } 
    else {
        header("Location:index.php?SK=78");
        exit();
    }
}
else {
    header("Location:index.php");
    exit();
}
?>