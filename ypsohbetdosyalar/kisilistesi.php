<?php

session_start();

function turkceyecevir($param){
	$param = strtr($param,"����������i��?%","USCIGOuoscigi,,");
	$param = str_replace(' ', '_', $param);
	return $param;
}
function turkcejquery($param){
	$param = str_replace("�", "&#199;", $param);
	$param = str_replace("�", "&#231;", $param);
	$param = str_replace("�", "&#304;", $param);
	$param = str_replace("�", "&#305;", $param);
	$param = str_replace("�", "&#286;", $param);
	$param = str_replace("�", "&#287;", $param);
	$param = str_replace("�", "&#214;", $param);
	$param = str_replace("�", "&#246;", $param);
	$param = str_replace("�", "&#220;", $param);
	$param = str_replace("�", "&#252;", $param);
	$param = str_replace("�", "&#350;", $param);
	$param = str_replace("�", "&#351;", $param);
	return $param;
}

$seviye = $_POST["seviye"];

if($seviye == 3){

	die(turkcejquery("Sevgili �yemiz sohbette ki�i listesini sadece <font color=red><b>Large</b></font> ve <font color=blue><b>Medium</b></font> �yelerimiz g�rebilmektedir. Large ve medium �yelerimiz size yazmad�k�a sohbeti kullanamazs�n�z. Sizde �yeli�inizi y�kseltip bu hizmetten s�n�rs�z faydalanabilirsiniz. <br /><br /><a href='index.php?sayfa=uyelik_yukselt'>�yeli�inizi y�kseltmek i�in t�klay�n�z.</a>"));

}
// bitti
$dosya = fopen("kisiler.log","r");

while(!feof($dosya))
{
$kisiler .= fgets($dosya, 255);

}

fclose($dosya);

$arkadaslarim = $_SESSION["mahirixarkadaslikarkadas"];

$kisimiz = NULL;

if($arkadaslarim){
/*
78937|charisman|29|Edirne|Small|black|||12360|ebrusamet|26|Ankara|Large|red|||
*/

$kisiler = explode("|||", $kisiler);

list($batucinsiyet, $batuseviye) = explode('|', $_SESSION["mahirixarkadasliksohbetdata"]);

$online = 0;
foreach($kisiler as $kisi){
	
	list($kisiid, $kisidurum, $kisiadi, $kisiyasi, $kisicinsiyet, $kisiimg, $kisisehri, $kisiseviye, $kisiseviyerenk) = explode("|", $kisi);
	
	if(strstr($arkadaslarim, $kisiid."|")){
		
		if($kisidurum  == 1) {
			$kisidurum2 = "<img src='ypsohbetdosyalar/ypsohbeton.jpg' />";
			$onclick = "onclick=\"chatWith('".turkceyecevir($kisiadi)."', '$batucinsiyet', '$batuseviye', '$kisicinsiyet', '$kisiseviye');\" ";
			$title = turkcejquery("$kisisehri, $kisicinsiyet, $kisiyasi ya��nda, $kisiseviye");
		}
		else {
			$kisidurum2 = "<img src='ypsohbetdosyalar/ypsohbetoff.jpg' />";
			$onclick = NULL;
			$title = turkcejquery("�yemiz sohbette �.d���d�r");
		}
		if($kisiid){
			$kisimiz .= "<a class='aadi' href='javascript:void(0)' ".$onclick."title='$title'><span class='sohbetavatar'><img src='$kisiimg' width='30' height='30' /></span><span class='sohbetisim'><font color='$kisiseviyerenk'>$kisiadi</font></span><span class='sohbetdurum'>$kisidurum2</span></a>";
			$online++;
		}
	}

}

}
/*
$arkadaslarim = explode("|", $arkadaslarim);

foreach($arkadaslarim as $arkadas){
	
	$arkadas = trim($arkadas);
	if($arkadas){
	
		preg_match('#'.$arkadas.'\|(.*?)\|#si', $kisiler, $aktar);
		
		if($aktar[1]){
			$kisimiz .= "<a href='javascript:void(0)' onclick=\"chatWith('".$aktar[1]."')\"><font color=='".$aktar[5]."'>".$aktar[1]."</font></a><br />";
		}
	
	}

}
}
*/

if(!$kisimiz) $kisimiz = "Online arkadasiniz bulunmamaktadir";

echo $kisimiz;

echo '<script language="javascript" type="text/javascript">window.top.window.sohbetonlinekisi(\''.$online.'\');</script>';
die();
?>