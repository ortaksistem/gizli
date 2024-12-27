<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();

if($islem == "ayarlar"){
	
	$ayarmail = $_POST["ayarmail"];
	$ayargiden = $_POST["ayargiden"];
	$ayararsiv = $_POST["ayararsiv"];
	$ayaranimasyon = $_POST["ayaranimasyon"];
	
	mysql_query("update "._MX."uye set mesajayarmail='$ayarmail', mesajayargiden='$ayargiden', mesajayararsiv='$ayararsiv', mesajayaranimasyon='$ayaranimasyon' where id='$uyeid'");
	
	die("ok");

}

if($islem == "oku"){

	$mesajid = $_POST["mesaj"];
	
	$result = mysql_query("select gonderen, gonderenad, konu, mesaj, kayit, durum from "._MX."uye_mesaj where id='$mesajid' and gonderilen='$uyeid'");
	
	list($gonderen, $gonderenad, $konu, $mesaj, $kayit, $durum) = mysql_fetch_row($result);
	
	$konu = turkcejquery(addslashes($konu));
	
	$mesaj = turkcejquery(addslashes($mesaj));
	
	$kayit = date("d.m.Y H:i", $kayit);
	
	if($durum == 2){
	
		mysql_query("update "._MX."uye_mesaj set durum='1' where id='$mesajid'");
	
	}
	
	$ayararsiv = uyebilgi("mesajayararsiv");
	
	if($ayararsiv == 1){

		mysql_query("update "._MX."uye_mesaj set yer='2' where id='$mesajid'");
		
	}
	
?>
	<tr>
		<td>
										<table border="0" width="100%" id="table257" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_mor.gif" height="46">
												<table border="0" width="100%" id="table309" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Mesaj Oku</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table289" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" width="100%" id="table290" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table291" cellspacing="0" cellpadding="0">
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494" background="img/pncre_alt_msg_oku_ic_ust.gif" height="80">
																		<table border="0" width="100%" id="table295" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="90" height="80">&nbsp;</td>
																				<td>
																		<table border="0" width="100%" id="table297" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>
																				<p class="soru">Gönderen <?=$gonderenad?></td>
																			</tr>
																			<tr>
																				<td height="4"></td>
																			</tr>
																			<tr>
																				<td>
																				<p class="msg_tit"><b><?=$konu?></b></td>
																			</tr>
																		</table>
																				</td>
																				<td width="110">
																		<table border="0" width="100%" id="table296" cellspacing="0" cellpadding="0">
																			<tr>
																				<td align="right">
																				<p class="yas"><?=$kayit?></td>
																			</tr>
																			<tr>
																				<td height="16"></td>
																			</tr>
																			<tr>
																				<td align="right">
																				<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$gonderen?>', '745', '700', 'profilpopup<?=$gonderen?>', 2, 1, 1);"><img border="0" src="img/btn_proflnebak.gif" width="86" height="22"></a></td>
																			</tr>
																		</table>
																				</td>
																				<td width="10">&nbsp;</td>
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
																		<table border="0" width="100%" id="table294" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>&nbsp;</td>
																				<td width="440">
																				<p class="tx">
																				<?=$mesaj?>
																				</p>
																				</td>													
																				<td>&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="12"></td>
																		<td width="494" height="12"></td>
																		<td height="12"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494" align="center">
																		<table border="0" width="100%" id="table292" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>&nbsp;</td>
																				<td width="476" height="51" background="img/msg_oku_btn_bg.gif" align="center" valign="top">
																				<table border="0" id="table293" cellspacing="0" cellpadding="0">
																					<tr>
																						<td height="20">&nbsp;</td>
																						<td width="13" height="20">&nbsp;</td>
																						<td height="20">&nbsp;</td>
																						<td width="13" height="20">&nbsp;</td>
																						<td height="20">&nbsp;</td>
																					</tr>
																					<tr>
																						<td><a href="javascript:arsiv(<?=$mesajid?>)"><img border="0" src="img/bnt_msgoku_arsivegonder.gif" width="110" height="31"></a></td>
																						<td width="13">&nbsp;</td>
																						<td><a href="javascript:yasakla(<?=$gonderen?>)"><img border="0" src="img/bnt_msgoku_engelle.gif" width="130" height="31"></a></td>
																						<td width="13">&nbsp;</td>
																						<td><a href="javascript:mesajgonder(<?=$gonderen?>)"><img border="0" src="img/bnt_msgoku_cevapla.gif" width="110" height="31"></a></td>
																					</tr>
																				</table>
																				</td>
																				<td>&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10">
																		</td>
																		<td width="494" height="10">
																		</td>
																		<td height="10">
																		</td>
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
														<td>&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif" height="10">
												<img border="0" src="img/1px.gif" width="1" height="1"></td>
											</tr>
											<tr>
												<td background="img/alt_kapa_mor.gif" height="41">
												<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
													<tr>
														<td width="10" height="41">&nbsp;</td>
														<td align="center">
														<a href="javascript:sil(<?=$mesajid?>)"><img border="0" src="img/btn_x_bumesaji_sil.gif" width="80" height="18"></a></td>
														<td width="10">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td>
												&nbsp;</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											</table>
		</td>
	</tr>
<?
	die();
	
}

if($islem == "sil"){

	$mesajid = $_POST["mesaj"];
	
	$result = mysql_query("update "._MX."uye_mesaj set masaustusil='1' where id='$mesajid' and gonderilen='$uyeid'");
	
	die();
}

if($islem == "sil2"){

	$mesajid = $_POST["mesaj"];
	
	$result = mysql_query("delete from "._MX."uye_mesaj_giden where id='$mesajid' and gonderen='$uyeid'");
	
	die();
}


if($islem == "arsiv"){

	$mesajid = $_POST["mesaj"];
	
	$result = mysql_query("update "._MX."uye_mesaj set yer='2' where id='$mesajid' and gonderilen='$uyeid'");
	
	die();
	
}
?>