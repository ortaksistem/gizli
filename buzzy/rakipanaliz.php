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
    <title>Rakip Takip, <?=_BASLIK?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link href="Assets/Css/reset.css" rel="stylesheet" />
    <link href="Assets/Css/flexslider.css" rel="stylesheet" />
    <link href="Assets/Css/font-awesome.min.css" rel="stylesheet" />
    <link href="Assets/Css/main.css" rel="stylesheet" />
	<base href="<?=_URL?>" />
</head>
<body>
<?php include("header.php"); ?>
	<?php
	
	list($toplam) = @mysql_fetch_row(@mysql_query("select count(id) from rakip where uye='"._UYEID."'"));

	?>
     <div class="whitebg">
        <div class="container">
            <div class="kelime-listeleme-top clearfix">
                <div class="kelime-listeleme-sol left clearfix"><span class="text left">Ekleme Hakkı</span><span class="text right"><?=$toplam?>/32</span></div>
                <div class="kelime-listeleme-sag right"><span><a href="javascript:void(0)" onclick="rakipeklekapat()">Rakip Analiz Site Ekle</a> <strong>+</strong></span></div>
				<div class="rakipekle">
					<div class="title"><p>Ekle</p></div>
					<form action="javascript:void(0)" method="post" name="rakipekleform">
					<ul>
						<li><input type="text" name="kelime" placeholder="Hedef Kelime (Örn : arama motoru)" /></li>
						<li><input type="text" name="site" placeholder="Kendi Siteniz. (Rakiplerle kıyaslanacak site)" /></li>
						<li><textarea name="siteler" placeholder="Takip edilmesini istediğiniz siteleri giriniz. Aralarına virgül koyarak çoklu ekleme yapabilirsiniz. Site Hedef Kelime'de ilk 10 sayfa içerisinde bulunmalıdır."></textarea></li>
						<li><input type="submit" value=" Ekle " class="buttons" /></li>
						<li class="sonuc">- Analizler yapılacağından işlem uzun sürebilir. <br />- Max 10 site eklenebilir. <br />- 10 siteden sonra sorgulama yapılmayacaktır.</li>
					</ul>
					</form>
				</div>
            </div>
            <div class="kelime-listeleme">
                <table>
                    <thead>
                        <tr>
                            <th class="align-left" style="width:230px">Ana Site
                            </th>
                            <th style="width:230px">Hedef Kelime</th>
                            <th>Siteler</th>
                            <th>Son Kontrol</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
						
						$result = mysql_query("select * from rakip where uye='"._UYEID."' order by id desc");
						
						while($array = mysql_fetch_array($result)){
							
							$id = $array["id"];
							$site = stripslashes($array["site"]);
							$kelime = stripslashes($array["kelime"]);
							
							$guncelleme = date("d.m.Y", $array["guncelleme"]);
							
							$siteler = explode("|", $array["siteler"]);
							
							$sit = NULL;
							foreach($siteler as $s){
								
								$s = stripslashes($s);
								
								$sit .= $s ."<br />";
							
							}
							
					?>
                        <tr id="rakip<?=$array["id"];?>">
                            <td class="align-left"><a href="http://<?=$site?>" target="_blank"><?=$site;?></a></td>
                            <td class="align-center" id="linklink<?=$id?>"><?=$kelime?></td>
                            <td class="align-center"><?=$sit?></td>
                            <td class="align-center"><?=$guncelleme?></td>
                            <td class="align-center">
								<a href="rakipanalizdetay.php?id=<?=$array["id"];?>"><img src="Assets/Img/git.png" alt="Analiz Detay" /></a>
                                <a href="javascript:void(0)" onclick="rakipsil(<?=$array["id"];?>)"><img src="Assets/Img/sil.png" /></a></td>
                        </tr>
					<?php	
						}
					
					?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>

<div id="popicerik">
	<div id="popkapat"><a href="javascript:void(0)" onclick="kapat()">KAPAT</a></div>
	<div id="popveri"></div>
</div>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Assets/Js/jquery.flexslider.js"></script>
    <script>
		$(document).ready(function(){
			$("input[name=domainismi]").on({focus: function(){if($(this).val() == "") $(this).val("http://");},blur: function(){if($(this).val() == "http://") $(this).val("");}});
			$(".user-login").click(function(){$(".linkekle").css("display", "none");if($(".user-login2").css("display") == "none") $(".user-login2").css("display", "block");else $(".user-login2").css("display", "none");});
			
			$("*").click(function(e){
				if(!$(e.target).is('.user-login')){
					$(".user-login2").css("display", "none");
				}
			});
			
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
			


			$(".rakipekle input[type=submit]").click(function(){
				var s = $(".rakipekle input[name=kelime]").val();
				var l = $(".rakipekle input[name=site]").val();
				var a = $(".rakipekle textarea[name=siteler]").val();
				if(s == ""){
					$(".rakipekle .sonuc").html("Hedef Kelimeyi Yazınız.");
				}
				else if(l == ""){
					$(".rakipekle .sonuc").html("Kendi sitenizi yazınız.");
				}
				else if(a == ""){
					$(".rakipekle .sonuc").html("En az bir rakip yazınız.");
				}
				else {
					$(".rakipekle .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".rakipekle input[type=submit]").val('Lütfen Bekleyin...');
					$(".rakipekle input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/rakipanaliz.php?islem=rakipekle',
							data: "s="+s+"&l="+l+"&a="+a,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "hata2"){
									$(".rakipekle .sonuc").html("Eklediğiniz ana siteye ulaşamadım. O yüzden ekleme yapamıyorum.");
								}
								else if(sonuc == "hata1"){
									$(".rakipekle .sonuc").html("Karşılaştırma siteleri eksik.");
								}
								else if(sonuc == "gotogo"){
									$(".rakipekle .sonuc").html("Bilinmeyen hata");
								}
								else {
									window.location = 'rakipanalizdetay.php?id='+sonuc;
								}
								$(".rakipekle input[type=submit]").attr("disabled", false);;
								$(".rakipekle input[type=submit]").val('Ekle');
							}
						})
				}
			});		
		});
		
		function rakipsil(id){
			var onayla = confirm("Tüm veriler silinecek. İşlem sonu tekrar geri alınamaz. Emin misinz?");
			
			if(onayla){
				$("#rakip"+id).html("<td colspan='7'><p align=center><img src='Assets/Img/loader3.gif' /></p></td>");
						jQuery.ajax({
							type: 'POST',
							url: 'inc/rakipanaliz.php?islem=sil',
							data: "id="+id,
							success: function(sonuc){
								$("#rakip"+id).hide();
							}
						})
			}
		}
		function denetle(){if($("input[name=domainismi]").val() == "") {alert ("Geçersiz Domain, Lütfen Kontrol Ediniz."); return false;}}
		function goster(nere){$(".first, .second, .third").hide();$("."+nere).show();}
		function rakipeklekapat(){if($(".rakipekle").css("display") == "none") $(".rakipekle").css("display", "block");else $(".rakipekle").css("display", "none");}
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>