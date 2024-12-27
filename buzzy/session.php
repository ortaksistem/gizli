<?php

session_start();

include("fonksiyon.php");

				echo base64_decode($_SESSION[_COOKIE."kullanici"]);
				die("ok");

?>