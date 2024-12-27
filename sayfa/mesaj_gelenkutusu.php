<?

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();


if($_POST["islem1_x"]){

	$mesajid = $_POST["mesajid"];
	
	$i = 0;
	
	foreach($mesajid as $ak){
		
		mysql_query("update "._MX."uye_mesaj set yer='2' where id='$ak' and gonderilen='$uyeid'");
	
	}
		
}

if($_POST["islem_x"]){
	
	$mesajid = $_POST["mesajid"];
	
	$i = 0;
	
	if($mesajid){
	
	foreach($mesajid as $ak){
	
		list($durum) = mysql_fetch_row(mysql_query("select durum from "._MX."uye_mesaj where id='$ak' and gonderilen='$uyeid'"));
		
		if($durum == 2){
			
			$i++;
			
		}
	
		mysql_query("update "._MX."uye_mesaj set masaustusil='1' where id='$ak' and gonderilen='$uyeid'");
	
	}
	
	@mysql_query("update "._MX."uye set topmesaj=topmesaj-$i where id='$uyeid'");
	
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Gelen Kutunuz <?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<link rel="stylesheet" href="inc/basic.css" type="text/css" />
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
	
	function hepsinisec(){
		for(i=0;i<document.getElementsByName("mesajid[]").length;i++) {
			document.getElementsByName("mesajid[]")[i].checked = !document.getElementsByName("mesajid[]")[i].checked;
		}
	}
	
	function sayfalar(sayfa){
		$("#mesajlar").html("adsa");
	
	}
</script>
</head>
<body onLoad="menuler('mesajmerkezi');">
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
										
										<?
										
										$result = mysql_query("select count(id) from "._MX."uye_mesaj where gonderilen='$uyeid' and yer='1' and masaustusil='0'");
										
										list($count) = mysql_fetch_row($result);
										
										if($count < 1){
										
										?>
											<!-- gelen kutusu bos -->
										<table border="0" width="100%" id="table201" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_mor.gif" height="46">
												<table border="0" width="100%" id="table261" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Gelen Kutusu</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="table203" cellspacing="0" cellpadding="0">
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
														<font color="#800080">
														<b>gelen kutunuz boştur</b></font></td>
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
												<td background="img/pncere1_a_bg.gif" height="10">
												<img border="0" src="img/1px.gif" width="1" height="1"></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/alt_kapa_mor.gif" height="41">
												<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
													<tr>
														<td width="10" height="41">&nbsp;</td>
														<td width="120">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td width="20">
																<img border="0" src="img/hepsinisec_iko_sol.gif" width="20" height="18"></td>
																<td width="6">&nbsp;</td>
																<td>
																<a class="ok_onceki_sonraki" href="#x">
																Hepsini Seç</a></td>
															</tr>
														</table>
														</td>
														<td align="center">
														&nbsp;</td>
														<td width="80" align="right">
														<img border="0" src="img/btn_x_arsivegonder.gif" width="80" height="18"></td>
														<td width="6" align="right">
														&nbsp;</td>
														<td width="63" align="right">
														<img border="0" src="img/btn_x_hemensil.gif" width="63" height="18"></td>
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
											<!-- gelen kutusu bos son -->
										<?
										
										}
										else {
										
										
										?>
										
										<table id="mesajokutable">
										
										</table>
										
										<form action="index.php?sayfa=mesaj_gelenkutusu" method="post" name="mesajform">
										<table border="0" width="100%" id="table201" cellspacing="0" cellpadding="0">
											<tr>
												<td background="img/ust_ac_mor.gif" height="46">
												<table border="0" width="100%" id="table261" cellspacing="0" cellpadding="0">
													<tr>
														<td width="20">&nbsp;</td>
														<td>
														<p class="tit_1_beyaz">
														Gelen Kutusu</td>
														<td width="20">&nbsp;</td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/pncere1_a_bg.gif">
												<table border="0" width="100%" id="mesajlar" cellspacing="0" cellpadding="0">
																										
													<?
														$limit = 10;
														
														$sayfa = $_POST["sayfa"];
														
														if(!$sayfa) $sayfa = 1;
														
														$toplamsayfa = ceil($count/$limit);
														
														$mesajid = array();
														
														$result = mysql_query("select id, gonderen, gonderenad, konu, kayit, durum from "._MX."uye_mesaj where gonderilen='$uyeid' and yer='1' and masaustusil='0' order by durum desc, oncelik asc limit ".(($sayfa-1)*$limit).",".$limit."");
														
														$i = 1;
														
														while(list($id, $gonderen, $gonderenad, $konu, $kayit, $durum) = mysql_fetch_row($result)){
														
														$konu = stripslashes($konu);
														
														if(strlen($konu) > 24) $konu = substr($konu, 0, 25) ." ...";
														
														$kayit = tarihdon($kayit);
													
														if($durum == 2) {
														$durum = "<font color=red>okunmamış mesaj</font>";
														$msjico = "iko_kapalimail.gif";
														}
														else  {
														$durum = "okunmuş mesaj";
														$msjico = "iko_acikmail.gif";
														}
													?>
													<tr>
														<td>&nbsp;</td>
														<td width="510">
														<table border="0" width="100%" id="table204" cellspacing="0" cellpadding="0">
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_ust.gif" width="510" height="6"></td>
															</tr>
															<tr>
																<td background="img/msg_kutusu_bg.gif">
																<table border="0" width="100%" id="table205" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="6">&nbsp;</td>
																		<td width="25" bgcolor="#E8E8E8" align="center" valign="bottom">
																		<table border="0" width="100%" id="table208" cellspacing="0" cellpadding="0">
																			<tr>
																				<td align="center"><input type="checkbox" name="mesajid[]" id="mesajid[]" value="<?=$id?>"></td>
																			</tr>
																			<tr>
																				<td height="3"><img border="0" src="img/1px.gif" width="1" height="1"></td>
																			</tr>
																		</table>
																		</td>
																		<td width="15">&nbsp;</td>
																		<td>
																		<table border="0" width="100%" id="table206" cellspacing="0" cellpadding="0">
																			<tr>
																				<td>
																				<p class="soru">Gönderen <a class="form_txt" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$gonderen?>', '745', '700', 'profilpopup<?=$gonderen?>', 2, 1, 1);"><b><?=$gonderenad?> <?php if($gonderen == 1838) { echo "<font color=red>(Site Yöneticisi)</font>"; }?></b></a></td>
																			</tr>
																			<tr>
																				<td height="4"></td>
																			</tr>
																			<tr>
																				<td>
																				<p class="msg_tit"><b><a class="msg_tit" href="index.php?sayfa=mesaj_mesajoku&id=<?=$id?>" title="Mesajı Oku"><?=$konu?></a></b></td>
																			</tr>
																		</table>
																		</td>
																		<td width="125" align="right">
																		<table border="0" width="100%" id="table207" cellspacing="0" cellpadding="0">
																			<tr>
																				<td align="right">
																				<p class="yas"><?=$kayit?></td>
																			</tr>
																			<tr>
																				<td align="right">
																				<p class="not"><?=$durum?></td>
																			</tr>
																			<tr>
																				<td height="8"></td>
																			</tr>
																			<tr>
																				<td align="right">
																				<p class="form_txt"><a class="form_txt" href="index.php?sayfa=mesaj_mesajoku&id=<?=$id?>" title="Mesajı Oku"><font color="#D22A2A">Mesajı Oku</font></a>&nbsp;&nbsp; |&nbsp;&nbsp; <a class="form_txt" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$gonderen?>', '745', '700', 'profilpopup<?=$gonderen?>', 2, 1, 1);">Profili</a></td>
																			</tr>
																		</table>
																		</td>
																		<td width="15">&nbsp;</td>
																		<td width="65">
																		<img border="0" src="img/<?=$msjico;?>" width="65" height="60"></td>
																		<td width="15">&nbsp;</td>
																	</tr>
																</table>
																</td>
															</tr>
															<tr>
																<td>
																<img border="0" src="img/msg_kutusu_alt.gif" width="510" height="6"></td>
															</tr>
														</table>
														</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td height="13"></td>
														<td width="510" height="13"></td>
														<td height="13"></td>
													</tr>
													<?
														$i++;
														
														} // while sonu
														
														
														
														// mesajları sıfırla
														
														/*
														
														list($topmesaj) = mysql_fetch_row(mysql_query("select topmesaj from "._MX."uye where id='$uyeid'"));
														
														if($topmesaj >= 1){
														
															if($topmesaj > $i){
															
																mysql_query("update "._MX."uye set topmesaj=topmesaj-$i where id='$uyeid'");
																
															}
															else {
															
																mysql_query("update "._MX."uye set topmesaj='0' where id='$uyeid'");
															
															}
														
														}
														
														*/
														
														// buraya kadar
														
													?>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/msg_kutusu_golge.gif" height="30">
												<table border="0" id="table256" cellspacing="0" cellpadding="0">
													<tr>
														<td width="14" height="6">
														</td>
														<td height="6"></td>
														<td width="12" height="6">
														</td>
														<td height="6"></td>
													</tr>
													<tr>
														<td width="14">&nbsp;</td>
														<td>
														<p class="cc">toplam <?=$count?> 
														mesaj bulundu, <?=$sayfa?>. sayfadasınız </td>
														<td width="12">&nbsp;</td>
														<td>
														<select size="1" name="sayfa" id="sayfa" class="selectler" onChange="this.form.submit();">
														<?
															for($i = 1; $i<=$toplamsayfa; $i++){
																if($i == $sayfa) echo "<option value=$i selected>Sayfa : $i</option>";
																else echo "<option value=$i>Sayfa : $i</option>";
															}
														?>
														</select></td>
													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td background="img/alt_kapa_mor.gif" height="41">
												<table border="0" style="border-collapse: collapse" width="100%" cellpadding="0">
													<tr>
														<td width="10" height="41">&nbsp;</td>
														<td width="120">
														<table border="0" style="border-collapse: collapse" cellpadding="0">
															<tr>
																<td width="20">
																<img border="0" src="img/hepsinisec_iko_sol.gif" width="20" height="18"></td>
																<td width="6">&nbsp;</td>
																<td>
																<a class="ok_onceki_sonraki" href="javascript:hepsinisec()">
																Hepsini Seç</a></td>
															</tr>
														</table>
														</td>
														<td align="center">
														&nbsp;</td>
														<td width="80" align="right">
														<input type="image" src="img/btn_x_arsivegonder.gif" name="islem1" id="islem1" value="arsiv"></td>
														<td width="6" align="right">
														&nbsp;</td>
														<td width="63" align="right">
														<input type="image" src="img/btn_x_hemensil.gif" name="islem" id="islem" value="sil"></td>
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
											</form>
	
										<?
											} // count else sonu
										?>
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