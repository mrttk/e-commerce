<?php
/**
 * Created by PhpStorm.
 * User: emre.tetik
 * Date: 24.04.2019
 * Time: 15:31
 */
unset($_SESSION["Kullanici"]);
session_destroy();
ob_end_flush();
?>