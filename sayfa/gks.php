<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$islem = $_GET["islem"];


if($islem == "basvuru"){


	if(uyebilgi("cinsiyet") != 3){
	
		
		$result = mysql_query("select count(id) from "._MX."gks where uye='$uyeid'");
		
		list($warmi) = mysql_fetch_row($result);
		
		if($warmi < 1){
		
		$kayit = mktime();
		
		
		$result = mysql_query("insert into "._MX."gks values(NULL, '$uyeid', '$kayit', '2')");
		
		
		if($result) echo "<script>alert('Başvurunuz başarıyla alındı');</script>";
	
		}
		else {
		
			echo "<script>alert('Daha önce başvuruda bulundunuz');</script>";

		}
	
	}
	
	else {
	
		echo "<script>alert('Sadece bayan, çift ve lezbiyen üyelerimiz faydalanabilmektedir.');</script>";
	}
}

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>K.G.L Almak İstiyorum<?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link rel="stylesheet" href="inc/basic.css" type="text/css" />
	<style type="text/css">
	.kgl{
		width:540px;
		position:relative;
		margin:0px;
		padding:0px;
		font-family:Arial;
	}
	.kgl img { border:0px; }
	.ust {
		width:540px;
		height:198px;
		background:url(img/kgl-ust.jpg) no-repeat;
		position:relative;
	}
	.ust .kiz {
		width:144px;
		height:169px;
		background:url(img/kgl-kiz.jpg) no-repeat;
		position:absolute;
		left:20px;
		bottom:0px;
	}
	.ust .uyeolkap {
		width:334px;
		height:30px;
		background:url(img/kgl-uye-ol-kap.jpg) no-repeat;
		position:absolute;
		top:29px;
		right:28px;
	}
	.ust .ok {
		width:93px;
		height:62px;
		background:url(img/kgl-ok.jpg) no-repeat;
		position:absolute;
		left:221px;
		bottom:0px;
	}
	.ust .yazi {
		width:334px;
		position:absolute;
		left:176px;
		top:73px;
		text-align:justify;
		font-size:14px;
		color:#383838;
		font-weight:bold;
	}
	.ust .yukle {
		width:199px;
		height:45px;
		position:absolute;
		right:21px;
		bottom:6px;
	}
	.aciklama {
		width:540px;
		height:337px;
		background:url(img/kgl-nedir.jpg) no-repeat;
		position:relative;
	}
	.aciklama p {
		margin:0px;
		padding:0px;
		font-size:12px;
		color:#595959;
	}
	.aciklama .nedir {
		padding:27px 0px 0px 32px;
		font-size:16px;
		color:#9e0a0a;
		font-weight:bold;
	}
	.aciklama .nedir2 {
		padding:20px 10px 0px 32px;
	}
	.kurallar {
		width:540px;
		height:168px;
		background:url(img/kgl-aciklama.jpg) no-repeat;
		position:relative;
	}
	.kurallar p {
		margin:0px;
		padding:0px;
		font-size:12px;
		color:#595959;
	}
	.kurallar .kuralbaslik {
		padding:6px 0px 0px 43px;
		font-size:16px;
		color:#9e0a0a;
		font-weight:bold;
	}
	.kurallar .kuralbaslik2 {
		padding:12px 0px 0px 43px;
		font-weight:bold;
	}
	.kurallar .yukle2 {
		width:199px;
		height:45px;
		position:absolute;
		right:30px;
		bottom:6px;
	}
	.fotolar {
		width:540px;
		height:341px;
		background:url(img/kgl-alt.jpg) no-repeat;
		position:relative;
	}
	.fotolar img {
		width:99px;
		height:99px;
		margin:2px 0px 0px 3px;
	}
	.fotolar p {
		margin:0px;
		padding:0px;
		font-size:12px;
		color:#595959;
	}
	.fotolar .fotobaslik {
		padding:16px 0px 0px 43px;
		font-size:16px;
		color:#9e0a0a;
		font-weight:bold;
	}
	.fotolar ul {
		width:482px;
		margin:10px 0px 0px 43px;
		padding:0px;
		list-style-type:none;
	}
	.fotolar li {
		width:105px;
		height:106px;
		background:url(img/kgl-foto-zemin.jpg) no-repeat;
		float:left;
		margin:10px 10px 5px 0px;
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

												$cinsiyet = uyebilgi("cinsiyet");

												if($cinsiyet == 1 or $cinsiyet == 2 or $cinsiyet == 4 or $cinsiyet == 5 or $cinsiyet == 6) $buton = "href='index.php?sayfa=profil_resim&tur=gks'";
												else $buton = "href='javascript:void(0)' onclick=\"alert('KGL üyelikten sadece bayan, çift ve lezbiyen üyelerimiz yararlanabilir');\"";

												?>
												<div class="kgl">

													<div class="ust">
														<div class="kiz"></div>
														<div class="uyeolkap"></div>
														<div class="ok"></div>
														<div class="yazi">En az 4 adet çıplaklık içermeyen el yazısı ile yazılı mutlaka elde tutularak çekilmiş fotoğrafınızı gönderin large üyeliğinizi hemen aktif edelim.
														</div>
														<div class="yukle"><a <?=$buton?>><img src="img/kgl-yukle.png" /></a></div>
													</div>
													
													<div class="aciklama">
														<p class="nedir">Nedir?</p>
														<p class="nedir2">
												K.G.L Kişisel Güvenlik Lisansı'nın kısaltılmış halidir.
												<br />
												<br />
												K.G.L li resim, siz üyelerimize ek güvenirlilik vermekle <br /> unutmayınız
												sistemimize her üye olan bayan yada çiftler gerçek <br />olmayabilir bunu 
												ayırt etmenin en kolay yolu K.G.L üyeliğidir gerek <br />site içinde veya gerek
												ileride olabilecek değişikliklerden öncelikli faydalanma hakkı verecektir.<br />
												<br />
												Bayan, Çift, Lezbiyen üyelerimizden aşağıdaki resimleri printleyerek veya kendileri el yazısı<br /> ile 
												yazarak en az 4 ADET ve de içinde çıplaklık olmayan ve mutlaka bu yazıları ELLERİNDE tutarak resim 
												çekip siteye eklediklerinde;
												<br />
												<br />
												*** Sistemimizden sınırsız Large üyelik alacaklar,<br />
												*** Şuan üyelikleri olanlarda ek üyelik uzatması kazanarak yararlanacaklar,<br />
												*** Bu hizmetten yararlanan üyelerimizin profillerinde K.G.L  ikonu yer alacaktır,<br />
												*** Yine bu resimler ile katılan üyelerimizin bu resimlerinden tasarıma uygun seçilenler site
												tasarımlarında kullanılacak ve kendilerini site tasarımında görebileceklerdir...
														</p>
													</div>
													
													<div class="kurallar">
														<p class="kuralbaslik">Kurallar</p>
														<p class="kuralbaslik2">
												En az 4 adet çıplaklık içermeyen el yazısı ile yazılı mutlaka elde tutularak çekilmiş<br />
												resimler olmak zorundadır.
												<br /><br />
												K.G.L Sistemi sadece Bayan, Çift, ve Lezbiyen üyelerimizi kapsamaktadır.
														</p>
														<div class="yukle2"><a <?=$buton?>><img src="img/kgl-yukle.png" /></a></div>
													</div>
													
													<div class="fotolar">
														<p class="fotobaslik">Örnek Resimler</p>
														
														<ul class="fotoliste">
															<li><img src="img/kgl-resim1.jpg" /></li>
															<li><img src="img/kgl-resim2.jpg" /></li>
															<li><img src="img/kgl-resim3.jpg" /></li>
															<li><img src="img/kgl-resim4.jpg" /></li>
															<li><img src="img/kgl-resim5.jpg" /></li>
															<li><img src="img/kgl-resim6.jpg" /></li>
															<li><img src="img/kgl-resim7.jpg" /></li>
															<li><img src="img/kgl-resim8.jpg" /></li>
														</ul>
													</div>
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