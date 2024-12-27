<?php
error_reporting(0);
ini_set('max_execution_time', 0);
header('Content-Type: text/html; charset=utf-8');
// baglantı
$baglan = mysql_connect("localhost", "yatak_seo", "1400110004") or die("Baglanamadim");
mysql_select_db("yatak_seo", $baglan) or die("Secemedim");
mysql_query("set names 'utf8'",$baglan);

// fonksiyonlar
	include("useragent.php");
	
	function cek($url)
	{
		$user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_HEADER, TRUE);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
		// curl_setopt ($ch, CURLOPT_REFERER, 'http://www.google.com/');
		curl_setopt ($ch, CURLOPT_COOKIEFILE,"cookie.txt");
		curl_setopt ($ch, CURLOPT_COOKIEJAR,"cookie.txt");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT, random_user_agent());
		$icerik = curl_exec($ch);
		curl_close($ch);
		return $icerik;
	}

	function googlesira($site, $kelime){
		
		$sira = NULL;
		
		$kelime = urlencode($kelime);
		
		$a = 1;
		
		$site = str_replace("www.", "", $site);
		
		for($j = 0; $j<=9; $j++){
			
			$sayfa = $j ."0";
			
			$cek = "https://www.google.com.tr/search?q=".$kelime."&start=".$sayfa."&lr=tr&hl=tr&oe=utf8&ie=utf8&cr=countryTR";
					
			$cek = cek($cek);
			
			$youtube = explode($site, $cek);
			
			$youtube = $youtobe[0];
			
			if(preg_match("#youtube.com\b#", $youtube)) { 
					
				$a++;
				
			}
				
			preg_match_all('#<cite(.*?)>(.*?)</cite#si', $cek, $aktar, PREG_SET_ORDER);
	
			foreach($aktar as $ak){
				
				
				$aranacak = strip_tags($ak[2]);
				
				// echo $aranacak ."<br />";
				if(preg_match("#".$site."\b#", $aranacak)) { 
					
					return $a;
					
					break;
				
				}
	
				$a++;

			} // end foreach
			
		} // end for j
		
		return false;
	
	} // googlesira()
	
	function yandexsira($site, $kelime){
	
		$sira = NULL;
		
		$kelime = urlencode($kelime);
		
		$a = 1;
		
		$site = str_replace("www.", "", $site);
		
		for($j = 0; $j<=9; $j++){
			
			
			$cek = "http://www.yandex.com.tr/yandsearch?text=".$kelime."&p=".$j."";
					
			$cek = cek($cek);
		
			preg_match_all('#<a class="link serp-url__link" target="_blank" href="(.*?)"(.*?)>(.*?)</a>#si', $cek, $aktar, PREG_SET_ORDER);
	
			foreach($aktar as $ak){
				
				
				$aranacak = strip_tags($ak[1]);
				
				if(preg_match("#".$site."\b#", $aranacak)) { 
					
					return $a;
					
					break;
				
				}
	
				$a++;

			} // end foreach
			
		} // end for j
		
		return false;
		

	
	} // function yandexsira();
	
	function yahoosira($site, $kelime){
	
		$sira = NULL;
		
		$kelime = urlencode($kelime);
		
		$a = 1;
		
		$site = str_replace("www.", "", $site);
		
		for($j = 0; $j<=9; $j++){
			
			if($j == 0) $sayfa = "1";
			else $sayfa = $j ."1";
			
			$cek = "https://search.yahoo.com/search?p=".$kelime."&ei=UTF-8&b=".$sayfa."";
					
			$cek = cek($cek);
		
			preg_match_all('#<span(.*?)class="url"(.*?)>(.*?)</span>#si', $cek, $aktar, PREG_SET_ORDER);
	
			foreach($aktar as $ak){
				
				
				$aranacak = strip_tags($ak[3]);
				
				if(preg_match("#".$site."\b#", $aranacak)) { 
					
					return $a;
					
					break;
				
				}
	
				$a++;

			} // end foreach
			
		} // end for j
		
		return false;
	} // yahoo sira

	
	function bingsira($site, $kelime){
	
		$sira = NULL;
		
		$kelime = urlencode($kelime);
		
		$a = 1;
		
		$site = str_replace("www.", "", $site);
		
		for($j = 0; $j<=9; $j++){
			
			if($j == 0) $sayfa = "1";
			else $sayfa = $j ."1";
			
			$cek = "http://www.bing.com/search?q=".$kelime."&first=".$sayfa."";
					
			$cek = cek($cek);
		
			preg_match_all('#<cite(.*?)>(.*?)</cite>#si', $cek, $aktar, PREG_SET_ORDER);
	
			foreach($aktar as $ak){
				
				
				$aranacak = strip_tags($ak[0]);
				
				if(preg_match("#".$site."\b#", $aranacak)) { 
					
					return $a;
					
					break;
				
				}
	
				$a++;

			} // end foreach
			
		} // end for j
		
		return false;
	} // bing sira
	
	function turkceay($ay){
		
		$aylar = array("", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");
		
		return $aylar[$ay];
		
	}
$islem = $_GET["islem"];


if($islem == "getir"){


	
	$sorgu = $_POST["kelime"];

	$site = $_POST["site"];
	
	$motor = $_POST["motor"];
	

	
		if($motor == "google"){
			
			$sira = googlesira($site, $sorgu);
			
			if($sira >= 1) echo "Google'de <b>".$sira.".</b>  sıradasın<br />";
			else echo "Google'de Bulunmuyorsun<br />";
			
		}
		
		
		if($motor == "yandex"){
			
			$sira = yandexsira($site, $sorgu);
			
			if($sira >= 1) echo "Yandex'de <b>".$sira.".</b>  sıradasın<br />";
			else echo "Yandex'de Bulunmuyorsun<br />";
			
		}

		if($motor == "yahoo"){
			
			$sira = yahoosira($site, $sorgu);
			
			if($sira >= 1) echo "Yahoo'da <b>".$sira.".</b>  sıradasın<br />";
			else echo "Yahoo'da Bulunmuyorsun<br />";
			
		}
		
		if($motor == "bing"){
			
			
			$sira = bingsira($site, $sorgu);
			
			if($sira >= 1) echo "Bing'de <b>".$sira.".</b>  sıradasın<br />";
			else echo "Bing'de Bulunmuyorsun<br />";

		
		}
		
		if($motor == "hepsi"){
			
			$sira = googlesira($site, $sorgu);
			if($sira >= 1) echo "Google'de <b>".$sira.".</b>  sıradasın<br />";
			else echo "Google'de Bulunmuyorsun<br />";
			
			$sira = yandexsira($site, $sorgu);
			if($sira >= 1) echo "Yandex'de <b>".$sira.".</b>  sıradasın<br />";
			else echo "Yandex'de Bulunmuyorsun<br />";			


			$sira = yahoosira($site, $sorgu);
			if($sira >= 1) echo "Yahoo'da <b>".$sira.".</b>  sıradasın<br />";
			else echo "Yahoo'da Bulunmuyorsun<br />";	

			$sira = bingsira($site, $sorgu);
			if($sira >= 1) echo "Bing'de <b>".$sira.".</b>  sıradasın<br />";
			else echo "Bing'de Bulunmuyorsun<br />";	
			
		}


	}
	else if($islem == "siteekle"){
	
		$site = $_POST["site"];
		$kelime = $_POST["kelime"];
		$google = $_POST["google"];
		$yandex = $_POST["yandex"];
		$yahoo = $_POST["yahoo"];
		$bing = $_POST["bing"];
		
		if($google != 1) $google = 0;
		if($yandex != 1) $yandex = 0;
		if($yahoo != 1) $yahoo = 0;
		if($bing != 1) $bing = 0;
		
		
		$site = str_replace("http://", "", $site);
		
		$result = mysql_query("select id from siteler where site='$site'");
		
		$kayit = @mktime();
		
		if(@mysql_num_rows($result) >= 1){
			
			list($siteid) = mysql_fetch_row($result);

				$kelimeler = explode(",", $kelime);
				
				$a = 0;
				
				list($siteadi) = mysql_fetch_row(mysql_query("select site from siteler where id='$siteid'"));
				
				foreach($kelimeler as $kelime){
					
					$kelime = trim($kelime);
					
					if($kelime){
					
						list($warmi) = mysql_fetch_row(mysql_query("select count(id) from kelimeler where site='$siteid' and kelime='$kelime'"));
						
						if($warmi < 1){
							
							
							list($kelimeid) = mysql_fetch_row(mysql_query("select max(id) from kelimeler"));
							
							$kelimeid++;
							
							@mysql_query("insert into kelimeler (id, site, kelime, google, yandex, yahoo, bing, kayit, durum) values('$kelimeid', '$siteid', '$kelime', '$google', '$yandex', '$yahoo', '$bing', '$kayit', '1')");
							
							
							if($google == 1){
								$sira = googlesira($site, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set googleilksira='$sira', googleilktarih='$kayit', googlesonsira='$sira', googlesontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							if($yandex == 1){
								$sira = yandexsira($site, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set yandexilksira='$sira', yandexilktarih='$kayit', yandexsonsira='$sira', yandexsontarih='$kayit' where id='$kelimeid'");
								
								}						
							}							
							if($yahoo == 1){
								$sira = yahoosira($site, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set yahooilksira='$sira', yahooilktarih='$kayit', yahoosonsira='$sira', yahoosontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							if($bing == 1){
								$sira = bingsira($site, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set bingilksira='$sira', bingilktarih='$kayit', bingsonsira='$sira', bingsontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							
							unset($sira);
							
							$a++;
						
						}
						
					}
				
				}
				
				if($a >= 1) die("Site kayıtlıydı, $a adet kelime eklendi");
				else die("Kelime ve siteler kayıtlı");
		}
		else {
			
			list($siteid) = mysql_fetch_row(mysql_query("select max(id) from siteler"));
			
			$siteid++;

			$result = mysql_query("insert into siteler (id, site, kayit, durum) values('$siteid', '$site', '$kayit', '1')");
			
			if($result){
				
				$kelimeler = explode(",", $kelime);
				
				$a = 0;
				
				foreach($kelimeler as $kelime){
					
					$kelime = trim($kelime);
					
					if($kelime){

						list($kelimeid) = mysql_fetch_row(mysql_query("select max(id) from kelimeler"));
							
						$kelimeid++;
							
						@mysql_query("insert into kelimeler (id, site, kelime, google, yandex, yahoo, bing, kayit, durum) values('$kelimeid', '$siteid', '$kelime', '$google', '$yandex', '$yahoo', '$bing', '$kayit', '1')");

							if($google == 1){
								$sira = googlesira($site, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set googleilksira='$sira', googleilktarih='$kayit', googlesonsira='$sira', googlesontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							if($yandex == 1){
								$sira = yandexsira($site, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set yandexilksira='$sira', yandexilktarih='$kayit', yandexsonsira='$sira', yandexsontarih='$kayit' where id='$kelimeid'");
								
								}						
							}							
							if($yahoo == 1){
								$sira = yahoosira($site, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set yahooilksira='$sira', yahooilktarih='$kayit', yahoosonsira='$sira', yahoosontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							if($bing == 1){
								$sira = bingsira($site, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set bingilksira='$sira', bingilktarih='$kayit', bingsonsira='$sira', bingsontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							
							unset($sira);
							
						$a++;
					
					}
				
				}
				
				
				die("Site ve $a kelime eklendi");
				
			
			}
			else {
				
				die("Site Eklenemedi");
			
			}
			
		}
		
		
	
	}
	else if($islem == "kelimeguncelle"){
		
		$site = $_POST["site"];
		
		list($siteid, $siteadi) = mysql_fetch_row(mysql_query("select id, site from siteler where id='$site'"));
		
		
		$result = mysql_query("select * from kelimeler where site='$siteid'");
		
		$kayit = @mktime();
		
		while($array = mysql_fetch_array($result)){
			
			$kelimeid = $array["id"];
			
			$kelime = $array["kelime"];
			
			
							if($array["google"] == 1){
								$sira = googlesira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set googlesonsira='$sira', googlesontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							if($array["yandex"] == 1){
								$sira = yandexsira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set yandexsonsira='$sira', yandexsontarih='$kayit' where id='$kelimeid'");
								
								}						
							}							
							if($array["yahoo"] == 1){
								$sira = yahoosira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set yahoosonsira='$sira', yahoosontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							if($array["bing"] == 1){
								$sira = bingsira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set bingsonsira='$sira', bingsontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							
							unset($sira);
			
		
		}
		
		
		
						$kelimeler = mysql_query("select id, kelime, google, googlesonsira, googlesontarih, yandex, yandexsonsira, yandexsontarih, yahoo, yahoosonsira, yahoosontarih, bing, bingsonsira, bingsontarih from kelimeler where site='$siteid' order by id asc");
						
						while($array = mysql_fetch_array($kelimeler)){
						
							
							echo $array["kelime"] ." (";
							
							if($array["google"] == 1) echo "Google : ". $array["googlesonsira"] .", ";
							if($array["yandex"] == 1) echo "Yandex : ". $array["yandexsonsira"] .", ";
							if($array["yahoo"] == 1) echo "Yahoo : ". $array["yahoosonsira"] .", ";
							if($array["bing"] == 1) echo "Bing : ". $array["bingsonsira"];
							
							echo ")<br />";
						
						}
						
						echo "<font color=green><b>Güncellendi.</b></font><hr />";
		
		
	
	}
	else if($islem == "tumu"){
	
		$result = mysql_query("select * from kelimeler order by id desc");
		
		$kayit = @mktime();
		
		while($array = mysql_fetch_array($result)){
			
			$kelimeid = $array["id"];
			
			
			$siteid = $array["site"];
			
			
			list($siteadi) = mysql_fetch_row(mysql_query("select site from siteler where id='$siteid'"));
			
			$kelime = $array["kelime"];
			
			
							if($array["google"] == 1){
								$sira = googlesira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set googlesonsira='$sira', googlesontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							if($array["yandex"] == 1){
								$sira = yandexsira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set yandexsonsira='$sira', yandexsontarih='$kayit' where id='$kelimeid'");
								
								}						
							}							
							if($array["yahoo"] == 1){
								$sira = yahoosira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set yahoosonsira='$sira', yahoosontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							if($array["bing"] == 1){
								$sira = bingsira($siteadi, $kelime);
								
								if($sira >= 1){
									
									@mysql_query("update kelimeler set bingsonsira='$sira', bingsontarih='$kayit' where id='$kelimeid'");
								
								}						
							}
							
							unset($sira);
			
		
		}	
		
		die("ok");
		
	
	}
	else if($islem == "kelimelog"){
	
		$kelimeid = $_POST["id"];
		
		if(is_numeric($kelimeid)){
			
			list($siteadi, $kelimeadi) = mysql_fetch_row(mysql_query("select siteler.site, kelimeler.kelime from kelimeler inner join siteler on siteler.id=kelimeler.site where kelimeler.id='$kelimeid'"));
			
			
			echo "<p align=center><b>$siteadi</b> sitesinin <b>$kelimeadi</b> kelimesine ilişkin istatistik aşagıdadır.</p>";
			
			
			$result = mysql_query("select google, yandex, yahoo, bing, gun, ay, yil, saat, dakika from kelimeler_log where kelimeid='$kelimeid' order by id desc");
			
			if(@mysql_num_rows($result) >= 1){
				
				echo "<table><tr>
					<td width='50%'><b>Tarih ve Saat</b></td>
					<td width='50%'><b>Arama Motoru Sıralama</b></td>
					</tr>";
					
					while($array = mysql_fetch_array($result)){
					
					$dakika = $array["dakika"];
					if(strlen($dakika) <= 1) $dakika = "0". $dakika;
					$saat = $array["saat"];
					if(strlen($saat) <= 1) $saat = "0". $saat;
					
					echo "<tr><td>".$array["gun"]." ".turkceay($array["ay"])." ".$array["yil"]." ".$saat.":".$dakika." </td>";
					
					echo "<td>";
					
							echo "Google : ". $array["google"];
							
					
					
					echo "</td></tr>";
					
					
					}
				
				echo "</table>";
			
			}
			else {
				die("Henüz istatistik oluşturulmamış");
			}
		
		}
		else {
			die("hata");
		}
	
	}
	else if($islem == "sitesil"){
		
		$site = $_POST["site"];
		
		@mysql_query("delete from kelimeler where site='$site'");
		@mysql_query("delete from siteler where id='$site'");
		
		die("ok");
	}
	else {
?>

<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Site Sıra Bulucu</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="modal.js"></script>
<script type="text/javascript">
	$(function() {
		$("#popkapat a").click(function(){
			$("#popveri").html("");
			$("#popbox, #popicerik").css("display", "none");
		});

	});
	function aramabaslat(){
		var siteadi = $("#siteadi").val();
		var kelime = $("#kelime").val();
		var motor = $("#motor").val();
		$("#sonuc").html("<img src='loading.gif' /> <font color=green><b>Yükleniyor . . . </b></font>");
				jQuery.ajax({
					type : 'POST',
					url : 'test.php?islem=getir',
					data : "site="+siteadi+"&kelime="+kelime+"&motor="+motor,
					success: function(sonuc){		
						$("#sonuc").html(sonuc);
					}
				})	
	}
	function siteekle(){
		var siteadi = $("#siteadi2").val();
		var kelime = $("#kelimeler").val();
		var google = $("input[name=google]:checked").val();
		var yahoo = $("input[name=yahoo]:checked").val();
		var yandex = $("input[name=yandex]:checked").val();
		var bing = $("input[name=bing]:checked").val();
		$("#sonuc2").html("<img src='loading.gif' /> <font color=green><b>Yükleniyor . . . </b></font>");
				jQuery.ajax({
					type : 'POST',
					url : 'test.php?islem=siteekle',
					data : "site="+siteadi+"&kelime="+kelime+"&google="+google+"&yahoo="+yahoo+"&yandex="+yandex+"&bing="+bing,
					success: function(sonuc){		
						$("#sonuc2").html(sonuc);
					}
				})		
	
	}
	function kelimeguncelle(site){
		$("#kelimeguncelle"+site).html("<img src='loading.gif' /> <font color=green><b>Güncelleme Başladı, Bekleyin. . . </b></font><hr />");
				jQuery.ajax({
					type : 'POST',
					url : 'test.php?islem=kelimeguncelle',
					data : "site="+site,
					success: function(sonuc){		
						$("#kelimeguncelle"+site).html(sonuc);
					}
				})	
	}
	function sitesil(site){
		var onayla = confirm("Veriler geri dönüşü olmadan silinecek. Onaylıyor musunuz?");
		if(onayla){
			$("#site"+site).hide("slow");
				jQuery.ajax({
					type : 'POST',
					url : 'test.php?islem=sitesil',
					data : "site="+site,
					success: function(sonuc){		
						if(sonuc == "hata"){
							alert("Site silinemedi, tekrar deneyin");
							$("#site"+site).show();
						}
					}
				})	
		
		}
	
	}
	function tumunuguncelle(){
		alert("Veriler arkaplanda güncellenecek, sayfayı kapatmayın");
			$("#tumu").html("<img src='loading.gif' />");
				jQuery.ajax({
					type : 'POST',
					url : 'test.php?islem=tumu',
					data : "site=guncelle",
					success: function(sonuc){		
						$("#tumu").html('<a href="javascript:void(0)" onclick="tumunuguncelle()" title="Tümünü Güncelle"><img src="reload.png" /></span></a>');
					}
				})			
	}
	function istatistikgetir(id){
		$("#popicerik").css("display", "block");
		var w = $(window).width() / 2 - 350;
		var h = 100 + jQuery(window).scrollTop();
		$("#popicerik").css("top", h);
		$("#popicerik").css("left", w);
		$("#popveri").html("<p align=center><img src='loading.gif' /> <br /><br /><font color=green><b>Veri yükleniyor, lütfen bekleyin. . . </b></font></p>");
				jQuery.ajax({
					type : 'POST',
					url : 'test.php?islem=kelimelog',
					data : "id="+id,
					success: function(sonuc){		
						$("#popveri").html(sonuc);
					}
				})	
				
	}
</script>
<style type="text/css">
	#ana { width:1100px; position:relative;}
	.sol { width:300px; position:absolute; height:300px; top:0px; left:0px; margin:10px; padding:15px; border:1px solid #ccc; font-size:14px Arial;}
	.sol2 { width:300px; position:absolute; top:350px; left:0px; margin:10px; padding:15px; border:1px solid #ccc; font-size:14px Arial;}
	#ana h1 { font-size:16px; }
	#ana input { width:150px; border:1px solid #dedede; }
	.sag { width:700px; position:relative; top:10px; left:350px; margin:10px; padding:15px; border:1px solid #ccc; font-size:14px Arial;}
	.submit { height:28px; border:1px solid #260101; background:#ad0606; color:#fff; font-weight:bold;}
	#popbox { width:100%; height:100%; }
	#popicerik { width:500px; height:300px; z-index:999; border:3px solid #ccc; }
	#popbox { width:100%; height:100%; position:absolute; z-index:998; background:#ccc; left:0px; top:0px; display:none}
	#popicerik { width:700px; height:500px; position:absolute; z-index:999; background:#fff; left:0px; top:0px; border:3px solid #ccc; display:none}
	#popveri { padding:10px; width:680px; height:480px; overflow:auto; }
	#popkapat { width:32px; height:32px; position:absolute; top:-10px; right:-10px;}
</style>
</head>
<body>
<div id="ana">
	<div class="sol">
		<h1>Site Sıra Bulucu</h1>
		<form action="javascript:void(0)" method="post">
		<p>Site Adı : <input type="text" name="siteadi" id="siteadi" value="www." class="inputs" /></p>
		<p>Aranacak Keywords : <input type="text" name="kelime" id="kelime" class="inputs" /></p>
		<p>Arama Motoru : <select name="motor" id="motor">
			<option value="google">Google</option>
			<option value="yahoo">Yahoo</option>
			<option value="yandex">Yandex</option>
			<option value="bing">Bing</option>
			<option value="hepsi">Hepsinde Ara</option>
		</select>
		</p>
		<p><input type="submit" value="Arama Başlat" class="submit" onclick="aramabaslat()" /></p>
		<p><span id="sonuc"></span></p>
		</form>
	</div>
	
	<div class="sag">
		<h1>Siteler <span id="tumu"><a href="javascript:void(0)" onclick="tumunuguncelle()" title="Tümünü Güncelle"><img src="reload.png" /></span></a></h1>
		<hr />
		<table>
			<tr>
				<td width="18%">Site Adı</td>
				<td width="70%">Kelimeler</td>
				<td width="10%">İşlemler</td>
			</tr>
				<?php
					
					$result = mysql_query("select id, site from siteler order by id asc");
					
					while(list($siteid, $siteadi) = mysql_fetch_row($result)){
					
					
				?>
			<tr id="site<?=$siteid?>">
				<td><?=$siteadi?></td>
				<td id="kelimeguncelle<?=$siteid?>">
					<?php
						
						$kelimeler = mysql_query("select id, kelime, google, googlesonsira, googlesontarih, yandex, yandexsonsira, yandexsontarih, yahoo, yahoosonsira, yahoosontarih, bing, bingsonsira, bingsontarih from kelimeler where site='$siteid' order by id asc");
						
						while($array = mysql_fetch_array($kelimeler)){
						
							
							echo $array["kelime"] ." (";
							
							if($array["google"] == 1) echo "Google : ". $array["googlesonsira"] .", ";
							if($array["yandex"] == 1) echo "Yandex : ". $array["yandexsonsira"] .", ";
							if($array["yahoo"] == 1) echo "Yahoo : ". $array["yahoosonsira"] .", ";
							if($array["bing"] == 1) echo "Bing : ". $array["bingsonsira"];
							
							echo ")";
							echo '<a href="javascript:void(0)" onclick="istatistikgetir('.$array["id"].')" title="İstatistik Getir"><img src="istatistik.png" /></a> ';
							
							echo "<br />";
						
						}
					
					?>
					<hr />
				</td>

				<td>
					<a href="javascript:void(0)" onclick="kelimeguncelle(<?=$siteid?>)" title="Kelimeleri Güncelle"><img src="reload.png" /></a> 
					<a href="javascript:void(0)" title="İstatistik Getir"><img src="istatistik.png" /></a> 
					<a href="javascript:void(0)" onclick="sitesil(<?=$siteid?>)" title="Sil"><img src="cross.png" /></a> 
				</td>
				
			</tr>
			
				<?
				
					
					}
				
				?>
		</table>
	</div>
	
	<div class="sol2">
		<h1>Site Ekle</h1>
		<form action="javascript:void(0)" method="post">
		<p>Site Adı : <input type="text" name="siteadi2" id="siteadi2" value="www." class="inputs" /></p>
		<p>Aranacak Keywords : 
		<textarea name="kelimeler" id="kelimeler" style="width:280px;height:100px;"></textarea> * Aralara virgül koyun
		</p>
		<p>Arama Motoru : <br />
			<input type="checkbox" name="google" value="1" style="width:20px" /> Google <br />
			<input type="checkbox" name="yahoo" value="1" style="width:20px" /> Yahoo <br />
			<input type="checkbox" name="yandex" value="1" style="width:20px" /> Yandex <br />
			<input type="checkbox" name="bing" value="1" style="width:20px" /> Bing <br />
		</p>
		<p><input type="submit" value="Site Ekle" class="submit" onclick="siteekle()" /></p>
		<p><span id="sonuc2">İşlem uzun sürebilir, eklediğiniz kelimelerin ilk sıraları bulunacak.</span></p>
		</form>
	</div>
</div>

	<div id="popicerik">
		<div id="popkapat"><a href="javascript:void(0)" onclick="kapat()"><img src="kapat.png" width="32" height="32" /></a></div>
		<div id="popveri"></div>
	</div>

</body>
</html><?php } ?>
