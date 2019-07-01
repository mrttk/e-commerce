<?php
if (isset($_SESSION["Kullanici"])) {
    $sayfalamaIcinSolveSagButonSayisi = 2;
    $sayfaBasinaGosterilecekKayitSayisi = 10;

    $toplamKayitSayisiSorgusu = $dbConnection->prepare("select * from yorumlar where UyeId = ? order by YorumTarihi desc");
    $toplamKayitSayisiSorgusu->execute([$kullaniciId]);
    $toplamKayitSayisi = $toplamKayitSayisiSorgusu->rowCount();
    $sayfalamayaBaslanacakKayitSayisi = ($sayfalama * $sayfaBasinaGosterilecekKayitSayisi) - $sayfaBasinaGosterilecekKayitSayisi;
    $bulunanSayfaSayisi = ceil($toplamKayitSayisi / $sayfaBasinaGosterilecekKayitSayisi);
    ?>
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
        <tr>
            <td>
                <hr/>
            </td>
        </tr>
        <tr>
            <td>
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
            <td>
                <hr/>
            </td>
        </tr>
        <tr>
            <td width="1065" valign="top">
                <table width="1065" align="center" border="0" cellspacing="0" cellpadding="0"
                       style="margin-bottom: 20px; ">
                    <tr height="40">
                        <td colspan="3" style="color:#FF9900;"><h3>Hesabım > Yorumlar</h3></td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" valign="top" style="border-bottom: 1px dashed #CCC">Tüm yorumlarınızı bu alandan görüntüleyebilirsiniz.
                        </td>
                    </tr>
                    <?php
                    $yorumlar = $dbConnection->prepare("select * from yorumlar where UyeId = ? order by YorumTarihi desc limit $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
                    $yorumlar->execute([$kullaniciId]);
                    $yorumSayisi = $yorumlar->rowCount();
                    $yorumlarKayitlari = $yorumlar->fetchAll(PDO::FETCH_ASSOC);

                    if ($yorumSayisi > 0) {
                        ?>
                            <tr height="50">
                                <td width="50">Puan</td>
                                <td width="50">&nbsp;</td>
                                <td width="">Yorum</td>
                            </tr>
                    <?php
                        foreach ($yorumlarKayitlari as $satirlar) {
                            $verilenPuan = $satirlar["Puan"];
                            if ($verilenPuan==1) {
                                $resimDosyasi = "YildizBirDolu.png";
                            }
                            elseif ($verilenPuan==2) {
                                $resimDosyasi = "YildizIkiDolu.png";
                            }
                            elseif ($verilenPuan==3) {
                                $resimDosyasi = "YildizUcDolu.png";
                            }
                            elseif ($verilenPuan==4) {
                                $resimDosyasi = "YildizDortDolu.png";                           
                            }
                            else {
                                $resimDosyasi = "YildizBesDolu.png";                            
                            }
                                ?>
                                <tr>
                                    <td>
                                        <img src="Resimler/<?php echo $resimDosyasi; ?>">
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        <?php echo $satirlar["YorumMetni"]; ?>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            <tr height="30">
                                <td colspan="3">
                                    <hr/>
                                </td>
                            </tr>
                        <tr>
                        <?php
                            if ($bulunanSayfaSayisi > 1) {
                                ?>
                                <tr>
                                    <td colspan="3" text-align="left">

                                        <div class="SayfalamaAlaniKapsayicisi">
                                            <div class="SayfalamaAlaniIcinMetinAlaniKapsayicisi" text-align="center">
                                                <p>
                                                    Toplam <b><?php echo $bulunanSayfaSayisi; ?></b> sayfada,<b> <?php
                                                        echo $toplamKayitSayisi; ?></b> adet kayit bulunmaktadir.
                                                </p>
                                            </div>
                                            <div class="SayfalamaAlanıIcinNumaraAlaniKapsayicisi">
                                                <?php
                                                if ($sayfalama > 1) {
                                                    echo "<span class='SayfalamaPasif'> <a href='index.php?SK=60&SYF=1'> << </a></span>";
                                                    $safalamaIcinSayfaDegeriniBirGeriAL = $sayfalama - 1;
                                                    echo "<span class='SayfalamaPasif'><a href='index.php?SK=60&SYF=" .
                                                        $safalamaIcinSayfaDegeriniBirGeriAL . "'> < </a></span>";
                                                }

                                                for ($sayfalamaIcinSayfaIndexDegeri = $sayfalama -
                                                    $sayfalamaIcinSolveSagButonSayisi;
                                                     $sayfalamaIcinSayfaIndexDegeri <= $sayfalama +
                                                     $sayfalamaIcinSolveSagButonSayisi; $sayfalamaIcinSayfaIndexDegeri++) {
                                                    if (($sayfalamaIcinSayfaIndexDegeri > 0) and
                                                        ($sayfalamaIcinSayfaIndexDegeri <= $bulunanSayfaSayisi)) {
                                                        if ($sayfalama == $sayfalamaIcinSayfaIndexDegeri) {
                                                            echo "<span class='SayfalamaAktif'>$sayfalamaIcinSayfaIndexDegeri</span>";
                                                        } else {
                                                            echo "<span class='SayfalamaPasif'><a href='index.php?SK=60&SYF=" .
                                                                $sayfalamaIcinSayfaIndexDegeri . "'>
$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                                        }

                                                    }
                                                }
                                                if ($sayfalama != $bulunanSayfaSayisi) {
                                                    $sayfalamaIcinSayfaDegeriniBirIleriAl = $sayfalama + 1;
                                                    echo "<span class='SayfalamaPasif'><a href='index.php?SK=60&SYF=" .
                                                        $sayfalamaIcinSayfaDegeriniBirIleriAl . "'> > </a></span>";
                                                    echo "<span class='SayfalamaPasif'><a href='index.php?SK=60&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else { ?>
                            <tr>
                                <td colspan="3" text-align="left">&nbsp;</td>
                            </tr>
                        <tr>
                            <td colspan="3" style="padding-bottom:200px;" text-align="left">Sisteme kayıtlı siparişiniz bulunmamaktadır.</td>
                        </tr>
                    <?php } ?>
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