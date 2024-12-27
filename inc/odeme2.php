<?php

session_start();

$islem = $_POST["islem"];

if(!$islem) die();

include("../ayarlar.php");
include("../fonksiyon.php");

$uyeid = uyeid();

if(!is_numeric($uyeid)) die();

if($islem == "kredikarti"){

	$ad = $_POST["ad"];
	$tel = $_POST["tel"];
	$mail = $_POST["mail"];
	$num1 = $_POST["num1"];
	$num2 = $_POST["num2"];
	$num3 = $_POST["num3"];
	$num4 = $_POST["num4"];
	$ay = $_POST["ay"];
	$yil = $_POST["yil"];
	$tutar = $_POST["tutar"];
	$cvc = $_POST["cvc"];
	
	$ad = turkce($ad);
	
	if(!$tutar or $tutar == "undefined") die("hata1");
	
	list($seviye, $sure) = explode(";", $tutar);
	
	$odenecektutar = seviye($seviye, "$sure");
	
	$tutar = $odenecektutar;
	
	if(strlen($ay) == 1) $ay = "0". $ay;
	
	// ödeme kodlarý buraya
	

$name="kolay";       			//Sanal pos api kullanic adi

$password="ERT539600";    			//Sanal pos api kullanicisi sifresi

$clientid="103346980";    			//Sanal pos magaza numarasi

$lip=gethostbyname($REMOTE_ADDR);  	//Son kullanici IP adresi

$email="";  						//Email

$oid=""; //$_POST['oid'];				//Siparis numarasy her islem icin farkli olmalidir ,

                                    //bo? gonderilirse sistem bir siparis numarasi üretir.

$type="Auth";   					//Auth: Saty? PreAuth Ön Otorizasyon

$ccno=$num1.$num2.$num3.$num4; //$_POST['cardno'];             //Kart Numarasy

$ccay=$ay;           //Kart son kullanma ay

$ccyil=$yil;           //Kart son kullanma yil

//$tutar=$_POST['total'];  			//Kurus ayyraci olarak "." kullanylmalydyr.

$cv2=$cvc;                 //Kart guvenlik kodu

$taksit="";           //Taksit sayisi Pe?in saty?larda bo? gonderilmelidir, "0" gecerli sayilmaz.

                                    //Provizyon alinamadigi durumda taksit sayisi degistirilirse sipari numarasininda

                                    //degistirilmesi gerekir.





// XML request sablonu

$request= "DATA=<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>

<CC5Request>

<Name>{NAME}</Name>

<Password>{PASSWORD}</Password>

<ClientId>{CLIENTID}</ClientId>

<IPAddress>{IP}</IPAddress>

<Email>{EMAIL}</Email>

<Mode>P</Mode>

<OrderId>{OID}</OrderId>

<GroupId></GroupId>

<TransId></TransId>

<UserId></UserId>

<Type>{TYPE}</Type>

<Number>{CCNO}</Number>

<Expires>{CCTAR}</Expires>

<Cvv2Val>{CV2}</Cvv2Val>

<Total>{TUTAR}</Total>

<Currency>949</Currency>

<Taksit>{TAKSIT}</Taksit>

<BillTo>

<Name></Name>

<Street1></Street1>

<Street2></Street2>

<Street3></Street3>

<City></City>

<StateProv></StateProv>

<PostalCode></PostalCode>

<Country></Country>

<Company></Company>

<TelVoice></TelVoice>

</BillTo>

<ShipTo>

<Name></Name>

<Street1></Street1>

<Street2></Street2>

<Street3></Street3>

<City></City>

<StateProv></StateProv>

<PostalCode></PostalCode>

<Country></Country>

</ShipTo>

<Extra></Extra>

</CC5Request>

";







//De?i?ken parametrelerin XML sablona yazilmasi



      $request=str_replace("{NAME}",$name,$request);

      $request=str_replace("{PASSWORD}",$password,$request);

      $request=str_replace("{CLIENTID}",$clientid,$request);

      $request=str_replace("{IP}",$lip,$request);

      $request=str_replace("{OID}",$oid,$request);

      $request=str_replace("{TYPE}",$type,$request);

      $request=str_replace("{CCNO}",$ccno,$request);

      $request=str_replace("{CCTAR}","$ccay/$ccyil",$request);

      $request=str_replace("{CV2}","$cv2",$request);

      $request=str_replace("{TUTAR}",$tutar,$request);

      $request=str_replace("{TAKSIT}",$taksit,$request);





		// Sanal pos adresine baglanti kurulmasi

        // Test icin $url = "https://cc5test.est.com.tr/servlet/cc5ApiServer"

        // Üretim ortami için $url = "https://sanalpos.teb.com.tr/servlet/cc5ApiServer"



       $url = "https://vpos.est.com.tr/servlet/cc5ApiServer";

        // $url = "https://vpos.est.com.tr/servlet/cc5ApiServer";  //GERÇEK

		$ch = curl_init();    // initialize curl handle

		

		curl_setopt($ch, CURLOPT_URL,$url); // set url to post to

		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);

		

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);

		

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable

		curl_setopt($ch, CURLOPT_TIMEOUT, 90); // times out after 90s

		curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // add POST fields



		$result = curl_exec($ch); // run the whole process





       if (curl_errno($ch)) {

           print curl_error($ch);

       } else {

           curl_close($ch);

       }





 $Response ="";

 $OrderId ="";

 $AuthCode  ="";

 $ProcReturnCode    ="";

 $ErrMsg  ="";

 $HOSTMSG  ="";



$response_tag="Response";

$posf = strpos (  $result, ("<" . $response_tag . ">") );

$posl = strpos (  $result, ("</" . $response_tag . ">") ) ;

$posf = $posf+ strlen($response_tag) +2 ;

$Response = substr (  $result, $posf, $posl - $posf) ;



$response_tag="OrderId";

$posf = strpos (  $result, ("<" . $response_tag . ">") );

$posl = strpos (  $result, ("</" . $response_tag . ">") ) ;

$posf = $posf+ strlen($response_tag) +2 ;

$OrderId = substr (  $result, $posf , $posl - $posf   ) ;



$response_tag="AuthCode";

$posf = strpos (  $result, "<" . $response_tag . ">" );

$posl = strpos (  $result, "</" . $response_tag . ">" ) ;

$posf = $posf+ strlen($response_tag) +2 ;

$AuthCode = substr (  $result, $posf , $posl - $posf   ) ;



$response_tag="ProcReturnCode";

$posf = strpos (  $result, "<" . $response_tag . ">" );

$posl = strpos (  $result, "</" . $response_tag . ">" ) ;

$posf = $posf+ strlen($response_tag) +2 ;

$ProcReturnCode = substr (  $result, $posf , $posl - $posf   ) ;



$response_tag="ErrMsg";

$posf = strpos (  $result, "<" . $response_tag . ">" );

$posl = strpos (  $result, "</" . $response_tag . ">" ) ;

$posf = $posf+ strlen($response_tag) +2 ;

$ErrMsg = substr (  $result, $posf , $posl - $posf   ) ;

	

	
	if($Response == "Approved"){
	
		$birgun = 60*60*24; // 60 saniye 1 saat 60 dakika 1 gün 24 saat
		
		switch($sure){
			case "aylik"; $eklezaman = $birgun * 30;break;
			case "aylik3"; $eklezaman = $birgun * 90;break;
			case "aylik6"; $eklezaman = $birgun * 180;break;
			case "yillik"; $eklezaman = $birgun * 365;break;
			case "sinirsiz"; $eklezaman = 0;break;
		}
		
		$uyecinsiyet = uyebilgi("cinsiyet");
		
		$seviyeoncelik = seviye($seviye, "oncelik");
		
		$oncelik = $uyecinsiyet * $seviyeoncelik;
		
		if($sure == "sinirsiz"){

			$result = mysql_query("update "._MX."uye set bitis='0', oncelik='$oncelik', seviye='$seviye' where id='$uyeid'");		
		
		}
		else {
		
			$uyezaman = uyebilgi("bitis");
			
			$simdi = time();
			
			if($uyezaman > $simdi){
			
			$zaman = $uyezaman + $eklezaman;
		
			}
			
			else {
			
			$zaman = $simdi + $eklezaman;
			
			}
			$result = mysql_query("update "._MX."uye set bitis='$zaman', oncelik='$oncelik', seviye='$seviye' where id='$uyeid'");
			
			
		}
		
		$kayit = time();
		
		$ip = $_SERVER["REMOTE_ADDR"];
		
		mysql_query("insert into "._MX."odeme values(NULL, '$uyeid', '1', '$ad', '$tel', '', '$mail', '$ip', '$odenecektutar', '$seviye', '$sure', '$kayit', '1')");
		
		die("ok");
		
		
	
	}
	else {
		die("hata2");
	}
	

}

if($islem == "havale"){

	$ad = $_POST["ad"];
	$tel = $_POST["tel"];
	$mail = $_POST["mail"];
	$tutar = $_POST["tutar"];
	$mesaj = $_POST["mesaj"];

	
	$ad = turkce($ad);
	$mesaj = turkce($mesaj);
	
	if(!$tutar or $tutar == "undefined") die("hata1");
	
	list($seviye, $sure) = explode(";", $tutar);
	
	$odenecektutar = seviye($seviye, "$sure");

	$kayit = time();
	
	$ip = $_SERVER["REMOTE_ADDR"];
	
	$mesaj = addslashes($mesaj);
	
	mysql_query("insert into "._MX."odeme values(NULL, '$uyeid', '2', '$ad', '$tel', '$mesaj', '$mail', '$ip', '$odenecektutar', '$seviye', '$sure', '$kayit', '2')");
		
	die("ok");

}
?>