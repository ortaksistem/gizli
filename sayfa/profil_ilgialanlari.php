<?


if(seviyeal("profil") != 1){
	yonlendir("index.php?sayfa=hata");
	die();
}


$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$cinsiyet = uyebilgi("cinsiyet");

$islem = $_POST["islem"];

if($islem == "kaydet"){
	
	if($tipler)	foreach($tipler as $t) $tipler2 .= $t .";";
	
	if($filmler) foreach($filmler as $f) $filmler2 .= $f .";";
	
	if($hobiler) foreach($hobiler as $h) $hobiler2 .= $h .";";
	
	if($begeniler) foreach($begeniler as $b) $begeniler2 .= $b .";";
	
	
		
	$tipler2 = suz($tipler2);
	$begeniler2 = suz($begeniler2);
	$filmler2 = suz($filmler2);
	$hobiler2 = suz($hobiler2);
	$tanitim = suz($tanitim);
	
	$result = mysql_query("update "._MX."uye set hobiler='$hobiler2', begeniler='$begeniler2', filmler='$filmler2', tipler='$tipler2', tanitim='$tanitim' where id='$uyeid'");
	
	if($result){
		
		$guncelle = "<font color=green><b>Bilgileriniz güncellendi</b></font>";
	
	}
	
}

$result = mysql_query("select hobiler, begeniler, filmler, tipler from "._MX."uye where id='$uyeid'");

$uyeaktar = mysql_fetch_array($result);

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Ýlgi Alanlarýnýzý Düzenle <?=$uyeadi?>, <?=_BASLIK?></title>
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
										<form action="index.php?sayfa=profil_ilgialanlari" method="post">
										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_turuncu.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Ýlgi Alanlarým</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
														<table border="0" width="100%" id="table516" cellspacing="0" cellpadding="0">
															<tr>
																<td width="15">&nbsp;</td>
																<td valign="top">
																<table border="0" width="100%" id="table517" cellspacing="0" cellpadding="0">
																	<tr>
																		<td>
																		&nbsp;</td>
																	</tr>
																	<tr>
																		<td>
														<table border="0" width="100%" id="table744" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td align="center"><?=$guncelle?></td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_alt.gif" width="510" height="6"></td>
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
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Hobileriniz</b></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit2_sag.gif" width="12" height="22"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="5">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table106" cellspacing="0" cellpadding="0">
																			<tr>
																				
																				<?php
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='12'");
																					$veri = $uyeaktar["hobiler"];
																					
																					$i = 1;
																					$hobiler = array();
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if(strstr($veri, $ad)) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="checkbox" value="<?=$ad?>" name="hobiler[]" id="hobiler[]"<?=$checked?>></td>
																						<td>
																						<p class="form_txt"><?=$ad?></td>
																					</tr>
																				</table>
																				</td>
																					<?
																					
																					if($i%3 == 0) echo "</tr><tr>";
																					$i++;
																					}
																					unset($veri);
																					?>
																			</tr>
																		</table>
																	</tr>
																	<tr>
																		<td height="5">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Beðenileriniz</b></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit2_sag.gif" width="12" height="22"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="5">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table106" cellspacing="0" cellpadding="0">
																			<tr>
																				
																				<?php
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='13'");
																					$veri = $uyeaktar["begeniler"];
																					
																					$i = 1;
																					$begeniler = array();
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if(strstr($veri, $ad)) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="checkbox" value="<?=$ad?>" name="begeniler[]" id="begeniler[]"<?=$checked?>></td>
																						<td>
																						<p class="form_txt"><?=$ad?></td>
																					</tr>
																				</table>
																				</td>
																					<?
																					
																					if($i%3 == 0) echo "</tr><tr>";
																					$i++;
																					}
																					unset($veri);
																					?>
																			</tr>
																		</table>
																	</tr>
																	<tr>
																		<td height="5">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Sevdiðiniz Filmler</b></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit2_sag.gif" width="12" height="22"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="5">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table106" cellspacing="0" cellpadding="0">
																			<tr>
																				
																				<?php
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='14'");
																					$veri = $uyeaktar["filmler"];
																					
																					$i = 1;
																					$fimler = array();
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if(strstr($veri, $ad)) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="checkbox" value="<?=$ad?>" name="filmler[]" id="filmler[]"<?=$checked?>></td>
																						<td>
																						<p class="form_txt"><?=$ad?></td>
																					</tr>
																				</table>
																				</td>
																					<?
																					
																					if($i%3 == 0) echo "</tr><tr>";
																					$i++;
																					}
																					unset($veri);
																					?>
																			</tr>
																		</table>
																	</tr>
																	<tr>
																		<td height="5">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Hoþlandýðýnýz Tipler</b></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit2_sag.gif" width="12" height="22"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="5">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table106" cellspacing="0" cellpadding="0">
																			<tr>
																				
																				<?php
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='15'");
																					$veri = $uyeaktar["tipler"];
																					

																					$i = 1;
																					$tipler = array();
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if(strstr($veri, $ad)) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="checkbox" value="<?=$ad?>" name="tipler[]" id="tipler[]"<?=$checked?>></td>
																						<td>
																						<p class="form_txt"><?=$ad?></td>
																					</tr>
																				</table>
																				</td>
																					<?
																					
																					if($i%3 == 0) echo "</tr><tr>";
																					$i++;
																					}
																					unset($veri);
																					?>
																			</tr>
																		</table>
																	</tr>
																	<tr>
																		<td height="5">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	</table>
																</td>
															</tr>
											
															<tr>
																<td width="15">&nbsp;</td>
																<td valign="top">
																&nbsp;</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td valign="top" align="center">
																<input type="image" src="img/btn_tamam.gif" width="190" height="32">
																<input type="hidden" name="islem" id="islem" value="kaydet">
																</td>
																<td width="15">&nbsp;</td>
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
								</form>
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
										<td><b><a class="c" href="index.php?sayfa=uyelik_yukselt">üyeliðini 
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
										<td><b><a class="c" href="index.php?sayfa=yardimmerkezi">yardým merkezi</a></b></td>
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
								<p class="c2"><a class="c1" href="index.php?sayfa=kullanim_sartlari">Kullaným 
								Þartlarý</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=gizlilik_ilkeleri">Gizlilik Ýlkeleri</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=yardimmaili">Bize Ulaþýn</a></td>
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