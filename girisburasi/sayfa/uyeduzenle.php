<?php

	$islem = $_GET["islem"];
	
	$id = $_POST["id"];
	
	if($islem == "sil"){
		$result = mysql_query("update "._MX."uye set durum='6' where id='$id'");
		if($result) die("ok");
		else die("hata");
	}


	if($islem == "sil2"){
		$result = mysql_query("delete from "._MX."uye_arkadas where uye='$id' or arkadas='$id'");
		$result = mysql_query("delete from "._MX."uye_ay where uye='$id'");
		$result = mysql_query("delete from "._MX."uye_begeniler where uye='$id'");
		$result = mysql_query("delete from "._MX."uye_cicek where uye='$id' or gonderen='$id'");
		$result = mysql_query("delete from "._MX."uye_opucuk where uye='$id' or gonderen='$id'");
		$result = mysql_query("delete from "._MX."uye_hafta where uye='$id'");
		$result = mysql_query("delete from "._MX."uye_hit where uye='$id'");
		$result = mysql_query("delete from "._MX."uye_mesaj where gonderen='$id' or gonderilen='$id'");
		$result = mysql_query("delete from "._MX."uye_mesaj_giden where gonderen='$id' or gonderilen='$id'");
		$result = mysql_query("delete from "._MX."uye_oy where uye='$id'");
		$result = mysql_query("delete from "._MX."uye_yasakli where yasaklayan='$id' or yasakli='$id'");
		$result = mysql_query("delete from "._MX."uye where id='$id'");
		include("../smssifreleme.php");
		$id2 = smssifrele($id);
		$result = mysql_query("delete from "._MX."orospu where baban='$id2'");
		if($result) die("ok");
		else die("hata");
	}


	if($islem == "onayla"){
		$result = mysql_query("update "._MX."uye set durum='1' where id='$id'");
		if($result) die("ok");
		else die("hata");
	}
			
	if($islem == "duzenle"){
		
		// bos
		
	}

?>