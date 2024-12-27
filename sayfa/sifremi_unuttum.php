<?php

$islem = $_GET["islem"];

if($islem == "gonder"){

	$mail = turkcejquery(suz($_POST["mail"]));
	
	$mail = nl2br($mail);

	$result = mysql_query("select id, kullanici from "._MX."uye where email='$mail'");
	
	
	$sayi = mysql_num_rows($result);
	
	if($sayi == 1){
	
	list($id, $kullanici) = mysql_fetch_row($result);

		if($id == 44229){
			
			$ip = $_SERVER["REMOTE_ADDR"];
			
			$kayit = time();

			@mysql_query("insert into "._MX."ip_log values(NULL, '44229', '$ip', '$kayit')");
		
		}
		
	function koduret($param = 8){

	$kod = md5(rand(1,9999));
	$kod = substr($kod, 10, $param);
	return $kod; 
	
	}
	
	$sifre = koduret(6);
	
	
	$admin = ayar("mail");
	
				$subject=""._AD." : Sifre hatirlatma";
				$message = "
				<style type=\"text/css\">
				.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;}
				</style>
				</head>
				<body>
				<p class=\"style2\">Sevgili <b>$kullanici</b> sifre hatirlatma talebinde bulundunuz bilgileriniz asagidadir.</p>
				<p class=\"style2\">Kullanici adiniz : $kullanici</p>
				<p class=\"style2\">Sifreniz : $sifre</p>
				<p class=\"style2\">Tesekkur eder, iyi gunler dileriz.</p>
				<p class=\"style2\">Tarih : ".date("d.m.Y")."</p>
				</body>
				</html>";
				$headers = "From: "._AD." <"._AD.">\n";
				$headers .= "X-Sender: <".$admin.">\n";
				$headers .= "X-Mailer: PHP\n"; //mailer
				$headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
				$headers .= "Return-Path: <".$admin.">\n";
				$headers .= "Content-Type: text/html; charset=iso-8859-9\n";
				mail($mail, $subject, $message, $headers);
				
				
				mysql_query("update "._MX."uye set sifre='".sifrele($sifre)."' where id='$id'");
				
				die("ok");
				
	}
	else {
		die("hata");
	}
}
else {
?>

<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Þifremi Unuttum</title>
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type="text/javascript">
	function gonder(){
	
		$("#gondersonuc").html("<img src='img/loading.gif' /> <font size=2 color=white><b>Bekleyin...</b></font>");
	
		var mail = $("#email").val();
		
		if (mail == "" || mail == 'Email adresinizi yazin'){
			$("#gondersonuc").html("<font size=2 color=white><b>Mail adresinizi yazmadýnýz.</b></font>");
		}
		else {
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=sifremi_unuttum&islem=gonder',
				data : "mail="+mail,
				success: function(sonuc){
					if(sonuc == "ok"){
						$("#gondersonuc").html("");
						alert("Þifreniz ve kullanýcý adýnýz email adresinize gönderilmiþtir. \n\n Lütfen mailinizi kontrol ediniz. \n\n Teþekkür ederiz...");
						
						window.close();
					}
					else {
						$("#gondersonuc").html("");
						
						alert("Sistemde kayýtlý böyle bir kullanýcý bulunmamaktadýr");
					
					}
				}
			
			})
		}
	}
</script>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">

<table border="0" id="table1" cellspacing="0" cellpadding="0">
	<tr>
		<td width="20">&nbsp;</td>
		<td width="330">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<form method="POST" action="javascript:void(0)">
		<td width="330" background="img/bg_sifremiunuttum.jpg" height="323" valign="top">
		<table border="0" width="100%" id="table2" cellspacing="0" cellpadding="0">
			<tr>
				<td width="33">&nbsp;</td>
				<td height="49">
				<p class="tit_zdshop_mer">Þifremi Unuttum?</td>
				<td width="33">&nbsp;</td>
			</tr>
			<tr>
				<td width="33">&nbsp;</td>
				<td height="169" valign="top">
				<table border="0" width="100%" id="table3" cellspacing="0" cellpadding="0">
					<tr>
						<td height="18"></td>
					</tr>
					<tr>
						<td>
						<p class="not2_byz"><b>DÝKKAT!</b></td>
					</tr>
					<tr>
						<td height="8"></td>
					</tr>
					<tr>
						<td>
						<p class="not2_byz">Þifrenizi ve kullanýcý adýnýzý hatýrlatma maili almak için aþaðýdaki kutucuða kayýt olurken kullandýðýnýz email adresinizi yazýnýz.</td>
					</tr>
				</table>
				</td>
				<td width="33">&nbsp;</td>
			</tr>
			<tr>
				<td width="33">&nbsp;</td>
				<td height="31">
				<table border="0" width="100%" id="table5" cellspacing="0" cellpadding="0">
					<tr>
						<td height="31">
						<table border="0" width="100%" id="table6" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10">
								<img border="0" src="img/sfrem_box_sol.gif" width="10" height="31"></td>
								<td background="img/sfrem_box_bg.gif">
													<input type="text" name="email" id="email" size="24" style="font-family: Trebuchet MS; color: #808080; font-size: 10pt; border: 1px solid #FFFFFF; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px" value="Email adresinizi yazin" onfocus="if(this.value=='Email adresinizi yazin')this.value=''" onblur="if(this.value=='')this.value='Email adresinizi yazin'"></td>
								<td width="10">
								<img border="0" src="img/sfrem_box_sag.gif" width="10" height="31"></td>
							</tr>
						</table>
						</td>
						<td width="6">&nbsp;</td>
						<td width="70">
						<input type="image" border="0" src="img/btn_gonderx.gif" onclick="gonder()" width="70" height="26"></td>
					</tr>
				</table>
				</td>
				<td width="33">&nbsp;</td>
			</tr>
			<tr>
				<td width="33" height="9"></td>
				<td height="9"></td>
				<td width="33" height="9"></td>
			</tr>
			<tr>
				<td width="33">&nbsp;</td>
				<td height="31">
				<table border="0" width="100%" id="table9" cellspacing="0" cellpadding="0">
					<tr>
						<td height="31">
						<table border="0" width="100%" id="table10" cellspacing="0" cellpadding="0">
							<tr>
								<td>
								<span id="gondersonuc"></span>
								</td>
							</tr>
						</table>
						</td>
						<td width="6">&nbsp;</td>
						<td width="70">
						</td>
					</tr>
				</table>
				</td>
				<td width="33">&nbsp;</td>
			</tr>
		</table>
		</td>
		</form>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20" height="5"></td>
		<td width="330" height="5"></td>
		<td width="20" height="5"></td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="330" align="right">
		<table border="0" id="table4" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<p class="not"><a class="not" href="javascript:window.close()">pencereyi kapat</a></td>
				<td width="15">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="330">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
</table>
</body>
</html>
<?php
}
?>