<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Ayın üyeleri <?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link rel="stylesheet" href="inc/basic.css" type="text/css" />
	<style type="text/css">
	.ayinguzeli {
		width:540px;
		position:relative;
		margin:0px;
		padding:0px;
	}
	.ayinguzeli a {
		text-decoration:none;
	}
	.ayinguzeli a:hover {
		text-decoration:underline;
	}
	.ayinguzeli img {
		border:0px;
	}
	.ay-ust {
		width:540px;
		height:87px;
		background:url(img/ay-ust.jpg) no-repeat;
		position:relative;
		margin:0px;
		padding:0px;
	}
	.ay-ust .onceki {
		width:87px;
		height:27px;
		position:absolute;
		left:10px;
		top:11px;
	}
	.ay-ust .logo {
		width:280px;
		height:50px;
		background:url(img/ay-logo.jpg) no-repeat;
		position:absolute;
		left:135px;
		top:22px;
	}
	.ay-ust .logo .yazi {
		position:absolute;
		top:16px;
		right:10px;
		font-size:16px;
		font-weight:bold;
		color:#2d2d2d;
		font-family:Arial;
	}
	.ay-ust .sonraki {
		width:88px;
		height:27px;
		position:absolute;
		right:10px;
		top:11px;
	}
	.ay-cinsiyetler {
		width:540px;
		height:32px;
		background:url(img/ay-cinsiyetler.jpg) no-repeat;
		position:relative;
		left:0px;
		text-align:left;
	}
	.ay-cinsiyetler a {
		font-size:12px;
		color:#fff;
		font-family:Arial;
		font-weight:bold;
	}
	.ay-cinsiyetler .liste {
		width:540px;
		height:32px;
		position:absolute;
		left:0px;
		top:0px;
	}
	.ay-cinsiyetler ul {
		margin:0px;
		padding:0px;
		text-align:left;
		list-style-type:none;
	}
	.ay-cinsiyetler li {
		width:80px;
		height:32px;
		background:url(img/ay-cinsiyet-bg-pasif.png) no-repeat;
		text-align:center;
		vertical-align:middle;
		float:left;
		margin:0px 0px 0px 5px;
	}
	.ay-cinsiyetler .aktif {
		background:url(img/ay-cinsiyet-bg-aktif.png) no-repeat;
	}
	.ay-cinsiyetler .aktif a { color:bf2626; }

	.ay-resimm {
		width:540px;
		height:371px;
		background:url(img/ay-resim.jpg) no-repeat;
		position:relative;
		text-align:center;
		left:0px:
		top:0px;
	}
	.ay-resimm img {
		margin:22px 0px 0px 0px;
	}
	.ay-bilgiler {
		width:540px;
		height:264px;
		background:url(img/ay-bilgiler.jpg) no-repeat;
		position:relative;
		left:0px;
		top:0px;
		font-size:12px;
	}
	.ay-bilgiler ul {
		margin:0px 0px 0px 50px;
		padding:0px;
		text-align:left;
		list-style-type:none;
		font-weight:bold;
		color:#333333;
	}
	.ay-bilgiler li {
		padding:3px 0px 0px 0px;
	}
	.ay-bilgiler span {
		width:150px;
		margin:0px 18px 0px 0px;
		text-align:right;
		font-weight:bold;
		color:#bf2626;
	}
	.ay-bilgiler .profil {
		width:237px;
		height:34px;
		position:absolute;
		bottom:30px;
		right:13px;
	}
	.ay-altbilgiler {
		width:540px;
		background:url(img/ay-alt-bg.jpg);
		position:relative;
	}
	.ay-altbilgiler .bilgi {
		width:540px;
		height:137px;
		background:url(img/ay-tanitim-bg.jpg) no-repeat;
		position:relative;
	}
	.ay-altbilgiler .bilgi p { width:490px; margin:0px; padding:0px; }
	
	.ay-altbilgiler .bilgi .baslik {
		position:absolute;
		left:28px;
		top:0px;
		font-size:16px;
		color:#af1b1b;
		font-weight:bold;
		font-family;Arial;
	}
	.ay-altbilgiler .bilgi .aciklama {
		position:absolute;
		left:28px;
		top:24px;
		text-align:justify;
		font-size:12px;
		color:#595959;
	}
	.ay-altt {
		width:540px;
		height:6px;
		background:url(img/ay-alt.jpg) no-repeat;
		position:relative;
	}
	.temizle { clear:both; }
	</style>
<script type="text/javascript" src="inc/jquery.js"></script>
<script type='text/javascript' src='inc/jquery.simplemodal.js'></script>
<script type="text/javascript">
	function menuler(menu){ 
		
		$("#mesajmerkezitablo").hide();
		$("#arkadasmerkezitablo").hide();
		$("#aramamerkezitablo").hide();
		$("#profilmerkezitablo").hide();
		
		$("#"+menu+"tablo").show("slow");
	}
	
	function uyegoster(yer){
		
		$(".liste li").removeClass("aktif");
		$("#cinsiyet"+yer).addClass("aktif");
		
		$(".ay-resimm").hide();
		$("#cinsiyetresim"+yer).fadeIn("slow");
		
		$(".ay-bilgiler").hide();
		$("#cinsiyetbilgiler"+yer).fadeIn("slow");
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
												<td>
												<?php
												
												$aylar = array("", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");
												
												$ay = $_GET["ay"];
												
												$yil = $_GET["yil"];
												
												$buay = date("m") - 1;
												
												$buyil = date("Y");
												
												if(!$ay) $ay = date("m");
												
												if(!$yil) $yil = date("Y");
												
												if($ay == 1) {
													$ay = 12;
													$yil--;
												}
												else {
													$ay--;
												}
												
												$oncekiay = $ay;
												
												list($warmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_ay where ay='$oncekiay' and yil='$yil'"));
												
												$onceki = "index.php?sayfa=ayinuyeleri&ay=$oncekiay&yil=$yil";

												
												if($ay == $buay) $sonraki = 'javascript:void(0)';
												else {
												$sonraki = $ay+2;
												$sonraki = "index.php?sayfa=ayinuyeleri&ay=$sonraki&yil=$yil";
												}
												
												
												$ayad = $aylar[$ay];
												
												
												$seccinsiyet = array(1, 2, 3, 4, 7, 8);
												
												?>
												<div class="ayinguzeli">

													<div class="ay-ust">
														<div class="onceki"><a href="<?=$onceki?>"><img src="img/ay-onceki-ay.jpg" /></a></div>
														<div class="sonraki"><a href="<?=$sonraki?>"><img src="img/ay-sonraki-ay.jpg" /></a></div>
														<div class="logo">
															<div class="yazi"><?=$ayad?> '<?=substr($yil, 2, 3);?></div>
														</div>
													</div>

													<div class="ay-cinsiyetler">
														<ul class="liste">
															<li id="cinsiyet1" class="aktif"><a href="javascript:void(0)" onclick="uyegoster(1);">Bayan</a></li>
															<li id="cinsiyet2"><a href="javascript:void(0)" onclick="uyegoster(2);">Çift</a></li>
															<li id="cinsiyet4"><a href="javascript:void(0)" onclick="uyegoster(4);">Lezbiyen</a></li>
															<li id="cinsiyet3"><a href="javascript:void(0)" onclick="uyegoster(3);">Erkek</a></li>
															<li id="cinsiyet8"><a href="javascript:void(0)" onclick="uyegoster(8);">Travesti</a></li>
															<li id="cinsiyet7"><a href="javascript:void(0)" onclick="uyegoster(7);">Gay</a></li>
														</ul>
													</div>
													
													<?php
													
													foreach($seccinsiyet as $sec){
													
													if($sec == 1) $style = NULL;
													else $style = ' style="display:none"';
													
													
													list($uye, $uyead, $resim) = mysql_fetch_row(mysql_query("select uye, uyead, img from "._MX."uye_ay where cinsiyet='$sec' and ay='$ay' and yil='$yil'"));
													
													
													list($dogum, $sehir, $kiminle, $iliski, $aracinsiyet, $tanitim, $tanitimonay) = mysql_fetch_row(mysql_query("select dogum, sehir, kiminle, iliski, aracinsiyet, tanitim, tanitimonay from "._MX."uye where id='$uye'"));
													
													$yas = date("Y") - date("Y", $dogum);
													
													$sehir = stripslashes($sehir);
													
													$kiminle = stripslashes($kiminle);
													
													$iliski = str_replace(";", ", ", $iliski);
													
													$aracinsiyet = str_replace(";", ", ", $aracinsiyet);
													
													if($tanitimonay == 1) $tanitim = stripslashes($tanitim);
													else $tanitim = "<font color=red>Onay bekliyor</font>";
													
													$tanitim = substr($tanitim, 0, 276);
													
													?>

													<div id="cinsiyetresim<?=$sec?>" class="ay-resimm"<?=$style?>><img src="<?=$resim?>" /></div>
													
													<div id="cinsiyetbilgiler<?=$sec?>" class="ay-bilgiler"<?=$style?>>
														<ul>
															<li><span>Rumuz</span><?=$uyead?></li>
															<li><span>Yaş</span><?=$yas?></li>
															<li><span>Yaşadığı Yer</span><?=$sehir?>, <?=$kiminle?></li>
															<li><span>Aradığı İlişki Türü</span><?=$iliski?></li>
															<li><span>Aradığı Cinsiyet</span><?=$aracinsiyet?></li>
															<li><span>Mesajı</span><?=$tanitim?></li>
														</ul>
														<div class="profil"><a href="javascript:void(0)" onClick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uyeid?>', 2, 1, 1);" title="Profiline Bak"><img src="img/ay-profil.jpg" /></a></div>
													</div>
													
													<?php
													
													} // end foreach
													
													?>
													<div class="ay-altbilgiler">
													
													<div class="bilgi">
														<p class="baslik">Ne İşe Yarar</p>
														<p class="aciklama">
														 &nbsp;</p>
													</div>
													<br />
													<div class="bilgi">
														<p class="baslik">Nasıl Olunur</p>
														<p class="aciklama">
														 &nbsp;</p>
													</div>
													
													<br />
													</div>
													
													<div class="ay-altt"></div>
												</div>


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