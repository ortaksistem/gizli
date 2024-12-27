<?

if(seviyeal("seviyeid") == 3){
	yonlendir("index.php?sayfa=hata");
	die();
}

$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$uyeadi = uyeadi();

$girecekler = array("1", "2", "4", "5", "6");
															
$uyecins = uyebilgi("cinsiyet");
															
if(!in_array($uyecins, $girecekler)) die("Sistem hatasi lutfen yoneticiye basvurun");


if($uyecins == 1 or $uyecins == 4 or $uyecins == 5) $asilcins = 2;
else $asilcins = 1;														
?>
<html>
<head>
<meta http-equiv="Content-Language" content="tr">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<title>Görüntülü Sohbet <?=$uyeadi?>, <?=_BASLIK?></title>
<meta name="keywords" content="<?=_KEYWORDS?>">
<meta name="description" content="<?=_DESCRIPTION?>">
<meta name="copyright" content="Copyright (c) 2009 <?=_AD?>">
<style type="text/css">
	body {
		margin:0px;
		padding:0px;
		background-color:#1d436a;
	}
</style>
</head>
<body bgcolor="#1d436a">
<iframe height="710" width="670" src="http://85.17.73.196/index.php?kullanici=<?=$uyeadi?>&cinsiyet=<?=$asilcins?>" scrolling="no" frameborder="0"></iframe>
</body>
</html>