<?php
// error_reporting(0);
@session_start();
include_once("ayarlar.php");
include_once("fonksiyon.php");

/*
$ref = $_GET["ref"];
$ref2 = $_SERVER["HTTP_REFERER"];
if($ref2 and !strstr($ref2, "ypartner.net")){

    // @mysql_query("insert into "._MX."ref2 values (NULL, '".addslashes($ref2)."', '".$_SERVER["HTTP_USER_AGENT"]."', '".$_SERVER["REDIRECT_URL"]."', '".@mktime()."')");
}
if(strstr($ref2, "google.com")) $ref = "google.com";
if($ref){ $_SESSION[_COOKIE."ref"] = $ref; }
*/

function mobiltarihdon($data){

    list($gun, $ay, $yil) = explode(",", date("d,m,Y", $data));

    $aylar = array("0", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");

    if(strstr($ay, "0")) $ay = str_replace("0", "", $ay);

    $ay = $aylar[$ay];

    return "$gun $ay $yil";
}

$sayfa = $_GET["sayfa"];
if($sayfa) {
    include("mobil/$sayfa.php");
} else {
	 if(uyeid()) {

		 include("mobil/duvar.php"); 
	 }
	 else {include("sayfa/home.php"); }
}
	
	
	
include("inc/online.php");
?>
