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

// get client hostname
$h = explode('@', $t);

// optional, connect to the internet using IP '127.0.0.1'
$r = stream_context_create(array('socket' => array('bindto' => '127.0.0.1:0')));

// connect to SMTP server (direct) from MX hosts list to port '25' and timeout '10' secounds
// optional, set hostname 'localdomain.net' for EHLO/HELO SMTP dialog
$c = SMTP::mxconnect($h[1], 25, 10, 'smtpcorp.com', $r) or die(print_r($_RESULT));

// send mail and set return-path '$p' in 'MAIL FROM' SMTP dialog
$s = SMTP::send($c, array($t), $m, $p);

// print result
if ($s) echo 'Sent !';
else print_r($_RESULT);

// disconnect
SMTP::disconnect($c);

?>