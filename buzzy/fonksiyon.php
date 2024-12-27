<?php

include("ayarlar.php");

function suz($param){
	return addslashes(mysql_real_escape_string(strip_tags($_REQUEST[$param], "<(.*?)>")));
}
// bitti
function suz2($param){
	return addslashes(mysql_real_escape_string(strip_tags($param, "<(.*?)>")));
}

function uye(){
	$data = $_SESSION[_COOKIE."kullanici"];
	if($data){	
		$data = base64_decode($data);
		list($id, $kullanici, $eposta, $sifre, $seviye) = explode("||", $data); // $bilgiler = "$kid||$kadi||$keposta||$ksifre||$kseviye";	
		list($sqlusername, $sqlsifre) = mysql_fetch_row(mysql_query("select kullaniciadi, sifre from kullanici where id='$id'"));	
		if($kullanici == $sqlusername and $sifre == $sqlsifre) return true;
		else return false;	
	}
	else {
		return false;
	}
}

function yonetici(){
	$data = $_SESSION[_COOKIE."kullanici"];
	if($data){	
		$data = base64_decode($data);
		list($id, $kullanici, $eposta, $sifre, $seviye) = explode("||", $data); // $bilgiler = "$kid||$kadi||$keposta||$ksifre||$kseviye";	
		list($sqlusername, $sqlsifre, $yonetici) = mysql_fetch_row(mysql_query("select kullaniciadi, sifre, yonetici from kullanici where id='$id'"));	
		if($kullanici == $sqlusername and $sifre == $sqlsifre and $yonetici == 1) return true;
		else return false;	
	}
	else {
		return false;
	}
}

function uyebilgi($deger){
	if($deger){
		$data = $_SESSION[_COOKIE."kullanici"];
		$data = base64_decode($data);
		list($id, $kullanici, $eposta, $sifre, $seviye) = explode("||", $data); // $bilgiler = "$kid||$kadi||$keposta||$ksifre||$kseviye";	
			switch($deger){
				case "id": return $id;break;
				case "kullaniciadi": return $kullanici;break;
				case "eposta": return $eposta;break;
				case "seviye": return $seviye;break;
			}
	}
	else {
		return "buzzy";
	}
}

function yonlendir($u) {
echo "<script>window.location='".$u."'</script>";
}
// bitti
function sifrele($s){
	return base64_encode(md5(sha1($s)));
}
function turkcetarih($data){
	
	$aylar = array("", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");
	
	list($gun,$ay,$yil) = explode("-", date("d-m-Y", $data));
	
	if(substr($ay, 0, 1) == 0) $ay = str_replace("0", "", $ay);
	
	$ay = $aylar[$ay];
	
	return "$gun $ay $yil";

}

function ahrefsanaliz($url){
	
	return @file_get_contents($url."&token="._TOKEN);

}

function sayicevirici($n){
        $n = (0+str_replace(",","",$n));
        if(!is_numeric($n)) return false;
        if($n>1000000000000) return round(($n/1000000000000),1).'T';
        else if($n>1000000000) return round(($n/1000000000),1).'B';
        else if($n>1000000) return round(($n/1000000),1).'M';
        else if($n>1000) return round(($n/1000),1).'K';
        
        return number_format($n);
}

function sayicevirici2($sayi){
	$sayi = number_format($sayi, 3, ".", ",");
	$sayi = explode(".", $sayi);
	return $sayi[0];
}

function linkduzelt($data){
	
	$data = str_replace("http://", "", $data);
	$data = str_replace("www.", "", $data);
	return $data;
}

function kisaltma($data){
	
	if(strlen($data) > 40){
		$data = substr($data, 0, 40);
	}
	return $data;
}

function ahrefstarih($data){
	
	list($tarih1, $tarih2) = explode("T", $data);
	
	return $tarih1;
}

if(uye()){
	define("_UYEDURUM", 1);
	define("_UYEID", uyebilgi("id"));
} else {
	define("_UYEDURUM", NULL);
}
?>