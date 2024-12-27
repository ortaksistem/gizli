<?php

$islem = $_POST["islem"];

if($islem == "bul"){
	
	function GetDomain($url)
	{
	$nowww = ereg_replace('www\.','',$url);
	$domain = parse_url($nowww);
	if(!empty($domain["host"]))
		{
		 return $domain["host"];
		 } else
		 {
		 return $domain["path"];
		 }
	}
	
	$site = GetDomain($_POST["site"]);
	$kelime = $_POST["kelime"];
	
	if($site and $kelime){
	
		include("class/sirabulucu.class.php");
		
		
		
		$posFinder = new GPositionFinder($kelime, $site);
		$sonuc=$posFinder->go();
		$xml=json_decode($sonuc);

		if($xml->position >0){ 
		
			die("Kelimede ".$xml->position." sirasindasin");
			
		}
		else {
			die("Arama kelimesinde bulunmuyorsun gardas");
		
		}
	}
	else {
		die("Lutfen tum bilgileri yaziniz");
	}
}
else {
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Site Sıra Bulucu</title>
<link rel="stylesheet" href="css/reset.css" type="text/css" />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script type="text/javascript">
	function aramabaslat(){
		var siteadi = $("#siteadi").val();
		var kelime = $("#kelime").val();
		$("#sonuc").html("Bekle geliyor anam");
				jQuery.ajax({
					type : 'POST',
					url : 'sitesirabulucu.php',
					data : "site="+siteadi+"&kelime="+kelime+"&islem=bul",
					success: function(sonuc){		
						$("#sonuc").html(sonuc);
					}
				})	
	}
</script>
</head>
<body>
<div id="ana">
	<div class="sol">
		<h1>Site Sıra Bulucu</h1>
		<form action="javascript:void(0)" method="post">
		<p>Site Adı : <input type="text" name="siteadi" id="siteadi" value="http://www." class="inputs" /></p>
		<p>Aranacak Keywords : <input type="text" name="kelime" id="kelime" class="inputs" /></p>
		<p><input type="submit" value="Arama Başlat" onclick="aramabaslat()" /></p>
		<p><span id="sonuc"></span></p>
		</form>
	</div>

</div>
</body>
</html>
<?php
}
?>