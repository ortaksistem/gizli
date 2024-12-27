<?

if(seviyeal("profil") != 1){
	yonlendir("index.php?sayfa=hata");
	die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$result = mysql_query("select ad, soyad, tel, dogum, ulke, sehir from "._MX."uye where id='$uyeid'");

list($ad, $soyad, $tel, $dogum, $ulke, $sehir) = mysql_fetch_row($result);

list($no1, $no2) = explode("-", $tel);

list($dogum1, $dogum2, $dogum3) = explode(",", date("d,m,Y", $dogum));

function aylar($param){
	
	$aylar = array("", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");
	
	if(strstr($param, "0")) $param = str_replace("0", "", $param);
	
		for($i = 1; $i<=12; $i++) {
			if($i == $param) echo "<option value=\"$i\" selected>$aylar[$i]</option>";
			else echo "<option value=\"$i\">$aylar[$i]</option>";
		}
	
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Kişisel Bilgilerinizi Düzenleyin <?=$uyeadi?>, <?=_BASLIK?></title>
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
	function kaydet(){
		var ad = document.getElementById("ad").value;
		var soyad = document.getElementById("soyad").value;
		var no1 = document.getElementById("no1").value;
		var no2 = document.getElementById("no2").value;
		var d1 = document.getElementById("d1").value;
		var d2 = document.getElementById("d2").value;
		var d3 = document.getElementById("d3").value;
		var ulke = document.getElementById("ulke").value;
		var sehir = document.getElementById("sehir").value;
		
		$("#kaydetsonuc").html("<img src='img/loading.gif' />");
		
				jQuery.ajax({
					type : 'POST',
					url : 'inc/profilguncelle.php',
					data : "islem=kisiselbilgiler&ad="+ad+"&soyad="+soyad+"&no1="+no1+"&no2="+no2+"&d1="+d1+"&d2="+d2+"&d3="+d3+"&ulke="+ulke+"&sehir="+sehir,
					success: function(sonuc){		
						if(sonuc == "ok"){
							$("#kaydetsonuc").html("<font color=green><b>Bilgileriniz başarıyla güncellendi</b></font>");
						}
						else {
							$("#kaydetsonuc").html("<font color=red><b>Şuan güncelleme yapılamıyor.</b></font>");
						}	
					}
				})
	}
</script>
</head>
<body onLoad="menuler('profilmerkezi')"s>

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
														Profil Bilgilerim</td>
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
														<td width="510">
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
																		<td width="494" height="18"></td>
																		<td height="18"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" width="100%" id="table321" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="120" align="right">
																				<p class="form_txt">Adınız:</td>
																				<td width="10">&nbsp;</td>
																				<td><input type="text" name="ad" id="ad" size="30" class="inputlar" value="<?=$ad?>"></td>
																			</tr>
																			<tr>
																				<td width="120" align="right">&nbsp;</td>
																				<td width="10">&nbsp;</td>
																				<td>&nbsp;</td>
																			</tr>
																			<tr>
																				<td width="120" align="right">
																				<p class="form_txt">Soyadınız:</td>
																				<td width="10">&nbsp;</td>
																				<td><input type="text" name="soyad" id="soyad" size="30" class="inputlar" value="<?=$soyad?>"></td>
																			</tr>
																			<tr>
																				<td width="120" align="right">&nbsp;</td>
																				<td width="10">&nbsp;</td>
																				<td>&nbsp;</td>
																			</tr>
																			<tr>
																				<td width="120" align="right">
																				<p class="form_txt">Doğum Tarihiniz:</td>
																				<td width="10">&nbsp;</td>
																				<td>
																								<table border="0" id="table324" cellspacing="0" cellpadding="0">
																									<tr>
																										<td>
																			<select size="1" name="d1" id="d1" class="selectler">
																			<? for($i = 1; $i<=31; $i++){ 
																			
																			if($i == $dogum1) echo "<option value=\"$i\" selected>$i</option>"; 
																			else echo "<option value=\"$i\">$i</option>";
																			
																			} ?>
																			</select
																										<td width="7">&nbsp;</td>
																										<td><select size="1" name="d2" id="d2" class="selectler">
																			<? aylar($dogum2); ?>
																			</select></td>
																										<td width="7">&nbsp;</td>
																										<td width="7"><input type="text" name="d3" id="d3" size="4" class="inputlar" value="<?=$dogum3?>" maxlength="4"> </td>
																										<td width="7">&nbsp;</td>
																										<td>
																									</tr>
																								</table>
																								</td>
																			</tr>
																			<tr>
																				<td width="120" align="right">&nbsp;</td>
																				<td width="10">&nbsp;</td>
																				<td>&nbsp;</td>
																			</tr>
																			<tr>
																				<td width="120" align="right">
																				<p class="form_txt">Telefon:</td>
																				<td width="10">&nbsp;</td>
																				<td>																	<table border="0" style="border-collapse: collapse" cellpadding="0">
																		<tr>
																			<td>
																			<p class="uyeolform_text01a">
																			<b>
																			<font size="1">+90</font></b></td>
																			<td width="7" height="28">&nbsp;</td>
																			<td>
																			<input type="text" name="no1" id="no1" size="3" maxlength="3" class="inputlar" value="<?=$no1?>"></td>
																			<td width="7">&nbsp;</td>
																			<td>
																			<input type="text" name="no2" id="no2" size="12" maxlength="7" class="inputlar" value="<?=$no2?>"></td>
																		</tr>
																	</table>
																	
																			</td>
																			</tr>
																			<tr>
																				<td width="120" align="right">&nbsp;</td>
																				<td width="10">&nbsp;</td>
																				<td>&nbsp;</td>
																			</tr>
																			<tr>
																				<td width="120" align="right">
																				<p class="form_txt">Ülke:</td>
																				<td width="10">&nbsp;</td>
																				<td>
																				<select size="1" name="ulke" id="ulke" class="selectler" onChange="sehirgetir(this.value)">
																	<?
																		$result = mysql_query("select id, adi from "._MX."ulkeler order by adi asc");
																		
																		while(list($uid, $uadi) = mysql_fetch_row($result)){
																			if($ulke == $uadi) {
																				echo "<option value=\"$uadi\" selected>".turkce($uadi)."</option>";
																				$ulkeid = $uid;
																			}
																			else {
																				echo "<option value=\"$uadi\">".turkce($uadi)."</option>";
																			}
																		}
																	
																	?>
																	</select> 
																	
																			</td>
																			</tr>
																			<tr>
																				<td width="120" align="right">&nbsp;</td>
																				<td width="10">&nbsp;</td>
																				<td>&nbsp;</td>
																			</tr>
																			<tr>
																				<td width="120" align="right">
																				<p class="form_txt">Şehir:</td>
																				<td width="10">&nbsp;</td>
																				<td><span id="sehirgetir">
																				<select size="1" name="sehir" id="sehir" class="selectler">
																				<?
																					if(!$ulkeid) $ulkeid = 214;

																					$result = mysql_query("select id, adi from "._MX."sehirler where ulke='$ulkeid' order by adi asc");
																					
																					while(list($sid, $sadi) = mysql_fetch_row($result)){
																						if($sadi == $sehir) echo "<option value=\"$sadi\" selected>".turkce($sadi)."</option>";
																						else echo "<option value=\"$sadi\">".turkce($sadi)."</option>";
																					}	
																				?>
																				</select>
																	</span>
																	
																			</td>
																			</tr>
																			<tr>
																				<td width="120" align="right">&nbsp;</td>
																				<td width="10">&nbsp;</td>
																				<td>&nbsp;</td>
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
																		<td height="7"></td>
																		<td width="494" height="7" align="center"><span id="kaydetsonuc"></span></td>
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
																						<table border="0" width="100%" id="table320" cellspacing="0" cellpadding="0">
																							<tr>
																								<td width="20" height="4"></td>
																								<td width="21" height="4"></td>
																								<td width="8" height="4"></td>
																								<td height="4"></td>
																							</tr>
																							<tr>
																								<td width="20">&nbsp;</td>
																								<td width="21">&nbsp;</td>
																								<td width="8">&nbsp;</td>
																								<td>&nbsp;</td>
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
																						<td width="13"><a href="javascript:kaydet()" title="Güncelle"><img border="0" src="img/bnt_guncelle.gif" width="110" height="31"></a></td>
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