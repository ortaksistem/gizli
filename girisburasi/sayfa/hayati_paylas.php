<?php

$islem = $_REQUEST["islem"];

if($islem == "onayla")
{

	$id = $_POST["id"];
	
	$result = mysql_query("update "._MX."hayati_paylas set durum='1' where id='$id'");
	
	if($result) die("ok");
	
	else die("hata");
}
else if($islem == "sil"){

	$id = $_POST["id"];
	
	$result = mysql_query("delete from "._MX."hayati_paylas where id='$id'");
	
	if($result) die("ok");
	
	else die("hata");

}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Hayatı Paylaş Bekleyen Yazılar | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
	
	function onayla(id){
	
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=hayati_paylas',
				data : "islem=onayla&id="+id,
				success: function(sonuc){		
					if(sonuc == "ok"){
						$("#paylas"+id).hide("slow");
					}
					else {
						alert("Onaylanamadı");
					}
				}
			})
	
	}

	function sil(id){
	
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=hayati_paylas',
				data : "islem=sil&id="+id,
				success: function(sonuc){		
					if(sonuc == "ok"){
						$("#paylas"+id).hide("slow");
					}
					else {
						alert("Onaylanamadı");
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
	
		<div id="center-column">
			<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="200">Başlık</th>
						<th>Yazı</th>
						<th>Kayıt</th>
						<th class="last">İşlem</th>
					</tr>
				
					<?
						
						$result = mysql_query("select id, konu, mesaj, kayit from "._MX."hayati_paylas where durum='2' order by id asc");
						
						while(list($id, $konu, $mesaj, $kayit) = mysql_fetch_row($result)){
						
						$konu = stripslashes($konu);
						
						$mesaj = stripslashes($mesaj);
						
						$kayit = date("d.m.Y H:i", $kayit);
						
					?>
					<tr id="paylas<?=$id?>">
						<td class="first style1" width="200"><?=$konu?></td>
						<td><?=$mesaj?></td>
						<td><?=$kayit?></td>
						<td class="last">
						<a href="index.php?sayfa=hayati_paylas_duzenle&id=<?=$id?>" title="Onayla"><img src="img/add-icon.gif" width="16" height="16" /></a>
						<a href="javascript:sil(<?=$id?>)" title="Sil" onclick="return confirm('Silmek istediğinizden Emin Misiniz?')"><img src="img/hr.gif" width="16" height="16" /></a>
						</td>
					</tr>
						<?
						
						}
					
					?>
				</table>
			</div>
					
		</div>		
					
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bekleyen hayatı paylaş yazılarını görebilir, onaylayıp silebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>