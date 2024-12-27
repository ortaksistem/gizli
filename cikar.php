<?php

include("ayarlar.php");


$result = mysql_query("select id, uye, kayit from "._MX."odeme2 where tutar='69'");


while(list($id, $uye, $kayit) = mysql_fetch_row($result)){

	$kayit = date("d.m.Y", $kayit);
	
	echo "$id $uye $kayit <br />";

}

?>