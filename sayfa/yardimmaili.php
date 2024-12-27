<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Yardım Maili <?=$uyeadi?>, <?=_BASLIK?></title>
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
	
	function gonder(){
		
		var konu = document.getElementById("konu").value;
		var mesaj = document.getElementById("mesaj").value;
		
		if(konu == ""){
			$("#mailsonuc").html("<font color=red><b>Konuyu seçin</b></font>");
		}
		else if(mesaj == ""){
			$("#mailsonuc").html("<font color=red><b>Mesajı Yazın</b></font>");
		}
		else {
			$("#mailsonuc").html("<img src='img/loading.gif' /> Bekleyin");

			jQuery.ajax({
				type : 'POST',
				url : 'inc/mailgonder.php',
				data : "mesaj="+mesaj+"&konu="+konu,
				success: function(sonuc){		
					if(sonuc == "hata"){
						$("#mailsonuc").html("<font color=red><b>Mailiniz şuan gönderilemiyor, lütfen sonra tekrar deneyiniz</b></font>");

					}
					else {
						$("#mailsonucok").hide();
						$("#mailsonucok").html("<tr><td>"+sonuc+"</td></tr>");
						$("#mailsonucok").show("slow");	
					}
				}
			})
				
		}
	
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
										

										<table id="mailsonucok" border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_turuncu.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Online Yardım</td>
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
														<td width="510" align="center">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<b>Sayın <?=$uyeadi?></b></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" height="10"></td>
																		<td height="10"></td>
																		<td width="15" height="10"></td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>
																		<p class="form_txt" style="text-align:justify">
																		Öncelikle 
																		S.S.S 
																		(sıkça 
																		sorulan 
																		sorular, yardım merkezi) 
																		bölümünden 
																		sizin 
																		aradığınız 
																		sorunun 
																		cevabı 
																		olup 
																		olmadığını 
																		kontrol 
																		ediniz. 
																		Cevabı 
																		verilmiş 
																		olan 
																		soruların 
																		tekrarına 
																		herhangi 
																		bir 
																		cevap 
																		yazılmamaktadır.Bu 
																		konuyu 
																		önemle 
																		hatırlatır 
																		en kısa 
																		zaman 
																		içerisinde 
																		harici 
																		probleminizin 
																		çözüleceğini 
																		belirtiriz.</td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="14"></td>
														<td width="510" align="center" height="14">
														</td>
														<td height="14"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table307" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table308" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18"></td>
																		<td width="494" height="27" align="right">
																		<p class="tit_zdshop_mer">
																		YatakPartner 
																		Yönetimine</td>
																		<td height="18"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200">
																				<p class="form_txt">Konu:</td>
																				<td>
																				<p class="form_txt">Mesajınız:</td>
																				<td width="20">&nbsp;</td>
																			</tr>
																			<tr>
																				<td width="15" height="6"></td>
																				<td height="6" width="200">
																				</td>
																				<td height="6">
																				</td>
																				<td width="20" height="6"></td>
																			</tr>
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td width="200" valign="top">
																								<select name="konu" id="konu" class="selectler">
																				<option value="">Seçiminiz:</option>
																				<option value="Kredi Kartı Problemi">Kredi Kartı Problemi</option>
																				<option value="Havale Problemi">Havale Problemi</option>
																				<option value="Üyelik Seviyesi">Üyelik Seviyesi</option>
																				<option value="Resim Problemi">Resim Problemi</option>
																				<option value="Şifre Problemi">Şifre Problemi</option>
																				<option value="Mesaj Problemi">Mesaj Problemi</option>
																				<option value="Profil Problemi">Profil Problemi</option>
																				<option value="Teşekkür Mesajı">Teşekkür Mesajı</option>
																				<option value="Diğer Sorunlar">Diğer Sorunlar</option>
																				</select></td>
																				<td>
																				<textarea rows="10" name="mesaj" id="mesaj" cols="45" style="font-family: Tahoma; font-size: 8pt; padding-left: 1px; padding-right: 1px"></textarea></td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="7"></td>
																		<td width="494" height="7"></td>
																		<td height="7"></td>
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
																						<table border="0" style="border-collapse: collapse" cellpadding="0">
																							<tr>
																								<td width="20">&nbsp;</td>
																								<td>
																								<p class="merkez_profil"><span id="mailsonuc"></span></td>
																							</tr>
																						</table>
																						</td>
																						<td width="150" align="right">
																				<table border="0" id="table319" cellspacing="0" cellpadding="0">
																					<tr>
																						<td width="13" height="20">&nbsp;</td>
																						<td width="30" height="20">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="13"><a href="javascript:gonder()"><img border="0" src="img/btn_gonderdavtet.gif" width="110" height="31"></a></td>
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
												<td background="img/alt_kapa_turuncu.gif" height="41">
												&nbsp;</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td align="center">
												<? echo stripslashes(ayar("icerikalti")); ?>
												</td>
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
										üyeler</a></b></td>
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
										<td><b><a class="c" href="index.php?sayfa=uyelik_yukselt">üyeliğini 
										yükselt</a></b></td>
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
										<td><b><a class="c" href="index.php?sayfa=yardimmerkezi">yardım merkezi</a></b></td>
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
								<p class="copyright">Copyright 2004-2010<br>
								<?=_AD?></td>
								<td align="right" valign="bottom">
								&nbsp;</td>
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