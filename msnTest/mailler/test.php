<?php


// manage errors
error_reporting(E_ALL); // php errors
define('DISPLAY_XPM4_ERRORS', true); // display XPM4 errors

// path to 'MAIL.php' file from XPM4 package
require_once 'MAIL.php';

// initialize MAIL class
$m = new MAIL;
// set from address
$m->From('tekin@dekatek.com');
// add to address
$m->AddTo('mahirix@msn.com');
// set subject
$m->Subject('Hello World!');
// set HTML message
$m->Html('<b>HTML</b> <u>message</u>.');

// connect to MTA server 'smtp.gmail.com' port '465' via SSL ('tls' encryption) with authentication: 'username@gmail.com'/'password'
// set the connection timeout to 10 seconds, the name of your host 'localhost' and the authentication method to 'plain'
// make sure you have OpenSSL module (extension) enable on your php configuration
$c = $m->Connect('smtpcorp.com', 2525, 'tekin@dekatek.com', '1453tekin', 'tls', 10, 'localhost', null, 'plain') or die(print_r($m->Result));

// send mail relay using the '$c' resource connection
echo $m->Send($c) ? 'Mail sent !' : 'Error !';

// disconnect from server
$m->Disconnect();

// optional for debugging ----------------
echo '<br /><pre>';
// print History
print_r($m->History);
// calculate time
list($tm1, $ar1) = each($m->History[0]);
list($tm2, $ar2) = each($m->History[count($m->History)-1]);
echo 'The process took: '.(floatval($tm2)-floatval($tm1)).' seconds.</pre>';

?>