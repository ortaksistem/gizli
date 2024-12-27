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
?>
<!DOCTYPE html>
<html lang="tr">
<head>

	<title>Yatak partner Sitesi, Partner Bul, Partner Arama, Partner sitesi, Yatak Arkadaşı</title>
	<meta name="description" content="En Seçkin Partner ve Arkadaş Bulma Sistemi Olan Yatakpartner Sitesi Sayesinde Aradığınız Partneri Bulmanız Artık Çok Kolay">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/giris.css">
	<link href="https://fonts.googleapis.com/css?family=Lalezar" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="/icon.png"/>

</head>
<body>
<div class="main">
	<div class="yp">
			<div class="title">YATAKPARTNER</div>
			<p>Hayallerinizi Ertelemeyin</p>
	</div>
	<div class="contact">
		<a href="javascript:void(0)">İletişim</a>
		<a href="javascript:void(0)">Canlı Destek</a>
	</div>
	<div class="resim">
		<img src="assets/img/resim.jpg" />
	</div>
	<div class="login">
		<ul>
			<li><input type="text" name="kadi" placeholder="Kullanıcı Adınız" /> </li>
			<li><input type="password" name="sifre" placeholder="Şifreniz" /> </li>
			<li class="button"><a href="#">&hearts; Giriş Yap</a></li>
			<li class="forgotpass"><a href="#">Şifremi Unuttum</a></li>
            <li class="sonuc"></li>

		</ul>
	</div>
	<div class="forgot">
		<div class="title">Şifremi Unuttum</div>
		<div class="line"></div>
		<p>E-mail adresinizi yazarak şifrenizi talep edebilirsiniz.</p>
		<input type="text" name="" placeholder="E-mail adresinizi yazınız" />
		<button>Gönder</button>
		<div class="close"><a href="#">Pencereyi Kapat</a></div>
	</div>

	<a href="ucretsiz-partner-bulma-sitesi.html" class="register">Kayıt Ol</a>

	<p class="content">En Farklı, En Eğlenceli, En Kaliteli Arkadaş ve Partner Bulma Sitesi</p>

	<div class="stat">
		<ul>
			<li>Online Üyeler</li>
			<li>Toplam Üye</li>
			<li>Dün Katılan</li>
			<li>Bugün Katılan</li>
		</ul>
		<div class="line"></div>
        <?php

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
		<ul>
			<li><?=$online?></li>
			<li><?=$toplam?></li>
			<li><?=$dun?></li>
			<li><?=$bugun?></li>
		</ul>

	</div>
</div>
<div class="contactform">
	<div class="title">İletişim Formu</div>
	<a href="#" class="close">asfsdfs</a>
	<div class="line"></div>
	<p>Her türlü soru, görüş ve önerilerinizi iletişim formumuzu kullanarak bize iletebilirsiniz.</p>
	<ul>
		<li><input type="text" name="ad" placeholder="Adınız soyadınız" /></li>
		<li><input type="text" name="tel" placeholder="Telefon numaranız"/></li>
		<li><input type="text" name="email" placeholder="Emmail adresiniz"/></li>
		<li><textarea name="mesaj" placeholder="Mesajınız"></textarea></li>
		<li><button>Mesajımı Gönder</button></li>
	</ul>
	<p class="close-a"><a href="#">KAPAT</a></p>
</div>
<div class="contentt">

<br><br><br><br><br>
<center><h1><span style="font-size: 12pt;"><strong>Partner Bul</strong></span></h1></center>
<p>Yatak Partner Sitesi, Türkiye'nin ilk Partner Siteleri nden biri olma özelliğini taşıdığı gibi, tam 16 yıldır partner bul, partner ara gibi isteklere de cevap vermektedir. Kendi alanında en iyi siteler arasında yer alıp, özlemini çektiğiniz sevgili hasretine de sizde bir çok üyemiz gibi sitemiz sayesinde son verebilirsiniz. </p>
<p>Arkadaşlık sitemize ücretsiz üye olup bu eğlencenin içinde olmak istiyorsanız mutlaka belirtmiş olduğumuz kurallara uymanız ve size özgü bir rumuz ile sisteme kayıt olmanız gerekmektedir. Hemen üye ol partner bul. </p>
<center><h2><span style="font-size: 12pt;"><strong>Yatak Arkadaşı</strong></span></h2></center>
<p>Hayallerinde ki Yatak Arkadaşı bulmanın en kolay yollarından birisi de tabii ki sistemimizde yer almanızdan geçiyor. Bununla birlikte dikkat etmeniz gereken diğer hususlar, tam doldurulmuş, resimli ve sizi en iyi şekilde ifade edecek, özenle hazırlanmış, karşı tarafa ne istediğinizi net bir şekilde anlatan bir profile sahip olmanızdır.</p>

<p>Basit ama belirleyici bir unsur olan bu bilgiler sizi diğer kullanıcılardan bir kaç adım öne çıkaracak ve Yatak Arkadaşı bulmanız için size avantaj sağlayacaktır. Partner siteleri size aradığınızı sunmak ve istediğiniz doğrultuda kişiler bulmanız için vardır. Sitemiz sayesinde hayalinizdeki aşkı bulmak sandığınız kadar zor olmasa gerek.</p>
<center><h2><span style="font-size: 12pt;"><strong>Partner Arama</strong></span></h2></center>
<p>Partner Arama siteleri kullanıcılara aradığını daha çabuk sunması ve kişilerin kendi istekleri doğrultusunda karşı tarafı yönlendirmesi, istek ve arzularını belirtmesi açısından kullanıcılar tarafından çok tercih edilen popüler bir sistemdir. Bu doğrultuda sitemiz yıllardır alışılagelen sitelerden ziyade daha farklı bir sunumla hazırlanmış ve üye olan tüm kullanıcılarımıza aradığını sunma gayretinde olmuştur.</p>

<p>Yetişkin kişilerin yer aldığı partner arama sitemizde kendi özgürlüğünü kazanmış ve kendi ayakları üzerinde duran, modern düşünceli ve hayatlarında bazı farklılıklar arayan kaliteli kişilerden oluştuğunu unutmayın lütfen.</p>
<center><h2><span style="font-size: 12pt;"><strong>Partner Siteleri</strong></span></h2></center>
<p>Her ne kadar partner sitesi olarak hizmet vermekte olsak ta bu sitede de kurallara mutlaka uymanız ve diğer üyeleri asla ve asla rahatsız etmemeniz gerekir. Cinsellik her insanın doğasında olan ve hemen hemen herkesin ihtiyaç duyduğu bir beden istemidir. Sitemiz aracılığı ile diğer üyelerle hem sohbet edecek, hem isteklerinize uygun eş bulacak, hemde yeni deneyim ve heyecanlar yaşayacaksınız.</p>

<p>Partner siteleri için genelde insanlar hem ön yargılı hemde birbirlerine karşı güvensiz olmaktadır. Bu ön yargıları aşmak bazen zor bir durum olsa da sitemizde hazırlayacağınız kaliteli bir profil ile bunu aşmanız mümkündür. İnsanlar kendilerine güven veren kişilerin yanında olmayı tercih ederler ve beraber vakit geçirmek isterler.
Yatak Partner Sitesi
</p>

&nbsp;
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/giris.js"></script>
</body>
</html>
<div style="display:none">
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(53593255, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/53593255" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</div>
<?php


function cache_bitir(){

    $fp = fopen(_CACHEDOSYASI, 'w+');

    fwrite($fp, ob_get_contents());

    fclose($fp);

    ob_end_flush();

}

cache_bitir();