<?php

	$id = $_GET["id"];
	
	if(!is_numeric($id)) die("Hata");

	
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Cep Telefonu Onayla <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type="text/javascript">
	function onaykodugonder(){
		
		var sozlesme = $("#sozlesme:checked").val();
		
		if(sozlesme == 1){
			
			var no1 = $("#no1").val();
			var no2 = $("#no2").val();
			
			if(no1 == "" && no2 == ""){
				alert("Lütfen telefon numaranızı yazınız.");
			}
			else {
				var uyeid = 1;
				$("#onaysonuc").html("<font color=green size=2><b>Onay kodu gönderiliyor, lütfen bekleyin...</b></font>");
				$("#onaykodubuton").attr("disabled", "disabled");
				$("#onaykodubuton").attr("value", "Lütfen Bekleyiniz");
				jQuery.ajax({
					
					type: 'POST',
					url: 'inc/uyeol_sms.php',
					data: "tur=uyeol&no1="+no1+"&no2="+no2+"&uyeid="+uyeid,
					success: function(sonuc){
						if(sonuc == "ok"){
							$("#telefontr").hide();
							$("#onaykodutr").show();
							$("#onaysonuc").html("<font color=green size=2><b>Onay kodunu üstteki alana giriniz</b></font>");
							$("#onaykodubuton").hide();
							$("#onaykodugonderbuton").show();
						}
						else {
							$("#onaysonuc").html("");
							$("#onaykodubuton").removeAttr("disabled");
							$("#onaykodubuton").attr("value", "Onay Kodu Gönder");
							alert(sonuc);
						}
					}
				
				})
				
				
			}

		}
		else {
			alert("Lütfen sözleşmeyi okuyup, kabul ettiğinizi onaylayınız.");
		}

	
	}
	
	function koduonayla(){
		
		var onaykodu = $("#onaykodu").val();
		var uyeid = <?=$id?>;
		
		if(onaykodu == ""){
			alert("Lütfen Onay Kodunu Giriniz");
		}
		else {
			
			$("#onaysonuc").html("<font color=green size=2><b>Onaylanıyor, lütfen bekleyiniz.</b></font>");
			$("#onaykodugonderbuton").attr("disabled", "disabled");
			$("#onaykodugonderbuton").attr("value", "Lütfen Bekleyiniz");
			
				jQuery.ajax({
					
					type: 'POST',
					url: 'inc/uyeol_sms.php',
					data: "tur=kodonayla&kod="+onaykodu+"&uyeid="+uyeid,
					success: function(sonuc){
						if(sonuc == "ok"){
							$("#onaysonuc").html("");
							alert("Telefon numaranız başarıyla onaylanmıştır, şimdi yönlendiriliyorsunuz.");
							window.location='index.php?sayfa=uyeol2&id='+uyeid;
						}
						else {
							$("#onaysonuc").html("");
							alert(sonuc);
						}
					}
				
				})
		
		}
	
	}
</script>
<style type="text/css">
	body {
		background:url(img/bg.gif);
	}
</style>
</head>
<body>

<div id="kaydol" align="center">
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
							<tr>
								<td>
								<style>

								ul, li {padding: 0px; margin: 0px; list-style-type: none}
								#yeni-header {
									width:770px;
									height:193px;
									background:url(images/header-yeni.jpg) no-repeat;
									margin:0px;
									padding:0px;
								}
								.yeni-header-menu {
									width:770px;
									height:49px;
									padding:144px 0px 0px 0px;
									margin:0px;
								}
								.yeni-header-menu li {
									float:left;
									list-style-type: none;
								}
								.yeni-header-menu img {
									border:none;
								}
									
								</style>
								<div id="yeni-header">
									<div id="yeni-header-menu">
										<div class="yeni-header-menu">

										</div>
									</div>
								</div>
								</td>
							</tr>
							<tr>
								<td height="7">
								<img border="0" src="img/1px.gif" width="1" height="1"></td>
							</tr>
							<tr>
								<td>
								<img border="0" src="img/ic_alan_gri_ust.gif" width="770" height="8"></td>
							</tr>
							<tr>
								<td background="img/ic_alan_gri_bg.gif">
								<table border="0" width="100%" id="table14" cellspacing="0" cellpadding="0">
									<tr>
										<td width="10">&nbsp;</td>
										<td width="200" valign="top">
										<table border="0" width="100%" id="table41" cellspacing="0" cellpadding="0">
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>
												<img border="0" src="img/uyeadim_arasi2.gif" width="200" height="2"></td>
											</tr>
											<tr>
												<td background="img/uyeadim_secili.gif" height="33" align="center">
												<img border="0" src="img/uyeol_step_kullanici2.gif" width="98" height="18"></td>
											</tr>
											<tr>
												<td>
												<img border="0" src="img/uyeadim_arasi2.gif" width="200" height="2"></td>
											</tr>
											<tr>
												<td background="img/uyeadim_secilmeyen.gif" align="center" height="33">
												<img border="0" src="img/uyeol_step_genelbilgi1.gif" width="100" height="18"></td>
											</tr>
											<tr>
												<td>
												<img border="0" src="img/uyeadim_arasi2.gif" width="200" height="2"></td>
											</tr>
											<tr>
												<td background="img/uyeadim_secilmeyen.gif" align="center" height="33">
												<img border="0" src="img/uyeol_step_ilgialanlari1.gif" width="83" height="18"></td>
											</tr>
											<tr>
												<td>
												<img border="0" src="img/uyeadim_arasi2.gif" width="200" height="2"></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
										</table>
										</td>
										<td width="6">&nbsp;</td>
										<td width="540" valign="top">
										<form method="POST" action="--WEBBOT-SELF--">
											<!--webbot bot="SaveResults" U-File="fpweb:///_private/form_results.csv" S-Format="TEXT/CSV" S-Label-Fields="TRUE" -->
										<table border="0" width="100%" id="table15" cellspacing="0" cellpadding="0">
											<tr>
												<td height="45" background="img/pncere1_a_ust.gif">
												<table border="0" width="100%" id="table40" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20" height="45">&nbsp;</td>
														<td>
														<p class="menu">&nbsp;</td>
														<td width="100" align="right">
														&nbsp;</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table16" cellspacing="0" cellpadding="0">
													<tr>
														<td>
														<table border="0" width="100%" id="table42" cellspacing="0" cellpadding="0">
															<tr>
																<td width="15">&nbsp;</td>
																<td valign="top">
																<table border="0" width="100%" id="table44" cellspacing="0" cellpadding="0">
																	<tr>
																		<td bgcolor="#D7D7D7">
																		<table border="0" width="100%" id="table45" cellspacing="1" cellpadding="0">
																			<tr id="telefontr">
																				<td bgcolor="#EFEFEF">
																				<table border="0" width="100%" id="table46" cellspacing="0" cellpadding="0">
			
			
																					<tr>
																						<td width="13">&nbsp;</td>
																						<td>
																						<table border="0" width="100%" id="table50" cellspacing="0" cellpadding="0">
																							<tr>
																								<td width="100" height="30">
																								<p class="form_txt">Telefon:</td>
																								<td>
																	<table border="0" style="border-collapse: collapse" cellpadding="0">
																		<tr>
																			<td>
																			<p class="uyeolform_text01a">
																			<font size="1"><b>
																			+90</b></font></td>
																			<td width="7" height="28">&nbsp;</td>
																			<td>
																			<input type="text" name="no1" id="no1" size="3" value="<?=$no1?>" maxlength="3" class="inputlar"></td>
																			<td width="7">&nbsp;</td>
																			<td>
																			<input type="text" name="no2" id="no2" value="<?=$no2?>" size="10" maxlength="7" class="inputlar"></td>
																		</tr>
																	</table>
																								</td>
																							</tr>
																						</table>
																						</td>
																						<td width="13">&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			<tr style="display:none" id="onaykodutr">
																				<td bgcolor="#EFEFEF">
																				<table border="0" width="100%" id="table46" cellspacing="0" cellpadding="0">
			
			
																					<tr>
																						<td width="13">&nbsp;</td>
																						<td>
																						<table border="0" width="100%" id="table50" cellspacing="0" cellpadding="0">
																							<tr>
																								<td width="100" height="30">
																								<p class="form_txt">Onay Kodu:</td>
																								<td>
																	<table border="0" style="border-collapse: collapse" cellpadding="0">
																		<tr>
																			<td>
																			<input type="text" name="onaykodu" id="onaykodu" size="16" maxlength="6" class="inputlar"></td>
																		</tr>
																	</table>
																								</td>
																							</tr>
																						</table>
																						</td>
																						<td width="13">&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			<tr>
																				<td bgcolor="#EFEFEF">
																				<table border="0" width="100%" id="table46" cellspacing="0" cellpadding="0">
			
			
																					<tr>
																						<td width="13">&nbsp;</td>
																						<td>
																						<table border="0" width="100%" id="table50" cellspacing="0" cellpadding="0">
																							<tr>
																								<td width="100" height="30">
																								<p class="form_txt">&nbsp;</td>
																								<td>
																	<table border="0" style="border-collapse: collapse" cellpadding="0">
																		<tr>
																			<td>
																			
																			<input type="submit" onclick="onaykodugonder()" id="onaykodubuton" value=" Onay Kodunu Gönder " style="border:1px solid #ccc;background-color:#ddd;padding:3px;width:200px;">
																			<input type="submit" onclick="koduonayla()" id="onaykodugonderbuton" value=" Kodu Gönder " style="border:1px solid #ccc;background-color:#ddd;padding:3px;width:200px;display:none">
																			
																			</td>
																		</tr>
																	</table>
																								</td>
																							</tr>
																						</table>
																						</td>
																						<td width="13">&nbsp;</td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td align="center" height="26">
																		<p class="not">&nbsp;</p>
																		<p class="not">
																		<font color="#D22A2A">
																		Neden 
																		Sms ile 
																		Aktivasyon 
																		Yapıyoruz?</font></p>
																		<p class="not">
																		Bilindiği 
																		üzere 
																		internet 
																		üzerinden 
																		bir çok 
																		hadise 
																		meydana 
																		gelebilmektedir. 
																		Yatakpartner 
																		sitesi 
																		sadece 
																		kaliteli 
																		elit 
																		insanlara 
																		yer 
																		vermekte 
																		olup, 
																		kabul 
																		gördüğü 
																		üyelerde 
																		bu 
																		doğrultudadır. 
																		Sms ile 
																		yapacağınız 
																		üyelik 
																		aktivasyonu 
																		hem 
																		sizler 
																		hem de 
																		diğer 
																		kullanıcılar 
																		için 
																		ekstra 
																		güvenlik 
																		unsuru 
																		oluşturmaktadır, 
																		ve yine 
																		olduğu 
																		gibi 
																		üyelik 
																		bilgileriniz 
																		Editor'lerin 
																		dahi 
																		göremeyeceği 
																		özel 
																		şifreleme 
																		sistemi 
																		ile 
																		sağlamaktadır. 
																		Sms ile 
																		üyelik 
																		sistemi 
																		sahte 
																		üyeliklerin 
																		açılmaması 
																		sizlerin 
																		kandırılmaması 
																		ve 
																		mağdur 
																		duruma 
																		düşmemeniz, 
																		şifre 
																		sorunları, 
																		mesajları 
																		cep 
																		telefonunuza 
																		alabilmek&nbsp; 
																		gibi bir 
																		çok 
																		özelliği 
																		içinde 
																		sunabilen 
																		hem 
																		güvenlik 
																		hem de 
																		sitemizdeki 
																		geçireceğiniz 
																		vakti 
																		hızlı 
																		hale 
																		getirmektedir.</td>
																	</tr>
																	<tr>
																		<td bgcolor="#E9E9E9">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table84" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13" height="30">&nbsp;</td>
																				<td height="30">
																				<p class="form_txt">Üyelik sözleşmesini <a class="form_txt" href="index.php?sayfa=kullanim_sozlesmesi" target="_blank"><font color="#D22A2A"><u>okumak için tıklayın</u></font></a></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td bgcolor="#E9E9E9">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" id="table88" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13" height="30">&nbsp;</td>
																				<td height="30">
																				<p class="form_txt">Üyelik sözleşmesini okudum, kabul ediyorum:</td>
																				<td>
																				<table border="0" id="table89" cellspacing="0" cellpadding="0">
																					<tr>
																						<td width="6">&nbsp;</td>
																						<td><input type="checkbox" name="sozlesme" id="sozlesme" value="1" checked></td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td>
																		<span id="onaysonuc"></span>
																		</td>
																	</tr>
																</table>
																</td>
																<td width="15">&nbsp;</td>
																<td width="200" valign="top">
																<table border="0" width="100%" id="table92" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="13" bgcolor="#AEC9F4" height="6">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td bgcolor="#AEC9F4" height="6">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td width="13" bgcolor="#AEC9F4" height="6">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td width="13" bgcolor="#E9F0FC">&nbsp;</td>
																		<td bgcolor="#E9F0FC">&nbsp;</td>
																		<td width="13" bgcolor="#E9F0FC">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="13" bgcolor="#E9F0FC">&nbsp;</td>
																		<td bgcolor="#E9F0FC">
																		<p class="not">
																		Rumuzunuz, 
																		sizin 
																		YatakPartner.Com' daki&nbsp; 
																		adınızdır. 
																		Aramalarda 
																		ilk 
																		okunacak 
																		hakkınızdaki 
																		ilk 
																		izlenimi 
																		verecek 
																		ve daha 
																		sonra 
																		sizi 
																		hatırlatacak 
																		kelimedir. 
																		Deyim 
																		yerindeyse, 
																		rumuz 
																		sizin 
																		markanızdır.<br><br>Rumuzunuz 
																		4 
																		harften 
																		kısa, 32 
																		harften 
																		uzun 
																		olamaz. 
																		10 veya 
																		12 
																		harften 
																		uzun 
																		olanı da 
																		pek bir 
																		işe 
																		yaramaz.<br><br>Unutmayın profiliniz sizsiniz, rumuz 
																		da sizin 
																		kafanızdır. 
																		Kafasız 
																		insan 
																		olmayacağı 
																		için 
																		kendinize 
																		bir 
																		rumuz 
																		bulmak 
																		zorundasınız.<br><br>İyi 
																		bir 
																		rumuz 
																		sizi 
																		tanımlamalı, 
																		kısa 
																		olmalı, 
																		kolay 
																		yazılmalı 
																		ve 
																		telaffuz 
																		edilmelidir. 
																		Örneğin 
																		fsqwda 
																		kötü bir 
																		rumuzdur. 
																		Böyle 
																		saçma 
																		sapan 
																		rumuzlar 
																		uydurmak 
																		yerine 
																		Angel, 
																		Mustafa, 
																		Hülya, 
																		Barbie 
																		gibi 
																		kolay 
																		okunan 
																		rumuzları 
																		kaparsanız 
																		hafızalarda 
																		kolay 
																		yer 
																		bulursunuz.<br><br>Orjinal isim 
																		bulacağım 
																		diye de 
																		çok 
																		fazla 
																		düşünmeyin. 
																		Sıradan 
																		gibi 
																		görünmelerine 
																		rağmen 
																		gerçek 
																		isimlerde 
																		işlevlidir. 
																		İnsanlara 
																		daha 
																		fazla 
																		güven 
																		verirler.<br><br>YP Yönetimi</td>
																		<td width="13" bgcolor="#E9F0FC">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="13" bgcolor="#E9F0FC">&nbsp;</td>
																		<td bgcolor="#E9F0FC">&nbsp;</td>
																		<td width="13" bgcolor="#E9F0FC">&nbsp;</td>
																	</tr>
																</table>
																</td>
																<td width="12">&nbsp;</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td height="13">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
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
											</table>
										</form>
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
		<table border="0" id="table847" cellspacing="0" cellpadding="0">
			<tr>
				<td width="15" height="156">&nbsp;</td>
				<td width="161" height="156">&nbsp;</td>
			</tr>
			<tr>
				<td width="15">&nbsp;</td>
				<td width="161">
				<?php include("inc/giris-sag2.php"); ?>
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
</div>

</body>
</html>