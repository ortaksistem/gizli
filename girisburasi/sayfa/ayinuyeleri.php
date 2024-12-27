<?php

	$islem = $_GET["islem"];

	$limit = 20; 
	
	if($islem == "yeni"){

		$uyeadi = $_POST["uyeadi"];
		
		$uyeadi = turkce($uyeadi);
		
		$ay = $_POST["ay"];
		
		$yil = $_POST["yil"];
		
		
		list($uyeid, $cinsiyet) = mysql_fetch_row(mysql_query("select id, cinsiyet, dogum, sehir, img, oncelik from "._MX."uye where kullanici='$uyeadi'"));

		if(!$uyeid) die("hata");
		
		list($warmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye_ay where cinsiyet='$cinsiyet' and ay='$ay' and yil='$yil'"));
		
		if($warmi >= 1) die("var");
		
		list($resim) = mysql_fetch_row(mysql_query("select resim from "._MX."uye_resim where uye='$uyeid' and ana='1' and durum='1'"));
		
		if(!$resim){
			list($resim) = mysql_fetch_row(mysql_query("select resim from "._MX."uye_resim where uye='$uyeid' and durum='1' order by rand() limit 1"));
		}
		
		if(!$resim) die("resim");
		
		list($maxid) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye_ay"));
		
		$maxid++;
		
		$uzanti = explode(".", $resim);
		
		$uzanti = $uzanti[count($uzanti)-1];
		
		
		
		@copy("../".$resim, "../img_uye/ay/$maxid.$uzanti");
		
		list($en, $boy) = getimagesize("../".$resim);
				
		if($boy > 312){
			
			@resmikes("../img_uye/ay/$maxid.$uzanti", "../img_uye/ay/$maxid.$uzanti");
			
		}	
		
		$result = mysql_query("insert into "._MX."uye_ay values('$maxid', '$uyeid', '$uyeadi', '$cinsiyet', 'img_uye/ay/$maxid.$uzanti', '$ay', '$yil', '1')");
		
		
		if($result) die("ok");
		else die("hata");
		
	}
	else if($islem == "sil"){

		$id = $_POST["id"];
				
		$result = mysql_query("delete from "._MX."uye_ay where id='$id'");
		
		
		if($result) die("ok");
		else die("hata");
		
	}
	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Ayýn Üyeleri | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
function uyeekle(){
	var uyeadi = document.getElementById('uyeadi').value;
	var ay = document.getElementById('ay').value;
	var yil = document.getElementById('yil').value;

	
	$("#uyeeklesonuc").html("<img src='img/loading.gif' /> <font color=green size=1>Lütfen Bekleyin...</font>");
	
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=ayinuyeleri&islem=yeni',
					data : "uyeadi="+uyeadi+"&ay="+ay+"&yil="+yil,
					success: function(sonuc){		
						if(sonuc == "ok"){
							$("#uyeeklesonuc").html("<font color=green size=1>Baþarýyla eklendi.</font>");
						}
						else if(sonuc == "var"){
							$("#uyeeklesonuc").html("");
							alert("Bu ay ve yýla ait eklenmiþ ayýn üyesi mevcuttur");
						}
						else if(sonuc == "resim"){
							$("#uyeeklesonuc").html("");
							alert("Üyenin resmi veya onaylý resmi bulunmamaktadýr");
						}
						else {
							$("#uyeeklesonuc").html("<font color=green size=1>Þuan ekleme yapýlamýyor.</font>");
						}
								
					}
				})
}

function uyeyisil(uye){
	var onayla = confirm("Silmek istediðinizden emin misiniz?");
	if(onayla){
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=ayinuyeleri&islem=sil',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
				$("#uyesonuc"+uye).hide();
				}
				else {
					alert("Üye silinemedi, tekrar deneyin");
				}	
			}
		})
	}
}

function sayfa(sayfa){
		
	window.location = 'index.php?sayfa=ayinuyeleri&p='+sayfa;
		
}
</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/uye.php"); ?>
		<div id="center-column">
		  <div class="select-bar">
			<label>
			<b>Yeni Ekle :</b> 
			</label>
		    <label>
		    Üye Adý : <input type="text" name="uyeadi" id="uyeadi" size="14" class="inputlar" />
		    </label>
		    <label>
		    Ay : <input type="text" name="ay" id="ay" size="3" maxlength="2" value="<?=date("m");?>" class="inputlar" />
		    </label>
		    <label>
		    Yýl : <input type="text" name="yil" id="yil" size="5" maxlength="4" value="<?=date("Y");?>" class="inputlar" />
		    </label>
		    <label>
			<input type="submit" name="Submit" value=" Ekle " onclick="uyeekle()" /> <span id="uyeeklesonuc">* Üyenin tam nickini yazýnýz !</span>
			</label>
		 </div>
		  
			<div class="table" id="uyeyukle">
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Kullanýcý Adý</th>
						<th>Seçildiði Tarih</th>
						<th class="last">Ýþlem</th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					
					<?
					
						$limit = 20;
						
						$p = $_GET["p"];
						
						if(!$p) $p = 1;
						
						$p = intval($p);
						
						$result = mysql_query("select count(id) from "._MX."uye_ay");
						
						list($sayi) = mysql_fetch_row($result);
						
						$toplamsayfa = ceil(($sayi/$limit));
						
						$result = mysql_query("select id, uye, uyead, ay, yil from "._MX."uye_ay order by id desc limit ".(($p-1)*$limit).",".$limit."");

						while(list($idd, $id, $kullanici, $ay, $yil) = mysql_fetch_row($result)){
						

					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <a href="javascript:void(0)" onclick="pencere('index.php?sayfa=uyeprofil&id=<?=$id?>', '500', '600', 'profilpopup<?=$id?>', 2, 1, 1);"><?=$kullanici?></a> </td>
						<td><?=$ay?>-<?=$yil?></td>
						<td class="last">
						<a href="javascript:void(0);" onclick="uyeyisil(<?=$idd?>)" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>
						</td>
					</tr>
					
					<?
						}
					?>
					</div>
				</table>
			</div>
			
				<div class="table">
					<div class="select">
						<strong>Sayfalar : </strong>
						<select name="sayfalar" id="sayfalar" class="selectler" onChange="sayfa(this.value)">
							<? 
							for($i = 1; $i<=$toplamsayfa; $i++) {
							if($p == $i) echo "<option value=$i selected>$i. Sayfa</option>"; 
							else echo "<option value=$i>$i. Sayfa</option>"; 
							}
							?>
						</select>
					</div>
				</div>
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan yeni haftanýn üyesi ekleyebilir ve mevcut üyeleri silebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?
}

function resmikes($source, $dest) {
	$nw = 450;
	$nh = 312;
	$stype = explode(".", $source);
	$stype = $stype[count($stype)-1];
    $size = getimagesize($source);
    $w = $size[0];
    $h = $size[1];
    switch($stype) {
        case 'gif':
        $simg = imagecreatefromgif($source);
        break;
        case 'jpg':
        $simg = imagecreatefromjpeg($source);
        break;
        case 'png':
        $simg = imagecreatefrompng($source);
        break;
    }
    $dimg = imagecreatetruecolor($nw, $nh);
    $wm = $w/$nw;
    $hm = $h/$nh;
    $h_height = $nh/2;
    $w_height = $nw/2;
    if($w> $h) {
        $adjusted_width = $w / $hm;
        $half_width = $adjusted_width / 2;
        $int_width = $half_width - $w_height;
        imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
    } elseif(($w <$h) || ($w == $h)) {
        $adjusted_height = $h / $wm;
        $half_height = $adjusted_height / 2;
        $int_height = $half_height - $h_height;
        imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
    } else {
        imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
    }
    imagejpeg($dimg,$dest,100);
}
// bitti

?>
