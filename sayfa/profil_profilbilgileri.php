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
		
	$result = mysql_query("update "._MX."uye set medenidurum='$medenidurum', kiminle='$kiminle', webcam='$webcam', webcamsohbet='$webcamsohbet', boy='$boy', kilo='$kilo', goz='$goz', vucut='$vucut', sac='$sac', bakim='$bakim', deneyim='$deneyim', egitim='$egitim', calisma='$calisma', meslek='$meslek', karakter='$karakter2', iliski='$iliski2', aracinsiyet='$aracinsiyet2' where id='$uyeid'");
	
	if($result){
		
		$guncelle = "<font color=green><b>Bilgileriniz güncellendi</b></font>";
	
	}
	
}

$result = mysql_query("select medenidurum, kiminle, webcam, webcamsohbet, iliski, aracinsiyet, karakter, boy, kilo, goz, vucut, sac, bakim, deneyim, egitim, calisma, meslek from "._MX."uye where id='$uyeid'");

$uyeaktar = mysql_fetch_array($result);

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Profil Bilgilerinizi Düzenleyin <?=$uyeadi?>, <?=_BASLIK?></title>
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
										<form action="index.php?sayfa=profil_profilbilgileri" method="post">
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
																				<p class="form_txt"><b>Medeni Durumunuz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='16'");
																					$veri = $uyeaktar["medenidurum"];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;
																					
																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="medenidurum" id="medenidurum"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Kiminle Yaþýyorsunuz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='1'");
																					$veri = $uyeaktar["kiminle"];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;
																					
																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="kiminle" id="kiminle"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Webcamýnýz var mý?</b></td>
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
																			$veri = $uyeaktar["webcam"];
																			
																			if($veri == "Evet"){
																				$checked = " checked";
																				$checked1 = NULL;
																			}
																			else {
																				$checked1 = " checked";
																				$checked = NULL;
																			}
																			unset($veri);
																			?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="Evet" name="webcam" id="webcam"<?=$checked?>></td>
																						<td>
																						<p class="form_txt"> Evet</td>
																					</tr>
																				</table>
																				</td>																				
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="Hayir" name="webcam" id="webcam"<?=$checked1?>></td>
																						<td>
																						<p class="form_txt"> Hayýr</td>
																					</tr>
																				</table>
																				</td>

																			</tr>
																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Görüntülü sohbetten hoþlanýr mýsýnýz?</b></td>
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
																			$veri = $uyeaktar["webcamsohbet"];
																			
																			if($veri == "Evet"){
																				$checked = " checked";
																				$checked1 = NULL;
																			}
																			else {
																				$checked1 = " checked";
																				$checked = NULL;
																			}
																			unset($veri);
																			?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="Evet" name="webcamsohbet" id="webcamsohbet"<?=$checked?>></td>
																						<td>
																						<p class="form_txt"> Evet</td>
																					</tr>
																				</table>
																				</td>																				
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="Hayir" name="webcamsohbet" id="webcamsohbet"<?=$checked1?>></td>
																						<td>
																						<p class="form_txt"> Hayýr</td>
																					</tr>
																				</table>
																				</td>

																			</tr>
																			</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Aradýðýnýz iliþki türü</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='2'");
																					$veri = $uyeaktar["iliski"];
																					
																					
																					$i = 1;
																					$iliski = array();
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if(strstr($veri, $ad)) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="checkbox" value="<?=$ad?>" name="iliski[]" id="iliski[]"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Aradýðýnýz cinsiyet</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='18'");
																					$veri = $uyeaktar["aracinsiyet"];
																					
																					
																					$i = 1;
																					$aracinsiyet = array();
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if(strstr($veri, $ad)) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="checkbox" value="<?=$ad?>" name="aracinsiyet[]" id="aracinsiyet[]"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	
																	<?php
																	
																	if($cinsiyet == 2){
																	
																	?>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Boyunuz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='4'");
																					$veri = $uyeaktar["boy"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[0];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="boy" id="boy"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Kilonuz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='5'");
																					$veri = $uyeaktar["kilo"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[0];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="kilo" id="kilo"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Göz Renginiz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='7'");
																					$veri = $uyeaktar["goz"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[0];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="goz" id="goz"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Vücut Yapýnýz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='6'");
																					$veri = $uyeaktar["vucut"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[0];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="vucut" id="vucut"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Saç Renginiz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='8'");
																					$veri = $uyeaktar["sac"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[0];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="sac" id="sac"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Ýliþki Deneyiminiz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='17'");
																					$veri = $uyeaktar["deneyim"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[0];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="deneyim" id="deneyim"<?=$checked?>></td>
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
																		</td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Bakýmlý mýsýnýz?</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='19'");
																					$veri = $uyeaktar["bakim"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[0];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="bakim" id="bakim"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Boy</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='4'");
																					$veri = $uyeaktar["boy"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[1];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="boyes" id="boyes"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Kilo</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='5'");
																					$veri = $uyeaktar["kilo"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[1];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="kiloes" id="kiloes"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Göz Rengi</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='7'");
																					$veri = $uyeaktar["goz"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[1];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="gozes" id="gozes"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Vücut Yapýsý</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='6'");
																					$veri = $uyeaktar["vucut"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[1];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="vucutes" id="vucutes"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Saç Rengi</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='8'");
																					$veri = $uyeaktar["sac"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[1];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="saces" id="saces"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Ýliþki Deneyimi</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='17'");
																					$veri = $uyeaktar["deneyim"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[1];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="deneyimes" id="deneyimes"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Bakýmlý mýsýnýz?</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='19'");
																					$veri = $uyeaktar["bakim"];
																					
																					$veri = explode("::", $veri);
																					$veri = $veri[1];
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="bakimes" id="bakimes"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<?
																	
																	} // cinsiyet sonu
																	else {
																	?>

																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Boyunuz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='4'");
																					$veri = $uyeaktar["boy"];
																					
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="boy" id="boy"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Kilonuz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='5'");
																					$veri = $uyeaktar["kilo"];
																					
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="kilo" id="kilo"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Göz Renginiz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='7'");
																					$veri = $uyeaktar["goz"];
																					
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="goz" id="goz"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Vücut Yapýnýz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='6'");
																					$veri = $uyeaktar["vucut"];
																					
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="vucut" id="vucut"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Saç Renginiz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='8'");
																					$veri = $uyeaktar["sac"];
																					
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="sac" id="sac"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Ýliþki Deneyiminiz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='17'");
																					$veri = $uyeaktar["deneyim"];
																					
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="deneyim" id="deneyim"<?=$checked?>></td>
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
																		</td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Bakýmlý mýsýnýz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='19'");
																					$veri = $uyeaktar["bakim"];
																					
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="bakim" id="bakim"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<?
																	}
																	?>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Karakter Özellikleriniz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='3'");
																					$veri = $uyeaktar["karakter"];
																					
																					$i = 1;
																					$karakter = array();
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if(strstr($veri, $ad)) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="checkbox" value="<?=$ad?>" name="karakter[]" id="karakter[]"<?=$checked?>></td>
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
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Eðitim Durumunuz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='9'");
																					$veri = $uyeaktar["egitim"];
																					
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="egitim" id="egitim"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Çalýþma Durumunuz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='11'");
																					$veri = $uyeaktar["calisma"];
																					
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="calisma" id="calisma"<?=$checked?>></td>
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
																		</td>
																	</tr>
																	<tr>
																		<td height="8">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																<tr>
																		<td>
																		<table border="0" width="100%" id="table519" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>Mesleðiniz</b></td>
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
																					$result = mysql_query("select ad from "._MX."uye_secenekler where tur='10'");
																					$veri = $uyeaktar["meslek"];
																					
																					$i = 1;
																					while(list($ad) = mysql_fetch_row($result)){
																					$ad = stripslashes($ad);
																					
																					if($veri == $ad) $checked = " checked";
																					else $checked = NULL;

																					?>
																				<td width="170" valign="top">
																				<table border="0" id="table107" cellspacing="0" cellpadding="0">
																					<tr>
																						<td><input type="radio" value="<?=$ad?>" name="meslek" id="meslek"<?=$checked?>></td>
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