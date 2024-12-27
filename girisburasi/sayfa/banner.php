<?

$islem = $_GET["islem"];

if($islem == "kaydet"){
	
	$logo = $_POST["logo"];
	$logoyani = $_POST["logoyani"];
	$sag = $_POST["sag"];
	$icerikustu = $_POST["icerikustu"];
	$icerikalti = $_POST["icerikalti"];
	$profilust = $_POST["profilust"];
	$profilsag = $_POST["profilsag"];
	$uyeolsag = $_POST["uyeolsag"];
	
	
	$logo = addslashes($logo);
	$logoyani = addslashes($logoyani);
	$sag = addslashes($sag);
	$icerikustu = addslashes($icerikustu);
	$icerikalti = addslashes($icerikalti);
	$profilust = addslashes($profilust);
	$profilsag = addslashes($profilsag);
	$uyeolsag = addslashes($uyeolsag);
	
	$result = mysql_query("update "._MX."ayarlar set logo='$logo', logoyani='$logoyani', sag='$sag', icerikustu='$icerikustu', icerikalti='$icerikalti', profilust='$profilust', profilsag='$profilsag', uyeolsag='$uyeolsag'");
	 
	if($result){
		$buton = "<font color=green><b>Bannerlar baþarýyla kaydedildi</b></font>";
	}
	else {
		$buton = NULL;
	}
}

$result = mysql_query("select logo, logoyani, sag, icerikustu, icerikalti, profilust, profilsag, uyeolsag from "._MX."ayarlar");

list($logo, $logoyani, $sag, $icerikustu, $icerikalti, $profilust, $profilsag, $uyeolsag) = mysql_fetch_row($result);

$logo = stripslashes($logo);

$logoyani = stripslashes($logoyani);

$sag = stripslashes($sag);

$icerikustu = stripslashes($icerikustu);

$icerikalti = stripslashes($icerikalti);

$profilust = stripslashes($profilust);

$profilsag = stripslashes($profilsag);

$uyeolsag = stripslashes($uyeolsag);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Site Bannerlarý | <? echo _AD; ?></title>
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
		<form action="index.php?sayfa=banner&islem=kaydet" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Site Bannerlarý <?=$buton?></th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Logo Url</strong></td>
						<td class="last"><input type="text" name="logo" id="logo" class="text" value="<?=$logo?>" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Logo Yaný</strong></td>
						<td class="last">
						<textarea name="logoyani" id="logoyani" class="textarea" cols="60" rows="6"><?=$logoyani?></textarea> * Html kod kullanýlabilir
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Sað Taraf</strong></td>
						<td class="last">
						<textarea name="sag" id="sag" class="textarea" cols="60" rows="6"><?=$sag?></textarea> * Sitenin yanýnda bulunan sað alan. Html kod kullanýlabilir
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Üye Ol Sað Taraf</strong></td>
						<td class="last">
						<textarea name="uyeolsag" id="uyeolsag" class="textarea" cols="60" rows="6"><?=$uyeolsag?></textarea> * Üye ol sayfasýnýn sað tarafý.
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Ýçerik Üstü</strong></td>
						<td class="last">
						<textarea name="icerikustu" id="icerikustu" class="textarea" cols="60" rows="6"><?=$icerikustu?></textarea> * Sitenin içeriðinde bununan alanlarýn üst kýsmý. Html kod kullanýlabilir
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Ýçerik Altý</strong></td>
						<td class="last">
						<textarea name="icerikalti" id="icerikalti" class="textarea" cols="60" rows="6"><?=$icerikalti?></textarea> * Sitenin içeriðinde bununan alanlarýn alt kýsmý. Html kod kullanýlabilir
						</td>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Profil Üstü</strong></td>
						<td class="last">
						<textarea name="profilust" id="profilust" class="textarea" cols="60" rows="6"><?=$profilust?></textarea> * Üyenin profil sayfasýndaki üst alan. Html kod kullanýlabilir
						</td>
					</tr>
					<tr class="bg">
						<td class="first" width="172"><strong>Profil Sag</strong></td>
						<td class="last">
						<textarea name="profilsag" id="profilsag" class="textarea" cols="60" rows="6"><?=$profilsag?></textarea> * Üyenin profil sayfasýndaki sag alan. Html kod kullanýlabilir
						</td>
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
			<div class="box">Site genel banner alanlarý bu bölümden kontrol edilmektedir. Açýklamalar mevcuttur.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
