<?

$islem = $_GET["islem"];

if($islem == "kaydet"){
	
	$tur = $_POST["tur"];
	$ad = addslashes(turkce($_POST["ad"]));
	
	if($ad){
		$result = mysql_query("insert into "._MX."uye_secenekler values(NULL, '$tur', '$ad')");
		
		if($result) echo "tamam";
	}
	
}
else if($islem == "sil"){
	
	$id = $_POST["id"];
	
	if($id){
		$result = mysql_query("delete from "._MX."uye_secenekler where id='$id'");
		
		if($result) echo "tamam";
	}
}
else {
	$tur = $_GET["tur"];
	
	switch($tur){
		case "kiminle":
			$turad = "Kiminle Yaþýyor";
			$turid = 1;
		break;
		case "aradigi":
			$turad = "Aradýðý Ýliþki Türü";
			$turid = 2;
		break;		
		case "karakter":
			$turad = "Karakter Özellikleri";
			$turid = 3;
		break;
		case "boy":
			$turad = "Boy Uzunluðu";
			$turid = 4;
		break;
		case "kilo":
			$turad = "Kilo";
			$turid = 5;
		break;
		case "vucut":
			$turad = "Vücut Yapýsý";
			$turid = 6;
		break;
		case "goz":
			$turad = "Göz Rengi";
			$turid = 7;
		break;
		case "sac":
			$turad = "Saç Rengi";
			$turid = 8;
		break;
		case "egitim":
			$turad = "Eðitim Durumu";
			$turid = 9;
		break;
		case "meslek":
			$turad = "Meslekler";
			$turid = 10;
		break;
		case "calisma":
			$turad = "Çalýþma Durumu";
			$turid = 11;
		break;
		case "hobiler":
			$turad = "Hobileri";
			$turid = 12;
		break;
		case "begeniler":
			$turad = "Beðenileri";
			$turid = 13;
		break;
		case "film":
			$turad = "Sevdiði Film Türleri";
			$turid = 14;
		break;
		case "tipler":
			$turad = "Hoþlandýðý Tipler";
			$turid = 15;
		break;
		case "medeni":
			$turad = "Medeni Durumlar";
			$turid = 16;
		break;
		case "deneyim":
			$turad = "Ýliþki Deneyimi";
			$turid = 17;
		break;
		case "cinsiyet":
			$turad = "Aradýðý cinsiyet";
			$turid = 18;
		break;
		case "bakimli":
			$turad = "Bakýmlý Mýsýnýz";
			$turid = 19;
		break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?=$turad?> Ayarlarý | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
	function ekle(turid){
	
		var ad = document.getElementById("ad").value;
		
		if(ad == ""){
			alert("Lütfen boþ býrakmayýn");
		}
		else {
				$("#yukleniyor").html("<font color=green><img src='img/loading.gif' />");
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=secenekler&islem=kaydet',
					data : "ad="+ad+"&tur="+turid,
					success: function(sonuc){		
						
						if(sonuc == "tamam"){
							$("#yukleniyor").html("<font color=green><b>Eklendi</b></font>");
							
						}
						else {
							$("#yukleniyor").html("<font color=red><b>Hata Oluþtu</b></font>");
						}
					
					}
				})
				
		}
	}
	
	function sil(id, i){
	
					jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=secenekler&islem=sil',
					data : "id="+id,
					success: function(sonuc){		

						if(sonuc == "tamam"){
							$("#sil"+i+"").hide("slow");	
						}
					
					}
				})	
	}
	</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/anasayfa.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2"><?=$turad?> Yeni Ekle</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Yeni Ekle</strong></td>
						<td class="last"><input type="text" name="ad" id="ad" class="text" style="width:250px" /> <input type="submit" value=" Kaydet " onclick="ekle(<?=$turid?>)" /> <span id="yukleniyor"></span></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		  
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2"><?=$turad?> Ekli Ýçerikler</th>
					</tr>
					<?
						$result = mysql_query("select id, ad from "._MX."uye_secenekler where tur='$turid'");
						$i = 1;
						
						while(list($id, $ad) = mysql_fetch_row($result)){
						$ad = stripslashes($ad);
						
							if($i%2 == 0){
							?>
							<tr id="sil<?=$i?>">
								<td class="first" width="%90"><strong><?=$ad?></strong></td>
								<td class="last"><a href="javascript:sil(<?=$id?>, <?=$i?>)" title="Sil"><img src="img/hr.gif" border="0" /></a></td>
							</tr>								
							<?
							}
							else {
							?>
							<tr class="bg" id="sil<?=$i?>">
								<td class="first" width="%90"><strong><?=$ad?></strong></td>
								<td class="last"><a href="javascript:sil(<?=$id?>, <?=$i?>)" title="Sil"><img src="img/hr.gif" border="0" /></a></td>
							</tr>							
							<?
							}
							$i++;
						
						}
					?>

				</table>
	        <p>&nbsp;</p>
		  </div>
		  
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box"><?=$turad?> türü içeriklerini ekleyebilir ve silebilirsiniz. Ajax kullanýlmýþtýr sayfa yenilenmez. Yalnýz yeni eklenen içerikleri görmek için sayfayý yenilemeniz gerekmektedir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?
}
?>
