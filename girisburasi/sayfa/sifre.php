<?

$islem = $_GET["islem"];

if($islem == "kaydet"){
	
	$eski = $_POST["eski"];
	$yeni = $_POST["yeni"];
	
	$result = mysql_query("select sifre from "._MX."admin where id='".adminid()."'");
	
	list($sqlsifre) = mysql_fetch_row($result);
	
	if($sqlsifre != sifreleme($eski)) die("hata1");
	
	
	$yeni = sifreleme($yeni);
	
	$result = mysql_query("update "._MX."admin set sifre='$yeni' where id='".adminid()."'");
	
	if($result) die("ok");
	else die("hata");

}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Y�netici �ifremi De�i�tir | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
		function baslat(){
			
			var eski = $("#eski").val();
			var yeni = $("#yeni").val();
			var yeni2 = $("#yeni2").val();
			
			if(eski == ""){
				alert("Eski �ifrenizi yazmad�n�z");
			}
			else if(yeni == ""){
				alert("Yeni �ifrenizi yazmad�n�z");
			}
			else if(yeni2 == ""){
				alert("Yeni �ifre tekrar�n� yazmad�n�z");
			}
			else if(yeni2 != yeni){
				alert("Yeni �ifre ile tekrar� uyu�mamaktad�r");
			}
			else if(eski == yeni){
				alert("Eski �ifreniz ile yenisi ayn�d�r");
			}
			else {
				$("#sonuc").html("<img src='img/loading.gif' /> Bekleyin ...");
				
				jQuery.ajax({
					type: 'POST',
					url: 'index.php?sayfa=sifre&islem=kaydet',
					data: 'eski='+eski+'&yeni='+yeni,
					success: function(sonuc){
						if(sonuc == "hata1"){
							$("#sonuc").html("");
							alert("Eski �ifreniz yanl��t�r");
						}
						else if(sonuc == "ok"){
							$("#sonuc").html("");
							alert("�ifreni ba�ar�yla de�i�tirilmi�tir. \n\n Otomatik ��k�� yapt�n�z, yeniden giri� yapmal�s�n�z.");
							window.location = 'index.php?sayfa=cikis';
						}
						else {
							$("#sonuc").html("");
							alert("Sistem hatas�, sonra tekrar deneyin");						
						}
					}
				})
			}
		
		}
	</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/anasayfa.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">�ifre De�i�tir</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Eski �ifre</strong></td>
						<td class="last"><input type="password" name="eski" id="eski" class="text" style="width:150px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Yeni �ifre</strong></td>
						<td class="last"><input type="password" name="yeni" id="yeni" class="text" style="width:150px" /></td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Yeni �ifre (Tekrar)</strong></td>
						<td class="last"><input type="password" name="yeni2" id="yeni2" class="text" style="width:150px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " onclick="baslat()" /> <span id="sonuc"></span></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Genel site ayarlar� bu b�l�mden yap�lmaktad�r. Ayarlar� do�ru yapt�g�n�zdan emin olunuz. Sitenin �al��mas�n� etkileyebilir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>