<?

$islem = $_POST["islem"];

if($islem == "kaydet"){
	
	$baslik = $_POST["baslik"];
	$duyuru = $_POST["yazi"];
	$durum = $_POST["durum"];
	$id = $_POST["id"];
	
	$baslik = turkce(addslashes($baslik));
	$duyuru = turkce(addslashes($duyuru));
	
	$zaman = @mktime();
	
	$result = mysql_query("update "._MX."hayati_paylas set konu='$baslik', mesaj='$duyuru', durum='$durum' where id='$id'");
	
	
	if($result){
		die("ok");
	}
	else {
		die("hata");
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Hayatı Paylaş Düzenle | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">

	function kaydet(id){
	
		var baslik = $("#baslik").val();
		var yazi = $("#duyuru").val();
		var durum = $("#durum").val();
		
		$("#sonuc").html("<img src='img/loading.gif' /> <font color=green size=1>Lütfen Bekleyin...</font>");
		
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=hayati_paylas_duzenle',
				data : "islem=kaydet&id="+id+"&baslik="+baslik+"&yazi="+yazi+"&durum="+durum,
				success: function(sonuc){		
					if(sonuc == "ok"){
						alert("Yazı başarıyla kaydedil");
						window.location = 'index.php?sayfa=hayati_paylas';
					}
					else {
						alert(sonuc);
						$("#sonuc").html("<font color=red size=1>Kaydedilemedi, tekrar deneyin.</font>");
					}
				}
			})
	
	}
	
	
	</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/icerik.php"); ?>
	
		<?php

			
			$id = $_GET["id"];
			
			$result = mysql_query("select konu, mesaj, durum from "._MX."hayati_paylas where id='$id'");
			
			list($baslik, $duyuru, $durum) = mysql_Fetch_row($result);
			
			$baslik = stripslashes($baslik);
			
			$duyuru = stripslashes($duyuru);
			
			if($durum == 2) $selected = " selected";
			else $selected = NULL;
		?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2"><?=$baslik?> Düzenle</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Duyuru Başlığı</strong></td>
						<td class="last"><input type="text" name="baslik" id="baslik" class="text" value="<?=$baslik?>" style="width:350px" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Yazı</strong></td>
						<td class="last"><textarea name="duyuru" id="duyuru" class="textarea" cols="70" rows="10"><?=$duyuru?></textarea></td>
					</tr>
					<tr>
						<td class="first"><strong>Durum</strong></td>
						<td class="last">
						<select name="durum" id="durum">
							<option value="1">Onaylı</option>
							<option value="2"<?=$selected?>>Onay Bekliyor</option>		
						</select>
						</td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " onclick="kaydet(<?=$id?>)" /> <span id="sonuc"></span></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>


		

					
		</div>		
					
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu bölümde hayatı paylaş yazısını düzenleyebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
