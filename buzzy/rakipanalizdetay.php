<?php
ob_start();
session_start();
include("fonksiyon.php");

$id = $_GET["id"];

if(!is_numeric($id)) die("gotogo");

if(_UYEDURUM != 1) yonlendir("index.php");

$result = @mysql_query("select kelime, site, siteler, guncelleme, kayit from rakip where id='$id' and uye='"._UYEID."'");

if(@mysql_num_rows($result) < 1) yonlendir("index.php");

list($kelime, $site, $siteler, $songuncelleme, $kayit) = @mysql_fetch_row($result);

$kelime = stripslashes($kelime);
$site = stripslashes($site);
$siteler = stripslashes($siteler);
$kelime22 = $kelime;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$kelime?> hedef kelimesi <?=$site?> analizi sonuçları</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link href="Assets/Css/reset.css" rel="stylesheet" />
    <link href="Assets/Css/flexslider.css" rel="stylesheet" />
    <link href="Assets/Css/font-awesome.min.css" rel="stylesheet" />
    <link href="Assets/Css/main.css" rel="stylesheet" />
	<base href="<?=_URL?>" />
</head>
<body>
<?php include("header.php"); ?>

    <div class="whitebg">
        <div class="container">
					<?php
					
					
					
					$anaarray = @mysql_fetch_array(@mysql_query("select * from rakip_log where rakip='$id' and uye='"._UYEID."' and site='$site' order by id desc limit 1"));
					
					list($toplambacklink, $toplamref) = @mysql_fetch_row(@mysql_query("select sum(backlinks), sum(refpages) from rakip_log where rakip='$id' and uye='"._UYEID."'"));
					
					$refbirim = $toplamref / 100;
					
					$backbirim = $toplambacklink / 100;
					
					$sitelerli = NULL;
					
					$keltoslarli = NULL;
					
					$siteler = explode("|", $siteler);
						rsort($siteler);
						foreach($siteler as $sit){
							
							$sit = trim($sit);
							
							$sorgula = @mysql_query("select * from rakip_log where rakip='$id' and uye='"._UYEID."' and site='$sit' order by id desc limit 1");
							
							$array = @mysql_fetch_array($sorgula);
							
							
							$siteadi = $array["site"];
							
							$siteid = $array["id"];
							
							if($siteid){
								
								if($anaarray["backlinks"] >= 1 and $array["backlinks"] >= 1){
									$b1 = sayicevirici2($array["backlinks"]);
									if($anaarray["backlinks"] > $array["backlinks"]){
										$b2 = 2;
									}
									else if($array["backlinks"] > $anaarray["backlinks"]){
										$b2 = 1;
									}
									else {
										$b2 = 3;
									}
								} else {
									$b1 = 0;
									$b2 = 0;
								}
								
								if($anaarray["refpages"] >= 1 and $array["refpages"] >= 1){
									$b3 = sayicevirici($array["refpages"]);
									if($anaarray["refpages"] > $array["refpages"]){
										$b4 = 2;
									}
									else if($array["refpages"] > $anaarray["refpages"]){
										$b4 = 1;
									}
									else {
										$b4 = 3;
									}
								}else {
									$b3 = 0;
									$b4 = 0;
								}

								if($anaarray["refdomains"] >= 1 and $array["refdomains"] >= 1){
									$b5 = sayicevirici($array["refdomains"]);
									if($anaarray["refdomains"] > $array["refdomains"]){
										$b6 = 2;
									}
									else if($array["refdomains"] > $anaarray["refdomains"]){
										$b6 = 1;
									}
									else {
										$b6 = 3;
									}
								}else {
									$b5 = 0;
									$b6 = 0;
								}								

								if($anaarray["refips"] >= 1 and $array["refips"] >= 1){
									$b7 = sayicevirici($array["refips"]);
									if($anaarray["refips"] > $array["refips"]){
										$b8 = 2;
									}
									else if($array["refips"] > $anaarray["refips"]){
										$b8 = 1;
									}
									else {
										$b8 = 3;
									}
								}else {
									$b7 = 0;
									$b8 = 0;
								}	

								if($anaarray["pages"] >= 1 and $array["pages"] >= 1){
									$b9 = sayicevirici2($array["pages"]);
									if($anaarray["pages"] > $array["pages"]){
										$b10 = 2;
									}
									else if($array["pages"] > $anaarray["pages"]){
										$b10 = 1;
									}
									else {
										$b10 = 3;
									}
								}else {
									$b9 = 0;
									$b10 = 0;
								}	

								if($anaarray["kbacklinks"] >= 1 and $array["kbacklinks"] >= 1){
									$b11 = sayicevirici2($array["kbacklinks"]);
									if($anaarray["kbacklinks"] > $array["kbacklinks"]){
										$b12 = 2;
									}
									else if($array["kbacklinks"] > $anaarray["kbacklinks"]){
										$b12 = 1;
									}
									else {
										$b12 = 3;
									}
								}else {
									$b11 = 0;
									$b12 = 0;
								}	

								if($anaarray["krefpages"] >= 1 and $array["krefpages"] >= 1){
									$b13 = sayicevirici2($array["krefpages"]);
									if($anaarray["krefpages"] > $array["krefpages"]){
										$b14 = 2;
									}
									else if($array["krefpages"] > $anaarray["krefpages"]){
										$b14 = 1;
									}
									else {
										$b14 = 3;
									}
								}else {
									$b13 = 0;
									$b14 = 0;
								}	

								if($anaarray["krefdomains"] >= 1 and $array["krefdomains"] >= 1){
									$b15 = sayicevirici2($array["krefdomains"]);
									if($anaarray["krefdomains"] > $array["krefdomains"]){
										$b16 = 2;
									}
									else if($array["krefdomains"] > $anaarray["krefdomains"]){
										$b16 = 1;
									}
									else {
										$b16 = 3;
									}
								}else {
									$b15 = 0;
									$b16 = 0;
								}	

								if($array["fb_share"] >= 1){
									$b17 = $array["fb_share"];
									if($anaarray["fb_share"] > $array["fb_share"]){
										$b18 = 2;
									}
									else if($array["fb_share"] > $anaarray["fb_share"]){
										$b18 = 1;
									}
									else {
										$b18 = 3;
									}
								}else {
									$b17 = 0;
									$b18 = 0;
								}	

								if($array["fb_like"] >= 1){
									$b19 = $array["fb_like"];
									if($anaarray["fb_like"] > $array["fb_like"]){
										$b20 = 2;
									}
									else if($array["fb_like"] > $anaarray["fb_like"]){
										$b20 = 1;
									}
									else {
										$b20 = 3;
									}
								}else {
									$b19 = 0;
									$b20 = 0;
								}	

								if($array["twitter"] >= 1){
									$b21 = sayicevirici2($array["twitter"]);
									if($anaarray["twitter"] > $array["twitter"]){
										$b22 = 2;
									}
									else if($array["twitter"] > $anaarray["twitter"]){
										$b22 = 1;
									}
									else {
										$b22 = 3;
									}
								}else {
									$b21 = 0;
									$b22 = 0;
								}	

								if($array["google"] >= 1){
									$b23 = sayicevirici2($array["google"]);
									if($anaarray["google"] > $array["google"]){
										$b24 = 2;
									}
									else if($array["google"] > $anaarray["google"]){
										$b24 = 1;
									}
									else {
										$b24 = 3;
									}
								}else {
									$b23 = 0;
									$b24 = 0;
								}	

								if($anaarray["linked_root_domains"] >= 1 and $array["linked_root_domains"] >= 1){
									$b25 = sayicevirici($array["linked_root_domains"]);
									if($anaarray["linked_root_domains"] > $array["linked_root_domains"]){
										$b26 = 2;
									}
									else if($array["linked_root_domains"] > $anaarray["linked_root_domains"]){
										$b26 = 1;
									}
									else {
										$b26 = 3;
									}
								}else {
									$b25 = 0;
									$b26 = 0;
								}	

								if($anaarray["text"] >= 1 and $array["text"] >= 1){
									$b27 = sayicevirici($array["text"]);
									if($anaarray["text"] > $array["text"]){
										$b28 = 2;
									}
									else if($array["text"] > $anaarray["text"]){
										$b28 = 1;
									}
									else {
										$b28 = 3;
									}
								}else {
									$b27 = 0;
									$b28 = 0;
								}	

								if($anaarray["image"] >= 1 and $array["image"] >= 1){
									$b29 = sayicevirici($array["image"]);
									if($anaarray["image"] > $array["image"]){
										$b30 = 2;
									}
									else if($array["image"] > $anaarray["image"]){
										$b30 = 1;
									}
									else {
										$b30 = 3;
									}
								}else {
									$b29 = 0;
									$b30 = 0;
								}	

								if($anaarray["sitewide"] >= 1 and $array["sitewide"] >= 1){
									$b31 = sayicevirici2($array["sitewide"]);
									if($anaarray["sitewide"] > $array["sitewide"]){
										$b32 = 2;
									}
									else if($array["sitewide"] > $anaarray["sitewide"]){
										$b32 = 1;
									}
									else {
										$b32 = 3;
									}
								}else {
									$b31 = 0;
									$b32 = 0;
								}	

								if($anaarray["not_sitewide"] >= 1 and $array["not_sitewide"] >= 1){
									$b33 = sayicevirici2($array["not_sitewide"]);
									if($anaarray["not_sitewide"] > $array["not_sitewide"]){
										$b34 = 2;
									}
									else if($array["not_sitewide"] > $anaarray["not_sitewide"]){
										$b34 = 1;
									}
									else {
										$b34 = 3;
									}
								}else {
									$b33 = 0;
									$b34 = 0;
								}	

								if($anaarray["nofollow"] >= 1 and $array["nofollow"] >= 1){
									$b35 = sayicevirici2($array["nofollow"]);
									if($anaarray["nofollow"] > $array["nofollow"]){
										$b36 = 2;
									}
									else if($array["nofollow"] > $anaarray["nofollow"]){
										$b36 = 1;
									}
									else {
										$b36 = 3;
									}
								}else {
									$b35 = 0;
									$b36 = 0;
								}	

								if($anaarray["dofollow"] >= 1 and $array["dofollow"] >= 1){
									$b37 = sayicevirici2($array["dofollow"]);
									if($anaarray["dofollow"] > $array["dofollow"]){
										$b38 = 2;
									}
									else if($array["dofollow"] > $anaarray["dofollow"]){
										$b38 = 1;
									}
									else {
										$b38 = 3;
									}
								}else {
									$b37 = 0;
									$b38 = 0;
								}	

								if($anaarray["redirect"] >= 1 and $array["redirect"] >= 1){
									$b39 = sayicevirici2($array["redirect"]);
									if($anaarray["redirect"] > $array["redirect"]){
										$b40 = 2;
									}
									else if($array["redirect"] > $anaarray["redirect"]){
										$b40 = 1;
									}
									else {
										$b40 = 3;
									}
								}else {
									$b39 = 0;
									$b40 = 0;
								}

								if($anaarray["canonical"] >= 1 and $array["canonical"] >= 1){
									$b41 = sayicevirici2($array["canonical"]);
									if($anaarray["canonical"] > $array["canonical"]){
										$b42 = 2;
									}
									else if($array["canonical"] > $anaarray["canonical"]){
										$b42 = 1;
									}
									else {
										$b42 = 3;
									}
								}else {
									$b41 = 0;
									$b42 = 0;
								}
								
								if($anaarray["gov"] >= 1 and $array["gov"] >= 1){
									$b43 = sayicevirici($array["gov"]);
									if($anaarray["gov"] > $array["gov"]){
										$b44 = 2;
									}
									else if($array["gov"] > $anaarray["gov"]){
										$b44 = 1;
									}
									else {
										$b44 = 3;
									}
								}else {
									$b43 = 0;
									$b44 = 0;
								}
								
								if($anaarray["edu"] >= 1 and $array["edu"] >= 1){
									$b45 = sayicevirici($array["edu"]);
									if($anaarray["edu"] > $array["edu"]){
										$b46 = 2;
									}
									else if($array["edu"] > $anaarray["edu"]){
										$b46 = 1;
									}
									else {
										$b46 = 3;
									}
								}else {
									$b45 = 0;
									$b46 = 0;
								}
								
								if($anaarray["rss"] >= 1 and $array["rss"] >= 1){
									$b47 = sayicevirici2($array["rss"]);
									if($anaarray["rss"] > $array["rss"]){
										$b48 = 2;
									}
									else if($array["rss"] > $anaarray["rss"]){
										$b48 = 1;
									}
									else {
										$b48 = 3;
									}
								}else {
									$b47 = 0;
									$b48 = 0;
								}
								
								if($anaarray["alternate"] >= 1 and $array["alternate"] >= 1){
									$b49 = sayicevirici2($array["alternate"]);
									if($anaarray["alternate"] > $array["alternate"]){
										$b50 = 2;
									}
									else if($array["alternate"] > $anaarray["alternate"]){
										$b50 = 1;
									}
									else {
										$b50 = 3;
									}
								}else {
									$b49 = 0;
									$b50 = 0;
								}
								
								if($anaarray["html_pages"] >= 1 and $array["html_pages"] >= 1){
									$b51 = sayicevirici($array["html_pages"]);
									if($anaarray["html_pages"] > $array["html_pages"]){
										$b52 = 2;
									}
									else if($array["html_pages"] > $anaarray["html_pages"]){
										$b52 = 1;
									}
									else {
										$b52 = 3;
									}
								}else {
									$b51 = 0;
									$b52 = 0;
								}
								
								if($anaarray["links_internal"] >= 1 and $array["links_internal"] >= 1){
									$b53 = sayicevirici($array["links_internal"]);
									if($anaarray["links_internal"] > $array["links_internal"]){
										$b54 = 2;
									}
									else if($array["links_internal"] > $anaarray["links_internal"]){
										$b54 = 1;
									}
									else {
										$b54 = 3;
									}
								}else {
									$b53 = 0;
									$b54 = 0;
								}
								
								if($anaarray["links_external"] >= 1 and $array["links_external"] >= 1){
									$b55 = sayicevirici($array["links_external"]);
									if($anaarray["links_external"] > $array["links_external"]){
										$b56 = 2;
									}
									else if($array["links_external"] > $anaarray["links_external"]){
										$b56 = 1;
									}
									else {
										$b56 = 3;
									}
								}else {
									$b55 = 0;
									$b56 = 0;
								}
								
								if($anaarray["refclass_c"] >= 1 and $array["refclass_c"] >= 1){
									$b57 = sayicevirici2($array["refclass_c"]);
									if($anaarray["refclass_c"] > $array["refclass_c"]){
										$b58 = 2;
									}
									else if($array["refclass_c"] > $anaarray["refclass_c"]){
										$b58 = 1;
									}
									else {
										$b58 = 3;
									}
								}else {
									$b57 = 0;
									$b58 = 0;
								}

								if($anaarray["rank"] >= 1 and $array["rank"] >= 1){
									$b59 = $array["rank"];
									if($anaarray["rank"] > $array["rank"]){
										$b60 = 2;
									}
									else if($array["rank"] > $anaarray["rank"]){
										$b60 = 1;
									}
									else {
										$b60 = 3;
									}
								}else {
									$b59 = 0;
									$b60 = 0;
								}
								
								
								$b61 = sayicevirici2(($b17+$b19));
								
								
								$kelimeler = stripslashes($array["kelimeler"]);
								
								if($kelimeler){
								$kelimeler = explode("|||", $kelimeler);
								
								$i = 1;
								
								$birim = $array["backlinks"]/100;
								
								$keltoslarli .= "<ul id='siteli$siteid' style='display:none'>";
								
								foreach($kelimeler as $kelime){
									if($i > 8) break;
									list($kelime, $backlink, $refpage, $refdomain) = explode("||", $kelime);
									
									if($kelime){
									if($i%2 == 0) $class="sari";
									else $class="mavi";
									
									$title = $kelime;
									if(strlen($kelime)>30)$kelime=substr($kelime,0,30) ." ..";
									
									$yuzde = $backlink/$birim;
									
									$yuzde = floor($yuzde);
									
									
									if($yuzde < 1) $yuzde = 1;
									
									$width = $yuzde*2;
									
									$keltoslarli .= '<li>'.$kelime.'<span><a href="javascript:void(0)" title="'.$title.'" class="'.$class.'" style="width:'.$width.'px;text-indent:'.($width+10).'px;">%'.$yuzde.'</a></span>';
									
									$i++;
									}
								}
									
									
									$keltoslarli .= "</ul>";
								
								}
								else {
									$keltoslarli .= "<ul id='siteli$siteid' style='display:none'><p align=center style='width:233px;height:250px;'><b><br />Kelime bulunmuyor</b></p></ul>";
								}
								
								
								$refyuzde1 = $array["refpages"]/$refbirim;
								
								$refyuzde1 = floor($refyuzde1);
								
								
								$refwidth1 = floor($refyuzde1 * 1.65);
								
								if(!$refyuzde1) $refyuzde1 = 0;
								if(!$refwidth1) $refwidth1 = 10;
								
								if(strlen($siteadi)>=50){
									$siteadi = substr($siteadi, 0,50) ." ..";
								}
								
								$sitelerli .= "<li><a href='javascript:void(0)' onclick=\"istatistikgetir($siteid, '$b1', '$b2', '$b3', '$b4', '$b5', '$b6', '$b7', '$b8', '$b9', '$b10', '$b11', '$b12', '$b13', '$b14', '$b15', '$b16', '$b17', '$b18', '$b19', '$b20', '$b21', '$b22', '$b23', '$b24', '$b25', '$b26', '$b27', '$b28', '$b29', '$b30', '$b31', '$b32', '$b33', '$b34', '$b35', '$b36', '$b37', '$b38', '$b39', '$b40', '$b41', '$b42', '$b43', '$b44', '$b45', '$b46', '$b47', '$b48', '$b49', '$b50', '$b51', '$b52', '$b53', '$b54', '$b55', '$b56', '$b57', '$b58', '$b59', '$b60', '$b61', '$refyuzde1', '$refwidth1')\">$siteadi</a></li>";
								
							}
							
						}
						
						/*
				$backlinks = $don->metrics->backlinks;
				$refpages = $don->metrics->refpages;
				$pages = $don->metrics->pages;
				$text = $don->metrics->text;
				$image = $don->metrics->image;
				$sitewide = $don->metrics->sitewide;
				$not_sitewide = $don->metrics->not_sitewide;
				$nofollow = $don->metrics->nofollow;
				$dofollow = $don->metrics->dofollow;
				$redirect = $don->metrics->redirect;
				$canonical = $don->metrics->canonical;
				$gov = $don->metrics->gov;
				$edu = $don->metrics->edu;
				$rss = $don->metrics->rss;
				$alternate = $don->metrics->alternate;
				$html_pages = $don->metrics->html_pages;
				$links_internal = $don->metrics->links_internal;
				$links_external = $don->metrics->links_external;
				$refdomains = $don->metrics->refdomains;
				$refclass_c = $don->metrics->refclass_c;
				$refips = $don->metrics->refips;
				$linked_root_domains = $don->metrics->linked_root_domains;
						*/
									
					?>
					
 			<div class="rakipanaliz">
				<div class="ust"><img src="Assets/Img/rakipanaliz-icon1.png" /><span><?=$kelime22?> kelimesi, <?=$site?> sitesi Analiz Sonuçları</span></div>
				
				<div class="icerik">
					
					<div class="back1">
						<span class="baslik">Siz</span>
						<span class="analiz"><?=sayicevirici2($anaarray["backlinks"]);?> Backlink</span>
						<span class="ok">&nbsp;</span>
					</div>
					
					<div class="back2">
						<span class="baslik">Rakip</span>
						<span class="analiz" id="a1"><?=$b1?> Backlink</span>
						<span class="ok"><img src="Assets/Img/rakiptakip-ok2.png" /></span>
					</div>
					
					<div class="ref1">
						<?php
							
							$refyuzde = $anaarray["refpages"]/$refbirim;
							
							$refyuzde = floor($refyuzde);
							
							$refwidth = floor($refyuzde * 1.65);
						?>
						<span class="refyuzde">%<?=$refyuzde?></span>
						<span class="referanssayi">Referans Sayfalar : <?=sayicevirici($anaarray["refpages"]);?></span>
						<span class="referansisaret1" style="width:<?=$refwidth?>px;">&nbsp;</span>
					</div>

					<div class="ref2">
						<span class="refyuzde" id="r1">%<?=$refyuzde1?></span>
						<span class="referanssayi" id="r2">Referans Sayfalar : <?=$b3?></span>
						<span class="referansisaret2" id="r3" style="width:<?=$refwidth1?>px;">&nbsp;</span>
					</div>					
					<div class="rank1">
						<span class="baslik">Siz</span>
						<span class="analiz">Domain Rank<br /><br /><?=sayicevirici2($anaarray["rank"]);?> %</span>
					</div>
					<div class="rank2" style="background:url('Assets/Img/rakiptakip-rank.png') no-repeat;">
						<span class="baslik">Rakip</span>
						<span class="analiz" id="a2">Domain Rank<br /><br /><?=$b59?> %</span>
					</div>
					
					<div class="siteler">
						<div class="rakipekle">
							<div class="title"><p>Yeni Site Ekle</p></div>
							<form action="javascript:void(0)" method="post" name="rakipekleform">
							<ul>
								<li><textarea name="siteler" placeholder="Takip edilmesini istediğiniz siteleri giriniz. Aralarına virgül koyarak çoklu ekleme yapabilirsiniz. En fazla 10 site ekleyebilirsiniz. Sistem 10 siteden sonra ekleme yapmayacaktır."></textarea></li>
								<li><input type="submit" onclick="rakipekle(<?=$id?>)" value=" Ekle " class="buttons" /></li>
								<li class="sonuc">- Analizler yapılacağından işlem uzun sürebilir. <br />- Max 10 site eklenebilir. <br />- 10 siteden sonra sorgulama yapılmayacaktır.</li>
							</ul>
							</form>
						</div>
						<div class="baslik"><a href="javascript:void(0)" onclick="rakipeklekapat()">Yeni Site Ekle</a></div>
						<ul class="sitelist"><?=$sitelerli?></ul>
						<div class="alt"></div>
					</div>
				</div>
				
				<div class="ust"><img src="Assets/Img/rakipanaliz-icon2.png" /><span>Hedef Kelime Dağılımları</span></div>
				
					<div class="kelime">
						<div class="sag">
							<ul>
							<?php
								
								$kelimeler = stripslashes($anaarray["kelimeler"]);
								
								$kelimeler = explode("|||", $kelimeler);
								
								$i = 1;
								
								$birim = $anaarray["backlinks"]/100;
								
								foreach($kelimeler as $kelime){
									if($i > 8) break;
									list($kelime, $backlink, $refpage, $refdomain) = explode("||", $kelime);
									if($kelime){
									if($i%2 == 0) $class="mavi";
									else $class="sari";
									
									$title = $kelime;
									if(strlen($kelime)>30)$kelime=substr($kelime,0,30) ." ..";
									
									$yuzde = $backlink/$birim;
									
									$yuzde = floor($yuzde);
									
									
									
									if($yuzde < 1) $yuzde = 1;
									
									$width = $yuzde*2;
									?>
									<li><?=$kelime;?><span><a href="javascript:void(0)" title="<?=$title?>" class="<?=$class;?>" style="width:<?=$width;?>px;text-indent:<?=($width+10);?>px;">%<?=$yuzde;?></a></span></li>
									<?php
									
									$i++;
									}
									
								
								}
							
							?>
							</ul>
						</div>
						<div class="sol">
							<?=$keltoslarli?>
						</div>
						
						<div class="diger">
							<div class="baslik">&nbsp;</div>
							<ul>
								<li><span class="text">Referans Sayfalar</span><span class="deger1"><?=sayicevirici($anaarray["refpages"]);?></span><span class="deger2" id="b1"><?=$b3?></span><span class="ok" id="c1"><img src="Assets/Img/ok<?=$b4?>.png" /></span></li>
								<li><span class="text">Referans Domain</span><span class="deger1"><?=sayicevirici($anaarray["refdomains"]);?></span><span class="deger2" id="b2"><?=$b5?></span><span class="ok" id="c2"><img src="Assets/Img/ok<?=$b6?>.png" /></span></li>
								<li><span class="text">Referans Ipler</span><span class="deger1"><?=sayicevirici($anaarray["refips"]);?></span><span class="deger2" id="b3"><?=$b7?></span><span class="ok" id="c3"><img src="Assets/Img/ok<?=$b8?>.png" /></span></li>
								<li><span class="text">Linked Root Domain</span><span class="deger1"><?=sayicevirici($anaarray["linked_root_domains"]);?></span><span class="deger2" id="b4"><?=$b25?></span><span class="ok" id="c4"><img src="Assets/Img/ok<?=$b26?>.png" /></span></li>
								<li><span class="text">Text Link</span><span class="deger1"><?=sayicevirici($anaarray["text"]);?></span><span class="deger2" id="b5"><?=$b27?></span><span class="ok" id="c5"><img src="Assets/Img/ok<?=$b28?>.png" /></span></li>
								<li><span class="text">Resim Link</span><span class="deger1"><?=sayicevirici($anaarray["image"]);?></span><span class="deger2" id="b6"><?=$b29?></span><span class="ok" id="c6"><img src="Assets/Img/ok<?=$b30?>.png" /></span></li>
								<li><span class="text">GOV Link</span><span class="deger1"><?=sayicevirici($anaarray["gov"]);?></span><span class="deger2" id="b7"><?=$b43?></span><span class="ok" id="c7"><img src="Assets/Img/ok<?=$b44?>.png" /></span></li>
								<li><span class="text">EDU Link</span><span class="deger1"><?=sayicevirici($anaarray["edu"]);?></span><span class="deger2" id="b8"><?=$b45?></span><span class="ok" id="c8"><img src="Assets/Img/ok<?=$b46?>.png" /></span></li>
								<li><span class="text">İnternal Link</span><span class="deger1"><?=sayicevirici($anaarray["links_internal"]);?></span><span class="deger2" id="b9"><?=$b53?></span><span class="ok" id="c9"><img src="Assets/Img/ok<?=$b54?>.png" /></span></li>
								<li><span class="text">External Link</span><span class="deger1"><?=sayicevirici($anaarray["links_external"]);?></span><span class="deger2" id="b10"><?=$b55?></span><span class="ok" id="c10"><img src="Assets/Img/ok<?=$b56?>.png" /></span></li>
								<li><span class="text">Html Sayfa Adedi</span><span class="deger1"><?=sayicevirici($anaarray["html_pages"]);?></span><span class="deger2" id="b11"><?=$b51?></span><span class="ok" id="c11"><img src="Assets/Img/ok<?=$b52?>.png" /></span></li>
							</ul>
							<div class="alt"></div>
						</div>
					</div>
				<div class="clearfix"></div>
				
				<div class="ust"><img src="Assets/Img/rakipanaliz-icon3.png" /><span>Sosyal Paylaşımlar</span></div>
				<div class="clearfix"></div>
				<div class="sosyal">
					<div class="sosyal1">
						<span class="twitter"><?=sayicevirici2($anaarray["twitter"]);?></span>
						<span class="facebook"><?=sayicevirici2(($anaarray["fb_share"]+$anaarray["fb_like"]));?></span>
						<span class="google"><?=sayicevirici2($anaarray["google"]);?></span>
					</div>
					<div class="sosyal2">
						<span class="twitter" id="a11"><?=$b21?></span>
						<span class="facebook" id="a9"><?=$b61?></span>
						<span class="google" id="a12"><?=$b23?></span>			
					</div>
				</div><div class="clearfix"></div>
			</div>
        </div>
    </div>
<?php include("footer.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>
	$(document).ready(function(){
		$(".sitelist li:last").addClass("aktif");
		$(".sol ul:last").show();
		$(".sitelist li").click(function(){
			$(".sitelist li").removeClass("aktif");
			$(this).addClass("aktif");
		});
	});
	
	<?php
		$degerler = NULL;
		
		for($i = 1; $i <= 63; $i++) {
			if($i == 63) $degerler .= "u".$i;
			else $degerler .= "u".$i.",";

		}
		
	?>
		function istatistikgetir(id, <?=$degerler?>){
			$("#a1").html(""+u1+" Backlink");
			$("#a2").html("Domain Rank<br /><br />"+u59+" %");
			$("#a9").html(""+u61+"");
			$("#a11").html(""+u21+"");
			$("#a12").html(""+u23+"");
			$("#b1").html(""+u3+"");
			$("#b2").html(""+u5+"");
			$("#b3").html(""+u7+"");
			$("#b4").html(""+u25+"");
			$("#b5").html(""+u27+"");
			$("#b6").html(""+u29+"");
			$("#b7").html(""+u43+"");
			$("#b8").html(""+u45+"");
			$("#b9").html(""+u53+"");
			$("#b10").html(""+u55+"");
			$("#b11").html(""+u51+"");
			$("#c1").html("<img src='Assets/Img/ok"+u4+".png' />");
			$("#c2").html("<img src='Assets/Img/ok"+u6+".png' />");
			$("#c3").html("<img src='Assets/Img/ok"+u8+".png' />");
			$("#c4").html("<img src='Assets/Img/ok"+u26+".png' />");
			$("#c5").html("<img src='Assets/Img/ok"+u28+".png' />");
			$("#c6").html("<img src='Assets/Img/ok"+u30+".png' />");
			$("#c7").html("<img src='Assets/Img/ok"+u44+".png' />");
			$("#c8").html("<img src='Assets/Img/ok"+u46+".png' />");
			$("#c9").html("<img src='Assets/Img/ok"+u54+".png' />");
			$("#c10").html("<img src='Assets/Img/ok"+u56+".png' />");
			$("#c11").html("<img src='Assets/Img/ok"+u52+".png' />");
			$("#r1").html("%"+u62+"");
			$("#r2").html("Referans Sayfalar : "+u3+"");
			$("#r3").css("width", u63);
			$(".sol ul").hide();
			$("#siteli"+id).show();
		}
		function rakipeklekapat(){if($(".rakipekle").css("display") == "none") $(".rakipekle").css("display", "block");else $(".rakipekle").css("display", "none");}
		function rakipekle(id){
				var a = $(".rakipekle textarea[name=siteler]").val();
				if(a == ""){
					$(".rakipekle .sonuc").html("En az bir rakip yazınız.");
				}
				else {
					$(".rakipekle .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".rakipekle input[type=submit]").val('Lütfen Bekleyin...');
					$(".rakipekle input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/rakipanaliz.php?islem=yenirakip',
							data: "id="+id+"&a="+a,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "ok"){
									location.reload();
								}
								else {
									$(".rakipekle .sonuc").html(sonuc);
								}
								$(".rakipekle input[type=submit]").attr("disabled", false);;
								$(".rakipekle input[type=submit]").val('Ekle');
							}
						})
				}
		}
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>