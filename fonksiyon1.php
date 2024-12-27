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

	$cinsiyet = array("", "Bayan", "Çift", "Erkek");
	
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
// bitti düzenleyecekseniz yonetim/fonksiyon.php dosyasýndakini unutmayýn

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
	
	$aylar = array("0", "Ocak", "Þubat", "Mart", "Nisan", "Mayýs", "Haziran", "Temmuz", "Aðustos", "Eylül", "Ekim", "Kasým", "Aralýk");
	
	if(strstr($ay, "0")) $ay = str_replace("0", "", $ay);
	
	$ay = $aylar[$ay];
	
	return "$gun $ay $yil";
}

function begeniler($param, $param2){

	$begeniler = array("", "Dudaklarýna Hayraným","Çok yakýþýklý","Gözlerine hayraným","Fiziðine hayraným","Kalçalarýna hayraným","Göðüslerine hayraným","Herþeyine hayraným","Çok güzel","Çok seksi","Çok karizmatik","Çok sempatik","Çok uyumlu çift","Çok güzel çift","Güzel bacaklar","Güzel ayaklar");

	
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