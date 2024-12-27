<?php
ob_start();
session_start();
include("fonksiyon.php");
if(!yonetici()){
	yonlendir("index.php");
	die();
}

define("_YONETIM", "buzzy");

$result = @mysql_query("select * from kullanici where id='"._UYEID."'");

$array = @mysql_fetch_array($result);

$kullaniciadi = stripslashes($array["kullaniciadi"]);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Yönetici Anasayfa , <?=_BASLIK?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link href="Assets/Css/reset.css" rel="stylesheet" />
    <link href="Assets/Css/flexslider.css" rel="stylesheet" />
    <link href="Assets/Css/font-awesome.min.css" rel="stylesheet" />
    <link href="Assets/Css/main.css" rel="stylesheet" />
	<base href="<?=_URL?>" />
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Assets/Js/jquery.flexslider.js"></script>
    <script>
		$(document).ready(function(){
			$("input[name=domainismi]").on({focus: function(){if($(this).val() == "") $(this).val("http://");},blur: function(){if($(this).val() == "http://") $(this).val("");}});
			$(".user-login").click(function(){$(".linkekle").css("display", "none");if($(".user-login2").css("display") == "none") $(".user-login2").css("display", "block");else $(".user-login2").css("display", "none");});
			
			$("#destekler li").click(function(){
				var id = $(this).attr("id");
				if(id){
					$("."+id).remove();
					$("#"+id+" .durum").html("<img src='Assets/Img/loader3.gif' />");
					$(this).css("height", "100%");
							jQuery.ajax({
								type: 'POST',
								url: 'inc/profil.php?islem=destekicerik',
								data: "id="+id,
								success: function(sonuc){
									$("#"+id).after("<div class='"+id+"'>"+sonuc+"</div>");
									$("#"+id+" .durum").html($("#"+id+" .tarih2").html());
								}
							})
				}
			});
			
	
		});
    </script>
</head>
<body>
<?php include("header.php"); ?>
   <div class="whitebg">
        <div class="container">

			<div class="k-top"><h2>Hoşgeldin <?=$kullaniciadi?></h2></div>
			
			<?php
			
			$sayfa = $_GET["sayfa"];
			
			$sayfa = suz2($sayfa);
			
			if($sayfa){
				include("yonetim/".$sayfa.".php");
			}
			else {
			?>
			<div class="k-sol" id="hesapozeti">
				<div class="k-sol-top"><h3>Yönetici Özeti</h3></div>
				<div class="bilgi">
					Yönetici Anasayfaya Hoş Geldiniz
				</div>
			</div>
			<?php
			}
			
			?>

			
			<div class="k-sag">
				<div class="k-sag-top"><h3>ADMIN<span>PANELİ</span></h3></div>
				<ul>
					<li class="aktif"><a href="yonetim.php">Yönetici Anasayfa</a></li>
					<li><a href="yonetim.php?sayfa=uyeler">Üyeler</a></li>
					<li><a href="yonetim.php?sayfa=siteler">Siteler</a></li>
					<li><a href="yonetim.php?sayfa=linkler">Linkler</a></li>
					<li><a href="yonetim.php?sayfa=sorgular">Sorgulamalar</a></li>
					<li><a href="yonetim.php?sayfa=odemeler">Ödemeler</a></li>
					<li><a href="yonetim.php?sayfa=destek">Destek Mesajları</a></li>
					<li><a href="cikis.php">Güvenli Çıkış</a></li>
				</ul>
				<p>&nbsp;</p>
			</div>

        </div>
		<div class="clearfix"></div>
    </div>
<?php include("footer.php"); ?>

</body>
</html>
<?php
// ob_end_flush();
?>