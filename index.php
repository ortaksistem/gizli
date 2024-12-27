<?php 
// error_reporting(0);
@session_start(); 
include_once("ayarlar.php"); 
include_once("fonksiyon.php"); 
$ref = $_GET["ref"];
 $ref2 = $_SERVER["HTTP_REFERER"];
 if($ref2 and !strstr($ref2, "gizli.com.tr")){
	
	// @mysql_query("insert into "._MX."ref2 values (NULL, '".addslashes($ref2)."', '".$_SERVER["HTTP_USER_AGENT"]."', '".$_SERVER["REDIRECT_URL"]."', '".@mktime()."')");
 }
 if(strstr($ref2, "google.com")) $ref = "google.com"; 
 if($ref){ $_SESSION[_COOKIE."ref"] = $ref; } 
 $sayfa = $_GET["sayfa"]; 
 if($sayfa) {
	 /*
	 if($sayfa == "giris"){
		  if($_SESSION["masaustu"] != 1 and mobilcihazmi()){
			 yonlendir("mobil.php");
		 }
	 }
	 */
 include("sayfa/$sayfa.php"); 
 } else { 
	 if(uyeid()) {
		 /*
		 if($_SESSION["masaustu"] != 1 and mobilcihazmi()){
			 yonlendir("mobil.php");
		 }
		 */
		 include("sayfa/giris.php"); 
	 }
	 else {include("sayfa/home.php"); }
 } 

 include("inc/online.php"); 
 ?> 
