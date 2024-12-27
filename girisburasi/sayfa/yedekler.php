<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Yedek Listesi | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/bakim.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post" name="bakimform">
		  <div class="table">

				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Yedek Listesi</th>
					</tr>
					<?php
					
						$open = opendir("yedek");
						
						$i = 0;
						
						while($read = readdir($open)){
						
						
							if(strstr($read, "gz")){
							
					?>
					<tr<?=$bg?>>
						<td class="first" width="350"><strong><?=$read?></strong></td>
						<td class="last" style="text-align:left"><a href="yedek/<?=$read?>" title="İndir">İndir</a></td>
					</tr>
					<?
							$i++;
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
			<div class="box">Yonetim klasörü içerindeki yedek klasöründeki veritabanı yedekleri listelenir.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
