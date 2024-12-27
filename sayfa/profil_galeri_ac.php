<?

if(seviyeal("album") != 1){
	yonlendir("index.php?sayfa=hata");
	die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

if($_SESSION["galerieklendi"] == "evet"){

	$galeri = $_SESSION["galeriid"];
	
	list($galeri, $durum) = explode(";", $galeri);
	
	header("Location: index.php?sayfa=profil_galeri_duzenle&id=$galeri");
	
	die();
}

$galeribaslik = "Galeri Oluştur";
	
list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."galeri"));
	
$galeri = $maxid + 1;

$_SESSION["galeriid"] = $galeri .";mahirix";

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title><?=$galeribaslik?> <?=$galeri?> <?=$uyeadi?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link type='text/css' href='inc/basic.css' rel='stylesheet' media='screen' />
<link rel="stylesheet" type="text/css" href="inc/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="inc/jquery.js"></script>
<script type='text/javascript' src='inc/jquery.simplemodal.js'></script>
<script type="text/javascript" src="inc/jquery.lightbox-0.5.js"></script>
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
	function resimyukle(){
		var resim = document.getElementById("resim").value;
		
		if(resim){
		
		document.resimformu.submit();
		mahirixalert("Resim Yükleniyor", "<p align=center><img src='img/yukleniyor.gif' /></p><p align=center><font color=green><b>Lütfen Bekleyiniz</b></p>");

		}
		else {

		mahirixalert("Resim Yükleme Hatası", "<p align=center><font color=red><b>Yüklenecek resim seçmediniz</b></p>");
		
		}

	}
	
	function resimyuklesonuc(sonuc){
		if(sonuc == "ok"){
			mahirixpencereguncelle("<p align=center><font color=green><b>Resim Başarıyla Yüklendi</b></p>");
			location.reload(true);
		}
		else if(sonuc == "hata1"){
			mahirixpencereguncelle("<p align=center><font color=red><b>Resim yüklenemedi lütfen sayfayı yenileyiniz.</b></p>");
		}
		else if(sonuc == "hata2"){
			mahirixpencereguncelle("<p align=center><font color=red><b>Yükleme hatası sayfayı yenileyin.</b></p>");
		}
		else {
			mahirixpencereguncelle("<p align=center><font color=red><b>Resim yüklenemedi. Lütfen resmi kontrol edip tekrar deneyiniz.</b></p>");	
		}
	}
	
	function sil(id){

		$("#resimtablo"+id).hide("slow");
		
				jQuery.ajax({
					type : 'POST',
					url : 'inc/galeri.php',
					data : "islem=sil&id="+id,
					success: function(sonuc){		
						
					}
				})
				
	}
</script>
</head>
<body onLoad="menuler('profilmerkezi');">
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
<table border="0" id="table5" cellspacing="0" cellpadding="0">
	<tr>
		<td width="20">&nbsp;</td>
		<td width="540">&nbsp;</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="540" valign="top">
										<table border="0" width="100%" id="table303" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_turuncu.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
															<tr>
																<td>
														<p class="tit_1_beyaz">
														Galeri Oluştur</td>
																<td width="160" align="right">
																&nbsp;</td>
															</tr>
														</table>
														</td>
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
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<b>
																		GALERİ 
																		KURALLARI</b></td>
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
																		- 
																		Galerinizin 
																		Profilinizde 
																		görüntülenebilmesi 
																		için 
																		mutlaka 
																		profilinizde 
																		AnaGörüntü 
																		Resminizin 
																		bulunması 
																		gerekmektedir.<br>
																		<br>
																		- 
																		Galeriler 
																		sadece 
																		Medium 
																		ve Large 
																		üyeler 
																		tarafindan 
																		görüntülenebilirler<br>
																		<br>
																		- 
																		Galerilerinize 
																		ekleyeceğiniz 
																		resimlerin 
																		çeşidine 
																		üye 
																		karar 
																		verir 
																		ancak, 
																		internetten 
																		alınma 
																		resimler,çiçek 
																		böcek 
																		resimleri,porno 
																		sitelerden 
																		alinma 
																		resimler 
																		bu 
																		galerilere 
																		konulamaz 
																		galerideki 
																		resimlerin 
																		çesidi 
																		ne 
																		olursa 
																		olsun 
																		size ait 
																		olmak 
																		zorundadır 
																		başkasına 
																		ait 
																		resim 
																		kullanamazsınız.<br>
																		<br>
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
																		çabalamayınız<br>
																		<br>
																		- 
																		Galerinizdeki 
																		resimler 
																		içerisinde 
																		yasadışı 
																		görüntü 
																		tespit 
																		edilirse 
																		ip 
																		numariniz 
																		ile 
																		birlikte 
																		bilgileriniz 
																		Kolluk 
																		Güçlerine 
																		sitemiz 
																		tarafindn 
																		tölarans 
																		gösterilmeden 
																		sorgusuz 
																		sualsiz 
																		bildirilir 
																		ve 
																		bundan 
																		sonrasini 
																		yasal 
																		yollarla 
																		çözmeniz 
																		için 
																		konu 
																		Yasalara 
																		birakilir.</p>
																		<p class="form_txt">
																		&nbsp;</td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	</table>
																		</td>
																	</tr>
																	<tr>
																		<td>
														&nbsp;</td>
																	</tr>
																	<tr>
																		<td align="right">
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td><img border="0" src="img/bg_alan_resim_uygun_tiksol.gif" width="10" height="30"></td>
																				<td background="img/bg_alan_resim_uygun_tikbg.gif" valign="bottom">
																				<p class="tit_1_beyaz">Yeni Resim Ekle</td>
																				<td><img border="0" src="img/bg_alan_resim_uygun_tiksag.gif" width="10" height="30"></td>
																				<td width="15" height="30">&nbsp;</td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	
																	<?php
																	
																	list($toplam) = mysql_fetch_row(mysql_query("select count(id) from "._MX."galeri where uye='$uyeid'"));
																	
																	$limit = seviyeal("albumlimit");
																	
																	if($toplam > $limit){
																	
																		echo "<tr><td><p align=center><b>Albüm oluşturma limitiniz dolmuştur.</b></p></td></tr>";
																	}
																	
																	
																	else {
																	?>
																	<tr>
																		<td background="img/bg_alan_resim_uygun.gif" height="120" align="center">
<form action="inc/galeri.php" method="post" name="resimformu" target="resimyukle" enctype="multipart/form-data">
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td height="18">
																				<p class="form_txt">Dosya Seç:</td>
																			</tr>
																			<tr>
																				<td align="center">
																				<table border="0" style="border-collapse: collapse" cellpadding="0">
																					<tr>
																						<td><input type="file" name="resim" id="resim" size="20" class="inputlar">
																						<input type="hidden" name="islem" id="islem" value="yukle">
																						
																						</td>
																																					</tr>
																				</table>
																				</td>
																			</tr>
																			<tr>
																				<td height="10"></td>
																			</tr>
																			<tr>
																				<td align="right"><a href="javascript:resimyukle()"><img border="0" src="img/btn_resmiyukle.gif" width="120" height="26"></a></td>
																			</tr>
																		</table>
</form>
																		<iframe name="resimyukle" id="resimyukle" height="0" width="0" style="display:none"></iframe>
																		</td>
																	</tr>
																	
																	<?php
																		
																		}
																	
																	?>
																	<tr>
																		<td bgcolor="#E9E9E9">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
																	</tr>
																	<tr>
																		<td bgcolor="#F9F9F9" height="35">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td width="20">&nbsp;</td>
																<td>
																<p class="tit_zdshop_mer">
																Resimlerim</td>
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
																			
																			<p align="center">
																			<font size="2">Henüz resim eklenmedi, resim yükledikden sonra sayfayı yenileyerek eklenmiş resimleri görebilirsiniz</font></p>
														
															
																		</td>
																	</tr>
																	<tr>
																		<td align="center">
														&nbsp;</td>
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
											</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="540" align="right">
		<table border="0" style="border-collapse: collapse" cellpadding="0">
			<tr>
				<td>
				<a href="javascript:window.close();"><img border="0" src="img/btn_kapat2.gif" width="56" height="22"></a></td>
				<td width="15">&nbsp;</td>
			</tr>
		</table>
		</td>
		<td width="20">&nbsp;</td>
	</tr>
	<tr>
		<td width="20">&nbsp;</td>
		<td width="540">&nbsp;</td>
		<td width="20">&nbsp;</td>
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