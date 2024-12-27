<?php

	$islem = $_GET["islem"];

	$limit = 20; 
	
	if($islem == "yeni"){

		$site = $_POST["siteadi"];
		
		$site = turkce($site);
		
		list($warmi) = mysql_fetch_row(mysql_query("select count(id) from "._MX."ref where site='$site'"));
		
		
		if($warmi >= 1) die("var");
		
		$result = mysql_query("insert into "._MX."ref values(NULL, '$site')");
		
		if($result) die("ok");
		else die("hata");
		
	}
	else if($islem == "sil"){

		$id = $_POST["id"];
				
		$result = mysql_query("delete from "._MX."ref where id='$id'");
		
		if($result) die("ok");
		else die("hata");
		
	}
	else if($islem == "getir"){

		$site = $_POST["site"];
				
		list($toplambayan) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where cinsiyet='1' and ref='$site'"));
						
		list($toplamcift) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where cinsiyet='2' and ref='$site'"));
						
		list($toplamerkek) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where cinsiyet='3' and ref='$site'"));
						
		list($toplamlez) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where cinsiyet='4' and ref='$site'"));
						
		list($toplambib) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where cinsiyet='5' and ref='$site'"));
						
		list($toplambie) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where cinsiyet='6' and ref='$site'"));
						
		list($toplambic) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where cinsiyet='7' and ref='$site'"));
						
		list($toplamtrans) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where cinsiyet='8' and ref='$site'"));

		list($toplamuye) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where ref='$site'"));
						
		$result = mysql_query("select id from "._MX."uye where ref='$site'");
		
		$gold = 0;
		
		$tutar = 0;
		
		while(list($idd) = mysql_fetch_row($result)){
			
			$sorgula = mysql_query("select id, tutar from "._MX."odeme where uye='$idd'");
			while(list($id, $tutarr) = mysql_fetch_row($sorgula)){
				
				$tutar = $tutar + $tutarr;
				
				$gold++;
			
			}
		}
						
		?>
		Bayan : <?=$toplambayan?><br>
		Cift : <?=$toplamcift?><br>
		Erkek : <?=$toplamerkek?><br>
		Lezbiyen : <?=$toplamlez?><br>
		B.Bayan : <?=$toplambib?><br>
		B.Cift : <?=$toplambic?><br>
		B.Erkek : <?=$toplambie?><br>
		Trans : <?=$toplamtrans?><br>
		Top Satis : <?=$gold?><br>
		Top Tutar : <?=$tutar?><br>
		
		<?php
		die();
	}
	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Referanslar | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
function siteekle(){
	var siteadi = $("#siteadi").val();

	
	$("#siteeklesonuc").html("<img src='img/loading.gif' /> <font color=green size=1>Lütfen Bekleyin...</font>");
	
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=referans&islem=yeni',
					data : "siteadi="+siteadi,
					success: function(sonuc){		
						if(sonuc == "ok"){
							$("#siteeklesonuc").html("<font color=green size=1>Baþarýyla eklendi.</font>");
						}
						else if(sonuc == "var"){
							$("#siteeklesonuc").html("<font color=green size=1>Site daha önce eklenmiþtir.</font>");
						}
						else {
							$("#siteeklesonuc").html("<font color=red size=1>Þuan ekleme yapýlamýyor.</font>");
						}
								
					}
				})
}

function istatistik(site, id){
		
		$("#siteuyeler"+id).html("<img src='img/loading.gif' />");
		
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=referans&islem=getir',
			data : "site="+site,
			success: function(sonuc){	
				$("#siteuyeler"+id).html(sonuc);
			}
		})
	
}

function sitesil(uye){
	var onayla = confirm("Silmek istediðinizden emin misiniz?");
	if(onayla){
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=referans&islem=sil',
			data : "id="+uye,
			success: function(sonuc){	
				if(sonuc == "ok"){
				$("#sitesonuc"+uye).hide();
				}
				else {
					alert("Site silinemedi, tekrar deneyin");
				}	
			}
		})
	}
}
</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/satislar.php"); ?>
		<div id="center-column">
		  <div class="select-bar">
			<label>
			<b>Yeni Site Ekle :</b> 
			</label>
		    <label>
		    <input type="text" name="siteadi" id="siteadi" size="14" class="inputlar" />
		    </label>
		    <label>
			<input type="submit" name="Submit" value=" Ekle " onclick="siteekle()" /> <span id="siteeklesonuc"></span>
			</label>
		 </div>
		  
			<div class="table" id="uyeyukle">
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Referans Adý</th>
						<th>Toplam Üye</th>
						<th>Üye Açýklamarý</th>
						<th class="last">Ýþlem</th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?
					
						$result = mysql_query("select id, site from "._MX."ref order by id asc");
						

						while(list($id, $site) = mysql_fetch_row($result)){
						
						
						list($toplamuye) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where ref='$site'"));
						
						list($toplamgold) = mysql_fetch_row(mysql_query("select count(id) from "._MX."uye where ref='$site' and seviye!='3'"));
						

						
					?>
					<tr id="sitesonuc<?=$id?>">
						<td class="first style1"><?=$site?></td>
						<td><?=$toplamuye?> <br><?=$toplamgold?> kiþi üyelik yükseltmiþ.</td>
						<td>
						<span id="siteuyeler<?=$id?>"></span>
						</td>
						<td class="last">
						<a href="javascript:void(0);" onclick="istatistik('<?=$site?>', <?=$id?>)" title="Sil"><img src="img/edit-icon.gif" width="16" height="16" /></a>
						<a href="javascript:void(0);" onclick="sitesil(<?=$id?>)" title="Sil"><img src="img/hr.gif" width="16" height="16" /></a>
						</td>
					</tr>
					
					<?
						}
					?>
					</div>
				</table>
			</div>
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan referanslarýn istatistikleri görülebilir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?
}
?>
