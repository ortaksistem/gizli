<?php

$id = $_GET["id"];

if(!is_numeric($id)) die();

include("../ayarlar.php");

list($kullanici) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$id'"));

if(!$kullanici) die();

header("Content-type: text/xml\n\n");

echo '<?xml version="1.0" encoding="utf-8"?>';


echo '<photos>';

$result = mysql_query("select resim from "._MX."uye_resim where uye='$id'");

while(list($resim) = mysql_fetch_row($result)){

	echo '<photo desc="'._AD.' - '.$kullanici.'" url="'.$resim.'" />';
	
}

echo '</photos>';
?>