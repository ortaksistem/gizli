<?

if(seviyeal("profilresmi") != 1){
	yonlendir("index.php?sayfa=hata");
	die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$yuklemeadet = seviyeal("profilresmilimit");

$result = mysql_query("select count(id) from "._MX."uye_resim where uye='$uyeid'");
																	
list($adet) = mysql_fetch_row($result);

$islem = $_GET["islem"];


if($islem == "anaresim"){
	
	
	$id = $_GET["id"];
	
	mysql_query("update "._MX."uye_resim set ana='0' where uye='$uyeid'");
	
	list($resimurl, $durum) = mysql_fetch_row(mysql_query("select resim, durum from "._MX."uye_resim where id='$id' and uye='$uyeid'"));
	
	if($durum == 1){
		
		$uzanti = explode(".", $resimurl);
		
		$uzanti = $uzanti[1];
		

		$resimurl = str_replace("resim/", "resimthumb/", $resimurl);
		
		@copy($resimurl, "img_uye/avatar/$uyeid.$uzanti");
		
		mysql_query("update "._MX."uye set img='img_uye/avatar/$uyeid.$uzanti' where id='$uyeid'");
		
		mysql_query("update "._MX."uye_resim set ana='1' where id='$id'");
		
	}
	

}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Resimleriniz <?=$uyeadi?></title>
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
    $(function() {
        $('.resimlink').lightBox();
    });
    
	function menuler(menu){ 
		
		$("#mesajmerkezitablo").hide();
		$("#arkadasmerkezitablo").hide();
		$("#aramamerkezitablo").hide();
		$("#profilmerkezitablo").hide();
		
		$("#"+menu+"tablo").show("slow");
	}
	
	function resimyukle(){
		var resim = document.getElementById("resim").value;
		
		var yukleme = <?=seviyeal("profilresmi");?>;
		
		var adet = <?=$adet?>;
		
		var limit = <?=$yuklemeadet?>;
		if(yukleme == 1){
		
			if(adet > limit){
				mahirixalert("Resim Yükleme Hatasý", "<p align=center><font color=red><b>Resim yükleme limitiniz dolmuþtur. Yükleme Limiti : <?=$yuklemeadet;?> resimdir.</b></p>");
			}
			else {
			
				if(resim == ''){
					mahirixalert("Resim Yükleme Hatasý", "<p align=center><font color=red><b>Bir resim dosyasý seçin (jpg, jpeg, gif, png, bmp)</b></p>");
				}
				else {
					document.resimformu.submit();
					mahirixalert("Resim Yükleniyor", "<p align=center><img src='img/yukleniyor.gif' /></p><p align=center><font color=green><b>Lütfen Bekleyiniz</b></p>");
				}
			
			}
		
		}
		else {
				mahirixalert("Resim Yükleme Hatasý", "<p align=center><font color=red><b>Resim yükleyebilmek için üyelik yükseltiniz.</b></p>");
		}
		
	}
	
	function resimyuklesonuc(sonuc){
		if(sonuc == "ok"){
			mahirixpencereguncelle("<p align=center><font color=green><b>Resim Baþarýyla Yüklendi</b></p>");
			resimguncelle();
		}
		else if(sonuc == "limit"){
			mahirixpencereguncelle("<p align=center><font color=red><b>Resim yükleme limitiniz dolmuþtur. Yükleme Limiti : <?=$yuklemeadet;?> resimdir.</b></p>");
		}
		else if(sonuc == "genislik"){
			mahirixpencereguncelle("<p align=center><font color=red><b>Resmin geniþliði max. 400 px olmalýdýr</b></p>");
		}
		else if(sonuc == "yukseklik"){
			mahirixpencereguncelle("<p align=center><font color=red><b>Resmin yüksekliði max. 350 px olmalýdýr</b></p>");
		}
		else {
			mahirixpencereguncelle("<p align=center><font color=red><b>Resim yüklenemedi. Lütfen resmi kontrol edip tekrar deneyiniz.</b></p>");	
		}
	}
	
	function resimguncelle(){

				jQuery.ajax({
					type : 'POST',
					url : 'inc/resim.php',
					data : "islem=resimguncelle",
					success: function(sonuc){		
						$("#gallery").html(sonuc);
					}
				})
					
	}
	
	function sil(id){

		$("#resimtablo"+id).hide("slow");
		
				jQuery.ajax({
					type : 'POST',
					url : 'inc/resim.php',
					data : "islem=sil&id="+id,
					success: function(sonuc){		
						if(sonuc == "otoyap2"){
							alert("Hiç onaylý resminiz bulunmadýðýndan profil resminiz silinmiþtir");
						}
					}
				})
				
	}
	
	function anaresim(url, onay){
	
		if(onay == 1){
			window.location = url;
		}
		else {
			mahirixalert("Hata", "<p align=center><font color=red><b>Ana resim sadece onaylý resimlerden seçilebilir.</b></p>");
		}
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
														Resimlerim</td>
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
																				<td width="35"><img border="0" src="img/resimler_not_ac.gif" width="35" height="39"></td>
																				<td background="img/resimler_not_bg.gif">
																		<p class="lnk01">
																		<b>
																		<a class="form_txt2" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil_resimdikkat', '550', '700', 'profilpopup<?=$uyeid?>', 2, 1, 1);">RESÝM 
																		EKLERKEN
																		DÝKKAT 
																		EDÝLMESÝ 
																		GEREKENLER</a></b></td>
																				<td width="10"><img border="0" src="img/resimler_not_kapa.gif" width="10" height="39"></td>
																			</tr>
																		</table>
																		</td>
																		<td width="127">
																		<a href="#"><img border="0" src="img/btn_galeri_ac2.gif" width="120" height="39"></a></td>
																	</tr>
																</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="15"></td>
														<td width="510" height="15">
																</td>
														<td height="15"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="12">&nbsp;</td>
																				<td>
																		<p class="form_txt">
																		Lütfen 
																		size ait 
																		olmayan, 
																		sadece 
																		göz ve 
																		benzeri 
																		olup 
																		resimli 
																		üyeler 
																		listesinde 
																		çýkmak 
																		için 
																		eklenmek 
																		istenen 
																		porno 
																		sitelerinden 
																		alýnma, 
																		çiçek, 
																		böcek, 
																		araba, 
																		manzara, 
																		birbirine 
																		benzer 
																		resimler 
																		kýsaca 
																		sizin 
																		kendi 
																		fotoðrafýnýz 
																		olmayan 
																		resimleri 
																		eklemeyiniz. 
																		Bu 
																		resimler 
																		onaylanmadan 
																		Editörlerimiz 
																		tarafýndan 
																		silinmektedir. 
																		Ayrýca 
																		bu tip 
																		resimleri 
																		eklemek 
																		size 
																		zaman 
																		kaybýndan 
																		baþka 
																		bir þey 
																		kazandýrmayacaktýr. 
																		Bu tip 
																		resimler 
																		üyeliðinizin 
																		silinmesine 
																		de neden 
																		olmaktadýr. 
																		Bu 
																		yazýya 
																		raðmen 
																		hala bu 
																		tip 
																		resimler 
																		eklemeniz 
																		bizi 
																		ciddiye 
																		almadýðýnýzý 
																		göstermektedir 
																		ve buda 
																		üyeliðinizin 
																		silinmesine 
																		neden 
																		olabilmektedir.<br><br>Sadece
																		çiftler 
																		ve 
																		bayanlar 
																		partnerleri 
																		ile 
																		birlikte 
																		olarak 
																		resim 
																		gönderebilirler. 
																		Erkek 
																		üyelerimiz 
																		partnerleri 
																		ile olan 
																		resimleri 
																		gönderemez, 
																		gönderilse 
																		dahi 
																		onay 
																		almadan 
																		silinecektir.<br><br>Teþekkür Ederiz.<br>YP Yönetimi</td>
																				<td width="12">&nbsp;</td>
																			</tr>
																		</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="right">
														<img border="0" src="img/cekimgucu_1a.jpg" width="105" height="22"></td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
															<tr>
																<td width="295" valign="top">
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td background="img/resimekle_ust.gif" height="50" valign="top">
																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="27" height="10"></td>
																				<td height="10"></td>
																			</tr>
																			<tr>
																				<td width="27">&nbsp;</td>
																				<td>
																				<p class="tit_profil_mer">Resim Ekle</td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td background="img/resimekle_byz.gif">
																		<form action="inc/resim.php" method="post" name="resimformu" target="resimyukle" enctype="multipart/form-data">

																		<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																			<tr>
																				<td width="27">&nbsp;</td>
																				<td width="94">
																				<?
																					$avatar = uyebilgi("img");
																					$cinsiyet = uyebilgi("cinsiyet");
																					
																					$avatar = uyeavatar($avatar, $cinsiyet);
																					
																				?>
																				<img border="0" src="<?=$avatar?>" /></td>
																				<td width="10">&nbsp;</td>
																				<td>
																				<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																					<tr>
																						<td height="30">
																										<p class="not">* max resim ölçüsü : 400x350</td>
																					</tr>
																					<tr>
																						<td height="30">
																										<p class="not">* max resim boyutu : 1 MB</td>
																					</tr>
																					<tr>
																						<td height="30">
																										<p class="not"><font color="#C32828"><a class="not" ><font color="#C32828">uygun resimler için týklayýn</font></u></a></font></td>
																					</tr>
																				</table>
																				</td>
																				<td width="27">&nbsp;</td>
																			</tr>
																		</table>
																	
																		</td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/resimekle_byz_kapa.gif" width="295" height="13"></td>
																	</tr>
																	<tr>
																		<td background="img/resimekle_bg.gif" height="92" align="center">
																		<table border="0" style="border-collapse: collapse" cellpadding="0">
																			<tr>
																				<td height="18">
																				<p class="form_txt">Dosya Seç:</td>
																			</tr>
																			<tr>
																				<td align="center">
																				<table border="0" style="border-collapse: collapse" cellpadding="0">
																					<tr>
																						<td>
																						<input type="file" name="resim" id="resim" size="20" class="inputlar">
																						<input type="hidden" name="islem" id="islem" value="yukle">
																						<input type="hidden" name="gks" id="gks" value="<?=$_GET["tur"];?>">
																						</td>
																						<td width="10">&nbsp;</td>
																						<td></td>
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
																	<tr>
																		<td>
																		<img border="0" src="img/resimekle_kapa.gif" width="295" height="10"></td>
																	</tr>
																</table>
																</td>
																<td>&nbsp;</td>
																<td width="204" valign="top">
																<img border="0" src="img/cekimgucu_1.jpg" width="204" height="261"></td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="right">
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/bg_alan_resim_uygunsuz_sol.gif" width="10" height="30"></td>
																		<td background="img/bg_alan_resim_uygunsuz_bg.gif" valign="bottom">
																		<p class="tit_1_beyaz">
																		Resimleriniz</td>
																		<td>
																		<img border="0" src="img/bg_alan_resim_uygunsuz_sag.gif" width="10" height="30"></td>
																		<td width="15" height="30">&nbsp;</td>
																	</tr>
																</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr id="resimyenile">
														<td>&nbsp;</td>
														<td width="510" background="img/bg_alan_resim_uygunsuz.gif" height="120" align="center" valign="bottom">
														<div id="gallery">
																<table border="0" style="border-collapse: collapse" cellpadding="0">
																	<tr>
																		<td width="20" height="28">&nbsp;</td>
																		<td height="28">
																		&nbsp;</td>
																		<td width="20" height="28">&nbsp;</td>
																		<td height="28">
																		&nbsp;</td>
																		<td width="20" height="28">&nbsp;</td>
																		<td height="28">
																		&nbsp;</td>
																	</tr>
																	<tr>
																	
																	<?
																	
																	
																	
																	$result = mysql_query("select id, resim, ana, durum from "._MX."uye_resim where uye='$uyeid'");
																	
																	$i = 1;
																	
																	while(list($id, $resim, $ana, $durum) = mysql_fetch_row($result)){
																	
																	
																	if($ana == 1){
																		$buton = '<img border="0" src="img/anaresim_tik.gif" width="80" height="15">';
																	}
																	else {
																		$buton = '<a href="javascript:void(0)" onclick="anaresim(\'index.php?sayfa=profil_resim&islem=anaresim&id='.$id.'\', '.$durum.')"><img border="0" src="img/btn_anarsimyap.gif" width="93" height="22"></a>';
																	}
																	
																	if($durum == 1){
																		$durum = NULL;
																	}
																	else {
																		$durum = "<font color=red size=2><b>Onay Bekliyor</b></font>";
																	}
																	?>
																	
																	
																		<td valign="top">
																		
																<table id="resimtablo<?=$id?>" border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td>
																		<img border="0" src="img/urn_penc_ust.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td background="img/urn_penc_bg.gif" align="center">
																		<a href="javascript:void(0)" onclick="<?=$resim?>" class="resimlink"><img border="0" src="<?=$resim?>" width="80" height="100"></a></td>
																	</tr>
																	<tr>
																		<td>
																		<img border="0" src="img/urn_penc_alt.gif" width="100" height="13"></td>
																	</tr>
																	<tr>
																		<td height="3" align="center">
																		<?=$durum?>
																		</td>
																	</tr>
																	<tr>
																		<td align="center" height="22">
																		<?=$buton?></td>
																	</tr>
																	<tr>
																		<td align="center" height="22">
																		<a href="javascript:sil(<?=$id?>)" title="Sil"><img border="0" src="img/btn_silresmi.gif" width="93" height="22"></a></td>
																	</tr>
																	</table>
	
																	
																		</td>
																		<td width="20">&nbsp;</td>
																		
																	
																	<?
																	
																	if($i % 4 == 0) echo '</tr>
																		<tr>
																			<td height="7">
																			</td>
																		</tr>
																	<tr>';
																	$i++;
																	
																	} // while
																	?>
																	
																	</tr>
																</table>
															</div>
														</td>
														<td>&nbsp;</td>
													</tr>
													</table>
														</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif" height="10">
												&nbsp;</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif" height="10" align="center">
												<p class="c2">Toplam <b><?=$adet?></b> resminiz bulunuyor ve toplam <b><?=$yuklemeadet?></b> resim yükleyebilirsiniz. 
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
										<td><b><a class="c" href="index.php?sayfa=uyelik_yukselt">üyeliðini 
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
										<td><b><a class="c" href="index.php?sayfa=yardimmerkezi">yardým merkezi</a></b></td>
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
								<p class="c2"><a class="c1" href="index.php?sayfa=kullanim_sartlari">Kullaným 
								Þartlarý</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=gizlilik_ilkeleri">Gizlilik Ýlkeleri</a>&nbsp; |&nbsp;
								<a class="c1" href="index.php?sayfa=yardimmaili">Bize Ulaþýn</a></td>
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