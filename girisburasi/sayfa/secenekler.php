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
			$turad = "Kiminle Ya��yor";
			$turid = 1;
		break;
		case "aradigi":
			$turad = "Arad��� �li�ki T�r�";
			$turid = 2;
		break;		
		case "karakter":
			$turad = "Karakter �zellikleri";
			$turid = 3;
		break;
		case "boy":
			$turad = "Boy Uzunlu�u";
			$turid = 4;
		break;
		case "kilo":
			$turad = "Kilo";
			$turid = 5;
		break;
		case "vucut":
			$turad = "V�cut Yap�s�";
			$turid = 6;
		break;
		case "goz":
			$turad = "G�z Rengi";
			$turid = 7;
		break;
		case "sac":
			$turad = "Sa� Rengi";
			$turid = 8;
		break;
		case "egitim":
			$turad = "E�itim Durumu";
			$turid = 9;
		break;
		case "meslek":
			$turad = "Meslekler";
			$turid = 10;
		break;
		case "calisma":
			$turad = "�al��ma Durumu";
			$turid = 11;
		break;
		case "hobiler":
			$turad = "Hobileri";
			$turid = 12;
		break;
		case "begeniler":
			$turad = "Be�enileri";
			$turid = 13;
		break;
		case "film":
			$turad = "Sevdi�i Film T�rleri";
			$turid = 14;
		break;
		case "tipler":
			$turad = "Ho�land��� Tipler";
			$turid = 15;
		break;
		case "medeni":
			$turad = "Medeni Durumlar";
			$turid = 16;
		break;
		case "deneyim":
			$turad = "�li�ki Deneyimi";
			$turid = 17;
		break;
		case "cinsiyet":
			$turad = "Arad��� cinsiyet";
			$turid = 18;
		break;
		case "bakimli":
			$turad = "Bak�ml� M�s�n�z";
			$turid = 19;
		break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?=$turad?> Ayarlar� | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
	function ekle(turid){
	
		var ad = document.getElementById("ad").value;
		
		if(ad == ""){
			alert("L�tfen bo� b�rakmay�n");
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
							$("#yukleniyor").html("<font color=red><b>Hata Olu�tu</b></font>");
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
						<th class="full" colspan="2"><?=$turad?> Ekli ��erikler</th>
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
			<div class="box"><?=$turad?> t�r� i�eriklerini ekleyebilir ve silebilirsiniz. Ajax kullan�lm��t�r sayfa yenilenmez. Yaln�z yeni eklenen i�erikleri g�rmek i�in sayfay� yenilemeniz gerekmektedir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?
}
?>
