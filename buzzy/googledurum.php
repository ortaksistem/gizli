<?php
ob_start();
session_start();
include("fonksiyon.php");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Google Algoritma Durumu <?=_BASLIK?></title>
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
                <h1>Google Durum</h1>
                <div class="grafik left">
					<div id="googleimaj" style="margin-top:-16px"></div>
                </div>
                <div class="kelimeler left">
                    <h2><span class="yellow"><i class="fa fa-comment-o"></i> Algoritma</span> İstatistiği</h2>
                    <ul>
					<?php
					
					function googledurumsec($deger){
						switch($deger){
							case "sunny": $deger = "Güneşli";break;
							case "ptcloudy": $deger = "Yarı Güneşli";break;
							case "stormy": $deger = "Yağmurlu";break;
							case "rainy": $deger = "Şimşekli";break;
							case "cloudy": $deger = "Bulutlu";break;
							default: $deger = "Güneşli";break;
						}
						return $deger;
					}
						$result = mysql_query("select durum, derece, tarih from moz order by id desc limit 30");
						
						$googlegrafikarray = array();
						
						while(list($durum, $derece, $tarih) = mysql_fetch_row($result)){

							switch($durum){
								case "sunny": $img = "gunesli";break;
								case "ptcloudy": $img = "yarigunesli";break;
								case "stormy": $img = "yagmurlu";break;
								case "rainy": $img = "simsek";break;
								case "cloudy": $img = "bulutlu";break;
								default: $img = "gunesli";break;
							}
						
						
						
						$durum = googledurumsec($durum);
						$img = '<img src="Assets/Img/'.$img.'.png" alt="'.$durum.'" />';
						list($yil, $ay, $gun) = explode("-", $tarih);
						
						$tarih = $gun .".". $ay .".". $yil;
						
						array_push($googlegrafikarray, '[{"v":"'.$tarih.' '.$durum.'"},{"v":'.$derece.'}]');
						

						if($derece>70){
					?>
					<li class="clearfix" style="background:#d15a5a;color:#fff;"><div class="left"><?=$tarih?></div><span class="right"><?=$derece?> &deg; <?=$img?></span></li>
					<?php
						}
						else if($derece <= 70 and $derece > 60){
											
					?>
					<li class="clearfix" style="background:#faebeb"><div class="left"><?=$tarih?></div><span class="right"><?=$derece?> &deg; <?=$img?></span></li>
					<?php
					
						}
						else {
					?>
					<li class="clearfix"><div class="left"><?=$tarih?></div><span class="right"><?=$derece?>&deg; <?=$img?></span></li>
					<?php
						
						} // end if
						
						unset($durum);
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
		});
		function denetle(){if($("input[name=domainismi]").val() == "") {alert ("Geçersiz Domain, Lütfen Kontrol Ediniz."); return false;}}
		function goster(nere){$(".first, .second, .third").hide();$("."+nere).show();}
		function googlechart(){
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Tarih');
			data.addColumn('number', 'Durum');
			data.addRows([<?php foreach($googlegrafikarray as $aktar) echo $aktar .","; ?>]);
			var options = {
			width: 600,
			height: 450,
			hAxis: {
			  title: 'Google Algoritma'
			}
			};
			var chart = new google.visualization.LineChart(document.getElementById('googleimaj'));
			chart.draw(data, options);
		}
		
		setTimeout(
		  function() 
		  {
			googlechart();
		  }, 1000);
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>