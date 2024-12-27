<?php

define("_AD", "mahir");

$admin = "mahirix@msn.com";

				$subject="Yeni mail alindi";
				$message = "
				<style type=\"text/css\">
				.style2 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 12px;}
				</style>
				</head>
				<body>
				<p class=\"style2\">Gonderen : mail Attim,</p>
				<p class=\"style2\">Tarih : ".date("d.m.Y")."</p>
				</body>
				</html>";
				$headers = "From: "._AD." <"._AD.">\n";
				$headers .= "X-Sender: <".$admin.">\n";
				$headers .= "X-Mailer: PHP\n"; //mailer
				$headers .= "X-Priority: 3\n"; //1 UrgentMessage, 3 Normal
				$headers .= "Return-Path: <".$admin.">\n";
				$headers .= "Content-Type: text/html; charset=iso-8859-9\n";
				mail($admin, $subject, $message, $headers);
	
				die("ok");
				
?>