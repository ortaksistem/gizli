<?

$islem = $_GET["islem"];

if($islem == "baslat"){
	
	$adet = $_POST["adet"];
	$cins1 = $_POST["cins1"];
	$cins2 = $_POST["cins2"];
	$cins3 = $_POST["cins3"];
	$cins4 = $_POST["cins4"];
	$cins5 = $_POST["cins5"];
	$cins6 = $_POST["cins6"];
	$cins7 = $_POST["cins7"];
	$cins8 = $_POST["cins8"];
	$yas1 = $_POST["yas1"];
	$yas2 = $_POST["yas2"];
	$ulke = $_POST["ulke"];
	
	$cinstoplam = $cins1+$cins2+$cins3+$cins4+$cins5+$cins6+$cins7+$cins8;
	
	if($cinstoplam > $adet) die("hata1");
	
	
	$eklendi = 0;
	
	$yas = rand($yas1, $yas2);
		
	$sifre = sifreleme("123456");
	
	$ip = $_SERVER["REMOTE_ADDR"];
	
	list($ulkeadi) = mysql_fetch_row(mysql_query("select adi from "._MX."ulkeler where id='$ulke'"));
	
	list($seviye) = mysql_fetch_row(mysql_query("select seviye from "._MX."ayarlar"));
	
	list($seviyeoncelik) = mysql_fetch_row(mysql_query("select oncelik from "._MX."seviye where id='$seviye'"));
	
	if($cins1 >= 1){
		
		for($i = 1; $i <= $cins1; $i++){
			
			$cinsiyet = 1;
			
			$oncelik = $cinsiyet * $seviyeoncelik;
			
			$simdi = time(();
			
			$yas = rand($yas1, $yas2);
			
			$yas = time((0,0,0, rand(1, 12), rand(1,30), date("Y")-$yas);
			
			list($sehiradi) = mysql_fetch_row(mysql_query("select adi from "._MX."sehirler where ulke='$ulke' order by rand() limit 1"));
			
			list($isim) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='1' order by rand() limit 1"));
			
			list($img) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='3' order by rand() limit 1"));
			
			$kod = rand(100, 999);
			
			$isim = $isim ."". $kod;
			
			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
			$maxid++;
			
			$girdir = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, img, topresim, tanitim, tanitimonay, sononline, sononline2, girissayisi, ip, kayit, oncelik, seviye, bot, durum) values('$maxid', '$isim', '$sifre', '".$isim."@hotmaill.com', '$isim', '$isim', '123-4567890', '$yas', '$cinsiyet', '$ulkeadi', '$sehiradi', '$img', '1', '$isim', '1', '$simdi', '$simdi', '1', '$ip', '$simdi', '$oncelik', '$seviye', '1', '1')");
			
			
			if($girdir){
			
				$eklendi++;
				mysql_query("insert into "._MX."uye_resim values(NULL, '$maxid', '$img', '1', '$simdi', '1')");
				
			}
			
			$girdir = NULL;
		
		}
	
	}

	if($cins2 >= 1){
		
		for($i = 1; $i <= $cins2; $i++){
			
			$cinsiyet = 2;
			
			$oncelik = $cinsiyet * $seviyeoncelik;
			
			$simdi = time(();
			
			$yas = rand($yas1, $yas2);
			
			$yas = time((0,0,0, rand(1, 12), rand(1,30), date("Y")-$yas);
			
			list($sehiradi) = mysql_fetch_row(mysql_query("select adi from "._MX."sehirler where ulke='$ulke' order by rand() limit 1"));
			
			list($isim) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='1' order by rand() limit 1"));
			
			list($isim2) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='2' order by rand() limit 1"));
			
			list($img) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='3' order by rand() limit 1"));
			
			$kod = rand(10, 99);
			
			$isim = $isim ."". $isim2 ."". $kod;

			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
			$maxid++;
						
			$girdir = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, img, topresim, tanitim, tanitimonay, sononline, sononline2, girissayisi, ip, kayit, oncelik, seviye, bot, durum) values('$maxid', '$isim', '$sifre', '".$isim."@hotmaill.com', '$isim', '$isim', '123-4567890', '$yas', '$cinsiyet', '$ulkeadi', '$sehiradi', '$img', '1', '$isim', '1', '$simdi', '$simdi', '1', '$ip', '$simdi', '$oncelik', '$seviye', '1', '1')");
			
			
			if($girdir){
			
				$eklendi++;
				mysql_query("insert into "._MX."uye_resim values(NULL, '$maxid', '$img', '1', '$simdi', '1')");
				
			}
			
			$girdir = NULL;
		
		}
	
	}
	

	if($cins3 >= 1){
		
		for($i = 1; $i <= $cins3; $i++){
			
			$cinsiyet = 3;
			
			$oncelik = $cinsiyet * $seviyeoncelik;
			
			$simdi = time(();
			
			$yas = rand($yas1, $yas2);
			
			$yas = time((0,0,0, rand(1, 12), rand(1,30), date("Y")-$yas);
			
			list($sehiradi) = mysql_fetch_row(mysql_query("select adi from "._MX."sehirler where ulke='$ulke' order by rand() limit 1"));
			
			list($isim) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='2' order by rand() limit 1"));
						
			list($img) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='4' order by rand() limit 1"));
			
			$kod = rand(100, 999);
			
			$isim = $isim ."". $kod;

			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
			$maxid++;
			
			$girdir = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, img, topresim, tanitim, tanitimonay, sononline, sononline2, girissayisi, ip, kayit, oncelik, seviye, bot, durum) values('$maxid', '$isim', '$sifre', '".$isim."@hotmaill.com', '$isim', '$isim', '123-4567890', '$yas', '$cinsiyet', '$ulkeadi', '$sehiradi', '$img', '1', '$isim', '1', '$simdi', '$simdi', '1', '$ip', '$simdi', '$oncelik', '$seviye', '1', '1')");
			
			
			if($girdir){
			
				$eklendi++;
				mysql_query("insert into "._MX."uye_resim values(NULL, '$maxid', '$img', '1', '$simdi', '1')");
				
			}
			
			$girdir = NULL;
		
		}
	
	}

	if($cins4 >= 1){
		
		for($i = 1; $i <= $cins4; $i++){
			
			$cinsiyet = 4;
			
			$oncelik = $cinsiyet * $seviyeoncelik;
			
			$simdi = time(();
			
			$yas = rand($yas1, $yas2);
			
			$yas = time((0,0,0, rand(1, 12), rand(1,30), date("Y")-$yas);
			
			list($sehiradi) = mysql_fetch_row(mysql_query("select adi from "._MX."sehirler where ulke='$ulke' order by rand() limit 1"));
			
			list($isim) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='1' order by rand() limit 1"));
			
			list($img) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='3' order by rand() limit 1"));
			
			$kod = rand(100, 999);
			
			$isim = $isim ."". $kod;

			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
			$maxid++;
			
			$girdir = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, img, topresim, tanitim, tanitimonay, sononline, sononline2, girissayisi, ip, kayit, oncelik, seviye, bot, durum) values('$maxid', '$isim', '$sifre', '".$isim."@hotmaill.com', '$isim', '$isim', '123-4567890', '$yas', '$cinsiyet', '$ulkeadi', '$sehiradi', '$img', '1', '$isim', '1', '$simdi', '$simdi', '1', '$ip', '$simdi', '$oncelik', '$seviye', '1', '1')");
			
			
			if($girdir){
			
				$eklendi++;
				mysql_query("insert into "._MX."uye_resim values(NULL, '$maxid', '$img', '1', '$simdi', '1')");
				
			}
			
			$girdir = NULL;
		
		}
	
	}

	if($cins5 >= 1){
		
		for($i = 1; $i <= $cins5; $i++){
			
			$cinsiyet = 5;
			
			$oncelik = $cinsiyet * $seviyeoncelik;
			
			$simdi = time(();
			
			$yas = rand($yas1, $yas2);
			
			$yas = time((0,0,0, rand(1, 12), rand(1,30), date("Y")-$yas);
			
			list($sehiradi) = mysql_fetch_row(mysql_query("select adi from "._MX."sehirler where ulke='$ulke' order by rand() limit 1"));
			
			list($isim) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='1' order by rand() limit 1"));
			
			list($img) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='3' order by rand() limit 1"));
			
			$kod = rand(100, 999);
			
			$isim = $isim ."". $kod;

			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
			$maxid++;
						
			$girdir = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, img, topresim, tanitim, tanitimonay, sononline, sononline2, girissayisi, ip, kayit, oncelik, seviye, bot, durum) values('$maxid', '$isim', '$sifre', '".$isim."@hotmaill.com', '$isim', '$isim', '123-4567890', '$yas', '$cinsiyet', '$ulkeadi', '$sehiradi', '$img', '1', '$isim', '1', '$simdi', '$simdi', '1', '$ip', '$simdi', '$oncelik', '$seviye', '1', '1')");
			
			
			if($girdir){
			
				$eklendi++;
				mysql_query("insert into "._MX."uye_resim values(NULL, '$maxid', '$img', '1', '$simdi', '1')");
				
			}
			
			$girdir = NULL;
		
		}
	
	}
	
	if($cins6 >= 1){
		
		for($i = 1; $i <= $cins6; $i++){
			
			$cinsiyet = 6;
			
			$oncelik = $cinsiyet * $seviyeoncelik;
			
			$simdi = time(();
			
			$yas = rand($yas1, $yas2);
			
			$yas = time((0,0,0, rand(1, 12), rand(1,30), date("Y")-$yas);
			
			list($sehiradi) = mysql_fetch_row(mysql_query("select adi from "._MX."sehirler where ulke='$ulke' order by rand() limit 1"));
			
			list($isim) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='1' order by rand() limit 1"));
			
			list($isim2) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='2' order by rand() limit 1"));
			
			list($img) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='3' order by rand() limit 1"));
			
			$kod = rand(10, 99);
			
			$isim = $isim ."". $isim2 ."". $kod;

			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
			$maxid++;
					
			$girdir = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, img, topresim, tanitim, tanitimonay, sononline, sononline2, girissayisi, ip, kayit, oncelik, seviye, bot, durum) values('$maxid', '$isim', '$sifre', '".$isim."@hotmaill.com', '$isim', '$isim', '123-4567890', '$yas', '$cinsiyet', '$ulkeadi', '$sehiradi', '$img', '1', '$isim', '1', '$simdi', '$simdi', '1', '$ip', '$simdi', '$oncelik', '$seviye', '1', '1')");
			
			
			if($girdir){
			
				$eklendi++;
				mysql_query("insert into "._MX."uye_resim values(NULL, '$maxid', '$img', '1', '$simdi', '1')");
				
			}
			
			$girdir = NULL;
		
		}
	
	
	}
	
	if($cins7 >= 1 or $cins8 >= 1){
		
		for($i = 1; $i <= $cins7; $i++){
			
			$cinsiyet = 7;
			
			$oncelik = $cinsiyet * $seviyeoncelik;
			
			$simdi = time(();
			
			$yas = rand($yas1, $yas2);
			
			$yas = time((0,0,0, rand(1, 12), rand(1,30), date("Y")-$yas);
			
			list($sehiradi) = mysql_fetch_row(mysql_query("select adi from "._MX."sehirler where ulke='$ulke' order by rand() limit 1"));
			
			list($isim) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='2' order by rand() limit 1"));
						
			list($img) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='4' order by rand() limit 1"));
			
			$kod = rand(100, 999);
			
			$isim = $isim ."". $kod;

			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
			$maxid++;
					
			$girdir = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, img, topresim, tanitim, tanitimonay, sononline, sononline2, girissayisi, ip, kayit, oncelik, seviye, bot, durum) values('$maxid', '$isim', '$sifre', '".$isim."@hotmaill.com', '$isim', '$isim', '123-4567890', '$yas', '$cinsiyet', '$ulkeadi', '$sehiradi', '$img', '1', '$isim', '1', '$simdi', '$simdi', '1', '$ip', '$simdi', '$oncelik', '$seviye', '1', '1')");
			
			
			if($girdir){
			
				$eklendi++;
				mysql_query("insert into "._MX."uye_resim values(NULL, '$maxid', '$img', '1', '$simdi', '1')");
				
			}
			
			$girdir = NULL;
		
		}
		
		for($i = 1; $i <= $cins8; $i++){
			
			$cinsiyet = 8;
			
			$oncelik = $cinsiyet * $seviyeoncelik;
			
			$simdi = time(();
			
			$yas = rand($yas1, $yas2);
			
			$yas = time((0,0,0, rand(1, 12), rand(1,30), date("Y")-$yas);
			
			list($sehiradi) = mysql_fetch_row(mysql_query("select adi from "._MX."sehirler where ulke='$ulke' order by rand() limit 1"));
			
			list($isim) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='2' order by rand() limit 1"));
						
			list($img) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='4' order by rand() limit 1"));
			
			$kod = rand(100, 999);
			
			$isim = $isim ."". $kod;

			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
			$maxid++;
						
			$girdir = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, img, topresim, tanitim, tanitimonay, sononline, sononline2, girissayisi, ip, kayit, oncelik, seviye, bot, durum) values('$maxid', '$isim', '$sifre', '".$isim."@hotmaill.com', '$isim', '$isim', '123-4567890', '$yas', '$cinsiyet', '$ulkeadi', '$sehiradi', '$img', '1', '$isim', '1', '$simdi', '$simdi', '1', '$ip', '$simdi', '$oncelik', '$seviye', '1', '1')");
			
			if($girdir){
			
				$eklendi++;
				
				mysql_query("insert into "._MX."uye_resim values(NULL, '$maxid', '$img', '1', '$simdi', '1')");
				
			}
			
			$girdir = NULL;
		
		}
	
	}		
	
	
	
	$kalan = $adet - $eklendi;
	
	if($kalan >= 1){
	
		for($i = 1; $i <= $kalan; $i++){
			
			$cinsiyet = rand(1,8);
			
			$oncelik = $cinsiyet * $seviyeoncelik;
			
			$simdi = time(();
			
			$yas = rand($yas1, $yas2);
			
			$yas = time((0,0,0, rand(1, 12), rand(1,30), date("Y")-$yas);
			
			list($sehiradi) = mysql_fetch_row(mysql_query("select adi from "._MX."sehirler where ulke='$ulke' order by rand() limit 1"));
			
			switch($cinsiyet){
				case "1":
				case "2":
				case "4":
				case "5":
				case "6":
				$tur = 1;
				$tur2 = 3;
				break;
				default:
				$tur = 2;
				$tur2 = 4;
				break;
			}
			
			list($isim) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='$tur' order by rand() limit 1"));
						
			list($img) = mysql_fetch_row(mysql_query("select icerik from "._MX."botveritabani where tur='$tur2' order by rand() limit 1"));
			
			$kod = rand(100, 999);
			
			$isim = $isim ."". $kod;

			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
			$maxid++;
						
			$girdir = mysql_query("insert into "._MX."uye (id, kullanici, sifre, email, ad, soyad, tel, dogum, cinsiyet, ulke, sehir, img, topresim, tanitim, tanitimonay, sononline, sononline2, girissayisi, ip, kayit, oncelik, seviye, bot, durum) values('$maxid', '$isim', '$sifre', '".$isim."@hotmaill.com', '$isim', '$isim', '123-4567890', '$yas', '$cinsiyet', '$ulkeadi', '$sehiradi', '$img', '1', '$isim', '1', '$simdi', '$simdi', '1', '$ip', '$simdi', '$oncelik', '$seviye', '1', '1')");
			
			if($girdir){
			
				$eklendi++;
				
				mysql_query("insert into "._MX."uye_resim values(NULL, '$maxid', '$img', '1', '$simdi', '1')");
				
			}
			
			$girdir = NULL;
		
		}
			
	
	} 
	
	if($eklendi >= 1){
		die("ok");
	}

}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Üye Üretici Powered By MahiriX :) | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
		function baslat(){
			
			var adet = $("#adet").val();
			var cins1 = $("#cins1").val();
			var cins2 = $("#cins2").val();
			var cins3 = $("#cins3").val();
			var cins4 = $("#cins4").val();
			var cins5 = $("#cins5").val();
			var cins6 = $("#cins6").val();
			var cins7 = $("#cins7").val();
			var cins8 = $("#cins8").val();
			var ulke = $("#ulke").val();
			var yas1 = $("#yas1").val();
			var yas2 = $("#yas2").val();

			if(adet == ""){
				alert("Lütfen kaç üye ekleneceðini yazýnýz");
			}
			else {
				
				$("#sonuc").html("<img src='img/loading.gif' /> Bekleyin...");
				
				jQuery.ajax({
					type: 'POST',
					url: 'index.php?sayfa=uyeyaratici&islem=baslat',
					data: 'adet='+adet+'&cins1='+cins1+'&cins2='+cins2+'&cins3='+cins3+'&cins4='+cins4+'&cins5='+cins5+'&cins6='+cins6+'&cins7='+cins7+'&cins8='+cins8+'&yas1='+yas1+'&yas2='+yas2+'&ulke='+ulke,
					success: function(sonuc){
						if(sonuc == "hata1"){
							alert("Lütfen cinsiyet sayýlarýný kontrol ediniz");
							$("#sonuc").html("");
						}
						else {
							alert(""+adet+" adet üye baþarýyla eklenmiþtir.");
							$("#sonuc").html("");		
							document.yaraticiform.reset();					
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
		<form action="javascript:void(0)" method="post" name="yaraticiform">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Üye Yaratýcý</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Kaç üye olsun</strong></td>
						<td class="last"><input type="text" name="adet" id="adet" class="text" style="width:50px" /> * Kaç adet üye eklenmesini istiyorsanýz o sayýyý yazýn. Bir seferde kasmamasý için 1000 adetten fazla girip lamerlik yapmayýn.</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cinsiyet Bayan</strong></td>
						<td class="last"><input type="text" name="cins1" id="cins1" class="text" style="width:50px" /> * Kaç adet belirlenen cinsiyetten olsun. Cinsiyet sayýlarý toplamý ana sayýdan büyük olmamalýdýr. Tüm cinsiyetleri boþ seçerseniz ya yada verdiðiniz cinsiyet sayýlarý toplamý ana sayýdan küçük olursa kalan cinsiyetler random çekilir !</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cinsiyet Çift</strong></td>
						<td class="last"><input type="text" name="cins2" id="cins2" class="text" style="width:50px" /> </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cinsiyet Erkek</strong></td>
						<td class="last"><input type="text" name="cins3" id="cins3" class="text" style="width:50px" /> </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cinsiyet Lezbiyen</strong></td>
						<td class="last"><input type="text" name="cins4" id="cins4" class="text" style="width:50px" /> </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cinsiyet Biseksüel Bayan</strong></td>
						<td class="last"><input type="text" name="cins5" id="cins5" class="text" style="width:50px" /> </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cinsiyet Biseksüel Çift</strong></td>
						<td class="last"><input type="text" name="cins6" id="cins6" class="text" style="width:50px" /> </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cinsiyet Biseksüel Erkek</strong></td>
						<td class="last"><input type="text" name="cins7" id="cins7" class="text" style="width:50px" /> </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Cinsiyet Transseksüel</strong></td>
						<td class="last"><input type="text" name="cins8" id="cins8" class="text" style="width:50px" /> </td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Yaþ Aralýðý</strong></td>
						<td class="last">
							<select name="yas1" id="yas1" class="text">
								<?php for($i = 18; $i < 45; $i++) echo "<option value=$i>$i</option>"; ?>
							</select> ile 
							<select name="yas2" id="yas2" class="text">
								<?php for($i = 50; $i > 18; $i--) echo "<option value=$i>$i</option>"; ?>
							</select>
						</td>
					</tr>	
					<tr>
						<td class="first" width="172"><strong>Ülkesi</strong></td>
						<td class="last">
							<select name="ulke" id="ulke" class="text">
								<?php
									$result = mysql_query("select id, adi from "._MX."ulkeler");
									
									while(list($id, $adi) = mysql_fetch_row($result)){
										if($id == 214) echo "<option value=$id selected>$adi</option>";
										else echo "<option value=$id>$adi</option>";
									
									}
								
								?>
							</select> * Seçitðiniz ülkeye göre sehirler random çekilecektir.
						</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Üye Eklemeyi Baþlat " onclick="baslat()" /> <span id="sonuc"></span></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu bölümden basit seçim yaparak hýzlý bot üye oluþturabilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>