<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Arama Sonucu <?=$uyeadi?></title>
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
	
	function sayfa(sayfa){
		
		$("#hangisayfa").html('<input type="hidden" name="sayfa" value="'+sayfa+'">');
	
		document.aramaformu.submit();
	}
</script>
</head>
<body onLoad="menuler('aramamerkezi');">
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

										<table border="0" width="100%" id="table173" cellspacing="0" cellpadding="0">
											<tr>
												<td height="46" background="img/ust_ac_turkuaz.gif">
												<table border="0" width="100%" id="table449" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Arama Sonuçları</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table175" cellspacing="0" cellpadding="0">
													<tr>
														<td>
												<table border="0" width="100%" id="table450" cellspacing="0" cellpadding="0">
													<tr>
														<td height="12"></td>
														<td width="510" height="12">
														</td>
														<td height="12"></td>
													</tr>
													<tr id="uyeler">
														<td>&nbsp;</td>
														<td width="510" align="center">
														<table border="0" id="table452" cellspacing="0" cellpadding="0">
														<tr>
															<?php
															
															
															$sonuclar = $_POST["sonuclar"];
															
															$aramasuresi = $_SESSION[_COOKIE."arama"];
															
															$simdi = @mktime();
															
															if($sonuclar == 1 or ($aramasuresi + 45) < $simdi){
															
															$cinsiyet = $_POST["cinsiyet"];
															
															$ulke = $_POST["ulke"];
															
															$sehir = turkce($_POST["sehir"]);
															
															$postsehir = $sehir;
															
															$yas1 = $_POST["yas1"];
															
															$yas2 = $_POST["yas2"];
															
															$online = $_POST["online"];
															
															$resim = $_POST["resim"];
															
															$galeri = $_POST["galeri"];
															
															$yil = date("Y");


															// cinsiyet where
															
															$cinsiyetsay = count($cinsiyet);
															
															$where1 .= "(";
															for($c = 0; $c < $cinsiyetsay; $c++){
																$cins = $cinsiyet[$c];
																
																if($cins == "farketmez"){
																	$where1 = NULL;
																	$c = $cinsiyetsay;
																}
																else {
																	if($c == $cinsiyetsay-1) $where1 .= "cinsiyet='$cins')";
																	else $where1 .= "cinsiyet='$cins' or ";
																}
															}
															
															// yas where
															
															$baslangicyas = @mktime(0,0,0, date("m"), date("d"), ($yil-$yas1));
															
															$bitisyas = @mktime(0,0,0, date("m"), date("d"), ($yil-$yas2));
															
															$where2 = "(dogum<$baslangicyas and dogum>$bitisyas)";
			
															// ulke sehir where
															
															$where3 = NULL;
															
															if($ulke != "farketmez") $where3 = "ulke='$ulke'";

															if($sehir != "farketmez") {
																if($where3) $where3 .= "and sehir='$sehir'";
																else $where3 = "sehir='$sehir'";
															}

															// resim where
															
															$where4 = NULL;
															if($resim == 1){
																$where4 = "topresim>=1";
															}															
															
															// galeri where
															
															$where5 = NULL;
															if($galeri == 1){
																$where5 = "topgaleri>=1";
															}
															
															
															// genel where
															
															$where = NULL;
															if($where1) $where = $where1;
															if($where2){
																if($where) $where .= " and ". $where2;
																else $where = $where2;
															}
															if($where3){
																if($where) $where .= " and ". $where3;
																else $where = $where3;
															}
															
															if($where4){
																if($where) $where .= " and ". $where4;
																else $where = $where4;
															}
															if($where5){
																if($where) $where .= " and ". $where5;
																else $where = $where5;
															}
															
															$aramatur = $_POST["aramatur"];
															
															if($aramatur == "medium" or $aramatur == "large"){
																
																$karakter = $_POST["karakter"];
																
																// karakter where

																$karaktersay = count($karakter);

																if($karaktersay >= 1){
																	$where6 .= "(";
																	for($k = 0; $k < $karaktersay; $k++){
																		$karak = $karakter[$k];
																	
																		if($k == $karaktersay-1) $where6 .= "karakter like '%$karak%')";
																		else $where6 .= "karakter like '%$karak%' or ";
																	
																	}
																}
																else {
																	$where6 = NULL;
																}
																
																
																
																$medeni = $_POST["medeni"];
																
																
																// medeni where

																$medenisay = count($medeni);

																if($medenisay >= 1){
																	$where7 .= "(";
																	for($k = 0; $k < $medenisay; $k++){
																		$men = $medeni[$k];
																	
																		if($k == $medenisay-1) $where7 .= "medenidurum like '%$men%')";
																		else $where7 .= "medenidurum like '%$men%' or ";
																	
																	}
																}
																else {
																	$where7 = NULL;
																}
																
															
																$iliski = $_POST["iliski"];


																// iliski where

																$iliskisay = count($iliski);

																if($iliskisay >= 1){
																	$where8 .= "(";
																	for($k = 0; $k < $iliskisay; $k++){
																		$ili = $iliski[$k];
																	
																		if($k == $iliskisay-1) $where8 .= "iliski like '%$ili%')";
																		else $where8 .= "iliski like '%$ili%' or ";
																	
																	}
																}
																else {
																	$where8 = NULL;
																}
																
																															
																$uyelik = $_POST["uyelik"];
															
																// uyelik where
																
																if($uyelik == 1){
																
																	$anauyelik = ayar("uyelik");
																	
																	$where9 = "seviye!='$anauyelik'";
																}
																
																
																if($where6){
																	if($where) $where .= " and ". $where6;
																	else $where = $where6;
																}
																if($where7){
																	if($where) $where .= " and ". $where7;
																	else $where = $where7;
																}
																if($where8){
																	if($where) $where .= " and ". $where8;
																	else $where = $where8;
																}
																if($where9){
																	if($where) $where .= " and ". $where9;
																	else $where = $where9;
																}
															}
															
															if($aramatur == "large"){
																
																$kiminle = $_POST["kiminle"];
																
																// kiminle where

																$kiminlesay = count($kiminle);

																if($kiminlesay >= 1){
																	$where10 .= "(";
																	for($k = 0; $k < $iliskisay; $k++){
																		$kimi = $kiminle[$k];
																	
																		if($k == $kiminlesay-1) $where10 .= "iliski like '%$kimi%')";
																		else $where10 .= "iliski like '%$kimi%' or ";
																	
																	}
																}
																else {
																	$where10 = NULL;
																}
																
																$webcam = $_POST["webcam"];
																
																// webcam where
																
																if($webcam == 1){
																	$where11 = "webcam='Evet'";
																}

																if($where10){
																	if($where) $where .= " and ". $where10;
																	else $where = $where10;
																}
																
																if($where11){
																	if($where) $where .= " and ". $where11;
																	else $where = $where11;
																}
																
															}
															
															$limit = 16;
															
															$sayfa = $_POST["sayfa"];
															
															$sayfa = intval($sayfa);
															
															if(!$sayfa) $sayfa = 1;
															
															$toplam = @mysql_query("select count(id) from "._MX."uye where $where");
															
															list($toplam) = @mysql_fetch_row($toplam);
															
															
															if($toplam >= 1){
															
															$toplamsayfa = ceil(($toplam/$limit));
															
															
															$result = @mysql_query("select id, kullanici, cinsiyet, dogum, sehir, img, tanitim seviye from "._MX."uye where ".$where."order by oncelik asc limit ".(($sayfa-1)*$limit).",".$limit."");
															
															
															$i = 1;
															
															$adet = @mysql_num_rows($result);
															
															if($adet >= 1) {
															
															while(list($id, $kullanici, $cinsiyetuye, $dogum, $sehir, $img, $tanitim, $seviye) = mysql_fetch_row($result)){
															
															$img = uyeavatar($img, $cinsiyetuye);
															
															$yas = (date("Y")-date("Y", $dogum));
															
															$tanitim = stripslashes($tanitim);
															
															if($online == 1){
															
															list($onlinemi) = @mysql_fetch_row(@mysql_query("select count(uye) from "._MX."online where uye='$id'"));
															
															if($onlinemi >= 1) $onlinemi = '<p class="online">Online</p>';
															else $onlinemi = '<p class="offline">Offline</p>';
														
															} // online mi bak
															
															$seviyead = seviye($seviye, "ad");
															
															$seviyerenk = seviye($seviye, "renk");
															
														?>	
																<td valign="top">
																<table border="0" id="table453" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="100" height="126" background="img/uyelistele_fotoarkasi.gif">
																		<table border="0" width="100%" id="table457" cellspacing="0" cellpadding="0">

																			<tr>
																				<td height="28" align="center">
																				<?=$onlinemi?></td>
																			</tr>

																			<tr>
																				<td height="70" align="center"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);" title="<?=$tanitim?>"><img border="0" src="<?=$img?>" width="70" height="70"></a></td>
																			</tr>
																			<tr>
																				<td height="28" align="center">
																				<p class="uye_small"><?=$seviyead?></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="6">
																		</td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="20">
																		<p class="nickname">
																		<a class="form_txt2" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);">
																		<font color="<?=$seviyerenk?>"><?=$kullanici?></font></a></td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="20">
																		<p class="yas"><?=$yas?> 
																		Yaşında</td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="20">
																		<p class="yer">
																		<?=$sehir?></td>
																	</tr>
																</table>
																</td>
																<td width="25">&nbsp;</td>
																
																<?php
																
																	if($i%4 == 0) {
																?>
															</tr>
															<tr>
																<td valign="top">
																&nbsp;</td>
																<td width="25">&nbsp;</td>
																<td valign="top">
																&nbsp;</td>
																<td width="25">&nbsp;</td>
																<td valign="top">
																&nbsp;</td>
																<td width="25">&nbsp;</td>
																<td valign="top">
																&nbsp;</td>
															</tr>
															<tr>
															<?php
																	}
																
																	$i++;
																	
																	} // end while
																	
																	
															}
															else {
															
															
															echo "<p align=center><font size=2 color=red><b>Aradığınız kriterlere uygun üye bulunamamıştır</b></font></p>";
															
															}
															
																} // end if toplam
																else {
																
																echo "<p align=center><font size=2 color=red><b>Aradığınız kriterlere uygun üye bulunamamıştır</b></font></p>";
																
																
																
																}
																
																$zaman = @mktime();
																
																$_SESSION[_COOKIE."arama"] = $zaman;
																
																} // arama suresi if
																
																else {
																
																echo "<p align=center><font size=2 color=red><b>45 saniyede bir arama yapabilirsiniz</b></font></p>";

																}

																?>
																
														</table>
														</td>
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
												<td background="img/alt_kapa_turkuaz.gif" height="41">
												<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
													<tr>
														<td width="10" height="41">&nbsp;</td>
														<td width="120">
														<?php
															
															if($sayfa == 1) $oncekisayfa = $toplamsayfa;
															else $oncekisayfa = $sayfa-1;
															
															if($sayfa == $toplamsayfa) $sonrakisayfa = 1;
															else $sonrakisayfa = $sayfa+1;
															
														?>
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td width="20">
																<img border="0" src="img/sayfa_cevir_iko_sol.gif" width="20" height="18"></td>
																<td width="6">&nbsp;</td>
																<td>
																<a class="ok_onceki_sonraki" href="javascript:void(0)" onclick="sayfa(<?=$oncekisayfa?>)">
																Önceki Sayfa</a></td>
															</tr>
														</table>
														</td>
														<td align="center">
														<font color=white size=2><b>Diğer Sayfalar : </b></font>
														
														<span id="sayfalar">
														<select onChange="sayfa(this.value)" class="selectler">
														<?php
															for($i = 1; $i <= $toplamsayfa; $i++){
																if($sayfa == $i) echo "<option value=$i selected>Sayfa : $i</option>";
																else echo "<option value=$i>Sayfa : $i</option>";
															}
														?>
														</select>
														</span>
														
														</td>
														<td width="120" align="right">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td align="right">
																<a class="ok_onceki_sonraki" href="javascript:void(0)" onclick="sayfa(<?=$sonrakisayfa?>)">
																Sonraki Sayfa</a></td>
																<td width="6">&nbsp;</td>
																<td width="20">
																<img border="0" src="img/sayfa_cevir_iko_sag.gif" width="20" height="18"></td>
															</tr>
														</table>
														</td>
														<td width="10">&nbsp;</td>
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
												<? echo stripslashes(ayar("icerikalti")); ?>
												</td>
											</tr>
											<tr>
												<td align="center">
												&nbsp;</td>
											</tr>
											</table>
										<form action="index.php?sayfa=arama_sonuc" method="post" name="aramaformu">
											<?php
												if($cinsiyet){
												foreach($cinsiyet as $cins) echo '<input type="hidden" name="cinsiyet[]" value="'.$cins.'">';
												}
											?>
											<input type="hidden" name="yas1" value="<?=$yas1?>">
											<input type="hidden" name="yas2" value="<?=$yas2?>">
											<input type="hidden" name="ulke" value="<?=$ulke?>">
											<input type="hidden" name="sehir" value="<?=$postsehir?>">
											<input type="hidden" name="online" value="<?=$online?>">
											<input type="hidden" name="galeri" value="<?=$galeri?>">
											<input type="hidden" name="resim" value="<?=$resim?>">
											<input type="hidden" name="aramatur" value="<?=$aramatur?>">
											<input type="hidden" name="sonuclar" value="1">
											
											<span id="hangisayfa"></span>
											
											<?php
												if($aramatur == "medium" or $aramatur == "large"){
													if($medeni) foreach($medeni as $men) echo '<input type="hidden" name="medeni[]" value="'.$men.'">';
													if($iliski) foreach($iliski as $ili) echo '<input type="hidden" name="iliski[]" value="'.$ili.'">';
													if($karakter) foreach($karakter as $karak) echo '<input type="hidden" name="karakter[]" value="'.$karak.'">';
												}
												
												if($aramatur == "large"){
													if($kiminle) foreach($kiminle as $kimi) echo '<input type="hidden" name="kiminle[]" value="'.$kimi.'">';
												}
											?>
										</form>
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