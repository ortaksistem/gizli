	function kaydet(){
		$("#uyari").hide("slow");
		$("#kaydol").show();
	}
	function sehirgetir(ulke){
	
		$("#sehirgetir").html("<font color=red size=2><b>Bekleyin</b></font>");
				
				jQuery.ajax({
					type : 'POST',
					url : 'inc/sehiryukle.php',
					data : "ulke="+ulke,
					success: function(sonuc){		
						$("#sehirgetir").html(sonuc);	
					}
				})
	}
	
	function degerlendir(tur){
		var deger = document.getElementById(tur).value;
		if(!deger){
			$("#span"+tur+"").html("<img src='img/cross.png' /><input type='hidden' name='"+tur+"sonuc' id='"+tur+"sonuc' value='no' />");
		}
		else {
				jQuery.ajax({
					type : 'POST',
					url : 'inc/degerlendir.php',
					data : "tur="+tur+"&deger="+deger,
					success: function(sonuc){		
						if(sonuc == "ok") {
							$("#span"+tur+"").html("<img src='img/tick.png' /><input type='hidden' name='"+tur+"sonuc' id='"+tur+"sonuc' value='ok' />");
						}
						else if(sonuc == "email"){
							$("#span"+tur+"").html("<img src='img/cross.png' /><font color=red size=1><b>Email adresi kay�tl�d�r</b></font><input type='hidden' name='"+tur+"sonuc' id='"+tur+"sonuc' value='no' />");
						}
						else if(sonuc == "rumuz"){
							$("#span"+tur+"").html("<img src='img/cross.png' /><font color=red size=1><b>Rumuz kay�tl�d�r</b></font><input type='hidden' name='"+tur+"sonuc' id='"+tur+"sonuc' value='no' />");
						}
						else if(sonuc == "rumuz2"){
							$("#span"+tur+"").html("<img src='img/cross.png' /><font color=red size=1><b>Rumuz yasakl�d�r</b></font><input type='hidden' name='"+tur+"sonuc' id='"+tur+"sonuc' value='no' />");
						}
						else {
							$("#span"+tur+"").html("<img src='img/cross.png' /><input type='hidden' name='"+tur+"sonuc' id='"+tur+"sonuc' value='no' />");
						}	
					}
				})		
		}
	}
	
	function sifredegerlendir(){
		var deger = document.getElementById("sifre").value;
		var deger2 = document.getElementById("sifre2").value;
		if(!deger2){
			$("#spansifre2").html("<img src='img/cross.png' />");
			$("#spansifresonuc").html("<input type='hidden' name='sifresonuc2' id='sifresonuc2' value='no' />");
		}
		else if(deger != deger2){
			$("#spansifre2").html("<img src='img/cross.png' />");
			$("#spansifresonuc").html("<font color=red size=1><b>�ifre ile tekrar� uyu�muyor</b></font><input type='hidden' name='sifresonuc2' id='sifresonuc2' value='no' />");
		}
		else {
			$("#spansifresonuc").html("<font color=blue size=1><b>Bekleyin</b></font>");
				jQuery.ajax({
					type : 'POST',
					url : 'inc/sifredegerlendir.php',
					data : "sifre="+deger+"&sifre2="+deger2,
					success: function(sonuc){		
						if(sonuc == "1") {
							$("#spansifre2").html("<img src='img/tick.png' />");
							$("#spansifresonuc").html("<font color=red size=1><b>G�vensiz</b></font><input type='hidden' name='sifresonuc2' id='sifresonuc2' value='ok' />");
						}
						else if(sonuc == "2") {
							$("#spansifre2").html("<img src='img/tick.png' />");
							$("#spansifresonuc").html("<font color=blue size=1><b>Orta</b></font><input type='hidden' name='sifresonuc2' id='sifresonuc2' value='ok' />");
						}
						else if(sonuc == "3") {
							$("#spansifre2").html("<img src='img/tick.png' />");
							$("#spansifresonuc").html("<font color=green size=1><b>G�venli</b></font><input type='hidden' name='sifresonuc2' id='sifresonuc2' value='ok' />");
						}
						else {
							$("#spansifresonuc").html("<img src='img/cross.png' /><input type='hidden' name='sifresonuc2' id='sifresonuc2' value='no' />");
						}	
					}
				})	
		}
	}
	
	function gkodudegerlendir(){
		var deger = document.getElementById("gkodu").value;
		var deger2 = document.getElementById("gkodu2").value;
		if(deger == deger2){
			$("#spangkodu").html("<img src='img/tick.png' /><input type='hidden' name='gkdousonuc' id='gkodusonuc' value='ok' />");
		}
		else {
			$("#spangkodu").html("<img src='img/cross.png' /><input type='hidden' name='gkdousonuc' id='gkodusonuc' value='no' />");
		}
	}
	
	function uyeol(){
		$("#uyeolsonuc").html("<img src='img/loading.gif' /><font size=2 color=green>L�tfen Bekleyin...</b></font>");
		
		var hata = "";
		
		var adsonuc = document.getElementById('adsonuc').value;
		
		if(adsonuc != "ok"){
			hata = hata + "- Ad�n�z� Kontrol Ediniz<br />";
		}

		var soyadsonuc = document.getElementById('soyadsonuc').value;
		
		if(soyadsonuc != "ok"){
			hata = hata + "- Soyad�n�z� Kontrol Ediniz<br />";
		}

		var d3sonuc = document.getElementById('d3sonuc').value;
		
		if(d3sonuc != "ok"){
			hata = hata + "- Do�um Tarihinizi Kontrol Ediniz<br />";
		}
		
		var mailsonuc = document.getElementById('mailsonuc').value;
		
		if(mailsonuc != "ok"){
			hata = hata + "- Mailinizi Kontrol Ediniz<br />";
		}

		var cinsiyetsonuc = document.getElementById('cinsiyetsonuc').value;
		
		if(cinsiyetsonuc != "ok"){
			hata = hata + "- Cinsiyetinizi Se�mediniz<br />";
		}

		var ulkesonuc = document.getElementById('ulkesonuc').value;
		
		if(ulkesonuc != "ok"){
			hata = hata + "- �lkenizi Se�mediniz<br />";
		}

		var sehirsonuc = document.getElementById('sehirsonuc').value;
		
		if(sehirsonuc != "ok"){
			hata = hata + "- �ehir Se�mediniz<br />";
		}

		var rumuzsonuc = document.getElementById('rumuzsonuc').value;
		
		if(rumuzsonuc != "ok"){
			hata = hata + "- Rumuzunuzu Kontrol Ediniz<br />";
		}

		var sifresonuc = document.getElementById('sifresonuc2').value;
		
		if(sifresonuc != "ok"){
			hata = hata + "- �ifrenizi Kontrol Ediniz<br />";
		}

		var gkodusonuc = document.getElementById('gkodusonuc').value;
		
		if(gkodusonuc != "ok"){
			hata = hata + "- G�venlik kodu yanl��t�r<br />";
		}

		var sozlesme = document.getElementById('sozlesme').value;
		
		if(sozlesme != 1){
			hata = hata + "- S�zle�meyi kabul etmediniz<br />";
		}


		// var ceptelonayvarmi = document.getElementById('ceptelonayvarmi').value;
		
		/* 
		if(ceptelonayvarmi != 1){
			hata = hata + "- Cep telefonunuzu onaylamad�n�z<br />";
		}
		*/
																						
		if(hata){
			$("#uyeolsonuc").html("<font color=red size=2><b>"+hata+"</b></font>");
		}
		else {
			
			
			var zaman = new Date()
			var yil = zaman.getFullYear();
			var maxyil = yil - 20;
			var minyil = yil - 59;
			
			var ad = document.getElementById('ad').value;
			var soyad = document.getElementById('soyad').value;
			var d1 = document.getElementById('d1').value;
			var d2 = document.getElementById('d2').value;
			var d3 = document.getElementById('d3').value;
			var no1 = document.getElementById('no1').value;
			var no2 = document.getElementById('no2').value;
			var email = document.getElementById('mail').value;
			var cinsiyet = document.getElementById('cinsiyet').value;
			var ulke = document.getElementById('ulke').value;
			var sehir = document.getElementById('sehir').value;
			var rumuz = document.getElementById('rumuz').value;
			var sifre = document.getElementById('sifre').value;

			if(d3 >= maxyil){
			
				alert("L�tfen do�um y�l�n�z� kontrol ediniz.\nSitemize 21 ya��ndan k���k ve 60 ya��ndan b�y�k kullan�c�lar �ye olamaz.");
				
				$("#uyeolsonuc").html("");
				
				exit();
				
			}
			
			if(d3 <= minyil){
			
				alert("L�tfen do�um y�l�n�z� kontrol ediniz.\nSitemize 21 ya��ndan k���k ve 60 ya��ndan b�y�k kullan�c�lar �ye olamaz.");
				
				$("#uyeolsonuc").html("");
				
				exit();
			}
			
			var cinsiyetad = "";

			switch(cinsiyet){
				case "1": cinsiyetad = "Bayan";break;
				case "2": cinsiyetad = "�ift";break;
				case "3": cinsiyetad = "Erkek";break;
				case "4": cinsiyetad = "Lezbiyen";break;
				case "5": cinsiyetad = "Biseks�el Bayan";break;
				case "6": cinsiyetad = "Biseks�el �ift";break;
				case "7": cinsiyetad = "Biseks�el Erkek";break;
				case "8": cinsiyetad = "Transeks�el";break;
			}

			$("#uyeolsonuc").html("");
			
			var onayal = confirm("L�tfen bilgilerinizi kontrol ediniz.\n\nBu bilgileri site i�erisinde daha sonra g�ncelleme hakk�n�z bulunmamaktad�r. \nBilgileriniz a�a��dad�r\n*************************************\n\nKullan�c� ad�n�z : "+rumuz+"\n\nEmail Adresiniz : "+email+"\n\nDogum Tarihiniz : "+d1+"."+d2+"."+d3+"\n\nAd�n�z Soyad�n�z : "+ad+" "+soyad+"\n\nCinsiyetiniz : "+cinsiyetad+"\n\n*************************************\n\nBilgileriniz do�ru ise tamam tu�una bas�n�z, de�ilse iptal tu�una basarak yeniden d�zenleyebilirsiniz.");
			
			if(onayal){
				$("#uyeolsonuc").html("<img src='img/loading.gif' /><font size=2 color=green>L�tfen Bekleyin...</b></font>");
				jQuery.ajax({
					type : 'POST',
					url : 'inc/uyeol.php',
					data : "ad="+ad+"&soyad="+soyad+"&d1="+d1+"&d2="+d2+"&d3="+d3+"&no1="+no1+"&no2="+no2+"&email="+email+"&cinsiyet="+cinsiyet+"&ulke="+ulke+"&sehir="+sehir+"&rumuz="+rumuz+"&sifre="+sifre,
					success: function(sonuc){		
						if(sonuc == "hata"){
							$("#uyeolsonuc").html("<font color=red size=2>Bir sistem hatas� olu�tu. Bilgilerinizi kontrol ederek sonra tekrar deneyiniz</font>");
						}
						else if(sonuc == "uyeolmus"){
							alert("Sitemizden sadece bir defa �yelik alabilirsiniz.");
							yonlendir("index.php");
						}
						else {
							/*if(cinsiyet == 3){
							yonlendir("index.php?sayfa=uyeol_sms&id="+sonuc);
							}
							else {
							*/
							yonlendir("index.php?sayfa=uyeol2&id="+sonuc);
							/* } */
						}
					}
				})	
			}
		}
	}
	
	function yonlendir(url){
		window.location = url;
	}