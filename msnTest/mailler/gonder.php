<?php

include("class.phpmailer.php");

$siteadi = "Yatakpartner.com";


			$mail = new PHPMailer(true);
																			
			$mail->IsSMTP();
			$mail->Host       = "smtp.com";		
			$mail->SMTPDebug  = 2;
			$mail->SMTPAuth   = true;         		    
			$mail->Host       = "smtp.com";		
			$mail->Port       = 2525; 		
			$mail->Username   = "notice@yatakpartner.com";		
			$mail->Password   = "1453tekin";
			$mail->AddReplyTo('notice@yatakpartner.com', $siteadi);		
			$mail->SetFrom('notice@yatakpartner.com', $siteadi);				
			$mail->Subject = ''.$siteadi.': Mesajiniz var.! '.rand(10000,1000000).'';		
			$mail->AltBody = ''.$siteadi.': Mesajiniz var.! '.rand(10000,1000000).'';
			$mail->AddAddress('mahirix@msn.com', $siteadi);									  
			$mail->MsgHTML("Asl�nda rezilli�i diye ba�l�k atmak en mant�kl�s� olabilirdi fakat ba�l�kda da rezil etmeyim dedim. A�a��ya kan�t�n�n resminide koyaca��m. ��yle bir durum var �ekim alan� i�indeyseniz ve ayl�k 100mb s�n�r� a�mad�ysan�z h�z ger�ekten g�zel. Fakat reklam verdi�i, orda burda anlatt��� s�per internet ad� alt�nda da��tt��� mobil internette ayl�k 100 mb kota konuluyor. Buna da adil kullan�m diye m��teri temsilcilerinin a�z�na sak�z niyetine s�ylettiriyorlar. Ve o an geliyor. 100 mb kota bittikten sonra internet i�ler ac�s�. Ne kadar kasarsan�z kas�n, ne indirirseniz indirin ay�n son g�nlerinde anca 100 mb daha kullanabilirsiniz.");									  
			$mail->Send();

?>