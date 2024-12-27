<?php
	
$islem = $_GET["islem"];
	
if($islem == "sil"){
	
	$id = $_POST["id"];
	
	$result = mysql_query("delete from "._MX."odeme where id='$id'");
	
	if(!$result) die("hata");
	else die("ok");
	
}
else if($islem == "onayla"){

		$id = $_POST["id"];
		
		list($uye, $seviye, $sure) = mysql_fetch_row(mysql_query("select uye, seviye, sure from "._MX."odeme where id='$id'"));
		
		list($uyecinsiyet, $uyezaman) = mysql_fetch_row(mysql_query("select cinsiyet, bitis from "._MX."uye where id='$uye'"));
		
		list($seviyeoncelik) = mysql_fetch_row(mysql_query("select oncelik from "._MX."seviye where id='$seviye'"));
		

		$birgun = 60*60*24; // 60 saniye 1 saat 60 dakika 1 gün 24 saat
		
		switch($sure){
			case "aylik"; $eklezaman = $birgun * 30;break;
			case "aylik3"; $eklezaman = $birgun * 90;break;
			case "aylik6"; $eklezaman = $birgun * 180;break;
			case "yillik"; $eklezaman = $birgun * 365;break;
			case "sinirsiz"; $eklezaman = 0;break;
		}
		
		
		$oncelik = $uyecinsiyet * $seviyeoncelik;
		
		if($sure == "sinirsiz"){

			$result = mysql_query("update "._MX."uye set bitis='0', oncelik='$oncelik', seviye='$seviye' where id='$uye'");		
		
		}
		else {
			
			$simdi = time();
			
			if($uyezaman > $simdi){
			
			$zaman = $uyezaman + $eklezaman;
		
			}
			
			else {
			
			$zaman = $simdi + $eklezaman;
			
			}
			
			$result = mysql_query("update "._MX."uye set bitis='$zaman', oncelik='$oncelik', seviye='$seviye' where id='$uye'");
			
			
		}
		
		$result = mysql_query("update "._MX."odeme set durum='1' where id='$id'");
	
		if(!$result) die("hata");
		else die("ok");
		
			
}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Bekleyen Havale Satýþlarý | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
	function sayfa(sayfa){
		
		window.location = 'index.php?sayfa=havale&p='+sayfa;
		
	}
	
	function sil(id){
		
		$("#uyesonuc"+id).hide();
		
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?sayfa=havale&islem=sil',
			data: 'id='+id,
			success: function(sonuc){
				if(sonuc == "hata") alert("Silinemedi sonra tekrar deneyin");
			}
			
		})
		
	}
	
	function onayla(id){
		
		$("#uyesonuc"+id).hide();
		
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?sayfa=havale&islem=onayla',
			data: 'id='+id,
			success: function(sonuc){
				if(sonuc == "hata") alert("Onaylanamadý sonra tekrar deneyin");
			}
			
		})
		
	}
</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/satislar.php"); ?>
		<div id="center-column">
			<div class="table">
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="80">Kullanýcý Adý</th>
						<th>Bilgiler</th>
						<th>Üyelik Tipi</th>
						<th>Süre</th>
						<th>Tutar</th>
						<th>Kayýt</th>
						<th class="last">Ýþlem</th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?
					
						$limit = 20;
						
						$p = $_GET["p"];
						
						if(!$p) $p = 1;
						
						$p = intval($p);
						
						$result = mysql_query("select count(id) from "._MX."odeme where tur='2' and durum='2'");
						
						list($sayi) = mysql_fetch_row($result);
						
						$toplamsayfa = ceil(($sayi/$limit));
						
						

						$result = mysql_query("select id, uye, ad, tel, mesaj, email, ip, tutar, seviye, sure, kayit from "._MX."odeme where tur='2' and durum='2' order by id desc limit ".(($p-1)*$limit).",".$limit."");

						while(list($id, $uye, $ad, $tel, $mesaj, $email, $ip, $tutar, $seviye, $sure, $kayit) = mysql_fetch_row($result)){
						
						
						list($uyead) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$uye'"));
						
						list($seviyead, $seviyerenk) = mysql_fetch_row(mysql_query("select ad, renk from "._MX."seviye where id='$seviye'"));
						
						$kayit = date("d.m.Y", $kayit);
						
						$mesaj = stripslashes($mesaj);
						
						switch($sure){
							case "aylik": $sure="1 Aylýk";break;
							case "aylik3": $sure="3 Aylýk";break;
							case "aylik6": $sure="6 Aylýk";break;
							case "yillik": $sure="Yýllýk";break;
							case "sinirsiz": $sure="Sýnýrsýz";break;
							default: $sure="Belirlenemedi";break;
						}
						
					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$uye?>', '500', '600', 'profilpopup<?=$uye?>', 2, 1, 1);"><font color="<?=$seviyerenk?>"><?=$uyead?></font></a> </td>
						<td>Ad : <?=$ad?><br>Tel : <?=$tel?><br>Email : <?=$email?><br>Ip : <?=$ip?><br>Mesaj : <?=$mesaj?></td>
						<td><font color="<?=$seviyerenk?>"><?=$seviyead?></font></td>
						<td><?=$sure?></td>
						<td><?=$tutar?> TL</td>
						<td><?=$kayit?></td>
						<td class="last">
						<a href="javascript:onayla(<?=$id?>)" title="Onayla"><img src="img/add-icon.gif" /></a> 
						<a href="javascript:sil(<?=$id?>)" title="Sil"><img src="img/hr.gif" /></a> 
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
							if($p == $i) echo "<option value=$i selected>$i. Sayfa</option>"; 
							else echo "<option value=$i>$i. Sayfa</option>"; 
							}
							?>
						</select>
					</div>
				</div>
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bekleyen havale satýþlarý bu alanda bulunmaktadýr. Bilgileri kontrol ederek onayla yada sil butonlarýný kullanýnýz. Sil dediðinizde veritabanýndan bilgi kaldýrýlýr.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>