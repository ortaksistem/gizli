<?php

function smsdegistir($param){
	
	return strtr($param, "0123456789", "qwdrbyliom");

}

function smsdegistir2($param){
	
	return strtr($param, "qwdrbyliom", "0123456789");

}

function smsparcala($param){
	/*
	$degerler = array("a", "b", "c", "d", "f", "g", "h", "j", "k", "l", "z", "v", "c", "b", "n", "m", "?", ":", ".");
	
	$rand = rand(5, 10);
	
	for($i = 1; $i <= $rand; $i++){ $yeni .= $degerler[array_rand($degerler)];}
	
	$rand = rand(5, 10);
	
	for($i = 1; $i <= $rand; $i++){ $yeni2 .= $degerler[array_rand($degerler)];}
	
	return "$yeni$param$yeni2";
	*/
	return $param;
	
}

function smsparcala2($param){
	
	/*
	$deger = strtr($param, "abcdfghjklzvcbnm?:.", "!!!!!!!!!!!!!!!!!!!");
	
	return ereg_replace("!", "", $deger);
	*/
	return $param;
	
}

function smssifrele($param){
	return base64_encode(base64_encode(base64_encode(base64_encode(smsparcala(smsdegistir($param))))));
}

function smscoz($param){
	return smsdegistir2(smsparcala2(base64_decode(base64_decode(base64_decode(base64_decode($param))))));
}


?>