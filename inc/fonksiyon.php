<?php

function suz($param){
	return addslashes($param);
}
// bitti

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
?>