<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$result = mysql_query("select * from "._MX."uye where id='$uyeid'");

$rowla = mysql_fetch_array($result);

$songiris = $rowla["sononline2"];

$songiris2 = tarihdon($songiris);
$songiris = date("H:i", $songiris);

$bitis = $rowla["bitis"];

if($bitis){
	$bitis = tarihdon($bitis);
}
else {
	$bitis = "S�n�rs�z";
}

$dogum = $rowla["dogum"];

$dogum = tarihdon($dogum);

$cinsiyet = $rowla["cinsiyet"];

$cinsiyet = cinsiyet($cinsiyet);

$goruntulenme = $rowla["goruntulenme"];

$seviye = $rowla["seviye"];

$seviyeicon = seviyeal("seviyeicon");

$ay = date("m");

$yil = date("Y");

$resultpuan = mysql_query("select toplamoy, toplampuan from "._MX."uye_oy where uye='$uyeid' and ay='$ay' and yil='$yil'");

list($toplamoy, $toplampuan) = mysql_fetch_row($resultpuan);

if($toplamoy){
	$aylikpuan = "<b>$toplamoy</b> �yeden <b>$toplampuan</b> ald�n�z";
}
else {
	$aylikpuan = "<b>Bu ay hi� oy almad�n�z</b>";
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Ho�geldin <?=$uyeadi?></title>
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
	
	function listele(hangisi, tur){
	
		$(".uyelersol").css("background-image", "url(img/tik2_kapa_sol.gif)");
		$(".uyelerorta").css("background-color", "#ff5438");
		$(".uyelerorta a").css("color", "#fff");
		$(".uyelersag").css("background-image", "url(img/tik2_kapa_sag.gif)");
		
		
		$("#uyelersol"+hangisi).css("background-image", "url(img/tik1_acik_sol.gif)");
		$("#uyelerorta"+hangisi).css("background-color", "#fff");
		$("#uyelerorta"+hangisi+" a").css("color", "#808080");
		$("#uyelersag"+hangisi).css("background-image", "url(img/tik1_acik_sag.gif)");


		$("#uyeler").html('<td background="img/x7_pencere_kimlik_bg.png" align="center"><img src=img/loading.gif /> <font size=2><b>Y�kleniyor bekleyin ...</b></font></td>');

			jQuery.ajax({
				type : 'POST',
				url : 'inc/girisuyeler.php',
				data : "listele="+hangisi+"&tur="+tur,
				success: function(sonuc){		
					$("#uyeler").html('<td background="img/x7_pencere_kimlik_bg.png" align="center">'+sonuc+'</td>');
				}
			})
			
	}
	
	function bildirimkabul(){


		$("#bildirim2").hide();
		$("#bildirim1").hide();
		
			jQuery.ajax({
				type : 'POST',
				url : 'inc/bildirimkabul.php',
				data : "kabul=evet",
				success: function(sonuc){		
					
				}
			})	
	
	}
</script>
</head>
<body>
<table border="0" width="100%" id="table1" cellspacing="0" cellpadding="0" height="100%">
	<tr>
		<td width="16">&nbsp;</td>
		<td width="790" valign="top">
		<table border="0" width="100%" id="table2" cellspacing="0" cellpadding="0">
			<tr>
				<td height="22" align="center">&nbsp;</td>
			</tr>
			<tr>
				<td>
				<img border="0" src="img/ste_ust.gif" width="790" height="11"></td>
			</tr>
			<tr>
				<td>
				<table border="0" width="100%" id="table3" cellspacing="0" cellpadding="0">
					<tr>
						<td width="10" background="img/ste_golge_sol.gif">&nbsp;</td>
						<td bgcolor="#FFFFFF">
						<table border="0" width="100%" id="table13" cellspacing="0" cellpadding="0">
							
							<?php include("inc/giris-ust2.php"); ?>
							
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
										<table border="0" width="100%" id="table15" cellspacing="0" cellpadding="0">
											<tr>
												<td height="45" background="img/pncere1_a_ust.gif">
												<table border="0" width="100%" id="table40" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20" height="45">&nbsp;</td>
														<td>
														<p class="menu"><b>
														Ho�geldin <?=$uyeadi?></b></td>
														<td width="100" align="right" valign="bottom">
														<a href="index.php?sayfa=cikis">
														<img border="0" src="img/btn_guvenli_cikis.gif" width="100" height="28"></a></td>
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
														<table border="0" width="100%" id="table17" cellspacing="0" cellpadding="0">
															<tr>
																<td width="15">&nbsp;</td>
																<td width="122" valign="top">
																<table border="0" width="100%" id="table18" cellspacing="0" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/pencere_foto_ust.gif" width="122" height="6"></td>
																	</tr>
																	<tr>
																			<?php
																				$img = $rowla["img"];
																				$img = uyeavatar($img, $rowla["cinsiyet"]);
																			?>
																		<td background="img/pencere_foto_bg.gif" align="center">
																		<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=profil&id=<?=$uyeid?>', '745', '700', 'profilpopup<?=$uyeid?>', 2, 1, 1);" title="Profiline Bak"><img border="0" src="<?=$img?>" width="110" height="110"></a></td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/pencere_foto_alt.gif" width="122" height="6"></td>
																	</tr>
																</table>
																</td>
																<td width="15">&nbsp;</td>
																<td>
																<table border="0" id="table19" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="22">
																		<p class="soru">
																		cinsiyet</td>
																		<td align="center" width="17" height="22">
																		<p class="c">
																		<b>:</b></td>
																		<td height="22">
																		<p class="cc">
																		<b><?=$cinsiyet?></b></td>
																	</tr>
																	<tr>
																		<td height="22">
																		<p class="soru">
																		do�um 
																		tarihi</td>
																		<td align="center" width="17" height="22">
																		<p class="c">
																		<b>:</b></td>
																		<td height="22">
																		<p class="cc">
																		<b><?=$dogum?></b></td>
																	</tr>
																	<tr>
																		<td height="22">
																		<p class="soru">
																		�yelik 
																		biti� 
																		tarihi</td>
																		<td align="center" width="17" height="22">
																		<p class="c">
																		<b>:</b></td>
																		<td height="22">
																		<p class="cc">
																		<b><?=$bitis?></b></td>
																	</tr>
																	<tr>
																		<td height="22">
																		<p class="soru">
																		en son 
																		ziyaret 
																		tarihi</td>
																		<td align="center" width="17" height="22">
																		<p class="c">
																		<b>:</b></td>
																		<td height="22">
																		<p class="cc">
																		<b><?=$songiris2?>
																		[<?=$songiris?>]</b></td>
																	</tr>
																	<tr>
																		<td height="22">
																		<p class="soru">
																		bu ayki 
																		oy 
																		puan�n�z</td>
																		<td align="center" width="17" height="22">
																		<p class="c">
																		<b>:</b></td>
																		<td height="22">
																		<p class="cc">
																		<b><?=$aylikpuan?></b></td>
																	</tr>
																	<?php
																	
																		if($rowla["tanitimonay"] == 3){
																	?>
																	<tr>
																		<td height="22">
																		<p class="soru">
																		<font color=red><b>D�KKAT</b></font></td>
																		<td align="center" width="17" height="22">
																		<p class="c">
																		<b>:</b></td>
																		<td height="22">
																		<p class="cc">
																		Profil tan�t�m yaz�n�z edit�r taraf�ndan red edilmi�tir</td>
																	</tr>
																	<?php
																		}
																		
																		if($rowla["topbildirim"] >= 1){
																	?>
																	<tr id="bildirim1">
																		<td height="22">
																		<p class="soru">
																		<font color=red><b>D�KKAT</b></font></td>
																		<td align="center" width="17" height="22">
																		<p class="c">
																		<b>:</b></td>
																		<td height="22">
																		<p class="cc">
																		<?=stripslashes($rowla["bildirim"]);?></td>
																	</tr>
																	<tr id="bildirim2">
																		<td height="22">
																		<p class="soru">
																		<font color=red><b>&nbsp;</b></font></td>
																		<td align="center" width="17" height="22">
																		<p class="c">
																		<b>&nbsp;</b></td>
																		<td height="22">
																		<p class="cc">
																		<a href="javascript:void(0)" onClick="bildirimkabul()" title="Okudum ve kabul ettim" class="cc">Okudum ve Kabul Ettim</a></td>
																	</tr>
																	<?php
																		
																		}
																	?>
																</table>
																</td>
																<td width="15">&nbsp;</td>
															</tr>
															<tr>
																<td width="15" height="6">
																</td>
																<td width="122" valign="top" height="6">
																</td>
																<td width="15" height="6">
																</td>
																<td valign="top" height="6">
																</td>
																<td width="15" height="6">
																</td>
															</tr>
															<tr>
																<td width="15">&nbsp;</td>
																<td width="122" valign="top">
																<img border="0" src="img/uye_img_<?=$seviyeicon?>.gif" width="122" height="27"></td>
																<td width="15">&nbsp;</td>
																<td background="img/bg_kackisi.gif">
																<table border="0" id="table20" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="11">&nbsp;</td>
																		<td>
																		<img border="0" src="img/iko_user2.gif" width="13" height="14"></td>
																		<td width="9">&nbsp;</td>
																		<td height="27">
																		<p class="copyright">
																		profiliniz
																		<font color="#D22A2A">
																		<b><?=$goruntulenme?></b></font> 
																		kere 
																		ziyaret 
																		edilmi�tir</td>
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
														<td>
														<table border="0" width="100%" id="table21" cellspacing="0" cellpadding="0">
															<tr>
																<td width="15">&nbsp;</td>
																<td align="center">
																<table border="0" id="table22" cellspacing="0" cellpadding="0">
																	<tr>
																		<td valign="top">
																		<table border="0" id="table23" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok1a.gif" width="11" height="13"></td>
																				<td height="20"><a class="lnk01" href="index.php?sayfa=profil_resim">resimlerim</a></td>
																			</tr>
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok1a.gif" width="11" height="13"></td>
																				<td height="20"><a class="lnk01" href="index.php?sayfa=profil_galeri&yer=istek">teklif listem</a></td>
																			</tr>
																			<tr>
																				<td width="13">&nbsp;</td>
																				<td height="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td width="40" valign="top">&nbsp;</td>
																		<td valign="top">
																		<table border="0" id="table24" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok1a.gif" width="11" height="13"></td>
																				<td height="20"><a class="lnk01" href="index.php?sayfa=profil_galeri">galerilerim</a></td>
																			</tr>
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok1a.gif" width="11" height="13"></td>
																				<td height="20"><a class="lnk01" href="index.php?sayfa=profil_kimleroyverdi">kimler oy verdi?</a></td>
																			</tr>
																			<tr>
																				<td width="13">&nbsp;</td>
																				<td height="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td width="40" valign="top">&nbsp;</td>
																		<td valign="top">
																		<table border="0" id="table25" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok1a.gif" width="11" height="13"></td>
																				<td height="20"><a class="lnk01" href="javascript:void(0)" onClick="pencere('index.php?sayfa=uyelik_haftaninuyesiol', '600', '700', 'haftaninuyesi', 2, 1, 1);">haftan�n �yesi ol</a></td>
																			</tr>
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok1a.gif" width="11" height="13"></td>
																				<td height="20"><a class="lnk01" href="index.php?sayfa=uyelik_tablosu">�yelik tablosu</a></td>
																			</tr>
																			<tr>
																				<td width="13">&nbsp;</td>
																				<td height="20">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td width="40" valign="top">&nbsp;</td>
																		<td valign="top">
																		<table border="0" id="table26" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok1a.gif" width="11" height="13"></td>
																				<td height="20"><a class="lnk01" href="index.php?sayfa=arkadas_begenenler">hayranlar�m</a></td>
																			</tr>
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok1a.gif" width="11" height="13"></td>
																				<td height="20"><a class="lnk01" href="index.php?sayfa=uyelik_sil">�yeli�imi sil</a></td>
																			</tr>
																		</table>
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
														<td height="8">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td>
												<img border="0" src="img/pncere1_a_alt.gif" width="540" height="10"></td>
											</tr>
											<tr>
												<td background="img/pncere1_b_bg.gif" align="center" height="8">
												<img border="0" src="img/1px.gif" width="1" height="1"></td>
											</tr>
											<tr>
												<td background="img/pncere1_b_bg.gif" align="center">
																<table border="0" id="table32" cellspacing="0" cellpadding="0">
																	<tr>
																		<td valign="top">
																		<table border="0" id="table33" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok2.gif" width="7" height="7"></td>
																				<td height="22"><a class="lnk02" href="javascript:void(0)" onClick="pencere('index.php?sayfa=uyelik_mailimidegistir', '380', '380', 'mailimidegistir', 2, 1, 1);">mailimi de�i�tir</a></td>
																			</tr>
																			</table>
																		</td>
																		<td width="40" valign="top">&nbsp;</td>
																		<td valign="top">
																		<table border="0" id="table37" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok2.gif" width="7" height="7"></td>
																				<td height="22"><a class="lnk02" href="javascript:void(0)" onClick="pencere('index.php?sayfa=uyelik_sifremidegistir', '380', '380', 'sifremidegistir', 2, 1, 1);">�ifremi de�i�tir</a></td>
																			</tr>
																			</table>
																		</td>
																		<td width="40" valign="top">&nbsp;</td>
																		<td valign="top">
																		<table border="0" id="table38" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok2.gif" width="7" height="7"></td>
																				<td height="22"><a class="lnk02" href="index.php?sayfa=arkadas_davetiyegonder">davetiye g�nder</a></td>
																			</tr>
																			</table>
																		</td>
																		<td width="40" valign="top">&nbsp;</td>
																		<td valign="top">
																		<table border="0" id="table39" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="13"><img border="0" src="img/iko_ok2.gif" width="7" height="7"></td>
																				<td height="22"><a class="lnk02" href="index.php?sayfa=uyelik_nasilpuanalabilirim">nas�l puan <br>alabilirim?</a></td>
																			</tr>
																			</table>
																		</td>
																	</tr>
																</table>
																</td>
											</tr>
											<tr>
												<td background="img/pncere1_b_bg.gif" align="center" height="6">
												<img border="0" src="img/1px.gif" width="1" height="1"></td>
											</tr>
											<tr>
												<td>
												<img border="0" src="img/pncere1_b_alt.gif" width="540" height="8"></td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td align="center">
												<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
													<tr>
														<td height="142" valign="top">
														<a href="index.php?sayfa=gks"><img src="img/kglbuyuk.png" border="0" /></a>
														</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td align="center">
												
												</td>
											</tr>
											<tr>
												<td height="15"></td>
											</tr>
											<tr>
												<td>
												<table border="0" width="100%" id="table41" cellspacing="0" cellpadding="0">
													<tr>
														<td background="img/bg_haftanin_uyeleri.gif" height="41">
														<table border="0" width="100%" id="table117" cellspacing="0" cellpadding="0">
															<tr>
																<td width="10" height="41">&nbsp;</td>
																<td valign="bottom">
																<table border="0" id="table121" cellspacing="0" cellpadding="0">
																	<tr>
																		<td valign="bottom">
																		<table border="0" id="table122" cellspacing="0" cellpadding="0">
																			<tr>
																				<td class="uyelersol" id="uyelersolhafta" background="img/tik1_acik_sol.gif" width="26" height="28"></td>
																				<td class="uyelerorta" id="uyelerortahafta" style="background-color:#fff">
																				<p class="cc"><a class="menutik" href="javascript:listele('hafta', 'hepsi')" title="Haftan�n �yelerini listele" style="color:#808080">Haftan�n �yeleri</a></td>
																				<td class="uyelersag" id="uyelersaghafta" background="img/tik1_acik_sag.gif" width="15" height="28"></td>
																			</tr>
																		</table>
																		</td>
																		<td width="6">&nbsp;</td>
																		<td valign="bottom">
																		<table border="0" id="table123" cellspacing="0" cellpadding="0">
																			<tr>
																				<td class="uyelersol" id="uyelersolpopuler" background="img/tik2_kapa_sol.gif" width="26" height="28"></td>
																				<td class="uyelerorta" id="uyelerortapopuler" style="background:#ff5428">
																				<p class="cc"><a class="menutik" href="javascript:listele('populer', 'hepsi')">Pop�ler �yeler</a></td>
																				<td class="uyelersag" id="uyelersagpopuler" background="img/tik2_kapa_sag.gif" width="15" height="28"></td>
																			</tr>
																		</table>
																		</td>
																		<td width="6">&nbsp;</td>
																		<td valign="bottom">
																		<table border="0" id="table123" cellspacing="0" cellpadding="0">
																			<tr>
																				<td class="uyelersol" id="uyelersolyeni" background="img/tik2_kapa_sol.gif" width="26" height="28"></td>
																				<td class="uyelerorta" id="uyelerortayeni" style="background:#ff5428">
																				<p class="cc"><a class="menutik" href="javascript:listele('yeni', 'hepsi')">Yeni �yeler</a></td>
																				<td class="uyelersag" id="uyelersagyeni" background="img/tik2_kapa_sag.gif" width="15" height="28"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																</table>
																</td>
																<td width="100" align="right">&nbsp;
																</td>
																<td width="10">&nbsp;</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td background="img/pncere1_a_bg.gif" height="16">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
													</tr>
										<tr id="uyeler">
												<td background="img/x7_pencere_kimlik_bg.png" align="center">
													
													
												<table border="0" cellspacing="0" cellpadding="0">
													<tr>
<?

	$hafta = date("W");
	
	$yil = date("Y");
	
	$result = mysql_query("select uye, uyead, cinsiyet, dogum, sehir, img from "._MX."uye_hafta where hafta='$hafta' and yil='$yil' and durum='1' order by cinsiyet asc limit 12");
	
	
	$i = 1;
	
	while(list($id, $kullanici, $cinsiyet, $dogum, $sehir, $img) = mysql_fetch_row($result)){
	
	
	$kullanici = turkcejquery($kullanici);
	
	$sehir = turkcejquery($sehir);
	
	$img = uyeavatar($img, $cinsiyet);
	

?>

																<td valign="top">
																<table border="0" id="table453" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="100" height="126" background="img/uyelistele_fotoarkasi.gif">
																		<table border="0" width="100%" id="table457" cellspacing="0" cellpadding="0">
																			<tr>
																				<td height="28" align="center">
																				<a class="nickname" href="javascript:void(0)" onClick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);" title="<?=$tanitim;?>"><?=$kullanici?></a></td>
																			</tr>
																			<tr>
																				<td height="70" align="center"><a href="javascript:void(0)" onClick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);" title="<?=$tanitim?>"><img border="0" src="<?=$img?>" width="70" height="70"></a></td>
																			</tr>
																			<tr>
																				<td height="28" align="center">
																				<p class="uye_small"><?=$sehir?></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="6">
																		</td>
																	</tr>
																</table>
																</td>
														<td width="18" valign="top">&nbsp;</td>
														<?php
															
															if($i%4 == 0){
														
														?>
													</tr>
													<tr>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18" valign="top">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18" valign="top">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
													</tr>
													<?php
														
														}
														$i++;
													
													?>

<?

	} // end while
	
?>
													</tr>
													
												</table>

													<tr>
														<td background="img/pncere1_a_bg.gif" align="center">&nbsp;</td>
													</tr>
													<tr>
														<td>
														<img border="0" src="img/pncere1_alt.gif" width="540" height="9"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td align="center">
												<a href="index.php?sayfa=hayati_paylas" title="Hayat� Payla�"><img border="0" src="img/test.gif" width="540" height="138"></a></td>
											</tr>
											<tr>
												<td height="8" align="center">
												<img border="0" src="img/1px.gif" width="1" height="1"></td>
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
										�yeler</a></b></td>
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
										<td><b><a class="c" href="index.php?sayfa=uyelik_yukselt">�yeli�ini 
										y�kselt</a></b></td>
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
										<td><b><a class="c" href="index.php?sayfa=yardimmerkezi">yard�m merkezi</a></b></td>
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
								<td align="center" valign="top">&nbsp;
								</td>
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