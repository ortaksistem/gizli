<?php

session_start();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();


$listele = $_POST["listele"];

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

															
															
																$limit = 15;
																				
																$result = mysql_query("select uye, ad, cinsiyet, yas, sehir, seviyead, seviyeicon, seviyerenk from "._MX."online ".$while."order by oncelik asc limit ".(($sayfa-1)*$limit).",".$limit."");
																
																while(list($uye, $ad, $cinsiyet, $yas, $sehir, $seviyead, $seviyeicon, $seviyerenk) = @mysql_fetch_row($result)){
																
																$sehir = turkcejquery($sehir);
																
																$ad = turkcejquery($ad);
																
															
															?>
															<tr>
																<td height="30">
																<table border="0" width="100%" id="table567" cellspacing="0" cellpadding="0">
																	<tr>
																		<td width="14">
																		<img border="0" src="img/cins_ufak_<?=$cinsiyet?>.gif" width="14" height="15"></td>
																		<td width="6">&nbsp;</td>
																		<td width="33">
																		<img border="0" src="img/uyelik_ufak_<?=$seviyeicon?>.gif" width="33" height="15"></td>
																		<td width="6">&nbsp;</td>
																		<td width="10">&nbsp;</td>
																		<td width="150" height="30">
																		<p class="nickname">
																		<a class="form_txt2" href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);">
																		<font color="<?=$seviyerenk?>"><?=$ad?></font></a></td>
																		<td width="10">&nbsp;</td>
																		<td width="30" align="center">
																		<p class="yas">
																		<?=$yas?></td>
																		<td width="10">&nbsp;</td>
																		<td width="135">
																		<p class="yer">
																		<?=$sehir?></td>
																		<td width="10">&nbsp;</td>
																		<td>
																		<table border="0" width="100%" id="table603" cellspacing="0" cellpadding="0">
																			<tr>
																				<td width="16"><a href="javascript:mesajgonder(<?=$uye?>);" title="Mesaj Gonder"><img border="0" src="img/iko_16mesajat.gif" width="16" height="16"></a></td>
																				<td width="4">&nbsp;</td>
																				<td>
																				<a href="javascript:mesajgonder(<?=$uye?>);" title="Mesaj Gonder"><p class="c">Mesaj gonder</p></a></td>
																			</tr>
																		</table>
																		</td>
																	</tr>
																</table>
																</td>
															</tr>
															
															<?php
															
															} // end while
															?>
															
															