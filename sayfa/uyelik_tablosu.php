<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Üyelik Tablosu <?=$uyeadi?>, <?=_BASLIK?></title>
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
														Üyelik Karşılaştırma 
														Tablosu</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table525" cellspacing="0" cellpadding="0">
													<tr>
														<td height="8"></td>
														<td width="510" height="8">
														</td>
														<td height="8"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table566" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="33">&nbsp;</td>
																		<td>
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td>
																				<p class="form_txt"><font color="#009900"><img border="0" src="img/iko_ok_mavi.gif" width="11" height="11"></font></td>
																				<td width="6">&nbsp;</td>
																				<td>
																				<p class="form_txt"><font color="#0000FF">SİTE İÇİ KULLANIM ALANLARI</font></td>
																			</tr>
																		</table>
																		</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" background="img/uyelik_tab_tit_free.gif">
																		<p class="form_txt">
																		smalll</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" background="img/uyelik_tab_tit_medium.gif">
																		<p class="form_txt">
																		medium</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" background="img/uyelik_tab_tit_large.gif">
																		<p class="form_txt">
																		large</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Profil 
																		oluşturma</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Profil 
																		güncelleme</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Profil 
																		görüntüleme</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Profile 
																		bakanları 
																		listeleme</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Profilime 
																		bakanları 
																		arşivde 
																		saklama</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Profile 
																		resim 
																		ekleme</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<p class="form_txt">
																		8 adet<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		25 adet</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		45 adet</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Profil 
																		resimlerini 
																		büyütme</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Hızlı 
																		üye 
																		arama</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Detaylı 
																		üye 
																		arama</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Online 
																		üyeleri 
																		listeleme</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Mesaj 
																		gönderme</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		Günlük 
																		25 adet</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Mesaj 
																		okuma</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Profilime 
																		bakanları 
																		arşivde 
																		saklama</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Mesaj 
																		cevaplama</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Giden 
																		mesajların 
																		okundu 
																		bilgisi</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Öpücük 
																		yollama</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		Günlük 
																		15 adet</td>
																	</tr>
																</table>
																		</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Öpücük 
																		yollayanları 
																		görme</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Çiçek 
																		yollama</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		Günlük 
																		15 adet</td>
																	</tr>
																</table>
																		</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Çiçek 
																		yollayanları 
																		görme</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Üye 
																		yasaklama</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Yasaklıları 
																		listeleme</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Okey 
																		odalarına 
																		giriş</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Sohbet 
																		odalarına 
																		giriş</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td bgcolor="#F9F9F9">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td>
																		<p class="cc">
																		Web cam 
																		odalarına 
																		giriş</td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<img border="0" src="img/iko_olmaz.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																		<td width="7" bgcolor="#FFFFFF">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="form_txt">
																		<img border="0" src="img/iko_olur.gif" width="16" height="16"></td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																&nbsp;</td>
															</tr>
															<tr>
																<td>
																&nbsp;</td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="33">&nbsp;</td>
																		<td align="right">
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td>
																				<p class="form_txt"><font color="#0000FF">ÜYELİK SÜRE ve ÜCRETLENDİRME</font></td>
																				<td width="10">&nbsp;</td>
																				<td><font color="#009900"><img border="0" src="img/iko_ok_mavi.gif" width="11" height="11"></font></td>
																			</tr>
																		</table>
																		</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" background="img/uyelik_tab_tit_free.gif">
																		<p class="form_txt">
																		smalll</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" background="img/uyelik_tab_tit_medium.gif">
																		<p class="form_txt">
																		medium</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" background="img/uyelik_tab_tit_large.gif">
																		<p class="form_txt">
																		large</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
																	<?php
																		$result = mysql_query("select aylik, aylik3, aylik6, yillik, sinirsiz from "._MX."seviye where id='2'");
																		
																		list($maylik, $maylik3, $maylik6, $myillik, $msinirsiz) = mysql_fetch_row($result);
																		
																		$result = mysql_query("select aylik, aylik3, aylik6, yillik, sinirsiz from "._MX."seviye where id='1'");
																		
																		list($laylik, $laylik3, $laylik6, $lyillik, $lsinirsiz) = mysql_fetch_row($result);
																						
																		
																	?>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td align="right">
																		<p class="cc">
																		<b>1 
																		AYLIK 
																		(YTL)</b></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<p class="form_txt">
																		ücretsiz</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="merkez_shop">
																		<?=$maylik?> TL</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="merkez_shop">
																		<?=$laylik?> TL</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td align="right">
																		<p class="cc">
																		<b>3 
																		AYLIK 
																		(YTL)</b></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<p class="form_txt">
																		ücretsiz</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="merkez_shop">
																		<?=$maylik3?> TL</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="merkez_shop">
																		<?=$laylik3?> TL</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td align="right">
																		<p class="cc">
																		<b>6 
																		AYLIK 
																		(YTL)</b></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<p class="form_txt">
																		ücretsiz</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="merkez_shop">
																		<?=$maylik6?> TL</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="merkez_shop">
																		<?=$laylik6?> TL</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="26">&nbsp;</td>
																		<td align="right">
																		<p class="cc">
																		<b>12 
																		AYLIK 
																		(YTL)</b></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F8FFF4">
																		<p class="form_txt">
																		ücretsiz</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F4FAFD">
																		<p class="merkez_shop">
																		<?=$myillik?> TL</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#FFF9FE">
																		<p class="merkez_shop">
																		<?=$lyillik?> TL</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#E6E6E6">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="7" height="33">&nbsp;</td>
																		<td>
																		&nbsp;</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" bgcolor="#F9F9F9">
																		&nbsp;</td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" background="img/uyelik_tab_tit_sa.gif">
																		<p class="merkez_profil">
																		<font color="#C6200B">
																		<a class="lnk01" href="index.php?sayfa=uyelik_yukselt">satın al</a></font></td>
																		<td width="7">&nbsp;</td>
																		<td width="60" align="center" background="img/uyelik_tab_tit_sa.gif">
																		<p class="merkez_profil">
																		<font color="#C6200B">
																		<a class="lnk01" href="index.php?sayfa=uyelik_yukselt">satın al</a></font></td>
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
												<td background="img/pncere1_a_bg.gif" height="11">
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
								<p class="copyright">Copyright 2010<br>
								<?=_AD?></td>
								<td align="right" valign="bottom">
								<p class="c2"><a class="c1" href="index.php?sayfa=kullanim_sartlari">Kullanım 
								Şartları</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=gizlilik_ilkeleri">Gizlilik İlkeleri</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=yardimmaili">Bize Ulaşın</a></td>
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