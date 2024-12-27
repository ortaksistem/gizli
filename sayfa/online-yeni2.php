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

$zaman = @mktime();

mysql_query("delete from "._MX."online where kayit < $zaman");

$saat = date("G");
$gun = date("N");
$yil = date("Y");

$varmi = @mysql_query("select id, bayan, cift, erkek, sure, durum from "._MX."online_liste_sure where saat='$saat'");

if(@mysql_num_rows($varmi) >= 1){

    list($id, $bayan, $cift, $erkek, $sure, $durum) = @mysql_fetch_row($varmi);


    if($durum != 1){

        $ekle = ($sure * 60) + $zaman;

        if($bayan >= 1){
            $cinsiyet = 1;
            $result = @mysql_query("select uye, uyeadi from "._MX."online_liste where cinsiyet='1' and gun='$gun' order by rand() limit $bayan");
            while (list($uye, $uyeadi) = @mysql_fetch_row($result)){

                list($yas, $sehir, $seviye) = @mysql_fetch_row(@mysql_query("select dogum, sehir, seviye from "._MX."uye where id='$uye'"));

                list($seviyead, $seviyeicon, $renk, $oncelik) = @mysql_fetch_row(@mysql_query("select ad, icon, renk, oncelik from "._MX."seviye where id='$seviye'"));

                $yas = $yil - date("Y", $yas);
                $uyeonceligi = $cinsiyet * $oncelik;
                @mysql_query("insert into "._MX."online values('$uye', '$uyeadi', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$uyeonceligi', '$ekle')");


            }
        } // end bayan

        if($cift >= 1){
            $cinsiyet = 2;
            $result = @mysql_query("select uye, uyeadi from "._MX."online_liste where cinsiyet='2' and gun='$gun' order by rand() limit $cift");
            while (list($uye, $uyeadi) = @mysql_fetch_row($result)){

                list($yas, $sehir, $seviye) = @mysql_fetch_row(@mysql_query("select dogum, sehir, seviye from "._MX."uye where id='$uye'"));

                list($seviyead, $seviyeicon, $renk, $oncelik) = @mysql_fetch_row(@mysql_query("select ad, icon, renk, oncelik from "._MX."seviye where id='$seviye'"));

                $yas = $yil - date("Y", $yas);
                $uyeonceligi = $cinsiyet * $oncelik;
                @mysql_query("insert into "._MX."online values('$uye', '$uyeadi', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$uyeonceligi', '$ekle')");


            }
        } // end cift

        if($erkek >= 1){
            $cinsiyet = 3;
            $result = @mysql_query("select uye, uyeadi from "._MX."online_liste where cinsiyet='3' and gun='$gun' order by rand() limit $erkek");
            while (list($uye, $uyeadi) = @mysql_fetch_row($result)){

                list($yas, $sehir, $seviye) = @mysql_fetch_row(@mysql_query("select dogum, sehir, seviye from "._MX."uye where id='$uye'"));

                list($seviyead, $seviyeicon, $renk, $oncelik) = @mysql_fetch_row(@mysql_query("select ad, icon, renk, oncelik from "._MX."seviye where id='$seviye'"));

                $yas = $yil - date("Y", $yas);
                $uyeonceligi = $cinsiyet * $oncelik;
                @mysql_query("insert into "._MX."online values('$uye', '$uyeadi', '$cinsiyet', '$yas', '$sehir', '$seviyead', '$seviyeicon', '$renk', '$uyeonceligi', '$ekle')");

            }
        } // end cift

        @mysql_query("update "._MX."online_liste_sure set durum='0'");
        @mysql_query("update "._MX."online_liste_sure set durum='1' where id='$id'");


    }
}


?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Online Üyeler</title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" type="text/css" href="inc/reset.css" />
<link rel="stylesheet" type="text/css" href="inc/style10uyeler.css" />
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
<script type="text/javascript">
	function cinsiyetlistele(deger){
		
		$("#listele ul").hide();
		
		if(deger == "hepsi") {
			$("#listele ul").show();
		}
		else {
			$(".cinsiyetimiz"+deger).show();
		}
	
	}
	
	function uyeliktipilistele(deger){
		
		$("#listele ul").hide();
		
		if(deger == "hepsi") {
			$("#listele ul").show();;
		}
		else {
			$(".turumuz"+deger).show();
		}
	
	}
</script>
</head>
<body>
<div class="genel">
	<div class="logo"><a href="#" name="yukari">Yukarý</a></div>
	<div class="filtre">
		<ul>
			<li class="filtretext">Filtre</li>
			<li class="cinsiyettext">Cinsiyet</li>
			<li class="cinsiyetselect">
				<div class="selectbox">
				<select name="uyeliktipi" id="uyeliktipi" onChange="cinsiyetlistele(this.value)">
					<option value="hepsi">Hepsi</option>
					<option value="bayan">Bayan</option>
					<option value="cift">Çift</option>
					<option value="erkek">Erkek</option>
					</select>
				</div>
			</li>
			<li class="uyeliktipitext">Üyelik Tipi</li>
			<li class="uyeliktipiselect">
				<div class="selectbox">
				<select name="uyeliktipi" id="uyeliktipi" onChange="uyeliktipilistele(this.value)">
					<option value="hepsi">Hepsi</option>
					<option value="large">Large</option>
					<option value="medium">Medium</option>
					<option value="small">Small</option>
				</select>
				</div>
			</li>
		</ul>
	</div>
	<div class="liste">
		<ul class="adlar">
			<li class="tur">&nbsp;</li>
			<li class="tur2">&nbsp;</li>
			<li class="nick">Kullanýcý Adý</li>
			<li class="yas2">Yaþ</li>
			<li class="sehir">Yaþadýðý Yer</li>
			<li class="mesaj2">&nbsp;</li>
		</ul>
	</div>
	<div class="liste" id="listele">
		<ul class="turumuzlarge cinsiyetimizerkek">
			<li class="tur erkek">&nbsp;</li>
			<li class="tur2 large">&nbsp;</li>
			<li class="nick"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=1838', '745', '700', 'profilpopup1838', 2, 1, 1);" rel="htmltooltip"><font color="#c78300"><strong>Editor</strong></font></a></li>
			<li class="yas">37</li>
			<li class="sehir">Istanbul Avrupa<li>
			<li class="mesaj"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=1838', '745', '700', 'profilpopup1838', 2, 1, 1);" title="Editor'ýn Profiline Bak">#</a></li>
			<li><div class="htmltooltip"><p align="center"><img src="img_uye/avatar/1838.jpg" width="100" /></p><p align="center"><img src="img/uye_img_large.gif" /></p><p align="center">37 Yaþýnda - Istanbul Avrupa</p></div></li>
		</ul>
<?php															
	
																														
	$result = mysql_query("select uye, ad, cinsiyet, yas, sehir, seviyead, seviyeicon, seviyerenk from "._MX."online order by cinsiyet asc, oncelik asc");
																
	while(list($uye, $ad, $cinsiyet, $yas, $sehir, $seviyead, $seviyeicon, $seviyerenk) = mysql_fetch_row($result)){
													
	
	if(strlen($yas) > 3) $yas = NULL;
	
	list($img, $seviye, $durum) = mysql_fetch_row(mysql_query("select img, seviye, durum from "._MX."uye where id='$uye'"));
	
	if($durum == 1){
	
	$img = uyeavatar($img, $cinsiyet);
	
	
	switch($cinsiyet){
		case "1":$cinsiyettur = "bayan";break;
		case "2":$cinsiyettur = "cift";break;
		case "3":$cinsiyettur = "erkek";break;
		case "4":$cinsiyettur = "lezbiyen";break;
		case "5":$cinsiyettur = "bbayan";break;
		case "6":$cinsiyettur = "bcift";break;
		case "7":$cinsiyettur = "berkek";break;
		case "8":$cinsiyettur = "trans";break;
	}
	
	switch($seviye){
		
		case "1": $seviye = "large"; break;
		case "2": $seviye = "medium"; break;
		case "3": $seviye = "small"; break;
		default:$seviye = "small"; break;
	
	}
	?>
	
		<ul class="turumuz<?=$seviye?> cinsiyetimiz<?=$cinsiyettur?>">
			<li class="tur <?=$cinsiyettur;?>">&nbsp;</li>
			<li class="tur2 <?=$seviye?>">&nbsp;</li>
			<li class="nick"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);" rel="htmltooltip"><font color="<?=$seviyerenk?>"><?=$ad?></font></a></li>
			<li class="yas"><?=$yas?></li>
			<li class="sehir"><?=$sehir?></li>
			<li class="mesaj"><a href="javascript:void(0)" onclick="pencere('index.php?sayfa=profil&id=<?=$uye?>', '745', '700', 'profilpopup<?=$uye?>', 2, 1, 1);" title="<?=$ad?>'ýn Profiline Bak">#</a></li>
			<li><div class="htmltooltip"><p align="center"><img src="<?=$img?>" width="100" /></p><p align="center"><img src="img/uye_img_<?=$seviyeicon?>.gif" /></p><p align="center"><?=$yas?> Yaþýnda - <?=$sehir?></p></div></li>
		</ul>
		
	
<?php
	
	$a++;
	
	}
	
	}
?>
	</div>
	<div class="yukari"><a href="#yukari">Yukarý</a></div>
</div>
</body>
</html>

<?php

cache_bitir();

?>