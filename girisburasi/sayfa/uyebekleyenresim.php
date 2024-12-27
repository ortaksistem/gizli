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
		
		list($uyeid, $anaresim, $durumabak) = mysql_fetch_row(mysql_query("select uye, ana, durum from "._MX."uye_resim where id='$id'"));
		
		if($durumabak == 1){
		
			mysql_query("update "._MX."uye set topresim=topresim-1 where id='$uyeid'");
		
		}
		
		list($resim) = mysql_fetch_row(mysql_query("select resim from "._MX."uye_resim where id='$id'"));
		
		@unlink("../$resim");
		
		$result = mysql_query("delete from "._MX."uye_resim where id='$id'");
		
		
		if($anaresim == 1){
		
			list($resimid, $resimurl) = mysql_fetch_row(mysql_query("select id, resim from "._MX."uye_resim where id='$id' and uye='$uyeid' and durum='1' order by rand() limit 1"));
			
			$uzanti = explode(".", $resimurl);
				
			$uzanti = $uzanti[count($uzanti)-1];
				
		
			$resimurl = str_replace("resim/", "resimthumb/", $resimurl);
				
			@copy("../".$resimurl, "../img_uye/avatar/$uyeid.$uzanti");
				
			mysql_query("update "._MX."uye set img='img_uye/avatar/$uyeid.$uzanti' where id='$uyeid'");
				
			mysql_query("update "._MX."uye_resim set ana='1' where id='$resimid'");	
				
		
		}
		
		if($result) die("ok");
		else die("hata");
}
else if($islem == "onayla"){
		$id = $_POST["id"];
		
		$result = mysql_query("update "._MX."uye_resim set durum='1' where id='$id'");
		
		list($uye) = mysql_fetch_row(mysql_query("select uye from "._MX."uye_resim where id='$id'"));
	
		list($uyeavatar) = mysql_fetch_row(mysql_query("select img from "._MX."uye where id='$uye'"));
		
		
		if(!$uyeavatar or $uyeavatar == "img_uye/avatar/null.jpg"){
		
			list($resimid, $resimurl) = mysql_fetch_row(mysql_query("select id, resim from "._MX."uye_resim where id='$id' and uye='$uye' and durum='1' order by rand() limit 1"));
			
				$uzanti = explode(".", $resimurl);
				
				$uzanti = $uzanti[count($uzanti)-1];
				
		
				$resimurl = str_replace("resim/", "resimthumb/", $resimurl);
				
				@copy("../".$resimurl, "../img_uye/avatar/$uye.$uzanti");
				
				mysql_query("update "._MX."uye set img='img_uye/avatar/$uye.$uzanti' where id='$uye'");
				
				mysql_query("update "._MX."uye_resim set ana='1' where id='$resimid'");
		
		
		}
		
		
		mysql_query("update "._MX."uye set topresim=topresim+1 where id='$uye'");


		if($result) die("ok");
		else die("hata");
}
else {
	
	$limit = 20; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Bekleyen Resimler | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery-eski.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
function sayfa(sayfa){
	
	window.location = 'index.php?sayfa=uyebekleyenresim&p='+sayfa;
}

function sil(uye, i){
	var onayla = confirm("Silmek istediðinizden emin misiniz?");
	if(onayla){
		$("#uyeid"+i).hide();
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=uyebekleyenresim&islem=sil',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
					
				}
				else {
					alert("Resim silinemedi tekrar deneyiniz");
				}
			}
		})
	}
}

function onayla(uye, i){
	
		$("#uyeid"+i).hide();
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=uyebekleyenresim&islem=onayla',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
					
				}
				else {
					alert("Resim onaylanamadý tekrar deneyiniz");
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
				<tr>
					<?
						
						$adminseviye = adminseviye();
						$p = $_GET["p"];
						if(!$p) $p = 1;
						$p = intval($p);
						
						$hafta = date("W");
						$yil = date("Y");
						
						$result = mysql_query("select id from "._MX."uye_resim where durum='2'");
						$sayi = mysql_num_rows($result);
						$toplamsayfa = ceil(($sayi/$limit));
						
						$i = 1;
						
						$result = mysql_query("select id, uye, resim, kayit from "._MX."uye_resim where durum='2' limit ".(($p-1)*$limit).",".$limit."");
						
						while(list($id, $uye, $resim, $zaman) = mysql_Fetch_row($result)){
						
						list($uyead, $cinsiyet, $sehir, $dogum, $img, $satissatis) = mysql_fetch_row(mysql_query("select kullanici, cinsiyet, sehir, dogum, img, satissatis from "._MX."uye where id='$uye'"));
						
						$img = uyeavatar($img, $cinsiyet);
						
						$cinsiyet = cinsiyet($cinsiyet);
						
						$dogum = $yil - date("Y", $dogum);
						
						$zaman = date("d.m.Y", $zaman);
						
						if($satissatis == 2 and $adminseviye != 2){
							$i--;
						}
						else if($satissatis == 2 and $adminseviye == 2){	
					?>

						
						<td id="uyeid<?=$i?>" class="first style1" style="text-aling:center">
							<p align=center><a href="javascript:void(0)" onclick="pencere('../<?=$resim?>', '500', '600', 'resimpopup<?=$uye?>', 2, 1, 1);"><img src="../<?=$resim?>" width="110" border="0" /></a></p>
							<p align=center>
							<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><?=$uyead?> - <?=$uyead?></a><br>
							<?=$cinsiyet?> - <?=$dogum?> Yaþ - <?=$sehir?><br><font color=black size=1><?=$zaman?> Tarihinde eklendi</font>
							
							</p>
							<p align="center">
							<a href="javascript:onayla(<?=$id?>, <?=$i?>)" title="Onayla"><img src="img/add-icon.gif" border="0" /></a> 
							<a href="javascript:sil(<?=$id?>, <?=$i?>)" title="Sil"><img src="img/hr.gif" border="0" /></a> 
							</p>
						</td>
					
					
					<?
						}
						else {
					?>

						
						<td id="uyeid<?=$i?>" class="first style1" style="text-aling:center">
							<p align=center><a href="javascript:void(0)" onclick="pencere('../<?=$resim?>', '500', '600', 'resimpopup<?=$uye?>', 2, 1, 1);"><img src="../<?=$resim?>" width="110" border="0" /></a></p>
							<p align=center>
							<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><?=$uyead?></a><br>
							<?=$cinsiyet?> - <?=$dogum?> Yaþ - <?=$sehir?><br><font color=black size=1><?=$zaman?> Tarihinde eklendi</font>
							
							</p>
							<p align="center">
							<a href="javascript:onayla(<?=$id?>, <?=$i?>)" title="Onayla"><img src="img/add-icon.gif" border="0" /></a> 
							<a href="javascript:sil(<?=$id?>, <?=$i?>)" title="Sil"><img src="img/hr.gif" border="0" /></a> 
							</p>
						</td>
					
					
					<?
						}
						
						
					
						if($i%4 == 0) echo "</tr><tr>";
						$i++;
						
						
						}
						
						
					?>
					</tr>
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
			<div class="box">Bekleyen profil resimlerini bu alandan onaylayabilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>