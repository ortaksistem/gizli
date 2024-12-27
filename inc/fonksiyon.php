<?php

function suz($param){
	return addslashes($param);
}
// bitti

function turkce($string){
     
     $patterns[0] = '/ล'.chr(158).'/';    
     $patterns[1] = '/ล/';
     $patterns[2] = '/ฤฐ/';
     $patterns[3] = '/ฤฑ/';
     $patterns[4] = '/ฤ'.chr(158).'/';
     $patterns[5] = '/ฤ/';
     $patterns[6] = '/ร/';
     $patterns[7] = '/รผ/';
     $patterns[8] = '/ร–/';
     $patterns[9] = '/รถ/';
     $patterns[10] = '/ร/';
     $patterns[11] = '/รง/';
     

     $replacements[0] = 'Þ'; 
     $replacements[1] = 'þ';
     $replacements[2] = 'Ý';
     $replacements[3] = 'ý';
     $replacements[4] = 'ะ';
     $replacements[5] = '๐';
     $replacements[6] = 'Ü';
     $replacements[7] = 'ü';
     $replacements[8] = 'ึ';
     $replacements[9] = '๖';
     $replacements[10] = 'ว';
     $replacements[11] = '็';

     
     return preg_replace($patterns, $replacements, $string);
}
// bitti

function turkcejquery($param){
	$param = str_replace("ว", "&#199;", $param);
	$param = str_replace("็", "&#231;", $param);
	$param = str_replace("Ý", "&#304;", $param);
	$param = str_replace("ý", "&#305;", $param);
	$param = str_replace("ะ", "&#286;", $param);
	$param = str_replace("๐", "&#287;", $param);
	$param = str_replace("ึ", "&#214;", $param);
	$param = str_replace("๖", "&#246;", $param);
	$param = str_replace("Ü", "&#220;", $param);
	$param = str_replace("ü", "&#252;", $param);
	$param = str_replace("Þ", "&#350;", $param);
	$param = str_replace("þ", "&#351;", $param);
	return $param;
}
// bitti
?>