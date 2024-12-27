<?php

function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}

$islem = $_GET["islem"];

if($islem == "listele"){
	
	$k1 = $_POST["k1"];
	$k2 = $_POST["k2"];
	$k3 = $_POST["k3"];
	$k4 = $_POST["k4"];
	$k5 = $_POST["k5"];
	$k6 = $_POST["k6"];
	$tur = $_POST["tur"];
	
	$baslangickayit = @mktime(0,0,0, $k2, $k1, $k3);
	$bitiskayit = @mktime(date("H"),date("i"),date("s"), $k5, $k4, $k6);
	
	if($tur == "kk") $tur = " and tur='1'";
	else if($tur == "havale") $tur = " and tur='2'";
	else $tur = NULL;
	
	
	$result = @mysql_query("select count(id) as adet, sum(tutar) from "._MX."odeme where kayit > $baslangickayit and kayit < $bitiskayit".$tur."");
	
	list($adet, $tutar) = @mysql_fetch_row($result);
	
	echo "$adet adet satýþtan $tutar TL kazanýlmýþ.";
	
	
	die();
	
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Satýþ istatistiði | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
	function sayfa(sayfa){
		
		window.location = 'index.php?sayfa=satislargenel&p='+sayfa;
		
	}
	function baslat(){
		var k1 = $("#k1").val();
		var k2 = $("#k2").val();
		var k3 = $("#k3").val();
		var k4 = $("#k4").val();
		var k5 = $("#k5").val();
		var k6 = $("#k6").val();
		var tur = $("#tur").val();
		
		$("#sonuc").html("Lütfen bekle");
		
		$.post("index.php?sayfa=satislaristatistik&islem=listele", "k1="+k1+"&k2="+k2+"&k3="+k3+"&k4="+k4+"&k5="+k5+"&k6="+k6+"&tur="+tur, function(sonuc){
			
			$("#sonuc").html(sonuc);
			
		})
		
	}
</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/satislar.php"); ?>
		<div id="center-column">
			<div class="table">
				<table class="listing" cellpadding="0" cellspacing="0">
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?php
						
						list($toplam) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme"));
						
						list($kredi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme where tur='1'"));
						
						list($havale) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme where tur='2'"));
						
						list($havaleonay) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme where tur='2' and durum='1'"));

						$havalebekleyen = $havale - $havaleonay;
						
						$bugun = @mktime();
						
						$dun = @mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));
						
						$buay = @mktime(0, 0, 0, date("m"), 31, date("Y"));
						
						$buay2 = @mktime(0, 0, 0, date("m"), 1, date("Y"));
						
						$biray = 60 * 60 * 24 * 30;
						
						$gecenay = $buay2 - $biray;
						
						
						list($buguntop) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme where kayit < $bugun and kayit > $dun"));
						
						list($toplamtutar) = mysql_fetch_row(mysql_query("select sum(tutar) from "._MX."odeme"));
						
						list($toplamtutar2) = mysql_fetch_row(mysql_query("select sum(tutar) from "._MX."odeme2"));
						
						
						list($buguntoplamolala) = mysql_fetch_row(mysql_query("select sum(tutar) from "._MX."odeme2 where kayit < $bugun and kayit > $dun"));
						
						list($buaytop) = mysql_fetch_row(mysql_query("select sum(tutar) from "._MX."odeme2 where kayit < $buay and kayit > $buay2"));
						
						list($buaytop2) = mysql_fetch_row(mysql_query("select sum(tutar) from "._MX."odeme2 where kayit < $buay2 and kayit > $gecenay"));

						$buay1 = @mktime(0, 0, 0, date("m"), 1, date("Y"));
						
						$buay2 = @mktime(0, 0, 0, date("m"), 31, date("Y"));
						
						list($buay) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme where kayit < $buay2 and kayit > $buay1 and tur='1'"));
						
						list($buaytoplam) = mysql_fetch_row(mysql_query("select sum(tutar) from "._MX."odeme where kayit < $buay2 and kayit > $buay1 and tur='1'"));

						$buay1 = @mktime(0, 0, 0, date("m")-1, 1, date("Y"));
						
						$buay2 = @mktime(0, 0, 0, date("m")-1, 31, date("Y"));
						
						list($gecenay) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme where kayit < $buay2 and kayit > $buay1 and tur='1'"));
						
						list($gecenaytoplam) = mysql_fetch_row(mysql_query("select sum(tutar) from "._MX."odeme where kayit < $buay2 and kayit > $buay1 and tur='1'"));						
						
						$result =  mysql_query("select tutar from "._MX."odeme where kayit < $bugun and kayit > $dun");
						
						$toplamtutarbugun = 0;
						
						while(list($buguntoplam) = mysql_fetch_row($result)) $toplamtutarbugun = $buguntoplam + $toplamtutarbugun;
						
					?>
					<tr>
						<th class="full" colspan="2">Genel Satýþ istatistiði</th>
					</tr>
					<tr>
						<td class="first" width="50%"><strong>Toplam Satýþlar</strong></td>
						<td class="last" style="text-align:left"><?=$toplam?></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Toplam Kredi Kartý Satýþlarý</strong></td>
						<td class="last" style="text-align:left"><?=$kredi?></td>
					</tr>
					<tr>
						<td class="first" width="50%"><strong>Toplam Havale Satýþlarý</strong></td>
						<td class="last" style="text-align:left"><?=$havale?></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Toplam Bu Ay Satýþ Adedi</strong></td>
						<td class="last" style="text-align:left"><?=$buay?></td>
					</tr>
					<tr>
						<td class="first" width="50%"><strong>Toplam Bu Ay Satýþ Tutarý</strong></td>
						<td class="last" style="text-align:left"><?=$buaytoplam?> TL</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Toplam Geçen Ay Satýþ Adedi</strong></td>
						<td class="last" style="text-align:left"><?=$gecenay?></td>
					</tr>
					<tr>
						<td class="first" width="50%"><strong>Toplam Geçen Ay Satýþ Tutarý</strong></td>
						<td class="last" style="text-align:left"><?=$gecenaytoplam?> TL</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Toplam Onaylý Havale Satýþlarý</strong></td>
						<td class="last" style="text-align:left"><?=$havaleonay?></td>
					</tr>
					<tr>
						<td class="first" width="50%"><strong>Bekleyen Havale Satýþlarý</strong></td>
						<td class="last" style="text-align:left"><?=$havalebekleyen?></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Bugün Toplam Satýþlar</strong></td>
						<td class="last" style="text-align:left"><?=$buguntop?></td>
					</tr>
					<tr>
						<td class="first" width="50%"><strong>Bugün Toplam Tutar</strong></td>
						<td class="last" style="text-align:left"><?=$toplamtutarbugun?> TL</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Toplam Kazanýlan Tutar</strong></td>
						<td class="last" style="text-align:left"><?=$toplamtutar?> TL</td>
					</tr>	
					<tr>
						<td class="first" width="172"><strong>Satýþ Tarihi</strong></td>
						<td class="last" style="text-align:left">
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
					<tr class="bg">
						<td class="first" width="172"><strong>Satýþ Türü</strong></td>
						<td class="last" style="text-align:left">
																	<select name="tur" id="tur" class="text">
							<option value="hepsi">Hepsi</option>
							<option value="kk">Kredi Kartý</option>
							<option value="havale">Havale</option>
							
																	</select>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>&nbsp;</strong></td>
						<td class="last" style="text-align:left">
						<input type="submit" value=" Listele " onclick="baslat()" class="input" />
						</td>
					</tr>	
					<tr class="bg">
						<td class="first" width="172"><strong>&nbsp;</strong></td>
						<td class="last" style="text-align:left">
						<span id="sonuc"></span>
						</td>
					</tr>
					<?
						
						/*
						
						$adminseviye = adminseviye();
						
						if($adminseviye == 2){
					?>
					<tr class="bg">
						<td class="first"><strong>Olala Bugün</strong></td>
						<td class="last" style="text-align:left"><?=$buguntoplamolala?> TL</td>
					</tr>
					<tr>
						<td class="first" width="50%"><strong>Olala Bu Ay</strong></td>
						<td class="last" style="text-align:left"><?=$buaytop?> TL</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Olala Geçen Ay</strong></td>
						<td class="last" style="text-align:left"><?=$buaytop2?> TL</td>
					</tr>
					<tr>
						<td class="first"><strong>Olala Toplam</strong></td>
						<td class="last" style="text-align:left"><?=$toplamtutar2?> TL</td>
					</tr>
					<?
						
						 }
						 */
					?>
			
					
				</table>
			</div>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Tüm satýþ istatistiðini bu alandan görebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php } ?>
