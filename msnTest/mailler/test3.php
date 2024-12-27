<?php


// manage errors
error_reporting(E_ALL); // php errors
define('DISPLAY_XPM4_ERRORS', true); // display XPM4 errors

// path to 'POP3.php' and 'SMTP.php' files from XPM4 package
require_once 'POP3.php';
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

// connect to 'pop3.hostname.net' POP3 server address with authentication username '$f' and password '$p'
$p = POP3::Connect('smtpcorp.com', $f, $p) or die(print_r($_RESULT));
// connect to 'smtp.hostname.net' SMTP server address
$c = SMTP::Connect('smtpcorp.com') or die(print_r($_RESULT));

// send mail
$s = SMTP::Send($c, array($t), $m, $f);

// print result
if ($s) echo 'Sent !';
else print_r($_RESULT);

// disconnect from SMTP server
SMTP::Disconnect($c);
// disconnect from POP3 server
POP3::Disconnect($p);

?>