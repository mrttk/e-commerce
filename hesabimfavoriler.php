<?php
require_once "Ayarlar/settings.php";
require_once "Ayarlar/functions.php";

if (isset($_SESSION["Kullanici"])) {
    $sayfalamaIcinSolveSagButonSayisi = 2;
    $sayfaBasinaGosterilecekKayitSayisi = 1;

    $toplamKayitSayisiSorgusu = $dbConnection->prepare("select * from favoriler where UyeId = ? order by id desc");
    $toplamKayitSayisiSorgusu->execute([$kullaniciId]);
    $toplamKayitSayisi = $toplamKayitSayisiSorgusu->rowCount();
    $sayfalamayaBaslanacakKayitSayisi = ($sayfalama * $sayfaBasinaGosterilecekKayitSayisi) - $sayfaBasinaGosterilecekKayitSayisi;
    $bulunanSayfaSayisi = ceil($toplamKayitSayisi / $sayfaBasinaGosterilecekKayitSayisi);
    ?>
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="F9F9F9">
        <tr>
            <td>
                <hr />
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
                <hr />
            </td>
        </tr>
        <tr>
            <td width="1065" valign="top">
                <table width="1065" align="center" border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 20px; ">
                    <tr height="40">
                        <td colspan="4" style="color:#FF9900;">
                            <h3>Hesabım > Favoriler</h3>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="4" valign="top" style="border-bottom: 1px dashed #CCC">Favori ürünlerinize
                            buradan ulaşabilirsiniz.
                        </td>
                    </tr>
                    <tr height="50">
                        <td width="50">Resim</td>
                        <td width="865">Adı</td>
                        <td width="50">Fiyatı</td>
                        <td width="25">Sil</td>
                    </tr>
                    <?php
                    $favorilerSorgusu = $dbConnection->prepare("select * from favoriler where UyeId = ? order by id desc limit $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
                    $favorilerSorgusu->execute([$kullaniciId]);
                    $favoriSayisi = $favorilerSorgusu->rowCount();
                    $favoriKayitlari = $favorilerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    if ($favoriSayisi > 0) {
                        foreach ($favoriKayitlari as $favoriSatirlar) {

                            $urunlerSorgusu = $dbConnection->prepare("select * from urunler where id = ? limit 1");
                            $urunlerSorgusu->execute([$favoriSatirlar['UrunId']]);
                            $urunKaydi = $urunlerSorgusu->fetch(PDO::FETCH_ASSOC);

                            $urununAdi = $urunKaydi["UrunAdi"];
                            $urununTuru = $urunKaydi["UrunTuru"];
                            $urununFiyati = $urunKaydi["UrunFiyati"];
                            $urununParaBirimi = $urunKaydi["ParaBirimi"];
                            $urununResmi = $urunKaydi["UrunResmiBir"];


                            if ($urununTuru == "Erkek Ayakkabısı") {
                                $resimKlasoruAdi = "Erkek";
                            } elseif ($urununTuru == "Kadın Ayakkabısı") {
                                $resimKlasoruAdi = "Kadin";
                            } else {
                                $resimKlasoruAdi = "Cocuk";
                            }
                            ?>
                            <tr height="50">
                                <td width="75"><img height="60" src="Resimler/UrunResimleri/<?php echo donusumleriGeriDondur($resimKlasoruAdi); ?>/<?php echo donusumleriGeriDondur($urununResmi); ?>" />
                                </td>
                                <td width="800"><a href="index.php?SK=83&ID=<?php echo $urunKaydi["id"]; ?>"><?php echo donusumleriGeriDondur($urununAdi); ?></a></td>
                                <td width="100"><?php echo donusumleriGeriDondur(fiyatBicimlendir($urununFiyati)); ?> <?php echo donusumleriGeriDondur($urununParaBirimi); ?></td>
                                <td><a href="index.php?SK=80&ID=<?php echo $favoriSatirlar["id"]; ?>"><img src="Resimler/Sil20x20.png"></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr height="30">
                            <td colspan="4">
                                <hr />
                            </td>
                        </tr>
                        <?php
                        if ($bulunanSayfaSayisi > 1) {
                            ?>
                            <tr>
                                <td colspan="4" align="left">

                                    <div class="SayfalamaAlaniKapsayicisi">
                                        <div class="SayfalamaAlaniIcinMetinAlaniKapsayicisi" align="center">
                                            <p>Toplam <b><?php echo $bulunanSayfaSayisi; ?></b> sayfada,<b><?php echo $toplamKayitSayisi; ?></b> adet kayit bulunmaktadir.</p>
                                        </div>
                                        <div class="SayfalamaAlanıIcinNumaraAlaniKapsayicisi">
                                            <?php
                                            if ($sayfalama > 1) {
                                                echo "<span class='SayfalamaPasif'> <a href='index.php?SK=59&SYF=1'> << </a></span>";
                                                $safalamaIcinSayfaDegeriniBirGeriAL = $sayfalama - 1;
                                                echo "<span class='SayfalamaPasif'><a href='index.php?SK=59&SYF=" .
                                                    $safalamaIcinSayfaDegeriniBirGeriAL . "'> < </a></span>";
                                            }

                                            for (
                                                $sayfalamaIcinSayfaIndexDegeri = $sayfalama -
                                                    $sayfalamaIcinSolveSagButonSayisi;
                                                $sayfalamaIcinSayfaIndexDegeri <= $sayfalama +
                                                    $sayfalamaIcinSolveSagButonSayisi;
                                                $sayfalamaIcinSayfaIndexDegeri++
                                            ) {
                                                if (($sayfalamaIcinSayfaIndexDegeri > 0) and ($sayfalamaIcinSayfaIndexDegeri <= $bulunanSayfaSayisi)
                                                ) {
                                                    if ($sayfalama == $sayfalamaIcinSayfaIndexDegeri) {
                                                        echo "<span class='SayfalamaAktif'>$sayfalamaIcinSayfaIndexDegeri</span>";
                                                    } else {
                                                        echo "<span class='SayfalamaPasif'><a href='index.php?SK=59&SYF=" .
                                                            $sayfalamaIcinSayfaIndexDegeri . "'>
$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                                    }
                                                }
                                            }


                                            if ($sayfalama != $bulunanSayfaSayisi) {
                                                $sayfalamaIcinSayfaDegeriniBirIleriAl = $sayfalama + 1;
                                                echo "<span class='SayfalamaPasif'><a href='index.php?SK=59&SYF=" .
                                                    $sayfalamaIcinSayfaDegeriniBirIleriAl . "'> > </a></span>";
                                                echo "<span class='SayfalamaPasif'><a href='index.php?SK=59&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="4" align="left">Sisteme kayıtlı favori ürününüz bulunmamaktadır.</td>
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