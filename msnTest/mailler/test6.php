<?php

	include("class.phpmailer.php");
	
	$siteadi = "deneme";

			$mailmesaj = '<table border="8" width="80%" height="322" bordercolorlight="#425967" cellspacing="0" bordercolordark="#425967">
	<tr>
		<td valign="top"><font face="Tahoma" size="4" color="#425967"><b><br>
&nbsp;&nbsp; Yatakpartner Mesaj servisi</b></font><br>

		<font color="#C0C0C0">
		----------------------------------------------------------------------------------------------------<br>
		<br>
		</font><b><font color="#425967" face="Tahoma" size="2">&nbsp;Sayin 
		uyemiz xxxx kullanicisindan yeni mesajiniz var giris yaparak mesajinizi 
		okuyabilirsiniz</font></b><font color="#C0C0C0"><br>
		----------------------------------------------------------------------------------------------------<br>
		</font><b><font color="#425967" face="Tahoma" size="2">&nbsp;Kullanici 
		Adiniz : asdfghjklimn<br>
&nbsp;Sifreniz&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : 
		74125896321456</font></b><font color="#C0C0C0"><br>

		----------------------------------------------------------------------------------------------------<br>
		<br>
		</font><b><font face="Tahoma" size="6" color="#425967">&nbsp;Otomatik 
		giris icin buraya tiklayiniz<br>
		</font></b><font color="#C0C0C0"><br>
		----------------------------------------------------------------------------------------------------<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</font><font color="#425967">&nbsp;<b><font face="Arial Black" size="5">www.yatakpartner.com</font></b></font></td>

	</tr>
</table>';
			
	$mail = new PHPMailer(true);
	
			$mail->IsSMTP();
			$mail->Host       = "174.37.239.228";		
			$mail->SMTPDebug  = 2;
			$mail->SMTPAuth   = true;         		    
			$mail->Host       = "174.37.239.228";		
			$mail->Port       = 587; 		
			$mail->Username   = "batuhandemirkan@ask-mesk.com";		
			$mail->Password   = "s9d8t7";
			$mail->AddReplyTo('mesaj@benikimengelledi.net', $siteadi);		
			$mail->SetFrom('mesaj@benikimengelledi.net', $siteadi);					
			$mail->Subject = ''.$siteadi.': Mesajiniz var.!';		
			$mail->AltBody = ''.$siteadi.': Mesajiniz var.!';
			$mail->AddAddress("dsmtp7@hotmail.com", $siteadi);								  
			$mail->MsgHTML($mailmesaj);									  
			$mail->Send();

?>