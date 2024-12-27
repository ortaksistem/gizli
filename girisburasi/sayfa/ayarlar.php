<?

$islem = $_GET["islem"];

if($islem == "kaydet"){
	
	$baslik = $_POST["baslik"];
	$ad = $_POST["ad"];
	$mail = $_POST["mail"];
	$uyelik = $_POST["uyelik"];
	$cache = $_POST["cache"];
	$seviye = $_POST["seviye"];
	$sorgulama = $_POST["sorgulama"];
	$keywords = $_POST["keywords"];
	$description = $_POST["description"];
	$sure = $_POST["sure"];
	$yazi = $_POST["yazi"];
	$mesaj = $_POST["mesaj"];
	
	$baslik = addslashes($baslik);
	$ad = addslashes($ad);
	$keywords = addslashes($keywords);
	$description = addslashes($description);
	$yazi = addslashes($yazi);
	
	$result = mysql_query("update "._MX."ayarlar set baslik='$baslik', ad='$ad', url='$url', mail='$mail', sorgulama='$sorgulama', cache='$cache', uyelik='$uyelik', seviye='$seviye', sure='$sure', yazi='$yazi', keywords='$keywords', description='$description', mesaj='$mesaj'");
	
	
	if($result){
		$buton = "<font color=green><b>Ayarlar baþarýyla kaydedildi</b></font>";
	}
	else {
		$buton = NULL;
	}
}

$result = mysql_query("select baslik, ad, url, mail, sorgulama, cache, uyelik, seviye, sure, yazi, mesaj, keywords, description from "._MX."ayarlar");
list($baslik, $ad, $url, $mail, $sorgulama, $cache, $uyelik, $seviye, $sure, $yazi, $mesaj, $keywords, $description) = mysql_fetch_row($result);

$baslik = stripslashes($baslik);
$ad = stripslashes($ad);
$keywords = stripslashes($keywords);
$description = stripslashes($description);

function uyeliktipi($param){
	
	$tipler = array("", "Kullanýcýlar Direk Üye Olsunlar", "Admin Onaylý Üyelik", "Email Onaylý Üyelik", "Cep Onaylý Üyelik");
	
	for($i = 1; $i<=4; $i++){
		if($param == $i) echo "<option value=$i selected>$tipler[$i]</option>";
		else echo "<option value=$i>$tipler[$i]</option>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Genel Site Ayarlarý| <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/anasayfa.php"); ?>
		<div id="center-column">
		<form action="index.php?sayfa=ayarlar&islem=kaydet" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Genel Site Ayarlarý <?=$buton?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Site Baþlýðý</strong></td>
						<td class="last"><input type="text" name="baslik" id="baslik" class="text" value="<?=$baslik?>" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Site Url</strong></td>
						<td class="last"><input type="text" name="url" id="url" class="text" value="<?=$url?>" style="width:250px" /> * Sonunda (/) olacak</td>
					</tr>
					<tr>
						<td class="first"><strong>Site Adý</strong></td>
						<td class="last"><input type="text" name="ad" id="ad" class="text" value="<?=$ad?>" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Admin Maili</strong></td>
						<td class="last"><input type="text" name="mail" id="mail" class="text" value="<?=$mail?>" style="width:250px" /></td>
					</tr>
					<tr>
						<td class="first"><strong>18+ sorgulamasý</strong></td>
						<td class="last">
						<?
							if($sorgulama == 1){
						?>
						<input type="radio" name="sorgulama" id="sorgulama" value="1" checked> Açýk
						<input type="radio" name="sorgulama" id="sorgulama" value="2"> Kapalý
						<?							
							}
							else {
						?>
						<input type="radio" name="sorgulama" id="sorgulama" value="1"> Açýk
						<input type="radio" name="sorgulama" id="sorgulama" value="2" checked> Kapalý
						<?
							}
						?>
						</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Mesaj Gönderimi</strong></td>
						<td class="last">
						<?
							if($mesaj == 1){
						?>
						<input type="radio" name="mesaj" id="mesaj" value="1" checked> Açýk
						<input type="radio" name="mesaj" id="mesaj" value="2"> Kapalý
						<?							
							}
							else {
						?>
						<input type="radio" name="mesaj" id="mesaj" value="1"> Açýk
						<input type="radio" name="mesaj" id="mesaj" value="2" checked> Kapalý
						<?
							}
						?>
						</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Online SÜresi</strong></td>
						<td class="last"><input type="text" name="sure" id="sure" class="text" value="<?=$sure?>" style="width:50px" /> * Üyelerin kaç dakika online olarak tutulacaðu dakika cinsinden</td>
					</tr>
					<tr>
						<td class="first"><strong>Cache Zamaný</strong></td>
						<td class="last"><input type="text" name="cache" id="cache" class="text" value="<?=$cache?>" style="width:50px" /> * Dakika cinsinden</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Üyelik Tipi</strong></td>
						<td class="last">
						<select name="uyelik" id="uyelik" class="text">
						<? uyeliktipi($uyelik); ?>
						</select>
						</td>
					</tr>
					<tr>
						<td class="first"><strong>Ana Üyelik Seviyesi</strong></td>
						<td class="last">
						<select name="seviye" id="seviye" class="text">
							<?
								$result = mysql_query("select id, ad from "._MX."seviye");
								
								while(list($sid, $sad) = mysql_fetch_row($result)){
									
									if($sid == $seviye) echo "<option value=$sid selected>".stripslashes($sad)."</option>";
									else echo "<option value=$sid>".stripslashes($sad)."</option>";
								}
							?>
						</select> * Yeni üyelerin dahil olacaðý üyelik grubu.
						</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Resim Üzerindeki Yazý</strong></td>
						<td class="last"><input type="text" name="yazi" id="yazi" class="text" value="<?=$yazi?>" style="width:150px" /> * Yüklenen resimlerin üzerine otomatik eklenecek yazý.</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Site Keywords</strong></td>
						<td class="last"><textarea name="keywords" id="keywords" class="textarea" cols="60" rows="6"><?=$keywords?></textarea></td>
					</tr>
					<tr>
						<td class="first"><strong>Site Description</strong></td>
						<td class="last"><textarea name="description" id="description" class="textarea" cols="60" rows="6"><?=$description?></textarea></td>
					</tr>
					<tr class="bg">
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
			<div class="box">Genel site ayarlarý bu bölümden yapýlmaktadýr. Ayarlarý doðru yaptýgýnýzdan emin olunuz. Sitenin çalýþmasýný etkileyebilir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
