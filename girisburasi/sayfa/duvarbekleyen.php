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
		list($tur, $resim) = mysql_fetch_row(mysql_query("select tur, resim from "._MX."duvar where id='$id'"));
		
		if($tur == 3){
			
			$resimthumb = str_replace("duvar/", "duvar_thumb/", $resim);
			
			@unlink("../$resim");
			@unlink("../$resimthumb");
		
		}
		
		$result = mysql_query("delete from "._MX."duvar where id='$id'");
		if($result) die("ok");
		else die("hata");
}
else if($islem == "onayla"){
		$id = $_POST["id"];	
		$result = mysql_query("update "._MX."duvar set durum='1' where id='$id'");
		if($result) die("ok");
		else die("hata");
}
else {
	
	$limit = 20; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Bekleyen Duvar ��erikleri | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
function sayfa(sayfa){
	
	window.location = 'index.php?sayfa=duvarbekleyen&p='+sayfa;
}

function sil(uye){
	var onayla = confirm("Silinsin mi?");
	if(onayla){
		$("#uyeid"+uye).hide();
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=duvarbekleyen&islem=sil',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
					
				}
				else {
					alert("��erik silinemedi tekrar deneyiniz");
				}
			}
		})
	}
}

function onayla(uye){
	
		$("#uyeid"+uye).hide();
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=duvarbekleyen&islem=onayla',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
					
				}
				else {
					alert("��erik onaylanamad� tekrar deneyiniz");
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
						
						$result = mysql_query("select id from "._MX."duvar where durum='2'");
						$sayi = mysql_num_rows($result);
						$toplamsayfa = ceil(($sayi/$limit));
						
						$i = 1;
						
						$result = mysql_query("select id, uye, uyeadi, tur, baslik, icerik, resim from "._MX."duvar where durum='2' limit ".(($p-1)*$limit).",".$limit."");
						
						while(list($id, $uye, $uyead, $tur, $baslik, $icerik, $resim) = mysql_Fetch_row($result)){
						
						list($satissatis) = mysql_fetch_row(mysql_query("select satissatis from "._MX."uye where id='$uye'"));
						
						$baslik = stripslashes(nl2br($baslik));
						
						if($tur == 1){
							$icerikk = $baslik;
						}
						else if($tur == 2){
							list($gen, $yuk, $video) = explode("||", stripslashes($icerik));
							
							$icerikk = "Video : <a href='$video' target='_blank'>$baslik</a>";
						}
						else {
							
							$resimthumb = str_replace("duvar/", "duvar_thumb/", $resim);
							
							$icerikk = "Resim : <a href='../$resim' target='_blank'><img src='../$resimthumb' width='100' /></a><br />$baslik";
						}
						
						if($satissatis == 2 and $adminseviye != 2){
							$i--;
						}
						else if($satissatis == 2 and $adminseviye == 2){
					?>

					<tr id="uyeid<?=$id?>" class="bg">
						<td class="first style1" style="text-aling:center" width="150">
							<p align=center>
							<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><?=$uyead?> - <?=$uyead?></a>
							
							
							</p>
						</td>
						<td class="first style1" style="text-aling:center">
							<?=$icerikk?><br />
                            <?=stripslashes($icerik)?>
						</td>
						<td class="first style1" style="text-aling:center" width="50">
							<p align="center">
							<a href="javascript:onayla(<?=$id?>)" title="Onayla"><img src="img/add-icon.gif" border="0" /></a> 
							<a href="javascript:sil(<?=$id?>)" title="Reddet"><img src="img/hr.gif" border="0" /></a> 
							</p>
						</td>
					</tr>
					
					<?
						}
						else {
					?>

					<tr id="uyeid<?=$id?>">
						<td class="first style1" style="text-aling:center" width="150">
							<p align=center>
							<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><?=$uyead?></a>
							
							
							</p>
						</td>
						<td class="first style1" style="text-aling:center">
							<?=$icerikk?>
                            <br />
                            <?=stripslashes($icerik)?>
						</td>
						<td class="first style1" style="text-aling:center" width="50">
							<p align="center">
							<a href="javascript:onayla(<?=$id?>)" title="Onayla"><img src="img/add-icon.gif" border="0" /></a> 
							<a href="javascript:sil(<?=$id?>)" title="Reddet"><img src="img/hr.gif" border="0" /></a> 
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
			<div class="box">Duvar bekleyen i�erikleri bu alanda bulunmaktad�r.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>