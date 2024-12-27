<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

unset($_SESSION[_COOKIE."listele"]);

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Yeni Üyeler <?=$uyeadi?>, <?=_BASLIK?></title>
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

	function listele(kimi){
	
		$("#uyeler").html('<td>&nbsp;</td><td width="510" align="center"><img src=img/loading.gif /> <font size=2><b>Yükleniyor...</b></font></td>');
		
		var sayfa = document.getElementById("sayfa").value;
		
			jQuery.ajax({
				type : 'POST',
				url : 'inc/aramauyeler.php',
				data : "islem=yeniuyeler&hangisi="+kimi+"&sayfa="+sayfa,
				success: function(sonuc){		
					$("#uyeler").html('<td>&nbsp;</td><td width="510" align="center">'+sonuc+'</td>');
					sayfayazdir();
				}
			})
			
			
	}
	
	function sayfa(){
	
		$("#uyeler").html('<td>&nbsp;</td><td width="510" align="center"><img src=img/loading.gif /> <font size=2><b>Yükleniyor...</b></font></td>');
		
		var sayfa = document.getElementById("sayfa").value;
		
			jQuery.ajax({
				type : 'POST',
				url : 'inc/aramauyeler.php',
				data : "islem=yeniuyeler&sayfa="+sayfa,
				success: function(sonuc){		
					$("#uyeler").html('<td>&nbsp;</td><td width="510" align="center">'+sonuc+'</td>');
				}
			})
			
			
	}
	
	function sayfayazdir(){

			var sayfa = 1;
			
			jQuery.ajax({
				type : 'POST',
				url : 'inc/aramauyeler.php',
				data : "islem=yeniuyelersayfa&sayfa="+sayfa,
				success: function(sonuc){		
					$("#sayfalar").html(sonuc);
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
										<table border="0" width="100%" id="table173" cellspacing="0" cellpadding="0">
											<tr>
												<td height="46" background="img/ust_ac_turkuaz.gif">
												<table border="0" width="100%" id="table449" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Yeni Üyeler</td>
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
												<table border="0" width="100%" id="table450" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" width="100%" id="table451" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td background="img/msg_kutusu_bg.gif">
																<table border="0" width="100%" id="table524" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="4"></td>
																		<td width="115" height="4">
																		</td>
																		<td width="15" height="4"></td>
																		<td width="115" height="4">
																		</td>
																		<td width="15" height="4"></td>
																		<td width="115" height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="115">
																		<a href="javascript:listele('bayan')"><img border="0" src="img/btn_cins_bayan.gif" width="115" height="19"></a></td>
																		<td width="15">&nbsp;</td>
																		<td width="115">
																											<a href="javascript:listele('erkek')"><img border="0" src="img/btn_cins_erkek.gif" width="115" height="19"></a></td>
																		<td width="15">&nbsp;</td>
																		<td width="115">
																		<a href="javascript:listele('ciftler')"><img border="0" src="img/btn_cins_ciftler.gif" width="115" height="19"></a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="5">
																		</td>
																		<td width="115" height="5">
																		</td>
																		<td width="15" height="5">
																		</td>
																		<td width="115" height="5">
																		</td>
																		<td width="15" height="5">
																		</td>
																		<td width="115" height="5">
																		</td>
																		<td width="15" height="5">
																		</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="115">
									
																		<td width="15">&nbsp;</td>
																		<td width="115">
																		<td width="15">&nbsp;</td>
																		<td width="115">
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="4"></td>
																		<td width="115" height="4">
																		</td>
																		<td width="15" height="4"></td>
																		<td width="115" height="4">
																		</td>
																		<td width="15" height="4"></td>
																		<td width="115" height="4">
																		</td>
																		<td width="15" height="4"></td>
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
													<tr id="uyeler">
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" id="table452" cellspacing="0" cellpadding="0">
														<tr>
														<?php
															
															$limit = 16;
															
															$sayfa = 1;
															
															$toplam = mysql_query("select count(id) from "._MX."uye");
															
															list($toplam) = mysql_Fetch_row($toplam);
															
															$toplamsayfa = ceil(($toplam/$limit));
															
															
															$result = mysql_query("select id, kullanici, cinsiyet, dogum, sehir, img, tanitim, seviye from "._MX."uye where durum='1' order by cinsiyet asc, id desc limit ".(($sayfa-1)*$limit).",".$limit."");
															
															
															$i = 1;
															
															while(list($id, $kullanici, $cinsiyet, $dogum, $sehir, $img, $tanitim, $seviye) = mysql_fetch_row($result)){
															
															
															$tanitim = stripslashes($tanitim);
															
															$yas = (date("Y")-date("Y", $dogum));
															
															list($online) = mysql_fetch_row(mysql_query("select count(uye) from "._MX."online where uye='$id'"));
															
															$img = uyeavatar($img, $cinsiyet);
															
															if($online >= 1) $online = '<p class="online">Online</p>';
															else $online = '<p class="offline">Offline</p>';
														
															$seviyead = seviye($seviye, "ad");
															
															$seviyerenk = seviye($seviye, "renk");
															
														?>	
																<td valign="top">
																<table border="0" id="table453" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="100" height="126" background="img/uyelistele_fotoarkasi.gif">
																		<table border="0" width="100%" id="table457" cellspacing="0" cellpadding="0">
																			<tr>
																				<td height="28" align="center">
																				<?=$online?></td>
																			</tr>
																			<tr>
																				<td height="70" align="center"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);" title="<?=$tanitim?>"><img border="0" src="<?=$img?>" width="70" height="70"></a></td>
																			</tr>
																			<tr>
																				<td height="28" align="center">
																				<p class="uye_small"><?=$seviyead?></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="6">
																		</td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="20">
																		<p class="nickname">
																		<a class="form_txt2" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);">
																		<font color="<?=$seviyerenk?>"><?=$kullanici?></font></a></td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="20">
																		<p class="yas"><?=$yas?> 
																		Yaşında</td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="20">
																		<p class="yer">
																		<?=$sehir?></td>
																	</tr>
																</table>
																</td>
																<td width="25">&nbsp;</td>
																
																<?php
																
																	if($i%4 == 0) {
																?>
															</tr>
															<tr>
																<td valign="top">
																&nbsp;</td>
																<td width="25">&nbsp;</td>
																<td valign="top">
																&nbsp;</td>
																<td width="25">&nbsp;</td>
																<td valign="top">
																&nbsp;</td>
																<td width="25">&nbsp;</td>
																<td valign="top">
																&nbsp;</td>
															</tr>
															<tr>
															<?php
																	}
																
																	$i++;
																	
																	} // end while
																?>
																
														</table>
														</td>
														<td>&nbsp;</td>
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
												<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
													<tr>
														<td width="10" height="41">&nbsp;</td>
														<td width="120">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>

															</tr>
														</table>
														</td>
														<td align="center">
														<font color=white size=2><b>Diğer Sayfalar : </b></font>
														
														<span id="sayfalar">
														<select name="sayfa" id="sayfa" onChange="sayfa()" class="selectler">
														<?php
															for($i = 1; $i <= $toplamsayfa; $i++) echo "<option value=$i>Sayfa : $i</option>";
														?>
														</select>
														</span>
														
														</td>
														<td width="120" align="right">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>

															</tr>
														</table>
														</td>
														<td width="10">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td align="center">
												&nbsp;</td>
											</tr>
											<tr>
												<td align="center">
												<? echo stripslashes(ayar("icerikalti")); ?>
												</td>
											</tr>
											<tr>
												<td align="center">
												&nbsp;</td>
											</tr>
											</table>


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