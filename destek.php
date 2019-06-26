<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr height="100" bgcolor="#FF9900">
        <td style="color: white;"><h3>Sık Sorulan Sorular</h3></td>
    </tr>
    <tr>
        <td>
            <?php
            $soruSorgusu = $dbConnection->prepare("select * from sorular");
            $soruSorgusu->execute();
            $soruSayisi = $soruSorgusu->rowCount();
            $soruKayitlari = $soruSorgusu->fetchAll(PDO::FETCH_ASSOC);
            foreach ($soruKayitlari as $kayitlar) {
                ?>
                <div>
                    <div style="height: 50px;" id="<?php echo $kayitlar['id']; ?>" class="SorununBaslikAlani"
                         onclick="$.SoruIcerigiGoster(<?php echo $kayitlar['id']; ?>)">
                                <?php echo $kayitlar['soru']; ?>
                    </div>
                    <div class="SorununCevapAlani"><?php echo $kayitlar['cevap']; ?></div>
                </div>
            <?php } ?>
        </td>
    </tr>
</table>