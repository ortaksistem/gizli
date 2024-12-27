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
    <title>Buzzy.Com ile İletişime Geçin</title>
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

			<div class="k-top2"><h2>Buzzy.Com</h2></div>
			
			<div class="k-top3"><span>Bizimle iletişime geçin</span></div>
			
			<div class="k-icerik">
				<img src="Assets/Img/iletisim-resim.png" class="iletisim-resim" alt="İletişim" />
				<form action="javascript:void(0)" name="iletisimformu" method="post">
				<table class="iletisimformu">
					<tbody>
						<tr><td width="200">Adınız</td><td>:</td><td><input type="text" name="isim" value="" placeholder="Adınızı yazınız" /></td></tr>
						<tr><td>Email Adresiniz</td><td>:</td><td><input type="text" name="email" value="" placeholder="E-posta adresiniz" style="width:250px;" /></td></tr>
						<tr><td>Telefon Numaranız</td><td>:</td><td><input type="text" name="tel" value="" placeholder="Telefon numaranız" style="width:250px;" /></td></tr>
						<tr><td>Konu</td><td>:</td><td><input type="text" name="konu" value="" placeholder="İletişim Konusu" style="width:300px;" /></td></tr>
						<tr><td>Mesajınız</td><td>:</td><td><textarea placeholder="Mesajınızı bu alana yazınız"></textarea></td></tr>
						<tr><td>&nbsp;</td><td>&nbsp;</td><td>
							<input type="image" onclick="javascript:document.iletisimformu.reset();"src="Assets/Img/sil-buton.png" /> 
							<input type="image" onclick="gonder()" src="Assets/Img/gonder-buton.png" /> 
							<br /><br /><span class="sonuc">&nbsp;</span>
						</td></tr>
					</tbody>
				</table>
				</form>
				
			</div>
		</div>
		<div class="clearfix"></div>
    </div>
<?php include("footer.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Assets/Js/jquery.flexslider.js"></script>
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
		
		function gonder(){
				var a1 = $(".iletisimformu input[name=isim]").val();
				var a2 = $(".iletisimformu input[name=email]").val();
				var a3 = $(".iletisimformu input[name=tel]").val();
				var a4 = $(".iletisimformu input[name=konu]").val();
				var a5 = $(".iletisimformu textarea").val();
				$(".iletisimformu input").css("border", "1px solid #d3e4f1");
				$(".iletisimformu textarea").css("border", "1px solid #d3e4f1");
				if(a1 == ""){
					$(".iletisimformu .sonuc").html("Size hitap edebilmemiz için bir isim yazınız.");
					$(".iletisimformu input[name=isim]").css("border", "1px solid red");
				}
				else if(a2 == "" && a3 == ""){
					$(".iletisimformu .sonuc").html("Size ulaşabilmemiz için bir telefon yada bir e-posta adresi yazınız.");
					$(".iletisimformu input[name=tel]").css("border", "1px solid red");
					$(".iletisimformu input[name=email]").css("border", "1px solid red");
				}
				else if(a4 == ""){
					$(".iletisimformu .sonuc").html("Size daha hızlı cevap verebilmemiz için bir konu yazınız.");
					$(".iletisimformu input[name=konu]").css("border", "1px solid red");
				}
				else if(a5 == ""){
					$(".iletisimformu .sonuc").html("Lütfen bir mesaj yazınız.");
					$(".iletisimformu textarea").css("border", "1px solid red");
				}
				else {
					$(".iletisimformu .sonuc").html("Mesajınız gönderiliyor, lütfen bekleyiniz.");
						jQuery.ajax({
							type: 'POST',
							url: 'inc/iletisim.php',
							data: "a1="+a1+"&a2="+a2+"&a3="+a3+"&a4="+a4+"&a5="+a5,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "tamam"){
									$(".iletisimformu .sonuc").html("<font color=green>Mesajınız başarıyla gönderilmiştir.</font>");
									document.iletisimformu.reset();
								}
								else {
									$(".iletisimformu .sonuc").html("<font color=red>"+sonuc+"</font>");
								}
							}
						})
				}
		}
		
		function goster(nere){$(".first, .second, .third").hide();$("."+nere).show();}
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>