<?php

// arada bir kullan�lan fonksiyonlar


function koduret($param = 8){

	$kod = md5(rand(1,9999));
	$kod = substr($kod, 10, $param);
	return $kod; 
}
// bitti

function resmikes($source, $dest) {
	$nw = 110;
	$nh = 110;
	$stype = explode(".", $source);
	$stype = $stype[1];
    $size = getimagesize($source);
    $w = $size[0];
    $h = $size[1];
    switch($stype) {
        case 'gif':
        $simg = imagecreatefromgif($source);
        break;
        case 'jpg':
        $simg = imagecreatefromjpeg($source);
        break;
        case 'png':
        $simg = imagecreatefrompng($source);
        break;
    }
    $dimg = imagecreatetruecolor($nw, $nh);
    $wm = $w/$nw;
    $hm = $h/$nh;
    $h_height = $nh/2;
    $w_height = $nw/2;
    if($w> $h) {
        $adjusted_width = $w / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;
        imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
    } elseif(($w <$h) || ($w == $h)) {
        $adjusted_height = $h / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;
        imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
    } else {
        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
    }
    imagejpeg($dimg,$dest,100);
}
// bitti

function resmiboyutlandir($source, $dest, $nw, $nh) {
	$stype = explode(".", $source);
	$stype = $stype[1];
    $size = getimagesize($source);
    $w = $size[0];
    $h = $size[1];
    switch($stype) {
        case 'gif':
        $simg = imagecreatefromgif($source);
        break;
        case 'jpg':
        $simg = imagecreatefromjpeg($source);
        break;
        case 'png':
        $simg = imagecreatefrompng($source);
        break;
    }
    $dimg = imagecreatetruecolor($nw, $nh);
    $wm = $w/$nw;
    $hm = $h/$nh;
    $h_height = $nh/2;
    $w_height = $nw/2;
    if($w> $h) {
        $adjusted_width = $w / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;
        imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
    } elseif(($w <$h) || ($w == $h)) {
        $adjusted_height = $h / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;
        imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
    } else {
        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
    }
    imagejpeg($dimg,$dest,100);
}

function resmeyaz($eski,$yeni)
{
$resmim = imagecreatefromjpeg($eski);
if(!$resmim)
{
die("B�yle Bir Resim Yok");
}

$text = ayar("yazi");

$font = 8;

$yellow = imagecolorallocate($resmim, 255, 255, 0);
$black = imagecolorallocate($resmim, 0, 0, 0);
$width = imagesx($resmim);
$height = imagesy($resmim);
$yazilacak = ( $width - imagefontwidth($font)*strlen($text) )/2;
imagestring($resmim, $font, $yazilacak, $height/2, $text, $yellow);
imagejpeg($resmim,$yeni);
imagedestroy($resmim);
}
?>