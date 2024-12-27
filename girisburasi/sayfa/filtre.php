<?

$islem = $_GET["islem"];

if($islem == "kaydet"){
	
	$tur = $_POST["tur"];
	$ad = addslashes(turkce($_POST["ad"]));
	
	if($ad){
		$result = mysql_query("insert into "._MX."filtre values(NULL, '$tur', '$ad')");
		
		if($result) echo "tamam";
	}
	
}
else if($islem == "sil"){
	
	$id = $_POST["id"];
	
	if($id){
		$result = mysql_query("delete from "._MX."filtre where id='$id'");
		
		if($result) echo "tamam";
	}
}
else {
	$tur = $_GET["tur"];
	
	switch($tur){
		case "mesaj":
			$turad = "Mesaj Filtre Sistemi";
			$turid = 2;
		break;
		case "nick":
			$turad = "Rumuz Filtre Sistemi";
			$turid = 1;
		break;		
		case "profil":
			$turad = "Profil Filtre Sistemi";
			$turid = 3;
		break;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title><?=$turad?> Filtre Ayarları | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
	function ekle(turid){
	
		var ad = document.getElementById("ad").value;
		
		if(ad == ""){
			alert("Lütfen boş bırakmayın");
		}
		else {
				$("#yukleniyor").html("<font color=green><img src='img/loading.gif' />");
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=filtre&islem=kaydet',
					data : "ad="+ad+"&tur="+turid,
					success: function(sonuc){		
						
						if(sonuc == "tamam"){
							$("#yukleniyor").html("<font color=green><b>Eklendi</b></font>");
							
						}
						else {
							$("#yukleniyor").html("<font color=red><b>Hata Oluştu</b></font>");
						}
					
					}
				})
				
		}
	}
	
	function sil(id, i){
	
					jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=filtre&islem=sil',
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
						<th class="full" colspan="2"><?=$turad?> Ekli İçerikler</th>
					</tr>
					<?
						$result = mysql_query("select id, ad from "._MX."filtre where tur='$turid'");
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
			<div class="box"><?=$turad?> türü içeriklerini ekleyebilir ve silebilirsiniz. Bu filtreler söylenen yerlerde geçerli olacaktır. Eklenen filtrenşn gözükmesi için sayfayı yenileyiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?
}
?>
