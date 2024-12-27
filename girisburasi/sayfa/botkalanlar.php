<?php

list($adet) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_mail_sira"));

$result = mysql_query("select uye from "._MX."uye_mail_sira");

$data = NULL;

while(list($id) = mysql_fetch_row($result)){
	$data .= $id.";";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Bot Mesajı Gönder | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">

		
</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/bot.php"); ?>
		<div id="center-column">

		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<div id="anasonuc">
	<form action="index.php?sayfa=botgonder" method="post">
	
	<input type="hidden" name="uyeler" id="uyeler" value="<?=$data?>">

				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2"><?=turkcejquery("Bot Mesajı Gönder");?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Toplam Kalan Uye</strong></td>
						<td class="last">
						<b><?=$adet;?></b> adet uye bulundu.
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
						<p><input type="checkbox" name="hit" id="hit" value="1" /> <?=turkcejquery("Profiline baksın");?></p>
						<p><input type="checkbox" name="arkadas" id="arkadas" value="1" /> <?=turkcejquery("Arkadaş olarak eklesin");?></p>
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
									[YAS] = Kullanicinin yasini yazdirir
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
						<td class="first" width="172"><strong><?=turkcejquery("Gönderim Hızı"); ?></strong></td>
						<td class="last">
						<input type="text" name="hiz" id="hiz" value="100" class="text" style="width:50px"> * ideal 100 tanedir
						</td>
					</tr>	
					<tr>
						<td class="first" width="172">&nbsp;</td>
						<td class="last">
						<input type="submit" value=" <?=turkcejquery("İşlemi başlat"); ?> " onclick="return confirm('Gonderim baslatilsin mi?');">
						<input type="hidden" name="toplam" id="toplam" value="<?=$adet?>">
						</td>
					</tr>	
				</table>
		</form>
				</div>
	        <p>&nbsp;</p>
		  </div>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Kalan bot mesajı maillerini gösterir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>