<?php



$islem = $_GET["islem"];

	function uretbakim() {



		$chars = "abcdefghijkmnopqrstuvwxyz023456789";

		srand((double)microtime()*1000000);

		$i = 0;

		$pass = '' ;



		while ($i <= 12) {

			$num = rand() % 33;

			$tmp = substr($chars, $num, 1);

			$pass = $pass . $tmp;

			$i++;

		}



		return $pass;



	}
	
	
if($islem == "gonder"){

	$kacinci = $_POST["kacinci"];
	$toplamsayfa = $_POST["toplamsayfa"];
	
	if($toplamsayfa < $kacinci) die("tamamdir");
	
	$sifredegis = $_POST["sifredegis"];
	$gun = $_POST["gun"];
	$email = $_POST["email"];
	$hiz = $_POST["hiz"];

	
	
	$i = $hiz * ($kacinci-1);
	
	$son = $i + $hiz;
	

	if($email == 2){
		
		
		include("../inc/class.phpmailer.php");


		list($siteadi, $siteurl) = mysql_fetch_row(mysql_query("select ad, url from "._MX."ayarlar"));
		
		
		
	}
	
	$zaman = time(();

	$cikar = 60 * 60 * 24 * $gun;

	$kalan = $zaman - $cikar;
	
	$result = mysql_query("select id, email, calintimi from "._MX."uye where sononline > $kalan order by id desc limit ".(($kacinci-1)*$hiz).",".$hiz."");

	while(list($id, $email, $calintimi) = mysql_fetch_row($result)){
	
		
		if($calintimi == 0){
			
			$yenisifre = rand(100000, 999999);
		
		}
		else {
			
			list($yenisifre) = mysql_fetch_row(mysql_query("select sifre from "._MX."uye where id='$id'"));
		
		}	
		
		
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			

		$randomkod = uretbakim();
		$randomkod2 = uretbakim();
		$randomkod3 = uretbakim();
		$randomkod4 = uretbakim();
		$randomkod5 = uretbakim();
		$randomkod6 = uretbakim();


		$mailmesaj = '<table border="1" width="51%" height="276" bordercolor="#999999" cellspacing="0">
 <tr>
  <td align="center"><font face="Verdana" size="2" color="#333333">
  Yatakpartner sifre servisi</font></td>
 </tr>
 <tr>
  <td align="center"><font face="Verdana" size="2" color="#333333">Degerli 
  kullanicimiz sistemimizde guvenlik sebebi ile sifreniz degistirilmis 
  olup sisteme girebilmeniz adina yeni sifreniz assagida yer almaktadir</font></td>
 </tr>
 <tr>
  <td align="center"><font face="Verdana" size="2" color="#333333">'.$yenisifre.'</font></td>
 </tr>
</table';

			
			$kemail = $email;
			
			$mail = new PHPMailer(true);
																			
			$mail->IsSMTP();
			$mail->Host       = "173.192.198.112";		
			$mail->SMTPDebug  = 2;
			$mail->SMTPAuth   = true;         		    
			$mail->Host       = "173.192.198.112";		
			$mail->Port       = 587; 		
			$mail->Username   = "batuhandemirkan@ask-mesk.com";		
			$mail->Password   = "s9d8t7";
			$mail->AddReplyTo('ileti@engellenenler.com', "Yatakpartner Sifre $randomkod5");		
			$mail->SetFrom('ileti@engellenenler.com', "Yatakpartner Sifre $randomkod5");					
			// $mail->Subject = ''.$boadi.' & '.$mesajinkonusu.'';		
			$mail->Subject = 'Yatakpartner Sifre '.$randomkod6.'';		
			// $mail->AltBody = ''.$boadi.' & '.$mesajinkonusu.'';
			$mail->AltBody = 'Yatakpartner Sifre '.$randomkod6.'';
			$mail->AddAddress($kemail, "Yatakpartner Sifre $randomkod5");
			$mail->MsgHTML("$mailmesaj");									  
			$mail->Send();
			
			@mysql_query("update "._MX."uye set sifre='$yenisifre', calintimi='1' where id='$id'");
			
			
			}
	
	
	}
	
	die("olala");
	
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
		
			var sifredegis = $("#sifredegis").val();
			var gun = $("#gun").val();
			var email = $("#email").val();
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
					url: 'index.php?sayfa=sifregonder&islem=gonder',
					data: "email="+email+"&gun="+gun+"&sifredegis="+sifredegis+"&hiz="+hiz+"&uyeler="+uyeler+"&kacinci="+kacinci+"&toplamsayfa="+toplamsayfa,
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
							$("#sayfacik1").html(ileri);
							$("#gonderilen").html(gonderilen);
							$("#sayfacikyazdir").html('<input type="hidden" name="sayfacik2" id="sayfacik2" value="'+ileri+'" />');
							gonder();
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
					
					$email = $_POST["email"];
					$sifredegis = $_POST["sifredegis"];
					$gun = $_POST["gun"];
					$toplam = $_POST["toplam"];
					$hiz = $_POST["hiz"];
					
					$toplamsayfa = ceil(($toplam/$hiz));
										
					$sayfacik = $_POST["sayfacik"];
					
					if(!$sayfacik) {
						$sayfacik = 1;	
					}
					
					$suan = $sayfacik * $hiz;
					
				
				?>
				<form action="index.php?sayfa=sifregonder" method="post">
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
						
						<input type="hidden" name="email" id="email" value="<?=$email?>" />
						<input type="hidden" name="sifredegis" id="sifredegis" value="<?=$sifredegis?>" />
						<input type="hidden" name="gun" id="gun" value="<?=$gun?>" />
						<input type="hidden" name="hiz" id="hiz" value="<?=$hiz?>" />
						<input type="hidden" name="toplam" id="toplam" value="<?=$toplam?>" />
						<input type="hidden" name="toplamsayfa" id="toplamsayfa" value="<?=$toplamsayfa?>" />
						<span id="sayfacikyazdir"><input type="hidden" name="sayfacik2" id="sayfacik2" value="<?=$sayfacik?>" /></span>
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
			<div class="box">Þifre deðiþtirme ve kullanýcý maillerine atma iþlemini yapar.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>