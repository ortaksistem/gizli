<?php

session_start();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die("hata");


$listele = $_POST["listele"];

if(!$listele) die("hata");


$tur = $_POST["tur"];

switch($tur){
	case "hepsi": $while = NULL;break;
	default: $while = "where cinsiyet='$tur' ";break;
}

if($listele == "populer"){

?>
												<table border="0" cellspacing="0" cellpadding="0">
													<tr>
<?

	$ay = date("m");
	
	$yil = date("Y");
	
	if($while) $while = $while ."and uye!='' ";
	else $while = "where uye!=''";
	
	$result = mysql_query("select DISTINCT(uye), ad, sehir from "._MX."uye_oy ".$while."order by cinsiyet asc, toplampuan desc limit 12");
	
	
	$i = 1;
	
	while(list($id, $kullanici, $sehir) = mysql_fetch_row($result)){
	
	
	if($id and $kullanici){
	
	list($cinsiyet, $img, $tanitim) = mysql_fetch_row(mysql_query("select cinsiyet, img, tanitim from "._MX."uye where id='$id'"));
	
	$kullanici = turkcejquery($kullanici);
	
	$sehir = turkcejquery($sehir);
	
	$img = uyeavatar($img, $cinsiyet);
	
	$tanitim = turkcejquery(stripslashes($tanitim));
	

?>

																<td valign="top">
																<table border="0" id="table453" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="100" height="126" background="img/uyelistele_fotoarkasi.gif">
																		<table border="0" width="100%" id="table457" cellspacing="0" cellpadding="0">
																			<tr>
																				<td height="28" align="center">
																				<a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);" title="<?=$tanitim;?>"><?=$kullanici?></a></td>
																			</tr>
																			<tr>
																				<td height="70" align="center"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);" title="<?=$tanitim?>"><img border="0" src="<?=$img?>" width="70" height="70"></a></td>
																			</tr>
																			<tr>
																				<td height="28" align="center">
																				<p class="uye_small"><?=$sehir?></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="6">
																		</td>
																	</tr>
																</table>
																</td>
														<td width="18" valign="top">&nbsp;</td>
														<?php
															
															if($i%4 == 0){
														
														?>
													</tr>
													<tr>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18" valign="top">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18" valign="top">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
													</tr>
													<?php
														
														}
														$i++;
													
													?>

<?

	} // end if

	} // end while
	
?>
													</tr>
													
													<?php
														
														if($i <= 1){
															
															echo "<tr><td colspan='7' align='middle'><p align=center><b>".turkcejquery("Aradýðýnýz kriterlere uygun üye þuan bulunamamýþtýr")."</b></p><p>&nbsp;</p></td></tr>";
														
														}
													
													?>
													<tr>

													<td colspan="7" width="497" height="62" background="img/x7_zemin_uye_kategori.png" align=middle>
													
														<table border="0" cellpadding="0" cellspacing="0">
															
															<tr>
																<td><a class="c1" href="index.php?sayfa=arama_populeruyeler">Hepsi</a></td>
																<td width="30">&nbsp;</td>
																<td><a class="c1" href="javascript:listele('populer', '1')">Bayan</a></td>
																<td width="30">&nbsp;</td>
																<td><a class="c1" href="javascript:listele('populer', '3')">Erkek</a></td>
																<td width="30">&nbsp;</td>
																<td><a class="c1" href="javascript:listele('populer', '2')"><?=turkcejquery("Çift");?></a></td>
																<td width="30">&nbsp;</td>
																<td>&nbsp;</td>
																<td width="30">&nbsp;</td>

															</tr>
														</table>
													</td> 
													
													</tr>
	
												</table>
<?
} // end populer


if($listele == "yeni"){

?>
												<table border="0" cellspacing="0" cellpadding="0">
													<tr>
<?

	if($while){
		$while = $while ."and tanitimonay='1' and durum='1' and topresim>=1 ";
	}
	else {
		$while = "where tanitimonay='1' and durum='1' and topresim>=1 ";
	}
	
	$result = mysql_query("select id, kullanici, cinsiyet, sehir, img, tanitim from "._MX."uye ".$while."order by cinsiyet asc, id desc limit 12");
	
	
	$i = 1;
	
	while(list($id, $kullanici, $cinsiyet, $sehir, $img, $tanitim) = mysql_fetch_row($result)){
	
	
	$kullanici = turkcejquery($kullanici);
	
	$sehir = turkcejquery($sehir);
	
	$img = uyeavatar($img, $cinsiyet);
	

	$tanitim = turkcejquery(stripslashes($tanitim));

?>
																<td valign="top">
																<table border="0" id="table453" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="100" height="126" background="img/uyelistele_fotoarkasi.gif">
																		<table border="0" width="100%" id="table457" cellspacing="0" cellpadding="0">
																			<tr>
																				<td height="28" align="center">
																				<a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);" title="<?=$tanitim;?>"><?=$kullanici?></a></td>
																			</tr>
																			<tr>
																				<td height="70" align="center"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);" title="<?=$tanitim?>"><img border="0" src="<?=$img?>" width="70" height="70"></a></td>
																			</tr>
																			<tr>
																				<td height="28" align="center">
																				<p class="uye_small"><?=$sehir?></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="6">
																		</td>
																	</tr>
																</table>
																</td>
														<td width="18" valign="top">&nbsp;</td>
														<?php
															
															if($i%4 == 0){
														
														?>
													</tr>
													<tr>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18" valign="top">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18" valign="top">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
													</tr>
													<?php
														
														}
														$i++;
													
													?>

<?

	} // end while
	
?>
													</tr>
													<?php
														
														if($i <= 1){
															
															echo "<tr><td colspan='7' align='middle'><p align=center><b>".turkcejquery("Aradýðýnýz kriterlere uygun üye þuan bulunamamýþtýr")."</b></p><p>&nbsp;</p></td></tr>";
														
														}
													
													?>
													<tr>

													<td colspan="7" width="497" height="62" background="img/x7_zemin_uye_kategori.png" align=middle>
													
														<table border="0" cellpadding="0" cellspacing="0">
															
															<tr>
																<td><a class="c1" href="index.php?sayfa=arama_yeniuyeler">Hepsi</a></td>
																<td width="30">&nbsp;</td>
																<td><a class="c1" href="javascript:listele('yeni', '1')">Bayan</a></td>
																<td width="30">&nbsp;</td>
																<td><a class="c1" href="javascript:listele('yeni', '3')">Erkek</a></td>
																<td width="30">&nbsp;</td>
																<td><a class="c1" href="javascript:listele('yeni', '2')"><?=turkcejquery("Çift");?></a></td>
																<td width="30">&nbsp;</td>
																<td>&nbsp;</td>
																<td width="30">&nbsp;</td>

															</tr>
														</table>
													</td> 
													
													</tr>
	
												</table>
<?
} // end populer


if($listele == "hafta"){

?>
												<table border="0" cellspacing="0" cellpadding="0">
													<tr>
<?

	$hafta = date("W");
	
	$yil = date("Y");
	
	$result = mysql_query("select uye, uyead, cinsiyet, dogum, sehir, img from "._MX."uye_hafta where hafta='$hafta' and yil='$yil' and durum='1' order by cinsiyet asc limit 12");
	
	
	$i = 1;
	
	while(list($id, $kullanici, $cinsiyet, $dogum, $sehir, $img) = mysql_fetch_row($result)){
	
	
	$kullanici = turkcejquery($kullanici);
	
	$sehir = turkcejquery($sehir);
	
	$img = uyeavatar($img, $cinsiyet);
	

?>

																<td valign="top">
																<table border="0" id="table453" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="100" height="126" background="img/uyelistele_fotoarkasi.gif">
																		<table border="0" width="100%" id="table457" cellspacing="0" cellpadding="0">
																			<tr>
																				<td height="28" align="center">
																				<a class="nickname" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);" title="<?=$tanitim;?>"><?=$kullanici?></a></td>
																			</tr>
																			<tr>
																				<td height="70" align="center"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$id?>', '745', '700', 'profilpopup<?=$id?>', 2, 1, 1);" title="<?=$tanitim?>"><img border="0" src="<?=$img?>" width="70" height="70"></a></td>
																			</tr>
																			<tr>
																				<td height="28" align="center">
																				<p class="uye_small"><?=$sehir?></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																	<tr>
																		<td width="100" align="center" height="6">
																		</td>
																	</tr>
																</table>
																</td>
														<td width="18" valign="top">&nbsp;</td>
														<?php
															
															if($i%4 == 0){
														
														?>
													</tr>
													<tr>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18" valign="top">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18" valign="top">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
														<td width="18">&nbsp;</td>
														<td width="110" valign="top">&nbsp;</td>
													</tr>
													<?php
														
														}
														$i++;
													
													?>

<?

	} // end while
	
?>
													</tr>
													<?php
														
														if($i <= 1){
															
															echo "<tr><td colspan='7' align='middle'><p align=center><b>".turkcejquery("Aradýðýnýz kriterlere uygun üye þuan bulunamamýþtýr")."</b></p><p>&nbsp;</p></td></tr>";
														
														}
													
													?>
	
												</table>
<?
} // hafta
?>
