<?

$islem = $_GET["islem"];

if($islem == "sil"){

	$id = $_POST["id"];
	
	list($resim) = mysql_Fetch_row(mysql_query("select resim from "._MX."galeri_resim where id='$id'"));
	
	@unlink("../$resim");
	
	$result = mysql_query("delete from "._MX."galeri_resim where id='$id'");
	
	
	if($result) die("ok");
	else die("hata");
	
	
}
else if($islem == "onayla"){

	$id = $_POST["id"];
	
	$result = mysql_query("update "._MX."galeri_resim set durum='1' where id='$id'");
	
	if($result) die("ok");
	else die("hata");
	
		
}
else if($islem == "topluonayla"){

	$id = $_GET["id"];
	
	$result = mysql_query("select id from "._MX."galeri_resim where galeri='$id'");
	
	while(list($rid) = mysql_Fetch_row($result)) mysql_query("update "._MX."galeri_resim set durum='1' where id='$rid'");
	
	mysql_query("update "._MX."galeri set durum='1' where id='$id'");
	
	list($uye) = mysql_fetch_row(mysql_query("select uye from "._MX."galeri where id='$id'"));
	
	mysql_query("update "._MX."uye set topgaleri=topgaleri+1 where id='$uye'");
	
	?>
		<script>
			alert("Galeri ve resimler baþarýyla onaylandý");
			window.close();
		</script>
	<?
	
}
else if($islem == "toplugaleri"){

	$id = $_GET["id"];

	list($uye) = mysql_fetch_row(mysql_query("select uye from "._MX."galeri where id='$id'"));
			
	mysql_query("update "._MX."galeri set durum='1' where id='$id'");
	
	?>
		<script>
			alert("Galeri onaylandý. Resimleri galeri resimlerinden onaylayabilirsiniz");
			window.close();
		</script>
	<?
	
}
else if($islem == "toplusil"){

	$id = $_GET["id"];
	
	$result = mysql_query("select id, resim from "._MX."galeri_resim where galeri='$id'");
	
	while(list($rid, $resim) = mysql_Fetch_row($result)) {
		@unlink("../$resim");
		
		mysql_query("delete from "._MX."galeri_resim where id='$rid'");
	}
	
	list($resim) = mysql_fetch_row(mysql_query("select resim from "._MX."galeri where id='$id'"));
	
	@unlink("../$resim");
	
	rmdir("../img_uye/galeri/$id");
	
	mysql_query("delete from "._MX."galeri where id='$id'");
	
	?>
		<script>
			alert("Galeri ve resimler baþarýyla silindi");
			window.close();
		</script>
	<?
	
}
else {

$id = $_GET["id"];

list($uye, $zaman, $gdurum) = mysql_fetch_row(mysql_query("select uye, kayit from "._MX."galeri where id='$id'"));

list($uyead, $cinsiyet, $sehir, $dogum, $img) = mysql_fetch_row(mysql_query("select kullanici, cinsiyet, sehir, dogum, img from "._MX."uye where id='$uye'"));
						
$cinsiyet = cinsiyet($cinsiyet);

$yil = date("Y");
					
$dogum = $yil - date("Y", $dogum);
						
$zaman = date("d.m.Y", $zaman);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Galeri <?=$id?> | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery-eski.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
function onayla(id){
	
		$("#onayspan"+id).hide();
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=galeri&islem=onayla',
			data : "id="+id,
			success: function(sonuc){	
				if(sonuc == "ok"){
					
				}
				else {
					alert("Resim onaylanamadý tekrar deneyiniz");
				}
			}
		})
}	

function sil(id){
	var onay = confirm("Emin misiniz?");
	
	if(onay){
		$("#resim"+id).hide();
		jQuery.ajax({
			type : 'POST',
			url : 'index.php?sayfa=galeri&islem=sil',
			data : "id="+id,
			success: function(sonuc){	
				if(sonuc == "ok"){
					
				}
				else {
					alert("Resim silinemedi tekrar deneyiniz");
				}
			}
		})
	}
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
						<th class="full" colspan="3">Galeri ID : <?=$id?> ( Ekleyen : <?=$uyead?> (<?=$cinsiyet?>, <?=$sehir?>, <?=$dogum?> Yaþ), Eklenme Tarihi : <?=$zaman?>)</th>
					</tr>
					<?php
						
						$result = mysql_query("select id, resim, durum from "._MX."galeri_resim where galeri='$id'");
						
						$i = 1;
						
						while(list($rid, $resim, $durum) = mysql_fetch_row($result)){
						
						
						?>
							<td id="resim<?=$rid?>" width="%25" align="center">
								<a href="javascript:void(0)" onclick="pencere('../<?=$resim?>', '500', '600', 'resimpopup<?=$rid?>', 2, 1, 1);"><img src="../<?=$resim?>" width="110" border="0" /></a>
								
								<p>
								<?php
									if($durum != 1){
										
										echo '<a href="javascript:onayla('.$rid.')" id="onayspan'.$rid.'" title="Resmi Onayla"><img src="img/add-icon.gif" border="0" /></a>';
									
									}
								
								?>
								<a href="javascript:sil(<?=$rid?>)" title="Resmi Sil"><img src="img/hr.gif" border="0" /></a>
								</p>
							</td>
						<?
						
						if($i%3 == 0) echo "</tr><tr>";
						
						$i++;
						
						}
					
					?>
	
						
					</tr>
					<tr>
						<td align="center" colspan="3">
							
							<?php
								if($gdurum != 1){
								
								?>
								<p><a href="index.php?sayfa=galeri&islem=topluonayla&id=<?=$id?>" title="Tüm Resimleri Onayla"><b>Tüm Resimleri Ve Galeriyi Onayla</b></a> </p>
								<p><a href="index.php?sayfa=galeri&islem=toplugaleri&id=<?=$id?>" title="Sadece Galeriyi Onayla"><b>Sadece Galeriyi Onayla</b></a> </p>
								<p><a href="index.php?sayfa=galeri&islem=toplusil&id=<?=$id?>" onclick="return confirm('Emin misiniz?')" title="Galeri ve Resimleri Sil"><b>Galeri ve Resimleri Sil</b></a> </p>
								<?
								}
							
							?>
						</td>
					</tr>
				</table>

			</div>	
					
	</div>


</body>
</html>
<?php
}
?>