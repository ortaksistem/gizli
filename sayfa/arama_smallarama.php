<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Small Arama <?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link type='text/css' href='inc/basic.css' rel='stylesheet' media='screen' />
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
	
	function sehirgetir(ulke){
	
		$("#sehirgetir").html("<font color=red size=2><b>Bekleyin</b></font>");
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/sehiryukle.php',
					data : "ulke="+ulke,
					success: function(sonuc){		
						$("#sehirgetir").html(sonuc);	
					}
				})
	}
	
</script>
</head>
<body onLoad="menuler('aramamerkezi');">
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
										<td width="540" valign="top">
										
										<!-- icerik baslangic -->
										<form action="index.php?sayfa=arama_sonuc" method="post">
										<table border="0" width="100%" id="table173" cellspacing="0" cellpadding="0">
											<tr>
												<td height="46" background="img/ust_ac_turkuaz.gif">
												<table border="0" width="100%" id="table449" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Small Arama</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table175" cellspacing="0" cellpadding="0">
													<tr>
														<td>
														<table border="0" width="100%" id="table214" cellspacing="0" cellpadding="0">
															<tr>
																<td width="15" height="12"></td>
																<td height="12">
																</td>
																<td width="15" height="12"></td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td background="img/aramer_bg_tit1.gif" height="22">
																<table border="0" width="100%" id="table270" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="22" height="22">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																				<p class="form_txt"><font color="#FF5300"><b>aradığınız cinsiyet</b></font></td>
																	</tr>
																</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td align="center" background="img/aramer_bg_tit1a.gif">
																<table border="0" width="100%" id="table280" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="23" height="9">
																		</td>
																		<td height="9">
																		</td>
																		<td width="23" height="9">
																		</td>
																	</tr>
																	<tr>
																		<td width="23">&nbsp;</td>
																		<td>
																		<table border="0" width="100%" id="table352" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="200">
																				<p class="form_txt">İstediğiniz cinsiyet türünü seçiniz. Çoklu seçmek için ctrl kullanınız.</td>
																				<td width="25">&nbsp;</td>
																				<td>
																								<table border="0" id="table353" cellspacing="0" cellpadding="0">
																									<tr>
																										<?php
																										$cinsiyet = array();
																										?>
																										<td><select name="cinsiyet[]" id="cinsiyet[]" class="selectler" multiple="multiple">
																										
																										<option value="farketmez" selected>Farketmez</option>
																										
																										<? cinsiyet(NULL); ?>
																										
																										</td>
																									</tr>
																								</table>
																				</td>
																			</tr>
																		</table>
																		</td>
																		<td width="23">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="23" height="7">
																		</td>
																		<td height="7">
																		</td>
																		<td width="23" height="7">
																		</td>
																	</tr>
																</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
																<td align="center">
																<img border="0" src="img/aramer_bg_tit1b.gif" width="510" height="7"></td>
																<td width="15">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="15" height="12"></td>
																<td align="center" height="12">
																</td>
																<td width="15" height="12"></td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td background="img/aramer_bg_tit1.gif" height="22">
																<table border="0" width="100%" id="table270" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="22" height="22">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																				<p class="form_txt"><font color="#FF5300"><b>aradığınız yaş aralığı</b></font></td>
																	</tr>
																</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td align="center" background="img/aramer_bg_tit1a.gif">
																<table border="0" width="100%" id="table280" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="23" height="9">
																		</td>
																		<td height="9">
																		</td>
																		<td width="23" height="9">
																		</td>
																	</tr>
																	<tr>
																		<td width="23">&nbsp;</td>
																		<td>
																		<table border="0" width="100%" id="table352" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="200">
																				<p class="form_txt">Sonuçlara hızlı erişim sağlamak için lütfen size uygun yaş aralığını belirtiniz..</td>
																				<td width="25">&nbsp;</td>
																				<td>
																								<table border="0" id="table353" cellspacing="0" cellpadding="0">
																									<tr>
																										<td><select name="yas1" id="yas1" class="selectler">
																										<? for($i = 18; $i < 90; $i++) echo "<option value=$i>$i</option>"; ?>
																										</select></td>
																										<td width="7">&nbsp;</td>
																										<td align="center">
																										<p class="form_txt">ile</td>
																										<td width="7">&nbsp;</td>
																										<td><select name="yas2" id="yas2" class="selectler">
																										<? for($i = 90; $i > 18; $i--) echo "<option value=$i>$i</option>"; ?>
																										</select></td>
																										<td width="7">&nbsp;</td>
																										<td>
																										<p class="form_txt">yaş arası</td>
																									</tr>
																								</table>
																				</td>
																			</tr>
																		</table>
																		</td>
																		<td width="23">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="23" height="7">
																		</td>
																		<td height="7">
																		</td>
																		<td width="23" height="7">
																		</td>
																	</tr>
																</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
																<td align="center">
																<img border="0" src="img/aramer_bg_tit1b.gif" width="510" height="7"></td>
																<td width="15">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="15" height="12"></td>
																<td align="center" height="12">
																</td>
																<td width="15" height="12"></td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td background="img/aramer_bg_tit1.gif" height="22">
																<table border="0" width="100%" id="table308" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="22" height="22">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																				<p class="form_txt"><font color="#FF5300"><b>aradığınız ülke &amp; şehir</b></font></td>
																	</tr>
																</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td align="center" background="img/aramer_bg_tit1a.gif">
																<table border="0" width="100%" id="table318" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="23" height="9">
																		</td>
																		<td height="9">
																		</td>
																		<td width="23" height="9">
																		</td>
																	</tr>
																	<tr>
																		<td width="23">&nbsp;</td>
																		<td>
																		<table border="0" width="100%" id="table361" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="200">
																				<p class="form_txt">size en yakın üyemizi listeleyebilirsiniz. </td>
																				<td width="25">&nbsp;</td>
																				<td>
																				<table border="0" width="100%" id="table362" cellspacing="0" cellpadding="0">
																					<tr>
																						<td>
																				<select size="1" name="ulke" id="ulke" class="selectler" onChange="sehirgetir(this.value)">
																				
																					<option value="farketmez" selected>Fartetmez</option>
																	<?
																		$result = mysql_query("select id, adi from "._MX."ulkeler order by adi asc");
																		
																		while(list($uid, $uadi) = mysql_fetch_row($result)){
																			echo "<option value=\"$uadi\">".turkce($uadi)."</option>";
																		}
																	
																	?>
																	</select>
																	
																	
																						</td>
																					</tr>
																					<tr>
																						<td height="10"></td>
																					</tr>
																					<tr>
																						<td>
																						<span id="sehirgetir">
																						<select size="1" name="sehir" id="sehir" class="selectler">
																						
																						<option value="farketmez" selected>Farketmez</option>
																						<?
																							$result = mysql_query("select id, adi from "._MX."sehirler where ulke='214' order by adi asc");
																							
																							while(list($sid, $sadi) = mysql_fetch_row($result)){
																								echo "<option value=\"$sadi\">".turkce($sadi)."</option>";
																							}	
																						?>
																						</select>
																						</span>
																						</td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																		</table>
																		</td>
																		<td width="23">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="23" height="7">
																		</td>
																		<td height="7">
																		</td>
																		<td width="23" height="7">
																		</td>
																	</tr>
																</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
																<td align="center">
																<img border="0" src="img/aramer_bg_tit1b.gif" width="510" height="7"></td>
																<td width="15">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="15" height="12"></td>
																<td align="center" height="12">
																</td>
																<td width="15" height="12"></td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td background="img/aramer_bg_tit1.gif" height="22">
																<table border="0" width="100%" id="table327" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="22" height="22">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																		<td>
																				<p class="form_txt"><font color="#FF5300"><b>özel seçimleriniz..</b></font></td>
																	</tr>
																</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td align="center" background="img/aramer_bg_tit1a.gif">
																<table border="0" width="100%" id="table337" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="23" height="9">
																		</td>
																		<td height="9">
																		</td>
																		<td width="23" height="9">
																		</td>
																	</tr>
																	<tr>
																		<td width="23">&nbsp;</td>
																		<td>
																		<table border="0" width="100%" id="table338" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="170" valign="top">
																				<table border="0" id="table339" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="checkbox" name="online" id="online" value="1"></td>
																						<td>
																						<p class="form_txt">Online Olanlar</td>
																					</tr>
																				</table>
																				</td>
																				<td width="170" valign="top">
																				<table border="0" id="table443" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="checkbox" name="resim" id="resim" value="1"></td>
																						<td>
																						<p class="form_txt">Resmi Olanlar</td>
																					</tr>
																				</table>
																				</td>
																				<td width="170" valign="top">
																				<table border="0" id="table446" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="checkbox" name="galeri" id="galeri" value="1"></td>
																						<td>
																						<p class="form_txt">Galerisi Olanlar</td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			</table>
																		</td>
																		<td width="23">&nbsp;</td>
																	</tr>
																	</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
																<td align="center">
																<img border="0" src="img/aramer_bg_tit1b.gif" width="510" height="7"></td>
																<td width="15">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td width="15" height="10"></td>
																<td align="center" height="10">
																</td>
																<td width="15" height="10"></td>
															</tr>
															<tr>
																<td width="15" height="13"></td>
																<td align="center" height="13">
																</td>
																<td width="15" height="13"></td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td align="center">
																<input type="image" src="img/btn_tamam.gif" width="190" height="32"></td>
																<td width="15">&nbsp;</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td height="8">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/alt_kapa_turkuaz.gif" height="41">
														&nbsp;</td>
											</tr>
											<tr>
												<td height="8" align="center">
												<img border="0" src="img/1px.gif" width="1" height="1"></td>
											</tr>
											</table>
										
										<input type="hidden" name="aramatur" id="aramatur" value="small">
										</form>
										<!-- icerik bitis -->
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