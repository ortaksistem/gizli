<?php

error_reporting(0); // php errors

$islem = $_GET["islem"];

if($islem == "gonder"){

	$kacinci = $_POST["kacinci"];
	$toplamsayfa = $_POST["toplamsayfa"];
	
	if($toplamsayfa < $kacinci) die("tamamdir");
	
	$oy = $_POST["oy"];
	$hit = $_POST["hit"];
	$arkadas = $_POST["arkadas"];
	$cicek = $_POST["cicek"];
	$opucuk = $_POST["opucuk"];
	$baslik = $_POST["baslik"];
	$mesaj = $_POST["mesaj"];
	$email = $_POST["email"];
	$bot = $_POST["bot"];
	$botadi = $_POST["botadi"];
	$botcinsiyet = $_POST["botcinsiyet"];
	$botsehir = $_POST["botsehir"];
	$botimg = $_POST["botimg"];
	$botdogum = $_POST["botdogum"];
	$botoncelik = $_POST["botoncelik"];
	$hiz = $_POST["hiz"];
	$uyeler = $_POST["uyeler"];

		
	$botadi = turkce($botadi);
	$botsehir = turkce($botsehir);
	$mesaj = addslashes(turkce($mesaj));
	$baslik = addslashes(turkce($baslik));

	$zaman = @mktime();
	$zaman2 = date("Y-m-d");
				
	$parcala = explode(";", $uyeler);
	
	
	$i = $hiz * ($kacinci-1);
	
	$son = $i + $hiz;
	

	if($email == 2){
		
		
		include("../smtpdosyalar/SMTP.php");

		$gondereneposta = 'notice@yatakpartner.com'; // from (Gmail mail address)
		$gonderensifre = '1453tekin'; // Gmail password
		
		$smtpbaglan = SMTP::connect('smtp.com', 465, $gondereneposta, $gonderensifre, 'tls', 10) or die(print_r($_RESULT));

		list($siteadi, $siteurl) = mysql_fetch_row(mysql_query("select ad, url from "._MX."ayarlar"));
		
		
		
		
	}
	
	if($email == 3){

	function mail_gonder($mail, $konu, $mesaj){
	 $kod = "123456";
	 $ch = curl_init();
	 curl_setopt($ch, CURLOPT_URL, 'http://178.162.226.106/~mahirix/mailat.php');
	 curl_setopt($ch, CURLOPT_POSTFIELDS,'sifre='.$kod.'&mail='.$mail.'&konu='.urlencode($konu).'&mesaj='.urlencode($mesaj).'');
	 curl_setopt($ch, CURLOPT_POST, 1);
	 curl_setopt($ch, CURLOPT_REFERER, "http://www.mahirix.net");
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6 (.NET CLR 3.5.30729)");
	 curl_exec($ch); 
	 $site=curl_exec($ch);
			  
	 return $site;
	 
	}

	
	}
		
	for($i; $i < $son; $i++){
	
		$id = trim($parcala[$i]);
		
		
		list($kullanici, $sifre, $kemail, $ad, $soyad, $dogum, $cinsiyet, $ulke, $sehir) = mysql_fetch_row(mysql_query("select kullanici, sifre, email, ad, soyad, dogum, cinsiyet, ulke, sehir from "._MX."uye where id='$id'"));
		
		
		if(!$cinsiyet) $cinsiyet = rand(1,8);	
		
		if($id){
		
			
		if($oy == 1){

				$puan = 5;
			
				$ay = date("m");
				
				$yil = date("Y");
				
				$kullanan = $bot .";". $botadi .";". $puan .";". $zaman;
				
				$result = mysql_query("select count(uye) from "._MX."uye_oy where uye='$id' and ay='$ay' and yil='$yil'");
				
				list($varmi) = mysql_fetch_row($result);
				
				if($varmi < 1){	
			
					$result = mysql_query("insert into "._MX."uye_oy values('$id', '$kullanici', '$cinsiyet', '$dogum', '$sehir', '1', '$puan', '$kullanan', '$ay', '$yil')");
					
				}
				else {
					
					$kullanan2 = $bot .";". $botadi;
					
					$result = mysql_query("select count(uye) from "._MX."uye_oy where oylar like '%$kullanan2%' and uye='$id'");
					
					list($count) = mysql_fetch_row($result);
					
					if($count < 1){
					
					list($oylar) = mysql_fetch_row(mysql_query("select oylar from "._MX."uye_oy where uye='$id' and ay='$ay' and yil='$yil'"));
					
					$oylar = $oylar .":". $kullanan;
					
					$result = mysql_query("update "._MX."uye_oy set toplamoy=toplamoy+1, toplampuan=toplampuan+$puan, oylar='$oylar' where uye='$id' and ay='$ay' and yil='$yil'");
					
					}
				
				}
	
		} // end oy
		
		
		if($arkadas == 1){
		
				$result = mysql_query("select count(id) from "._MX."uye_arkadas where uye='$bot' and arkadas='$id'");
				
				list($varmi) = mysql_fetch_row($result);
			
				if($varmi < 1){
				
				$kayit = $zaman;
				
				$result = mysql_query("insert into "._MX."uye_arkadas values(NULL, '$bot', '$id', '$botadi', '$kullanici', '$kayit', '2')");
			
				mysql_query("update "._MX."uye set toparkadas=toparkadas+1 where id='$id'");
				
				}
		
		} // end arkadas
		
		
		if($hit == 1){
		
			$ay = date("m");
			
			$yil = date("Y");
			
			$hitbak = mysql_query("select count(uye) from "._MX."uye_hit where uye='$id' and ay='$ay' and yil='$yil'");
			
			list($hitsay) = mysql_fetch_row($hitbak);
			
			$hitekle = $bot .";". $botadi;
				
			if($hitsay < 1){
			
				mysql_query("insert into "._MX."uye_hit values('$id', '$kullanici', '$cinsiyet', '$dogum', '$sehir', '1', '$hitekle', '$ay', '$yil')");	
				
				mysql_query("update "._MX."uye set topbakan=topbakan+1, goruntulenme=goruntulenme+1 where id='$id'");
			
			}
			else {
			
				list($hitler) = mysql_fetch_row(mysql_query("select hitler from "._MX."uye_hit where uye='$id' and ay='$ay' and yil='$yil'"));
			
				if(!strstr($hitler, $hitekle)){
				
					$yeniekle = $hitler .":::". $hitekle;
					
					mysql_query("update "._MX."uye_hit set hit=hit+1, hitler='$yeniekle' where uye='$id' and ay='$ay' and yil='$yil'");
					
					mysql_query("update "._MX."uye set topbakan=topbakan+1, goruntulenme=goruntulenme+1 where id='$id'");
					
				}
			}
			
		} // end hit
	
	
	
	
		if($opucuk == 1){
			
				$result = mysql_query("select count(id) from "._MX."uye_opucuk where uye='$id' and gonderen='$bot'");
				
				list($varmi) = mysql_fetch_row($result);
			
				if($varmi < 1){
				
				$yapancinsiyet = $botcinsiyet;
				$yapandogum = $botdogum;
				$yapansehir = $botsehir;
					
				$kayit = $zaman;
				
				$result = mysql_query("insert into "._MX."uye_opucuk values(NULL, '$id', '$bot', '$kullanici', '$botadi', '$yapancinsiyet', '$yapandogum', '$yapansehir', '$kayit')");
				
				mysql_query("update "._MX."uye set topopucuk=topopucuk+1 where id='$id'");
			
				}
		
		} // end öpücük
		

		if($cicek == 1){
			
				$result = mysql_query("select count(id) from "._MX."uye_cicek where uye='$id' and gonderen='$bot'");
				
				list($varmi) = mysql_fetch_row($result);
			
				if($varmi < 1){
				
				$yapancinsiyet = $botcinsiyet;
				$yapandogum = $botdogum;
				$yapansehir = $botsehir;
					
				$kayit = $zaman;
				
				$result = mysql_query("insert into "._MX."uye_cicek values(NULL, '$id', '$bot', '$kullanici', '$botadi', '$yapancinsiyet', '$yapandogum', '$yapansehir', '$kayit')");
				
				mysql_query("update "._MX."uye set topcicek=topcicek+1 where id='$id'");
			
				}
		
		} // end öpücük
		
		
		
		
		// mesaj gönderme baþlýyor
		/*
		[KADI] = Kullanici adini yazdirir
		[ADI] = Kullanicinin gercek adini yazdirir
		[SOYADI] = Kullanicinin gercek soyadini yazdirir
		[CINSIYET] = Kullanicinin cinsiyetini yazdirir.
		[ULKE] = Kullanicinin ulkesini yazdirir.
		[SEHIR] = Kullanicinin sehrini yazdirir
		[YAS] = Kullanicinin yasini yazdirir 

		*/
			
			
			$cinsiyetadi = cinsiyet($cinsiyet, NULL);
			$yas = date("Y") - date("Y", $dogum);
			
			$icerikler = array('[KADI]', '[ADI]', '[SOYADI]', '[CINSIYET]', '[ULKE]', '[SEHIR]', '[YAS]');
			$icerikler2 = array($kullanici, $ad, $soyad, $cinsiyetadi, $ulke, $sehir, $yas);
			
			$mesajimiz = str_replace($icerikler, $icerikler2, $mesaj);
			
			
			mysql_query("insert into "._MX."uye_mesaj (gonderen, gonderilen, gonderenad, konu, mesaj, kayit, tarih, oncelik, yer, durum) values('$bot', '$id', '$botadi', '$baslik', '$mesajimiz', '$zaman', '$zaman2', '$botoncelik', '1', '2')");
	
	
			mysql_query("update "._MX."uye set topmesaj=topmesaj+1 where id='$id'");
		
		
		// mesaj gonderme bitti
		
		if($email == 3){
			
			if(filter_var($kemail, FILTER_VALIDATE_EMAIL)){
			
			$mailmesaj = "	
			<p><b>Sayin uyemiz $siteadi Sitesinden <font color='#FF0000'></font>
			<br>
			$botadi rumuzlu uyemizden yeni bir mesaj aldiniz</b></p>
			<p><b>Mesaji Okumak icin Lutfen Siteye Giris Yapiniz..</b></p>
			<p><b>&nbsp;</b></p>
			<p><b>Giris Bilgileriniz</b></p>
			<p><b>Kullanici Adiniz : [KID]</b></p>
			<p><b>Sifreniz : [KPASS]</b></p>
			<p><font color='#FF0000'><b>
			<a target='_blank' href='".$siteurl."index.php?sayfa=hizligiris&k=[KID]&s=[KPASS]' style='text-decoration: none'>
			<font color='#FF0000'>Giris yapmak icin BURAYA TIKLAYINIZ...</font></a></b></font></p>
			<p><font color='#0000FF'><b>
			<a target='_blank' href='".$siteurl."' style='text-decoration: none'>
			".$siteurl."</a></b></font></p>";
			
			
			$iceriklera = array('[KID]', '[KPASS]');
			$iceriklerb = array($kullanici, $sifre);		
			
			$mailmesaj2 = str_replace($iceriklera, $iceriklerb, $mailmesaj);
			
			@mail_gonder($kemail, "Yeni Bir Mesaj Aldýnýz", $mailmesaj2);
			
			}
			
		}
		
		if($email == 2){

			
			if(filter_var($kemail, FILTER_VALIDATE_EMAIL)){
		

			$mailmesaj = "	
			<p><b>Sayin uyemiz $siteadi Sitesinden <font color='#FF0000'></font>
			<br>
			$botadi rumuzlu uyemizden yeni bir mesaj aldiniz</b></p>
			<p><b>Mesaji Okumak icin Lutfen Siteye Giris Yapiniz..</b></p>
			<p><b>&nbsp;</b></p>
			<p><b>Giris Bilgileriniz</b></p>
			<p><b>Kullanici Adiniz : [KID]</b></p>
			<p><b>Sifreniz : [KPASS]</b></p>
			<p><font color='#FF0000'><b>
			<a target='_blank' href='".$siteurl."index.php?sayfa=hizligiris&k=[KID]&s=[KPASS]' style='text-decoration: none'>
			<font color='#FF0000'>Giris yapmak icin BURAYA TIKLAYINIZ...</font></a></b></font></p>
			<p><font color='#0000FF'><b>
			<a target='_blank' href='".$siteurl."' style='text-decoration: none'>
			".$siteurl."</a></b></font></p>";
			
			$iceriklera = array('[KID]', '[KPASS]');
			$iceriklerb = array($kullanici, $sifre);		
			
			$mailmesaj2 = str_replace($iceriklera, $iceriklerb, $mailmesaj);
			
			$mailmesajgonder = "From: noreply@yatakpartner.com\r\n".
				 'To: '.$kemail."\r\n".
				 'Subject: Yeni Bir Mesaj Aldiniz'."\r\n".
				 'Content-Type: text/html'."\r\n\r\n".
				 ''.$mailmesaj2.'';				
			

			
			
			
			SMTP::send($smtpbaglan, array($kemail), $mailmesajgonder, $gondereneposta);
			
			}
		
		
		}
		
		
		} // end if id war mý
	} // end for
	
	if($email == 2){
	
	SMTP::disconnect($smtpbaglan);
	
	
	}
	
	die("ok");
	
}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Bot Mesajý Gönder | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
		function gonder(){
		
			var oy = $("#oy").val();
			var hit = $("#hit").val();
			var arkadas = $("#arkadas").val();
			var cicek = $("#cicek").val();
			var opucuk = $("#opucuk").val();
			var baslik = $("#baslik").val();
			var mesaj = $("#mesaj").val();
			var email = $("#email").val();
			var bot = $("#bot").val();
			var botadi = $("#botadi").val();
			var botcinsiyet = $("#botcinsiyet").val();
			var botsehir = $("#botsehir").val();
			var botimg = $("#botimg").val();
			var botoncelik = $("#botoncelik").val();
			var botdogum = $("#botdogum").val();
			var hiz = $("#hiz").val();
			var uyeler = $("#uyeler").val();
			var toplamsayfa = $("#toplamsayfa").val();
			
			var kacinci = $("#sayfacik2").val();
			var kacinci = $("#sayfacik2").val();
			

			
				var gonderilen = kacinci * hiz;
				
				var ileri = kacinci;
				
				ileri++;
				
				$("#ileributon").html('<input type="hidden" name="sayfacik" id="sayfacik" value="'+ileri+'"><input type="submit" value=" Devam Et ">');
				
				
				
				jQuery.ajax({
					
					type: 'POST', 
					url: 'index.php?sayfa=botgonder&islem=gonder',
					data: "oy="+oy+"&hit="+hit+"&arkadas="+arkadas+"&cicek="+cicek+"&opucuk="+opucuk+"&baslik="+baslik+"&mesaj="+mesaj+"&email="+email+"&bot="+bot+"&botadi="+botadi+"&botcinsiyet="+botcinsiyet+"&botsehir="+botsehir+"&botimg="+botimg+"&botoncelik="+botoncelik+"&botdogum="+botdogum+"&hiz="+hiz+"&uyeler="+uyeler+"&kacinci="+kacinci+"&toplamsayfa="+toplamsayfa,
					success: function(sonuc){
						if(sonuc == "ok"){
							$("#sayfacik1").html(ileri);
							$("#gonderilen").html(gonderilen);
							$("#sayfacikyazdir").html('<input type="hidden" name="sayfacik2" id="sayfacik2" value="'+ileri+'" />');
							gonder();
						}
						else if(sonuc == "tamamdir"){
							alert("Gönderim iþlemi baþarýyla tamamlanmýþtýr");
						}
						else {
							alert("Sistem hatasý tekrar deneyin");
							alert(sonuc);
						}
					}
					
				})
				
	
		}
	</script>
</head>
<body onLoad="gonder()">
<div id="main">
	<div id="header">
<? include("menu/bot.php"); ?>
		<div id="center-column">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<div id="anasonuc">
				<?php
					
					$oy = $_POST["oy"];
					$hit = $_POST["hit"];
					$arkadas = $_POST["arkadas"];
					$cicek = $_POST["cicek"];
					$opucuk = $_POST["opucuk"];
					$baslik = $_POST["baslik"];
					$mesaj = $_POST["mesaj"];
					$email = $_POST["email"];
					$bot = $_POST["bot"];
					$uyeler = $_POST["uyeler"];
					$toplam = $_POST["toplam"];
					$hiz = $_POST["hiz"];
					
					$toplamsayfa = ceil(($toplam/$hiz));
					
					list($botadi, $botcinsiyet, $botsehir, $botdogum, $botimg, $botoncelik) = mysql_Fetch_row(mysql_query("select kullanici, cinsiyet, sehir, dogum, img, oncelik from "._MX."uye where id='$bot'"));
					
					$sayfacik = $_POST["sayfacik"];
					
					if(!$sayfacik) {
						$sayfacik = 1;	
					}
					
					$suan = $sayfacik * $hiz;
					
				
				?>
				<form action="index.php?sayfa=botgonder" method="post">
				<table id="gondersonuc2" class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="1"><?=turkcejquery("Ýþlem gerçekleþtiriliyor");?></th>
					</tr>
					<tr>
						<td align="center">
						
						<p><img src='img/loading30.gif' /></p>
						
						<p><b>Lütfen bekleyiniz, iþlem gerçekleþtiriliyor</b></p>
						
						<p>Toplam : <b><?=$toplam;?></b> adet / Gönderilen : <b><span id="gonderilen"><?=$suan?></span></b> gönderiliyor</p>
						<p>Toplam sayfa : <b><?=$toplamsayfa;?></b> / Suan : <b><span id="sayfacik1"><?=$sayfacik?></span></b></p>
						<p><span id="ileributon"></span></p>
						
						<input type="hidden" name="oy" id="oy" value="<?=$oy?>" />
						<input type="hidden" name="hit" id="hit" value="<?=$hit?>" />
						<input type="hidden" name="arkadas" id="arkadas" value="<?=$arkadas?>" />
						<input type="hidden" name="cicek" id="cicek" value="<?=$cicek?>" />
						<input type="hidden" name="opucuk" id="opucuk" value="<?=$opucuk?>" />
						<input type="hidden" name="baslik" id="baslik" value="<?=$baslik?>" />
						<input type="hidden" name="mesaj" id="mesaj" value="<?=$mesaj?>" />
						<input type="hidden" name="email" id="email" value="<?=$email?>" />
						<input type="hidden" name="hiz" id="hiz" value="<?=$hiz?>" />
						<input type="hidden" name="toplam" id="toplam" value="<?=$toplam?>" />
						<input type="hidden" name="toplamsayfa" id="toplamsayfa" value="<?=$toplamsayfa?>" />
						<input type="hidden" name="bot" id="bot" value="<?=$bot?>" />
						<input type="hidden" name="botadi" id="botadi" value="<?=$botadi?>" />
						<input type="hidden" name="botcinsiyet" id="botcinsiyet" value="<?=$botcinsiyet?>" />
						<input type="hidden" name="botsehir" id="botsehir" value="<?=$botsehir?>" />
						<input type="hidden" name="botdogum" id="botdogum" value="<?=$botdogum?>" />
						<input type="hidden" name="botimg" id="botimg" value="<?=$botimg?>" />
						<input type="hidden" name="botoncelik" id="botoncelik" value="<?=$botoncelik?>" />
						<span id="sayfacikyazdir"><input type="hidden" name="sayfacik2" id="sayfacik2" value="<?=$sayfacik?>" /></span>
						<?php
							$uyeler = $_POST["uyeler"];
						?>
						<input type="hidden" name="uyeler" id="uyeler" value="<?=$uyeler?>">
						
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
			<div class="box">Bu alandan üyelere bot mesajý gönderebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>