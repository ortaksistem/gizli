<?php


if($_GET["olala"] != "123123") die("sie");

include("ayarlar.php");


$result = @mysql_query("select kullanici, dogum, tel, ad, soyad from mahir_uye where sehir='Kayseri' and cinsiyet='1' order by id desc");

while(list($kullanici, $dogum, $tel, $ad, $soyad) = @mysql_fetch_row($result)){
	$dogum = date("d.m.Y", $dogum);
if($tel != "-"){
	echo "$kullanici - $tel - $ad $soyad - $dogum <br />";
}
}

?>