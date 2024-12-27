<?php

$tur = $_POST["tur"];

if(!$tur) die();


if($tur == "genelsatis"){
	
	for($i = 1; $i <= 12; $i++){
	
	
	}
?>
<img src="sayfa/grafik.php?data=3*3*10&label=a*v*c" />
<?

}

if($tur == "satisyil"){
	
	
	$data1 = NULL;
	$label1 = NULL;
	
	$toplam = 0;
	$toplam2 = 0;
	for($i = 2010; $i <= date("Y"); $i++){
		
		$tarih1 = @mktime(0,0,0, 1, 1, $i);
		$tarih2 = @mktime(0,0,0, 12, 31, $i);
		
		list($aktar, $tutar) = mysql_fetch_row(mysql_query("select count(id), sum(tutar) from "._MX."odeme where kayit < $tarih2 and kayit > $tarih1"));
		
		$data1 .= "$tutar*";
		$label1 .= urlencode("$i YIL - Tutar : $tutar TL - $aktar adet")."*";
		// echo "$i $aktar $tutar<br />";
		$toplam = $toplam + $tutar;
		$toplam2 = $toplam2 + $aktar;
		
	}
	
	$link1 = "data=".$data1."0&label=".$label1."Toplam : $toplam TL - $toplam2 adet satis";
	
?>
<img src="sayfa/grafik.php?<?=$link1?>" />
<?

}

if($tur == "satisay"){
	
	
	$data1 = NULL;
	$label1 = NULL;
	
	$toplam = 0;
	$toplam2 = 0;
	
	$yil = date("Y");
	
	
	for($i = 1; $i <= date("m"); $i++){
		
		$tarih1 = @mktime(0,0,0, $i, 1, $yil);
		$tarih2 = @mktime(0,0,0, $i, 31, $yil);
		
		list($aktar, $tutar) = mysql_fetch_row(mysql_query("select count(id), sum(tutar) from "._MX."odeme where kayit < $tarih2 and kayit > $tarih1"));
		
		$data1 .= "$tutar*";
		$ayadi = tarihay($i);
		$label1 .= urlencode("$ayadi AY - Tutar : $tutar TL - $aktar adet")."*";
		// echo "$i $aktar $tutar<br />";
		$toplam = $toplam + $tutar;
		$toplam2 = $toplam2 + $aktar;
		
	}
	
	$link1 = "data=".$data1."0&label=".$label1."Toplam : $toplam TL - $toplam2 adet satis";
	
?>
<img src="sayfa/grafik.php?<?=$link1?>" />
<?
}

if($tur == "satisgun"){
	
	
	$data1 = NULL;
	$label1 = NULL;
	
	$toplam = 0;
	$toplam2 = 0;
	
	$yil = date("Y");
	$ay = date("m");
	
	
	for($i = 1; $i <= date("d"); $i++){
		
		$tarih1 = @mktime(0,0,0, $i, $ay, $yil);
		$tarih2 = @mktime(23,59,59, $i, $ay, $yil);
		
		list($aktar, $tutar) = mysql_fetch_row(mysql_query("select count(id), sum(tutar) from "._MX."odeme where kayit < $tarih2 and kayit > $tarih1"));
		
		if(!$aktar) $aktar = 0;
		if(!$tutar) $tutar = 0;
		$data1 .= "$tutar*";
		$label1 .= urlencode("$i. Gun - Tutar : $tutar TL - $aktar adet")."*";
		// echo "$i $aktar $tutar<br />";
		$toplam = $toplam + $tutar;
		$toplam2 = $toplam2 + $aktar;
		
	}
	
	$link1 = "data=".$data1."0&label=".$label1."Toplam : $toplam TL - $toplam2 adet satis";
?>
<img src="sayfa/grafik.php?<?=$link1?>" />
<?
}
?>