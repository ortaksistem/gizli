<?php

session_start();

$mesaj = $_POST["mesaj"];
$konu = $_POST["konu"];



if($konu and $mesaj){
	
	include("../ayarlar.php");
	include("../fonksiyon.php");
	
	
	$uyeid = uyeid();
	
	
	$konu = suz(turkce($konu));
	
	$mesaj = suz(turkce($mesaj));
	
	
	$kayit = time();
	
	
	$result = mysql_query("insert into "._MX."hayati_paylas values(NULL, '$uyeid', '$konu', '$mesaj', '$kayit', '2')");
	
	
	if($result) {
?>
										<table border="0" width="100%" id="table15" cellspacing="0" cellpadding="0">
												<tr>
												<td background="img/ust_ac_lacivert.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														<?php echo turkcejquery("Hayatý Paylaþ"); ?></td>
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
														<?php echo turkcejquery("Tebrikler yazýnýz baþarýyla gönderilmiþtir");?></font></b></td>
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

														<p class="tx"><?php echo turkcejquery("Yazýnýz baþarýyla gönderilmiþtir. Yöneticilerimiz tarafýndan incelendikten sonra onaylanacaktýr.<br> Teþekkür Ederiz...");?> <br>
														</td>
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
}
else die("hata");

?>