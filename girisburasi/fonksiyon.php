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
     
     $patterns[0] = '/�'.chr(158).'/';    
     $patterns[1] = '/ş/';
     $patterns[2] = '/İ/';
     $patterns[3] = '/ı/';
     $patterns[4] = '/�'.chr(158).'/';
     $patterns[5] = '/ğ/';
     $patterns[6] = '/Ü/';
     $patterns[7] = '/ü/';
     $patterns[8] = '/Ö/';
     $patterns[9] = '/ö/';
     $patterns[10] = '/Ç/';
     $patterns[11] = '/ç/';
     

     $replacements[0] = '�'; 
     $replacements[1] = '�';
     $replacements[2] = '�';
     $replacements[3] = '�';
     $replacements[4] = '�';
     $replacements[5] = '�';
     $replacements[6] = '�';
     $replacements[7] = '�';
     $replacements[8] = '�';
     $replacements[9] = '�';
     $replacements[10] = '�';
     $replacements[11] = '�';

     
     return preg_replace($patterns, $replacements, $string);
}
// bitti

function cinsiyet($param, $param2 = NULL){

	$cinsiyet = array("", "Bayan", "�ift", "Erkek", "Lezbiyen", "Biseks�el Bayan", "Biseks�el �ift", "Biseks�el Erkek", "Transseks�el");
	
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
// bitti d�zenleyecekseniz ana dizindeki fonksiyon.php dosyas�ndakini unutmay�n



function uyeavatar($avatar, $cinsiyet){

	if(!$avatar or $avatar == 'img_uye/avatar/null.jpg') $avatar = "img_uye/$cinsiyet.gif";
	
	return $avatar;

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
// bitti

function tarihay($data){
		
	$aylar = array("0", "Ocak", "�ubat", "Mart", "Nisan", "May�s", "Haziran", "Temmuz", "A�ustos", "Eyl�l", "Ekim", "Kas�m", "Aral�k");
	
	return $aylar[$data];
}
// bitti
?>