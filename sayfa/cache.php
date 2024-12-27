<?php

/*
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
++ 																++
++	Script Coder	:	MahiriX									++
++	Mail			:	mahirix@msn.com							++
++	Web				:	http://www.mahirix.net					++
++	Copyright		:	Lisanssýz kullananýn ebesine			++
++																++
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
*/

// ftp cache süresi

$ftp_cache = 5; // dakika cinsinden

function cache_baslat(){
	global $ftp_cache;


	$filename = "".md5($_SERVER['REQUEST_URI']).".html";

	$cachefile = "cache/".$filename;

	define("_CACHEDOSYASI", $cachefile);
	
	$zaman = 60 * $ftp_cache;

	$cachetime = $zaman;

	if (file_exists($cachefile))

	{

	if(time() - $cachetime < filemtime($cachefile))

	{

	readfile($cachefile);

	exit;

	}

	else

	{

	unlink($cachefile);

	}

	}

	ob_start();

	//Ftp Cache	

}


function cache_bitir(){

		$fp = fopen(_CACHEDOSYASI, 'w+');

		fwrite($fp, ob_get_contents());

		fclose($fp);

		ob_end_flush();
		
}
	
?>