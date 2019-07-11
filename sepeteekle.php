<?php

if (isset($_SESSION["Kullanici"])) {
    if (isset($_GET["ID"])) {
        $gelenID = guvenlik($_GET["ID"]);
    } else {
        $gelenID = "";
    }

    if (isset($_POST["varyant"])) {
        $gelenVaryantId = guvenlik($_POST["varyant"]);
    } else {
        $gelenVaryantId = "";
    }

    if ($gelenID != "" and $gelenVaryantId != "") {

                $sepetKontrolSorgusu = $dbConnection->prepare("select * from sepet where UyeId = ? order by id desc limit 1");
                $sepetKontrolSorgusu->execute([$kullaniciId]);
                $sepetSayisi = $sepetKontrolSorgusu->rowCount();
                $sepetKaydi = $sepetKontrolSorgusu->fetch(PDO::FETCH_ASSOC);

                if ($sepetSayisi > 0) {

                    $urunSepetKontrolSorgusu = $dbConnection->prepare("select * from sepet where UyeId = ? and UrunId = ? and VaryantId = ? limit 1");
                    $urunSepetKontrolSorgusu->execute([$kullaniciId, $gelenID, $gelenVaryantId]);
                    $urunSepetSayisi = $urunSepetKontrolSorgusu->rowCount();
                    $urunSepetKaydi = $urunSepetKontrolSorgusu->fetch(PDO::FETCH_ASSOC);

                    if ($urunSepetSayisi > 0) {

                        $sepetIdsi = $urunSepetKaydi['id'];
                        $urununSepettekiMevcutAdedi = $urunSepetKaydi['UrunAdedi'];
                        $urununYeniAdedi = $urununSepettekiMevcutAdedi + 1;

                        $urunSepetGuncellemeSorgusu = $dbConnection->prepare("update sepet set UrunAdedi = ? where id = ? and UyeId = ? and UrunId = ? limit 1");
                        $urunSepetGuncellemeSorgusu->execute([$urununYeniAdedi, $sepetIdsi, $kullaniciId, $gelenID]);
                        $urunGuncellemeSayisi = $urunSepetGuncellemeSorgusu->rowCount();

                        if ($urunGuncellemeSayisi > 0) {
                            header("Location:index.php?SK=94");
                            exit();
                        } else {
                            header("Location:index.php?SK=92");
                            exit();
                        }
                    } else {
                        $urunEklemeSorgusu = $dbConnection->prepare("insert into sepet (UyeId, UrunId, VaryantId, UrunAdedi) values (?,?,?,?)");
                        $urunEklemeSorgusu->execute([$kullaniciId, $gelenID, $gelenVaryantId, 1]);
                        $urunEklemeSayisi = $urunEklemeSorgusu->rowCount();
                        $sonIdDegeri = $dbConnection->lastInsertId();

                        if ($urunEklemeSayisi > 0) {
                            $siparisNumarasiGüncellemeSorgusu = $dbConnection->prepare("update sepet set SepetNumarasi = ? where UyeId = ?");
                            $siparisNumarasiGüncellemeSorgusu->execute([$sonIdDegeri, $kullaniciId]);
                            $siparisNumarasiGuncellemeSayisi = $siparisNumarasiGüncellemeSorgusu->rowCount();

                            if ($siparisNumarasiGuncellemeSayisi > 0) {
                                header("Location:index.php?SK=94");
                                exit();
                            } else {
                                header("Location:index.php?SK=92");
                                exit();
                            }
                        } else {
                            header("Location:index.php?SK=92");
                            exit();
                        }
                    }
                } else {

                    $urunEklemeSorgusu = $dbConnection->prepare("insert into sepet (UyeId, UrunId, VaryantId, UrunAdedi) values (?,?,?,?)");
                    $urunEklemeSorgusu->execute([$kullaniciId, $gelenID, $gelenVaryantId, 1]);
                    $urunEklemeSayisi = $urunEklemeSorgusu->rowCount();
                    $sonIdDegeri = $dbConnection->lastInsertId();

                    if ($urunEklemeSayisi > 0) {
                        $siparisNumarasiGüncellemeSorgusu = $dbConnection->prepare("update sepet set SepetNumarasi = ? where UyeId = ?");
                        $siparisNumarasiGüncellemeSorgusu->execute([$sonIdDegeri, $kullaniciId]);
                        $siparisNumarasiGuncellemeSayisi = $siparisNumarasiGüncellemeSorgusu->rowCount();

                        if ($siparisNumarasiGuncellemeSayisi > 0) {
                            header("Location:index.php?SK=94");
                            exit();
                        } else {
                            header("Location:index.php?SK=92");
                            exit();
                        }
                    } else {
                        header("Location:index.php?SK=92");
                        exit();
                    }
                }
    } else {
        header("Location:index.php");
        exit();
    }
} else {
    header("Location:index.php?SK=92");
    exit();
}
