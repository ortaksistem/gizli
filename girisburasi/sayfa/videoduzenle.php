<?
function adminseviye(){

	$data = $_SESSION[_COOKIE]["yonetici"];
	
	$data = base64_decode($data);
	
	list($id, $kullanici, $sifre, $seviye) = explode(";;;", $data);
	
	return $seviye;
}
$islem = $_GET["islem"];

if($islem == "kaydet"){

	$id = $_POST["id"];
	$dosya = $_POST["dosya"];
	
	
	list($eski) = mysql_fetch_row(mysql_query("select dosya from "._MX."video where id='$id'"));
	
	
		if(@file_exists("../video/files/$eski")){
			@unlink("../video/files/$eski");
		}
		
	$result = mysql_query("update "._MX."video set dosya='$dosya', durum='1' where id='$id'");
	
	
	if($result) die("ok");
	else die("hata");
	
}
else {

$id = $_GET["id"];

if(!is_numeric($id)) die("Hops");

list($uye, $dosya) = mysql_fetch_row(mysql_query("select uye, dosya from "._MX."video where id='$id'"));

list($kullanici) = mysql_fetch_row(mysql_query("select kullanici from "._MX."uye where id='$uye'"));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Video Düzenle : <?=$kullanici?> | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
<script type="text/javascript">
	
	function kaydet(){
		
		var id = <?=$id?>;
		var dosya = $("#dosya").val();
		
		
		$("#kaydet").html("<img src='img/loading.gif' /> <font color=green size=1><b>Lütfen Bekleyin...</b></font>");
		
					jQuery.ajax({
						type : 'POST',
						url : 'index.php?sayfa=videoduzenle&islem=kaydet',
						data : "id="+id+"&dosya="+dosya,
						success: function(sonuc){		
							if(sonuc == "ok"){
								$("#kaydet").html("<font color=green size=1><b>Kaydedildi</b></font>");
							}
							else {
								$("#kaydet").html("");
								alert("Kaydedilemedi, lütfen sonra tekrar deneyin");
							}
						}
					})
				
		
	}
	
	</script>
</head>
<body>
	<div id="center-column" style="width:470px">
			<div class="table" style="width:470px">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				
				<table class="listing form" cellpadding="0" cellspacing="0" style="width:470px">
					<tr>
						<th class="full" colspan="2">Video Düzenle</th>
					</tr>
					<tr>
						<td class="first" width="100"><strong>Video Dosya</strong></td>
						<td class="last"><input type="text" name="dosya" id="dosya" class="text" value="<?=$dosya?>" style="width:320px" /> * Tam url yi yazýn.</td>
					</tr>
					<tr class="bg">
						<td class="first" width="100"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Kaydet " class="inputlar" onclick="kaydet()"> <span id="kaydet">* Kaydet dendiðinde önceki dosya ftp den silinecektir ve ayrýca video onaylanmýþ olacaktýr.</span></td>
					</tr>
				</table>
			</div>	
					
	</div>


</body>
</html>
<?php
}
?>