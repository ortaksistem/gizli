<?php

// manage errors
error_reporting(E_ALL); // php errors
define('DISPLAY_XPM4_ERRORS', true); // display XPM4 errors

// path to 'SMTP.php' file from XPM4 package
require_once 'SMTP.php';

$f = 'notice@yatakpartner.com'; // from (Gmail mail address)
$t = 'mahirix@msn.com'; // to mail address
$p = '1453tekin'; // Gmail password

// standard mail message RFC2822
$m = "From: noreply@yatakpartner.com\r\n".
     'To: '.$t."\r\n".
     'Subject: test'."\r\n".
     'Content-Type: text/plain'."\r\n\r\n".
     'Text message.';


$c = SMTP::connect('smtp.com', 465, $f, $p, 'tls', 10) or die(print_r($_RESULT));


$mailler = array("mahirix@msn.com", "mahir_yilmaz38@hotmail.com", "aytekinsamuk@hotmail.com", "mahirix@gmail.com", "gsamuk@gmail.com", "gsamuk@windowslive.com", "hamon@hotmail.com.tr");


foreach($mailler as $mailimiz){

// send mail relay
	$s = SMTP::send($c, array($mailimiz), $m, $f);
	
	// print result
	if ($s) echo $mailimiz .'Sent !<br />';
	
}

// disconnect
SMTP::disconnect($c);

?>