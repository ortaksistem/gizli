<?

if(seviyeal("online") != 1){
	yonlendir("index.php?sayfa=hata");
	die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

include("cache.php");

cache_baslat();


$uyeadi = uyeadi();

$zaman = time();

mysql_query("delete from "._MX."online where kayit < $zaman");
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Online Üyeler</title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/reset.css" type="text/css" />
<link rel="stylesheet" href="inc/online.css" type="text/css" />
<script type="text/javascript" src="inc/jquery-eski.js"></script>
<script type="text/javascript" src="inc/mahirixtooltip.js"></script>
<style type="text/css">

div.htmltooltip{
position: absolute; /*leave this and next 3 values alone*/
z-index: 1000;
left: -1000px;
top: -1000px;
background: #fff;
border: 10px solid #ececec;
color: white;
padding: 2px;
width: 150px; /*width of tooltip*/
color:#000;
font-weight:bold;
}

div.htmltooltip p {
padding:3px 0px 0px 0px;
}

</style>
</head>
<body>

<div id="ust"></div>

<!--
<div id="header">
	<div class="header">
	<ul>
		<li><a href="javascript:listele('hepsi')"><img src="img/online-hepsi.jpg" /></a></li>
		<li><a href="javascript:listele('lezbiyen')"><img src="img/online-lezbiyen.jpg" /></a></li>
		<li><a href="javascript:listele('ciftler')"><img src="img/online-ciftler.jpg" /></a></li>
		<li><a href="javascript:listele('bayan')"><img src="img/online-bayanlar.jpg" /></a></li>
		<li><a href="javascript:listele('gay')"><img src="img/online-gayler.jpg" /></a></li>
		<li><a href="javascript:listele('trans')"><img src="img/online-trans.jpg" /></a></li>
		<li><a href="javascript:listele('erkek')"><img src="img/online-erkek.jpg" /></a></li>
	</ul>
	</div>
</div>

// -->

<div id="listeust"></div>

<div id="liste">
	<div class="liste" id="listele">

<?php															
	
	$a = 1;
																														
	$result = mysql_query("select uye, ad, cinsiyet, yas, sehir, seviyead, seviyeicon, seviyerenk from "._MX."online order by cinsiyet asc, oncelik asc");
																
	while(list($uye, $ad, $cinsiyet, $yas, $sehir, $seviyead, $seviyeicon, $seviyerenk) = mysql_fetch_row($result)){
	
	if($a%17 == 0){
		
?>
	</div>
</div>
<div id="liste2">
	<div class="liste2">
<?
	
	}														
																
	list($img) = mysql_fetch_row(mysql_query("select img from "._MX."uye where id='$uye'"));
	
	$img = uyeavatar($img, $cinsiyet);
	
	if(strstr($sehir, "Istanbul")) $sehir = "Istanbul";
														
	?>
	<ul<?=$style?>>
		<li class="tur"><img src="img/cins_ufak_<?=$cinsiyet?>.gif" /> <img src="img/uyelik_ufak_<?=$seviyeicon?>.gif" width="34" height="15" /></li>
		<li class="kullanici"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);" rel="htmltooltip"><font color="<?=$seviyerenk?>"><?=$ad?></font></a></li>
		<li class="yas"><?=$yas?></li>
		<li class="sehir"><?=$sehir?></li>
		<li class="mesaj"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);" title="<?=$ad?>'ın Profiline Bak"><img src="img/online-mesajgonder.jpg" /></a></li>
		<li><div class="htmltooltip"><p align="center"><img src="<?=$img?>" width="100" /></p><p align="center"><img src="img/uye_img_<?=$seviyeicon?>.gif" /></p><p align="center"><?=$yas?> Yaşında - <?=$sehir?></p></div></li>
	</ul>
	
<?php
	
	$a++;
	
	}
?>

	</div>
</div>


<div id="sayfa">
<div class="sayfa">
<a href="javascript:void(0)" onclick="window.location.reload();"><img src="img/online-sayfa-yenile.jpg" style="padding-top:4px" /></a>
</div>
</div>

<div id="alt"></div>
</body>
</html>

<?php

cache_bitir();

?>