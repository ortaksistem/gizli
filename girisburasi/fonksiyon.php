<?php

foreach($_POST AS $key => $value) {    
   ${$key} = $value;    
}   
foreach($_GET AS $key => $value) {
   ${$key} = $value; 
}   
// bitti 

function suz($param){
	return addslashes($param);
}
// bitti

function admin(){
	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	list($sqlsifre) = mysql_fetch_row(mysql_query("select sifre from "._MX."admin where kullanici='$kullanici' and id='$id'"));
	
	if($sqlsifre){
		if($sqlsifre == $sifre) return true;
		else return false;
	}
	else {
		return false;
	}
}
// bitti

function adminid(){
	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $id;
}
// bitti

function sifreleme($param){
	return $param;
}
// bitti

function yonlendir($u) {
echo "<script language=javascript>location='".$u."'</script>";
}
// bitti

function turkce($string){
     
     $patterns[0] = '/Å'.chr(158).'/';    
     $patterns[1] = '/ÅŸ/';
     $patterns[2] = '/Ä°/';
     $patterns[3] = '/Ä±/';
     $patterns[4] = '/Ä'.chr(158).'/';
     $patterns[5] = '/ÄŸ/';
     $patterns[6] = '/Ãœ/';
     $patterns[7] = '/Ã¼/';
     $patterns[8] = '/Ã–/';
     $patterns[9] = '/Ã¶/';
     $patterns[10] = '/Ã‡/';
     $patterns[11] = '/Ã§/';
     

     $replacements[0] = 'Þ'; 
     $replacements[1] = 'þ';
     $replacements[2] = 'Ý';
     $replacements[3] = 'ý';
     $replacements[4] = 'Ð';
     $replacements[5] = 'ð';
     $replacements[6] = 'Ü';
     $replacements[7] = 'ü';
     $replacements[8] = 'Ö';
     $replacements[9] = 'ö';
     $replacements[10] = 'Ç';
     $replacements[11] = 'ç';

     
     return preg_replace($patterns, $replacements, $string);
}
// bitti

function cinsiyet($param, $param2 = NULL){

	$cinsiyet = array("", "Bayan", "Çift", "Erkek", "Lezbiyen", "Biseksüel Bayan", "Biseksüel Çift", "Biseksüel Erkek", "Transseksüel");
	
	if($param){
		return $cinsiyet[$param];
	}
	else {
		$sayi = count($cinsiyet);
		
		for($i = 1; $i<$sayi; $i++){
			if($param2 == $i) echo "<option value=\"$i\" selected>$cinsiyet[$i]</option>";
			else echo "<option value=\"$i\">$cinsiyet[$i]</option>";
		}
	}

}
// bitti düzenleyecekseniz ana dizindeki fonksiyon.php dosyasýndakini unutmayýn



function uyeavatar($avatar, $cinsiyet){

	if(!$avatar or $avatar == 'img_uye/avatar/null.jpg') $avatar = "img_uye/$cinsiyet.gif";
	
	return $avatar;

}

function turkcejquery($param){
	$param = str_replace("Ç", "&#199;", $param);
	$param = str_replace("ç", "&#231;", $param);
	$param = str_replace("Ý", "&#304;", $param);
	$param = str_replace("ý", "&#305;", $param);
	$param = str_replace("Ð", "&#286;", $param);
	$param = str_replace("ð", "&#287;", $param);
	$param = str_replace("Ö", "&#214;", $param);
	$param = str_replace("ö", "&#246;", $param);
	$param = str_replace("Ü", "&#220;", $param);
	$param = str_replace("ü", "&#252;", $param);
	$param = str_replace("Þ", "&#350;", $param);
	$param = str_replace("þ", "&#351;", $param);
	return $param;
}
// bitti

function tarihay($data){
		
	$aylar = array("0", "Ocak", "Þubat", "Mart", "Nisan", "Mayýs", "Haziran", "Temmuz", "Aðustos", "Eylül", "Ekim", "Kasým", "Aralýk");
	
	return $aylar[$data];
}
// bitti
?>