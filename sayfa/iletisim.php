<?php

$islem = $_GET["islem"];

if($islem == "gonder"){

	$ad = turkcejquery(suz($_POST["ad"]));
	$tel = turkcejquery(suz($_POST["tel"]));
	$mesaj = turkce(suz($_POST["mesaj"]));
	$mail = turkcejquery(suz($_POST["mail"]));

	$mesaj = strtr($mesaj,"ÜÞÇÝÐÖüöþçiðý","USCIGOuoscigi");
	
	
	$ad = nl2br($ad);
	$tel = nl2br($tel);
	$mail = nl2br($mail);
	$mesaj = nl2br($mesaj);


	$admin = ayar("mail");
	
				$subject=""._AD." : Yeni Mail Alindi";
				$message = "
				<style type=\"text/css\">
				.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;}
				</style>
				</head>
				<body>
				<p class=\"style2\">Sevgili yonetici sitenize yeni iletisim maili gonderilmistir, mail bilgileri asagidadir.</p>
				<p class=\"style2\">Gonderen : $ad</p>
				<p class=\"style2\">Tel : $tel</p>
				<p class=\"style2\">Mail : $mail</p>
				<p class=\"style2\">Mesaj : $mesaj</p>
				<p class=\"style2\">Tarih : ".date("d.m.Y")."</p>
				</body>
				</html>";
				$headers = "From: "._AD." <"._AD.">\n";
				$headers .= "X-Sender: <".$mail.">\n";
				$headers .= "X-Mailer: PHP\n"; //mailer
				$headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
				$headers .= "Return-Path: <".$mail.">\n";
				$headers .= "Content-Type: text/html; charset=iso-8859-9\n";
				mail($admin, $subject, $message, $headers);
				
				die("ok");
}
else {
?>

<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Ýletiþim</title>
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type="text/javascript">
	function gonder(){
	
		$("#gondersonuc").html("<img src='img/loading.gif' /> <font size=2 color=green><b>Bekleyin...</b></font>");
	
	
		var ad = $("#ad").val();
		var tel = $("#tel").val();
		var mail = $("#mail").val();
		var mesaj = $("#mesaj").val();
		
		
		if(ad == ""){
			$("#gondersonuc").html("<font size=2 color=red><b>Adýnýzý yazmadýnýz.</b></font>");
		}
		else if (tel == ""){
			$("#gondersonuc").html("<font size=2 color=red><b>Telefon numaranýzý yazmadýnýz.</b></font>");
		}
		else if (mail == ""){
			$("#gondersonuc").html("<font size=2 color=red><b>Mail adresinizi yazmadýnýz.</b></font>");
		}
		else if (mesaj == ""){
			$("#gondersonuc").html("<font size=2 color=red><b>Mesaj yazmadýnýz.</b></font>");
		}
		else {
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=iletisim&islem=gonder',
				data : "ad="+ad+"&tel="+tel+"&mail="+mail+"&mesaj="+mesaj,
				success: function(sonuc){
					if(sonuc == "ok"){
						$("#gondersonuc").html("");
						alert("Mesajýnýz baþarýyla iletilmiþtir. \n\n Editörlerimiz tarafýndan incelenip size geri dönülecektir. \n\n Teþekkür ederiz...");
						
						window.close();
					}
					else {
						$("#gondersonuc").html("<font size=2 color=red><b>Mesajýnýz þuanda gönderilemiyor. Lütfen sonra tekrar deneyiniz.</b></font>");
					}
				}
			
			})
		}
	}
</script>
</head>
<body>
<table border="0" id="table5" cellspacing="0" cellpadding="0">
	<tr>
		<td width="20">&nbsp;</td>
		<td width="520">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="520">
		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
			<tr>
				<td width="20">&nbsp;</td>
				<td>
								<p class="tit_mesaj_mer"><font color="#C32828">
								Bize Ulaþýn</font></td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20" height="8"></td>
		<td width="520" height="8"></td>
		<td width="20" height="8"></td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="520" valign="top">
		<form method="POST" action="javascript:void(0)">
		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
			<tr>
				<td>
				<img border="0" src="img/istatis_ust.gif" width="520" height="10"></td>
			</tr>
			<tr>
				<td background="img/istatis_bg.gif">
				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
					<tr>
						<td width="15">&nbsp;</td>
						<td>
						&nbsp;</td>
						<td width="15">&nbsp;</td>
					</tr>
					<tr>
						<td width="15">&nbsp;</td>
						<td>
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="120">
																				<p class="form_txt">Ad, Soyad:</td>
																				<td>
																				<p class="form_txt"><input type="text" name="ad" id="ad" size="45" style="font-family: Tahoma; font-size: 8pt; color: #7B7B7B; border: 1px solid #B0B0B0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
						</td>
						<td width="15">&nbsp;</td>
					</tr>
					<tr>
						<td width="15">&nbsp;</td>
						<td>
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="120">
																				<p class="form_txt">Telefon Numaranýz:</td>
																				<td>
																				<p class="form_txt"><input type="text" name="tel" id="tel" size="45" style="font-family: Tahoma; font-size: 8pt; color: #7B7B7B; border: 1px solid #B0B0B0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
						</td>
						<td width="15">&nbsp;</td>
					</tr>
					<tr>
						<td width="15">&nbsp;</td>
						<td>
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="120">
																				<p class="form_txt">E-posta Adresiniz:</td>
																				<td>
																				<p class="form_txt"><input type="text" name="mail" id="mail" size="45" style="font-family: Tahoma; font-size: 8pt; color: #7B7B7B; border: 1px solid #B0B0B0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px"></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
						</td>
						<td width="15">&nbsp;</td>
					</tr>
					<tr>
						<td width="15">&nbsp;</td>
						<td>
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="120">
																				<p class="form_txt">Mesajýnýz:</td>
																				<td>
																				<textarea rows="10" name="mesaj" id="mesaj" cols="57" style="font-family: Tahoma; font-size: 8pt; padding-left: 1px; padding-right: 1px"></textarea></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																			<tr>
																				<td width="15" height="6"></td>
																				<td height="6" width="120">
																				</td>
																				<td height="6">
																				</td>
																				<td width="20" height="6"></td>
																			</tr>
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="120">
																				&nbsp;</td>
																				<td>
																				<input type="image" src="img/btn_gonderdavtet.gif" width="110" height="31" onclick="gonder()"> <span id="gondersonuc"></span></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
						</td>
						<td width="15">&nbsp;</td>
					</tr>
					<tr>
						<td width="15" height="12"></td>
						<td height="12">
						</td>
						<td width="15" height="12"></td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
				<img border="0" src="img/istatis_alt.gif" width="520" height="10"></td>
			</tr>
		</table>
		</form>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20" height="8"></td>
		<td width="520" height="8"></td>
		<td width="20" height="8"></td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="520" align="right">
		<table border="0" style="border-collapse: collapse" cellpadding="0">
			<tr>
				<td>
				<a href="javascript:window.close()"><img border="0" src="img/btn_kapat2.gif" width="56" height="22"></a></td>
				<td width="15">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="520">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
</table>
</body>
</html>
<?php
}
?>