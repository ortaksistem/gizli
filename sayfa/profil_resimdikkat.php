<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Resim Eklerken Dikkat Edilmesi Gerekenler <?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
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
<body onLoad="menuler('profilmerkezi');">

										
										<!-- icerik baslangic -->
										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_turuncu.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														UYARI!</td>
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
														<td width="510" align="right">
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/bg_alan_resim_uygunsuz_sol.gif" width="10" height="30"></td>
																		<td background="img/bg_alan_resim_uygunsuz_bg.gif" valign="bottom">
																		<p class="tit_1_beyaz">
																		Eklenemeyecek 
																		Resimler</td>
																		<td>
																		<img border="0" src="img/bg_alan_resim_uygunsuz_sag.gif" width="10" height="30"></td>
																		<td width="15" height="30">&nbsp;</td>
																	</tr>
																</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" height="120" background="img/bg_alan_resim_uygunsuz.gif" align="center" valign="bottom">
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																		<td width="27">&nbsp;</td>
																		<td>
																		<img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																		<td width="27">&nbsp;</td>
																		<td>
																		<img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																		<td width="27">&nbsp;</td>
																		<td>
																		<img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																	</tr>
																</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																<p class="form_txt">
																At vero eos et 
																accusamus et 
																iusto odio 
																dignissimos 
																ducimus qui 
																blanditiis 
																praesentium 
																voluptatum 
																deleniti atque 
																corrupti quos 
																dolores et quas 
																molestias 
																excepturi sint 
																occaecati 
																cupiditate non 
																provident, 
																similique sunt 
																in culpa qui 
																officia deserunt 
																mollitia animi, 
																id est laborum 
																et dolorum fuga. 
																Et harum quidem 
																rerum facilis 
																est et expedita </td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="right">
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/bg_alan_resim_uygunsuz_sol.gif" width="10" height="30"></td>
																		<td background="img/bg_alan_resim_uygunsuz_bg.gif" valign="bottom">
																		<p class="tit_1_beyaz">
																		Ana 
																		Resim 
																		Olamayacak 
																		Resimler</td>
																		<td>
																		<img border="0" src="img/bg_alan_resim_uygunsuz_sag.gif" width="10" height="30"></td>
																		<td width="15" height="30">&nbsp;</td>
																	</tr>
																</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" height="120" background="img/bg_alan_resim_uygunsuz.gif" align="center" valign="bottom">
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																		<td width="27">&nbsp;</td>
																		<td>
																		<img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																		<td width="27">&nbsp;</td>
																		<td>
																		<img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																		<td width="27">&nbsp;</td>
																		<td>
																		<img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																	</tr>
																</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																		&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																		<p class="form_txt">
																		At vero 
																		eos et 
																		accusamus 
																		et iusto 
																		odio 
																		dignissimos 
																		ducimus 
																		qui 
																		blanditiis 
																		praesentium 
																		voluptatum 
																		deleniti 
																		atque 
																		corrupti 
																		quos 
																		dolores 
																		et quas 
																		molestias 
																		excepturi 
																		sint 
																		occaecati 
																		cupiditate 
																		non 
																		provident, 
																		similique 
																		sunt in 
																		culpa 
																		qui 
																		officia 
																		deserunt 
																		mollitia 
																		animi, 
																		id est 
																		laborum 
																		et 
																		dolorum 
																		fuga. Et 
																		harum 
																		quidem 
																		rerum 
																		facilis 
																		est et 
																		expedita
																		</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																		&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="right">
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td><img border="0" src="img/bg_alan_resim_uygun_tiksol.gif" width="10" height="30"></td>
																				<td background="img/bg_alan_resim_uygun_tikbg.gif" valign="bottom">
																				<p class="tit_1_beyaz">Ana Resim Olabilecek Resimler</td>
																				<td><img border="0" src="img/bg_alan_resim_uygun_tiksag.gif" width="10" height="30"></td>
																				<td width="15" height="30">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" background="img/bg_alan_resim_uygun.gif" height="120" align="center" valign="bottom">
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td><img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																				<td width="27">&nbsp;</td>
																				<td><img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																				<td width="27">&nbsp;</td>
																				<td><img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																				<td width="27">&nbsp;</td>
																				<td><img border="0" src="img/sil_uygunsuz.gif" width="94" height="94"></td>
																			</tr>
																		</table>
																		</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																		&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																		<p class="form_txt">
																		At vero 
																		eos et 
																		accusamus 
																		et iusto 
																		odio 
																		dignissimos 
																		ducimus 
																		qui 
																		blanditiis 
																		praesentium 
																		voluptatum 
																		deleniti 
																		atque 
																		corrupti 
																		quos 
																		dolores 
																		et quas 
																		molestias 
																		excepturi 
																		sint 
																		occaecati 
																		cupiditate 
																		non 
																		provident, 
																		similique 
																		sunt in 
																		culpa 
																		qui 
																		officia 
																		deserunt 
																		mollitia 
																		animi, 
																		id est 
																		laborum 
																		et 
																		dolorum 
																		fuga. Et 
																		harum 
																		quidem 
																		rerum 
																		facilis 
																		est et 
																		expedita
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


										<!-- icerik bitis -->

</body>
</html>