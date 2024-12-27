<?php


// manage errors
error_reporting(E_ALL); // php errors
define('DISPLAY_XPM4_ERRORS', true); // display XPM4 errors

// path to 'SMTP.php' file from XPM4 package
require_once 'SMTP.php';

$f = 'tekin@dekatek.com'; // from (Gmail mail address)
$t = 'mahirix@msn.com'; // to mail address
$p = '1453tekin'; // Gmail password

// standard mail message RFC2822
$m = 'From: '.$f."\r\n".
     'To: '.$t."\r\n".
     'Subject: test'."\r\n".
     'Content-Type: text/plain'."\r\n\r\n".
     'Text message.';

// connect to 'smtp.gmail.com' via SSL (TLS encryption) using port '465' and timeout '10' secounds
// make sure you have OpenSSL module (extension) enable on your php configuration
$c = fsockopen('tls://smtpcorp.com', 465, $errno, $errstr, 10) or die($errstr);
// expect response code '220'
if (!SMTP::recv($c, 220)) die(print_r($_RESULT));
// EHLO/HELO
if (!SMTP::ehlo($c, 'localhost')) SMTP::helo($c, 'localhost') or die(print_r($_RESULT));
// AUTH LOGIN/PLAIN
if (!SMTP::auth($c, $f, $p, 'login')) SMTP::auth($c, $f, $p, 'plain') or die(print_r($_RESULT));
// MAIL FROM
SMTP::from($c, $f) or die(print_r($_RESULT));
// RCPT TO
SMTP::to($c, $t) or die(print_r($_RESULT));
// DATA
SMTP::data($c, $m) or die(print_r($_RESULT));
// RSET, optional if you need to send another mail using this connection '$c'
// SMTP::rset($c) or die(print_r($_RESULT));
// QUIT
SMTP::quit($c);
// close connection
@fclose($c);

echo 'Sent !';

?>