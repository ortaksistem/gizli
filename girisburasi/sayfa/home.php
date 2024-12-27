<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin Anasayfa | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
	$(window).load(function () {

		$("#istsatisyil").html("<font color=green size=1><b>Satış istatistiği yükleniyor.</b></font>");

		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=homeistatistik',
			data : "tur=satisyil",
			success: function(sonuc){	
				$("#istsatisyil").html(sonuc);
			}
		})
		
		$("#istsatisay").html("<font color=green size=1><b>Satış istatistiği yükleniyor.</b></font>");

		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=homeistatistik',
			data : "tur=satisay",
			success: function(sonuc){	
				$("#istsatisay").html(sonuc);
			}
		})
		
		$("#istsatisgun").html("<font color=green size=1><b>Satış istatistiği yükleniyor.</b></font>");

		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=homeistatistik',
			data : "tur=satisgun",
			success: function(sonuc){	
				$("#istsatisgun").html(sonuc);
			}
		})
	});  
	</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/anasayfa.php"); ?>
		<div id="center-column" cellpadding="5" cellspacing="5">
			<table>
			<tr>
			<td colspan=2">
			<?php
				
				list($toplam) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye"));
				list($cep) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where telonay='1'"));
				list($spsay) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where sitemiz='sp'"));
			
			?>
			Toplam Üye Sayısı : <b><?=$toplam?></b><br />
			Toplam Cep Onaylı Üye Sayısı : <b><?=$cep?></b><br /><br />
			Toplam Adsense Üye Sayısı : <b><?=$spsay?></b><br /><br />
			</td>
			</tr>
			<tr>
				<td colspan=2>
					<b>Yıllara Göre Satış İstatistiği</b>
					<p><span id="istsatisyil"></span></p>
				</td>

			</tr>
			<tr>
				<td colspan=2>
					<b><?=date("Y");?> Yılı Aylara Göre Satış İstatistiği</b>
					<p><span id="istsatisay"></span></p>
				</td>

			</tr>
			<tr>
				<td colspan=2>
					<b><?=tarihay(date("m"));?> Ayı Günlere Göre Satış İstatistiği</b>
					<p><span id="istsatisgun"></span></p>
				</td>

			</tr>
			</table>
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Burada sistem kullanımı hakkında kısa bilgiler yer alıcaktır.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
