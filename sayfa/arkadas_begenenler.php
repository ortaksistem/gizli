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
<title>Profilimi Beğenenler <?=$uyeadi?>, <?=_BASLIK?></title>
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
	
	
	function listele(kimi){
	
		var sayfa = document.getElementById("sayfa").value;
	
		$("#listele").html("<td><p align=center><img src=img/loading.gif /></td>");
	
			jQuery.ajax({
				type : 'POST',
				url : 'inc/onlineuyeler.php',
				data : "listele="+kimi+"&sayfa="+sayfa,
				success: function(sonuc){		
					$("#listele").html("<td><table>"+sonuc+"</table></td>");
					sayfayazdir();
				}
			})
		
	}
	
	function sayfa(){
	
		var sayfa = document.getElementById("sayfa").value;
	
		$("#listele").html("<td><p align=center><img src=img/loading.gif /></td>");
	
			jQuery.ajax({
				type : 'POST',
				url : 'inc/onlineuyeler.php',
				data : "sayfa="+sayfa,
				success: function(sonuc){		
					$("#listele").html("<td><table>"+sonuc+"</table></td>");
				}
			})
		
	}
	
	function sayfayazdir(){

			var sayfa = 1;
			
			jQuery.ajax({
				type : 'POST',
				url : 'inc/onlineuyelersayfa.php',
				data : "sayfa="+sayfa,
				success: function(sonuc){		
					$("#sayfalar").html(sonuc);
				}
			})

	}
	
	function goster(i, hit){
		$("#listele"+i).show();
		$("#listele"+i).html('<td colspan="4" style="padding:10px;font-size:10px;"><img src=img/loading.gif /> <font color=green>Yükleniyor, bekleyin..</font></td>');
		if(hit < 1){
			$("#listele"+i).html('<td colspan="4" style="padding:10px;font-size:10px;"><font color=red>Bu türde beğenen kullanıcı yoktur.</font></td>');
		}
		else {
			jQuery.ajax({
				type : 'POST',
				url : 'inc/begenenlersayfa.php',
				data : "sayfa="+i+"&islem=goster",
				success: function(sonuc){		
					$("#listele"+i).html('<td colspan="4" style="padding:10px;font-size:10px;">'+sonuc+'</td>');
				}
			})
		}
			
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
										
										</td>
										
										
										<td width="6">&nbsp;</td>
										<td width="540" valign="top">
										
										<!-- icerik baslangic -->

										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_pembe.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Profilimi Beğenenler</td>
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" style="border-collapse: collapse" cellpadding="0" width="100%">
															
															<?php
																
																$sayisi = begeniler(NULL, "say");
																
																$toplam = 0;
																
																for($i = 1; $i < $sayisi; $i++){
																
																$begeni = begeniler($i, NULL);
															
															
																$result = mysql_query("select begenenler, hit from "._MX."uye_begeniler where uye='$uyeid' and begeni='$i'");
																
																list($begenenler, $hit) = mysql_fetch_row($result);
																
																if(!$hit) $hit = 0;
															?>
														
															<tr>
																<td>
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td width="20" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td width="180" height="22">
																		
																		<a href="javascript:goster(<?=$i?>, <?=$hit?>)" title="Kimler Beğenmiş Gör"><p class="form_txt"><b><?=$begeni?></b></p></a></p></td>
																		<td width="150">
																		<p class="uye_small">
																		<b><?=$hit?> Üye</b></td>
																		<td width="20">&nbsp;</td>
																	</tr>
																	<tr id="listele<?=$i?>" style="display:none">

																		<?php
																		
																			
																			/*
																			if($hit == 1){
																			
																				list($bid, $bad, $bcins) = explode(";", $begenenler);
																				
																				
																				$bcins = cinsiyet($bcins);
																				
																					?>
																					<a class="form_txt2" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$bid?>', '745', '700', 'profilpopup<?=$bid?>', 2, 1, 1);"><font color=red><?=$bad?> (<?=$bcins?>)</font></a>,&nbsp;
																					<?
																			}
																			
																			else {
																				
																				$begenenler = explode(":::", $begenenler);
																				
																				$adet = count($begenenler);
																				
																				for($e = 1; $e < $adet; $e++){

																					list($bid, $bad, $bcins) = explode(";", $begenenler[$e]);
																					
																					$bcins = cinsiyet($bcins);
																					?>
																					<a class="form_txt2" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$bid?>', '745', '700', 'profilpopup<?=$bid?>', 2, 1, 1);"><font color=red><?=$bad?> (<?=$bcins?>)</font></a>,&nbsp;
																					<?
																				
																				}
																			
																			}*/
																		
																		?>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<?php
															
																	$toplam = $toplam + $hit;
																	
																} // end for
															?>
															
															<tr>
																<td bgcolor="#FFF1F0">
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td width="20">&nbsp;</td>
																		<td width="180" height="22">
																		<p class="form_txt">
																		<font color="#B60800">
																		<b>
																		Toplam</b></font></td>
																		<td width="150">
																		<p class="uye_small">
																		<font color="#B60800">
																		<b><?=$toplam?> Üye</b></font></td>
																		<td width="20">&nbsp;</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td bgcolor="#F0F0F0">
																<img border="0" src="img/1px.gif" width="1" height="1"></td>
															</tr>
															<tr>
																<td height="12">
																</td>
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
												<td background="img/alt_kapa_pembe.gif" height="41">
												&nbsp;</td>
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