<?

$islem = $_GET["islem"];

if($islem == "uye"){
	
	$sure = $_POST["sure"];
	
	$adet = $_POST["adet"];
	
	$zaman = @mktime();
	
	$ekle = (60 * $sure) + $zaman;
	
	$result = mysql_query("select id, kullanici, cinsiyet, dogum, sehir, oncelik, seviye from "._MX."uye order by rand() limit $adet");
	
	
	while(list($id, $kullanici, $cinsiyet, $dogum, $sehir, $oncelik, $seviye) = mysql_fetch_row($result)){
	
	
	list($seviyead, $seviyeicon, $renk, $oncelik) = mysql_fetch_row(mysql_query("select ad, icon, renk, oncelik from "._MX."seviye where id='$seviye'"));
	

			$resultonline = mysql_query("select count(uye) from "._MX."online where uye='$id'");
			
			list($online) = mysql_fetch_row($resultonline);	
						
			if($online >= 1){
			
				mysql_query("delete from "._MX."online where uye='$id'");
				
			}
			
			$yas = (date("Y")-date("Y", $dogum));
			
			$oncelik = $cinsiyet * $oncelik;
			
			mysql_query("insert into "._MX."online values('$id', '$kullanici', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$oncelik', '$ekle')");
			
	}	
	
	die("ok");
			
}
else if($islem == "bot"){
	
	$sure = $_POST["sure"];
	
	$adet = $_POST["adet"];
	
	$zaman = @mktime();
	
	$ekle = (60 * $sure) + $zaman;
	
	$result = mysql_query("select id, kullanici, cinsiyet, dogum, sehir, oncelik, seviye from "._MX."uye where bot='1' order by rand() limit $adet");
	
	
	while(list($id, $kullanici, $cinsiyet, $dogum, $sehir, $oncelik, $seviye) = mysql_fetch_row($result)){
	
	
	list($seviyead, $seviyeicon, $renk, $oncelik) = mysql_fetch_row(mysql_query("select ad, icon, renk, oncelik from "._MX."seviye where id='$seviye'"));
	

			$resultonline = mysql_query("select count(uye) from "._MX."online where uye='$id'");
			
			list($online) = mysql_fetch_row($resultonline);	
						
			if($online >= 1){
			
				mysql_query("delete from "._MX."online where uye='$id'");
				
			}
				
			$yas = (date("Y")-date("Y", $dogum));
			
			$oncelik = $cinsiyet * $oncelik;
					
			mysql_query("insert into "._MX."online values('$id', '$kullanici', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$oncelik', '$ekle')");
			
	}	
	
	die("ok");
			
}
else if($islem == "nick"){
	
	$sure = $_POST["sure"];
	
	$uyeler = $_POST["adet"];
	
	$zaman = @mktime();
	
	$ekle = (60 * $sure) + $zaman;
	
	
	$uyeler = explode(",", $uyeler);
	
	$sayi = count($uyeler);
	
	for($i = 0; $i < $sayi; $i++){
	
		$uye = trim($uyeler[$i]);
		
		if($uye){
		
			$result = mysql_query("select id, kullanici, cinsiyet, dogum, sehir, oncelik, seviye from "._MX."uye where kullanici='$uye'");
			
			
			list($id, $kullanici, $cinsiyet, $dogum, $sehir, $oncelik, $seviye) = mysql_fetch_row($result);
			
			if($id){
			
				list($seviyead, $seviyeicon, $renk, $oncelik) = mysql_fetch_row(mysql_query("select ad, icon, renk, oncelik from "._MX."seviye where id='$seviye'"));
				
			
						$resultonline = mysql_query("select count(uye) from "._MX."online where uye='$id'");
						
						list($online) = mysql_fetch_row($resultonline);	
									
						if($online >= 1){
						
							mysql_query("delete from "._MX."online where uye='$id'");
							
						}
								
						$yas = (date("Y")-date("Y", $dogum));
								
						$oncelik = $cinsiyet * $oncelik;
						
						mysql_query("insert into "._MX."online values('$id', '$kullanici', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$oncelik', '$ekle')");
					
			}
		
		}
		
	
	}
	die("ok");
			
}
else {
list($sitesure) = mysql_fetch_row(mysql_query("select sure from "._MX."ayarlar"));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Online Yap | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
		
		function onlineuye(){
			
			var sure = $("#sure").val();
			
			var uye = $("#uye").val();
			
			if(sure == ""){
				alert("Online süresini yazmadýnýz");
			}
			else if(uye == ""){
				alert("Yapýlacak üye sayýsýný yazmadýnýz");
			}
			else {
			
				$("#sonuc1").html("<img src='img/loading.gif' /> <font color=green><b>Bekleyin</b></font>");
				
				jQuery.ajax({
					type: 'POST', 
					url: 'index.php?sayfa=online&islem=uye',
					data: "sure="+sure+"&adet="+uye,
					success: function(sonuc){
						if(sonuc == "ok"){
							$("#sonuc1").html("<font color=green><b>"+uye+" adet üye online yapýldý.</b></font>");
						}
						else {
							$("#sonuc1").html("<font color=red><b>Sistem hatasý sonra tekrar deneyin.</b></font>");
						}
					}
					
				})
			}
		
		}

		function onlinebot(){
			
			var sure = $("#sure").val();
			
			var uye = $("#bot").val();
			
			if(sure == ""){
				alert("Online süresini yazmadýnýz");
			}
			else if(uye == ""){
				alert("Yapýlacak bot sayýsýný yazmadýnýz");
			}
			else {
			
				$("#sonuc2").html("<img src='img/loading.gif' /> <font color=green><b>Bekleyin</b></font>");
				
				jQuery.ajax({
					type: 'POST', 
					url: 'index.php?sayfa=online&islem=bot',
					data: "sure="+sure+"&adet="+uye,
					success: function(sonuc){
						if(sonuc == "ok"){
							$("#sonuc2").html("<font color=green><b>"+uye+" adet bot online yapýldý.</b></font>");
						}
						else {
							$("#sonuc2").html("<font color=red><b>Sistem hatasý sonra tekrar deneyin.</b></font>");
						}
					}
					
				})
			}
		
		}


		function onlinenick(){
			
			var sure = $("#sure").val();
			
			var uye = $("#nickler").val();
			
			if(sure == ""){
				alert("Online süresini yazmadýnýz");
			}
			else if(uye == ""){
				alert("Yapýlacak üye yazmadýnýz");
			}
			else {
			
				$("#sonuc3").html("<img src='img/loading.gif' /> <font color=green><b>Bekleyin</b></font>");
				
				jQuery.ajax({
					type: 'POST', 
					url: 'index.php?sayfa=online&islem=nick',
					data: "sure="+sure+"&adet="+uye,
					success: function(sonuc){
						if(sonuc == "ok"){
							$("#sonuc3").html("<font color=green><b>Üyeler online yapýldý.</b></font>");
						}
						else {
							$("#sonuc3").html("<font color=red><b>Sistem hatasý sonra tekrar deneyin.</b></font>");
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
<? include("menu/bot.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Online Yap</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Online Süresi</strong></td>
						<td class="last"><input type="text" name="sure" id="sure" class="text" value="<?=$sitesure?>" style="width:50px" /> * Online olarak kalacaklarý süre (Dakika cinsinden sýnýr yok)</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Üye Online</strong></td>
						<td class="last"><br><br><input type="text" name="uye" id="uye" class="text" style="width:50px" /> <input type="submit" value=" Online Yap " onclick="onlineuye()" /> * Kenara yazdýðýnýz üye kadar rastgele üye seçilerek online yapýlýr<br><br><span id="sonuc1"></span><br><br></td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Bot Online</strong></td>
						<td class="last"><br><br><input type="text" name="bot" id="bot" class="text" style="width:50px" /> <input type="submit" value=" Online Yap " onclick="onlinebot()" /> * Kenara yazdýðýnýz bot kadar rastgele bot seçilerek online yapýlýr<br><br><span id="sonuc2"></span><br><br></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Üye Nickleri</strong></td>
						<td class="last"><textarea name="nickler" id="nickler" class="textarea" cols="60" rows="6"></textarea> <p><input type="submit" value=" Online Yap " onclick="onlinenick()" /> * Aralarýna virgül koyarak yazýnýz (Sýnýr yoktur). Yazdýðýnýz nicklerin doðru oldugundan emin olun. </p><br><br><span id="sonuc3"></span><br><br></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Genel site ayarlarý bu bölümden yapýlmaktadýr. Ayarlarý doðru yaptýgýnýzdan emin olunuz. Sitenin çalýþmasýný etkileyebilir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>