<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

mysql_query("update "._MX."uye set topgaleritalep='0', topgalerionay='0' where id='$uyeid'");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Galerilerim <?=$uyeadi?>, <?=_BASLIK?></title>
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

	function galerisil(id){
	
		var onay = confirm("Galeriyi silmek istediğinizden emin misiniz?");
		
		if(onay){
		
			$("#galeri"+id).hide("slow");
			jQuery.ajax({
				type : 'POST',
				url : 'inc/galeri.php',
				data : "islem=galerisil&id="+id,
				success: function(sonuc){		
					if(sonuc == "ok"){
						$("#galeri"+id).hide();
					}
					else {
						alert("Galeri silinemedi, lütfen sonra tekrar deneyiniz");
					}
				}
			})
			
		}
			
	}
	function yukle(kimi, sayfa){
				
		$(".galerilerim").hide();
					
		$(".tiksol").css("background-image", "url(img/gal_mnu_tik_kapali_sol.gif)");
		
		$("#tiksol"+kimi).css("background-image", "url(img/gal_mnu_tik_acik_sol.gif)");

		$(".tikorta").css("background-image", "url(img/gal_mnu_tik_kapali_bg.gif)");
		
		$("#tikorta"+kimi).css("background-image", "url(img/gal_mnu_tik_acik_bg.gif)");
		
		$(".tikalt").css("background-image", "url(img/gal_mnu_tik_kapali_sag.gif)");
		
		$("#tikalt"+kimi).css("background-image", "url(img/gal_mnu_tik_acik_sag.gif)");		
		
		$("#icerik-yukle").html("<td><img src=img/loading.gif /> <font color=black size=2><b>Yükleniyor ...</b></font></td>");

			jQuery.ajax({
				type : 'POST',
				url : 'inc/galeri-durumlar.php',
				data : "islem="+kimi+"&sayfa="+sayfa,
				success: function(sonuc){		
						$("#icerik-yukle").html("<td>"+sonuc+"</td>");
				}
			})
				
	}
	
	function isteksil(id){
	
		var onay = confirm("Silmek istediğinizden emin misiniz?");
		
		if(onay){
			jQuery.ajax({
				type : 'POST',
				url : 'inc/galeri-istekler.php',
				data : "islem=sil&id="+id,
				success: function(sonuc){
					$("#istek"+id).hide("slow");
				}
			})
		}	
	}
	
	function istekonayla(id){
	
		var onay = confirm("Onaylamak istediğinizden emin misiniz?");
		
		if(onay){
			jQuery.ajax({
				type : 'POST',
				url : 'inc/galeri-istekler.php',
				data : "islem=onayla&id="+id,
				success: function(sonuc){
					$("#istek"+id).hide("slow");
				}
			})
		}	
	}
	
	function istekreddet(id){
	
		var onay = confirm("Reddetmek istediğinizden emin misiniz?");
		
		if(onay){
			jQuery.ajax({
				type : 'POST',
				url : 'inc/galeri-istekler.php',
				data : "islem=reddet&id="+id,
				success: function(sonuc){
					$("#istek"+id).hide("slow");
				}
			})
		}	
	}
	
	function istektemizle(id){
	
		var onay = confirm("Silmek istediğinizden emin misiniz?");
		
		if(onay){
			jQuery.ajax({
				type : 'POST',
				url : 'inc/galeri-istekler.php',
				data : "islem=temizle&id="+id,
				success: function(sonuc){
					$("#istek"+id).hide("slow");
				}
			})
		}	
	}
<?php
	$yer = $_GET["yer"];
	
	if($yer == "istek"){
	
	echo "yukle('istekler', 1);";
	
	}

?>
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
										
										<!-- icerik baslangic -->

										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_turuncu.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Galerilerim</td>
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
														<td width="510">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<table id="usttab" border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="12" height="39"><img border="0" src="img/gal_mnu_sol.gif" width="12" height="39"></td>
																				<td background="img/gal_mnu_bg.gif" align="center" valign="bottom">
																				<table border="0" style="border-collapse: collapse" cellpadding="0">
																					<tr>
																						<td height="29">
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td class="tiksol" id="tiksolgaleri" background="img/gal_mnu_tik_acik_sol.gif" width="20" height="29">&nbsp;</td>
																								<td class="tikorta" id="tikortagaleri" background="img/gal_mnu_tik_acik_bg.gif" height="29">
																								<p class="cc"><b><a class="c" href="javascript:yukle('galeri', 1)">Galerilerim</a></b></td>
																								<td class="tikalt" id="tikaltgaleri" background="img/gal_mnu_tik_acik_sag.gif" width="10" height="29">&nbsp;</td>
																							</tr>
																						</table>
																						</td>
																						<td width="15" height="29">&nbsp;</td>
																						<td height="29">
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td class="tiksol" id="tiksolistekler" background="img/gal_mnu_tik_kapali_sol.gif" width="20" height="29">&nbsp;</td>
																								<td class="tikorta" id="tikortaistekler" background="img/gal_mnu_tik_kapali_bg.gif" height="29">
																								<p class="cc"><b><a class="c" href="javascript:yukle('istekler', 1)">İstekler</a></b></td>
																								<td class="tikalt" id="tikaltistekler" background="img/gal_mnu_tik_kapali_sag.gif" width="10" height="29">&nbsp;</td>
																							</tr>
																						</table>
																						</td>
																						<td width="15" height="29">&nbsp;</td>
																						<td height="29">
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td class="tiksol" id="tiksolizinliler" background="img/gal_mnu_tik_kapali_sol.gif" width="20" height="29">&nbsp;</td>
																								<td class="tikorta" id="tikortaizinliler" background="img/gal_mnu_tik_kapali_bg.gif" height="29">
																								<p class="cc"><b><a class="c" href="javascript:yukle('izinliler', 1)">İzinliler</a></b></td>
																								<td class="tikalt" id="tikaltizinliler" background="img/gal_mnu_tik_kapali_sag.gif" width="10" height="29">&nbsp;</td>
																							</tr>
																						</table>
																						</td>
																						<td width="15" height="29">&nbsp;</td>
																						<td height="29">
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td class="tiksol" id="tiksolredler" background="img/gal_mnu_tik_kapali_sol.gif" width="20" height="29">&nbsp;</td>
																								<td class="tikorta" id="tikortaredler" background="img/gal_mnu_tik_kapali_bg.gif" height="29">
																								<p class="cc"><b><a class="c" href="javascript:yukle('redler', 1)">Redler</a></b></td>
																								<td class="tikalt" id="tikaltredler" background="img/gal_mnu_tik_kapali_sag.gif" width="10" height="29">&nbsp;</td>
																							</tr>
																						</table>
																						</td>
																						<td width="15" height="29">&nbsp;</td>
																						<td height="29">
																						<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																							<tr>
																								<td class="tiksol" id="tiksollistem" background="img/gal_mnu_tik_kapali_sol.gif" width="20" height="29">&nbsp;</td>
																								<td class="tikorta" id="tikortalistem" background="img/gal_mnu_tik_kapali_bg.gif" height="29">
																								<p class="cc"><b><a class="c" href="javascript:yukle('listem', 1)">Listem</a></b></td>
																								<td class="tikalt" id="tikaltlistem" background="img/gal_mnu_tik_kapali_sag.gif" width="10" height="29">&nbsp;</td>
																							</tr>
																						</table>
																						</td>
																					</tr>
																				</table>
																				</td>
																				<td width="12"><img border="0" src="img/gal_mnu_sag.gif" width="12" height="39"></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																<tr id="icerik-yukle">
																		<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<b>
																		SAYIN 
																		ÜYEMİZ;</b></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" height="10"></td>
																		<td height="10"></td>
																		<td width="15" height="10"></td>
																	</tr>
																	<tr>
																		<td width="15">&nbsp;</td>
																		<td>
																		
																		<p class="form_txt">
- Galerinizin Profilinizde görüntülenebilmesi için mutlaka profilinizde AnaGörüntü Resminizin  bulunması gerekmektedir.<br />
<br />
- Galeriler sadece Medium ve Large üyeler tarafindan görüntülenebilirler<br />
<br />
- Galerilerinize ekleyeceğiniz resimlerin çeşidine üye karar verir ancak, internetten alınma resimler,çiçek böcek resimleri,porno sitelerden alinma resimler bu galerilere konulamaz galerideki resimlerin çesidi ne olursa olsun size ait olmak zorundadır başkasına ait resim kullanamazsınız.<br />
<br />
																		- Galeri 
																		açabilmeniz 
																		için en 
																		az 3 
																		adet 
																		resim 
																		yüklemeniz 
																		gerekmektedir 
																		harici 
																		durumlarda 
																		açmış 
																		olduğunuz 
																		ve 
																		açacak 
																		olduğunuz 
																		bütün 
																		galeriler 
																		silinecektir 
																		lütfen 
																		bu tür 
																		durumlar 
																		için 
																		mail 
																		yada 
																		iletşime 
																		geçmek 
																		için 
																		çabalamayınız<br />
<br />
- Galerinizdeki resimler içerisinde yasadışı görüntü tespit edilirse ip numariniz ile birlikte bilgileriniz Kolluk Güçlerine sitemiz tarafindn tölarans gösterilmeden sorgusuz sualsiz bildirilir ve bundan sonrasini yasal yollarla çözmeniz için konu Yasalara birakilir.</td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	</table>
																		</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																	<tr class="galerilerim">
																		<td>
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="10">
																		<img border="0" src="img/ic_menu_ac.gif" width="10" height="39"></td>
																		<td background="img/ic_menu_bg.gif" width="5">&nbsp;</td>
																		<td background="img/ic_menu_bg.gif">
																		<p class="tit_1_beyaz">
																		Galerilerim</td>
																		<td width="127">
																		<a href="index.php?sayfa=profil_galeri_ac"><img border="0" src="img/btn_galeri_ac.gif" width="127" height="39"></a></td>
																	</tr>
																</table>
																		</td>
																	</tr>
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																	<tr class="galerilerim">
																		<td align="center">
														<table border="0" id="table452" cellspacing="0" cellpadding="0" align="center">
															<tr>
																<?php
																
																	$result = mysql_query("select id, resim, hit, kayit, durum from "._MX."galeri where uye='$uyeid' order by id desc");
																	
																	$i = 1;
																	
																	while(list($id, $resim, $hit, $kayit, $durum) = mysql_fetch_row($result)){
																	
																	$kayit = date("d.m.Y H:i", $kayit);
																	
																	if($durum == 1) $durum = "<font color=green>Onaylı</font>";
																	else $durum = "<font color=red>Onay Bekliyor</font>";
																	
																	list($topresim) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri_resim where galeri='$id'"));
																	
																?>
																<td align="center" valign="top">
																<table align="center" id="galeri<?=$id?>" border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td align="center">
																		<img border="0" src="img/urn_penc_ust.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td align="center" style="background:url(img/urn_penc_bg.gif);background-position:center;background-repeat:repeat-y;">
																		<a href="javascript:void(0)" onclick="pencere('index.php?sayfa=galeri&id=<?=$id?>', '600', '700', 'galeripopup<?=$id?>', 2, 1, 1);" title="Galeriye Bak"><img border="0" src="<?=$resim?>" width="80" height="100"></a></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<img border="0" src="img/urn_penc_alt.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td height="6">
																		</td>
																	</tr>
																	<tr>
																		<td align="center">
																		<p class="merkez_profil">
																		Galeri 
																		ID: 
																		<?=$id?></td>
																	</tr>
																	<tr>
																		<td align="center" height="18">
																		<p class="not">
																		- <?=$durum?>
																		-</td>
																	</tr>
																	<tr>
																		<td align="center" height="18">
																		<p class="form_txt">
																		toplam 
																		<?=$topresim?> ad. 
																		resim</td>
																	</tr>
																	<tr>
																		<td align="center" height="18">
																		<p class="form_txt">
																		<font color="#2069A0">
																		<?=$hit?> kez 
																		izlenmiş</font></td>
																	</tr>
																	<tr>
																		<td align="center" height="18">
																		<p class="form_txt">
																		<?=$kayit?> tarihinde eklenmiş</td>
																	</tr>
																	<tr>
																		<td align="center" height="5"></td>
																	</tr>
																	<tr>
																		<td align="center">
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td><a href="javascript:galerisil(<?=$id?>)"><img border="0" src="img/btn_sil.gif" width="35" height="28"></a></td>
																				<td width="2"></td>
																				<td><a href="index.php?sayfa=profil_galeri_duzenle&id=<?=$id?>"><img border="0" src="img/btn_duzenle.gif" width="64" height="28"></a></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																</table>
																</td>
																
																<?php
																	
																	if($i%4 == 0) echo "</tr><tr>";
																	$i++;
																	
																	} // end while
																
																?>
															</tr>
															</table>
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
												<td background="img/alt_kapa_turuncu.gif" height="41">
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