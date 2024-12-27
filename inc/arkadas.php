<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();

if($islem == "arkadassil"){
	
	$id = $_POST["id"];
	
	$arkadas =  $_POST["arkadas"];
	
	$result = mysql_query("delete from "._MX."uye_arkadas where id='$id'");
	
	if($result) die("ok");
	
	else die("hata");
	
}


if($islem == "onayla"){
	
	$id = $_POST["id"];
	
	$arkadas =  $_POST["arkadas"];
	
	$result = mysql_query("update "._MX."uye_arkadas set durum='1' where id='$id'");
	
	if($result) die("ok");
	
	else die("hata");
	
}

if($islem == "opucukler"){

    $id = $_POST["id"];


    if($id >= 1){
        $result = mysql_query("delete from " . _MX . "uye_opucuk where id='$id' and uye='$uyeid'");
    } else {
        $result = mysql_query("delete from " . _MX . "uye_opucuk where uye='$uyeid'");
    }
	
	if($result) die("ok");
	
	else die("hata");
	
}

if($islem == "cicekler"){
	
	$id = $_POST["id"];


	if($id >= 1){
        $result = mysql_query("delete from " . _MX . "uye_cicek where id='$id' and uye='$uyeid'");
    } else {
        $result = mysql_query("delete from " . _MX . "uye_cicek where uye='$uyeid'");
    }

	if($result) die("ok");
	
	else die("hata");
	
}

if($islem == "yasakli"){
	
	
	$result = mysql_query("delete from "._MX."uye_yasakli where yasaklayan='$uyeid'");
	
	if($result) die("ok");
	
	else die("hata");
	
}

if($islem == "yasaklisil"){
	
	$id = $_POST["id"];
	
	$result = mysql_query("delete from "._MX."uye_yasakli where id='$id'");
	
	if($result) die("ok");
	
	else die("hata");
	
}

if($islem == "bakanlar"){
	
	$ay = date("m");
	
	$yil = date("Y");
	
	$setle = NULL;
	
	$result = mysql_query("update "._MX."uye_hit set hit='0', hitler='$setle' where uye='$uyeid' and ay='$ay' and yil='$yil'");
	
	if($result) die("ok");
	
	else die("hata");
	
}