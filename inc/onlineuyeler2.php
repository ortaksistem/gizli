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

															
															
																$limit = 16;
																				
																$result = mysql_query("select uye, ad, cinsiyet, yas, sehir, seviyead, seviyeicon, seviyerenk from "._MX."online ".$while."order by cinsiyet asc,oncelik asc limit ".(($sayfa-1)*$limit).",".$limit."");
																
																while(list($uye, $ad, $cinsiyet, $yas, $sehir, $seviyead, $seviyeicon, $seviyerenk) = mysql_fetch_row($result)){
																
																$sehir = turkcejquery($sehir);
																
																$ad = turkcejquery($ad);
																
															
															?>
	<ul>
		<li class="tur"><img src="img/cins_ufak_<?=$cinsiyet?>.gif" /> <img src="img/uyelik_ufak_<?=$seviyeicon?>.gif" width="34" height="15" /></li>
		<li class="kullanici"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);" title="<?=$ad?>'ýn Profiline Bak"><font color="<?=$seviyerenk?>"><?=$ad?></font></a></li>
		<li class="yas"><?=$yas?></li>
		<li class="sehir"><?=$sehir?></li>
		<li class="mesaj"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);" title="<?=$ad?>'ýn Profiline Bak"><img src="img/online-mesajgonder.jpg" /></a></li>
	</ul>
															
															<?php
															
															} // end while
															?>
															
															