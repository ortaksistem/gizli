<?php

	$islem = $_GET["islem"];

	$limit = 20; 
	
	if($islem == "tara"){

		?>
		<td>
			<table>
			
				<tr>
					<td>asdada</td>
				</tr>
			</table>
		</td>
		
		<?
		
		
		if($result) die("ok");
		else die("hata");
		
	}

	else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Çift Üyelikleri tara | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
</head>
<script type="text/javascript">
function tarabaslat(){

	
	$("#sonuclar").html("<img src='img/loading.gif' /> <font color=green size=1>Lütfen Bekleyin...</font>");
	
				jQuery.ajax({
					type : 'POST',
					url : 'index.php?sayfa=uyecift&islem=tara',
					data : "tara=ok",
					success: function(sonuc){		
						$("#sonuclar2").html(sonuc);
						$("#sonuclar").html("");
								
					}
				})
}

</script>
<body>
<div id="main">
	<div id="header">
<? include("menu/uye.php"); ?>
		<div id="center-column">
		  <div class="select-bar">
		    <label>
			<input type="submit" name="Submit" value=" Taramaya Başlat " onclick="tarabaslat()" /> <span id="sonuclar"></span>
			</label>
		 </div>
		  
			<div class="table" id="uyeyukle">
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr id="sonuclar2">
					</tr>
					<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
					<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
					</div>
				</table>
			</div>
			
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan çift üyelikleri tarayabilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?
}
?>
