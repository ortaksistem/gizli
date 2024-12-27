<?php

$ulke = $_POST["ulke"];

if(!$ulke) die();

include("../ayarlar.php");
include("../fonksiyon.php");

$ulke = suz(turkce($ulke));

list($ulke) = mysql_fetch_row(mysql_query("select id from "._MX."ulkeler where adi like '%$ulke%'"));

if(!$ulke) $ulke = 214;

$result = mysql_query("select id, adi from "._MX."sehirler where ulke='$ulke' order by adi asc");

while(list($sid, $sadi) = mysql_fetch_row($result)){
    echo "<option value=\"".turkcejquery($sadi)."\">".turkcejquery($sadi)."</option>";
}
?>