<?php
include_once "Ayarlar/settings.php";
include_once "Ayarlar/functions.php";

if (isset($_POST["KargoTakipNosu"])) {
    $gelenKargoTakipNosu = SayiliIcerikleriFiltrele(guvenlik($_POST["KargoTakipNosu"]));
} else {
    $gelenKargoTakipNosu = "";
}

if ($gelenKargoTakipNosu != "") {
    header("Location:https://www.yurticikargo.com/tr/online-servisler/gonderi-sorgula?code=" . $gelenKargoTakipNosu);
} else {
    header("Location:index.php?SK=14");
}
exit();
?>