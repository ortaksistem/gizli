<?php


include("ayarlar.php");

@mysql_query("update "._MX."uye set topmesaj='0'");


$result = mysql_query("select gonderilen from "._MX."uye_mesaj where durum='2'");

$i = 1;

while(list($uye) = mysql_fetch_row($result)){

	
	@mysql_query("update "._MX."uye set topmesaj=topmesaj+1 where id='$uye'");
	
	$i++;

}

echo $i;

?>