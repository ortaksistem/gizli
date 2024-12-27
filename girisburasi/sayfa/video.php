<?php
function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}
	$islem = $_GET["islem"];

	$limit = 20; 
	
	if($islem == "sil"){
		
		$id = $_POST["id"];
		
		list($dosya) = mysql_fetch_row(mysql_query("select dosya from "._MX."video where id='$id'"));
		
		
		if(@file_exists("../video/files/$dosya")){
			@unlink("../video/files/$dosya");
		}
		
		$result = mysql_query("delete from "._MX."video where id='$id'");
		if($result) die("ok");
		else die("hata");
		
		

		
	}
	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Tüm Videolar | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">


function dosyasil(uye){
	var onayla = confirm("Silmek istediğinizden emin misiniz?");
	if(onayla){
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=video&islem=sil',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
				$("#videosonuc"+uye).hide();
				}
				else {
					alert("Video silinemedi, tekrar deneyin");
				}	
			}
		})
	}
}

function sayfa(sayfa){
	
	window.location = 'index.php?sayfa=video&p='+sayfa;
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
						<th class="first" width="177">Kullanıcı Adı</th>
						<th>Video Url/İndir</th>
						<th>Eklenme Tarihi</th>
						<th>Durum</th>
						<th class="last">İşlem</th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?
					
						$limit = 20;
						$p = $_GET["p"];
						if(!$p) $p = 1;
						$p = intval($p);
						
						
						$result = mysql_query("select id from "._MX."video");
						$sayi = mysql_num_rows($result);
						$toplamsayfa = ceil(($sayi/$limit));
						
						
						$result = mysql_query("select id, uye, dosya, kayit, durum from "._MX."video order by id desc limit ".(($p-1)*$limit).",".$limit."");

						while(list($id, $uye, $dosya, $kayit, $durum) = mysql_fetch_row($result)){
						
						list($kullanici) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$uye'"));
						
						$kayit = date("d.m.Y H:i", $kayit);
						
						if($durum == 1) $durum = "<font color=green>Eklendi</font>";
						else $durum = "<font color=red>Bekliyor</font>";
						
					?>
					<tr id="videosonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><?=$kullanici?></a> </td>
						<td><a href="../video/files/<?=$dosya?>"><?=$dosya?></a></td>
						<td><?=$kayit?></td>
						<td><?=$durum?></td>
						<td class="last">
						<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=videoduzenle&id=<?=$id?>', '500', '600', 'videopopup<?=$id?>', 2, 1, 1);"><img src="img/edit-icon.gif" width="16" height="16" /></a>
						<a href="javascript:void(0);" onclick="dosyasil(<?=$id?>)" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>
						</td>
					</tr>
					
					<?
						}
					?>
					</div>
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
			<div class="box">Bu alandan mevcut bekleyen videoları görebilir, dosyaları indirebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?
}
?>
