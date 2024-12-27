<?
error_reporting(0);
$uyeid = uyeid();

// if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();



$item = $_GET["item_number"];

if($item){
	
	// include("ayarlar.php");
	// include("fonksiyon.php");
	
	list($idmiz, $uyemiz, $paypal) = @mysql_fetch_row(@mysql_query("select id, uye, paypal from "._MX."paypal where item='$item'"));
	
	
	$uyeid = $uyemiz;
	
	// if($uyeid == $uyemiz){
		
		
		list($seviye, $sure) = explode(";", $paypal);
		
		$odenecektutar = seviye($seviye, "$sure");
		
		$tutar = $odenecektutar;
		
		if(strlen($ay) == 1) $ay = "0". $ay;
		
		$birgun = 60*60*24; // 60 saniye 1 saat 60 dakika 1 gün 24 saat
		
		switch($sure){
			case "aylik"; $eklezaman = $birgun * 30;break;
			case "aylik3"; $eklezaman = $birgun * 90;break;
			case "aylik6"; $eklezaman = $birgun * 180;break;
			case "yillik"; $eklezaman = $birgun * 365;break;
			case "sinirsiz"; $eklezaman = 0;break;
		}
		
		list($uyecinsiyet, $uyezaman) = @mysql_fetch_row(@mysql_query("select cinsiyet, bitis from "._MX."uye where id='$uyeid'"));
		
		// $uyecinsiyet = uyebilgi("cinsiyet");
		
		$seviyeoncelik = seviye($seviye, "oncelik");
		
		$oncelik = $uyecinsiyet * $seviyeoncelik;
		
		list($uyekayit) = mysql_fetch_row(mysql_query("select kayit from "._MX."uye where id='$uyeid'"));
		
		$zamanzaman = 60 * 60 * 24 * 2;
		
		$suankizaman = @mktime();
		
		if($uyekayit + $zamanzaman > $suankizaman){
			$olala = 1;
		}
		else {
			list($satisadet) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme2"));
			list($satisadet2) = mysql_fetch_row(mysql_query("select count(id) from "._MX."odeme"));
			
			$satisadet = $satisadet + $satisadet2;
			
			if($satisadet%2 == 0) $olala = 2;
			else $olala = 1;
		
		}
		
		if($sure == "sinirsiz"){

			$result = mysql_query("update "._MX."uye set bitis='0', satissatis='$olala', oncelik='$oncelik', seviye='$seviye' where id='$uyeid'");		
		
		}
		else {
		
			// $uyezaman = uyebilgi("bitis");
			
			$simdi = time();
			
			if($uyezaman > $simdi){
			
			$zaman = $uyezaman + $eklezaman;
		
			}
			
			else {
			
			$zaman = $simdi + $eklezaman;
			
			}
			$result = mysql_query("update "._MX."uye set bitis='$zaman', satissatis='$olala', oncelik='$oncelik', seviye='$seviye' where id='$uyeid'");
			
			
		}
		
		$kayit = @mktime();
		
		$ip = $_SERVER["REMOTE_ADDR"];
		
		@mysql_query("insert into "._MX."odeme values(NULL, '$uyeid', '1', 'PAYPAL - $item numarali odeme', 'PayPal Odemesi', '', '', '$ip', '$odenecektutar', '$seviye', '$sure', '$kayit', '1')");
		
		@mysql_query("delete from "._MX."paypal where id='$idmiz'");
		
		session_destroy();

		// die("ok");
		
	// }
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Ödeme Alýndý <?=$uyeadi?>, <?=_BASLIK?></title>
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
										

										<table border="0" width="100%" id="table15" cellspacing="0" cellpadding="0">
												<tr>
												<td background="img/ust_ac_lacivert.gif" height="46">
												<table border="0" width="100%" id="table323" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Üyelik Yükselt</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table16" cellspacing="0" cellpadding="0">
													<tr>
														<td height="15">
														</td>
													</tr>
													<tr>
														<td height="15" align="center">
												<table border="0" width="100%" id="table525" cellspacing="0" cellpadding="0">
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
								<img border="0" src="img/iko_odemetamam.gif" width="128" height="128"></td>
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
														<b>
														<font color="#C32828" size="5">
														Tebrikler! Ödemeniz 
														alýnmýþtýr</font></b></td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="10"></td>
														<td width="510" align="center" height="10">
														</td>
														<td height="10"></td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td width="510" align="center">
														<?php
														$tur = $_GET["tur"];
														if($tur == 1){
														?>
														<p class="tx">Üyeliðiniz baþarýyla yükseltilmiþtir. Aktif olmasý için yeniden giriþ yapmalýsýnýz. Çýkýþ yapmak için <a class="tx" href="index.php?sayfa=cikis">
														<u>
														<font color="#C32828">
														Týklayýn</font></u></a>.<br>
														
														<?php
														}
														else {
														?>
														<p class="tx">Bilgileriniz en kýsa zamanda kontrol edilip üyeliðiniz aktif edilecektir. <br>
														<?php
														}
														?>
														sorularýnýz için
														<a class="tx" href="#x">
														<u>
														<font color="#C32828">
														yardým</font></u></a> 
														sayfalarýmýzý ziyaret 
														edebilirsiniz.</td>
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
														<td height="8">
														<img border="0" src="img/1px.gif" width="1" height="1"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td>
														<img border="0" src="img/pncere1_alt.gif" width="540" height="9"></td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td height="12"></td>
											</tr>
											<tr>
												<td height="12">
												</td>
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