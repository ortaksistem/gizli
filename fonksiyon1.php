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

function ayar($param){
	$result = mysql_query("select $param from "._MX."ayarlar");
	
	$row = mysql_fetch_array($result);
	
	return $row[$param];
}
// bitti

function seviye($seviye, $param){
	
	if(!$seviye){
		list($seviye) = mysql_fetch_row(mysql_query("select seviye from "._MX."ayarlar"));
	}
	
	$result = mysql_query("select $param from "._MX."seviye where id='$seviye'");
	
	list($param) = mysql_fetch_row($result);
	
	return $param;
}
// bitti

function sifrele($param){
	
	return $param;
	
}
// bitti 

function cinsiyet($param){

	$cinsiyet = array("", "Bayan", "�ift", "Erkek");
	
	if($param){
		return $cinsiyet[$param];
	}
	else {
		$sayi = count($cinsiyet);
		
		for($i = 1; $i<$sayi; $i++){
			echo "<option value=\"$i\">$cinsiyet[$i]</option>";
		}
	}

}
// bitti d�zenleyecekseniz yonetim/fonksiyon.php dosyas�ndakini unutmay�n

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

function uyeid(){

	$data = $_SESSION[_COOKIE];
	
	if($data){
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre) = explode(";;;", $data);
	
	return $id;
	
	}
	else return false;
	
}


function uyeadi(){

	$data = $_SESSION[_COOKIE];
	
	if($data){
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre) = explode(";;;", $data);
	
	return $kullanici;
	
	}
	else return false;
	
}

function uyebilgi($param){

	$data = $_SESSION[_COOKIE];
	
	if($data){
	
	$data = base64_decode($data);
	
	$data = explode(";;;", $data);
	
		if($param == "cinsiyet"){
			return $data[3];
		}
		
		elseif($param == "dogum"){
			return $data[4];	
		}
	
		elseif($param == "sehir"){
			return $data[5];	
		}

		elseif($param == "avatar"){
			return $data[6];	
		}
			
		else {
			$uyeid = $data[0];
	
			$result = mysql_query("select $param from "._MX."uye where id='$uyeid'");
			
			list($param) = mysql_fetch_row($result);
			
			return $param;
			
		}
	
	}
	else return false;
	
}

function uyeavatar($avatar, $cinsiyet){

	if(!$avatar or $avatar == 'img_uye/avatar/null.jpg') $avatar = "img_uye/$cinsiyet.gif";
	
	return $avatar;

}

function seviyeal($param){
	
	$data = $_SESSION[_COOKIE."seviye"];
	
	if($data){
		
		preg_match('#!'.$param.'=(.*?)&#si', $data, $seviye);
		
		if($seviye[1]){
			return $seviye[1];
		}
		else {
			return 0;
		}
		
	}
	else return false;

}
function tarihdon($data){
	
	list($gun, $ay, $yil) = explode(",", date("d,m,Y", $data));
	
	$aylar = array("0", "Ocak", "�ubat", "Mart", "Nisan", "May�s", "Haziran", "Temmuz", "A�ustos", "Eyl�l", "Ekim", "Kas�m", "Aral�k");
	
	if(strstr($ay, "0")) $ay = str_replace("0", "", $ay);
	
	$ay = $aylar[$ay];
	
	return "$gun $ay $yil";
}

function begeniler($param, $param2){

	$begeniler = array("", "Dudaklar�na Hayran�m","�ok yak���kl�","G�zlerine hayran�m","Fizi�ine hayran�m","Kal�alar�na hayran�m","G���slerine hayran�m","Her�eyine hayran�m","�ok g�zel","�ok seksi","�ok karizmatik","�ok sempatik","�ok uyumlu �ift","�ok g�zel �ift","G�zel bacaklar","G�zel ayaklar");

	
	if($param2 == "say"){
		return count($begeniler);
	}
	else {
		if($param){
			return $begeniler[$param];
		}
		else {
			$sayi = count($begeniler);
			
			for($i = 1; $i<$sayi; $i++){
				echo "<option value=\"$i\">$begeniler[$i]</option>";
			}
		}
	}

}
function mobilcihazmi() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
  }

function yonlendir($u) {
echo "<script language=javascript>location='".$u."'</script>";
}
// bitti
?>