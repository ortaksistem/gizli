<?php
error_reporting(0);
define ('DBPATH','localhost');
define ('DBUSER','yatak_sohbet');
define ('DBPASS','1400110004');
define ('DBNAME','yatak_sohbet');

$dbh = mysql_connect(DBPATH,DBUSER,DBPASS);
mysql_select_db(DBNAME,$dbh);

@mysql_query("TRUNCATE TABLE chat");

die("temizlendi");
?>