<?php


$i = 1;

$open = opendir("img_bot/erkekavatar");

while($read = readdir($open)){
	
	if(strstr($read, "jpg") or strstr($read, "gif") or strstr($read, "png")){
		mysql_query("insert into "._MX."botveritabani values(NULL, '4', 'img_bot/erkekavatar/$read')");
		$i++;
	}

}

echo $i;

?>