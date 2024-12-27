<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$gonderilecekid = $_POST["uye"];

list($gonderilecek) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$gonderilecekid'"));

$konu = $_POST["baslik"];

if($konu){
	
	if(!strstr($konu, "Re : ")) $konu = "Re : ". $konu;

}
else $konu = NULL;
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
</head>
<body>
<table border="0" id="table5" cellspacing="0" cellpadding="0">
	<tr>
		<td width="20">&nbsp;</td>
		<td width="520" valign="top">
		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
			<tr>
				<td>
				<img border="0" src="img/istatis_ust.gif" width="520" height="10"></td>
			</tr>
			<tr>
				<td background="img/istatis_bg.gif" align="center">
														<table border="0" id="table307" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table308" cellspacing="0" cellpadding="0">
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494" background="img/bg_msgyaz_alici.gif" height="35">
																		<table border="0" width="100%" id="table322" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="50" align="right" height="35">
																				<p class="form_txt">Kime:</td>
																				<td width="10">&nbsp;</td>
																				<td>
																				<b><?=$gonderilecek?></b>
																				</td>
																				<td width="110" align="right">
																				<p class="yas"><?=turkcejquery(tarihdon(time()));?> [<? echo date("H:i"); ?>]</td>
																				<td width="12">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="18"></td>
																		<td width="494" height="18"></td>
																		<td height="18"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" width="100%" id="table321" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="50" align="right">
																				<p class="form_txt">Konu:</td>
																				<td width="10">&nbsp;</td>
																				<td><input type="text" name="konu" id="konu" size="40" value="<?=$konu?>" style="font-family: Tahoma; font-size: 8pt"></td>
																			</tr>
																			<tr>
																				<td width="50" align="right">&nbsp;</td>
																				<td width="10">&nbsp;</td>
																				<td>&nbsp;</td>
																			</tr>
																			<tr>
																				<td width="50" align="right" valign="top">
																				<p class="form_txt">Mesaj:</td>
																				<td width="10">&nbsp;</td>
																				<td><textarea rows="7" name="mesaj" id="mesaj" cols="76" style="font-family: Tahoma; font-size: 8pt; padding-left: 1px; padding-right: 1px"></textarea></td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494" align="center">
																		<table border="0" width="100%" id="table313" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>&nbsp;</td>
																				<td width="476" height="51" background="img/msg_oku_btn_bg.gif" align="right" valign="top">
																				<table border="0" width="100%" id="table318" cellspacing="0" cellpadding="0">
																					<tr>
																						<td valign="top">
																						<p style="padding-left:50px;padding-top:10px;"><span id="mesajgondersonuc"></span></p>
																						</td>
																						<td width="150" align="right">
																				<table border="0" id="table319" cellspacing="0" cellpadding="0">
																					<tr>
																						<td width="13" height="20">&nbsp;</td>
																						<td width="30" height="20">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="13"><a href="javascript:void(0)" onclick="mesajgonderuygula(<?=$gonderilecekid?>);"><img border="0" src="img/btn_gonderdavtet.gif" width="110" height="31"></a></td>
																						<td width="30">&nbsp;</td>
																					</tr>
																				</table>
																						</td>
																					</tr>
																				</table>
																				</td>
																				<td>&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_alt.gif" width="510" height="7"></td>
															</tr>
														</table>
				</td>
			</tr>
			<tr>
				<td>
				<img border="0" src="img/istatis_alt.gif" width="520" height="10"></td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
</table>

<p>&nbsp;</p>
</body>
</html>