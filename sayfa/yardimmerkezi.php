<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Yard�m Merkezi <?=$uyeadi?>, <?=_BASLIK?></title>
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
														Yard�m Merkezi</td>
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
																		<b>SIK�A 
																		SORULAN 
																		SORULAR</b></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" height="4"></td>
																		<td height="4"></td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#yukseltme">
																		�yeli�imi 
																		nas�l 
																		y�kseltebilirim ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nasilolurum">
																		�cretsiz Medium ve ya Large �yelik nas�l alabilirim ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#sohbetodalari">
																		Sohbet odalar�ndan yararlanmak i�in nelere ihtiyac�m var?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nedenkullanamiyor">Small �yeler neden sistemi kullanam�yorlar 
																		?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nedenkisitlaniyor">
																		Small �yeler neden bu kadar k�s�tlan�yor?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#puansistemi">
																		Puan sistemi nas�l �al���yor ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nedenonaylanmadi">
																		Profilimde resimlerim neden onaylanmad� ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nedenyukleyemiyoruz">
																		Neden Profilimize istedi�imiz resimleri y�kleyemiyoruz ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nedenokumuyor">
																		Mesaj yollad���m ki�iler neden mesajlar�m� okumuyor ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#medium">
																		Medium ve Large �yeler Mesajla�malarda Nelere Dikkat Etmeliler ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
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
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="yukseltme">�yeli�imi 
																		Nas�l 
																		Y�kseltebilirim?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																																				�yeli�i y�kseltmenin en 
                  h�zl� yolu kredi kart� veya havale ile �yelik sat�n 
                  almakt�r.Bu �ekilde �yelik sat�n almak i�in Profiliniz ve 
                  men�de bulunan �yeli�imi Y�kselt linklerine t�klayarak sat�n 
                  almak istedi�iniz �yelik tipini belirleyerek ileriki ad�mlara 
                  ge�ebilirsiniz.�deme bilgilerini doldurup gerekli �demeyi 
                  Kredi Kart� veya Havale ile yapt���n�zda �yeli�iniz �demesi 
                  yap�lm�� olan �yelik tipi �eklinde a��lacak ve sat�n alm�� 
                  oldu�unuz �yelik tipinin haklar�n� kullanmaya 
                  ba�layabileceksiniz.
																		</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table722" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table723" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nasilolurum">�cretsiz Medium veya Large �yelik nas�l alabilirim?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																																				Bunu yapman�n 2 yolu 
                  bulunmaktad�r.Birincisi Puan sistemidir bu sistem ile size 
                  verilen puanlar� toplayarak.Belli bir puana ula�t�ktan sonra 
                  puan�n�zla �yelik alabilirsiniz.Puanlar�n nas�l kazan�laca�� 
                  Puan Nas�l Toplar�m linkinde mevcuttur. <BR>Di�er yol ise bu 
                  sadece bayan ve de �ift �yeler i�in ge�erlidir.GKS'li �ye 
                  olarak �cretsiz yararlanabilirsiniz</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table724" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table725" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="sohbetodalari">Sohbet odalar�ndan yararlanmak i�in nelere ihtiyac�m var?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																																				�ncelikle Medium 
                  veya Large �yeli�e ihtiyac�n�z var.Bu iki tip �yelikten birine 
                  sahipseniz sohbete girmek i�in bilgisayar�n�zda Java y�kl� 
                  olmas� yeterlidir...</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table726" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table727" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nedenkullanamiyor">Small �yeler neden sistemi kullanam�yorlar.</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		Small �yelik sistemi 
                  siteyi incelemeniz ve de be�endi�iniz takdirde Medium yada 
                  Large �yeliklerden al�p almamaya karar vermenizi sa�lamak i�in 
                  vard�r .Small �yelik sistemi kullanmak i�in de�il sistemi ve 
                  i�leyi�ini tan�mak i�in a��lan �yelik tipidir.</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table728" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table729" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nedenkisitlaniyor">Small �yeler neden bu kadar k�s�tlan�yor?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		Small �yelik her sistemde 
                  siteyi tan�tmak amac� ile olu�turulmu� bir �yelik bi�imidir ve 
                  �cretsizdir ve de sitenin bir �ok �zelli�inden hi� bir yerde 
                  yararlanamaz sistemi be�enirse �yeli�ini y�kseltir ve 
                  yararlanmak istediklerinden yararlanabilir. Small �ye nin 
                  mesaj hakk� bulunmamaktad�r...
																		</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table730" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table731" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="puansistemi">Puan sistemi nas�l �al���yor?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		Puan 
																		sistemi 
																		sitede 
																		yapaca��n�z 
																		her 
																		t�rl� 
																		aktivite 
																		sonucunda 
																		sistemin 
																		size 
																		verece�i 
																		puanlar 
																		sayesinde 
																		�al���r. 
																		Bu 
																		puanlar� 
																		daha 
																		sonra 
																		kullanarak 
																		SHOP 
																		merkezimden 
																		diledi�iniz 
																		�ekilde 
																		harcayabilirsiniz...</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table732" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table733" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nedenonaylanmadi">Profilimde resimlerim neden onaylanmad�?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																																				Bunun bir 
																		ka� sebebi 
                  olabilir.�ncelikle onay verilecekleri hen�z Edit�rlerimiz 
                  incelememi� olabilir ancak en s�k g�r�len neden sizin 
                  resimlerinizden Ana resim se�memi� olman�zd�r. Ana resim 
                  se�erseniz resimlerinizde g�r�l�r
																		</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table734" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table735" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nedenyukleyemiyoruz">Neden 
																		profilimize 
																		istedi�imiz 
																		resimleri 
																		y�kleyemiyoruz 
																		?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																																				Buras� profil ve 
                  resim bilgilerini �ok ciddiye alan bir sitedir ve kesin 
                  de�i�mez kurallar�m�zdan biride size ait olmayan resimlerin 
                  eklenmesine kesinlikle izin verip alakas�z resimler ile resimli 
                  profil aramalar�nda ��karak sadece resimli profil arayan 
                  �yelerimizin vaktini bo�a harcaman�z� engellemektir.�it 
                  olmayan �yelerde yine ba�kalar� ile olan resimlerini ekleyemez 
                  bu tip profillerde de �yelik tipi ne olursa olsun taraf�m�zdan 
                  silinir.
																		</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table736" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table737" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nedenokumuyor">Mesaj yollad���m ki�iler neden mesajlar�m� okumuyor ?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		Bu sorunun muhatab� 
                  mesaj� att���n�z ki�idir bunu bizlere sorman�z yanl��t�r.Mesaj 
                  att���n�z ki�i sisteme girmiyor olabilir, mesaj�n�zla 
                  ilgilenmiyor olabilir bunun bir garantisi yoktur...
																		</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table738" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table739" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="medium">Medium ve Large �yeler Mesajla�malarda Nelere Dikkat Etmeliler ?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		�yelik sat�n alarak 
                  ciddiyetinizi , kararl�l���n�z�, isteklili�inizi kan�tlam�� 
                  ki�iler olarak Medium ve Large �yeler standart �yelere 
                  mesajlar�nda mail adresi vererek ayr�ca kendilerini riske atmaktad�rlar. Unutmay�n siz kendinizi kan�tlam��ken k���k bir 
                  bedeli �demeden size ula�mak isteyen ki�iler bizler ne kadar 
                  �aba g�ster sekte profillerinde yazd�klar� ki�iler olmayabilir. Bu tip durumlarda kar��la�abilece�iniz sorunlardan sitemiz 
                  kesinlikle sorumlu tutulamaz.Mail adresi �al�nmas�na kadarda 
                  her t�rl� sorunu ya�ayabilirsiniz.Unutmay�n birileri ile 
                  tan��man�n en g�zel yolu sizin �dedi�iniz bedeli �demi� 
                  ciddiyetlerini kan�tlam�� ki�ilerle tan��makt�r.Bu �ekilde her 
                  t�rl� riski minimuma indirmi� olursunuz.</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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