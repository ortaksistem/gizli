<?php
function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}
	$islem = $_GET["islem"];

	$limit = 20; 
	
	if($islem == "onay"){

		$uyeadi = $_POST["uyeadi"];
		
		$uyeadi = turkce($uyeadi);
		
		
		list($uyeid) = mysql_fetch_row(mysql_query("select id from "._MX."uye where kullanici='$uyeadi'"));
		
		if(!$uyeid) die("<font color=red>Boyle bir bot bulunmuyor");
		
		$result = mysql_query("select id, talepeden from "._MX."galeri_talep where talepedilen='$uyeid' and durum='2'");
		
		$galeri = 1;
		
		while(list($id, $talep) = mysql_fetch_row($result)){
		
			@mysql_query("update "._MX."galeri_talep set durum='1' where id='$id'");
			
			@mysql_query("update "._MX."uye set topgalerionay=topgalerionay+1 where id='$talep'");
		
			$galeri++;
		}
		
		
		$result = mysql_query("select id from "._MX."uye_arkadas where uye='$uyeid' or arkadas='$uyeid'");
		
		$arkadas = 1;
		
		while(list($id) = mysql_fetch_row($result)){
		
			@mysql_query("update "._MX."uye_arkadas set durum='1' where id='$id'");
			
			$arkadas++;
			
		}
		
		
		echo "<font color=green>$galeri talebi, $arkadas talebi onaylandi</font>";
		
		
	}
	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Bot verilerini onayla | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
function onayla(){
	var uyeadi = document.getElementById('uyeadi').value;

	
	$("#onaylasonuc").html("<img src='img/loading.gif' /> <font color=green size=1>Lütfen Bekleyin...</font>");
	
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=botonayla&islem=onay',
					data : "uyeadi="+uyeadi,
					success: function(sonuc){		
						$("#onaylasonuc").html(sonuc);
								
					}
				})
}

</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/uye.php"); ?>
		<div id="center-column">
		  <div class="select-bar">
			<label>
			<b>Bot Adýný Yazýn :</b> 
			</label>
		    <label>
		    <input type="text" name="uyeadi" id="uyeadi" size="14" class="inputlar" />
		    </label>
		    <label>
			<input type="submit" name="Submit" value=" Onayla " onclick="onayla()" /> <span id="onaylasonuc">* Botun tam nickini yazýnýz !</span>
			</label>
		 </div>
		  
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Botun tüm bekleyen içerikleri (galeri talepleri, arkadaþlar vs) onaylanacaktýr.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?
}
?>
