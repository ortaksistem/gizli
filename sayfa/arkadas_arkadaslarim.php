<?

if(seviyeal("arkadas") != 1){
	yonlendir("index.php?sayfa=hata");
	die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Arkadaşlarım <?=$uyeadi?>, <?=_BASLIK?></title>
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
	function mesajgonder(uye){
		
		
		var mesajgonderme = <?=seviyeal("mesaj");?>;
		
		var gonderen = <?=$uyeid?>;
		

		
			if(mesajgonderme == 1){
			
			mahirixpencere("<?=$uyeadi?>'e mesaj gönderin", "<p align=center><img src='img/loading.gif' /></p>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=mesajyaz',
				data : "uye="+uye+"&uyeadi=<?=$uyeadi?>",
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
	
	
	function sil(id){
	
			jQuery.ajax({
				type : 'POST',
				url : 'inc/arkadas.php',
				data : "islem=arkadassil&id="+id,
				success: function(sonuc){		
					if(sonuc == "ok"){
						$("#arkadas"+id).hide("slow");
					}
					else {
						alert("Arkadaş Silinemedi Lütfen Sonra Tekrar Deneyiniz");
					}
				}
			})
			
	}
	
	function onayla(id){
	
			jQuery.ajax({
				type : 'POST',
				url : 'inc/arkadas.php',
				data : "islem=onayla&id="+id,
				success: function(sonuc){		
					if(sonuc == "ok"){
						$("#onaydurum"+id).html("<font color=green><b>Onaylandı</b></font>");
					}
					else {
						alert("Arkadaşlığınız şuanda onaylanamadı. Lütfen Sonra Tekrar Deneyiniz");
					}
				}
			})
			
	}

	function sayfa(hangi){
		window.location = 'index.php?sayfa=arkadas_arkadaslarim&p='+hangi;
	}
</script>
</head>
<body onLoad="menuler('arkadasmerkezi');">
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
										
										<?php
										
											// bakınca verileri sıfırlıcaz
											
											if($toparkadas >= 1){
											
												mysql_query("update "._MX."uye set toparkadas='0' where id='$uyeid'");
												
											}
										
										?>
										</td>
										
										
										<td width="6">&nbsp;</td>
										<td width="540" valign="top">
										
										<!-- icerik baslangic -->
										
										<table border="0" width="100%" id="table201" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_pembe.gif" height="46">
												<table border="0" width="100%" id="table261" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Arkadaşlarım</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table589" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table592" cellspacing="0" cellpadding="0">
												<?php
												
														$p = $_GET["p"];
							
														if(!$p) $p = 1;
																					
														$p = intval($p);
														
														$limit = 25;
														
														$toplam = mysql_query("select count(id) from "._MX."uye_arkadas where uye='$uyeid' or arkadas='$uyeid'");
														
														list($toplam) = mysql_fetch_row($toplam);
														
														$toplamsayfa = ceil(($toplam/$limit));
														
													
													
													
													
													if($toplam < 1){
													
												?>
											<tr>
												<td background="../img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table525" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<? echo stripslashes(ayar("icerikustu")); ?>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<p class="tit_arkadas_mer">
														<b>arkadaş listeniz boştur</b></td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													</table>
														</td>
											</tr>
												<?
													
													}
													else {
													
													
													$result = mysql_query("select id, uye, arkadas, uyead, arkadasad, durum from "._MX."uye_arkadas where uye='$uyeid' or arkadas='$uyeid' order by id desc, durum desc limit ".(($p-1)*$limit).",".$limit."");
											?>

															<tr>
																<td height="30">
																<table border="0" width="100%" id="table593" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="33">&nbsp;</td>
																		<td width="6">&nbsp;</td>
																		<td width="14">&nbsp;</td>
																		<td width="10">&nbsp;</td>
																		<td width="150" height="30">
																		<p class="form_txt">
																		<font color="#ABABAB">
																		<b>
																		KULLANICI 
																		ADI</b></font></td>
																		<td width="10">&nbsp;</td>
																		<td width="30" align="center">
																		<p class="form_txt">
																		<font color="#ABABAB">
																		<b>YAŞ</b></font></td>
																		<td width="10">&nbsp;</td>
																		<td width="135">
																		<p class="form_txt">
																		<font color="#ABABAB">
																		<b>
																		YAŞADIĞI 
																		YER</b></font></td>
																		<td width="10">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		&nbsp;</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
											<?
													while(list($id, $uye, $arkadas, $uyead, $arkadasad, $durum) = mysql_fetch_row($result)){
													
														if($durum == 2){
														
															if($arkadas == $uyeid){
																
																$buton = "<a href='javascript:onayla($id)' class='c' title='Arkadaşlığı Onayla'><font color=red><b>Onayla</b></font></a>";
															
															}
															else {
															
																$buton = "<font color=red size=1><b>Onay Bekleniyor</b></font>";
															
															}
															
														}
														else {
															$buton = "<font color=green size=2><b>Onaylandı</b></font>";
														}
													
													
														if($arkadas == $uyeid){
														
															$arkadas = $uye;
															
															$arkadasad = $uyead;
														
														}
													
														list($dogum, $cinsiyet, $sehir) = mysql_fetch_row(mysql_query("select dogum, cinsiyet, sehir from "._MX."uye where id='$arkadas'"));
														
													
														
														$yas = (date("Y")-date("Y", $dogum));
													
												
												
												?>
															<tr id="arkadas<?=$id?>">
																<td height="30">
																<table border="0" width="100%" id="table594" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="33" bgcolor="#F5F5F5" align="center">
																		<a href="javascript:sil(<?=$id?>)" title="Sil"><img src="img/cross.png" border="0" /></a></td>
																		<td width="6">&nbsp;</td>
																		<td width="14">
																		<img border="0" src="img/cins_ufak_<?=$cinsiyet?>.gif" width="14" height="15"></td>
																		<td width="10">&nbsp;</td>
																		<td width="150" height="30">
																		<p class="nickname">
																		<a class="form_txt2" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$arkadas?>', '745', '700', 'profilpopup<?=$arkadas?>', 2, 1, 1);">
																		<font color=red><?=$arkadasad?></font></a></td>
																		<td width="10">&nbsp;</td>
																		<td width="30" align="center">
																		<p class="yas">
																		<?=$yas?></td>
																		<td width="10">&nbsp;</td>
																		<td width="135">
																		<p class="yer">
																		<?=$sehir?></td>
																		<td width="10">&nbsp;</td>
																		<td>
																		<table border="0" width="100%" id="table603" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="16"><a href="javascript:mesajgonder(<?=$arkadas?>);" title="Mesaj Gönder"><img border="0" src="img/iko_16mesajat.gif" width="16" height="16"></a></td>
																				<td width="4">&nbsp;</td>
																				<td>
																				<table>
																					<tr id="onaydurum<?=$id?>">
																					<td>
																					<?=$buton?>
																					</td>
																					</tr>
																				</table>
																			</tr>
																		</table>
																		</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
														<?php
															
															 } // end mysql_num_rows if
															} // end while
														?>
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
													</table>
												</td>
											</tr>
											<tr>
												<td background="img/alt_kapa_pembe.gif" height="41">
												<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
													<tr>
														<td width="10" height="41">&nbsp;</td>
														<td width="300">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td align="center">
																	<font color=white size=2><b>Diğer Sayfalar : </b></font>
																
																<span id="sayfalar">
																<select name="sayfa" id="sayfa" onChange="sayfa(this.value)" class="selectler">
																<?php
																	
																	for($i = 1; $i <= $toplamsayfa; $i++) {
																		if($p == $i) echo "<option value=$i selected>Sayfa : $i</option>";
																		else echo "<option value=$i>Sayfa : $i</option>";
																	}
																?>
																</select>
																</span>
																</td>
															</tr>
														</table>
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