<?php
session_start();

$eposta = $_POST["e"];

if($eposta){
	
	if ( filter_var($eposta, FILTER_VALIDATE_EMAIL) ){ 
	   
	   
	   include("../fonksiyon.php");
	   
	   $eposta = suz2($eposta);
	   
	   $result = @mysql_query("select mail from mail where mail='$eposta'");
	   
	   if(@mysql_num_rows($result) >= 1){
			
			die("E-posta adresi sistemimizde kayıtlıdır. Teşekkür ederiz");
	   }
	   else {
		
			@mysql_query("insert into mail values('$eposta', '".@mktime()."')");
			
			die("ok");
	   
	   }
	   
	} else {
	   
	   die("E-posta adresi geçersizdir");
	   
	}

}
else {
	die("E-posta adresi eksik");
}

?>