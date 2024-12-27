<?php
	$id = $_GET["id"];
	
	if(!is_numeric($id)) die("Hata");

	list($cinsiyet) = mysql_fetch_row(mysql_query("select cinsiyet from "._MX."uye where id='$id'"));
	
	if(!is_numeric($cinsiyet)) die("Hata");
	
	$uyelik = ayar("uyelik");
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Adım 2 : Üye Ol, <?=_BASLIK?></title>
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
	

	var hata = "";
	var boy = valueal(document.forms['uyeol2form'].elements['boy']);
	
	if(boy == "") hata = "- Boyunuzu seçmediniz\n";
	
	var kilo = valueal(document.forms['uyeol2form'].elements['kilo']);
	
	if(kilo == "") hata = ""+hata+"- Kilonuzu seçmediniz\n";
	
	if(hata){
		alert(hata);
	}
	else {
		$("#kaydetsonuc").html('<img src="img/loading.gif" /> <font color=green size=2><b>Lütfen Bekleyin</b></font>');
		
		document.uyeol2form.submit();
	}
	

}

function valueal(radioObj) {
	if(!radioObj)
		return "";
	var radioLength = radioObj.length;
	if(radioLength == undefined)
		if(radioObj.checked)
			return radioObj.value;
		else
			return "";
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
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
												<td background="img/uyeadim_secili.gif" align="center" height="33">
												<img border="0" src="img/uyeol_step_genelbilgi2.gif" width="100" height="18"></td>
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
										<form action="index.php?sayfa=uyeol3&id=<?=$id?>" method="post" name="uyeol2form">											<table border="0" width="100%" id="table15" cellspacing="0" cellpadding="0">
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
																				<p class="c2"><font color="#FFFFFF">GENEL BİLGİLERİNİZ</font></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit_sag.gif" width="12" height="28"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table99" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>medeni durumunuz</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='16'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="medenidurum" id="medenidurum" value="<?=$ad?>" /></span> <?=$ad?></div>
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
																		<table border="0" width="100%" id="table101" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>kimle yaşıyorsunuz?</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='1'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="kiminle" id="kiminle" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table102" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>web caminiz var mı?</b></td>
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
													<div class="durumlarliste"><span><input type="radio" name="webcam" id="webcam" value="Evet" /></span> Evet</div>
													<div class="durumlarliste"><span><input type="radio" name="webcam" id="webcam" value="Hayir" /></span> Hayır</div>


												</div>
																		</td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table102" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>web cam sohbetten hoşlanır mısınız?</b></td>
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
													<div class="durumlarliste"><span><input type="radio" name="webcamsohbet" id="webcamsohbet" value="Evet" /></span> Evet</div>
													<div class="durumlarliste"><span><input type="radio" name="webcamsohbet" id="webcamsohbet" value="Hayir" /></span> Hayır</div>


												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table102" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>aradığınız cinsiyet?</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='18'");
														
														$aracinsiyet = array();
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="checkbox" name="aracinsiyet[]" id="aracinsiyet[]" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table102" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>aradığınız ilişki türü?</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='2'");
														
														$iliski = array();
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="checkbox" name="iliski[]" id="iliski[]" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table102" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>karakter özellikleriniz?</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='3'");
														
														$karakter = array();
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															
															?>
															<div class="durumlarliste"><span><input type="checkbox" name="karakter[]" id="karakter[]" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<!-- cinsiyet baslangic -->
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table94" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit_sol.gif" width="25" height="28"></td>
																				<td background="img/uyeol_ic_tit_bg.gif">
																				<p class="c2"><font color="#FFFFFF">
																				<?php
																				
																				if($cinsiyet == 2){
																					echo "ERKEK ÜYENİN FİZİKSEL ÖZELLİKLERİ";
																				}
																				else {
																					echo "FİZİKSEL ÖZELLİKLERİZ";
																				}	
																				
																				
																				?></font></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit_sag.gif" width="12" height="28"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table222" cellspacing="0" cellpadding="0">
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
																		<td height="5"></td>
																	</tr>
																	<tr>
																		<td>
												<div class="durumlar">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='4'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="boy" id="boy" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table222" cellspacing="0" cellpadding="0">
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
																		<td height="5"></td>
																	</tr>
																	<tr>
																		<td>
												<div class="durumlar">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='5'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="kilo" id="kilo" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table222" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>vücut yapısı</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='6'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="vucut" id="vucut" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table223" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>göz rengi</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='7'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="goz" id="goz" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table224" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>saç rengi</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='8'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="sac" id="sac" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table227" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>bakımlı mı?</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='19'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="bakim" id="bakim" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table227" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>ilişki deneyimi var mı?</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='17'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="deneyim" id="deneyim" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>																	</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<!-- cinsiyet bitis -->
																	
																	<!-- cinsiyet cift hatun baslangic -->
																	
																	<?php
																	
																	if($cinsiyet == 2){
																	
																	?>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table94" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit_sol.gif" width="25" height="28"></td>
																				<td background="img/uyeol_ic_tit_bg.gif">
																				<p class="c2"><font color="#FFFFFF">
																				BAYAN ÜYENİN FİZİKSEL ÖZELLİKLERİ</font></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit_sag.gif" width="12" height="28"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table222" cellspacing="0" cellpadding="0">
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
																		<td height="5"></td>
																	</tr>
																	<tr>
																		<td>
												<div class="durumlar">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='4'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="boyes" id="boyes" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>	
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table222" cellspacing="0" cellpadding="0">
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
																		<td height="5"></td>
																	</tr>
																	<tr>
																		<td>
												<div class="durumlar">
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='5'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="kiloes" id="kiloes" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>	
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table222" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>vücut yapısı</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='6'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="vucutes" id="vucutes" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>	
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table223" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>göz rengi</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='7'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="gozes" id="gozes" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table224" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>saç rengi</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='8'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="saces" id="saces" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table227" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>bakımlı mı?</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='19'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="bakimes" id="bakimes" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table227" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>ilişki deneyimi var mı?</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='17'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="deneyimes" id="deneyimes" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>																	</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<?php
																	}
																	?>
																	<!-- cinsiyet cift hatun bitis -->
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table98" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit_sol.gif" width="25" height="28"></td>
																				<td background="img/uyeol_ic_tit_bg.gif">
																				<p class="c2"><font color="#FFFFFF">EĞİTİM ve İŞ BİLGİLERİNİZ</font></td>
																				<td width="12"><img border="0" src="img/uyeol_ic_tit_sag.gif" width="12" height="28"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table459" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>eğitiminiz</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='9'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="egitim" id="egitim" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>

																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table459" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>mesleginiz & iş alanları</b></td>
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
													<select name="meslek" id="meslek" class="inputlar">
													<option value="">Mesleğinizi seçiniz</option>
													<?php
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='10'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<option value="<?=$ad?>"><?=$ad?></option>
															<?
														}
													?>
													</select>
												</div>

																		</td>
																	</tr>
																	<tr>
																		<td height="8"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table466" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="25"><img border="0" src="img/uyeol_ic_tit2_sol.gif" width="25" height="22"></td>
																				<td background="img/uyeol_ic_tit2_bg.gif">
																				<p class="form_txt"><b>çalışma durumunuz</b></td>
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
														$result = mysql_query("select ad from "._MX."uye_secenekler where tur='11'");
														
														while(list($ad) = mysql_fetch_row($result)){
															$ad = stripslashes($ad);
															?>
															<div class="durumlarliste"><span><input type="radio" name="calisma" id="calisma" value="<?=$ad?>" /></span> <?=$ad?></div>
															<?
														}
													?>

												</div>
																		</td>
																	</tr>
																</table>
																</td>
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
																<a href="javascript:void(0)" onclick="kaydet()" title="Kaydet ve İlerle"><img border="0" src="img/btn_kaydet_ilerle.gif" width="210" height="40"></a>
																<br /><span id="kaydetsonuc"></span>
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