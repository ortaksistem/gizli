<?

$islem = $_GET["islem"];

if($islem == "bosalt"){

}
else if($islem == "cek"){

}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Emailleri Cek | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">
	function baslat(){
		
		var onaylama = confirm("Email Adreslerine Mail G�ndermek istedi�inizden Emin Misiniz?");
		
		if(onaylama){
			
			var hiz = $("#hiz").val();
			
			window.location = 'index.php?sayfa=emailbotgonder&hiz='+hiz;
			
		}
	}
</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/bot.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post" name="bakimform">
		  <div class="table">

				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Mail G�nder</th>
					</tr>
					<?php
						
						list($soncekilen) = mysql_fetch_row(mysql_query("select soncekilen from "._MX."ayarlar2"));
						list($sonuncu) = mysql_fetch_row(mysql_query("select max(id) from "._MX."uye"));
						list($mail) = mysql_fetch_row(mysql_query("select count(id) from mailler where durum!='1'"));
						
						$kalan = $sonuncu - $soncekilen;
					
					?>
					<tr>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last"><input type="submit" value=" Tabloyu Bo�alt " onclick="bosalt()" /> <input type="submit" value=" �ekmeye Ba�la " onclick="baslat()" /></td>
					</tr>
					<tr>
						<td class="first"><strong>&nbsp;</strong></td>
						<td class="last" id="islem">
						<b>Son �ekilen �ye id : </b><?=$soncekilen?> <br />
						<b>Son Uye id : </b><?=$sonuncu?> <br />
						<b>�ekilecek: </b><?=$kalan?> <br />
						<b>At�lacak Mail Say�s�: </b><?=$mail?> <br />
						</td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan kullan�c� email adreslerini �ekebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>