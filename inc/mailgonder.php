<?php

session_start();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();

$konu = $_POST["konu"];
$mesaj = $_POST["mesaj"];


if($konu and $mesaj){

	
	$konu = nl2br(turkce($konu));
	
	$mesaj = nl2br(turkce($mesaj));
	
	$mesaj = strtr($mesaj,"ÜÞÇÝÐÖüöþçiðý","USCIGOuoscigi");
	
	$konu = strtr($konu,"ÜÞÇÝÐÖüöþçiðý","USCIGOuoscigi");
	
	$uyeadi = uyeadi();
	
	$admin = ayar("mail");
	
	list($uyemail, $satissatis) = mysql_fetch_row(mysql_query("select email, satissatis from "._MX."uye where id='$uyeid'"));
				
				$subject=""._AD." : Yardým Talebi";
				$message = "
				<style type=\"text/css\">
				.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;}
				</style>
				</head>
				<body>
				<p class=\"style2\">Gonderen $uyeadi,</p>
				<p class=\"style2\">Konu : $konu</p>
				<p class=\"style2\">Mail : $uyemail</p>
				<p class=\"style2\">Mesaji : $mesaj</p>
				<p class=\"style2\">Tarih : ".date("d.m.Y")."</p>
				</body>
				</html>";
				$headers = "From: ".$uyemail." <".$uyemail.">\n";
				$headers .= "X-Sender: <".$uyemail.">\n";
				$headers .= "X-Mailer: PHP\n"; //mailer
				$headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
				$headers .= "Return-Path: <".$uyemail.">\n";
				$headers .= "Content-Type: text/html; charset=iso-8859-9\n";
				mail($admin, $subject, $message, $headers);
				
				$subject=""._AD." : Yardým Talebiniz alinmisitr";
				$message = "
				<style type=\"text/css\">
				.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;}
				</style>
				</head>
				<body>
				<p class=\"style2\">Sevgili <b>$uyeadi</b>,</p>
				<p class=\"style2\">Yardim talebiniz basariyla alinmistir, en kisa zamanda yanitlanacaktir.</p>
				<p class=\"style2\">Tesekkur ederiz.</p>
				<p class=\"style2\"><b>"._AD."</b> Yonetimi.</p>
				<p class=\"style2\">Tarih : ".date("d.m.Y")."</p>
				</body>
				</html>";
				$headers = "From: "._AD." <"._AD.">\n";
				$headers .= "X-Sender: <".$admin.">\n";
				$headers .= "X-Mailer: PHP\n"; //mailer
				$headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
				$headers .= "Return-Path: <".$admin.">\n";
				$headers .= "Content-Type: text/html; charset=iso-8859-9\n";
				mail($uyemail, $subject, $message, $headers);
?>
										<table border="0" width="100%" id="table15" cellspacing="0" cellpadding="0">
												<tr>
												<td background="img/ust_ac_lacivert.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														<?php echo turkcejquery("Yardým Maili"); ?></td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table16" cellspacing="0" cellpadding="0">
													<tr>
														<td height="15">
														</td>
													</tr>
													<tr>
														<td height="15" align="center">
												<table border="0" width="100%" id="table525" cellspacing="0" cellpadding="0">
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
								<img border="0" src="img/iko_odemetamam.gif" width="128" height="128"></td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<p class="tit_arkadas_mer">
														<b>
														<font color="#C32828" size="5">
														<?php echo turkcejquery("Tebrikler mailiniz baþarýyla gönderilmiþtir");?></font></b></td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="10"></td>
														<td width="510" align="center" height="10">
														</td>
														<td height="10"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">

														<p class="tx"><?php echo turkcejquery("Mailiniz baþarýyla iletilmiþtir, Yöneticilerimiz tarafýndan en kýsa zamanda cevaplanacaktýr.");?> <br>

														<?php echo turkcejquery("sorularýnýz için");?>
														<a class="tx" href="index.php?sayfa=yardimmerkezi">
														<u>
														<font color="#C32828">
														<?php echo turkcejquery("yardým");?></font></u></a> 
														<?php echo turkcejquery("sayfalarýmýzý ziyaret edebilirsiniz.");?></td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													</table>
														</td>
													</tr>
													<tr>
														<td height="8">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td>
														<img border="0" src="img/pncere1_alt.gif" width="540" height="9"></td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td height="12">
												</td>
											</tr>
											</table>
<?php	
				

}
else {

	die("hata");

}

?>