<?

error_reporting(0);

if(seviyeal("goruntuleme") != 1){
	yonlendir("index.php?sayfa=hata");
	die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyead = uyeadi();

$uye = $_GET["id"];

if(!is_numeric($uye)) header("Location: index.php");

list($varmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_yasakli where yasakli='$uyeid' and yasaklayan='$uye' or yasakli='$uye' and yasaklayan='$uyeid'"));

if($varmi >= 1){
	echo "<script>alert('Bu profil yasakland���ndan dolay� profili g�remezsiniz.'); window.close();</script>";
	die();
}

$result = mysql_query("select * from "._MX."uye where id='$uye'");

$uyeaktar = mysql_fetch_array($result);

$uyeadi = $uyeaktar["kullanici"];

$uyedurumune = $uyeaktar["durum"];

if(!$uyeadi){
	echo "<script>alert('B�yle bir isimde kullan�c� sistemimizde bulunmamaktad�r !'); window.close();</script>";
	die();
}

if($uyedurumune == 5){
	echo "<script>alert('�ye kendini sildi�inden profil bilgilerine ula��lamaz !'); window.close();</script>";
	die();
}

if($uyedurumune == 6){
	echo "<script>alert('Bu �ye y�neticiler taraf�ndan sistemden uzakla�t�r�lm��t�r !'); window.close();</script>";
	die();
}

$cinsiyet = $uyeaktar["cinsiyet"];

$cinsiyetadi = cinsiyet($cinsiyet);

$dogum = $uyeaktar["dogum"];

$dogumyil = date("Y", $dogum);

$yas = (date("Y")-$dogumyil);

$sehir = $uyeaktar["sehir"];



if($uyeid != $uye){

	$ay = date("m");
	
	$yil = date("Y");
	
	$hitbak = mysql_query("select count(uye) from "._MX."uye_hit where uye='$uye' and ay='$ay' and yil='$yil'");
	
	list($hitsay) = mysql_fetch_row($hitbak);
	
	$hitekle = $uyeid .";". uyeadi();
		
	if($hitsay < 1){
	
		$hitekle = $hitekle.";".time();
		
		mysql_query("insert into "._MX."uye_hit values('$uye', '$uyeadi', '$cinsiyet', '$yas', '$sehir', '1', '$hitekle', '$ay', '$yil')");	
		
		mysql_query("update "._MX."uye set topbakan=topbakan+1, goruntulenme=goruntulenme+1 where id='$uye'");
	
	}
	else {
	
		list($hitler) = mysql_fetch_row(mysql_query("select hitler from "._MX."uye_hit where uye='$uye' and ay='$ay' and yil='$yil'"));
	
		if(!strstr($hitler, $hitekle)){
		
			$yeniekle = $hitler .":::". $hitekle.";".time();
			
			mysql_query("update "._MX."uye_hit set hit=hit+1, hitler='$yeniekle' where uye='$uye' and ay='$ay' and yil='$yil'");
			
			mysql_query("update "._MX."uye set topbakan=topbakan+1, goruntulenme=goruntulenme+1 where id='$uye'");
			
		}
	}
	
}

?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title><?=$uyeadi?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<link rel="stylesheet" type="text/css" href="inc/reset.css" />
<link rel="stylesheet" type="text/css" href="inc/styleprofil.css" />
<link rel="stylesheet" type="text/css" href="inc/zd.css" />
<link rel="stylesheet" type="text/css" href="inc/lightbox.css" />
<link type='text/css' href='inc/basic.css' rel='stylesheet' media='screen' />
<script type="text/javascript" src="inc/jqueryprofil.js"></script>
<script type='text/javascript' src='inc/jquery.simplemodal.js'></script>
<script type='text/javascript' src='inc/lightbox.js'></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.resimgalerisi').lightBox({
			  maxHeight: 450, 
			  maxWidth: 450
			});	
	});
	function puanver(puan, uye){
		
		var yapan = <?=$uyeid?>;
		
		if(yapan == uye){
			mahirixalert("Oy Verin", "<font color=red><b>Kendi kendinize oy veremezsiniz</b></font>");
		}
		else {
				$("#vote-send").html("<img src='img/loading.gif' /> <font color=green><b>�yeye "+puan+" puan veriliyor, bekleyin..</font>");

				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=oy&yapan="+yapan+"&yapilan="+uye+"&puan="+puan,
					success: function(sonuc){		
						if(sonuc == "var"){
							$("#vote-send").html("<font color=red><b>Daha �nce puan verdiniz.</b></font>");
						}
						else {
							$("#vote-send").html("<font color=green><b>Oyunuz i�in te�ekk�r ederim</b></font>");
						}
					}
				})
		}
		
	}

	function begenenler(uye){
		
			
			mahirixpencere("<?=$uyeadi?>'in profilini be�enenler", "<p align=center><img src='img/loading.gif' /></p>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=profilinibegenenler',
				data : "uye="+uye,
				success: function(sonuc){		
					mahirixpencereguncelle(sonuc);
				}
			})

	
	}

	function begenengoster(i){
		$("#listele"+i).slideToggle(1);
	}

	function mesajgonder(uye){
		
		
		var mesajgonderme = <?=seviyeal("mesaj");?>;
		
		var gonderen = <?=$uyeid?>;
		

		
			if(mesajgonderme == 1){
			
			mahirixpencere("<?=$uyeadi?>'e mesaj g�nderin", "<p align=center><img src='img/loading.gif' /></p>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=mesajyaz',
				data : "uye="+uye+"&uyeadi=<?=$uyeadi?>",
				success: function(sonuc){		
					mahirixpencereguncelle(sonuc);
				}
			})
			
			}
			else {
				mahirixalert("Mesaj G�nderme", "<div><p><font color=red><b>Mesaj g�nderebilmek i�in l�tfen �yeli�inizi y�kseltiniz</b></font></p></div>");
						
			}
		
	
	}
	
	function hediyegonder(uye){
		mahirixalert("Hediye G�nder", "<div><p><font color=green><b>Hediye g�nderme hizmeti hen�z aktif de�ildir. Sizler i�in sistemimizi s�rekli yenilemekteyiz. Bu hizmette en k�sa s�rede aktif edilecektir. �lginize te�ekk�r ederiz.</b></font></p></div>");
	}
	
	function mesajgonderuygula(uye){
		
		var gonderen = <?=$uyeid?>;
				
		var konu = document.getElementById("konu").value;
		var mesaj = document.getElementById("mesaj").value;
		
		if(konu == ""){
			$("#mesajgondersonuc").html("<font color=red><b>Konuyu yaz�n</b></font>");
		}
		else if(mesaj == ""){
			$("#mesajgondersonuc").html("<font color=red><b>Mesaj� Yaz�n</b></font>");
		}
		else {
			$("#mesajgondersonuc").html("<img src='img/loading.gif' /> Bekleyin");

			jQuery.ajax({
				type : 'POST',
				url : 'inc/mesajgonder.php',
				data : "gonderen="+gonderen+"&gonderilen="+uye+"&mesaj="+mesaj+"&konu="+konu,
				success: function(sonuc){		
					if(sonuc == "ok"){
						mahirixpencereguncelle("<p align=center><font color=green><b>Mesaj�n�z �yemize ba�ar�yla iletilmi�tir</b></font>");
					}
					else if(sonuc == "hata1"){
						$("#mesajgondersonuc").html("<font color=red><b>G�nl�k mesaj g�nderme limitiniz dolmu�tur, daha fazla g�ndermek i�in �yeli�inizi y�kseltiniz</b></font>");
					}
					else {
						$("#mesajgondersonuc").html("<font color=red><b>Mesaj�n�z �uan g�nderilemiyor, l�tfen sonra tekrar deneyiniz</b></font>");
					}
				}
			})
				
		}
	
	}

	function yoneticiyebildir(uye){
		
		
		var gonderen = <?=$uyeid?>;
		

		

			
			mahirixpencere("<?=$uyeadi?>'i y�neticiye bildirin", "<p align=center><img src='img/loading.gif' /></p>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=yoneticiyebildir',
				data : "uye="+uye+"&uyeadi=<?=$uyeadi?>",
				success: function(sonuc){		
					mahirixpencereguncelle(sonuc);
				}
			})
			

		
	
	}

	function yoneticiyebildiruygula(uye){
		
		var gonderen = <?=$uyeid?>;
				
		var konu = document.getElementById("konu").value;
		var mesaj = document.getElementById("mesaj").value;
		
		if(konu == ""){
			$("#mesajgondersonuc").html("<font color=red><b>Konuyu yaz�n</b></font>");
		}
		else if(mesaj == ""){
			$("#mesajgondersonuc").html("<font color=red><b>Mesaj� Yaz�n</b></font>");
		}
		else {
			$("#mesajgondersonuc").html("<img src='img/loading.gif' /> Bekleyin");

			jQuery.ajax({
				type : 'POST',
				url : 'inc/yoneticiyebildir.php',
				data : "yer=profil&gonderen="+gonderen+"&gonderilen="+uye+"&mesaj="+mesaj+"&konu="+konu,
				success: function(sonuc){		
					if(sonuc == "ok"){
						mahirixpencereguncelle("<p align=center><font color=green><b>Bildiriminiz g�nderilmi�tir. En k�sa zamanda ilgilenilecektir. Te�ekk�r ederiz.</b></font>");
					}
					else {
						$("#mesajgondersonuc").html("<font color=red><b>Mesaj�n�z �uan g�nderilemiyor, l�tfen sonra tekrar deneyiniz</b></font>");
					}
				}
			})
				
		}
	
	}
		
	function yasakla(uye){
		
		var yasaklama = <?=seviyeal("yasakla");?>;
		
		if(yasaklama == 1){
			
			var yasaklayan = <?=$uyeid?>
			
			if(yasaklayan == uye){
				mahirixalert("�ye Yasaklama", "<div><p><font color=red><b>Kendi kendinizi yasaklayamazs�n�z</b></font></p></div>");			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=yasakla&yapan="+yasaklayan+"&yapilan="+uye,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("�ye Yasaklama", "<div><p><font color=red><b>�ye daha �nce yasaklanm��t�r.</b></font></p></div>");
						}
						else {
							mahirixalert("�ye Yasaklama", "<div><p><font color=green><b>�yeyi ba�ar�yla yasaklad�n�z.</b></font></p></div>");
						}
					}
				})
			
			}
		}
		else {
			mahirixalert("�ye Yasaklama", "<div><p><font color=red><b>�ye yasaklamak i�in l�tfen �yeli�inizi y�kseltiniz</b></font></p></div>");	
		}
	}
	
	function listemeekle(uye){
		
		var ekleme = <?=seviyeal("arkadas");?>;
		
		if(ekleme == 1){
			
			var ekleyen = <?=$uyeid?>
			
			if(ekleyen == uye){
				mahirixalert("Arkada� Listeme Ekle", "<div><p><font color=red><b>Kendi kendinizi listenize ekleyemezsiniz.</b></font></p></div>");			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=arkadas&yapan="+ekleyen+"&yapilan="+uye,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("Arkada� Listeme Ekle", "<div><p><font color=red><b>�ye daha �nce listenize eklenmi�tir.</b></font></p></div>");
						}
						else {
							mahirixalert("Arkada� Listeme Ekle", "<div><p><font color=green><b>�yeyi ba�ar�yla listenize eklediniz, �ye onaylad�ktan sonra arkada� olacaks�n�z.</b></font></p></div>");
						}
					}
				})
			
			}
		}
		else {
			mahirixalert("Arkada� Listeme Ekle", "<div><p><font color=red><b>Arkada� ekleyebilmek i�in l�tfen �yeli�inizi y�kseltiniz</b></font></p></div>");	
		}
	}
	
	function opucuk(uye){
		
		var opucuk = <?=seviyeal("opucuk");?>;
		
		if(opucuk == 1){
			
			var gonderen = <?=$uyeid?>
			
			if(gonderen == uye){
				mahirixalert("�p�c�k G�nderin", "<div><p><font color=red><b>Kendi kendinizi �p�c�k g�nderemezsiniz.</b></font></p></div>");			
			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=opucuk&yapan="+gonderen+"&yapilan="+uye,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("�p�c�k G�nderin", "<div><p><font color=red><b>�yeyi daha �nce �pt�n�z.</b></font></p></div>");
						}
						else {
							mahirixalert("�p�c�k G�nderin", "<div><p><font color=green><b>�yeyi ba�ar�yla �pt�n�z.</b></font></p></div>");
						}
					}
				})
			
			}
		}
		else {
			mahirixalert("�p�c�k G�nderin", "<div><p><font color=red><b>�p�c�k g�nderebilmek i�in l�tfen �yeli�inizi y�kseltiniz</b></font></p></div>");	
		}
	}
	
	function cicek(uye){
		
		var cicek = <?=seviyeal("cicek");?>;
		
		if(cicek == 1){
			
			var gonderen = <?=$uyeid?>
			
			if(gonderen == uye){
				mahirixalert("�i�ek G�nderin", "<div><p><font color=red><b>Kendi kendinizi �i�ek g�nderemezsiniz.</b></font></p></div>");			
			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=cicek&yapan="+gonderen+"&yapilan="+uye,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("�i�ek G�nderin", "<div><p><font color=red><b>�yeye daha �nce �i�ek g�nderdiniz.</b></font></p></div>");
						}
						else {
							mahirixalert("�i�ek G�nderin", "<div><p><font color=green><b>�yeye ba�ar�yla �i�ek g�nderdiniz.</b></font></p></div>");
						}
					}
				})
			
			}
		}
		else {
			mahirixalert("�p�c�k G�nderin", "<div><p><font color=red><b>�i�ek g�nderebilmek i�in l�tfen �yeli�inizi y�kseltiniz</b></font></p></div>");	
		}
	}
	
	
	function begendim(uye){
	
		var hangisi = document.getElementById("begendim").value;
		
		$("#begeniler").html("<font size=2>Bekleyin...</font>");


			var gonderen = <?=$uyeid?>
			
			if(gonderen == uye){
				mahirixalert("Be�enin", "<div><p><font color=red><b>Kendi kendinizi be�enemezsiniz.</b></font></p></div>");			
			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=begeni&yapan="+gonderen+"&yapilan="+uye+"&begeni="+hangisi,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("Be�eni G�nderin", "<div><p><font color=red><b>Daha �nce be�eniniz g�nderilmi�tir.</b></font></p></div>");
							$("#begeniler").html("");

						}
						else {
							mahirixalert("Be�eni G�nderin", "<div><p><font color=green><b>Be�eniniz ba�ar�yla iletilmi�tir.</b></font></p></div>");
							$("#begeniler").html("<font size=1><b>Be�eniniz g�nderildi</b></font>");
							$(".begen").css("background", "none");
						}
					}
				})
			
			}
			
				
	}
	
	function galeritalep(uye, galeri){


			var gonderen = <?=$uyeid?>
			
			if(gonderen == uye){
				mahirixalert("Galeri talebi", "<div><p><font color=red><b>Kendi kendinize galeri talebinde bulunamazs�n�z</b></font></p></div>");			
			}
			else {
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeprofilislem.php',
					data : "islem=galeritalep&yapan="+gonderen+"&yapilan="+uye+"&galeri="+galeri,
					success: function(sonuc){		
						if(sonuc == "var"){
							mahirixalert("Galeri talebi", "<div><p><font color=red><b>�uan talebiniz bulunmaktad�r. Galerilerim  men�s�nden takip edebilirsiniz</b></font></p></div>");

						}
						else {
							mahirixalert("Galeri talebi", "<div><p><font color=green><b>Galeri talebiniz ba�ar�yla iletilmi�tir.</b></font></p></div>");
						}
					}
				})
			
			}
			
				
	}

	function yildiz(kac, id){ 
		
		var data = "";
		var a = 1;
		var i = 1;

		for(i; i <= kac; i++){
			data = ""+data+" <a href='javascript:void(0)' onclick='puanver("+i+", "+id+")' onmouseout='javascript:yildizlar("+id+")' title='"+i+" Puan ver'><img src='img/profil-yildiz-acik.png' border='0' /></a>";
			a++;
		}
		for(i = a; i <= 5; i++){
			data = ""+data+" <a href='javascript:void(0)' onmouseover='yildiz("+i+", "+id+")' onmouseout='javascript:yildizlar("+id+")' title='"+i+" Puan ver'><img src='img/profil-yildiz-kapali.png' border='0' /></a>";
		}
		
		
		$("#vote-send").html(data);
	}
	
	function yildizlar(id){
		var data = "";
		var i = 1;
		
		for(i = 1; i <= 5; i++){
			data = ""+data+" <a href='javascript:void(0)' onmouseover='yildiz("+i+", "+id+")' title='"+i+" Puan ver'><img src='img/profil-yildiz-kapali.png' border='0' /></a>";
		}
			
		$("#vote-send").html(data);
	}
	
	
	function uyeprofil(nere){
		$(".tik-menu2 li").removeClass('aktif');
		
		$("#li"+nere).addClass('aktif');
		
		$(".sol .aciklama").hide();
		
		$("#"+nere).fadeIn("slow");
		
		
	}
	
	function sayfayikapat(){
		window.close();
	}
	
	function resimyukle(resim, gen){
	
		$("#resimlerid").html("<img src='"+resim+"' width="+gen+" />");
	
	}
</script>
</head>
<body>
<div id="mahirix-modal-content">
	<div id="mahirix-model-header">
		<div id="mahirix-model-title"></div>
		<div id="mahirix-model-title-kapat"><a href="javascript:void(0)" onclick="mahirixmodelkapat();" title="Kapat"><img src="img/mahirix_alert_kapat.png" border="0" /></a></div>
	</div>
	<div style="clear:both;"></div>
	<div id="mahirix-model-icc"></div>
	<div id="mahirix-model-alt"></div>
</div>
<div class="genel">
	<div class="header"><div class="logo"></div></div>
	<div class="header-menu">
		<div class="header-menu-sol"></div>
		<div class="nick"><?=$uyeadi?></div>
		
		<div class="menu">
			<?
				$online = mysql_query("select count(uye) from "._MX."online where uye='$uye'");
									
				list($onlinemi) = mysql_fetch_row($online);
									
				if($onlinemi >= 1) $online = "online";
				else $online = "offline";								

				$seviye = $uyeaktar["seviye"];
									
				switch($seviye){
					case "1": $seviyeicon = "large";break;
					case "2": $seviyeicon = "medium";break;
					case "3": $seviyeicon = "small";break;
					default: $seviyeicon = "small";break;
				}
									

				$webcam = $uyeaktar["webcam"];
									
				if($webcam == "Evet") $webcam = "var";
				else $webcam = "yok";
									
                ?>
			<ul>
				<li><img src="img/profil-<?=$seviyeicon?>-uye.jpg" alt="" /></li>
				<li class="ayrac"></li>
				<li><img src="img/profil-webcam-<?=$webcam?>.jpg" alt="" /></li>
				<li class="ayrac"></li>
				<li><img src="img/profil-<?=$online?>.jpg" alt="" /></li>
			</ul>
		</div>
		
		<div class="header-menu-sag"></div>
	</div>
	
	<div class="alt-menu">
		
		<div class="resim">
            <?
				$avatar = $uyeaktar["img"];
						
				if(!$avatar or $avatar == "img_uye/avatar/null.jpg") $oyverme = 1;
				$avatar = uyeavatar($avatar, $cinsiyet);
            ?>
			<a href="javascript:uyeprofil('resimleri')"><img class="profil-resmi" src="<?=$avatar?>" /></a>
			<a href="javascript:uyeprofil('resimleri')"><span class="profil-resim-adet">(<?=$uyeaktar["topresim"];?> Resim)</span></a>
		</div>
		<div class="temizle"></div>
		
		<div class="menumuz">
			<ul>
				<li class="mesajgonder"><a href="javascript:mesajgonder(<?=$uye?>);" title="Mesaj G�nder">Mesaj G�nder</a></li>
				<li class="ayrac"></li>
				<li class="listemeekle"><a href="javascript:listemeekle(<?=$uye?>);" title="Listeleme Ekle">Listeme Ekle</a></li>
				<li class="ayrac"></li>
				<li class="hediyegonder"><a href="javascript:hediyegonder(<?=$uye?>);" title="Hediye G�nder">Hediye G�nder</a></li>
				<li class="ayrac"></li>
				<li class="opucukyolla"><a href="javascript:opucuk(<?=$uye?>);" title="�p�c�k Yolla">�p�c�k Yolla</a></li>
				<li class="ayrac"></li>
				<li class="cicekyolla"><a href="javascript:cicek(<?=$uye?>);" title="�i�ek G�nder">�i�ek Yolla</a></li>
				<li class="ayrac"></li>
				<li class="sikayetet"><a href="javascript:yoneticiyebildir(<?=$uye?>);">Sikayet Et</a></li>
				<li class="ayrac"></li>
				<li class="yasakla"><a href="javascript:yasakla(<?=$uye?>);" title="�yeyi yasakla">Yasakla</a></li>
			</ul>
		</div>
		

		<div class="tik-menu">
			
			<div class="puanver">
                        <?php                 
                        
                        if($oyverme != 1){


                        $ay = date("m");
                        
                        $yil = date("Y");
                        
                        $oylayan = $uyeid .";". $uyead;
                        
                        $result = mysql_query("select count(uye), oylar from "._MX."uye_oy where uye='$uye' and oylar like '%$oylayan%' and ay='$ay' and yil='$yil'");
                        
                        list($oylandimi, $oylar) = mysql_fetch_row($result);
                        
                        if($oylandimi < 1){
                        
                        ?>
				<strong>Puan Ver :</strong> 
				<span id="vote-send">
				<a href="javascript:void(0)" onmouseover="yildiz(1, <?=$uye?>);"><img src="img/profil-yildiz-kapali.png" border="0" /></a>
				<a href="javascript:void(0)" onmouseover="yildiz(2, <?=$uye?>);"><img src="img/profil-yildiz-kapali.png" border="0" /></a>
				<a href="javascript:void(0)" onmouseover="yildiz(3, <?=$uye?>);"><img src="img/profil-yildiz-kapali.png" border="0" /></a>
				<a href="javascript:void(0)" onmouseover="yildiz(4, <?=$uye?>);"><img src="img/profil-yildiz-kapali.png" border="0" /></a>
				<a href="javascript:void(0)" onmouseover="yildiz(5, <?=$uye?>);"><img src="img/profil-yildiz-kapali.png" border="0" /></a>
				</span>
				<?php
                        }
                        else {
                        
							preg_match('#'.$oylayan.';(.*?);#si', $oylar, $puanaktar);
							
							echo 'Profile '.$puanaktar[1].' puan verdiniz.';
                        
                        }
                        
                        }
                        else {
                        
							echo '<strong>Profil resmi bulunmayan �yeye puan verilemez</strong>';
                        
                        }
				
				?>
			</div>
			
			
			<?php
								$begenen = $uyeid .";". $uyead;
								
								$resultbegeni = mysql_query("select count(id), begeni from "._MX."uye_begeniler where uye='$uye' and begenenler like '%$begenen%'");
								
								list($begeniwarmi, $begenineymis) = mysql_fetch_row($resultbegeni);
                            
                            if($begeniwarmi < 1){
			?>
			<div class="begen">
                            <span id="begeniler">
                            <select class="selectler" name="begendim" id="begendim" onChange="begendim(<?=$uye?>)">
                            <option value="">Se�im Yap�n�z</option>
                            <?php begeniler(NULL, NULL); ?>
                            </select>
                            </span>
			</div>
			<?php
				}
				else {
                            $begenineymis = begeniler($begenineymis, NULL);
                            echo "<div class='begen' style='height:40px;background:none'>Be�endiniz ��nk� <b>$begenineymis</b></div>";
				
				}
			?>
			
			
			<div class="tik-menu2">
				<ul>
					<li id="liprofilbilgileri" class="aktif"><a href="javascript:uyeprofil('profilbilgileri')">Profil Bilgilerim</a></li>
					<li id="likisiselbilgileri"><a href="javascript:uyeprofil('kisiselbilgileri')">Ki�isel Bilgilerim</a></li>
					<li id="liilgialanlari"><a href="javascript:uyeprofil('ilgialanlari')">�lgi Alanlar�m</a></li>
					<li id="liresimleri"><a href="javascript:uyeprofil('resimleri')">Resimlerim</a></li>
					<li><a href="javascript:hediyegonder(<?=$uye;?>)">Hediyelerim</a></li>
				</ul>
			</div>
		<div class="temizle"></div>	
		</div>

		<div class="alt-menu-sag"></div>
	</div>
	
	
	<div class="icerik">
		
		<div class="sol">
			<div id="profilbilgileri" class="aciklama">
				<ul>
					<li><table><tr><td class="td1">Rumuz</td><td class="td2"><?=$uyeadi?></td></tr></table></li>
					<li><table><tr><td class="td1">Cinsiyet</td><td class="td2"><?=cinsiyet($cinsiyet)?></td></tr></table></li>
					<li><table><tr><td class="td1">Ya�</td><td class="td2"><?=$yas?></td></tr></table></li>
					<li><table><tr><td class="td1">Medeni Durum</td><td class="td2">
						<?php
						if(!$uyeaktar["medenidurum"]) echo "Belirtilmemi�"; 
						else echo $uyeaktar["medenidurum"];
						?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Ya�ad��� Yer</td><td class="td2">
                        <?
						echo $uyeaktar["sehir"];
                        if($uyeaktar["kiminle"]) echo " ".$uyeaktar['kiminle']."	ya��yorum.";
                        ?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Arad��� �li�ki T�r�</td><td class="td2">
							<?
								$iliski = $uyeaktar["iliski"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
								
								$iliski = explode(";", $iliski);
								
								foreach($iliski as $ilis) if($ilis) echo $ilis .", ";
								
								}
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Arad��� Cinsiyet</td><td class="td2">
							<?
								$iliski = $uyeaktar["aracinsiyet"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
								
								$iliski = explode(";", $iliski);
								
								foreach($iliski as $ilis) if($ilis) echo $ilis .", ";
								
								}
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Webcam Sohbetten</td><td class="td2">
                        <?
							$iliski = $uyeaktar["webcamsohbet"];
							
							if($iliski == "Evet") echo "Ho�lan�yorum";
							else echo "Ho�lanm�yorum";
                        ?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">K�saca Tan�t�m</td><td class="td2">
							<?
								if($uyeaktar["tanitimonay"] == 1){
									echo stripslashes(nl2br($uyeaktar["tanitim"]));
								}
								else {
									echo "<font color=red>Profil yaz�s� onay bekliyor</font>";
								}
							?>
					</td></tr></table></li>
				</ul>
			</div>

			
			<div id="kisiselbilgileri" class="aciklama" style="display:none">
				<ul>
				<?php
					if($cinsiyet == 2){
					
				?>
					<li><table><tr><td class="td1">&nbsp;</td><td class="td3"><font color="blue">Kendinin</font></td><td class="td3"><font color="red">E�inin</font></td></tr></table></li>
                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["boy"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
					<li><table><tr><td class="td1">Boy</td><td class="td3" style="color:blue;opacity:0.5;"><?=$iliski1?></td><td class="td3" style="color:red;opacity:0.5;"><font color="red"><?=$iliski2?></font></td></tr></table></li>
                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["kilo"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
					<li><table><tr><td class="td1">Kilo</td><td class="td3" style="color:blue;opacity:0.5;"><?=$iliski1?></td><td class="td3" style="color:red;opacity:0.5;"><font color="red"><?=$iliski2?></font></td></tr></table></li>
                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["goz"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
					<li><table><tr><td class="td1">G�z Rengi</td><td class="td3" style="color:blue;opacity:0.5;"><?=$iliski1?></td><td class="td3" style="color:red;opacity:0.5;"><font color="red"><?=$iliski2?></font></td></tr></table></li>
                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["sac"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
					<li><table><tr><td class="td1">Sa� Rengi</td><td class="td3" style="color:blue;opacity:0.5;"><?=$iliski1?></td><td class="td3" style="color:red;opacity:0.5;"><font color="red"><?=$iliski2?></font></td></tr></table></li>
                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["deneyim"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
					<li><table><tr><td class="td1">�li�ki Deneyimi</td><td class="td3" style="color:blue;opacity:0.5;"><?=$iliski1?></td><td class="td3" style="color:red;opacity:0.5;"><font color="red"><?=$iliski2?></font></td></tr></table></li>
					                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["bakim"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
					<li><table><tr><td class="td1">Bak�ml� M�?</td><td class="td3" style="color:blue;opacity:0.5;"><?=$iliski1?></td><td class="td3" style="color:red;opacity:0.5;"><font color="red"><?=$iliski2?></font></td></tr></table></li>
                        <?php
						list($iliski1, $iliski2) = explode("::", $uyeaktar["vucut"]);
                        if(!$iliski1) $iliski1 = "Belirtmemi�";
                        if(!$iliski2) $iliski2 = "Belirtmemi�";

                        ?>
					<li><table><tr><td class="td1">V�cut Yap�s�</td><td class="td3" style="color:blue;opacity:0.5;"><?=$iliski1?></td><td class="td3" style="color:red;opacity:0.5;"><font color="red"><?=$iliski2?></font></td></tr></table></li>
				<?php
					}
					else {
				?>
					<li><table><tr><td class="td1">Boy</td><td class="td2">
							<?
								$iliski = $uyeaktar["boy"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Kilo</td><td class="td2">
							<?
								$iliski = $uyeaktar["kilo"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">G�z Rengi</td><td class="td2">
							<?
								$iliski = $uyeaktar["goz"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Sa� rengi</td><td class="td2">
							<?
								$iliski = $uyeaktar["sac"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">�li�ki Deneyimi</td><td class="td2">
							<?
								$iliski = $uyeaktar["deneyim"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Bak�ml� M�?</td><td class="td2">
							<?
								$iliski = $uyeaktar["bakim"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Vuc�t Yap�s�</td><td class="td2">
							<?
								$iliski = $uyeaktar["vucut"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
					</td></tr></table></li>
				<?php
					}
				?>
					<li><table><tr><td class="td1">Karakter �zellikleri</td><td class="td2">
							<?
								$iliski = $uyeaktar["karakter"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo $ilis .", ";
								}
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">E�itim Durumu</td><td class="td2">
							<?
								$iliski = $uyeaktar["egitim"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">�al��ma Durumu</td><td class="td2">
							<?
								$iliski = $uyeaktar["calisma"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Meslek</td><td class="td2">
							<?
								$iliski = $uyeaktar["meslek"];
								
								if(!$iliski) echo "Belirtmemi�";
								else echo $iliski;
							?>
					</td></tr></table></li>
				</ul>
			</div>
			
			
			<div id="ilgialanlari" class="aciklama" style="display:none">
				<ul>
					<li><table><tr><td class="td1">Hobilerim</td><td class="td2">
							<?
								$iliski = $uyeaktar["hobiler"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo "- $ilis<br />";
								}
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Be�enilerim</td><td class="td2">
							<?
								$iliski = $uyeaktar["begeniler"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo "- $ilis<br />";
								}
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Ho�land���m Filmler</td><td class="td2">
							<?
								$iliski = $uyeaktar["filmler"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo "- $ilis<br />";
								}
							?>
					</td></tr></table></li>
					<li><table><tr><td class="td1">Ho�land���m Tipler</td><td class="td2">
							<?
								$iliski = $uyeaktar["tipler"];
								
								if(!$iliski){
									echo "Belirtmemi�";
								}
								else {
									$iliski = explode(";", $iliski);
								
									foreach($iliski as $ilis) if($ilis) echo "- $ilis<br />";
								}
							?>
					</td></tr></table></li>
				</ul>
			</div>
			
			<div id="resimleri" class="aciklama" style="display:none">
				<?php
				
				if($uyeaktar["topresim"] >= 1){
				?>
				<div id="resimgalerisi" class="resimgalerisi">

				<?php
					$uyemizinidsi = $uyeaktar["id"];
					$resultresim = mysql_query("select resim from "._MX."uye_resim where uye='$uyemizinidsi'");
				
					while(list($resimresim) = mysql_fetch_row($resultresim)){
					?>
				<div class="col-lg-3" style="float:left;width:130px;height:130px;border:2px solid #B8AAB3;margin:10px;">
				  <a href="<?php echo $resimresim;?>" data-lightbox="resimgrubu"> <img src="<?php echo $resimresim;?>"></a>
				</div>
					<?php					
							
					}
				
				?>
				</div>
				<?
				
				}
				else {
					echo "<p align=center><b>�yemizin hen�z resmi bulunmuyor</b></p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
				}
				?>
			</div>

			

			<div class="temizle"></div>
		</div>
		
		<div class="sag">
                <?php
                
                $kgl = $uyeaktar["kgl"];
                
                if($kgl == 1) echo '<img src="img/kglkucuk.gif" border="0" />';
                else echo stripslashes(ayar("profilsag"));
                
                ?>
		</div>
		
	</div>
	
	<div class="footer"></div>
	
	<p class="profil-kapat"><a href="javascript:sayfayikapat();">Sayfay� Kapat</a></p>
</div>
</body>
</html>