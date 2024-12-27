<?php
ob_start();
session_start();
include("fonksiyon.php");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?=_BASLIK?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link href="Assets/Css/reset.css" rel="stylesheet" />
    <link href="Assets/Css/flexslider.css" rel="stylesheet" />
    <link href="Assets/Css/font-awesome.min.css" rel="stylesheet" />
    <link href="Assets/Css/main.css" rel="stylesheet" />
	<base href="<?=_URL?>" />
</head>
<body>
<?php include("header.php"); ?>
    <div class="slider-bg clearfix">
        
        <div class="container">
            <div class="slider">
                <ul class="slides">
                        <li>
							
                            <div class="slider-form right">
							<form action="analiz.php" onSubmit="return denetle()" method="post">
                                <input type="text" name="domainismi" placeholder="Domain ismini yazınız..." />
                                <input type="submit" value="ANALİZ ET" class="slider-form-button" />
							</form>
                            </div>
                        </li>
                    </ul>
            </div>

        </div>
    </div>
    <div class="home-content-top-blue">
        <div class="container">
            <div class="content">
                <h3><span class="yellow">Bizimle Birlikte Neler</span> yapabilirsiniz?</h3>
                <ul class="home-content-list">
                    <li>
                        <div class="image">
                            <a href="#">
                                <img src="Assets/Img/site-analizi.png" /></a>
                        </div>
                        <p>
                           Link takip aracı ile sitenize gelen linlleri sınırsız bir şekilde günlük olarak takip edebilir ve ayrıntılı rapor alabilirsiniz. 
                        </p>
                    </li>
                    <li>
                        <div class="image">
                            <a href="#">
                                <img src="Assets/Img/backlink-analizi.png" /></a>
                        </div>
                        <p>
                            Tüm web sitelerini detaylı analiz ederek ayrıntılı raporlar sayesinde hedefe ulaşmanız artık daha kolay
                        </p>
                    </li>
                    <li>
                        <div class="image">
                            <a href="#">
                                <img src="Assets/Img/zararli-backlink-tespiti.png" /></a>
                        </div>
                        <p>
                            Web sitenize sizin aldığınız yada dışarıdan gelen zararlı linklerin ayrışımı için kullanılır, Olası güncellemelerden daha az etkilenirsiniz.
                        </p>
                    </li>
                    <li>
                        <div class="image">
                            <a href="#">
                                <img src="Assets/Img/google-sira-bulucu.png" /></a>
                        </div>
                        <p>
                            Sınırsız site ve kelime ekleyebileceğiniz sıra bulucu aracımız ile hedef kelimelerinizi takip etmeniz artık çok daha kolay.
                        </p>
                    </li>
                    <li>
                        <div class="image">
                            <a href="#">
                                <img src="Assets/Img/rakiplerim-ne-yapmis.png" /></a>
                        </div>
                        <p>
                            Haftalık rapor alabileceğiniz aracımız rakiplerinizi hafta bazlı olarak takip eder ve sizler için detaylı analiz yapar.
                        </p>
                    </li>
                    <li>
                        <div class="image">
                            <a href="#">
                                <img src="Assets/Img/siralamanizdaki-degismeler.png" /></a>
                        </div>
                        <p>
                            Hedef kelimenizdeki değişimleri ve rakiplerinizin iniş çıkışlarını günlük olarak sizlere aktarır ve ayrıntılı rapor sunar
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="home-content-top-yellow">
        <div class="container">
            <div class="content">
                <h3>Çözüm Ortaklarımız</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="cozumortakslider">
            <ul class="slides">
                <li>
                    <img src="Assets/Img/bing-logo.png" alt="" />
                </li>
                <li>
                    <img src="Assets/Img/meadwestvaco-logo.png" alt="" />
                </li>
                <li>
                    <img src="Assets/Img/ntv-logo.png" alt="" />
                </li>
                <li>
                    <img src="Assets/Img/webrazzi-logo.png" alt="" />
                </li>
                <li>
                    <img src="Assets/Img/skype-logo.png" alt="" />
                </li>
                <li>
                    <img src="Assets/Img/opet-logo.png" alt="" />
                </li>
                <li>
                    <img src="Assets/Img/skype-logo.png" alt="" />
                </li>
                <li>
                    <img src="Assets/Img/opet-logo.png" alt="" />
                </li>
                <!-- items mirrored twice, total of 12 -->
            </ul>
        </div>
    </div>
<?php include("footer.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Assets/Js/jquery.flexslider.js"></script>
    <script>
        $('.cozumortakslider').flexslider({
            animation: "slide",
            animationLoop: false,
            itemWidth: 165,
            itemMargin: 6,
            controlNav: false,
            controls: true
        });
		$(document).ready(function(){
			$("input[name=domainismi]").on({focus: function(){if($(this).val() == "") $(this).val("http://");},blur: function(){if($(this).val() == "http://") $(this).val("");}});
			<?php if(_UYEDURUM != 1){ ?>
			$(".user-login").click(function(){if($(".user-login2").css("display") == "none") $(".user-login2").css("display", "block");else $(".user-login2").css("display", "none");});
			$(".first input[type=submit]").click(function(){var k = $(".first input[name=username]").val();var s = $(".first input[name=password]").val();if(k == ""){$(".first .sonuc").html("E-posta veya kullanıcı adını yazınız");}else if(s == ""){$(".first .sonuc").html("Şifrenizi yazınız");}else {$(".first .sonuc").html('<img src="Assets/Img/loader1.gif" />');$(".first input[type=submit]").val('Lütfen Bekleyin...');$(".first input[type=submit]").attr("disabled", true);;jQuery.ajax({type: 'POST',url: 'inc/uye.php?islem=giris',data: "k="+k+"&s="+s,success: function(sonuc){sonuc = $.trim(sonuc);if(sonuc == "ok"){location.reload();}else {$(".first input[type=submit]").attr("disabled", false);;$(".first input[type=submit]").val('Giriş Yap');$(".first .sonuc").html(sonuc);}}})}});$(".second input[type=submit]").click(function(){var k = $(".second input[name=username]").val();if(k == ""){$(".second .sonuc").html("E-posta veya kullanıcı adını yazınız");}else {$(".second .sonuc").html('<img src="Assets/Img/loader1.gif" />');$(".second input[type=submit]").val('Lütfen Bekleyin...');$(".second input[type=submit]").attr("disabled", true);;jQuery.ajax({type: 'POST',url: 'inc/uye.php?islem=sifremiunuttum',data: "k="+k,success: function(sonuc){sonuc = $.trim(sonuc);if(sonuc == "ok"){$(".second input[name=username]").val("");$(".second input[type=submit]").val('Şifremi Gönder');$(".second .sonuc").html("Şifreniz başarıyla değiştirilip e-posta adresinize gönderilmiştir.<br /><br />E-posta adresinizde junk kısmına bakmanızı tavsiye ederiz.");}else {$(".second input[type=submit]").attr("disabled", false);;$(".second input[type=submit]").val('Şifremi Gönder');$(".second .sonuc").html(sonuc);}}})}});$(".third input[type=submit]").click(function(){var k = $(".third input[name=username]").val();var s = $(".third input[name=password]").val();var e = $(".third input[name=eposta]").val();if(k == ""){$(".third .sonuc").html("Kullanıcı adını yazınız");}else if(e == ""){$(".third .sonuc").html("E-posta adresinizi yazınız");}else if(s == ""){$(".third .sonuc").html("Şifrenizi yazınız");}else {$(".third .sonuc").html('<img src="Assets/Img/loader1.gif" />');$(".third input[type=submit]").val('Lütfen Bekleyin...');$(".third input[type=submit]").attr("disabled", true);;jQuery.ajax({type: 'POST',url: 'inc/uye.php?islem=uyeol',data: "k="+k+"&s="+s+"&e="+e,success: function(sonuc){sonuc = $.trim(sonuc);if(sonuc == "tamam"){$(".third ul").html('<li>Başarıyla üye oldunuz.<br /><br /><a href="javascript:void(0)" onclick="goster(\'first\')"><b>BURAYA</b> tıklayarak giriş yapabilirsiniz.</a></li>');}else {$(".third input[type=submit]").attr("disabled", false);;$(".third input[type=submit]").val('Üyeliğimi Tamamla');$(".third .sonuc").html(sonuc);}}})}});
			<?php } ?>
			
			$(".bulletin input[type=submit]").click(function(){
				var e = $(".bulletin input[type=text]").val();
				if(e == ""){
					alert("Bir e-posta adresi yazınız");
				}
				else {
					$(".bulletin input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/email.php',
							data: "e="+e,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "ok"){
									alert("E-posta adresiniz başarıyla eklenmiştir. Teşekkür ederiz");
								}
								else if(sonuc == "cikar"){
									alert("E-posta adresiniz başarıyla listemizden çıkarılmıştır. Teşekkür ederiz.");
								}
								else {
									alert(sonuc);
								}
								$(".bulletin input[type=submit]").attr("disabled", false);;
							}
						})
				}
			});
			
		});
		function denetle(){if($("input[name=domainismi]").val() == "") {alert ("Geçersiz Domain, Lütfen Kontrol Ediniz."); return false;}}
		function goster(nere){$(".first, .second, .third").hide();$("."+nere).show();}
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>