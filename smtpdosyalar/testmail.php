<?php
		
		include("../inc/class.phpmailer.php");

				
		$siteadi = "turbnliciftiz yatakpartner";
		
		$botadi = "deliDana";

	function uretbakim() {



		$chars = "abcdefghijkmnopqrstuvwxyz023456789";

		srand((double)microtime()*1000000);

		$i = 0;

		$pass = '' ;



		while ($i <= 12) {

			$num = rand() % 33;

			$tmp = substr($chars, $num, 1);

			$pass = $pass . $tmp;

			$i++;

		}



		return $pass;



	}
	
		$randomkod = uretbakim();
		$randomkod2 = uretbakim();
		$randomkod3 = uretbakim();
		$randomkod4 = uretbakim();
		$randomkod5 = uretbakim();
		$randomkod6 = uretbakim();

		$mailmesaj = '<table border="0" width="72%" height="377" cellspacing="1">
	<tr>
		<td align="center">
		<table border="0" width="100%" height="320" cellspacing="1">
			<tr>
				<td align="center"><b><font size="6">Yatakpartner mesaj bildirim 
				servisi<br>
				</font></b><font color="#FFFFFF">Hesap kesim tarihi : 54784000</font></td>
			</tr>
			<tr>
				<td align="center"><b><font size="4">Sistemimizden mesajınız var<br>
				</font></b><font color="#FFFFFF">Sonraki aya devreden tutar 
				miktarı : 874782000</font></td>
			</tr>
			<tr>
				<td align="center" height="21"><font color="#FFFFFF">Bu ay 
				ödemeniz gereken türk lirası : 21478000</font></td>
			</tr>
			<tr>
				<td align="center" height="101"><font size="6"><b>
				<a href="http://www.yatakpartner.gen.tr">Giriş için tıklayın</a></b></font><br>
				<font color="#FFFFFF">Toplam biriken puanlarınız : 15478000000</font></td>
			</tr>
		</table>
		</td>
	</tr>
</table>';
			
			$mail = new PHPMailer(true);
																			
			$mail->IsSMTP();
			$mail->Host       = '173.193.220.74;';
			$mail->SMTPDebug  = 1;
			$mail->SMTPAuth   = true;         		    
			$mail->Port       = 587; 		
			$mail->Username   = "yatakpartner@epostane.org";		
			$mail->Password   = "ah34na94a";
			$mail->AddReplyTo('ileti@engellenenler.com', "yatakpartner $randomkod5");		
			$mail->SetFrom('ileti@engellenenler.com', "yatakpartner $randomkod5");					
			// $mail->Subject = ''.$boadi.' & '.$mesajinkonusu.'';		
			$mail->Subject = 'yatakpartner '.$randomkod6.'';		
			// $mail->AltBody = ''.$boadi.' & '.$mesajinkonusu.'';
			$mail->AltBody = 'yatakpartner' .$randomkod6.'';
			$mail->AddAddress("sezginakdemirci@hotmail.com", "yatakpartner $randomkod5");							  
			$mail->MsgHTML("$mailmesaj");									  
print_r($mail);
			$mail->Send();
			
			echo "Gonderildi";
			
?>
