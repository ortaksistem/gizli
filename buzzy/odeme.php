<?php
ob_start();
session_start();
include("fonksiyon.php");

$islem = $_GET["islem"];

$islem = suz2($islem);

if($islem == "ode"){
	
	$tur = $_POST["tur"];
	$item_number = $_POST["item_number"];
	$email = $_POST["email"];
	
	if($tur == "medium" or $tur == "large" and is_numeric($item_number) and $email == uyebilgi("eposta")){
	
		switch($tur){
			case "medium"; $tutar = 49;$aciklama = "Medium Uyelik Odemesi";break;
			case "large"; $tutar = 69;$aciklama = "Large Uyelik Odemesi";break;
		}

		$zaman = @mktime();
		
		list($maxid) = @mysql_fetch_row(@mysql_query("select max(id) from paypal"));
		
		$maxid++;
		
		@mysql_query("insert into paypal values ('.$maxid.', '"._UYEID."', '$item_number', '$tur', '$zaman')");
			
		// PayPal settings
		$paypal_email = 'info@yatakpartner.org';
		$return_url = "http://www.buzzy.com/odeme_alindi.php&item_number=$item_number&item=$maxid";
		$cancel_url = "http://www.buzzy.com/odeme.php";
		$notify_url = 'http://www.buzzy.com';

		$item_name = $aciklama;
		$item_amount = $tutar.".00";


		// Check if paypal request or response
		if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){

			// Firstly Append paypal account to querystring
			$querystring .= "?business=".urlencode($paypal_email)."&";

			// Append amount& currency (£) to quersytring so it cannot be edited in html

			//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
			$querystring .= "item_name=".urlencode($item_name)."&";
			$querystring .= "amount=".urlencode($item_amount)."&";

			//loop for posted values and append to querystring
			foreach($_POST as $key => $value){
				$value = urlencode(stripslashes($value));
				$querystring .= "$key=$value&";
			}
			

			
			// Append paypal return addresses
			$querystring .= "return=".urlencode(stripslashes($return_url))."&";
			$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
			$querystring .= "notify_url=".urlencode($notify_url);

			// Append querystring with custom field
			//$querystring .= "&custom=".USERID;

			// Redirect to paypal IPN
			header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
			die();

		}
		
	}
	else {
		yonlendir("odeme.php");
		die();
	}

} else {
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ödeme Sayfası, <?=_BASLIK?></title>
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

          <div class="content-detail">
                <h2>Üyelikler</h2>
                <h1>Seo Hosting</h1>
                <p>
                    SEO Hosting; her web sitenizi farklı C-CLASS IP adresleri üzerinde, tek kontrol paneli aracılığıyla (cPanel) barındırabilmenize olanak tanır. Arama Mot
                    optimizasyonu (SEO) ile ilgilenen veya arama motoru sonuç sayfalarındadır.
                   
                </p>
                <p>
                    Başta Google olmak üzere arama motorları web sitesi sahipleri için oldukça önemli. Çünkü her web sitesi sahip olduğu trafiğin büyük bir çoğunluğunu 
                arama motorlarından sağlıyor. Arama motorlarında üst sıralarda olmanızı sağlayan birçok etken var. Arama motorlarında üst sırada bulunmayı sağlayan 
                etkenlerden biri ise backlink.(sizin sitenize farklı sitelerden verilmiş bağlantılar) Kendi sitenize verdiğiniz bağlantılarda IP adresi aynı olacağı için alacağı
                verim farklı IP adreslerinden alınan bağlantılar kadar etkili değil. Bu sebepledir ki SEO Hosting, Aramotoru Optimizasyonu konusuyla ilgilenen, rekabel 
                içeren bir sektörde sitesini aktif tutmaya çalışan, arama motorlarında üst sıralarda olmak için aldığı bağlantıları (backlink) daha etkbir şekilde değerlend
                rmek isteyen kişiler için ideal bir hosting çözümüdür.
                </p>
            </div>
            <div class="fiyatlar clearfix">
                <div class="fiyat1 left">
                    <div class="baslik">Small Üyelik</div>
                    <div class="fiyat-content">
                        <ul>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Ücretiz üyelik</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Backlink Sorgu 1 Adet</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Sıra Bulucu 1 Adet</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Link Takip 1 Adet</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Rakip Analiz Yok</li>
                        </ul>
                        <div class="gun"><span></span>Süresiz<span></span></div>
                        <div class="fiyat">
                            Ücretsiz
                        </div>
                    </div>
                    <div class="odeme">
                        <form action="javascript:void(0)" method="post">
							<input type="image"  src="Assets/Img/fiyat1-ode.png" />
						</form>
                    </div>
                </div>
                <div class="fiyat2 left">
                    <div class="baslik">Medium Üyelik</div>
                    <div class="fiyat-content">
                        <ul>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Medium Paket Üyelik</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Backlink Sorgu 100 Adet</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Sıra Bulucu Sınırsız</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Link Takip Sınırsız</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Rakip Analiz 10 Kelime</li>
                        </ul>
                        <div class="gun"><span></span>1 Aylık <span></span></div>
                        <div class="fiyat">
                            49 TL
                        </div>
						<div class="odeme">
						<?php
							if(_UYEDURUM == 1){
							
							list($uyeid, $uyeemail, $uyeisim) = @mysql_fetch_row(@mysql_query("select id, eposta, isim from kullanici where id='"._UYEID."'"));
							
							
							$uyeemail = stripslashes($uyeemail);
							$uyeisim = stripslashes($uyeisim);
						?>
							<form action="odeme.php?islem=ode" method="post">
								<input name="cmd" type="hidden" value="_xclick" />
								<input name="tur" id="tur" type="hidden" value="medium" />
								<input name="no_note" type="hidden" value="1" />
								<input name="lc" type="hidden" value="TR" />
								<input name="currency_code" type="hidden" value="TRY" />
								<input name="bn" type="hidden" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
								<input name="first_name" type="hidden" value="<?php echo $uyeisim;?>" />
								<input name="email" type="hidden" value="<?php echo $uyeemail;?>" />
								<input name="item_number" type="hidden" value="<?php echo rand(100000,999999);?>" />
								<input type="image"  src="Assets/Img/fiyat2-ode.png" />
							</form>
						<?php
							}
							else {
						?>
							<a href="javascript:void(0)" onclick="uyeol()"><img src="Assets/Img/fiyat2-ode.png" title="Medium Üyelik" /></a>
						<?php
							}
						?>
                        </div>
                    </div>
                </div>
                <div class="fiyat3 left">
                    <div class="baslik">Large Üyelik</div>
                    <div class="fiyat-content">
                        <ul>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Large Paket Üyelik</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Backlink Sorgu Sınırsız</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Sıra Bulucu Sınırsız</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Link Takip Sınırsız</li>
                            <li>
                                <img src="Assets/Img/right-arrow.png" />
                                Rakip Analiz Sınırsız</li>
                        </ul>
                        <div class="gun"><span></span>1 Aylık <span></span></div>
                        <div class="fiyat">
                            69 TL
                        </div>
                    </div>
                    <div class="odeme">
						<?php
							if(_UYEDURUM == 1){
							
						?>
							<form action="odeme.php?islem=ode" method="post">
								<input name="cmd" type="hidden" value="_xclick" />
								<input name="tur" id="tur" type="hidden" value="large" />
								<input name="no_note" type="hidden" value="1" />
								<input name="lc" type="hidden" value="TR" />
								<input name="currency_code" type="hidden" value="TRY" />
								<input name="bn" type="hidden" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
								<input name="first_name" type="hidden" value="<?php echo $uyeisim;?>" />
								<input name="email" type="hidden" value="<?php echo $uyeemail;?>" />
								<input name="item_number" type="hidden" value="<?php echo rand(100000,999999);?>" />
								<input type="image"  src="Assets/Img/fiyat3-ode.png" />
							</form>
						<?php
							}
							else {
						?>
							<a href="javascript:void(0)" onclick="uyeol()"><img src="Assets/Img/fiyat3-ode.png" title="Medium Üyelik" /></a>
						<?php
							}
						?>
                    </div>
                </div>
            </div>
            <div class="content-detail">
                <h1>Seo Hosting</h1>
                <p>
                    SEO Hosting; her web sitenizi farklı C-CLASS IP adresleri üzerinde, tek kontrol paneli aracılığıyla (cPanel) barındırabilmenize olanak tanır. Arama Mot
                    optimizasyonu (SEO) ile ilgilenen veya arama motoru sonuç sayfalarındadır.
                   
                </p>
                <p>
                    Başta Google olmak üzere arama motorları web sitesi sahipleri için oldukça önemli. Çünkü her web sitesi sahip olduğu trafiğin büyük bir çoğunluğunu 
                arama motorlarından sağlıyor. Arama motorlarında üst sıralarda olmanızı sağlayan birçok etken var. Arama motorlarında üst sırada bulunmayı sağlayan 
                etkenlerden biri ise backlink.(sizin sitenize farklı sitelerden verilmiş bağlantılar) Kendi sitenize verdiğiniz bağlantılarda IP adresi aynı olacağı için alacağı
                verim farklı IP adreslerinden alınan bağlantılar kadar etkili değil. Bu sebepledir ki SEO Hosting, Aramotoru Optimizasyonu konusuyla ilgilenen, rekabel 
                içeren bir sektörde sitesini aktif tutmaya çalışan, arama motorlarında üst sıralarda olmak için aldığı bağlantıları (backlink) daha etkbir şekilde değerlend
                rmek isteyen kişiler için ideal bir hosting çözümüdür.
                </p>
            </div>
			
		</div>
		<div class="clearfix"></div>
    </div>
<?php include("footer.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>
		$(document).ready(function(){
			$(".user-login").click(function(){$(".linkekle").css("display", "none");if($(".user-login2").css("display") == "none") $(".user-login2").css("display", "block");else $(".user-login2").css("display", "none");});
			
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
		function uyeol(){alert("Üyelik yükseltebilmek için öncelikle üye olmanız gerekmektedir");$(".user-login2").css("display", "block");goster("third");}
		function goster(nere){$(".first, .second, .third").hide();$("."+nere).show();}
    </script>
</body>
</html>
<?php
} // end if
// ob_end_flush();
?>