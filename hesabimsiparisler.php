<?php
require_once "Ayarlar/settings.php";
require_once "Ayarlar/functions.php";

if (isset($_SESSION["Kullanici"])) {
    $sayfalamaIcinSolveSagButonSayisi = 2;
    $sayfaBasinaGosterilecekKayitSayisi = 1;

    $toplamKayitSayisiSorgusu = $dbConnection->prepare("select distinct SiparisNumarasi from siparisler where UyeId = ?");
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
                        <td colspan="8" style="color:#FF9900;"><h3>Hesabım > Siparişlerim</h3></td>
                    </tr>
                    <tr height="40">
                        <td colspan="8" valign="top" style="border-bottom: 1px dashed #CCC">Sipariş bilgilerinize
                            buradan ulaşabilirsiniz.
                        </td>
                    </tr>
                    <tr height="50">
                        <td width="125">Sipariş Numarası</td>
                        <td width="75">Resim</td>
                        <td width="50">Yorum</td>
                        <td width="415">Adı</td>
                        <td width="100">Fiyatı</td>
                        <td width="50">Adedi</td>
                        <td width="100">Toplam Fiyat</td>
                        <td width="150">Kargo Durumu</td>
                    </tr>
                    <?php
                    $siparislerNumaralariSorgusu = $dbConnection->prepare("select distinct SiparisNumarasi from siparisler where UyeId = ? order by SiparisNumarasi desc limit $sayfalamayaBaslanacakKayitSayisi, $sayfaBasinaGosterilecekKayitSayisi");
                    $siparislerNumaralariSorgusu->execute([$kullaniciId]);
                    $siparisNumaralariSayisi = $siparislerNumaralariSorgusu->rowCount();
                    $siparisNumaralariKayitlari = $siparislerNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    if ($siparisNumaralariSayisi > 0) {
                        foreach ($siparisNumaralariKayitlari as $siparisNumaralariSatirlar) {
                            $siparisSorgusu = $dbConnection->prepare("select * from siparisler where UyeId = ? and SiparisNumarasi = ? order by id asc");
                            $siparisNo = donusumleriGeriDondur($siparisNumaralariSatirlar["SiparisNumarasi"]);
                            $siparisSorgusu->execute([$kullaniciId, $siparisNo]);
                            $siparisSorgusuKayitlari = $siparisSorgusu->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($siparisSorgusuKayitlari as $siparisSatirlar) {
                                $urunTuru = donusumleriGeriDondur($siparisSatirlar["UrunTuru"]);
                                if ($urunTuru == "Erkek Ayakkabısı") {
                                    $resimKlasoruAdi = "Erkek";
                                } elseif ($urunTuru == "Kadın Ayakkabısı") {
                                    $resimKlasoruAdi = "Kadin";
                                } else {
                                    $resimKlasoruAdi = "Cocuk";
                                }
                                $kargoDurumu = donusumleriGeriDondur($siparisSatirlar["KargoDurumu"]);
                                if ($kargoDurumu == 0) {
                                    $kargoDurumuYazdir = "Beklemede";
                                } else {
                                    $kargoDurumuYazdir = donusumleriGeriDondur($siparisSatirlar["KargoGonderiKodu"]);
                                }

                                ?>
                                <tr height="50">
                                    <td width="125"><?php echo donusumleriGeriDondur($siparisSatirlar["SiparisNumarasi"]); ?></td>
                                    <td width="75"><img height="60"
                                                        src="Resimler/UrunResimleri/<?php echo $resimKlasoruAdi; ?>/<?php echo donusumleriGeriDondur($siparisSatirlar["UrunResmiBir"]); ?>"/>
                                    </td>
                                    <td width="50">
                                        <a href="index.php?SK=75&UrunID=<?php echo donusumleriGeriDondur
                                        ($siparisSatirlar["UrunId"]); ?>">
                                            <img src="Resimler/DokumanKirmiziKalemli20x20.png" border="0"/>
                                        </a>
                                    </td>
                                    <td width="415"><?php echo donusumleriGeriDondur($siparisSatirlar["UrunAdi"]); ?></td>
                                    <td width="100"><?php echo donusumleriGeriDondur(fiyatBicimlendir
                                        ($siparisSatirlar["UrunFiyati"])); ?> TL
                                    </td>
                                    <td width="50"><?php echo donusumleriGeriDondur($siparisSatirlar["UrunAdedi"]); ?></td>
                                    <td width="100"><?php echo donusumleriGeriDondur(fiyatBicimlendir($siparisSatirlar["ToplamUrunFiyati"])); ?>
                                        TL
                                    </td>
                                    <td width="150"><?php echo $kargoDurumuYazdir; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr height="30">
                                <td colspan="8">
                                    <hr/>
                                </td>
                            </tr>
                            <?php
                            if ($bulunanSayfaSayisi > 1) {

                                ?>
                                <tr>
                                    <td colspan="8" align="left">

                                        <div class="SayfalamaAlaniKapsayicisi">
                                            <div class="SayfalamaAlaniIcinMetinAlaniKapsayicisi" align="center">
                                                <p>
                                                    Toplam <b><?php echo $bulunanSayfaSayisi; ?></b> sayfada,<b> <?php
                                                        echo $toplamKayitSayisi; ?></b> adet kayit bulunmaktadir.
                                                </p>
                                            </div>
                                            <div class="SayfalamaAlanıIcinNumaraAlaniKapsayicisi">
                                                <?php
                                                if ($sayfalama > 1) {
                                                    echo "<span class='SayfalamaPasif'> <a href='index.php?SK=61&SYF=1'> << </a></span>";
                                                    $safalamaIcinSayfaDegeriniBirGeriAL = $sayfalama - 1;
                                                    echo "<span class='SayfalamaPasif'><a href='index.php?SK=61&SYF=" .
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
                                                            echo "<span class='SayfalamaPasif'><a href='index.php?SK=61&SYF=" .
                                                                $sayfalamaIcinSayfaIndexDegeri . "'>
$sayfalamaIcinSayfaIndexDegeri</a></span>";
                                                        }

                                                    }
                                                }


                                                if ($sayfalama != $bulunanSayfaSayisi) {
                                                    $sayfalamaIcinSayfaDegeriniBirIleriAl = $sayfalama + 1;
                                                    echo "<span class='SayfalamaPasif'><a href='index.php?SK=61&SYF=" .
                                                        $sayfalamaIcinSayfaDegeriniBirIleriAl . "'> > </a></span>";
                                                    echo "<span class='SayfalamaPasif'><a href='index.php?SK=61&SYF=" . $bulunanSayfaSayisi . "'> >> </a></span>";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    } else { ?>
                        <tr>
                            <td colspan="8" align="left">Sisteme kayıtlı siparişiniz bulunmamaktadır.</td>
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