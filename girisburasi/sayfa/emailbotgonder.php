<?php

error_reporting(0); 

$islem = $_GET["islem"];

if($islem == "gonder"){

function randla()
{	
	$length = 16;
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    // Length of character list
    $chars_length = (strlen($chars) - 1);

    // Start our string
    $string = $chars{rand(0, $chars_length)};
   
    // Generate random string
    for ($i = 1; $i < $length; $i = strlen($string))
    {
        // Grab a random character from our list
        $r = $chars{rand(0, $chars_length)};
       
        // Make sure the same two characters don't appear next to each other
        if ($r != $string{$i - 1}) $string .=  $r;
    }
   
    // Return the string
    return $string;
}


	$kacinci = $_POST["kacinci"];
	$toplamsayfa = $_POST["toplamsayfa"];
	$hiz = $_POST["hiz"];
	
		
		
	include("../inc/class.phpmailer.php");

	list($siteadi, $siteurl) = mysql_fetch_row(mysql_query("select ad, url from "._MX."ayarlar"));
	
	
	$result = mysql_query("select id, kadi, email from mailler where durum!='1' order by id asc limit ".(($kacinci-1)*$hiz).",".$hiz."");
	
	
	while(list($id, $kadi, $kemail) = mysql_fetch_row($result)){
			
			if(!$kadi) $kadi = "ruyagibi";
			
			if(filter_var($kemail, FILTER_VALIDATE_EMAIL)){
			

			$mailmesaj='<table border="1" width="49%" height="468" cellspacing="0" cellpadding="0" style="border-collapse: collapse">
	<tr>
		<td bgcolor="#0099FF" align="center" height="105"><b>
		<font face="Tahoma" size="5" color="#FFFFFF">Yatakpartner Davetiyesi 
		Kazandýnýz</font></b></td>
	</tr>
	<tr>
		<td bgcolor="#C0C0C0" align="center" height="131">
		<font face="Tahoma" size="4" color="#333333">Davetiye Kodunuz : 
		2578458745</font></td>
	</tr>
	<tr>
		<td bgcolor="#0099FF" align="center" height="118">
		<font face="Tahoma" size="4" color="#FFFFFF">www.yatakpartner.com</font></td>
	</tr>
	<tr>
		<td bgcolor="#C0C0C0" align="center">
		&nbsp;</td>
	</tr>
	</table>';
						
		@mysql_query("update mailler set durum='1' where id='$id'");	
			
			$mail = new PHPMailer(true);
																			
			$mail->IsSMTP();
			$mail->Host       = "173.192.198.112";		
			$mail->SMTPDebug  = 2;
			$mail->SMTPAuth   = true;         		    
			$mail->Host       = "173.192.198.112";		
			$mail->Port       = 587; 		
			$mail->Username   = "batuhandemirkan@ask-mesk.com";		
			$mail->Password   = "s9d8t7";
			$mail->AddReplyTo('ileti@engellenenler.com', "YatakPartner");		
			$mail->SetFrom('ileti@engellenenler.com', "YatakPartner");					
			$mail->Subject = ''.$kadi.' sizi sizemize davet etti';		
			$mail->AltBody = ''.$kadi.' sizi sizemize davet etti';
			$mail->AddAddress($kemail, "$siteadi");								  
			$mail->MsgHTML("$mailmesaj");									  
			$mail->Send();
			
			}
	
	
	
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
		
			var hiz = $("#hiz").val();
			var toplamsayfa = $("#toplamsayfa").val();
			
			var kacinci = $("#sayfacik2").val();
			

			
				var gonderilen = kacinci * hiz;
				
				var ileri = kacinci;
				
				ileri++;
				
				if(ileri > toplamsayfa){
				
					alert("Gönderim iþlemi baþarýyla tamamlanmýþtýr");
					
				}
				else {
				$("#ileributon").html('<input type="hidden" name="sayfacik" id="sayfacik" value="'+ileri+'"><input type="submit" value=" Devam Et ">');
				
				
				
				jQuery.ajax({
					
					type: 'POST', 
					url: 'index.php?sayfa=emailbotgonder&islem=gonder',
					data: "hiz="+hiz+"&kacinci="+kacinci+"&toplamsayfa="+toplamsayfa,
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
					
					$hiz = $_REQUEST["hiz"];
					
					list($toplam) = mysql_fetch_row(mysql_query("select count(id) from mailler where durum!='1' "));
					
					$toplamsayfa = ceil(($toplam/$hiz));
										
					$sayfacik = $_POST["sayfacik"];
					
					if(!$sayfacik) {
						$sayfacik = 1;	
					}
					
					$suan = $sayfacik * $hiz;
					
				
				?>
				<form action="index.php?sayfa=emailbotgonder" method="post">
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
			<div class="box">Bu alandan email adreslerine bot mesajý gönderebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>