<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Mesaj Ayarlarınız <?=$uyeadi?>, <?=_BASLIK?></title>
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
	
		var ayarmail = document.getElementById("ayarmail").checked;
		var ayargiden = document.getElementById("ayargiden").checked;
		var ayararsiv = document.getElementById("ayararsiv").checked;
		var ayaranimasyon = document.getElementById("ayaranimasyon").checked;
		
		if(ayarmail == true){
			ayarmail = document.getElementById("ayarmail").value;
		}
		
		if(ayargiden == true){
			ayargiden = document.getElementById("ayargiden").value;
		}

		if(ayararsiv == true){
			ayararsiv = document.getElementById("ayararsiv").value;
		}

		if(ayaranimasyon == true){
			ayaranimasyon = document.getElementById("ayaranimasyon").value;
		}		
		
		$("#ayarsonuc").html("<img src='img/loading.gif' /> Bekleyin");
		
			jQuery.ajax({
				type : 'POST',
				url : 'inc/uyemesaj.php',
				data : "islem=ayarlar&ayarmail="+ayarmail+"&ayargiden="+ayargiden+"&ayararsiv="+ayararsiv+"&ayaranimasyon="+ayaranimasyon,
				success: function(sonuc){		

					$("#ayarsonuc").html("<font color=green><b>Ayarlarınız kaydedildi</b></font>");

					
				}
			})
			
	}
</script>
</head>
<body onLoad="menuler('mesajmerkezi');">

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
										
										<?
											
										list($ayarmail, $ayargiden, $ayararsiv, $ayaranimasyon) = mysql_fetch_row(mysql_query("select mesajayarmail, mesajayargiden, mesajayararsiv, mesajayaranimasyon from "._MX."uye where id='$uyeid'"));
										
										if($ayarmail == 1) $ayarmailchecked = " checked";
										else $ayarmailchecked = NULL;
										
										if($ayargiden == 1) $ayargidenchecked = " checked";
										else $ayargidenchecked = NULL;

										if($ayararsiv == 1) $ayararsivchecked = " checked";
										else $ayararsivchecked = NULL;

										if($ayaranimasyon == 1) $ayaranimasyonchecked = " checked";
										else $ayaranimasyonchecked = NULL;									
										?>

										<table border="0" width="100%" id="table201" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_mor.gif" height="46">
												<table border="0" width="100%" id="table261" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Mesaj Ayarlarım</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table203" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<p class="form_txt">- 
														Mesaj saklama limitinin 
														üzerine çıkan 
														mesajlarınızı sistem 
														silerek yeni 
														mesajlarınıza yer 
														açacaktir<br>
														- Otomarik ayarları 
														kullanarak işlemlerinizi 
														daha rahat hale 
														getirebilirsiniz</td>
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
														<p class="tit_mesajmer">
														Otomatik Ayarlar</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="10"></td>
														<td width="510" height="10">
														</td>
														<td height="10"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" width="100%" id="table204" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td background="img/msg_kutusu_bg.gif">
																<table border="0" width="100%" id="table257" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="9">&nbsp;</td>
																		<td width="25" bgcolor="#E8E8E8" align="center">
																		<input type="checkbox" name="ayarmail" id="ayarmail" value="1"<?=$ayarmailchecked?>></td>
																		<td width="9">&nbsp;</td>
																		<td height="26">
																				<p class="msg_tit"><b>Gelen mesajı mail ile bildir</b></td>
																		<td width="9">&nbsp;</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_alt.gif" width="510" height="6"></td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="13"></td>
														<td width="510" height="13"></td>
														<td height="13"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" width="100%" id="table214" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td background="img/msg_kutusu_bg.gif">
																<table border="0" width="100%" id="table258" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="9">&nbsp;</td>
																		<td width="25" bgcolor="#E8E8E8" align="center">
																		<input type="checkbox" name="ayargiden" id="ayargiden" value="1"<?=$ayargidenchecked?>></td>
																		<td width="9">&nbsp;</td>
																		<td height="26">
																				<p class="msg_tit"><b>Gönderdiğim mesajı giden kutusuna kaydet</b></td>
																		<td width="9">&nbsp;</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_alt.gif" width="510" height="6"></td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="13"></td>
														<td width="510" height="13"></td>
														<td height="13"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" width="100%" id="table224" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td background="img/msg_kutusu_bg.gif">
																<table border="0" width="100%" id="table259" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="9">&nbsp;</td>
																		<td width="25" bgcolor="#E8E8E8" align="center">
																		<input type="checkbox" name="ayararsiv" id="ayararsiv" value="1"<?=$ayararsivchecked?>></td>
																		<td width="9">&nbsp;</td>
																		<td height="26">
																				<p class="msg_tit"><b>Okunan mesajı arşive gönder</b></td>
																		<td width="9">&nbsp;</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_alt.gif" width="510" height="6"></td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="13"></td>
														<td width="510" height="13"></td>
														<td height="13"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" width="100%" id="table234" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td background="img/msg_kutusu_bg.gif">
																<table border="0" width="100%" id="table260" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="9">&nbsp;</td>
																		<td width="25" bgcolor="#E8E8E8" align="center">
																		<input type="checkbox" name="ayaranimasyon" id="ayaranimasyon" value="1"<?=$ayaranimasyonchecked?>></td>
																		<td width="9">&nbsp;</td>
																		<td height="26">
																				<p class="msg_tit"><b>Mesaj uyarı animasyonu kullan</b></td>
																		<td width="9">&nbsp;</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_alt.gif" width="510" height="6"></td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="13"></td>
														<td width="510" height="13"></td>
														<td height="13"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<a href="javascript:kaydet()" title="Kaydet"><img border="0" src="img/btn_tamam.gif" width="190" height="32"></a>
														
														<p align="center"><span id="ayarsonuc"></span></p>		
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="12"></td>
														<td width="510" height="12"></td>
														<td height="12"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/alt_kapa_mor.gif" height="41">
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