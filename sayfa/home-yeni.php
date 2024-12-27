<?

$sorgulama = ayar("sorgulama");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="tr" lang="tr">
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<title><?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="goole-site-verification" content="aVDSnWshymkbicBHOBO323QVlrU8hqA_s8aek9KthY4" />
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
							alert("Giriş Başarısız");

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
?><div id="main" class="main">		<div class="destek">		<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=iletisim', '530', '450', 'iletisim', 2, 1, 1);"> home-yeni</a>		<a href="javascript:void(0)" onClick="pencere('index.php?sayfa=iletisim', '530', '450', 'iletisim', 2, 1, 1);"> canli destek</a>	</div>		<div class="uyeol1"><a href="index.php?sayfa=uyeol"><img src="img/yeni-sende-simdi-uye-ol.jpg" /></a></div>		<div id="yukleniyor" class="yukleniyor"><img src="img/loading8.gif" /> Giriş Yapılıyor, Bekleyin...</div>		<div class="kullanicigiris">		<ul>			<li class="kullanici"><input type="text" name="kullanicii" id="kullanicii" value="Kullanıcı adınız" class="inputkullanici" onFocus="if(this.value=='Kullanıcı adınız')this.value=''" onBlur="if(this.value=='')this.value='Kullanıcı adınız'" /></li>			<li class="sifre"><input type="password" name="sifree" id="sifree" value="Sifreniz" class="inputsifre" onFocus="if(this.value=='Sifreniz')this.value=''" onBlur="if(this.value=='')this.value='Sifreniz'" /></li>			<li class="buton">				<ul>					<li class="buttongiris2"><input type="image" src="img/yeni-giris-buton.jpg" class="buttongiris" onclick="login()" /></li>					<li class="sifreiste"><a href="javascript:void(0)" onClick="pencere('index.php?sayfa=sifremi_unuttum', '370', '380', 'sifremiunuttum', 2, 1, 1);" title="Şifre hatırlat">Şifremi Unuttum</a><br /><a href="javascript:void(0)" onClick="pencere('index.php?sayfa=onay_maili', '770', '380', 'onaymaili', 2, 1, 1);" title="Onay Mailim Gelmedi">Onay mailim gelmedi</a></li>				</ul>			</li>		</ul>	</div>								<?php
								
									$result = mysql_query("select count(uye) from "._MX."online");
									
									list($online) = mysql_fetch_row($result);
									
									$result = mysql_query("select count(id) from "._MX."uye");
									
									list($toplam) = mysql_fetch_row($result);
									
									$simdi = mktime();
									
									$dun = mktime(0, 0, 0, date("m"), date("d"),   date("Y")); 
									
									$dun2 = mktime(0, 0, 0, date("m"), date("d")-1,   date("Y")); 
									
									$result = mysql_query("select count(id) from "._MX."uye where kayit < '$simdi' and kayit > '$dun'");
									
									list($bugun) = mysql_fetch_row($result);
									
									$result = mysql_query("select count(id) from "._MX."uye where kayit < '$dun' and kayit > '$dun2'");
									
									list($dun) = mysql_fetch_row($result);									
								
								?>
									<div class="istatistik">		<ul>			<li class="onlinee2"><?=$online?></li>			<li class="toplam"><?=$toplam?></li>			<li class="bugun"><?=$bugun?></li>			<li class="dun"><?=$dun?></li>		</ul>	</div>		<div class="uyeol2"><a href="index.php?sayfa=uyeol"><img src="img/yeni-uyeol2.jpg" /></a></div>		<div class="kizlar"><img src="img/yeni-hatun.jpg" /></div></div></body></html>
							home-yeni