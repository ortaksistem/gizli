<?php

ini_set("max_execution_time",0);

$islem = $_GET["islem"];

if($islem == "bul"){

	$where = NULL;
	
	$cinsiyet = $_POST["cinsiyet"];
	
	if($cinsiyet != "hepsi") {
	
	$where = "cinsiyet='".$cinsiyet."'";
	
	}	

	$yas1 = $_POST["yas1"];
	$yas2 = $_POST["yas2"];
	
	$baslangicyas = @mktime(0,0,0, date("m"), date("d"), date("Y")-$yas2);
	$bitisyas = @mktime(0,0,0, date("m"), date("d"), date("Y")-$yas1);

	if($where){
		$where = $where ." and dogum > $baslangicyas and dogum < $bitisyas";
	}
	else {
		$where = "dogum > $baslangicyas and dogum < $bitisyas";
	}
	
	$seviye = $_POST["seviye"];
	
	if($seviye != "hepsi"){
		$where = $where ." and seviye='$seviye'";
	}
	
	$k1 = $_POST["k1"];
	$k2 = $_POST["k2"];
	$k3 = $_POST["k3"];
	$k4 = $_POST["k4"];
	$k5 = $_POST["k5"];
	$k6 = $_POST["k6"];
	
	$baslangickayit = @mktime(0,0,0, $k2, $k1, $k3);
	$bitiskayit = @mktime(23,59,59, $k5, $k4, $k6);
	
	$where = $where . " and kayit < $bitiskayit and kayit > $baslangickayit";
	
	$ulke = turkce($_POST["ulke"]);
	
	if($ulke != "hepsi"){
		$where = $where ." and ulke='$ulke'";
	}
	
	$sehir = turkce($_POST["sehir"]);
	
	
	if($sehir != "hepsi"){
		$where = $where ." and sehir='$sehir'";
	}	
	
	
	$aradigi = turkce($_POST["aradigi"]);
	
	if($aradigi != "hepsi"){
		$where = $where ." and aracinsiyet like '%$aradigi%'";
	}

	$iliski = turkce($_POST["iliski"]);
	
	if($iliski != "hepsi"){
		$where = $where ." and iliski like '%$iliski%'";
	}

	$medeni = turkce($_POST["medeni"]);
	
	if($medeni != "hepsi"){
		$where = $where ." and medenidurum like '%$medeni%'";
	}

	$kiminle = turkce($_POST["kiminle"]);
	
	if($kiminle != "hepsi"){
		$where = $where ." and kiminle like '%$kiminle%'";
	}
	
	$aktif = $_POST["aktif"];
	
	/*
	if($aktif != "hepsi"){
		if($aktif == 1) $where = $where ." and durum='1'";
		else $where = $where ." and durum!='1'";
	}
	*/
	
	$where = $where ." and durum='1'";
	
	$tanitim = $_POST["tanitim"];
	
	if($tanitim != "hepsi"){
		if($tanitim == 1) $where = $where ." and tanitimonay='1'";
		else $where = $where ." and tanitimonay!='1'";
	}
	
	$webcam = $_POST["webcam"];
	
	if($webcam == 1) $where = $where ." and webcam='Evet'";

	$webcamsohbet = $_POST["webcamsohbet"];
	
	if($webcamsohbet == 1) $where = $where ." and webcamsohbet='Evet'";
	
	$dbegeni = $_POST["dbegeni"];
	
	if($dbegeni == 1) $where = $where ." and begeniler!=''";

	$dhobi = $_POST["dhobi"];
	
	if($dhobi == 1) $where = $where ." and hobiler!=''";

	$dfilm = $_POST["dfilm"];
	
	if($dfilm == 1) $where = $where ." and filmler!=''";
	
	$dtip = $_POST["dtip"];
	
	if($dtip == 1) $where = $where ." and tipler!=''";

	$dtanim = $_POST["dtanim"];
	
	if($dtanim == 1) $where = $where ." and tanitim!=''";	

	$dtanimonay = $_POST["dtanimonay"];
	
	if($dtanimonay == 1) $where = $where ." and tanitimonay='1'";
	
	// referanson


	$referanson = $_POST["referanson"];
	
	// if($referanson == 1) $where = $where ." and ref NOT LIKE '%yatak%'";
	
	
	if($_POST["resim"] == 1) $where = $where ." and topresim >= 1";
	
	if($_POST["galeri"] == 1) $where = $where ." and topgaleri >= 1";
	
	
	$online = $_POST["online"];
	
	
	
	if($where) $where = " where ". $where;
	
	
	$result = mysql_query("select id from "._MX."uye".$where."");
	
	$uyeler = array();
	
	$i = 1;
	
	$eskigold = $_POST["eskigold"];
	
	
	if($eskigold == 1){
	
	while(list($id) = mysql_fetch_row($result)){
		
		list($warmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme where uye='$id'"));
		
		if($warmi < 1){
		
			
			@mysql_query("insert into "._MX."uye_mail_sira values(NULL, '$id')");
			
			$data .= $id.";";
			
			
			$i++;
			
			
		
		}
	
	
	}
	
	}
	
	else {

		while(list($id) = mysql_fetch_row($result)){
			
			@mysql_query("insert into "._MX."uye_mail_sira values(NULL, '$id')");

			
			$data .= $id.";";
			
			
			$i++;
		
			
		}
		
	
	
	}

	if($i < 2) die("hata1");
	
	?>
	<form action="index.php?sayfa=botgonder" method="post">
	
	<input type="hidden" name="uyeler" id="uyeler" value="<?=$data?>">

				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2"><?=turkcejquery("Bot Mesajý Gönder");?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Toplam Bulunan Uye</strong></td>
						<td class="last">
						<b><?=$i-1;?></b> adet uye bulundu. <a href="javascript:void(0)" onclick="istatistikekle()"><b>istatistik Ekle</b></a> <span id="istatistiksonuc"></span>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Bot</strong></td>
						<td class="last">
						<select name="bot" id="bot" class="text">
						<?php
							$result = mysql_query("select id, kullanici, cinsiyet from "._MX."uye where bot='1'");
							
							while(list($id, $kullanici, $cinsiyet) = mysql_Fetch_row($result)){
							$cinsiyet = turkcejquery(cinsiyet($cinsiyet, NULL));
							$kullanici = turkcejquery($kullanici);
						?>
						
							<option value="<?=$id?>"><?=$kullanici?> (<?=$cinsiyet?>)</option>
							
						<?
							}
						?>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Bot islemi</strong></td>
						<td class="last">
						<p><input type="checkbox" name="oy" id="oy" value="1" /> Oy versin</p>
						<p><input type="checkbox" name="hit" id="hit" value="1" /> <?=turkcejquery("Profiline baksýn");?></p>
						<p><input type="checkbox" name="arkadas" id="arkadas" value="1" /> <?=turkcejquery("Arkadaþ olarak eklesin");?></p>
						<p><input type="checkbox" name="cicek" id="cicek" value="1" /> <?=turkcejquery("Çiçek göndersin");?></p>
						<p><input type="checkbox" name="opucuk" id="opucuk" value="1" /> <?=turkcejquery("Öpücük göndersin");?></p>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Bot Mesaji</strong></td>
						<td class="last">
							<table>
								<tr>
									<td>Konu</td><td widht="1">:</td><td style="text-align:left"><input type="text" name="baslik" id="baslik" class="text"></td>
								</tr>
								<tr>
									<td>Mesaj</td><td widht="1">:</td><td style="text-align:left"><textarea name="mesaj" id="mesaj" rows="6" cols="45" class="text"></textarea>
									<p>[KADI] = Kullanici adini yazdirir<br>
									[ADI] = Kullanicinin gercek adini yazdirir<br>
									[SOYADI] = Kullanicinin gercek soyadini yazdirir<br>
									[CINSIYET] = Kullanicinin cinsiyetini yazdirir.<br>
									[ULKE] = Kullanicinin ulkesini yazdirir.<br>
									[SEHIR] = Kullanicinin sehrini yazdirir<br>
									[YAS] = Kullanicinin yasini yazdirir<br>
									[KILO] = Kullanicinin kilosunu yazdirir<br>
									[BOY] = Kullanicinin kilosunu yazdirir<br>
									[BEGENI] = Kullanicinin begenilerini yazdirir<br>
									[FILM] = Kullanicinin filmlerini yazdirir<br>
									[TIP] = Kullanicinin sevdigi tipleri yazdirir<br>
									[HOBI] = Kullanicinin hobilerini yazdirir<br>
									[TANITIM] = Kullanicinin profil tanitim yazisini yazdirir<br>
									</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Email</strong></td>
						<td class="last">
						<select name="email" id="email" class="text">
							<option value="hayir">Email gonderme</option>
							<option value="1">Sunucu tarafli email gonder</option>
							<option value="2">SMTP email gonder</option>
							<option value="3">Uzak Smtp MahiriX'den Gönder</option>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong><?=turkcejquery("Gönderim Hýzý"); ?></strong></td>
						<td class="last">
						<input type="text" name="hiz" id="hiz" value="100" class="text" style="width:50px"> * ideal 100 tanedir
						</td>
					</tr>	
					<tr>
						<td class="first" width="172">&nbsp;</td>
						<td class="last">
						<input type="submit" value=" <?=turkcejquery("Ýþlemi baþlat"); ?> " onclick="return confirm('Gonderim baslatilsin mi?');">
						<input type="hidden" name="toplam" id="toplam" value="<?=$i-1?>">
						</td>
					</tr>	
				</table>
		</form>
	<?
}
else if($islem == "temizle"){

	@mysql_query("TRUNCATE TABLE "._MX."uye_mailist");
	
	
	die("ok");
	
}
else if($islem == "temizle2"){

	
	@mysql_query("TRUNCATE TABLE "._MX."uye_mail_sira");
	
	die("ok");
	
}
else if($islem == "istatistikekle"){
	
	@mysql_query("TRUNCATE TABLE "._MX."istatistik2");

	$veri = $_POST["uyeler"];
	
	if($veri){
		$zaman = @mktime();
		
		@mysql_query("insert into "._MX."istatistik2 values('$veri', '1', '$zaman')");
		
		die("ok");
	}
	else {
		die("hata");
	}
}
else {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Bot Mesajý Gönder | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
	function sehirgetir(ulke){
	
		$("#sehirgetir").html("<font color=red size=2><b>Bekleyin</b></font>");
				
				jQuery.ajax({
					type : 'POST',
					url : '../inc/sehiryukle2.php',
					data : "ulke="+ulke,
					success: function(sonuc){		
						$("#sehirgetir").html(sonuc);	
					}
				})
	}

	function temizle(){
	
		$("#sonuc").html("<img src='img/loading.gif' /> Bekleyin...");
				
		jQuery.ajax({
			
			type: 'POST',
			url: 'index.php?sayfa=bot&islem=temizle',
			data: "temizle=mahirix",
			success: function(sonuc){
				if(sonuc == "ok"){
					$("#sonuc").html("<font color=green>Temizlendi</font>");
				}
				else {
					$("#sonuc").html("<font color=red>Sitem hatasý.</font>");
				}
			}
			
		})
	}

	function temizle2(){
	
		$("#sonuc").html("<img src='img/loading.gif' /> Bekleyin...");
				
		jQuery.ajax({
			
			type: 'POST',
			url: 'index.php?sayfa=bot&islem=temizle2',
			data: "temizle=mahirix",
			success: function(sonuc){
				if(sonuc == "ok"){
					$("#sonuc").html("<font color=green>Temizlendi</font>");
				}
				else {
					$("#sonuc").html("<font color=red>Sitem hatasý.</font>");
				}
			}
			
		})
	}
	
	function baslat(){
	
		var cinsiyet = $("#cinsiyet").val();
		var yas1 = $("#yas1").val();
		var yas2 = $("#yas2").val();
		var seviye = $("#seviye").val();
		var k1 = $("#k1").val();
		var k2 = $("#k2").val();
		var k3 = $("#k3").val();
		var k4 = $("#k4").val();
		var k5 = $("#k5").val();
		var k6 = $("#k6").val();
		var ulke = $("#ulke").val();
		var sehir = $("#sehir").val();
		var aradigi = $("#aradigi").val();
		var iliski = $("#iliski").val();
		var medeni = $("#medeni").val();
		var kiminle = $("#kiminle").val();
		var aktif = $("#aktif").val();
		var tanitim = $("#tanitim").val();
		var webcam = $("#webcam").val();
		var webcamsohbet = $("#webcamsohbet").val();
		var online = $("#online:checked").val();
		var resim = $("#resim:checked").val();
		var galeri = $("#galeri:checked").val();
		var eskigold = $("#eskigold:checked").val();
		var dbegeni = $("#dbegeni:checked").val();
		var dhobi = $("#dhobi:checked").val();
		var dfilm = $("#dfilm:checked").val();
		var dtip = $("#dtip:checked").val();
		var dtanim = $("#dtanim:checked").val();
		var dtanimonay = $("#dtanimonay:checked").val();
		var referanson = $("#referanson:checked").val();

		$("#sonuc").html("<img src='img/loading.gif' /> Bekleyin...");
		
		jQuery.ajax({
			
			type: 'POST',
			url: 'index.php?sayfa=bot&islem=bul',
			data: "cinsiyet="+cinsiyet+"&yas1="+yas1+"&yas2="+yas2+"&seviye="+seviye+"&k1="+k1+"&k2="+k2+"&k3="+k3+"&k4="+k4+"&k5="+k5+"&k6="+k6+"&ulke="+ulke+"&sehir="+sehir+"&aradigi="+aradigi+"&iliski="+iliski+"&medeni="+medeni+"&kiminle="+kiminle+"&aktif="+aktif+"&webcam="+webcam+"&webcamsohbet="+webcamsohbet+"&online="+online+"&resim="+resim+"&galeri="+galeri+"&tanitim="+tanitim+"&eskigold="+eskigold+"&dbegeni="+dbegeni+"&dhobi="+dhobi+"&dfilm="+dfilm+"&dtip="+dtip+"&dtanim="+dtanim+"&dtanimonay="+dtanimonay+"&referanson="+referanson,
			success: function(sonuc){
				if(sonuc == "hata1"){
					$("#sonuc").html("");
					alert("Aradýðýnýz kriterlere uygun üye bulunamamýþtýr");
				}
				else {
					$("#anasonuc").html(sonuc);
				}
			}
			
		})
		
	}

	function istatistikekle(){
	
		$("#istatistiksonuc").html("<font color=green><b>Bekleyin...</b></font>");
		
		var uyeler = $("#uyeler").val();
		
		jQuery.ajax({
			
			type: 'POST',
			url: 'index.php?sayfa=bot&islem=istatistikekle',
			data: "uyeler="+uyeler,
			success: function(sonuc){
				if(sonuc == "ok"){
					$("#istatistiksonuc").html("<font color=green>Eklendi</font>");
				}
				else {
					$("#istatistiksonuc").html("<font color=red>Sitem hatasý.</font>");
				}
			}
			
		})
	}

	function intval (mixed_var, base) {

	 
		var type = typeof( mixed_var );
	 
		if (type === 'boolean') {        return (mixed_var) ? 1 : 0;
		} else if (type === 'string') {
			tmp = parseInt(mixed_var, base || 10);
			return (isNaN(tmp) || !isFinite(tmp)) ? 0 : tmp;
		} else if (type === 'number' && isFinite(mixed_var) ) {        return Math.floor(mixed_var);
		} else {
			return 0;
		}
	}
		
</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/bot.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<div id="anasonuc">
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Bot Mesajý Gönder</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cinsiyet</strong></td>
						<td class="last">
						<select name="cinsiyet" id="cinsiyet" class="text">
							<option value="hepsi">Hepsi</option>
							<?php cinsiyet(NULL, NULL); ?>
						</select>
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Yaþ aralýðý</strong></td>
						<td class="last">
						<select name="yas1" id="yas1" class="text">
							<?php for($i = 18; $i <= 50; $i++) echo "<option value=$i>$i</option>"; ?>
						</select> ile 
						<select name="yas2" id="yas2" class="text">
							<?php for($i = 80; $i >= 18; $i--) echo "<option value=$i>$i</option>"; ?>
						</select> arasý
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Seviye</strong></td>
						<td class="last">
						<select name="seviye" id="seviye" class="text">
							<option value="hepsi">Hepsi</option>
							<?php 
								$result = mysql_query("select id, ad from "._MX."seviye");
								
								while(list($id, $ad) = mysql_fetch_row($result)) echo "<option value=$id>$ad</option>";
							?>
						</select>
						</td>
					</tr>	
					<tr class="bg">
						<td class="first" width="172"><strong>Kayýt Tarihi</strong></td>
						<td class="last">
						<p>Gün : <select name="k1" id="k1" class="text">
							<?php for($i = 1; $i <= 31; $i++) echo "<option value=$i>$i</option>"; ?>
						</select> 
						Ay : <select name="k2" id="k2" class="text">
							<?php 
							for($i = 1; $i <= 12; $i++) {
							if($i == date("m")) echo "<option value=$i selected>".tarihay($i)."</option>";
							else echo "<option value=$i>".tarihay($i)."</option>";
							}
							?>
						</select>
						Yýl : <input type="text" name="k3" id="k3" class="text" style="width:40px" value="<?=date("Y");?>"> ile 
						</p>
						<p>Gün : <select name="k4" id="k4" class="text">
							<?php 
							for($i = 1; $i <= 31; $i++) {
							if($i == date("d")) echo "<option value=$i selected>$i</option>";
							else echo "<option value=$i>$i</option>";
							}
							?>
						</select> 
						Ay : <select name="k5" id="k5" class="text">
							<?php 
							for($i = 1; $i <= 12; $i++) {
							if($i == date("m")) echo "<option value=$i selected>".tarihay($i)."</option>";
							else echo "<option value=$i>".tarihay($i)."</option>";
							}
							?>
						</select>
						Yýl : <input type="text" name="k6" id="k6" class="text" style="width:40px" value="<?=date("Y");?>"> arasý 
						</p>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Aradýðýnýz ülke</strong></td>
						<td class="last">
						<select name="ulke" id="ulke" class="text" onChange="sehirgetir(this.value);">
							<option value="hepsi">Hepsi</option>
																	<?
																		$result = mysql_query("select id, adi from "._MX."ulkeler order by adi asc");
																		
																		while(list($uid, $uadi) = mysql_fetch_row($result)){
																			if($uid == 214) echo "<option value=\"$uadi\" selected>".turkce($uadi)."</option>";
																			else echo "<option value=\"$uadi\">".turkce($uadi)."</option>";
																		}
																	
																	?>
						</select>
						</td>
					</tr>	
					<tr class="bg">
						<td class="first" width="172"><strong>Aradýðýnýz þehir</strong></td>
						<td class="last">
						
																	<span id="sehirgetir">
																	<select name="sehir" id="sehir" class="text">
							<option value="hepsi">Hepsi</option>
																	<?
																		$result = mysql_query("select id, adi from "._MX."sehirler where ulke='214' order by adi asc");
																		
																		while(list($sid, $sadi) = mysql_fetch_row($result)){
																			echo "<option value=\"$sadi\">".turkce($sadi)."</option>";
																		}	
																	?>
																	</select>
																	</span>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Aradýðý cinsiyet</strong></td>
						<td class="last">
						<select name="aradigi" id="aradigi" class="text">
							<option value="hepsi">Hepsi</option>
							<?php
								$result = mysql_query("select ad from "._MX."uye_secenekler where tur='18'");
								
								while(list($ad) = mysql_fetch_row($result)) echo "<option value=\"$ad\">$ad</option>";
							?>
						</select>
						</td>
					</tr>	
					<tr class="bg">
						<td class="first" width="172"><strong>Aradýðý iliþki türü</strong></td>
						<td class="last">
						<select name="iliski" id="iliski" class="text">
							<option value="hepsi">Hepsi</option>
							<?php
								$result = mysql_query("select ad from "._MX."uye_secenekler where tur='2'");
								
								while(list($ad) = mysql_fetch_row($result)) echo "<option value=\"$ad\">$ad</option>";
							?>
						</select>
						</td>
					</tr>	
					<tr>
						<td class="first" width="172"><strong>Boy</strong></td>
						<td class="last">
						<select name="boy" id="boy" class="text">
							<option value="hepsi">Hepsi</option>
							<?php
								$result = mysql_query("select ad from "._MX."uye_secenekler where tur='4'");
								
								while(list($ad) = mysql_fetch_row($result)) echo "<option value=\"$ad\">$ad</option>";
							?>
						</select>
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Kilo</strong></td>
						<td class="last">
						<select name="kilo" id="kilo" class="text">
							<option value="hepsi">Hepsi</option>
							<?php
								$result = mysql_query("select ad from "._MX."uye_secenekler where tur='5'");
								
								while(list($ad) = mysql_fetch_row($result)) echo "<option value=\"$ad\">$ad</option>";
							?>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Medeni Durumu</strong></td>
						<td class="last">
						<select name="medeni" id="medeni" class="text">
							<option value="hepsi">Hepsi</option>
							<?php
								$result = mysql_query("select ad from "._MX."uye_secenekler where tur='16'");
								
								while(list($ad) = mysql_fetch_row($result)) echo "<option value=\"$ad\">$ad</option>";
							?>
						</select>
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Kiminle Yaþýyor</strong></td>
						<td class="last">
						<select name="kiminle" id="kiminle" class="text">
							<option value="hepsi">Hepsi</option>
							<?php
								$result = mysql_query("select ad from "._MX."uye_secenekler where tur='1'");
								
								while(list($ad) = mysql_fetch_row($result)) echo "<option value=\"$ad\">$ad</option>";
							?>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Hesap durumu</strong></td>
						<td class="last">
						<select name="aktif" id="aktif" class="text">
							<option value="hepsi">Hepsi</option>
							<option value="1">Hesabý aktif üyeler</option>
							<option value="2">Hesabu aktif olmayan üyeler</option>

						</select>
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Profil tanýtýmý onayý</strong></td>
						<td class="last">
						<select name="tanitim" id="tanitim" class="text">
							<option value="hepsi">Hepsi</option>
							<option value="1">Profil tanýmý onaylý üyeler</option>
							<option value="2">Profil tanýmý onaysýz üyeler</option>

						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Webcami Olanlar</strong></td>
						<td class="last">
						<select name="webcam" id="webcam" class="text">
							<option value="hepsi">Farketmez</option>
							<option value="1">Evet</option>
							<option value="2">Hayýr</option>

						</select>
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Webcam Sohbetten Hoþlananlar</strong></td>
						<td class="last">
						<select name="webcamsohbet" id="webcamsohbet" class="text">
							<option value="hepsi">Farketmez</option>
							<option value="1">Evet</option>
							<option value="2">Hayýr</option>

						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Diðer Seçimler</strong></td>
						<td class="last">
						<p>Sadece online olanlar <input type="checkbox" name="online" id="online" value="1" /> * Biraz fazla kasar</p>
						<p>Sadece resmi olanlar <input type="checkbox" name="resim" id="resim" value="1" /></p>
						<p>Sadece galerisi olanlar <input type="checkbox" name="galeri" id="galeri" value="1" /></p>
						<p>Eski goldlar listelenmesin <input type="checkbox" name="eskigold" id="eskigold" value="1" /></p>
						<p>Beðenileri Dolduranlar <input type="checkbox" name="dbegeni" id="dbegeni" value="1" /></p>
						<p>Hobilerini Dolduranlar <input type="checkbox" name="dhobi" id="dhobi" value="1" /></p>
						<p>Filmlerini Dolduranlar <input type="checkbox" name="dfilm" id="dfilm" value="1" /></p>
						<p>Hoþlandýðý Tipleri Dolduranlar <input type="checkbox" name="dtip" id="dtip" value="1" /></p>
						<p>Profil Tanýtýmýný Dolduranlar <input type="checkbox" name="dtanim" id="dtanim" value="1" /></p>
						<p>Profil Tanýtýmý Onaylananlar <input type="checkbox" name="dtanimonay" id="dtanimonay" value="1" /></p>
						<p>Referansý olmayan üyeler <input type="checkbox" name="referanson" id="referanson" value="1" /></p>
						</td>
					</tr>	
					<tr>
						<td class="first" width="172"><strong>&nbsp;</strong></td>
						<td class="last">
						<input type="submit" value=" Aramayý Baþlat " onclick="baslat()" class="input" /> <input type="submit" value=" Mail List Temizle " onclick="temizle()" class="input" /> <input type="submit" value=" Mail Sýra Temizle" onclick="temizle2()" class="input" /> <span id="sonuc"></span>
						</td>
					</tr>			
				</table>
				</div>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan üyelere bot mesajý gönderebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>