<?php
ob_start();
session_start();
$site = $_GET["site"];
if(!is_numeric($site)) die("Go");
include("fonksiyon.php");
$site = suz2($site);

$result = mysql_query("select site from siteler where id='$site' and uye='"._UYEID."'");

list($siteadi) = mysql_fetch_row($result);

if(!$siteadi){
	
	yonlendir("index.php");
	
	die();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$siteadi?> kelimeleri, <?=_BASLIK?></title>
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
	<?php
	
	list($toplam) = @mysql_fetch_row(@mysql_query("select count(id) from kelimeler where site='$site'"));

	?>
     <div class="whitebg">
        <div class="container">
            <div class="kelime-listeleme-top clearfix">
                <div class="kelime-listeleme-sol left clearfix"><span class="text left">Site Kelime Hakkı</span><span class="text right"><?=$toplam?>/32</span></div>
                <div class="kelime-ekleme-sag right"><span><strong>+</strong> <a href="javascript:void(0)" onclick="kelimeeklekapat()">Kelime Ekle</a> </span></div>
				<div class="kelimeekle">
					<div class="title"><p>Kelime Ekle</p></div>
					<form action="javascript:void(0)" method="post" name="kelimeekleform">
					<ul>
						<li><select name="site">
						<?php
						$result = @mysql_query("select id, site from siteler where uye='"._UYEID."' order by id desc");
						
						while(list($siteid, $sites) = mysql_fetch_row($result)){
							
							$sites = stripslashes($sites);
							
							if($siteid == $site) echo "<option value=$siteid selected>$sites</option>";
							else echo "<option value=$siteid>$sites</option>";
						
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
            <div class="kelime-listeleme">
                <table>
                    <thead>
                        <tr>
                            <th class="align-left">Kelime
                            </th>
                            <th>Arama Motoru</th>
                            <th>Son Sıra</th>
                            <th>Sıra Değişimi</th>
                            <th>En İyi</th>
                            <th>Son Kont.</th>
                            <th>İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
						
						$result = mysql_query("select * from kelimeler where site='$site'");
						
						while($array = mysql_fetch_array($result)){
						
						$aramamotor = NULL;
						$siradegisim = NULL;
						$ilksiramiz = NULL;
						$sonkontrol = NULL;
						$sonsiramiz = NULL;
						
							if($array["google"] == 1) {
								
								$aramamotor .= "Google ";
								
								$ilksira = $array["googleortasira"];
								$sonsira = $array["googlesonsira"];
								
								if($sonsira > $ilksira) $siradegisim .= '<img src="Assets/Img/downarroworange.png" />';	
								if($sonsira < $ilksira) $siradegisim .= '<img src="Assets/Img/uparrowgreen.png" />';
								if($sonsira == $ilksira) $siradegisim .= '-';
								
								$sonsiramiz .= $sonsira." ";
								
								$ilksiramiz .= $array["googleeniyi"]." ";
								
								$sonkontrol = $array["googlesonkontrol"];
								
							}
							
							if($array["yandex"] == 1) {
							
								$aramamotor .= "/ Yndx ";
								
								$ilksira = $array["yandexortasira"];
								$sonsira = $array["yandexsonsira"];
								
								if($sonsira > $ilksira) $siradegisim .= ' / <img src="Assets/Img/downarroworange.png" />';	
								if($sonsira < $ilksira) $siradegisim .= ' / <img src="Assets/Img/uparrowgreen.png" />';
								if($sonsira == $ilksira) $siradegisim .= ' / -';
								
								$sonsiramiz .= "/ ". $sonsira." ";
								
								$ilksiramiz .= "/ ". $array["yandexeniyi"]." ";
								
								$sonkontrol = $array["yandexsonkontrol"];
								
							}
							
							if($array["yandexeniyi"] == NULL) die("ola");

							if($array["yahoo"] == 1) {
							
								$aramamotor .= "/ Yaho ";
								
								$ilksira = $array["yahooortasira"];
								$sonsira = $array["yahoosonsira"];
								
								if($sonsira > $ilksira) $siradegisim .= ' / <img src="Assets/Img/downarroworange.png" />';	
								if($sonsira < $ilksira) $siradegisim .= ' / <img src="Assets/Img/uparrowgreen.png" />';
								if($sonsira == $ilksira) $siradegisim .= ' / -';
								
								$sonsiramiz .= "/ ". $sonsira." ";
								
								$ilksiramiz .= "/ ". $array["yahooeniyi"]." ";
								
								$sonkontrol = $array["yahoosonkontrol"];
								
							}							
							if($array["bing"] == 1) {
							
								$aramamotor .= "/ Bing ";
								
								$ilksira = $array["bingortasira"];
								$sonsira = $array["bingsonsira"];
								
								if($sonsira > $ilksira) $siradegisim .= ' / <img src="Assets/Img/downarroworange.png" />';	
								if($sonsira < $ilksira) $siradegisim .= ' / <img src="Assets/Img/uparrowgreen.png" />';
								if($sonsira == $ilksira) $siradegisim .= ' / -';
								
								$sonsiramiz .= "/ ". $sonsira." ";
								
								$ilksiramiz .= "/ ". $array["bingeniyi"]." ";
								
								$sonkontrol = $array["bingsonkontrol"];							
							}
							
							if(!$sonkontrol) $sonkontrol = @mktime();
							
							$sonkontrol = date("d.m.Y", $sonkontrol);
					?>
                        <tr id="kelime<?=$array["id"];?>">
                            <td class="align-left"><?=stripslashes($array["kelime"]);?></td>
                            <td class="align-center"><?=$aramamotor?></td>
                            <td class="align-center"><?=$sonsiramiz?></td>
                            <td class="align-center"><?=$siradegisim?></td>
                            <td class="align-center"><?=$ilksiramiz?></td>
                            <td class="align-center"><?=$sonkontrol?></td>
                            <td class="align-center"><a href="kelimedetay.php?id=<?=$array["id"];?>">
                                                         <img src="Assets/Img/git.png" /></a>
                                <a href="javascript:void(0)" onclick="kelimesil(<?=$array["id"];?>)">
                                    <img src="Assets/Img/sil.png" /></a></td>
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
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Assets/Js/jquery.flexslider.js"></script>
    <script>
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
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>