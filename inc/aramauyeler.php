<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die("hata");

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();


if($islem == "yeniuyeler"){

$listele = $_POST["hangisi"];

$sayfa = $_POST["sayfa"];

if(!$listele){
	
	$listele = $_SESSION[_COOKIE."listele"];

}

switch($listele){
	case "bayan": $while = "where cinsiyet='1' or cinsiyet='5' "; $_SESSION[_COOKIE."listele"] = "bayan";break;
	case "lezbiyen": $while = "where cinsiyet='4' ";$_SESSION[_COOKIE."listele"] = "lezbiyen";break;
	case "erkek": $while = "where cinsiyet='3' ";$_SESSION[_COOKIE."listele"] = "erkek";break;
	case "ciftler": $while = "where cinsiyet='2' or cinsiyet='6' ";$_SESSION[_COOKIE."listele"] = "ciftler";break;
	case "gay": $while = "where cinsiyet='7' ";$_SESSION[_COOKIE."listele"] = "gay";break;
	case "trans": $while = "where cinsiyet='8' ";$_SESSION[_COOKIE."listele"] = "trans";break;
	default: $while = NULL;break;
}


	if($while){
		$while = $while ."and durum='1' ";
	}
	else {
		$while = "where durum='1' ";
	}
		
?>

														<table border="0" id="table452" cellspacing="0" cellpadding="0">
														<tr>
														<?php
															
															$limit = 16;
															
															$toplam = mysql_query("select count(id) from "._MX."uye");
															
															list($toplam) = mysql_Fetch_row($toplam);
															
															$toplamsayfa = ceil(($toplam/$limit));
															
															
															$result = mysql_query("select id, kullanici, cinsiyet, dogum, sehir, img, tanitim, seviye from "._MX."uye ".$while."order by cinsiyet asc, id desc limit ".(($sayfa-1)*$limit).",".$limit."");
															
															
															$i = 1;
															
															while(list($id, $kullanici, $cinsiyet, $dogum, $sehir, $img, $tanitim, $seviye) = mysql_fetch_row($result)){
															
															$img = uyeavatar($img, $cinsiyet);
															
															$kullanici = turkcejquery($kullanici);
															
															$sehir = turkcejquery($sehir);
															
															$tanitim = turkcejquery(stripslashes($tanitim));
															
															$yas = (date("Y")-date("Y", $dogum));
															
															list($online) = mysql_fetch_row(mysql_query("select count(uye) from "._MX."online where uye='$id'"));
															
															if($online >= 1) $online = '<p class="online">Online</p>';
															else $online = '<p class="offline">Offline</p>';
														
															$seviyead = seviye($seviye, "ad");
															
															$seviyead = turkcejquery($seviyead);
															
															$seviyerenk = seviye($seviye, "renk");
															
														?>	
																<td valign="top">
																<table border="0" id="table453" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="100" height="126" background="img/uyelistele_fotoarkasi.gif">
																		<table border="0" width="100%" id="table457" cellspacing="0" cellpadding="0">
																			<tr>
																				<td height="28" align="center">
																				<?=$online?></td>
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
																		<?=turkcejquery("Yaþýnda");?></td>
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
																?>
																
														</table>
														

<?
} // end yeniuyeler if


if($islem == "yeniuyelersayfa"){
	
$listele = $_SESSION[_COOKIE."listele"];


switch($listele){
	case "bayan": $while = "where cinsiyet='1' or cinsiyet='5'";break;
	case "lezbiyen": $while = "where cinsiyet='4'";break;
	case "erkek": $while = "where cinsiyet='3'";break;
	case "ciftler": $while = "where cinsiyet='2' or cinsiyet='6'";break;
	case "gay": $while = "where cinsiyet='7'";break;
	case "trans": $while = "where cinsiyet='8'";break;
	default: $while = NULL;break;
}

	if($while){
		$while = $while ."and durum='1' ";
	}
	else {
		$while = "where durum='1' ";
	}
	
															
															
$limit = 16;

$result = mysql_query("select count(id) from "._MX."uye ".$while."");

list($toplam) = mysql_fetch_row($result);

$toplamsayfa = ceil(($toplam/$limit));

?>
<select name="sayfa" id="sayfa" class="selectler" onChange="sayfa()">
<?
for($i = 1; $i <= $toplamsayfa; $i++) echo "<option value=$i>Sayfa : $i</option>";
?>
</select>
<?
} // end yeniuyelersayfa if


if($islem == "populeruyeler"){

$listele = $_POST["hangisi"];

$sayfa = $_POST["sayfa"];

if(!$listele){
	
	$listele = $_SESSION[_COOKIE."listele"];

}

switch($listele){
	case "bayan": $while = "and cinsiyet='1' or cinsiyet='5' "; $_SESSION[_COOKIE."listele"] = "bayan";break;
	case "lezbiyen": $while = "and cinsiyet='4' ";$_SESSION[_COOKIE."listele"] = "lezbiyen";break;
	case "erkek": $while = "and cinsiyet='3' ";$_SESSION[_COOKIE."listele"] = "erkek";break;
	case "ciftler": $while = "and cinsiyet='2' or cinsiyet='6' ";$_SESSION[_COOKIE."listele"] = "ciftler";break;
	case "gay": $while = "and cinsiyet='7' ";$_SESSION[_COOKIE."listele"] = "gay";break;
	case "trans": $while = "and cinsiyet='8' ";$_SESSION[_COOKIE."listele"] = "trans";break;
	default: $while = NULL;break;
}

?>

														<table border="0" id="table452" cellspacing="0" cellpadding="0">
														<tr>
														<?php
															
															$limit = 16;
															
															$ay = date("m");
															
															$yil = date("Y");
															
															$result = mysql_query("select uye, ad, cinsiyet, yas, sehir, toplampuan from "._MX."uye_oy where ay='$ay' and yil='$yil' ".$while."order by toplampuan desc limit ".(($sayfa-1)*$limit).",".$limit."");
															
															
															$i = 1;
															
															while(list($id, $kullanici, $cinsiyet, $dogum, $sehir, $puan) = mysql_fetch_row($result)){
															
															
															list($img, $tanitim, $seviye) = mysql_fetch_row(mysql_query("select img, tanitim, seviye from "._MX."uye where id='$id'"));
															
															$img = uyeavatar($img, $cinsiyet);
															
															$yas = (date("Y")-date("Y", $dogum));
															
															list($online) = mysql_fetch_row(mysql_query("select count(uye) from "._MX."online where uye='$id'"));
															
															if($online >= 1) $online = '<p class="online">Online</p>';
															else $online = '<p class="offline">Offline</p>';
														
															$seviyead = seviye($seviye, "ad");
															
															$seviyerenk = seviye($seviye, "renk");
															
															$tanitim = turkcejquery(stripslashes($tanitim));
															
														?>	
																<td valign="top">
																<table border="0" id="table453" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="100" height="126" background="img/uyelistele_fotoarkasi.gif">
																		<table border="0" width="100%" id="table457" cellspacing="0" cellpadding="0">
																			<tr>
																				<td height="28" align="center">
																				<?=$online?></td>
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
																		<?=turkcejquery("Yaþýnda");?></td>
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
																?>
																
														</table>
														

<?
} // end populeruyeler if


if($islem == "populeruyelersayfa"){
	
$listele = $_SESSION[_COOKIE."listele"];


switch($listele){
	case "bayan": $while = "and cinsiyet='1' or cinsiyet='5'";break;
	case "lezbiyen": $while = "and cinsiyet='4'";break;
	case "erkek": $while = "and cinsiyet='3'";break;
	case "ciftler": $while = "and cinsiyet='2' or cinsiyet='6'";break;
	case "gay": $while = "and cinsiyet='7'";break;
	case "trans": $while = "and cinsiyet='8'";break;
	default: $while = NULL;break;
}

															
															
$limit = 16;

$ay = date("m");

$yil = date("Y");

$result = mysql_query("select count(uye) from "._MX."uye_oy where ay='$ay' and yil='$yil' ".$while."");

list($toplam) = mysql_fetch_row($result);

$toplamsayfa = ceil(($toplam/$limit));

?>
<select name="sayfa" id="sayfa" class="selectler" onChange="sayfa()">
<?
for($i = 1; $i <= $toplamsayfa; $i++) echo "<option value=$i>Sayfa : $i</option>";
?>
</select>
<?
} // end populeruyelersayfa if
?>