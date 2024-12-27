<?php
	$id = $_GET["id"];
	
	if(!is_numeric($id)) die("Hata");

	list($cinsiyet) = mysql_fetch_row(mysql_query("select cinsiyet from "._MX."uye where id='$id'"));
	
	if(!is_numeric($cinsiyet)) die("Hata");
	
	$medenidurum = suz($medenidurum);
	$kiminle = suz($kiminle);
	$webcam = suz($webcam);
	$webcamsohbet = suz($webcamsohbet);
	$boy = suz($boy);
	$kilo = suz($kilo);
	$goz = suz($goz);
	$vucut = suz($vucut);
	$sac = suz($sac);
	$deneyim = suz($deneyim);
	$egitim = suz($egitim);
	$calisma = suz($calisma);
	$meslek = suz($meslek);
	$bakim = suz($bakim);
	
	if($karakter){
		foreach($karakter as $k){
			$karakter2 .= $k .";";
		}
	}
	
	if($iliski){
		foreach($iliski as $i){
			$iliski2 .= $i .";";
		}
	}

	if($aracinsiyet){
		foreach($aracinsiyet as $arac){
			$aracinsiyet2 .= $arac .";";
		}
	}	
	
	$karakter2 = suz($karakter2);
	$iliski2 = suz($iliski2);
	$aracinsiyet2 = suz($aracinsiyet2);
	
	
		if($cinsiyet == 2){
			$boyes = suz($boyes);
			$kiloes = suz($kiloes);
			$saces = suz($saces);
			$gozes = suz($gozes);
			$vucutes = suz($vucutes);
			$deneyimes = suz($deneyimes);
			$bakimes = suz($bakimes);		
			
						
			$boy = $boy ."::". $boyes;
			$kilo = $kilo ."::". $kiloes;
			$sac = $sac ."::". $saces;
			$goz = $goz ."::". $gozes;
			$vucut = $vucut ."::". $vucutes;
			$deneyim = $deneyim ."::". $deneyimes;
			$bakim = $bakim ."::". $bakimes;
		}
		
	$result = mysql_query("update "._MX."uye set medenidurum='$medenidurum', kiminle='$kiminle', webcam='$webcam', webcamsohbet='$webcamsohbet', boy='$boy', kilo='$kilo', goz='$goz', vucut='$vucut', sac='$sac', bakim='$bakim', deneyim='$deneyim', egitim='$egitim', calisma='$calisma', meslek='$meslek', karakter='$karakter2', iliski='$iliski2', aracinsiyet='$aracinsiyet2' where id='$id'");

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Adým 3 : Üye Ol, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/ea.css" type="text/css" />
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<style type="text/css">
	body {
		background:url(img/bg.gif);
	}
</style>
<script type="text/javascript" src="inc/jquery.js"></script>
<script type="text/javascript">
function kaydet(){
	
	
	var tanitim = document.getElementById("tanitim").value;
	
	tanitim = jQuery.trim(tanitim);
	
	if(tanitim == ""){
		alert("Profil tanýtým yazýsýný yazmadýnýz");
	}
	else {
		$("#kaydetsonuc").html('<img src="img/loading.gif" /> <font color=green size=2><b>Lütfen Bekleyin</b></font>');
	
		document.uyeol3form.submit();
	}
}
</script>
</head>

<body>

<div align="center">
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
												<td background="img/uyeadim_secilmeyen.gif" height="33" align="center">
												<img border="0" src="img/uyeol_step_kullanici1.gif" width="98" height="18"></td>
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
												<td background="img/uyeadim_secili.gif" align="center" height="33">
												<img border="0" src="img/uyeol_step_ilgialanlari2.gif" width="83" height="18"></td>
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
										<form action="index.php?sayfa=uyeol4&id=<?=$id?>" method="post" name="uyeol3form">											<table border="0" width="100%" id="table15" cellspacing="0" cellpadding="0">
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
																<table border="0" width="100%" id="table92" cellspacing="0" cellpadding="0">
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table93" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit_sol.gif" width="25" height="28"></td>
																				<td background="img/uyeol_ic_tit_bg.gif">
																				<p class="c2"><font color="#FFFFFF">ÝLGÝ ALANLARINIZ</font></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit_sag.gif" width="12" height="28"></td>
																			</tr>
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>hobileriniz</b></td>
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
												<div class="durumlar">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='12'");
														
														$hobiler = array();
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															
															?>
															<div class="durumlarliste"><span><input type="checkbox" name="hobiler[]" id="hobiler[]" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table100" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>beðenileriniz</b></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit2_sag.gif" width="12" height="22"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="5">
																		</td>
																	</tr>
																	<tr>
																		<td>
												<div class="durumlar">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='13'");
														
														$begeniler = array();
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															
															?>
															<div class="durumlarliste"><span><input type="checkbox" name="begeniler[]" id="begeniler[]" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		</td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table100" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>hoþlandýðýnýz filmler</b></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit2_sag.gif" width="12" height="22"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="5">
																		</td>
																	</tr>
																	<tr>
																		<td>
												<div class="durumlar">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='14'");
														
														$filmler = array();
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															
															?>
															<div class="durumlarliste"><span><input type="checkbox" name="filmler[]" id="filmler[]" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>																	</td>
																	</tr>
																	<tr>
																		<td height="8">
																		</td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table103" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>hoþlandýðýnýz tipler</b></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit2_sag.gif" width="12" height="22"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="5"></td>
																	</tr>
																	<tr>
																		<td>
												<div class="durumlar">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='15'");
														
														$tipler = array();
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															
															?>
															<div class="durumlarliste"><span><input type="checkbox" name="tipler[]" id="tipler[]" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>																		</td>
																	</tr>
																	</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td valign="top">
																<table border="0" width="100%" id="table93" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit_sol.gif" width="25" height="28"></td>
																				<td background="img/uyeol_ic_tit_bg.gif">
																				<p class="c2"><font color="#FFFFFF">KENDÝNÝZÝ VE ARADIÐINIZ PARTNERÝ KISACA TANIMLAYIN</font></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit_sag.gif" width="12" height="28"></td>
																			</tr>
																			</table></td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td valign="top">
																<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
																	<tr>
																		<td style="font-size:12px">&nbsp;<p>
																		<strong>Önemli : Sayýn Üyemiz</strong></p>
																		<p class="not" style="text-align:justify;font-size:11px">
Þuan bulunduðunuz bölüme profil tanýtým bilgisi yazmak mecburidir.Profilinize yazmýþ olduðunuz yazýlar üyeler tarafýndan görüntülenmeden önce Editör Onayýna gitmekte ve tüm profiller Editörler tarafýndan onaylanmadan önce tek tek Okunmaktadýr Bu nedenle lütfen 
site kurallarýna uygun olmayan yazýlar yazmayýnýz bu tip yazýlar profilinizin Red edilmesine veya Silinmesine neden olmaktadýr.Ben 
anlatýlmam yaþanýrým zeki olan beni bulur ben yazamiyorum siz yazin çaktýrmadan 
msn vermek telefýn numarasý yazmak rumuzum maililmdir ekleyin vs gibi red 
olunacak þeyleri yazmanýz sadece sizin için zaman kaybý olacaktýr , Editor 
onayýna geldikten sonra silinmesi 3 sn içinde gerçekleþecektir bu yüzden bu tür 
giriþimlerle kendinizi küçük ve rencide edici duruma düþürmeyiniz.. Sizden 
istenen kendinizi vede aradýðýnýz kiþiyi tanýtan kýsa bir yazý istenmektedir.Bu yazýyý yazmaniz ve 
yukakrýdaki uyarýlara dikkat ederek kabul edilmeyen profil yazisi yazmamanýz Profil Yazýnýzýn Kabul Edilmesini Saðlayacaktýr.unutmayýnýz 
bütün profiller editorler tarafindan tek tek incelendikten sonra siteye kabul 
edilmektedir ve sitemize uygun olduðunuzu göstereceðiniz profiller 
hazýrlayýnýz...<br />
<br /><br />

																		</p>
																		</td>
																	</tr>
																</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td valign="top">
																						
																	<textarea rows="9" name="tanitim" id="tanitim" cols="61"></textarea></td>
																<td width="15">&nbsp;</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td height="13">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
													</tr>
													<tr>
														<td align="right">
														<table border="0" id="table91" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<a href="javascript:void(0)" onclick="kaydet()" title="Kaydet ve Ýlerle"><img border="0" src="img/btn_kaydet_ilerle.gif" width="210" height="40"></a>
													<br />
													<span id="kaydetsonuc"></span>
													<?
															if($uyelik == 2){
																echo '<p><font color=red size=2>Üyeliðiniz admin onayýndan sonra aktif olacaktýr</font></p>';
															}
															if($uyelik == 3){
																echo '<p><font color=red size=3>Üyeliðinizi onaylamak için emailinize gelen onay linkine týklayýnýz. Mail Junk\'a gelmiþ olabilir.</font></p>';
															}
														?>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
														</table>
														</td>
													</tr>
													
													<tr>
														<td height="8">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
													</tr>
													<tr>
														<td height="8">
														</td>
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
								<p class="c2">&nbsp;</td>
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