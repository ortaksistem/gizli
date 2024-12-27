<?php
ob_start();
session_start();
include("fonksiyon.php");
if(!yonetici()){
	yonlendir("index.php");
	die();
}
define("_YONETIM", "buzzy");
$sayfa = $_GET["sayfa"];		
$sayfa = suz2($sayfa);		
if($sayfa){
	include("yonetim/".$sayfa.".php");
}
else {
	die();
}
?>