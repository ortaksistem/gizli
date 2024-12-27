<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1254">
<title>Refler</title>
<script type="text/javascript" src="inc/jquery.js"></script>
<script type="text/javascript">
	function git(sayfa){
		window.location = "http://www.ypartner.net/reflerigoster.php?sayfa="+sayfa;
	}
	
</script>
</head>
<body>
<?php
	include("ayarlar.php");
	include("fonksiyon.php");
	$limit = 50;
	$result = @mysql_query("select id from "._MX."ref2");
	$sayi=@mysql_num_rows($result);
	$toplamsayfa = ceil(($sayi/$limit));
	$p = $_GET['sayfa'];
	$p = intval($p);
	if (!$p) $p = 1;	
	
	$result = @mysql_query("select ref, zaman from "._MX."ref2 order by id desc limit ".(($p-1)*$limit).",".$limit."");
	?>
	<table>
	<?php
	while(list($ref, $zaman) = mysql_fetch_row($result)){
		
		?>
			<tr><td style="width:300px;height:50px;overflow:hidden" ><a href="<?=$ref?>" target="_blank"><?=$ref?></a></td><td><?php echo date("H:i d.m.Y", $zaman);?></td></tr>
		
		<?
	
	}
?>
	</table>
</body>
</html>