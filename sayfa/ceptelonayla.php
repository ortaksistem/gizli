<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Cep Tel Onayla <?=$uyeadi?>, <?=_BASLIK?></title>
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
	
	function onaykodugonder(){
		
			
			var no1 = $("#cep1").val();
			var no2 = $("#cep2").val();
			
			
			if(no1 == "" && no2 == ""){
				alert("Lütfen telefon numaranızı yazınız.");
			}
			else {
				var uyeid = <?=$uyeid?>;
				$("#cepsonuc").html("<font color=green size=2><b>Onay kodu gönderiliyor, lütfen bekleyin...</b></font>");
				$("#onaykodubuton").attr("disabled", "disabled");
				$("#onaykodubuton").attr("value", "Lütfen Bekleyiniz");
				jQuery.ajax({
					
					type: 'POST',
					url: 'inc/uyeol_sms.php',
					data: "tur=ceponayla&no1="+no1+"&no2="+no2+"&uyeid="+uyeid,
					success: function(sonuc){
						if(sonuc == "ok"){
							$("#telefontr").hide();
							$("#onaykodutr").show();
							$("#cepsonuc").html("<font color=green size=2><b>Onay kodunu üstteki alana giriniz</b></font>");
							$("#ustbilgi").html("Onay Kodunu Giriniz");
						}
						else {
							$("#cepsonuc").html("");
							$("#onaykodubuton").removeAttr("disabled");
							$("#onaykodubuton").attr("value", "Onay Kodu Gönder");
							alert(sonuc);
						}
					}
				
				})
				
				
			}
	
	}

	function koduonayla(){
		
		var onaykodu = $("#onaykodu").val();
		var uyeid = <?=$uyeid?>;
		
		if(onaykodu == ""){
			alert("Lütfen Onay Kodunu Giriniz");
		}
		else {
			
			$("#cepsonuc").html("<font color=green size=2><b>Onaylanıyor, lütfen bekleyiniz.</b></font>");
			$("#onaykodugonderbuton").attr("disabled", "disabled");
			$("#onaykodugonderbuton").attr("value", "Lütfen Bekleyiniz");
			
				jQuery.ajax({
					
					type: 'POST',
					url: 'inc/uyeol_sms.php',
					data: "tur=kodonayla&kod="+onaykodu+"&uyeid="+uyeid,
					success: function(sonuc){
						if(sonuc == "ok"){
							$("#cepsonuc").html("");
							alert("Telefon numaranız başarıyla onaylanmıştır, şimdi yönlendiriliyorsunuz.");
							window.location='index.php?sayfa=giris';
						}
						else {
							$("#cepsonuc").html("");
							alert(sonuc);
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
														Cep Telefonunu Onaylayın</td>
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
																		Buraya bir açıklama yazısı gelicek neden cep tel kullanacağız vs.</td>
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
																		<span id="ustbilgi">Cep Telefonunuzu Giriniz</span></td>
																		<td height="18"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<form action="javascript:void(0)" method="post" name="ceponayformu">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr id="telefontr">
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200">
																				<p class="form_txt"> Cep Numaranız
																				<input type="text" name="cep1" id="cep1" class="inputlar" size="5" maxlength="3" value="5" /> <input type="text" name="cep2" id="cep2" class="inputlar" size="13" maxlength="7" /> <input type="submit" onclick="onaykodugonder()" id="onaykodubuton" value=" Onay Kodunu Gönder " style="border:1px solid #ccc;background-color:#ddd;width:150px;">
																				</td>
																				<td width="20">&nbsp;</td>
																			</tr>
																			<tr id="onaykodutr" style="display:none">
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200">
																				<p class="form_txt"> Onay Kodunuz
																				<input type="text" name="onaykodu" id="onaykodu" class="inputlar" size="10" maxlength="6" value="" /> <input type="submit" onclick="koduonayla()" id="onaykodugonderbuton" value=" Kodu Gönder " style="border:1px solid #ccc;background-color:#ddd;width:150px;">
																				</td>
																				<td width="20">&nbsp;</td>
																			</tr>
																			<tr>
																				<td width="15">&nbsp;</td>
																				<td height="27" width="200">
																				<p class="form_txt"> <span id="cepsonuc"></span>
																				</td>
																				<td width="20">&nbsp;</td>
																			</tr>
																		</table>
																		</form>
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