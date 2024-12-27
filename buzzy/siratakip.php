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
    <title>Sıra Takip, <?=_BASLIK?></title>
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
	
	list($toplam) = @mysql_fetch_row(@mysql_query("select count(id) from siteler where uye='"._UYEID."'"));

	?>
    <div class="whitebg">
        <div class="container">
            <div class="kelime-listeleme-top clearfix">
                <div class="kelime-listeleme-sol left clearfix"><span class="text left">Site Ekleme Hakkı</span><span class="text right"><?=$toplam?>/32</span></div>
                <div class="kelime-listeleme-sag right"><span><strong>+</strong> <a href="javascript:void(0)" onclick="kelimeeklekapat()">Kelime Ekle</a> </span><span>/</span> <span><a href="javascript:void(0)" onclick="siteeklekapat()">Site Ekle</a> <strong>+</strong></span></div>
				<div class="siteekle">
					<div class="title"><p>Site Ekle</p></div>
					<form action="javascript:void(0)" method="post" name="siteekleform">
					<ul>
						<li><input type="text" name="siteadi" placeholder="Site adresini giriniz. Örn: google.com" /></li>
						<li><textarea name="sitekelime" placeholder="Kelimeleri Buraya Giriniz, aralarına virgül koyarak ayırınız"></textarea></li>
						<li> <b>Arama Motorları :</b><br /> <br /> 
							<input type="checkbox" name="google" value="1" /> Google &nbsp; 
							<input type="checkbox" name="yahoo" value="1" /> Yahoo &nbsp; 
							<input type="checkbox" name="bing" value="1" /> Bing &nbsp; 
							<input type="checkbox" name="yandex" value="1" /> Yandex &nbsp; 
						</li>
						<li><input type="submit" value=" Siteyi Ekle " class="buttons" /></li>
						<li class="sonuc">* İlk sıralar bulunacağından dolayı işlem uzun sürebilir.</li>
					</ul>
					</form>
				</div>
				<div class="kelimeekle">
					<div class="title"><p>Kelime Ekle</p></div>
					<form action="javascript:void(0)" method="post" name="kelimeekleform">
					<ul>
						<li><select name="site">
						<?php
						$result = @mysql_query("select id, site from siteler where uye='"._UYEID."' order by id desc");
						
						while(list($siteid, $site) = mysql_fetch_row($result)){
							
							$site = stripslashes($site);
							
							echo "<option value=$siteid>$site</option>";
						
						}
						?>
							</select>
						</li>
						<li><textarea name="sitekelime" placeholder="Kelimeleri Buraya Giriniz, aralarına virgül koyarak ayırınız"></textarea></li>
						<li> <b>Arama Motorları :</b><br /> <br /> 
							<input type="checkbox" name="google" value="1" /> Google &nbsp; 
							<input type="checkbox" name="yahoo" value="1" /> Yahoo &nbsp; 
							<input type="checkbox" name="bing" value="1" /> Bing &nbsp; 
							<input type="checkbox" name="yandex" value="1" /> Yandex &nbsp; 
						</li>
						<li><input type="submit" value=" Kelimeyi Ekle " class="buttons" /></li>
						<li class="sonuc">* İlk sıralar bulunacağından dolayı işlem uzun sürebilir.</li>
					</ul>
					</form>
				</div>
            </div>
			<?php
				
				if($toplam >= 1){
			
			?>
            <div class="kelime-listeleme">
                <table>
                    <thead>
                        <tr>
                            <th class="align-left">Site Adresi
                            </th>
                            <th class="width40">Ekli Kelimeler</th>
                            <th>Güncelle</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
						
						
						$result = @mysql_query("select id, site from siteler where uye='"._UYEID."' order by id desc");
						
						while(list($siteid, $site) = mysql_fetch_row($result)){
					
							$site = stripslashes($site);
							
							$kelime = @mysql_query("select id, kelime from kelimeler where site='$siteid' order by id asc");
							
							$kelimeler = "";
							
							while(list($kelimeid, $kelimead) = mysql_fetch_row($kelime)){
								
								$kelimeler .= $kelimead .", ";
							
							}
							
					?>
                        <tr id="site<?=$siteid?>">
                            <td><a href="#"><?=$site?></a></td>
                            <td><?=$kelimeler?></td>
                            <td class="align-center" id="guncelle<?=$siteid?>"><a href="javascript:void(0)" onclick="siteguncelle(<?=$siteid?>)"><img src="Assets/Img/guncelle.png" alt="Kelimeleri Güncelle" /></a></td>
                            <td class="align-center">
                                <a href="siratakipdetay.php?site=<?=$siteid?>"><img src="Assets/Img/git.png" alt="Kelime Detayları" /></a>
                                <a href="javascript:void(0)" onclick="sitesil(<?=$siteid?>)"><img src="Assets/Img/sil.png" /></a></td>
                        </tr>
					<?php
							
							unset($kelime);
							unset($kelimeler);
						}
					
					?>
                    </tbody>
                </table>
            </div>
			<?php
				
				}
			
			?>
        </div>
    </div>

<?php include("footer.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Assets/Js/jquery.flexslider.js"></script>
    <script>
        //$('.slider').flexslider({
        //    animation: "slide",
        //    controls: false
        //});
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
			$(".user-login").click(function(){$(".siteekle,.kelimeekle").css("display", "none");if($(".user-login2").css("display") == "none") $(".user-login2").css("display", "block");else $(".user-login2").css("display", "none");});
			
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
			
			$(".siteekle input[type=submit]").click(function(){
				var s = $(".siteekle input[name=siteadi]").val();
				var k = $(".siteekle textarea[name=sitekelime]").val();
				var g = $(".siteekle input[name=google]:checked").val();
				var y = $(".siteekle input[name=yahoo]:checked").val();
				var b = $(".siteekle input[name=bing]:checked").val();
				var ya = $(".siteekle input[name=yandex]:checked").val();
				if(s == ""){
					$(".siteekle .sonuc").html("Site adresini yazınız.");
				}
				else if(k == ""){
					$(".siteekle .sonuc").html("En az bir kelime yazınız");
				}
				else if(y != "1" && g != "1" && b != "1" && ya != "1"){
					$(".siteekle .sonuc").html("En az bir arama motoru seçiniz");
				}
				else {
					$(".siteekle .sonuc").html('<img src="Assets/Img/loader1.gif" />');
					$(".siteekle input[type=submit]").val('Lütfen Bekleyin...');
					$(".siteekle input[type=submit]").attr("disabled", true);;
						jQuery.ajax({
							type: 'POST',
							url: 'inc/siratakip.php?islem=siteekle',
							data: "s="+s+"&k="+k+"&g="+g+"&y="+y+"&ya="+ya+"&b="+b,
							success: function(sonuc){
								sonuc = $.trim(sonuc);
								if(sonuc == "tamam"){
									$(".siteekle .sonuc").html("Tamamdır");
									$(".siteekle input[type=submit]").attr("disabled", false);;
									$(".siteekle input[type=submit]").val('Siteyi Ekle');
									document.siteekleform.reset();
									$(".siteekle .sonuc").html("Site ve kelimeler eklendi. <a href='javascript:void(0)' onclick='siteeklekapat()'><b>Kapat</b></a>");
								}
								else {
									$(".siteekle input[type=submit]").attr("disabled", false);;
									$(".siteekle input[type=submit]").val('Siteyi Ekle');
									$(".siteekle .sonuc").html(sonuc);
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
		function sitesil(id){
			var onayla = confirm("Tüm veriler silinecek. İşlem sonu tekrar geri alınamaz. Emin misinz?");
			
			if(onayla){
				$("#site"+id).html("<td colspan='5'><p align=center><img src='Assets/Img/loader3.gif' /></p></td>");
						jQuery.ajax({
							type: 'POST',
							url: 'inc/siratakip.php?islem=sitesil',
							data: "id="+id,
							success: function(sonuc){
								$("#site"+id).hide();
							}
						})
			}
		}
		function siteguncelle(id){
			$("#guncelle"+id).html('<img src="Assets/Img/loader3.gif" />');
			jQuery.ajax({type: 'POST',url: 'inc/siratakip.php?islem=siteguncelle',data: "id="+id,success: function(sonuc){$("#guncelle"+id).html("<img src='Assets/Img/guncellendi.png' />");}})
			
		}
		function denetle(){if($("input[name=domainismi]").val() == "") {alert ("Geçersiz Domain, Lütfen Kontrol Ediniz."); return false;}}
		function goster(nere){$(".first, .second, .third").hide();$("."+nere).show();}
		function siteeklekapat(){$(".kelimeekle").css("display","none");if($(".siteekle").css("display") == "none") $(".siteekle").css("display", "block");else $(".siteekle").css("display", "none");}
		function kelimeeklekapat(){$(".siteekle").css("display","none");if($(".kelimeekle").css("display") == "none") $(".kelimeekle").css("display", "block");else $(".kelimeekle").css("display", "none");}
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>