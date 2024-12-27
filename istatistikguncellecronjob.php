<?php

include("ayarlar.php");
include("fonksiyon.php");

list($gun, $ay, $yil) = explode("-", date("d-m-Y"));

@mysql_query("insert into "._MX."istatistik values('1', '$gun', '$ay', '$yil')");

die("ok");


?>