<?php
function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}
	$islem = $_GET["islem"];

	$limit = 20; 
	
	if($islem == "yeni"){

		$uyeadi = $_POST["uyeadi"];
		
		$uyeadi = turkce($uyeadi);
		
		
		list($uyeid, $cinsiyet, $dogum, $sehir, $img, $oncelik) = mysql_fetch_row(mysql_query("select id, cinsiyet, dogum, sehir, img, oncelik from "._MX."uye where kullanici='$uyeadi'"));
		
		
		if(!$uyeid) die("hata");
		
		$hafta = date("W");
		
		$yil = date("Y");
		
		
		$result = mysql_query("insert into "._MX."uye_hafta values(NULL, '$uyeid', '$uyeadi', '$cinsiyet', '$dogum', '$sehir', '$img', '$oncelik', '$hafta', '$yil', '1')");
		
		
		if($result) die("ok");
		else die("hata");
		
	}
	else if($islem == "sil"){

		$id = $_POST["id"];
				
		$result = mysql_query("delete from "._MX."uye_hafta where uye='$id'");
		
		
		if($result) die("ok");
		else die("hata");
		
	}
	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Haftanýn Üyeleri | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
function uyeekle(){
	var uyeadi = document.getElementById('uyeadi').value;

	
	$("#uyeeklesonuc").html("<img src='img/loading.gif' /> <font color=green size=1>Lütfen Bekleyin...</font>");
	
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=haftaninuyeleri&islem=yeni',
					data : "uyeadi="+uyeadi,
					success: function(sonuc){		
						if(sonuc == "ok"){
							$("#uyeeklesonuc").html("<font color=green size=1>Baþarýyla eklendi.</font>");
						}
						else {
							$("#uyeeklesonuc").html("<font color=green size=1>Þuan ekleme yapýlamýyor.</font>");
						}
								
					}
				})
}

function uyeyisil(uye){
	var onayla = confirm("Silmek istediðinizden emin misiniz?");
	if(onayla){
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=haftaninuyeleri&islem=sil',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
				$("#uyesonuc"+uye).hide();
				}
				else {
					alert("Üye silinemedi, tekrar deneyin");
				}	
			}
		})
	}
}
</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/uye.php"); ?>
		<div id="center-column">
		  <div class="select-bar">
			<label>
			<b>Yeni Üye Ekle :</b> 
			</label>
		    <label>
		    <input type="text" name="uyeadi" id="uyeadi" size="14" class="inputlar" />
		    </label>
		    <label>
			<input type="submit" name="Submit" value=" Ekle " onclick="uyeekle()" /> <span id="uyeeklesonuc">* Üyenin tam nickini yazýnýz !</span>
			</label>
		 </div>
		  
			<div class="table" id="uyeyukle">
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Kullanýcý Adý</th>
						<th>Cinsiyet</th>
						<th>Þehir</th>
						<th>Doðum</th>
						<th class="last">Ýþlem</th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?
					
						$hafta = date("W");
						
						$yil = date("Y");
						
						$result = mysql_query("select uye, uyead, cinsiyet, dogum, sehir from "._MX."uye_hafta where hafta='$hafta' and yil='$yil'");

						while(list($id, $kullanici, $cinsiyet, $dogum, $sehir) = mysql_fetch_row($result)){
						
						$cinsiyet = cinsiyet($cinsiyet);
						
						$dogum = date("d.m.Y", $dogum);
					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$id?>', '500', '600', 'profilpopup<?=$id?>', 2, 1, 1);"><?=$kullanici?></a> </td>
						<td><?=$cinsiyet?></td>
						<td><?=$sehir?></td>
						<td><?=$dogum?></td>
						<td class="last">
						<a href="javascript:void(0);" onclick="uyeyisil(<?=$id?>)" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>
						</td>
					</tr>
					
					<?
						}
					?>
					</div>
				</table>
			</div>
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan yeni haftanýn üyesi ekleyebilir ve mevcut üyeleri silebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?
}
?>
