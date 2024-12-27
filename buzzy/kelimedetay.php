<?php
ob_start();
session_start();
$id = $_GET["id"];
if(!is_numeric($id)) die("Go");
include("fonksiyon.php");
$id = suz2($id);

$result = mysql_query("select siteler.id, siteler.uye, siteler.site, kelimeler.kelime, kelimeler.google, kelimeler.googleortasira, kelimeler.yandex, kelimeler.yandexortasira, kelimeler.yahoo, kelimeler.yahooortasira, kelimeler.bing, kelimeler.bingortasira from kelimeler inner join siteler on siteler.id=kelimeler.site where kelimeler.id='$id'");

list($siteid, $uyeid, $site, $kelime, $google, $googlesira, $yandex, $yandexsira, $yahoo, $yahoosira, $bing, $bingsira) = mysql_fetch_row($result);


if(!is_numeric($siteid) or _UYEID != $uyeid){
	
	yonlendir("index.php");
	
	die();
}

$site = stripslashes($site);
$kelime = stripslashes($kelime);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$kelime?>, <?=$site?> istatistiği</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link href="Assets/Css/reset.css" rel="stylesheet" />
    <link href="Assets/Css/flexslider.css" rel="stylesheet" />
    <link href="Assets/Css/font-awesome.min.css" rel="stylesheet" />
    <link href="Assets/Css/main.css" rel="stylesheet" />
	<base href="<?=_URL?>" />
</head>
<body>
<div id="popicerik">
	<div id="popkapat"><a href="javascript:void(0)" onclick="kapat()">KAPAT</a></div>
	<div id="popveri"></div>
</div>
<?php include("header.php"); ?>

    <div class="whitebg">
        <div class="container">
            <div class="kelime-analizi clearfix">
                <h1>Kelime Analizi</h1>
                <div class="grafik left">
					<div id="googleimaj"></div>
					<div id="yandeximaj"></div>
					<div id="yahooimaj"></div>
					<div id="bingimaj"></div>
                </div>
                <div class="kelimeler left">
                    <h2><span class="yellow"><i class="fa fa-comment-o"></i> Kelime:</span> <?=$kelime?></h2>
                    <ul>
					<?php
						
						$result = mysql_query("select * from kelimeler_log where kelimeid='$id' and siteid='$siteid' order by id desc limit 30");
						
						$googlegrafikarray = array();
						$yahoografikarray = array();
						$yandexgrafikarray = array();
						$binggrafikarray = array();
						
						while($array = mysql_fetch_array($result)){
						
						$tarih = date("d.m.Y", $array["kayit"]);
						
						$siradegisim = NULL;
						
						
						if($google == 1){

								$sonsira = $array["google"];
								
								if($sonsira >= 1) {
								if($sonsira > $googlesira) $siradegisim .= 'Google : '.$sonsira.'. <img src="Assets/Img/downarroworange.png" />';	
								if($sonsira < $googlesira) $siradegisim .= 'Google : '.$sonsira.'.  <img src="Assets/Img/uparrowgreen.png" />';
								if($sonsira == $googlesira) $siradegisim .= 'Google : '.$sonsira.'. <img src="Assets/Img/hori.png" />';
								}
								else {
									$siradegisim .= 'Google : '.$sonsira.'. <img src="Assets/Img/hori.png" />';
								}
								
								array_push($googlegrafikarray, '[{"v":"'.$tarih.'"},{"v":'.$sonsira.'}]');
								
						}
						
						if($yandex == 1){
						
								$sonsira = $array["yandex"];
								
								if($sonsira >= 1) {
								if($sonsira > $yandexsira) $siradegisim .= 'Yndx : '.$sonsira.'. <img src="Assets/Img/downarroworange.png" />';	
								if($sonsira < $yandexsira) $siradegisim .= 'Yndx : '.$sonsira.'.  <img src="Assets/Img/uparrowgreen.png" />';
								if($sonsira == $yandexsira) $siradegisim .= 'Yndx : '.$sonsira.'. <img src="Assets/Img/hori.png" />';
								}
								else {
									$siradegisim .= 'Yndx : '.$sonsira.'. <img src="Assets/Img/hori.png" />';
								}				
								
								array_push($yandexgrafikarray, '[{"v":"'.$tarih.'"},{"v":'.$sonsira.'}]');
						
						}
					
						if($yahoo == 1){
						
								$sonsira = $array["yahoo"];
								
								if($sonsira >= 1) {
								if($sonsira > $yahoosira) $siradegisim .= 'Yaho : '.$sonsira.'. <img src="Assets/Img/downarroworange.png" />';	
								if($sonsira < $yahoosira) $siradegisim .= 'Yaho : '.$sonsira.'.  <img src="Assets/Img/uparrowgreen.png" />';
								if($sonsira == $yahoosira) $siradegisim .= 'Yaho : '.$sonsira.'. <img src="Assets/Img/hori.png" />';
								}
								else {
									$siradegisim .= 'Yaho : '.$sonsira.'. <img src="Assets/Img/hori.png" />';
								}				
								
								array_push($yahoografikarray, '[{"v":"'.$tarih.'"},{"v":'.$sonsira.'}]');
						
						}


						if($bing == 1){
						
								$sonsira = $array["bing"];
								
								if($sonsira >= 1) {
								if($sonsira > $bingsira) $siradegisim .= 'Bing : '.$sonsira.'. <img src="Assets/Img/downarroworange.png" />';	
								if($sonsira < $bingsira) $siradegisim .= 'Bing : '.$sonsira.'.  <img src="Assets/Img/uparrowgreen.png" />';
								if($sonsira == $bingsira) $siradegisim .= 'Bing : '.$sonsira.'. <img src="Assets/Img/hori.png" />';
								}
								else {
									$siradegisim .= 'Bing : '.$sonsira.'. <img src="Assets/Img/hori.png" />';
								}			

								array_push($binggrafikarray, '[{"v":"'.$tarih.'"},{"v":'.$sonsira.'}]');
						
						}						
					?>
					<li class="clearfix"><div class="left"><?=$tarih?></div><span class="right"><?=$siradegisim?></span></li>
					<?php
						}
					
					?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php include("footer.php"); ?>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Assets/Js/jquery.flexslider.js"></script>
    <script>
	google.load('visualization', '1', {'packages':['corechart']});
	
		$(document).ready(function(){
			$("input[name=domainismi]").on({focus: function(){if($(this).val() == "") $(this).val("http://");},blur: function(){if($(this).val() == "http://") $(this).val("");}});
			$(".user-login").click(function(){$(".kelimeekle").css("display", "none");if($(".user-login2").css("display") == "none") $(".user-login2").css("display", "block");else $(".user-login2").css("display", "none");});
			$(".first input[type=submit]").click(function(){
				var k = $(".first input[name=username]").val();
				var s = $(".first input[name=password]").val();
				if(k == ""){
					$(".first .sonuc").html("E-posta veya kullanıcı adını yazınız");
				}
				else if(s == ""){
					$(".first .sonuc").html("Şifrenizi yazınız");
				}
				else {
					$(".first .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".first input[type=submit]").val('Lütfen Bekleyin...');
					$(".first input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/uye.php?islem=giris',
							data: "k="+k+"&s="+s,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "ok"){
									$(".user-login2").css("display", "none");
									$(".user-login").html('<img src="Assets/Img/user-icon.png" /> Merhaba <b>'+k+'</b> <a href="cikis.php">Çıkış</a>');
									$(".user-login2").html('<p><font color=white>Üye Menüsü Gelicek</p>');
								}
								else {
									$(".first input[type=submit]").attr("disabled", false);;
									$(".first input[type=submit]").val('Giriş Yap');
									$(".first .sonuc").html(sonuc);
								}
							}
						})
				}
			});

			$(".second input[type=submit]").click(function(){
				var k = $(".second input[name=username]").val();
				if(k == ""){
					$(".second .sonuc").html("E-posta veya kullanıcı adını yazınız");
				}
				else {
					$(".second .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".second input[type=submit]").val('Lütfen Bekleyin...');
					$(".second input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/uye.php?islem=sifremiunuttum',
							data: "k="+k,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "ok"){
									$(".second input[name=username]").val("");
									$(".second input[type=submit]").val('Şifremi Gönder');
									$(".second .sonuc").html("Şifreniz başarıyla değiştirilip e-posta adresinize gönderilmiştir.<br /><br />E-posta adresinizde junk kısmına bakmanızı tavsiye ederiz.");
								}
								else {
									$(".second input[type=submit]").attr("disabled", false);;
									$(".second input[type=submit]").val('Şifremi Gönder');
									$(".second .sonuc").html(sonuc);
								}
							}
						})
				}
			});
			
			$(".third input[type=submit]").click(function(){
				var k = $(".third input[name=username]").val();
				var s = $(".third input[name=password]").val();
				var e = $(".third input[name=eposta]").val();
				if(k == ""){
					$(".third .sonuc").html("Kullanıcı adını yazınız");
				}
				else if(e == ""){
					$(".third .sonuc").html("E-posta adresinizi yazınız");
				}
				else if(s == ""){
					$(".third .sonuc").html("Şifrenizi yazınız");
				}
				else {
					$(".third .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".third input[type=submit]").val('Lütfen Bekleyin...');
					$(".third input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/uye.php?islem=uyeol',
							data: "k="+k+"&s="+s+"&e="+e,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "tamam"){
									$(".third ul").html('<li>Başarıyla üye oldunuz.<br /><br /><a href="javascript:void(0)" onclick="goster(\'first\')"><b>BURAYA</b> tıklayarak giriş yapabilirsiniz.</a></li>');
								}
								else {
									$(".third input[type=submit]").attr("disabled", false);;
									$(".third input[type=submit]").val('Üyeliğimi Tamamla');
									$(".third .sonuc").html(sonuc);
								}
							}
						})
				}
			});
			


			$(".kelimeekle input[type=submit]").click(function(){
				var s = $(".kelimeekle select[name=site]").val();
				var k = $(".kelimeekle textarea[name=sitekelime]").val();
				var g = $(".kelimeekle input[name=google]:checked").val();
				var y = $(".kelimeekle input[name=yahoo]:checked").val();
				var b = $(".kelimeekle input[name=bing]:checked").val();
				var ya = $(".kelimeekle input[name=yandex]:checked").val();
				if(s == ""){
					$(".kelimeekle .sonuc").html("Site adresini yazınız.");
				}
				else if(k == ""){
					$(".kelimeekle .sonuc").html("En az bir kelime yazınız");
				}
				else if(y != "1" && g != "1" && b != "1" && ya != "1"){
					$(".kelimeekle .sonuc").html("En az bir arama motoru seçiniz");
				}
				else {
					$(".kelimeekle .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".kelimeekle input[type=submit]").val('Lütfen Bekleyin...');
					$(".kelimeekle input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/siratakip.php?islem=kelimeekle',
							data: "s="+s+"&k="+k+"&g="+g+"&y="+y+"&ya="+ya+"&b="+b,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "tamam"){
									$(".kelimeekle .sonuc").html("Tamamdır");
									$(".kelimeekle input[type=submit]").attr("disabled", false);;
									$(".kelimeekle input[type=submit]").val('Siteyi Ekle');
									document.kelimeekleform.reset();
									$(".kelimeekle .sonuc").html("Kelimeler eklendi. <a href='javascript:void(0)' onclick='kelimeeklekapat()'><b>Kapat</b></a>");
								}
								else {
									$(".kelimeekle input[type=submit]").attr("disabled", false);;
									$(".kelimeekle input[type=submit]").val('Kelimeyi Ekle');
									$(".kelimeekle .sonuc").html(sonuc);
								}
							}
						})
				}
			});			
		});
		function kelimesil(id){
			var onayla = confirm("Tüm veriler silinecek. İşlem sonu tekrar geri alınamaz. Emin misinz?");
			
			if(onayla){
				$("#kelime"+id).html("<td colspan='7'><p align=center><img src='Assets/Img/loader3.gif' /></p></td>");
						jQuery.ajax({
							type: 'POST',
							url: 'inc/siratakip.php?islem=kelimesil',
							data: "id="+id,
							success: function(sonuc){
								$("#kelime"+id).hide();
							}
						})
			}
		}
		function denetle(){if($("input[name=domainismi]").val() == "") {alert ("Geçersiz Domain, Lütfen Kontrol Ediniz."); return false;}}
		function goster(nere){$(".first, .second, .third").hide();$("."+nere).show();}
		function kelimeeklekapat(){if($(".kelimeekle").css("display") == "none") $(".kelimeekle").css("display", "block");else $(".kelimeekle").css("display", "none");}
		<?php $chartlar = array(); if($google == 1){ ?>
		function googlechart(){
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Tarih');
			data.addColumn('number', 'Sıra');
			data.addRows([<?php foreach($googlegrafikarray as $aktar) echo $aktar .","; ?>]);
			var options = {
			width: 600,
			height: 250,
			hAxis: {
			  title: 'Google'
			}
			};
			var chart = new google.visualization.LineChart(document.getElementById('googleimaj'));
			chart.draw(data, options);
		}
		<?php
			array_push($chartlar, "googlechart();");
			}

		if($yandex == 1){ ?>
		function yandexchart(){
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Tarih');
			data.addColumn('number', 'Sıra');
			data.addRows([<?php foreach($yandexgrafikarray as $aktar) echo $aktar .","; ?>]);
			var options = {
			width: 600,
			height: 250,
			hAxis: {
			  title: 'Yandex'
			}
			};
			var chart = new google.visualization.LineChart(document.getElementById('yandeximaj'));
			chart.draw(data, options);
		}
		<?php
			array_push($chartlar, "yandexchart();");
			}
		if($yahoo == 1){ ?>
		function yahoochart(){
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Tarih');
			data.addColumn('number', 'Sıra');
			data.addRows([<?php foreach($yahoografikarray as $aktar) echo $aktar .","; ?>]);
			var options = {
			width: 600,
			height: 250,
			hAxis: {
			  title: 'Yahoo'
			}
			};
			var chart = new google.visualization.LineChart(document.getElementById('yahooimaj'));
			chart.draw(data, options);
		}
		<?php
			array_push($chartlar, "yahoochart();");
			}
		if($bing == 1){ ?>
		function bingchart(){
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Tarih');
			data.addColumn('number', 'Sıra');
			data.addRows([<?php foreach($binggrafikarray as $aktar) echo $aktar .","; ?>]);
			var options = {
			width: 600,
			height: 250,
			hAxis: {
			  title: 'Bing'
			}
			};
			var chart = new google.visualization.LineChart(document.getElementById('bingimaj'));
			chart.draw(data, options);
		}
		<?php
			array_push($chartlar, "bingchart();");
			}
		?>
		
		setTimeout(
		  function() 
		  {
			<?php foreach($chartlar as $aktar) echo $aktar; ?>
		  }, 1000);
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>