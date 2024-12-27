<?php
function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}
	$islem = $_GET["islem"];

if($islem == "sil"){
		$id = $_POST["id"];
		$result = mysql_query("update "._MX."uye set tanitimonay='3' where id='$id'");
		if($result) die("ok");
		else die("hata");
}
else if($islem == "onayla"){
		$id = $_POST["id"];
		$result = mysql_query("update "._MX."uye set tanitimonay='1' where id='$id'");
		if($result) die("ok");
		else die("hata");
}
else {
	
	$limit = 20; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Bekleyen Profil Tanıtım Yazıları | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery-eski.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
function sayfa(sayfa){
	
	window.location = 'index.php?sayfa=uyebekleyentanitim&p='+sayfa;
}

function sil(uye){
	var onayla = confirm("Editör Tarafından Red Edildi Yazısı Çıkacaktır");
	if(onayla){
		$("#uyeid"+uye).hide();
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=uyebekleyentanitim&islem=sil',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
					
				}
				else {
					alert("Tanıtım silinemedi tekrar deneyiniz");
				}
			}
		})
	}
}

function onayla(uye){
	
		$("#uyeid"+uye).hide();
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=uyebekleyentanitim&islem=onayla',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
					
				}
				else {
					alert("Tanıtım onaylanamadı tekrar deneyiniz");
				}
			}
		})
}
</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/uye.php"); ?>
		<div id="center-column">
		  
			<div class="table" id="uyeyukle">
				<table class="listing" cellpadding="0" cellspacing="0">
					<?
						
						$adminseviye = adminseviye();
						$p = $_GET["p"];
						if(!$p) $p = 1;
						$p = intval($p);
						
						$yil = date("Y");
						
						$result = mysql_query("select id from "._MX."uye where durum='1' and tanitim!='' and tanitimonay='2'");
						$sayi = mysql_num_rows($result);
						$toplamsayfa = ceil(($sayi/$limit));
						
						$i = 1;
						
						$result = mysql_query("select id, kullanici, cinsiyet, dogum, sehir, img, tanitim, satissatis from "._MX."uye where durum='1' and tanitim!='' and tanitimonay='2' limit ".(($p-1)*$limit).",".$limit."");
						
						while(list($uye, $uyead, $cinsiyet, $dogum, $sehir, $img, $tanitim, $satissatis) = mysql_Fetch_row($result)){
						
						$img = uyeavatar($img, $cinsiyet);
						
						$cinsiyet = cinsiyet($cinsiyet);
						
						$dogum = $yil - date("Y", $dogum);

						$tanitim = stripslashes(nl2br($tanitim));
						if($satissatis == 2 and $adminseviye != 2){
							$i--;
						}
						else if($satissatis == 2 and $adminseviye == 2){
					?>

					<tr id="uyeid<?=$uye?>" class="bg">
						<td class="first style1" style="text-aling:center" width="150">
							<p align=center><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><img src="../<?=$img?>" width="110" border="0" /></a></p>
							<p align=center>
							<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><?=$uyead?> - <?=$uyead?></a><br>
							<?=$cinsiyet?> - <?=$dogum?> Yaş - <?=$sehir?><br><?=$zaman1?>
							
							</p>
						</td>
						<td class="first style1" style="text-aling:center">
							<?=$tanitim?>
						</td>
						<td class="first style1" style="text-aling:center" width="50">
							<p align="center">
							<a href="javascript:onayla(<?=$uye?>)" title="Onayla"><img src="img/add-icon.gif" border="0" /></a> 
							<a href="javascript:sil(<?=$uye?>)" title="Reddet"><img src="img/hr.gif" border="0" /></a> 
							</p>
						</td>
					</tr>
					
					<?
						}
						else {
					?>

					<tr id="uyeid<?=$uye?>">
						<td class="first style1" style="text-aling:center" width="150">
							<p align=center><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><img src="../<?=$img?>" width="110" border="0" /></a></p>
							<p align=center>
							<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><?=$uyead?></a><br>
							<?=$cinsiyet?> - <?=$dogum?> Yaş - <?=$sehir?><br><?=$zaman1?>
							
							</p>
						</td>
						<td class="first style1" style="text-aling:center">
							<?=$tanitim?>
						</td>
						<td class="first style1" style="text-aling:center" width="50">
							<p align="center">
							<a href="javascript:onayla(<?=$uye?>)" title="Onayla"><img src="img/add-icon.gif" border="0" /></a> 
							<a href="javascript:sil(<?=$uye?>)" title="Reddet"><img src="img/hr.gif" border="0" /></a> 
							</p>
						</td>
					</tr>
					
					<?						
						
						}
						
						
						}
						
						
					?>

				</table>
			</div>
				<div class="table">
					<div class="select">
						<strong>Sayfalar : </strong>
						<select name="sayfalar" id="sayfalar" class="selectler" onChange="sayfa(this.value)">
							<? 
							for($i = 1; $i<=$toplamsayfa; $i++) {
							if($i == $p) echo "<option value=$i selected>$i. Sayfa</option>"; 
							else echo "<option value=$i>$i. Sayfa</option>";
							}
							?>
						</select>
					</div>
				</div>
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Haftanın üyelerini bu bölümden onaylayabilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>