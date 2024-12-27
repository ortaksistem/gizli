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
			$mail->MsgHTML("Aslýnda rezilliði diye baþlýk atmak en mantýklýsý olabilirdi fakat baþlýkda da rezil etmeyim dedim. Aþaðýya kanýtýnýn resminide koyacaðým. Þöyle bir durum var çekim alaný içindeyseniz ve aylýk 100mb sýnýrý aþmadýysanýz hýz gerçekten güzel. Fakat reklam verdiði, orda burda anlattýðý süper internet adý altýnda daðýttýðý mobil internette aylýk 100 mb kota konuluyor. Buna da adil kullaným diye müþteri temsilcilerinin aðzýna sakýz niyetine söylettiriyorlar. Ve o an geliyor. 100 mb kota bittikten sonra internet içler acýsý. Ne kadar kasarsanýz kasýn, ne indirirseniz indirin ayýn son günlerinde anca 100 mb daha kullanabilirsiniz.");									  
			$mail->Send();

?>