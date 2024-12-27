<?php
session_start();
include("fonksiyon.php");

$domain = $_POST["domainismi"];
$tip = $_POST["domaintipi"];

$domain = suz2($domain);
$tip = suz2($tip);
if(!$tip) $tip = "domain";
if(!$domain){
	
	$referer = $_SERVER["HTTP_REFERER"];
	
	if($referer) $referer = "index.php";
	
	yonlendir($referer);

	die();

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Analiz, <?=_BASLIK?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <link href="Assets/Css/reset.css" rel="stylesheet" />
    <link href="Assets/Css/flexslider.css" rel="stylesheet" />
    <link href="Assets/Css/font-awesome.min.css" rel="stylesheet" />
    <link href="Assets/Css/main.css" rel="stylesheet" />
	<base href="<?=_URL?>" />
</head>
<body>
<?php include("header.php"); ?>
    <div class="header-search-bar">
        <div class="container">
            <div class="search clearfix">
			<form action="analiz.php" method="post">
                <input type="text" name="domainismi" class="searchtext" placeholder="www.domain.com" value="<?=$domain?>" />
                <button class="ara right"></button>
				<?php
					switch($tip){
						case "subdomain": $subdomain = " selected";break;
						case "prefix": $prefix = " selected";break;
						case "exact": $exact = " selected";break;
						default: $domainselect = " selected";break;
					
					}
				
				?>
                <select name="domaintipi" class="right">
                    <option value="domain"<?=$domainselect?>>*domain*</option>
                    <option value="subdomain"<?=$subdomain?>>*subdomain*</option>
                    <option value="prefix"<?=$prefix?>>*prefix*</option>
                    <option value="exact"<?=$exact?>>*exact*</option>
                </select>
			</form>
            </div>
        </div>
    </div>
	<?php

						list($maxid) = @mysql_fetch_row(@mysql_query("select max(id) from sorgu"));
						
						$maxid++;
						
						@mysql_query("insert into sorgu (id, uye, domain, tip, kayit) values('$maxid', '"._UYEID."', '$domain', '$tip', '".@mktime()."')");
						

						
						$suan = @mktime();
						
						$cache = @mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='metrics' and kayit > $suan");
						

						
						if(@mysql_num_rows($cache) >= 1){
							
							list($data) = @mysql_fetch_row($cache);
							
							$cek = json_decode($data);
							
							list($domainrating) = @mysql_fetch_row(@mysql_query("select veri from cache where site='$domain' and tip='$tip' and tur='domainrating' and kayit > $suan"));
							
							$domainrating = json_decode($domainrating);
							
							
						}
						else {
							
							$cachetime = $suan + (60*60*24*7);
							
							$data = NULL;
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='domainrating' and kayit < $suan");
							
							@mysql_query("delete from cache where site='$domain' and tip='$tip' and tur='metrics' and kayit < $suan");
							
							$domainrating = ahrefsanaliz("http://apiv2.ahrefs.com/?from=domain_rating&target=".$domain."&mode=".$tip."&output=json");					
							
							@mysql_query("insert into cache values('$domain', '$tip', 'domainrating', NULL, '".addslashes($domainrating)."', '$cachetime')");
							
							$domainrating = json_decode($domainrating);
							
							$cek = ahrefsanaliz("http://apiv2.ahrefs.com/?from=metrics_extended&target=".$domain."&mode=".$tip."&output=json");
							
							@mysql_query("insert into cache values('$domain', '$tip', 'metrics', NULL, '".addslashes($cek)."', '$cachetime')");
							
							$cek = json_decode($cek);
							
						}
						
							$domainrating2 = $domainrating->domain->domain_rating;
							$jquerybacklinks = $cek->metrics->backlinks;
							$jqueryrefering = $cek->metrics->refdomains;
							$jqueryrefips = $cek->metrics->refips;
							$jqueryexternal = $cek->metrics->links_external;
							$jquerypages = $cek->metrics->pages;	
							$backlink = sayicevirici($cek->metrics->backlinks);
							$backlink2 = sayicevirici2($cek->metrics->backlinks);
							

							$refdomains2 = sayicevirici($cek->metrics->refdomains);
							$refdomains = sayicevirici2($cek->metrics->refdomains);
							$refips = sayicevirici2($cek->metrics->refips);

							$refclass_c = sayicevirici2($cek->metrics->refclass_c);
							$linked_root_domains = sayicevirici2($cek->metrics->linked_root_domains);
							$refering = sayicevirici2($cek->metrics->refpages);
							$governmental = sayicevirici2($cek->metrics->gov);
							$educational = sayicevirici2($cek->metrics->edu);
							$text = sayicevirici2($cek->metrics->text);
							$dofollow = sayicevirici2($cek->metrics->dofollow);
							$nofollow = sayicevirici2($cek->metrics->nofollow);
							$image = sayicevirici2($cek->metrics->image);
							$sitewide = sayicevirici2($cek->metrics->sitewide);
							$nositewide = sayicevirici2($cek->metrics->not_sitewide);
							$rss = sayicevirici2($cek->metrics->rss);
							$alternate = sayicevirici2($cek->metrics->alternate);
							$htmlpages = sayicevirici2($cek->metrics->html_pages);
							$internal = sayicevirici2($cek->metrics->links_internal);
							$external = sayicevirici2($cek->metrics->links_external);
							$redirect = sayicevirici2($cek->metrics->redirect);
							$pages = sayicevirici2($cek->metrics->pages);						
						
	?>
    <div class="whitebg">
        <div class="container clearfix">
            <div class="left-sidebar left">
                <h2 class="menu-head1">Genel</h2>
                <ul class="menu">
                    <li><a href="javascript:void(0)" onclick="analiz()">Analiz</a></li>
                    <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'crawled', 1, <?=$jquerypages?>)">Taranan Sayfalar</a></li>
                    <?php /* <li><a href="javascript:void(0)" onclick="cografidagilim(<?=$maxid;?>)">Coğrafi Dağılım</a></li> */ ?>
                </ul>
                <h2 class="menu-head2">Gelen Linkler</h2>
                <ul class="menu">
                    <li class="submenu"><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'backlink', 1, <?=$jquerybacklinks?>)">Backlinkler</a>
                        <ul>
                            <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'backlinknew', 1, 1)">Yeni</a> / <a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'backlinklost', 1, 1)">Kayıp</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'backlinkbroken', 1, 1)">Kırık Backlinkler</a></li>
                    <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'anchors', 1, 1)">Kelimeler</a></li>
                    <li class="submenu"><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'refering', 1, <?=$jqueryrefering?>)">Referans Domainler</a>
                        <ul>
                            <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'referingnew', 1, 1)">Yeni</a> / <a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'referinglost', 1, 1)">Kayıp</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'refips', 1, <?=$jqueryrefips?>)">Referans IPler</a></li>
                </ul>
                <h2 class="menu-head3">Giden Linkler</h2>
                <ul class="menu">
                    <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'linkeddomain', 1, 1)">Linklenen Domainler</a></li>
                    <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'linkedanchor', 1, 1)">Kelimeler</a></li>
                    <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'linkbroken', 1, 1)">Kırık Dış Linkler</a></li>
                </ul>
            </div>
			<div class="analiz-content left" id="icerik">
			
			</div>
			
            <div class="analiz-content left" id="mainanaliz">

                <div class="clearfix">
                    <ul class="top-content">
                        <li class="domainrank clearfix">
                            <h3><strong>URL</strong> RANK</h3>
                            <span class="blue"><?=$domainrating2?></span>
                        </li>
                        <li class="backlinks clearfix">
                            <h3>BACKLINKS</h3>
                            <span class="orange"><?=$backlink?></span>
                        </li>
                        <li class="referer clearfix">
                            <h3><strong>REFFERING</strong><br />
                                DOMAINS</h3>
                            <span class="green"><?=$refdomains2?></span>
                        </li>
                        <li class="social clearfix" id="social_rank">
							<p><br /><img src="Assets/Img/loader3.gif" /></p>
                        </li>
                    </ul>
                    <div class="left-sidebar left">
                        <ul>
                            <li><a href="javascript:void(0)">Referans Sayfalar</a> <span class="yellow"><?=$refering?></span></li>
                            <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'backlink', 1, <?=$jquerybacklinks?>)">Toplam Backlink</a> <span class="yellow"><?=$backlink2?></span></li>
                            <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'crawled', 1, <?=$jquerypages?>)">Taranan Sayfalar</a> <span class="yellow"><?=$pages?></span></li>
                        </ul>
                        <ul>
                            <li><a href="javascript:void(0)" onclick="sorgu(<?=$maxid;?>, 'refips', 1, <?=$jqueryrefips?>)">Referans IPs</a> <span class="yellow"><?=$refips?></span></li>
                            <li><a href="javascript:void(0)">Referans Subnets</a> <span class="yellow"><?=$refclass_c?></span></li>
                            <li><a href="javascript:void(0)">Referans Domains</a> <span class="yellow"><?=$refdomains?></span></li>
                            <li><a href="javascript:void(0)">GOV</a> <span class="yellow"><?=$governmental?></span></li>
                            <li><a href="javascript:void(0)">EDU</a> <span class="yellow"><?=$educational?></span></li>
                        </ul>
                        <h4>
                            <img src="Assets/Img/zincir.png" />
                            Backlink Tipleri</h4>
                        <ul>
                            <li><a href="javascript:void(0)">text</a> <span class="yellow"><?=$text?></span></li>
                            <li><a href="javascript:void(0)">dofollow</a> <span class="yellow"><?=$dofollow?></span></li>
                            <li><a href="javascript:void(0)">nofollow</a> <span class="yellow"><?=$nofollow?></span></li>
                            <li><a href="javascript:void(0)">sitewide</a> <span class="yellow"><?=$sitewide?></span></li>
                            <li><a href="javascript:void(0)">no sitewide</a> <span class="yellow"><?=$nositewide?></span></li>
                            <li><a href="javascript:void(0)">redirect</a> <span class="yellow"><?=$redirect?></span></li>
                            <li><a href="javascript:void(0)">imaj</a> <span class="yellow"><?=$image?></span></li>
                            <li><a href="javascript:void(0)">gov</a> <span class="yellow"><?=$governmental?></span></li>
                            <li><a href="javascript:void(0)">edu</a> <span class="yellow"><?=$educational?></span></li>
						</ul>
                        <h4>
                            <img src="Assets/Img/zincir.png" />
                            Site İçi Link Tipleri</h4>
						<ul>
                            <li><a href="javascript:void(0)">Dış Linkler</a> <span class="yellow"><?=$external?></span></li>
                            <li><a href="javascript:void(0)">İç Linkler</a> <span class="yellow"><?=$internal?></span></li>
                            <li><a href="javascript:void(0)">Rss</a> <span class="yellow"><?=$rss?></span></li>
                            <li><a href="javascript:void(0)">Html Sayfalar</a> <span class="yellow"><?=$htmlpages?></span></li>
                            <li><a href="javascript:void(0)">Alternate</a> <span class="yellow"><?=$alternate?></span></li>
                        </ul>
                    </div>
                    <div class="analiz-detay left clearfix">
                        <h3><i class="fa fa-file-text"></i>Referring Pages </h3>	
						<div id="referingimaj" style="height:350px;margin-top:10px;"><p align="center"><img src="Assets/Img/loader3.gif" /></p></div>
                        <h3><i class="fa fa-file-text"></i>Backlink New & Lost </h3>	
						<div id="backlinkimaj" style="margin-top:10px;"><p align="center"><img src="Assets/Img/loader3.gif" /></p></div>
                    </div>
                </div>
                <div class="analiz-tag-cloud">
                    <h3><i class="cloud-icon"></i>Kelime Bulutu</h3>
                    <div class="tags clearfix">
                        <p align="center"><img src="Assets/Img/loader3.gif" /></p>
                    </div>
                </div>
                <div class="analiz-content-map">
                    <h3><i class="fa fa-globe"></i>Domain Dağılımı</h3>
                    <div class="map" id="domainimaj">
						<p align="center"><img src="Assets/Img/loader3.gif" width="12" height="12" /></p>
                    </div>
                </div>
				<div class="analizler2"></div>
            </div>

        </div>
    </div>
<?php include("footer.php"); ?>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="Assets/Js/jquery.flexslider.js"></script>
    <script>
    google.load('visualization', '1', {'packages':['corechart']});
        $('.cozumortakslider').flexslider({
            animation: "slide",
            animationLoop: false,
            itemWidth: 165,
            itemMargin: 6,
            controlNav: false,
            controls: true
        });
		$(document).ready(function(){
			$("input[name=domainismi]").on({focus: function(){if($(this).val() == "") $(this).val("http://www.");},blur: function(){if($(this).val() == "http://www.") $(this).val("");}});
			$(".user-login").click(function(){if($(".user-login2").css("display") == "none") $(".user-login2").css("display", "block");else $(".user-login2").css("display", "none");});
			
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
			
			
						jQuery.ajax({
							type: 'POST',
							url: 'inc/analiz.php?islem=sosyal',
							data: "id=<?=$maxid?>",
							success: function(sonuc3){
								$("#social_rank").html(sonuc3);
							}
						})	
						jQuery.ajax({
							type: 'POST',
							url: 'inc/analiz.php?islem=anchorcloud',
							data: "id=<?=$maxid?>&backlink=<?=$jquerybacklinks?>",
							success: function(sonuc2){
								$(".analiz-tag-cloud .tags").html(sonuc2);
							}
						})
						<?php
						/*

						jQuery.ajax({
							type: 'POST',
							url: 'inc/analiz.php?islem=anchortop',
							data: "id=<?=$maxid?>&backlink=<?=$jquerybacklinks?>&refering=<?=$jqueryrefering?>",
							success: function(sonuc3){
								$(".analizler2").html(sonuc3);
							}
						})		
						*/
						
						?>

			
		});
		
		function analiz(){$("#mainanaliz").show();$("#icerik").hide();}
		<?php /*
		function cografidagilim(id){
			$("#mainanaliz").hide();
			$("#icerik").show();
			$("#icerik").html("<p align=center><img src='Assets/Img/loader3.gif' /> Yükleniyor, bekleyiniz...</p>");
			  var jsonData = $.ajax({
				  url: "inc/analiz3.php?id="+id,
				  dataType:"json",
				  async: false
				  }).responseText;
				  
			  var data = new google.visualization.DataTable(jsonData);
			$("#icerik").html('<div class="analiz-content-map"><h3><i class="fa fa-globe"></i>Referans Dünya Dağılımı</h3><div class="map" id="map"></div></div>');
			  var chart = new google.visualization.GeoChart(document.getElementById('map'));
			  chart.draw(data, {width: 772, height: 350,colorAxis: {colors: ['#dddddd', '#487cac']}});
			
		}
		*/
		?>
		function sorgu(id, ney, sayfa, data){
			$("#mainanaliz").hide();
			$("#icerik").show();
			$("#icerik").html("<p align=center><img src='Assets/Img/loader3.gif' /> Yükleniyor, bekleyiniz...</p>");
			
						jQuery.ajax({
							type: 'POST',
							url: 'inc/sorgu.php?islem='+ney,
							data: "id="+id+"&sayfa="+sayfa+"&data="+data,
							success: function(sonuc){
								$("#icerik").html(sonuc);
							}
						})	
		}
		function sorgu2(id, ney, sayfa, data){
			$(".pagination .export").html("<img src='Assets/Img/loader3.gif' /> Yükleniyor, bekleyiniz...");
						jQuery.ajax({
							type: 'POST',
							url: 'inc/sorgu.php?islem='+ney,
							data: "id="+id+"&sayfa="+sayfa+"&data="+data,
							success: function(sonuc){
								$("#devaminiyukle").append(sonuc);
								sayfa = sayfa + 1;
								data = data + 30;
								$(".pagination .export").html('<a href="javascript:void(0)" onclick="sorgu2('+id+', \''+ney+'\', '+sayfa+', '+data+')" class="green left">DEVAMINI YÜKLE</a>');
							}
						})	
		}
		
		setTimeout(
		  function() 
		  {
			drawChart();
		  }, 3000);
		setTimeout(
		  function() 
		  {
			drawChart2();
		  }, 8000);
		setTimeout(
		  function() 
		  {
			drawChart4();
		  }, 5000);

		function drawChart() {
		  var jsonData = $.ajax({
			  url: "inc/analiz1.php?id=<?=$maxid?>&islem=veri1",
			  dataType:"json",
			  async: false
			  }).responseText;
			  
		  var data = new google.visualization.DataTable(jsonData);
		  var chart = new google.visualization.LineChart(document.getElementById('referingimaj'));
		  chart.draw(data, {width: 520, height: 350});
		}
		function drawChart2() {
		  var jsonData = $.ajax({
			  url: "inc/analiz1.php?id=<?=$maxid?>&islem=veri2",
			  dataType:"json",
			  async: false
			  }).responseText;
			  
		  var data = new google.visualization.DataTable(jsonData);
		  var chart = new google.visualization.ColumnChart(document.getElementById('backlinkimaj'));
		  chart.draw(data, {width: 520, height: 350,isStacked: true});
		}

		function drawChart4() {
		  var jsonData = $.ajax({
			  url: "inc/analiz1.php?id=<?=$maxid?>&islem=veri3",
			  dataType:"json",
			  async: false
			  }).responseText;
			  
		  var data = new google.visualization.DataTable(jsonData);
		  var chart = new google.visualization.LineChart(document.getElementById('domainimaj'));
		  chart.draw(data, {width: 772, height: 350});
		}
		function denetle(){if($("input[name=domainismi]").val() == "") {alert ("Geçersiz Domain, Lütfen Kontrol Ediniz."); return false;}}
		function goster(nere){$(".first, .second, .third").hide();$("."+nere).show();}
    </script>
</body>
</html>
<?php
// ob_end_flush();
?>