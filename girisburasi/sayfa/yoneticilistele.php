<?

$islem = $_GET["islem"];

if($islem == "sil"){
	
	$id = $_POST["id"];
	
	$result = mysql_query("delete from "._MX."admin where id='$id'");
	
	if($result) die("ok");
	else die("hata");
	
	
}
else {
list($seviye) = mysql_fetch_row(mysql_query("select seviye from "._MX."admin where id='".adminid()."'"));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Yöneticiler | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
	function sil(id){
		$("#uyesonuc"+id).hide();
		
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?sayfa=yoneticilistele&islem=sil',
			data: 'id='+id,
			success: function(sonuc){
				if(sonuc == "hata") alert("Silinemedi sonra tekrar deneyin");
			}
			
		})
	}
</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/yoneticiler.php"); ?>
		<div id="center-column">
		<form action="index.php?sayfa=yonetici&islem=kaydet" method="post">
		  <div class="table">
				<?php
					
					if($seviye != 1){
						echo "<p align=center><b>Bu alanı kullanma yetkiniz bulunmamaktadır</b></p>";
						die();
					}
					
				?>
			<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="160">Admin kullanıcı adı</th>
						<th>Email</th>
						<th>Süper admin</th>
						<th class="last">İşlem</th>
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					<?php
						$result = mysql_query("select id, kullanici, sifre, email, seviye from "._MX."admin");
						
						
						while(list($id, $kullanici, $sifre, $email, $seviye) = mysql_fetch_row($result)){
						
						if($seviye != 2){
						if($seviye == 1) $seviye = "<font color=green><b>Evet</b></font>";
						else $seviye = "<font color=red><b>Hayır</b></font>";
					
					?>
					<tr id="uyesonuc<?=$id?>">
						<td class="first style1"> <?=$kullanici?></td>
						<td><?=$email?></td>
						<td><?=$seviye?></td>
						<td class="last">
						<a href="index.php?sayfa=yoneticiduzenle&id=<?=$id?>" title="Düzenle"><img src="img/add-icon.gif" /></a> 
						<a href="javascript:sil(<?=$id?>)" title="Sil"><img src="img/hr.gif" /></a> 
						</td>
					</tr>
					
					<?php
						}
					}
					?>
			
			</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan yeni yönetici ekleyebilir, ekli yöneticileri düzenleyebilir ve silebilirsiniz. Bu alan geliştirmeye açıktır şimdilik sadece yönetici eklenmek için kullanılacaktır.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>