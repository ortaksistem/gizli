<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Hayatı Paylaş Oku <?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link rel="stylesheet" href="inc/basic.css" type="text/css" />
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

	function yoneticiyebildir(uye){

			
			mahirixpencere("Yöneticiye bildirin", "<p align=center><img src='img/loading.gif' /></p>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=yoneticiyebildir',
				data : "uye="+uye+"&uyeadi=<?=$uyeadi?>",
				success: function(sonuc){		
					mahirixpencereguncelle(sonuc);
				}
			})
			

		
	
	}

	function yoneticiyebildiruygula(uye){
		
		var gonderen = <?=$uyeid?>;
				
		var konu = document.getElementById("konu").value;
		var mesaj = document.getElementById("mesaj").value;
		
		if(konu == ""){
			$("#mesajgondersonuc").html("<font color=red><b>Konuyu yazın</b></font>");
		}
		else if(mesaj == ""){
			$("#mesajgondersonuc").html("<font color=red><b>Mesajı Yazın</b></font>");
		}
		else {
			$("#mesajgondersonuc").html("<img src='img/loading.gif' /> Bekleyin");

			jQuery.ajax({
				type : 'POST',
				url : 'inc/yoneticiyebildir.php',
				data : "yer=hayatipaylas&gonderen="+gonderen+"&gonderilen="+uye+"&mesaj="+mesaj+"&konu="+konu,
				success: function(sonuc){		
					if(sonuc == "ok"){
						mahirixpencereguncelle("<p align=center><font color=green><b>Bildiriminiz gönderilmiştir. En kısa zamanda ilgilenilecektir. Teşekkür ederiz.</b></font>");
					}
					else {
						$("#mesajgondersonuc").html("<font color=red><b>Mesajınız şuan gönderilemiyor, lütfen sonra tekrar deneyiniz</b></font>");
					}
				}
			})
				
		}
	
	}
</script>
</head>
<body onLoad="menuler('durummerkezi');">
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
										<td width="540" valign="top" align="center">
										<!-- icerik -->

										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_pembe.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Oku.</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table525" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													
													<?php

														$limit = 8;
														
														$p = $_GET["p"];
														
														$p = intval($p);
														
														if(!$p) $p = 1;
														
														
														
															
														$toplam = mysql_query("select count(id) from "._MX."hayati_paylas where durum='1'");
															
														list($toplam) = mysql_fetch_row($toplam);
															
														$toplamsayfa = ceil(($toplam/$limit));
																												
														
														$result = mysql_query("select id, uye, konu, mesaj, kayit from "._MX."hayati_paylas where durum='1' order by id desc limit ".(($p-1)*$limit).",".$limit."");
														
														
														while(list($id, $uye, $konu, $mesaj, $kayit) = mysql_fetch_row($result)){
														
														
														list($kullanici, $cinsiyet, $img) = mysql_fetch_row(mysql_query("select kullanici, cinsiyet, img from "._MX."uye where id='$uye'"));
														
														$img = uyeavatar($img, $cinsiyet);
														
														$konu = stripslashes($konu);
														
														$mesaj = stripslashes($mesaj);
														
														
														$tarih = tarihdon($kayit);
														
													?>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table290" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>&nbsp;</td>
																		<td width="486">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td><img border="0" src="img/hytipaylas_penc01_ac.gif" width="486" height="10"></td>
																			</tr>
																			<tr>
																				<td background="img/hytipaylas_penc01_bg.gif">
																		<table border="0" width="100%" id="table534" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="10">&nbsp;</td>
																				<td width="10">
																		<img border="0" src="<?=$img?>" width="70" height="70"></td>
																				<td width="10">&nbsp;</td>
																				<td>
																		<table border="0" width="100%" id="table535" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>
																				<p class="soru">Gönderen <?=$kullanici?></td>
																			</tr>
																			<tr>
																				<td height="4"></td>
																			</tr>
																			<tr>
																				<td>
																				<p class="msg_tit"><b><?=$konu?></b></td>
																			</tr>
																		</table>
																				</td>
																				<td width="110">
																		<table border="0" width="100%" id="table536" cellspacing="0" cellpadding="0">
																			<tr>
																				<td align="right">
																				<p class="yas"><?=$tarih?></td>
																			</tr>
																			<tr>
																				<td height="16"></td>
																			</tr>
																			<tr>
																				<td align="right">
																				<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);"><img border="0" src="img/btn_proflnebak.gif" width="86" height="22"></a></td>
																			</tr>
																		</table>
																				</td>
																				<td width="10">&nbsp;</td>
																			</tr>
																		</table>
																				</td>
																			</tr>
																			<tr>
																				<td><img border="0" src="img/hytipaylas_penc01_kapa.gif" width="486" height="10"></td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="12"></td>
																		<td width="486" height="12"></td>
																		<td height="12"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="486">
																		<table border="0" width="100%" id="table563" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="10">&nbsp;</td>
																				<td>
																				<p class="tx">
																				<?=$mesaj?>
																				</td>
																				<td width="10">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="5"></td>
																		<td width="486" align="right" height="5"></td>
																		<td height="5"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="486" align="right">
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td>
																		<p class="not2_byz">
																		<b>
																		<a class="not2_byz" href="javascript:void(0)" onclick="yoneticiyebildir(<?=$uye?>)">
																		<u>
																		<span style="font-size: 9pt">
																		<font color="#C32828">Yöneticiye 
																		Bildir</font></span></u></a></b></td>
																		<td width="8">&nbsp;</td>
																		<td>
																		<img border="0" src="img/iko_yonetici_bildir.gif" width="16" height="16"></td>
																	</tr>
																</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="6"></td>
																		<td width="486" align="right" height="6"></td>
																		<td height="6"></td>
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<?php
													
														} // end while
													?>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<a href="index.php?sayfa=hayati_paylas_yaz"><img border="0" src="img/btn_paylasmakist.gif" width="190" height="35"></a></td>
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
												<td background="img/alt_kapa_pembe.gif" height="41">
												<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
													<?php
														
														if($p == 1) $oncekisayfa = $toplamsayfa;
														else $oncekisayfa = $p - 1;
														
														if($p == $toplamsayfa) $sonrakisayfa = 1;
														else $sonrakisayfa = $p + 1;
													
													?>
													<tr>
														<td width="10" height="41">&nbsp;</td>
														<td width="120">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td width="20">
																<img border="0" src="img/sayfa_cevir_iko_sol.gif" width="20" height="18"></td>
																<td width="6">&nbsp;</td>
																<td>
																<a class="ok_onceki_sonraki" href="index.php?sayfa=hayati_paylas_oku&p=<?=$oncekisayfa?>">
																Önceki Sayfa</a></td>
															</tr>
														</table>
														</td>
														<td align="center">
														&nbsp;
														</td>
														<td width="120" align="right">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td align="right">
																<a class="ok_onceki_sonraki" href="index.php?sayfa=hayati_paylas_oku&p=<?=$sonrakisayfa?>">
																Sonraki Sayfa</a></td>
																<td width="6">&nbsp;</td>
																<td width="20">
																<img border="0" src="img/sayfa_cevir_iko_sag.gif" width="20" height="18"></td>
															</tr>
														</table>
														</td>
														<td width="10">&nbsp;</td>
													</tr>
												</table>
												</td>
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