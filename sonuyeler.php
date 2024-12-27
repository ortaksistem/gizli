<?php

include("ayarlar.php");



$zaman = time();

$cikar = 60 * 60 * 24 * 31 * 3;

$kalan = $zaman - $cikar;


list($adet) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where sononline > $kalan"));


echo $adet;

?>