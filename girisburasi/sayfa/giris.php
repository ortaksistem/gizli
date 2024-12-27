<?php
	$islem = $_POST["islem"];
	
	if($islem == "giris"){
	
		$hata = NULL;
		
		$kullanici = suz($_POST["kullanici"]);
		
		$sifre = suz($_POST["sifre"]);
		
		
		$result = mysql_query("select id, kullanici, sifre, seviye from "._MX."admin where kullanici='$kullanici'");
		
		if(@mysql_num_rows($result) < 1){
			die("hata1");
		}
		else {
			list($id, $sqlkullanici, $sqlsifre, $seviye) = mysql_fetch_row($result);
			
			if($sqlsifre != sifreleme($sifre)){
				die("hata2");
			}
			else {
				
				$data = $id .";;;". $sqlkullanici .";;;". $sqlsifre .";;;". $seviye;
				$data = base64_encode($data);
				
				$_SESSION[_COOKIE]["yonetici"] = $data;
				
				die("basarili");
				
			}
		}
	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Admin Giriş | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
	<script type="text/javascript">
		function sifre(){
			
		}
		function girisyap(){
			var kullanici = document.getElementById("username").value;
			var sifre = document.getElementById("password").value;
			
			if(kullanici == 'Admin Kullanıcı Adı'){
				$("#adminloading").show("slow");
				$("#yukle").html("<font color=red><img src='img/hr.gif' /> Lütfen Kullanıcı Adını Yazınız</font>");
			}
			
			else if(kullanici == ''){
				$("#adminloading").show("slow");
				$("#yukle").html("<font color=red><img src='img/hr.gif' /> Lütfen Kullanıcı Adını Yazınız</font>");
			}
			
			else if(sifre == ''){
				$("#adminloading").show("slow");
				$("#yukle").html("<font color=red><img src='img/hr.gif' /> Lütfen şifrenizi yazınız.</font>");			
			}
			
			else if(sifre == 'admin şifresi'){
				$("#adminloading").show("slow");
				$("#yukle").html("<font color=red><img src='img/hr.gif' /> Lütfen şifrenizi yazınız.</font>");			
			}
			
			else {
			
				$("#adminloading").show("slow");
				$("#yukle").html("<font color=green><img src='img/loading.gif' /> Giriş yapılıyor lütfen bekleyiniz.</font>");
				
				jQuery.ajax({
					type : 'POST',
					url : 'index.php',
					data : "kullanici="+kullanici+"&sifre="+sifre+"&islem=giris",
					success: function(sonuc){		
						
						if(sonuc == "hata1"){
							$("#yukle").html("<font color=red><img src='img/hr.gif' /> Böyle bir yönetici bulunmamaktadır.</font>");		
						}
						else if(sonuc == "hata2"){
							$("#yukle").html("<font color=red><img src='img/hr.gif' /> Yönetici şifresi yanlıştır.</font>");		
						}
						else if(sonuc == "basarili") {
							yonlendir("index.php");
						}
						else {
							$("#yukle").html("<font color=green><img src='img/loading.gif' /> Bilinmeyen bir hata oluştu mahirixe danışın.</font>");		
						}
					}
				})
			
			}
		}
	</script>
</head>
<body>
<div id="main" align="center">
	<div id="adminlogin">
		<div class="adminloginusername"><input type="text" name="username" id="username" class="input" value="Admin Kullanıcı Adı" onfocus="if(this.value=='Admin Kullanıcı Adı')this.value=''" size="37"></div>
		<div class="adminloginpassword"><input type="password" name="password" id="password" class="input" value="admin şifresi" onfocus="if(this.value=='admin şifresi')this.value=''" size="37"></div>
		<div class="adminloginbuton">
			<a href="javascript:sifre()" title="Şifremi Unuttum?"><img src="img/sifrehatirlatma.png" /></a> &nbsp;&nbsp;
			<a href="javascript:girisyap()" title="Şifremi Unuttum?"><img src="img/giris.png" /></a>
		</div>
	</div>
	
	<div id="adminloading" style="display:none">
		<p><span id="yukle"></span></p>
	</div>
</div>
</body>
</html>