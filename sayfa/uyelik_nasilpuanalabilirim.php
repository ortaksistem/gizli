<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Nas�l Puan Alabilirim <?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link rel="stylesheet" href="inc/basic.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type='text/javascript' src='inc/jquery.simplemodal.js'></script>
<style>
	body {
		background: url(img/bg.gif);
	}
</style>
<script type="text/javascript">
	function menuler(menu){ 
		
		$("#mesajmerkezitablo").hide();
		$("#arkadasmerkezitablo").hide();
		$("#aramamerkezitablo").hide();
		$("#profilmerkezitablo").hide();
		
		$("#"+menu+"tablo").show("slow");
	}
</script>
</head>
<body onLoad="menuler('durummerkezi');">
<div id="mahirix-modal-content">
	<div id="mahirix-model-header">
		<div id="mahirix-model-title"></div>
		<div id="mahirix-model-title-kapat"><a href="javascript:void(0)" onclick="mahirixmodelkapat();" title="Kapat"><img src="img/mahirix_alert_kapat.png" border="0" /></a></div>
	</div>
	<div style="clear:both;"></div>
	<div id="mahirix-model-icc"></div>
	<div id="mahirix-model-alt"></div>
</div>
<table border="0" width="100%" id="table1" cellspacing="0" cellpadding="0" height="100%">
	<tr>
		<td width="16">&nbsp;</td>
		<td width="790" valign="top">
		<table border="0" width="100%" id="table2" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<table border="0" width="100%" id="table3" cellspacing="0" cellpadding="0">
					<tr>
						<td width="10" background="img/ste_golge_sol.gif">&nbsp;</td>
						<td bgcolor="#FFFFFF">
						<table border="0" width="100%" id="table13" cellspacing="0" cellpadding="0">
							
							<?php include("inc/giris-ust.php"); ?>
							
							<tr>
								<td background="img/ic_alan_gri_bg.gif">
								<table border="0" width="100%" id="table14" cellspacing="0" cellpadding="0">
									<tr>
										<td width="10">&nbsp;</td>
										<td width="200" valign="top">
										
										<?php include("inc/giris-sol.php"); ?>
										
										</td>
										
										
										<td width="6">&nbsp;</td>
										<td width="540" valign="top" align="center">
										<!-- icerik -->
										

										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_turuncu.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Puan Tablom</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table525" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="260" valign="top">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td background="img/penc_puantablom_us.gif" height="60" valign="bottom">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="15">&nbsp;</td>
																						<td height="39">
																						<p class="tit_mesajmer">Puanlar�m</td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			<tr>
																				<td background="img/penc_puantablom_bg.gif">
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Mesaj G�nderme Puan�n�z</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">5</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Siteye Login Olma Puan�n�z</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">10</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Ana Resim Puan�n�z</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">100</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Toplam Galeri Puan�n�z</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">30</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Oy Verme Puan�n�z</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">2</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Davet G�nderme Puan�n�z</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">10</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Gelen Mesaja Cevap Puan�n�z</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">5</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Hayranl�k Puan�n�z</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">5</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Ana Resimden Sonraki Resimler</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">20</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Medium Olma Puan�n�z</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">5000</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt">Large Olma Puan�n�z</td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt">10000</td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E4E4E4"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="10"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="10">&nbsp;</td>
																						<td>
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td height="23" width="6">&nbsp;</td>
																								<td height="23">
																								<p class="form_txt"><b><font color="#F95822">Kullan�labilir Toplam Puan</font></b></td>
																								<td width="30" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																								<td width="55">
																								<p class="form_txt"><font color="#F95822">0</font></td>
																							</tr>
																						</table>
																						</td>
																						<td width="10">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="10" height="5"></td>
																						<td height="5"></td>
																						<td width="10" height="5"></td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			<tr>
																				<td><img border="0" src="img/penc_puantablom_al.gif" width="260" height="10"></td>
																			</tr>
																		</table>
																		</td>
																		<td width="15">&nbsp;</td>
																		<td valign="top">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td>&nbsp;</td>
																			</tr>
																			<tr>
																				<td height="39">
																		<p class="tit_mesaj_mer">
																		<font color="#F95822">
																		Nas�l 
																		Puan 
																		Kazan�r�m?</font></td>
																			</tr>
																			<tr>
																				<td>
																		<p class="yer">
																		Sistemde 
																		yapaca��n�z 
																		her 
																		aktivite 
																		i�in 
																		puan 
																		kazanabilirsiniz. 
																		Bunun 
																		i�in 
																		yandaki 
																		tabloya 
																		uygun 
																		hareket 
																		etmeniz 
																		yeterli 
																		olacakt�r. <br>Biriken puanlar�n�zla �yelik veya SHOP merkezimden 
																		istedi�iniz 
																		herhangi 
																		bir 
																		�r�n�n 
																		sipari�ini 
																		verebilirsiniz. 
																		�r�n 
																		sipari�i 
																		i�in 
																		puan�n�z�n 
																		yeterli 
																		olmas� 
																		gerekmektedir. </td>
																			</tr>
																			<tr>
																				<td>&nbsp;</td>
																			</tr>
																			<tr>
																				<td align="center">
																				<table border="0" style="border-collapse: collapse" cellpadding="0">
																					<tr>
																						<td valign="top">
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td>
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td>
																		<img border="0" src="img/uyelik_ufak_medium.gif" width="33" height="15"></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="cc">�YEL�K</td>
																			</tr>
																		</table>
																								</td>
																							</tr>
																							<tr>
																								<td height="9"></td>
																							</tr>
																							<tr>
																								<td>
																				<p class="offline"><font color="#0000FF">1 Ayl�kta 39,000<br>
																				3 Ayl�kta 59,000<br>
																				6 Ayl�kta 79,000<br>
																				1 Senelik 99,000</font></td>
																							</tr>
																							</table>
																						</td>
																						<td width="39" align="center">&nbsp;</td>
																						<td valign="top">
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td>
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td>
																		<img border="0" src="img/uyelik_ufak_large.gif" width="33" height="15"></td>
																				<td width="8">&nbsp;</td>
																				<td>
																				<p class="cc">�YEL�K</td>
																			</tr>
																		</table>
																								</td>
																							</tr>
																							<tr>
																								<td height="9"></td>
																							</tr>
																							<tr>
																								<td>
																				<p class="offline">1 Ayl�kta 49,000 <br>
																				3 Ayl�kta 69,000 <br>
																				6 Ayl�kta 89,000 <br>
																				1 Senelik 109,000 </td>
																							</tr>
																							</table></td>
																					</tr>
																				</table>
																				</td>
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
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif" height="10">
												<img border="0" src="img/1px.gif" width="1" height="1"></td>
											</tr>
											<tr>
												<td background="img/alt_kapa_turuncu.gif" height="41">
												&nbsp;</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td align="center">
												<font color="#7B7B7B">banner 
												alan�</font></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											</table>


											
										<!-- icerik sonu -->
										</td>
										<td width="8">&nbsp;</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td>
								<img border="0" src="img/ic_alan_gri_alt.gif" width="770" height="8"></td>
							</tr>
						</table>
						</td>
						<td width="10" background="img/ste_golge_sag.gif">&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td background="img/ste_alt2.gif" height="93" valign="top">
				<table border="0" width="100%" id="table4" cellspacing="0" cellpadding="0">
					<tr>
						<td width="25" height="7"></td>
						<td height="7"></td>
						<td width="25" height="7"></td>
					</tr>
					<tr>
						<td width="25" height="29">&nbsp;</td>
						<td height="29">
						<table border="0" id="table6" cellspacing="0" cellpadding="0">
							<tr>
								<td>
								<table border="0" id="table7" cellspacing="0" cellpadding="0">
									<tr>
										<td><b><a class="c" href="index.php">ana sayfa</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table8" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=okey">okey oyna</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table9" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=sohbet">sohbet et</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table10" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=arkadas_onlineuyeler">online 
										�yeler</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table11" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=uyelik_yukselt">�yeli�ini 
										y�kselt</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
								<td width="1">
								<img border="0" src="img/mnu_alt_bol.gif" width="1" height="29"></td>
								<td>
								<table border="0" id="table12" cellspacing="0" cellpadding="0">
									<tr>
										<td width="16">&nbsp;</td>
										<td><b><a class="c" href="index.php?sayfa=yardimmerkezi">yard�m merkezi</a></b></td>
										<td width="16">&nbsp;</td>
									</tr>
								</table>
								</td>
							</tr>
						</table>
						</td>
						<td width="25" height="29">&nbsp;</td>
					</tr>
					<tr>
						<td width="25" height="10"></td>
						<td height="10"></td>
						<td width="25" height="10"></td>
					</tr>
					<tr>
						<td width="25">&nbsp;</td>
						<td>
						<table border="0" width="100%" id="table5" cellspacing="0" cellpadding="0">
							<tr>
								<td width="150">
								<p class="copyright">Copyright 2010<br>
								<?=_AD?></td>
								<td align="right" valign="bottom">
								<p class="c2"><a class="c1" href="index.php?sayfa=kullanim_sartlari">Kullan�m 
								�artlar�</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=gizlilik_ilkeleri">Gizlilik �lkeleri</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=yardimmaili">Bize Ula��n</a></td>
							</tr>
						</table>
						</td>
						<td width="25">&nbsp;</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td valign="top">
		<table border="0" id="table169" cellspacing="0" cellpadding="0">
			<tr>
				<td width="15" height="156">&nbsp;</td>
				<td width="161" height="156">&nbsp;</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">
				<?php include("inc/giris-sag.php"); ?>
				</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">&nbsp;</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">&nbsp;</td>
			</tr>
		</table>
		</td>
	</tr>
</table>


</body>
</html>