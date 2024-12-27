<?

if(seviyeal("mesajoku") != 1){
	yonlendir("index.php?sayfa=hata");
	die();
}

$uyeid = uyeid();

$mesajid = $_GET["id"];

if(!is_numeric($uyeid) or !is_numeric($mesajid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Mesaj Oku <?=$uyeadi?></title>
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

	function sil(id){

			jQuery.ajax({
				type : 'POST',
				url : 'inc/uyemesaj.php',
				data : "islem=sil&mesaj="+id,
				success: function(sonuc){		
					window.location = "index.php?sayfa=mesaj_gelenkutusu";
				}
			})
				
	}

	function arsiv(id){

			jQuery.ajax({
				type : 'POST',
				url : 'inc/uyemesaj.php',
				data : "islem=arsiv&mesaj="+id,
				success: function(sonuc){		

					window.location = "index.php?sayfa=mesaj_gelenkutusu";

				}
			})
				
	}
	
			
	function yasakla(uye){
		
		var yasaklama = <?=seviyeal("yasakla");?>;
		
		if(yasaklama == 1){
			
			var yasaklayan = <?=$uyeid?>
			
			if(yasaklayan == uye){
				mahirixalert("Üye Yasaklama", "<div><p><font color=red><b>Kendi kendinizi yasaklayamazsınız</b></font></p></div>");			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=yasakla&yapan="+yasaklayan+"&yapilan="+uye,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("Üye Yasaklama", "<div><p><font color=red><b>Üye daha önce yasaklanmıştır.</b></font></p></div>");
						}
						else {
							mahirixalert("Üye Yasaklama", "<div><p><font color=green><b>Üyeyi başarıyla yasakladınız.</b></font></p></div>");
						}
					}
				})
			
			}
		}
		else {
			mahirixalert("Üye Yasaklama", "<div><p><font color=red><b>Üye yasaklamak için lütfen üyeliğinizi yükseltiniz</b></font></p></div>");	
		}
	}
	
	function mesajgonder(uye, mesajbaslik){
		
		
		var mesajgonderme = <?=seviyeal("mesaj");?>;
		
		var gonderen = <?=$uyeid?>;
		

		
			if(mesajgonderme == 1){
			
			mahirixpencere("Mesaj gönderin", "<p align=center><img src='img/loading.gif' /></p>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=mesajyaz',
				data : "uye="+uye+"&uyeadi=<?=$uyeadi?>&baslik="+mesajbaslik,
				success: function(sonuc){		
					mahirixpencereguncelle(sonuc);
				}
			})
			
			}
			else {
				mahirixalert("Mesaj Gönderme", "<div><p><font color=red><b>Mesaj gönderebilmek için lütfen üyeliğinizi yükseltiniz</b></font></p></div>");
						
			}
		
	
	}
	
	function mesajgonderuygula(uye){
		
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
				url : 'inc/mesajgonder.php',
				data : "gonderen="+gonderen+"&gonderilen="+uye+"&mesaj="+mesaj+"&konu="+konu,
				success: function(sonuc){		
					if(sonuc == "ok"){
						mahirixpencereguncelle("<p align=center><font color=green><b>Mesajınız üyemize başarıyla iletilmiştir</b></font>");
					}
					else if(sonuc == "hata1"){
						$("#mesajgondersonuc").html("<font color=red><b>Günlük mesaj gönderme limitiniz dolmuştur, daha fazla göndermek için üyeliğinizi yükseltiniz</b></font>");
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
<body onLoad="menuler('mesajmerkezi');">
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
										
										<?
										
										
										$result = mysql_query("select gonderen, gonderenad, konu, mesaj, kayit, durum from "._MX."uye_mesaj where id='$mesajid' and gonderilen='$uyeid'");
										
										list($gonderen, $gonderenad, $konu, $mesaj, $kayit, $durum) = mysql_fetch_row($result);
										
										$konu = turkcejquery(addslashes($konu));
										
										$mesaj = turkcejquery(addslashes($mesaj));
										
										$mesaj = nl2br($mesaj);
										
										$kayit = date("d.m.Y H:i", $kayit);
										
										if($durum == 2){
										
											mysql_query("update "._MX."uye_mesaj set durum='1' where id='$mesajid'");
											
											mysql_query("update "._MX."uye set topmesaj=topmesaj-1 where id='$uyeid'");
										
										}
										
										$ayararsiv = uyebilgi("mesajayararsiv");
										
										if($ayararsiv == 1){
									
											mysql_query("update "._MX."uye_mesaj set yer='2' where id='$mesajid'");
											
										}
										
										list($onceki) = mysql_fetch_row(mysql_query("select id from "._MX."uye_mesaj where gonderilen='$uyeid' and id < $mesajid order by id desc"));
										
										if(!$onceki){
										
											list($onceki) = mysql_fetch_row(mysql_query("select id from "._MX."uye_mesaj where gonderilen='$uyeid' order by id desc"));
											
										}
										
										list($sonraki) = mysql_fetch_row(mysql_query("select id from "._MX."uye_mesaj where gonderilen='$uyeid' and id > $mesajid order by id asc"));
										
										if(!$sonraki){
										
											list($sonraki) = mysql_fetch_row(mysql_query("select id from "._MX."uye_mesaj where gonderilen='$uyeid' order by id asc"));
											
										}
										?>
										<table border="0" width="100%" id="table257" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_mor.gif" height="46">
												<table border="0" width="100%" id="table309" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Mesaj Oku</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table289" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" width="100%" id="table290" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table291" cellspacing="0" cellpadding="0">
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494" background="img/pncre_alt_msg_oku_ic_ust.gif" height="80">
																		<table border="0" width="100%" id="table295" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="90" height="80">&nbsp;</td>
																				<td>
																		<table border="0" width="100%" id="table297" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>
																				<p class="soru">Gönderen <a class="soru" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$gonderen?>', '745', '700', 'profilpopup<?=$gonderen?>', 2, 1, 1);"><?=$gonderenad?></a></td>
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
																		<table border="0" width="100%" id="table296" cellspacing="0" cellpadding="0">
																			<tr>
																				<td align="right">
																				<p class="yas"><?=$kayit?></td>
																			</tr>
																			<tr>
																				<td height="16"></td>
																			</tr>
																			<tr>
																				<td align="right">
																				<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$gonderen?>', '745', '700', 'profilpopup<?=$gonderen?>', 2, 1, 1);"><img border="0" src="img/btn_proflnebak.gif" width="86" height="22"></a></td>
																			</tr>
																		</table>
																				</td>
																				<td width="10">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="18"></td>
																		<td width="494" height="18"></td>
																		<td height="18"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494">
																		<table border="0" width="100%" id="table294" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>&nbsp;</td>
																				<td width="440">
																				<p class="tx">
																				<?=$mesaj?>
																				</p>
																				</td>													
																				<td>&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																		<td>&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="12"></td>
																		<td width="494" height="12"></td>
																		<td height="12"></td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																		<td width="494" align="center">
																		<table border="0" width="100%" id="table292" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>&nbsp;</td>
																				<td width="476" height="51" background="img/msg_oku_btn_bg.gif" align="center" valign="top">
																				<table border="0" id="table293" cellspacing="0" cellpadding="0">
																					<tr>
																						<td height="20">&nbsp;</td>
																						<td width="13" height="20">&nbsp;</td>
																						<td height="20">&nbsp;</td>
																						<td width="13" height="20">&nbsp;</td>
																						<td height="20">&nbsp;</td>
																					</tr>
																					<tr>
																						<td><a href="javascript:arsiv(<?=$mesajid?>)"><img border="0" src="img/bnt_msgoku_arsivegonder.gif" width="110" height="31"></a></td>
																						<td width="13">&nbsp;</td>
																						<td><a href="javascript:yasakla(<?=$gonderen?>)"><img border="0" src="img/bnt_msgoku_engelle.gif" width="130" height="31"></a></td>
																						<td width="13">&nbsp;</td>
																						<td><a href="javascript:mesajgonder(<?=$gonderen?>, '<?=$konu?>')"><img border="0" src="img/bnt_msgoku_cevapla.gif" width="110" height="31"></a></td>
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
												<td background="img/alt_kapa_mor.gif" height="41">
												<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
													<tr>
														<td width="10" height="41">&nbsp;</td>
														<td align="left" width="80">
														<a href="index.php?sayfa=mesaj_mesajoku&id=<?=$onceki?>" title="Önceki Mesajı Oku"><img border="0" src="img/onceki.gif" width="80" height="18"></a>
														</td>
														<td align="center">
														<a href="javascript:sil(<?=$mesajid?>)"><img border="0" src="img/btn_x_bumesaji_sil.gif" width="80" height="18"></a></td>
														<td align="right" width="80">
														<a href="index.php?sayfa=mesaj_mesajoku&id=<?=$sonraki?>" title="Sonraki Mesajı Oku"><img border="0" src="img/sonraki.gif" width="80" height="18">
														</td>
														<td width="10">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td>
												&nbsp;</td>
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