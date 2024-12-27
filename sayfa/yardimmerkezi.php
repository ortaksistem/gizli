<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Yardım Merkezi <?=$uyeadi?>, <?=_BASLIK?></title>
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
												<td background="img/ust_ac_turuncu.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Yardım Merkezi</td>
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
																<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<b>SIKÇA 
																		SORULAN 
																		SORULAR</b></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" height="4"></td>
																		<td height="4"></td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#yukseltme">
																		Üyeliğimi 
																		nasıl 
																		yükseltebilirim ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nasilolurum">
																		Ücretsiz Medium ve ya Large üyelik nasıl alabilirim ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#sohbetodalari">
																		Sohbet odalarından yararlanmak için nelere ihtiyacım var?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nedenkullanamiyor">Small üyeler neden sistemi kullanamıyorlar 
																		?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nedenkisitlaniyor">
																		Small üyeler neden bu kadar kısıtlanıyor?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#puansistemi">
																		Puan sistemi nasıl çalışıyor ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nedenonaylanmadi">
																		Profilimde resimlerim neden onaylanmadı ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nedenyukleyemiyoruz">
																		Neden Profilimize istediğimiz resimleri yükleyemiyoruz ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#nedenokumuyor">
																		Mesaj yolladığım kişiler neden mesajlarımı okumuyor ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	<tr>
																		<td width="15" align="center">
																		<img border="0" src="img/zdok.gif" width="6" height="5"></td>
																		<td>
																		<p class="form_txt">
																		<a class="form_txt" href="#medium">
																		Medium ve Large Üyeler Mesajlaşmalarda Nelere Dikkat Etmeliler ?</a></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																	<tr>
																		<td width="15" align="center" height="4"></td>
																		<td height="4">
																		</td>
																		<td width="15" height="4"></td>
																	</tr>
																	</table>


														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="14"></td>
														<td width="510" align="center" height="14">
														</td>
														<td height="14"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table307" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table308" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="yukseltme">Üyeliğimi 
																		Nasıl 
																		Yükseltebilirim?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																																				Üyeliği yükseltmenin en 
                  hızlı yolu kredi kartı veya havale ile üyelik satın 
                  almaktır.Bu şekilde üyelik satın almak için Profiliniz ve 
                  menüde bulunan Üyeliğimi Yükselt linklerine tıklayarak satın 
                  almak istediğiniz üyelik tipini belirleyerek ileriki adımlara 
                  geçebilirsiniz.Ödeme bilgilerini doldurup gerekli ödemeyi 
                  Kredi Kartı veya Havale ile yaptığınızda üyeliğiniz ödemesi 
                  yapılmış olan üyelik tipi şeklinde açılacak ve satın almış 
                  olduğunuz üyelik tipinin haklarını kullanmaya 
                  başlayabileceksiniz.
																		</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table722" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table723" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nasilolurum">Ücretsiz Medium veya Large üyelik nasıl alabilirim?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																																				Bunu yapmanın 2 yolu 
                  bulunmaktadır.Birincisi Puan sistemidir bu sistem ile size 
                  verilen puanları toplayarak.Belli bir puana ulaştıktan sonra 
                  puanınızla üyelik alabilirsiniz.Puanların nasıl kazanılacağı 
                  Puan Nasıl Toplarım linkinde mevcuttur. <BR>Diğer yol ise bu 
                  sadece bayan ve de Çift üyeler için geçerlidir.GKS'li üye 
                  olarak ücretsiz yararlanabilirsiniz</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table724" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table725" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="sohbetodalari">Sohbet odalarından yararlanmak için nelere ihtiyacım var?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																																				Öncelikle Medium 
                  veya Large üyeliğe ihtiyacınız var.Bu iki tip üyelikten birine 
                  sahipseniz sohbete girmek için bilgisayarınızda Java yüklü 
                  olması yeterlidir...</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table726" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table727" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nedenkullanamiyor">Small üyeler neden sistemi kullanamıyorlar.</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		Small üyelik sistemi 
                  siteyi incelemeniz ve de beğendiğiniz takdirde Medium yada 
                  Large üyeliklerden alıp almamaya karar vermenizi sağlamak için 
                  vardır .Small üyelik sistemi kullanmak için değil sistemi ve 
                  işleyişini tanımak için açılan üyelik tipidir.</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table728" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table729" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nedenkisitlaniyor">Small üyeler neden bu kadar kısıtlanıyor?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		Small üyelik her sistemde 
                  siteyi tanıtmak amacı ile oluşturulmuş bir üyelik biçimidir ve 
                  ücretsizdir ve de sitenin bir çok özelliğinden hiç bir yerde 
                  yararlanamaz sistemi beğenirse üyeliğini yükseltir ve 
                  yararlanmak istediklerinden yararlanabilir. Small üye nin 
                  mesaj hakkı bulunmamaktadır...
																		</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table730" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table731" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="puansistemi">Puan sistemi nasıl çalışıyor?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		Puan 
																		sistemi 
																		sitede 
																		yapacağınız 
																		her 
																		türlü 
																		aktivite 
																		sonucunda 
																		sistemin 
																		size 
																		vereceği 
																		puanlar 
																		sayesinde 
																		çalışır. 
																		Bu 
																		puanları 
																		daha 
																		sonra 
																		kullanarak 
																		SHOP 
																		merkezimden 
																		dilediğiniz 
																		şekilde 
																		harcayabilirsiniz...</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table732" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table733" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nedenonaylanmadi">Profilimde resimlerim neden onaylanmadı?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																																				Bunun bir 
																		kaç sebebi 
                  olabilir.Öncelikle onay verilecekleri henüz Editörlerimiz 
                  incelememiş olabilir ancak en sık görülen neden sizin 
                  resimlerinizden Ana resim seçmemiş olmanızdır. Ana resim 
                  seçerseniz resimlerinizde görülür
																		</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table734" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table735" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nedenyukleyemiyoruz">Neden 
																		profilimize 
																		istediğimiz 
																		resimleri 
																		yükleyemiyoruz 
																		?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																																				Burası profil ve 
                  resim bilgilerini çok ciddiye alan bir sitedir ve kesin 
                  değişmez kurallarımızdan biride size ait olmayan resimlerin 
                  eklenmesine kesinlikle izin verip alakasız resimler ile resimli 
                  profil aramalarında çıkarak sadece resimli profil arayan 
                  üyelerimizin vaktini boşa harcamanızı engellemektir.Çit 
                  olmayan üyelerde yine başkaları ile olan resimlerini ekleyemez 
                  bu tip profillerde de üyelik tipi ne olursa olsun tarafımızdan 
                  silinir.
																		</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table736" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table737" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="nedenokumuyor">Mesaj yolladığım kişiler neden mesajlarımı okumuyor ?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		Bu sorunun muhatabı 
                  mesajı attığınız kişidir bunu bizlere sormanız yanlıştır.Mesaj 
                  attığınız kişi sisteme girmiyor olabilir, mesajınızla 
                  ilgilenmiyor olabilir bunun bir garantisi yoktur...
																		</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" width="100%" id="table738" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/pncre_alt_msg_oku_ust.gif" width="510" height="7"></td>
															</tr>
															<tr>
																<td background="img/pncre_alt_msg_oku_bg.gif">
																<table border="0" width="100%" id="table739" cellspacing="0" cellpadding="0">
																	<tr>
																		<td height="18" width="12"></td>
																		<td height="27">
																		<p class="tit_zdshop_mer">
																		<a name="medium">Medium ve Large Üyeler Mesajlaşmalarda Nelere Dikkat Etmeliler ?</a></td>
																		<td height="18" width="12"></td>
																	</tr>
																	<tr>
																		<td height="4" width="12"></td>
																		<td height="4"></td>
																		<td height="4" width="12"></td>
																	</tr>
																	<tr>
																		<td width="12">&nbsp;</td>
																		<td>
																		<p class="form_txt">
																		Üyelik satın alarak 
                  ciddiyetinizi , kararlılığınızı, istekliliğinizi kanıtlamış 
                  kişiler olarak Medium ve Large üyeler standart üyelere 
                  mesajlarında mail adresi vererek ayrıca kendilerini riske atmaktadırlar. Unutmayın siz kendinizi kanıtlamışken küçük bir 
                  bedeli ödemeden size ulaşmak isteyen kişiler bizler ne kadar 
                  çaba göster sekte profillerinde yazdıkları kişiler olmayabilir. Bu tip durumlarda karşılaşabileceğiniz sorunlardan sitemiz 
                  kesinlikle sorumlu tutulamaz.Mail adresi çalınmasına kadarda 
                  her türlü sorunu yaşayabilirsiniz.Unutmayın birileri ile 
                  tanışmanın en güzel yolu sizin ödediğiniz bedeli ödemiş 
                  ciddiyetlerini kanıtlamış kişilerle tanışmaktır.Bu şekilde her 
                  türlü riski minimuma indirmiş olursunuz.</td>
																		<td width="12">&nbsp;</td>
																	</tr>
																	<tr>
																		<td height="10" width="12">
																		</td>
																		<td height="10">
																		</td>
																		<td height="10" width="12">
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
												<td background="img/alt_kapa_turuncu.gif" height="41">
												&nbsp;</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td align="center">
												<font color="#7B7B7B">banner 
												alanı</font></td>
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