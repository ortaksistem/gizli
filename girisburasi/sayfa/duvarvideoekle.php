<?

function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}

$islem = $_GET["islem"];

if($islem == "kaydet"){
	
	$baslik = $_POST["baslik"];
	$uye = $_POST["uye"];
	$url = $_POST["url"];
	$resim = $_POST["resim"];

	$buton = NULL;
	
	if(!$baslik or !$uye or !$resim or !$url){
	
		$buton = "<font color=red><strong>Tüm alanlarý doldurun</strong></font>";
		
	}
	else {
		
		$baslik = stripslashes($baslik);
		
		$kayit = @mktime();
		
		list($uyeid, $kullanici, $uyeavatar, $cinsiyet) = mysql_fetch_row(mysql_query("select id, kullanici, img, cinsiyet from "._MX."uye where kullanici='$uye'"));
		
		
		if(is_numeric($uyeid)){
		
		
			if(!$avatar or $avatar == 'img_uye/avatar/null.jpg') {
			$avatar = "img_uye/".$cinsiyet.".gif";
			}
			
			$icerik = '<div class="player">
						<object id="Object1" type="application/x-shockwave-flash" data="player_flv_mini.swf" width="420" height="315">
			                <param name="movie" value="player_flv_mini.swf" />
			                <param name="wmode" value="opaque" />
			                <param name="allowScriptAccess" value="sameDomain" />
			                <param name="quality" value="high" />
			                <param name="menu" value="true" />
			                <param name="autoplay" value="false" />
			                <param name="autoload" value="false" />
			                <param name="FlashVars" value="flv='.$url.'&amp;width=420&amp;height=315&amp;autoplay=0&amp;autoload=0&amp;buffer=5&amp;playercolor=000000
&amp;loadingcolor=9b9a9a&amp;buttoncolor=ffffff&amp;slidercolor=ffffff" />
		                </object>
		            </div>';
			
			$icerik = stripslashes($icerik);
			
			$result = mysql_query("insert into "._MX."duvar (id, uye, uyeadi, avatar, tur, baslik, icerik, resim, kayit, durum) values(NULL, '$uyeid', '$kullanici', '$avatar', '4', '$baslik', '$icerik', '$resim', '$kayit', '1')");
			
			if($result){
				
				$buton = "<font color=green><strong>Video baþarýyla eklendi</strong></font>";
				
			}
			else {
				
				$buton = "<font color=red><strong>Video eklenemedi</strong></font>";
				
			}
			
		}
		else {
		
			$buton = "<font color=red><strong>Böyle bir kullanýcý sistemde bulunmuyor</strong></font>";
		
		}
		
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Duvar Video Ekle <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/uye.php"); ?>
		<div id="center-column">
		<form action="index.php?sayfa=duvarvideoekle&islem=kaydet" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Duvar Video Ekle <?=$buton?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Video Baþlýðý</strong></td>
						<td class="last"><input type="text" name="baslik" id="baslik" class="text" value="" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Üye Adý</strong></td>
						<td class="last"><input type="text" name="uye" id="uye" class="text" value="" style="width:250px" /> * Tam Nicki Yazýnýz</td>
					</tr>
					<tr>
						<td class="first"><strong>Video Url</strong></td>
						<td class="last"><input type="text" name="url" id="url" class="text" value="" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Resim Url</strong></td>
						<td class="last"><input type="text" name="resim" id="resim" class="text" value="" style="width:250px" /></td>
					</tr>
					<tr>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " /></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Duvar alanýna üye videosu ekleyebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
