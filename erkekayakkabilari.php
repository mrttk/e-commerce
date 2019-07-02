<?php
if (isset($_GET['MenuID'])) {
    $gelenMenuId =  guvenlik($_GET['MenuID']);
} else {
    $gelenMenuId = "";
}
if ($gelenMenuId != "") { }
?>

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="100">
        <td align="left" width="250">
            <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <?php
                            $menulerSorgusu = $dbConnection->prepare("select * from menuler where UrunTuru = 'Erkek Ayakkabısı' order by MenuAdi asc");
                            $menulerSorgusu->execute();
                            $menuKayitSayisi = $menulerSorgusu->rowCount();
                            $menuKayitlari = $menulerSorgusu->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <tr height="50">
                                <td bgcolor="#f1f1f1"><b>MENÜLER</b></td>
                            </tr>
                            <?php
                            foreach ($menuKayitlari as $menu) {
                                ?>
                                <tr height="30">
                                    <td><a href="index.php?SK=84&MenuID=<?php echo $menu['id']; ?>" class="AyakkabiMenuleri" <?php if ($gelenMenuId == $menu['id']) { ?>style="color: #FF9900;" <?php } else { ?>style="color: #646464;" <?php } ?> "> <?php echo donusumleriGeriDondur($menu['MenuAdi']); ?> (<?php echo donusumleriGeriDondur($menu['UrunSayisi']); ?>)</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                    <td>&nbsp;</td>
                    <td>Banner</td>
                </tr>
            </table>
        </td>
        <td align=" left" width="11">&nbsp;</td>
                                <td align="left" width="795">Ürünler</td>
                            </tr>
                        </table>