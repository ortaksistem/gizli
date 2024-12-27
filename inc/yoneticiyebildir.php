<?php

session_start();

$gonderen = $_POST["gonderen"];
$gonderilen = $_POST["gonderilen"];
$mesaj = $_POST["mesaj"];
$konu = $_POST["konu"];
$yer = $_POST["yer"];

if(!is_numeric($gonderen) or !is_numeric($gonderilen)) die("hata");

if($konu and $mesaj){
	
	include("../ayarlar.php");
	include("../fonksiyon.php");
	
	
	$mesaj = turkce($mesaj);
	$konu = turkce($konu);
	
	$mesaj = addslashes($mesaj);
	$konu = addslashes($konu);
	
	$zaman = time();
	
	$result = mysql_query("insert into "._MX."bildirim values(NULL, '$gonderen', '$gonderilen', '$yer', '$konu', '$mesaj', '$zaman', '1')");
	
	if($result){
		die("ok");
	}
	else {
		die("hata");
	}

}
else die("hata");

?>