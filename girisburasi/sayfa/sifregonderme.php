<?php

$islem = $_POST["islem"];


if($islem == "hesapla"){
	
	$gun = $_POST["gun"];
	
	if(!is_numeric($gun)) die(2);
	
	$zaman = time();

	$cikar = 60 * 60 * 24 * $gun;

	$kalan = $zaman - $cikar;


	list($adet) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where sononline > $kalan"));


	echo $adet;
	
	die();

}
else {

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Şifre Gönder | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
	function hesapla(){
		
		var gun = $("#gun").val();
		
		$("#hesapla").html("<font color=green><b>Hesaplanıyor</b></font>");
		

		jQuery.ajax({
			
			type: 'POST',
			url: 'index.php?sayfa=sifregonderme',
			data: "islem=hesapla&gun="+gun,
			success: function(sonuc){
				if(sonuc == 2){
					$("#hesapla").html("<font color=red><b>İşlem hatalısı.</b></font>");
				}
				else {
					$("#hesapla").html("<font color=green><b>"+sonuc+"</b> üyeye gönderilecek</font>");
					$("#toplam").val(sonuc);
				}
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

		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<div id="anasonuc">
	<form action="index.php?sayfa=sifregonder" method="post">
	
	<input type="hidden" name="uyeler" id="uyeler" value="<?=$data?>">

				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2"><?=turkcejquery("Bot Mesajı Gönder");?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Gönderilecek Üye</strong></td>
						<td class="last">
						<span id="hesapla">Hesaplanmadı</span>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Kaç gün öncesi</strong></td>
						<td class="last">
						<input type="text" name="gun" id="gun" value="90" class="text" style="width:50px"> <a href="javascript:void(0)" onclick="hesapla();">Hesapla</a> * Gün olarak kaç gün
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>İşlem</strong></td>
						<td class="last">
						<p><input type="checkbox" name="sifredegis" id="sifredegis" value="1" /> Şifreler değiştirilsin mi?</p>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Email</strong></td>
						<td class="last">
						<select name="email" id="email" class="text">
							<option value="2" selected>SMTP email gonder</option>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong><?=turkcejquery("Gönderim Hızı"); ?></strong></td>
						<td class="last">
						<input type="text" name="hiz" id="hiz" value="5" class="text" style="width:50px"> 
						</td>
					</tr>	
					<tr>
						<td class="first" width="172">&nbsp;</td>
						<td class="last">
						<input type="submit" value=" <?=turkcejquery("İşlemi başlat"); ?> " onclick="return confirm('Gonderim baslatilsin mi? Hesaplama Yapmanız Gerektiğini Unutmayın!!');">
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
			<div class="box">Şifre değiştirme ve kullanıcı maillerine atma işlemini yapar.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>
