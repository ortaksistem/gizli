<?php


function aylar($param){
	
	$aylar = array("", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");
	
	if($param){
		return $aylar[$param];
	}
	else {
		for($i = 1; $i<=12; $i++) {
			echo "<option value=\"$i\">$aylar[$i]</option>";
		}
	}
	
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Üye Ol, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type="text/javascript" src="inc/uyeol.js"></script>
<script type="text/javascript">
	function onaykodu(){
		
			
			var no1 = $("#no1").val();
			var no2 = $("#no2").val();
			
			if(no1 == "" && no2 == ""){
				alert("Lütfen telefon numaranızı yazınız.");
			}
			else {
				var uyeid = 1;
				$("#onaysonuc").html("<font color=green size=1><b>Onay kodu gönderiliyor, lütfen bekleyin...</b></font>");
				jQuery.ajax({
					
					type: 'POST',
					url: 'inc/uyeol_sms.php',
					data: "tur=uyeol&no1="+no1+"&no2="+no2+"&uyeid="+uyeid,
					success: function(sonuc){
						if(sonuc == "ok"){
							$("#onaysonuc").html("<font color=green size=1><b>Onay kodunu üstteki alana giriniz</b></font><br /><br /><b><font size=1>Kalan Süre : <font color=red><span id='kalansure'>180</span></font> saniye</font></b>");
							$(".onaykoduinput").show();
							onaykodusure();
						}
						else {
							$("#onaysonuc").html('<a href="javascript:void(0)" onclick="onaykodu()"><img src="img/onaykodu.jpg" /></a>');
							alert(sonuc);
						}
					}
				
				})
				
				
			}

	
	}
	
	var tekrarlama = 1;
	
	function onaykodusure(){
		var sure = $("#kalansure").html();
		if(sure > 1){
		setTimeout("onaykodusure()", 1000);
		sure = sure - 1;
		$("#kalansure").html(sure);
		}
		else {
		if(tekrarlama == 2){
		$("#onaysonuc").html('<a href="javascript:void(0)" onclick="kodsuzdevam()"><font color=red size=1><b>Onaysız devam et</b></font></a>');
		} else {
		$("#onaysonuc").html('<a href="javascript:void(0)" onclick="onaykodu()"><font color=red size=1><b>Kodu Tekrar Gönder</b></font></a>');
		tekrarlama = tekrarlama + 1;
		}
		clearTimeout();
		}
	}
	
	function kodsuzdevam(){
		$(".onaykoduinput").hide();
		$("#onaysonuc").html("<font color=green size=1><b>Kayıt için telefon onayınız artık istenmemektedir.</b></font>");
	}
	function kodonayla(){
		var onaykodu = $("#onaykod").val();
		var uzunluk = onaykodu.length;
		
		if(uzunluk >= 6){
		
				var uyeid = 1;
				$("#onaysonuc").html("<font color=green size=1><b>Kod onaylanıyor, lütfen bekleyin...</b></font>");
				jQuery.ajax({
					
					type: 'POST',
					url: 'inc/uyeol_sms.php',
					data: "tur=kodonayla&kod="+onaykodu+"&uyeid="+uyeid,
					success: function(sonuc){
						if(sonuc == "ok"){
							clearTimeout();
							$("#onaysonuc").hide();
							$("#onaysonuc2").html("<font color=green size=1><b>Telefonunuz başarıyla onaylandı.</b></font>");
							$("#ceptelonayvarmi").val("1");
							$(".onaykoduinput").hide();
						}
						else {
							$("#onaysonuc").html('<font color=red size=1><b>Onay kodunuz geçersiz.</b></font><br /><br /><a href="javascript:void(0)" onclick="onaykodu()"><font color=red size=1><b>Kodu Tekrar Gönder</b></font></a>');
							alert(sonuc);
						}
					}
				
				})
		}
		else {
			alert("Onay kodunu eksik yazdınız, lütfen tam olarak yazınız");
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
																			<tr>
																				<td bgcolor="#EFEFEF">
																				<table border="0" width="100%" id="table46" cellspacing="0" cellpadding="0">
																					<tr>
																						<td width="13">&nbsp;</td>
																						<td>
																						<table border="0" width="100%" id="table47" cellspacing="0" cellpadding="0">
																							<tr>
																								<td width="100" height="30">
																								<p class="form_txt">Adınız:</td>
																								<td><input type="text" name="ad" id="ad" size="24" class="inputlar" onblur="degerlendir('ad')"> <span id="spanad"><input type="hidden" name="adsonuc" id="adsonuc" value="no" /></td>
																							</tr>
																						</table>
																						</td>
																						<td width="13">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="13">&nbsp;</td>
																						<td>
																						<table border="0" width="100%" id="table48" cellspacing="0" cellpadding="0">
																							<tr>
																								<td width="100" height="30">
																								<p class="form_txt">Soyadınız:</td>
																								<td><input type="text" name="soyad" id="soyad" size="24" class="inputlar" onblur="degerlendir('soyad')"> <span id="spansoyad"><input type="hidden" name="soydsonuc" id="soyadsonuc" value="no" /></span></td>
																							</tr>
																						</table>
																						</td>
																						<td width="13">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="13">&nbsp;</td>
																						<td>
																						<table border="0" width="100%" id="table49" cellspacing="0" cellpadding="0">
																							<tr>
																								<td width="100" height="30">
																								<p class="form_txt">Doğum Tarihiniz:</td>
																								<td>																	<table border="0" style="border-collapse: collapse" cellpadding="0">
																		<tr>
																			<td>
																			<select size="1" name="d1" id="d1" class="selectler">
																			<? for($i = 1; $i<=31; $i++){ echo "<option value=\"$i\">$i</option>"; } ?>
																			</select></td>
																			<td width="7" height="28">&nbsp;</td>
																			<td>
																			<select size="1" name="d2" id="d2" style="font-family: Tahoma; font-size: 8pt; color: #595959">
																			<? aylar(NULL); ?>
																			</select></td>
																			<td width="7">&nbsp;</td>
																			<td>
																			<input type="text" name="d3" id="d3" size="2" maxlength="4" class="inputlar" onblur="degerlendir('d3')" value="19"> <span id="spand3"><input type="hidden" name="d3sonuc" id="d3sonuc" value="no" /></span></td>
																		</tr>
																	</table>																								</td>
																							</tr>
																						</table>
																						</td>
																						<td width="13">&nbsp;</td>
																					</tr>
																					<tr>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
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
																			<input type="text" name="no2" id="no2" value="<?=$no2?>" size="10" maxlength="7" class="inputlar"> <input type="hidden" name="ceptelonayvarmi" id="ceptelonayvarmi" value="0" /></td>
																		</tr>
																	</table>
																								</td>
																							</tr>
																						</table>
																						</td>
																						<td width="13">&nbsp;</td>
																					</tr>
																					
																					<tr>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					
																					<tr class="onaykoduinput" style="display:none">
																						<td width="13">&nbsp;</td>
																						<td>
																						<table border="0" width="100%" id="table50" cellspacing="0" cellpadding="0">
																							<tr>
																								<td width="100" height="30">
																								<p class="form_txt">Onay Kodu:</td>
																								<td>
																	<table border="0" style="border-collapse: collapse" cellpadding="0">
																		<tr>
																			<td width="7" height="28">&nbsp;</td>
																			<td>
																			<input type="text" name="onaykod" id="onaykod" onBlur="kodonayla()" size="8" maxlength="6" class="inputlar"></td>
																			<td width="7">&nbsp;</td>
																		</tr>
																	</table>
																								</td>
																							</tr>
																						</table>
																						</td>
																						<td width="13">&nbsp;</td>
																					</tr>
																					
																					<tr class="onaykoduinput" style="display:none">
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>	
																					
																					<tr>
																						<td width="13">&nbsp;</td>
																						<td>
																						<table border="0" width="100%" id="table50" cellspacing="0" cellpadding="0">
																							<tr>
																								<td width="100" height="30">
																								<p align="center"><span id="onaysonuc"><a href="javascript:void(0)" onclick="onaykodu()"><img src="img/onaykodu.jpg" /></a></span><span id="onaysonuc2"></span></p>
																								</td>
																							</tr>
																						</table>
																						</td>
																						<td width="13">&nbsp;</td>
																					</tr>																					
																					
																					<tr>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																						<td width="13" bgcolor="#E9E9E9"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																					</tr>
																					<tr>
																						<td width="13">&nbsp;</td>
																						<td>
																						<table border="0" width="100%" id="table51" cellspacing="0" cellpadding="0">
																							<tr>
																								<td width="100" height="30">
																								<p class="form_txt">Mail Adresiniz:</td>
																								<td><input type="text" name="mail" id="mail" size="24" class="inputlar" onblur="degerlendir('mail')"> <span id="spanmail"><input type="hidden" name="mailsonuc" id="mailsonuc" value="no" /></span></td>
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
																		<p class="not">
																		<font color="#D22A2A">
																		Yukarıdaki 
																		bilgiler 
																		sitemiz 
																		tarafından 
																		gizli 
																		tutulmaktadır..</font></td>
																	</tr>
																	<tr>
																		<td bgcolor="#E9E9E9">
																		<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td>
																		<table border="0" width="100%" id="table56" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13" height="30">&nbsp;</td>
																				<td width="100" height="30">
																				<p class="form_txt">Cinsiyetiniz:</td>
																				<td>
																	<select size="1" name="cinsiyet" id="cinsiyet" class="selectler" onblur="degerlendir('cinsiyet')">
																	<? cinsiyet(NULL); ?>
																	</select>
																	<span id="spancinsiyet"><input type="hidden" name="cinsiyetsonuc" id="cinsiyetsonuc" value="ok" /></span>
																				</td>
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
																		<table border="0" width="100%" id="table60" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13" height="30">&nbsp;</td>
																				<td width="100" height="30">
																				<p class="form_txt">Yaşadığınız Ülke:</td>
																				<td>																	<select size="1" name="ulke" id="ulke" class="selectler" onChange="sehirgetir(this.value)" onblur="degerlendir('ulke')">
																	<?
																		$result = mysql_query("select id, adi from "._MX."ulkeler order by adi asc");
																		
																		while(list($uid, $uadi) = mysql_fetch_row($result)){
																			if($uid == 214) echo "<option value=\"$uadi\" selected>".turkce($uadi)."</option>";
																			else echo "<option value=\"$uadi\">".turkce($uadi)."</option>";
																		}
																	
																	?>
																	</select>
																	<span id="spanulke"><input type="hidden" name="ulkesonuc" id="ulkesonuc" value="ok" /></span></td>
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
																		<table border="0" width="100%" id="table64" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13" height="30">&nbsp;</td>
																				<td width="100" height="30">
																				<p class="form_txt">Yaşadığınız Şehir:</td>
																				<td>
																				<span id="sehirgetir">
																	<select size="1" name="sehir" id="sehir" class="selectler" onblur="degerlendir('sehir')">
																	<?
																		$result = mysql_query("select id, adi from "._MX."sehirler where ulke='214' order by adi asc");
																		
																		while(list($sid, $sadi) = mysql_fetch_row($result)){
																			echo "<option value=\"$sadi\">".turkce($sadi)."</option>";
																		}	
																	?>
																	</select>
																	</span>
																	<span id="spansehir"><input type="hidden" name="sehirsonuc" id="sehirsonuc" value="ok" /></span></td>
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
																		<table border="0" width="100%" id="table68" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13" height="30">&nbsp;</td>
																				<td width="100" height="30">
																				<p class="form_txt">Rumuzunuz:</td>
																				<td><input type="text" name="rumuz" id="rumuz" size="24" class="inputlar" onblur="degerlendir('rumuz')"> <span id="spanrumuz"><input type="hidden" name="rumuzsonuc" id="rumuzsonuc" value="no" /></span></td>
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
																		<table border="0" width="100%" id="table72" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13" height="30">&nbsp;</td>
																				<td width="100" height="30">
																				<p class="form_txt">Şifreniz:</td>
																				<td>
																				<input type="password" name="sifre" id="sifre" size="18" class="inputlar" onblur="degerlendir('sifre')"> <span id="spansifre"></span></td>
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
																		<table border="0" width="100%" id="table76" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13" height="30">&nbsp;</td>
																				<td width="100" height="30">
																				<p class="form_txt">Şifreniz (tekrar):</td>
																				<td>
																				<input type="password" name="sifre2" id="sifre2" size="18" class="inputlar" onblur="sifredegerlendir()"> <span id="spansifre2"></span></td>
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
																		<table border="0" width="100%" id="table72" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13" height="30">&nbsp;</td>
																				<td width="100" height="30">
																				<p class="form_txt">Şifre güvenliği:</td>
																				<td>
																				<span id="spansifresonuc"><input type="hidden" name="sifresonuc2" id="sifresonuc2" value="no" /></span>&nbsp;</td>
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
																		<table border="0" width="100%" id="table80" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13" height="30">&nbsp;</td>
																				<td width="100" height="30">
																				<p class="form_txt">Kontrol Kodu:</td>
																				<td>
																	<table border="0" style="border-collapse: collapse" cellpadding="0">
																		<tr>
																			<td>
																			<p class="form_txt">
																			<?
																				$toplam = rand(10000,99999);
																				 
																			?>
																			<img src="inc/guvenlikkodu.php?sifre=<?=$toplam?>" border="0" />
																			</p>
																			</td>
																			<td width="7" height="28">&nbsp;</td>
																			<td>
																			<input type="text" name="gkodu" id="gkodu" size="4" class="inputlar" maxlength="5" onblur="gkodudegerlendir()"> <span id="spangkodu"><input type="hidden" name="gkodusonuc" id="gkodusonuc" value="no" /></span><input type="hidden" name="gkodu2" id="gkodu2" value="<?=$toplam?>"></td>
																		</tr>
																	</table>
																				</td>
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
																		<span id="uyeolsonuc"></span>
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
														<td align="right">
														<table border="0" id="table91" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<a href="javascript:uyeol()" title="Kaydet ve İlerle" id="uyeolahref"><img border="0" src="img/btn_kaydet_ilerle.gif" width="210" height="40"></a></td>
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