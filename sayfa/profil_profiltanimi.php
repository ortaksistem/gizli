<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$result = mysql_query("select tanitim, tanitimonay from "._MX."uye where id='$uyeid'");

list($tanitim, $tanitimonay) = mysql_fetch_row($result);

$tanitim = stripslashes($tanitim);

if($tanitimonay == 1) $tanitimonay = "<font color=green>ONAYLANDI</font>";
elseif($tanitimonay == 3) $tanitimonay = "<font color=red><b>Edit�r Taraf�ndan Red Edilmi�</b></font>";
else $tanitimonay = "<font color=red>Onay Bekliyor</font>";
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Ki�isel Bilgilerinizi D�zenleyin <?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
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
	
	function kaydet(){
	
		var onayla = confirm("Yazd���n�z tan�t�m yaz�s� ED�TOR taraf�ndan onayland�ktan sonra yay�na girecektir.\nProfil tan�t�m�n�zda msn, mail, adres, telefon, hakaret, k�f�r ve �yeleri k���k d���r�c� unsurlar var ise �yelik �eklinize bak�lmadan �yeli�inizin silinmesine neden olur ve yasal i�lem s�recine kadar gider l�tfen bu konuda dikkatli olunuz..\nTe�ekk�r ederiz...");
		
		if(onayla){
		
		var tanitim = document.getElementById("tanitim").value;
		
		if(tanitim == ""){
			alert("Bo� b�rakmay�n�z");
		}
		else {
		$("#kaydetsonuc").html("<img src='img/loading.gif' />");
		
				jQuery.ajax({
					type : 'POST',
					url : 'inc/profilguncelle.php',
					data : "islem=tanitim&tanitim="+tanitim,
					success: function(sonuc){		
						if(sonuc == "ok"){
							$("#kaydetsonuc").html("<font color=green><b>Tan�t�m yaz�n�z g�ncellendi.</b></font>");
						}
						else {
							$("#kaydetsonuc").html("<font color=red><b>�uan g�ncelleme yap�lam�yor.</b></font>");
						}	
					}
				})
		}
		
		}
	}
</script>
</head>
<body onLoad="menuler('profilmerkezi');">
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
										<td width="540" valign="top">
										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_turuncu.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Profil Tan�t�m�</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table306" cellspacing="0" cellpadding="0">
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
																		<b>
																		<font color="#F95822">
																		�NEML� 
																		!!</font> 
																		SAYIN 
																		�YEM�Z;</b></td>
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
																		<p class="form_txt">
																		�uan 
																		bulundu�unuz 
																		b�l�me 
																		profil 
																		tan�t�m 
																		bilgisi 
																		yazmak 
																		mecburidir. 
																		Profilinize 
																		yazm�� 
																		oldu�unuz 
																		yaz�lar 
																		�yeler 
																		taraf�ndan 
																		g�r�nt�lenmeden 
																		�nce 
																		Edit�r 
																		onay�ndan 
																		ge�mektedir. 
																		Bu 
																		nedenle 
																		l�tfen 
																		a�a��daki 
																		kurallara 
																		uygun 
																		olmayan 
																		yaz�lar 
																		yazmay�n�z. 
																		Bu tip 
																		yaz�lar 
																		profilinizin 
																		Red 
																		edilmesine 
																		veya 
																		silinmesine 
																		neden 
																		olacakt�r.</td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>
																		&nbsp;</td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<b>KABUL 
																		ED�LECEK 
																		PROF�L 
																		YAZISI</b></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" height="10"></td>
																		<td height="10">
																		</td>
																		<td width="15" height="10"></td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		Kendinizi 
																		ve de 
																		arad���n�z 
																		ki�iyi 
																		tan�tan 
																		k�sa bir 
																		yaz� 
																		sizden 
																		istenmektedir. 
																		Bu 
																		yaz�y� 
																		yazman�z 
																		ve 
																		a�a��daki 
																		uyar�lara 
																		dikkat 
																		ederek 
																		kabul 
																		edilmeyen 
																		profil 
																		yaz�s� 
																		yazmaman�z 
																		profil 
																		yaz�n�z�n 
																		kabul 
																		edilmesini 
																		sa�layacakt�r.<br><br>Red edilme 
																		veya 
																		silinmeye 
																		neden 
																		olacak 
																		uyar�lar 
																		a�a��dad�r 
																		;<br>A�a��daki 
																		uyar�lara 
																		ve 
																		benzerlerine 
																		dikkat 
																		ederek 
																		haz�rlayaca��n�z 
																		profil 
																		yaz�lar�n�z 
																		i�in 
																		te�ekk�re 
																		ederiz...<br><br>Ben yazmam, ben sevmem, ben anlat�lmam ya�an�r�m, 
																		tan�mak 
																		isteyen 
																		tan�r, 
																		ben 
																		u�ar�m, 
																		ben 
																		�uyum 
																		buyum, 
																		bunlar� 
																		yazmay� 
																		sevmem, 
																		noktalama 
																		i�aretleri, 
																		msn 
																		adresi, 
																		telefon 
																		numaras�, 
																		�akt�rmadan 
																		msn 
																		adresi 
																		vermeye 
																		�al��ma 
																		, zeki 
																		olan 
																		anlar 
																		�eklinde 
																		msn 
																		adresi 
																		vermeye 
																		�al��ma 
																		vb. 
																		profil 
																		yaz�s� 
																		ile 
																		alakas� 
																		olmayan 
																		yaz�lar, 
																		argo ve 
																		m�stehcen 
																		olarak 
																		tan�mlanabilecek 
																		kelimelerin 
																		oldu�u, 
																		manas�z 
																		yaz�lar 
																		yazmay�n�z 
																		bu tip 
																		profiller 
																		Edit�rler 
																		taraf�ndan 
																		silinmektedir.<br><br>L�tfen unutmay�n 
																		sitemize 
																		her �ye 
																		olan 
																		ki�i 
																		mutlaka 
																		kabul 
																		edilecektir 
																		diye bir 
																		kural�m�z 
																		yoktur. 
																		Profil 
																		doldurdum 
																		kurallar�na 
																		ve de 
																		site i�i 
																		kurallara 
																		uymayan 
																		�yelerimiz 
																		�yelik 
																		seviyesine 
																		bak�lmaks�z�n 
																		sitemizden 
																		yasaklanabilir 
																		veya 
																		silinebilir. 
																		Bu 
																		sebeple 
																		site 
																		i�indeki 
																		ki�ilerle 
																		olan 
																		diyaloglar�n�za 
																		ve 
																		ger�ek 
																		bir 
																		profil 
																		haz�rlamaya 
																		�zen 
																		g�stermenizi 
																		rica 
																		ederiz.</td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="25">&nbsp;</td>
														<td width="510" align="center" height="25">
														&nbsp;</td>
														<td height="25">&nbsp;</td>
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
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="15" height="5">
																		</td>
																		<td height="5">
																		</td>
																		<td width="15" height="5">
																		</td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>
																		<p class="tit_mesaj_mer">
																		<font color="#F95822">Kendinizi 
																		ve 
																		Arad���n�z 
																		Ki�iyi 
																		Tan�mlay�n</font></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" height="12"></td>
																		<td height="12"></td>
																		<td width="15" height="12"></td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>
																		<textarea rows="10" name="tanitim" id="tanitim" cols="90" style="font-family: Tahoma; font-size: 8pt; padding-left: 1px; padding-right: 1px"><?=$tanitim?></textarea></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>&nbsp;</td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>
																		<table border="0" width="100%" id="table727" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>&nbsp;</td>
																				<td width="476" height="51" background="img/msg_oku_btn_bg.gif" align="right" valign="top">
																				<table border="0" width="100%" id="table728" cellspacing="0" cellpadding="0">
																					<tr>
																						<td valign="top">
																						<table border="0" style="border-collapse: collapse" cellpadding="0">
																							<tr>
																								<td width="20">&nbsp;</td>
																								<td>
																								<p class="merkez_profil"><span id="kaydetsonuc"><?=$tanitimonay?></span></p></td>
																							</tr>
																						</table>
																						</td>
																						<td width="150" align="right">
																				<table border="0" id="table729" cellspacing="0" cellpadding="0">
																					<tr>
																						<td width="13" height="20">&nbsp;</td>
																						<td width="30" height="20">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="13"><a href="javascript:kaydet()" title="G�nder"><img border="0" src="img/btn_gonderdavtet.gif" width="110" height="31"></a></td>
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
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" height="5">
																		</td>
																		<td height="5">
																		</td>
																		<td width="15" height="5">
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
											</table>
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