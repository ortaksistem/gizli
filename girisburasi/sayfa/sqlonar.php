<?php

$islem = $_GET["islem"];

if($islem == "mahirix"){

		global $database;
		$result = mysql_query("SHOW TABLES");
		$table = "Tables_in_$database";
		while ($listele=mysql_fetch_assoc($result)){
			$tables = $listele[$table];
			if(eregi(_MX, $tables)){
				$repeir = mysql_query("REPAIR TABLE $tables");
					if($repeir){
						echo $tables . " Onarim Tamamlandi.<br /> ";
					}
			}
		}
		

}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Tabloları Onar | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">

	function onar(){
		
		$("#sonuc").html("<img src='img/loading.gif' /> Bekleyin ...");
		
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?sayfa=sqlonar&islem=mahirix',
			data: 'gonder=tamam',
			success: function(sonuc){
				$("#sonuc").html(sonuc);
			}
		
		})
	
	}
</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/bakim.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full">Tabloları Onar</th>
					</tr>
					<tr>
						<td class="last"><input type="submit" value=" Onarmayı Başlat " onclick="onar()" /> <p><span id="sonuc"></span></p></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan tabloları onarabilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>