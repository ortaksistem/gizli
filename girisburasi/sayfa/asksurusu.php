<?

function gunler($param, $param2){

	$gunler = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
	$gunler2 = array("Pazartesi", "Salý", "Çarþamba", "Perþembe", "Cuma", "Cumartesi", "Pazar");
	
	if($param){
	
	
	}
	else {
		
		$adet = count($gunler);
		
		for($i = 0; $i < $adet; $i++){
			$gun = $gunler[$i];
			$gun2 = $gunler2[$i];
			if($param2 == $gun) echo "<option value=\"$gun\" selected>$gun2</option>";
			else echo "<option value=\"$gun\">$gun2</option>";
		}
		
	}
}

$islem = $_GET["islem"];

if($islem == "kaydet"){
	
	
	$baslik = $_POST["baslik"];
	$sik1 = $_POST["sik1"];
	$sik2 = $_POST["sik2"];
	$sik3 = $_POST["sik3"];
	$sik4 = $_POST["sik4"];
	$gun = $_POST["gun"];
	$cevap = $_POST["cevap"];
	
	if(!$baslik or !$sik1 or !$sik2) die("Gerekli alanlari doldurun");

	
	$baslik = addslashes($baslik);
	$sik1 = addslashes($sik1);
	$sik2 = addslashes($sik2);
	$sik3 = addslashes($sik3);
	$sik4 = addslashes($sik4);
	
	$kayit = time(();
	
	
	$result = mysql_query("insert into "._MX."anket values(NULL, '$baslik', '$sik1', '0', '$sik2', '0', '$sik3', '0', '$sik4', '0', '$cevap', '0', '$gun', '$kayit')");
	
	
	if($result){
		$buton = "<font color=green><b>Anket baþarýyla kaydedildi</b></font>";
	}
	else {
		$buton = NULL;
	}
}

if($islem == "duzenle2"){

	$id = $_POST["id"];
	$baslik = $_POST["baslik"];
	$sik1 = $_POST["sik1"];
	$sik2 = $_POST["sik2"];
	$sik3 = $_POST["sik3"];
	$sik4 = $_POST["sik4"];
	$cevap = $_POST["cevap"];
	$gun = $_POST["gun"];
	
	if(!$id or !$baslik or !$sik1 or !$sik2) die("Gerekli alanlari doldurun");

	
	$baslik = addslashes($baslik);
	$sik1 = addslashes($sik1);
	$sik2 = addslashes($sik2);
	$sik3 = addslashes($sik3);
	$sik4 = addslashes($sik4);
	
	$result = mysql_query("update "._MX."anket set soru='$baslik', cevap1='$sik1', cevap2='$sik2', cevap3='$sik3', cevap4='$sik4', cevap='$cevap', gun='$gun' where id='$id'");
	
	yonlendir("index.php?sayfa=asksurusu_listele");


}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Aþk Sürüþü Yeni Ekle | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/icerik.php"); ?>
	

		<div id="center-column">
		
		<?php
			
			if($islem == "duzenle"){
			
			$id = $_GET["id"];
			
			$result = mysql_query("select soru, cevap1, cevap2, cevap3, cevap4, cevap, gun from "._MX."anket where id='$id'");
			
			list($soru, $sik1, $sik2, $sik3, $sik4, $cevap, $gun) = mysql_fetch_row($result);
			
			$soru = stripslashes($soru);
			
			$sik1 = stripslashes($sik1);
			$sik2 = stripslashes($sik2);
			$sik3 = stripslashes($sik3);
			$sik4 = stripslashes($sik4);
			
		?>
		<form action="index.php?sayfa=asksurusu&islem=duzenle2" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Aþk sürüþünü düzenle</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Aþk Sürüþü Sorusu</strong></td>
						<td class="last"><input type="text" name="baslik" id="baslik" class="text" value="<?=$soru?>" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Cevap Þýkký 1</strong></td>
						<td class="last"><input type="text" name="sik1" id="sik1" class="text" value="<?=$sik1?>" style="width:250px" /></td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cevap Þýkký 2</strong></td>
						<td class="last"><input type="text" name="sik2" id="sik2" class="text" value="<?=$sik2?>" style="width:250px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Cevap Þýkký 3</strong></td>
						<td class="last"><input type="text" name="sik3" id="sik3" class="text" value="<?=$sik3?>" style="width:250px" /></td>
					</tr>	
					<tr>
						<td class="first" width="172"><strong>Cevap Þýkký 4</strong></td>
						<td class="last"><input type="text" name="sik4" id="sik4" class="text" value="<?=$sik4?>" style="width:250px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Anket Cevabý</strong></td>
						<td class="last">
						<select name="cevap" id="cevap">
						<?php
							
							$cevaplar = array("Cevap Yok", "Cevap1", "Cevap2", "Cevap3", "Cevap4");
							
							$adet = count($cevaplar);
							
							
							for($i = 0; $i < $adet; $i++){
								
								if($i == $cevap) echo "<option value='$i' selected>".$cevaplar[$i]."</option>";
								else echo "<option value='$i'>".$cevaplar[$i]."</option>";
							
							}
						
						
						?>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Hangi Gün</strong></td>
						<td class="last"><select name="gun" id="gun">
						<?=gunler(NULL, $gun);?>
						</select></td>
					</tr>	
					<tr class="bg">
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Düzenle " /> * En az 2 þýk yani 1 ve 2. þýklarýn doldurulmasý zorunludur.</td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		  <input type="hidden" name="id" id="id" value="<?=$id?>">
		</form>
		<?php
			}
			else {
			
		?>
		<form action="index.php?sayfa=asksurusu&islem=kaydet" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Yeni Aþk Sürüþü Ekle <?=$buton?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Aþk Sürüþü Sorusu</strong></td>
						<td class="last"><input type="text" name="baslik" id="baslik" class="text" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Cevap Þýkký 1</strong></td>
						<td class="last"><input type="text" name="sik1" id="sik1" class="text" style="width:250px" /></td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cevap Þýkký 2</strong></td>
						<td class="last"><input type="text" name="sik2" id="sik2" class="text" style="width:250px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Cevap Þýkký 3</strong></td>
						<td class="last"><input type="text" name="sik3" id="sik3" class="text" style="width:250px" /></td>
					</tr>	
					<tr>
						<td class="first" width="172"><strong>Cevap Þýkký 4</strong></td>
						<td class="last"><input type="text" name="sik4" id="sik4" class="text" style="width:250px" /></td>
					</tr>	
					<tr class="bg">
						<td class="first" width="172"><strong>Anket Cevabý</strong></td>
						<td class="last">
						<select name="cevap" id="cevap">
						<?php
							
							$cevaplar = array("Cevap Yok", "Cevap1", "Cevap2", "Cevap3", "Cevap4");
							
							$adet = count($cevaplar);
							
							
							for($i = 0; $i < $adet; $i++){
								
								if($i == $cevap) echo "<option value='$i' selected>".$cevaplar[$i]."</option>";
								else echo "<option value='$i'>".$cevaplar[$i]."</option>";
							
							}
						
						
						?>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Hangi Gün</strong></td>
						<td class="last"><select name="gun" id="gun">
						<?=gunler(NULL, NULL);?>
						</select></td>
					</tr>		
					<tr class="bg">
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " /> * En az 2 þýk yani 1 ve 2. þýklarýn doldurulmasý zorunludur.</td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		<?
			}
		?>
		
					
		</div>		
					
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Aþk sürüþü içeriðini ekleyebilirsiniz, düzenleyebilir, silebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
