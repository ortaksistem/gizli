<?php


include("ayarlar.php");

@mysql_query("update "._MX."uye set topresim='0'");


$result = mysql_query("select uye from "._MX."uye_resim where durum='1'");

$i = 1;

while(list($uye) = mysql_fetch_row($result)){

	
	@mysql_query("update "._MX."uye set topresim=topresim+1 where id='$uye'");
	
	$i++;

}

echo $i;

?>