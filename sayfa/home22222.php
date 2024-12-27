<?

$ftp_cache = 5; // dakika cinsinden

function cache_baslat(){
	global $ftp_cache;


	$filename = "anasayfa.html";

	$cachefile = "cache/".$filename;

	define("_CACHEDOSYASI", $cachefile);
	
	$zaman = 60 * $ftp_cache;

	$cachetime = $zaman;

	if (file_exists($cachefile))

	{

	if(time() - $cachetime < filemtime($cachefile))

	{

	readfile($cachefile);

	exit;

	}

	else

	{

	unlink($cachefile);

	}

	}

	ob_start();

	//Ftp Cache	

}

cache_baslat();

$sorgulama = ayar("sorgulama");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="tr" lang="tr">
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<title>Yatak partner sitesi - Seks Partner, Sex Partner, Seks Partneri, Seks Arkadaşı, Sex Arkadaş</title>
<meta name="description" content="En Seçkin Partner ve Arkadaş Bulma Sistemi Olan Yatakpartner Sitesi Sayesinde Aradığınız Sevgiliyi, Arkadaşı ve Partneri Bulmanız Artık Çok Kolay">
<meta name="google-site-verification" content="ga9mBwCMcSfHpt_asMh1VsDskGEogyqUkaiT_31XhY4" />
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" href="inc/zd.css" type="text/css" />
<script type="text/javascript" src="inc/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="inc/style-new.css" /><style type="text/css">
	@import url("inc/style-reset-new.css");
</style><!--[if IE 6]>
<script type="text/javascript" src="inc/style-png.js"></script>
<![endif]-->
<?
	// 18 yaş sorgualaması
	if($sorgulama == 1){
?>
<script type="text/javascript" src="inc/jquery.cookie.js"></script>
<script type="text/javascript">
	function sorgulama(){
		var bak = <?=$sorgulama;?>;
		
		if(bak >= 1){
				
				$('#main').hide();
					
				var winH = $(window).height();
				var winW = $(window).width();	
				
				$("#sorgulama").css('top',  winH/2-$("#sorgulama").height()/2);
				$("#sorgulama").css('left', winW/2-$("#sorgulama").width()/2);
				
				$("#sorgulama").fadeIn(1000);
				
		}
	}
	function girisyap(){
		$("#sorgulama").hide();
		$("#main").show();
	}
</script>
<?
	}
?>
<script type="text/javascript">
	function login(){
		var kullanici = $("#kullanicii").val();
		var sifre = $("#sifree").val();;
		
		if(kullanici == '' || kullanici == 'Kullanıcı adınız'){
			alert("Kullanıcı adını yazmadınız");
		}
		else if(sifre == '' || sifre == 'Sifreniz'){
			alert("Şifrenizi yazmadınız");
		}
		else {
			$("#yukleniyor").show();

				jQuery.ajax({
					type : 'POST',
					url : 'inc/giris.php',
					data : "kullanici="+kullanici+"&sifre="+sifre,
					success: function(sonuc){		
						if(sonuc == "ok"){
							yonlendir("index.php?sayfa=giris");
						}	
						else if(sonuc == "hata1"){
							$("#yukleniyor").hide();
							alert("Tüm alanları doldurun");
						}
						else if(sonuc == "hata2"){
							$("#yukleniyor").hide();
							alert("Giriş Başarısız");
						}
						else if(sonuc == "hata3"){
							$("#yukleniyor").hide();
							alert("Üyeliğiniz henüz onaylanmamış");
						}
						else {
							$("#yukleniyor").hide();
							alert(sonuc);

						}
					}
				})
				
		}
	}
	
	function yonlendir(url){
		window.location = url;
	}
	
</script>
</head>
<body <?php if($sorgulama == 1) echo "onLoad=\"sorgulama()\""; ?>>
<?
	if($sorgulama == 1){
		echo "<div id=\"sorgulama\" style=\"display:none\">";
		include("sayfa/uyari.php");
		echo "</div>";
	}
?><div id="main" class="main">		<div class="destek">		<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=iletisim', '530', '450', 'iletisim', 2, 1, 1);"> iletisim</a>		<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=iletisim', '530', '450', 'iletisim', 2, 1, 1);"> canli destek</a>	</div>		<div class="uyeol1"><a href="index.php?sayfa=uyeoluyari"><img src="img/yeni-sende-simdi-uye-ol.jpg" /></a></div>		<div id="yukleniyor" class="yukleniyor"><img src="img/loading8.gif" /> Giriş Yapılıyor, Bekleyin...</div>		<div class="kullanicigiris">		<ul>			<li class="kullanici"><input type="text" name="kullanicii" id="kullanicii" value="Kullanıcı adınız" class="inputkullanici" onFocus="if(this.value=='Kullanıcı adınız')this.value=''" onBlur="if(this.value=='')this.value='Kullanıcı adınız'" /></li>			<li class="sifre"><input type="password" name="sifree" id="sifree" value="Sifreniz" class="inputsifre" onFocus="if(this.value=='Sifreniz')this.value=''" onBlur="if(this.value=='')this.value='Sifreniz'" /></li>			<li class="buton">				<ul>					<li class="buttongiris2"><input type="image" src="img/yeni-giris-buton.jpg" class="buttongiris" onclick="login()" /></li>					<li class="sifreiste"><a href="javascript:void(0)" onClick="pencere('index.php?sayfa=sifremi_unuttum', '370', '380', 'sifremiunuttum', 2, 1, 1);" title="Şifre hatırlat">Şifremi Unuttum</a><br /><a href="javascript:void(0)" onClick="pencere('index.php?sayfa=onay_maili', '770', '380', 'onaymaili', 2, 1, 1);" title="Onay Mailim Gelmedi">Onay mailim gelmedi</a></li>				</ul>			</li>		</ul>	</div>								<?php
								
									$result = mysql_query("select count(uye) from "._MX."online");
									
									list($online) = mysql_fetch_row($result);
									
									$result = mysql_query("select count(id) from "._MX."uye");
									
									list($toplam) = mysql_fetch_row($result);
									
									$simdi = time();
									
									$dun = time() - (60 * 60 * date("H") + 60 * date("i")); 
									
									
									$dun2 = $dun - (24 * 60 * 60); 
									
									$result = mysql_query("select count(id) from "._MX."uye where kayit < '$simdi' and kayit > '$dun'");
									
									list($bugun) = mysql_fetch_row($result);
									
									$result = mysql_query("select count(id) from "._MX."uye where kayit < '$dun' and kayit > '$dun2'");
									
									list($dun) = mysql_fetch_row($result);									
								
								?>
									<div class="istatistik">		<ul>			<li class="onlinee2"><?=$online?></li>			<li class="toplam"><?=$toplam?></li>			<li class="bugun"><?=$bugun?></li>			<li class="dun"><?=$dun?></li>		</ul>	</div>		<div class="uyeol2"><a href="index.php?sayfa=uyeoluyari"><img src="img/yeni-uyeol2.jpg" /></a></div>		<div class="kizlar"><img src="img/yeni-hatun.jpg" /></div></div></body></html><?php 
function cache_bitir(){

		$fp = fopen(_CACHEDOSYASI, 'w+');

		fwrite($fp, ob_get_contents());

		fclose($fp);

		ob_end_flush();
		
}

cache_bitir();
									?>
									
									
<div style="display:none">

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(52250113, "init", {
        id:52250113,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52250113" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</div>