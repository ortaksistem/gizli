<?php

include_once("../ayarlar.php");
include_once("fonksiyon.php");

function kontrolet($uye){
	
	list($bot, $durum) = mysql_fetch_row(mysql_query("select bot, durum from "._MX."uye where id='$uye'"));
	
	list($warmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_ay where uye='$uye'"));
	
	if($bot != 1 and $durum == 1 and $warmi < 1) return true;
	else return false;

}

$a = 1;

$ay = date("m");
$yil = date("Y");
if($ay <= 1){
	$ay = 12;
	$yil = $yil - 1;
}
else {
	$ay = $ay - 1;
}



for($i = 1; $i <= 8; $i++){

	$result = mysql_query("select uye from "._MX."uye_oy where cinsiyet='$i' and ay='$ay' and yil='$yil' order by toplampuan desc");

	while(list($uye) = mysql_fetch_row($result)){
	
		if(kontrolet($uye)){
			
			list($uyeid, $uyeadi, $cinsiyet) = mysql_fetch_row(mysql_query("select id, kullanici, cinsiyet from "._MX."uye where id='$uye'"));
		
			list($warmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_ay where cinsiyet='$cinsiyet' and ay='$ay' and yil='$yil'"));
			
			if($warmi < 1){
			
			list($resim) = mysql_fetch_row(mysql_query("select resim from "._MX."uye_resim where uye='$uyeid' and ana='1' and durum='1'"));
			
			if(!$resim){
				list($resim) = mysql_fetch_row(mysql_query("select resim from "._MX."uye_resim where uye='$uyeid' and durum='1' order by rand() limit 1"));
			}
			
			
			list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye_ay"));
			
			$maxid++;
			
			$uzanti = explode(".", $resim);
			
			$uzanti = $uzanti[count($uzanti)-1];
			
			
			
			@copy("../".$resim, "../img_uye/ay/$maxid.$uzanti");
			
			list($en, $boy) = getimagesize("../".$resim);
					
			if($boy > 312){
				
				@resmikes("../img_uye/ay/$maxid.$uzanti", "../img_uye/ay/$maxid.$uzanti");
				
			}	
			
			mysql_query("insert into "._MX."uye_ay values('$maxid', '$uyeid', '$uyeadi', '$cinsiyet', 'img_uye/ay/$maxid.$uzanti', '$ay', '$yil', '1')");
			
			$a++;
			
			}
			break;
		
		}
	
	
	}
	
	


}

echo $a;

function resmikes($source, $dest) {
	$nw = 450;
	$nh = 312;
	$stype = explode(".", $source);
	$stype = $stype[count($stype)-1];
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

?>