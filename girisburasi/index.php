<?php

error_reporting(0);
@session_start();

include_once("../ayarlar.php");
include_once("fonksiyon.php");

if(!admin()){
	include("sayfa/giris.php");
}
else {
	$sayfa = $_GET["sayfa"];
	
	if($sayfa) include("sayfa/$sayfa.php");
	else include("sayfa/home.php");
}
?>
