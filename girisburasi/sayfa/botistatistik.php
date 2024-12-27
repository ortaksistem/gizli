<?

$islem = $_GET["islem"];

if($islem == "getir"){
	
	$result = mysql_query("select veri, zaman from "._MX."istatistik2");
	
	list($uyeler, $zaman) = mysql_fetch_row($result);

	$parcala = explode(";", $uyeler);
	
	$i = 0;
	
	$a = 0;
	
	foreach($parcala as $uye){
		
	
		list($varmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where id='$uye' and sononline > $zaman"));
		
		if($varmi >= 1) $a++;
		
		unset($varmi);
		
		$i++;
	
	}
	
	
	$yuzdesi = $a/$i *100;
	
	$yuzdesi = round($yuzdesi, 2);
	
	$kzaman = date("d.m.Y", $zaman);
	
	
	echo "Gonderilen tarih : <b>$kzaman</b><br />Uye Adedi : <b>$i</b><br />Giris Yapan Uye Adedi : <b>$a</b><br />Giris Yapan Uye Yuzdesi : <b>% $yuzdesi</b>";
	
	die();
}
else {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Bot Ýstatistik Görüntüle | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
	function istatistikgetir(){
	
		$("#islem").html("<font color=green size=2><b>Bekleyin hesaplanýyor.</b></font>");
				
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=botistatistik&islem=getir',
					data : "gonder=ok",
					success: function(sonuc){		
						$("#islem").html(sonuc);
					}
				})
	}
	

		
</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/bot.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post" name="bakimform">
		  <div class="table">

				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Ýstatistik Görüntüle</th>
					</tr>
					<tr>
						<td class="first" width="150"><strong>Ýþlem Butonlarý</strong></td>
						<td class="last">
						<input type="submit" value=" Ýstatistiði Getir " onclick="istatistikgetir()" /> 
					</tr>
					<tr>
						<td class="first"><strong>Durum ve Ýstatistik</strong></td>
						<td class="last" id="islem">
						
						</td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan kullanýcý email geri dönüþ istatistiklerini görebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>