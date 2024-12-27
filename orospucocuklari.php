<?php


include("ayarlar.php");



$result = mysql_query("select id, kullanici from "._MX."uye where kgl=0 and bot=0 and seviye!=3");

$i = 0;
while(list($id, $kullanici) = mysql_fetch_row($result)){



	list($sayi1) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme where uye='$id'"));
	list($sayi2) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme2 where uye='$id'"));
	
	if($sayi1 < 1 and $sayi2 < 1){
	
		
		echo "<b>$kullanici</b> , ";
		
		$i++;
		
	}
	
	unset($sayi1);
	unset($sayi2);
	

}

echo "<p>$i adet piç bulundu</p>";

?>