<?php

$islem = $_REQUEST["islem"];

if($islem == "onayikaldir")
{

	$id = $_POST["id"];
	
	$result = mysql_query("update "._MX."hayati_paylas set durum='2' where id='$id'");
	
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
	<title>Hayat� Payla� Bekleyen Yaz�lar | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
	
	function onayla(id){
	
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=hayati_paylas_listele',
				data : "islem=onayikaldir&id="+id,
				success: function(sonuc){		
					if(sonuc == "ok"){
						$("#paylas"+id).hide("slow");
					}
					else {
						alert("Onaylanamad�");
					}
				}
			})
	
	}

	function sil(id){
	
			jQuery.ajax({
				type : 'POST',
				url : 'index.php?sayfa=hayati_paylas_listele',
				data : "islem=sil&id="+id,
				success: function(sonuc){		
					if(sonuc == "ok"){
						$("#paylas"+id).hide("slow");
					}
					else {
						alert("Onaylanamad�");
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
			
			$bul = $_POST["bul"];
			
			$bul = addslashes($bul);
		
		?>
		<div id="center-column">
		<form action="index.php?sayfa=hayati_paylas_listele" method="post">
		  <div class="select-bar">
			<label>
			<b>Yaz� Bul :</b> 
			</label>
		    <label>
		    <input type="text" name="bul" id="bul" value="<?=$bul?>" size="14" class="inputlar" />
		    </label>
		    <label>
			<input type="submit" name="Submit" value=" Bul " /> * �ok fazla yaz� olaca��n� d���nd���m�zden arama usul� bulmay� tercih ettik. Konu yada mesajda ge�en herhangi bir kelimeyi yazarak yaz�y� bulabilirsiniz.
			</label>
		  </div>
		</form>
			<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="200">Ba�l�k</th>
						<th>Yaz�</th>
						<th>Kay�t</th>
						<th class="last">��lem</th>
					</tr>
				
					<?
					
						if($bul) {
						
						$result = mysql_query("select id, konu, mesaj, kayit from "._MX."hayati_paylas where konu like '%$bul%' or '%$bul%'");
						
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
						<a href="javascript:onayla(<?=$id?>)" title="Onay� Kald�r"><img src="img/add-icon.gif" width="16" height="16" /></a>
						<a href="javascript:sil(<?=$id?>)" title="Sil" onclick="return confirm('Silmek istedi�inizden Emin Misiniz?')"><img src="img/hr.gif" width="16" height="16" /></a>
						</td>
					</tr>
						<?
						
						}
						
						}
					
					?>
				</table>
			</div>
					
		</div>		
					
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bekleyen hayat� payla� yaz�lar�n� g�rebilir, onaylay�p silebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>