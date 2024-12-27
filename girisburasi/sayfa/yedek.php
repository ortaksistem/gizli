<?php

$islem = $_GET["islem"];

function DBMakeBackup($host,$port,$user,$pwd,$dbname)	{ // yazandan allah razý olsun :))
ini_set("max_execution_time",0);
$i		= 0;
$crlf	= "\r\n";
$schema_insert	= "";
$host	= (!$host)		? "localhost"	: $host;
$port	= (!$port)		? "3306"		: $port;
$user	= (!$user)		? "root"		: $user;
$dbname	= (!$dbname)	? die("No Database specified")		: $dbname;
$password	= ($pwd == "")	? "NO" : "YES";
@mysql_pconnect($host.":".$port, $user, $pwd) or die("Can't connect to ".$host.":".$port." (using password: ".$password.") ");
@mysql_select_db($dbname) or die ("Unable to select database");
$tables			= mysql_list_tables($dbname);
$num_tables		= @mysql_numrows($tables);
$Year		= date("Y");
$Month		= date("m");
$Day		= date("d");
$lang		= $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$country	= StrToUpper($lang);
$loc	= array("".$lang."_".$country."@euro","".$lang."_".$country."","".$lang."","".$country."");
foreach ($loc as $GetRightLocale)	{
	If (setlocale(LC_TIME,$GetRightLocale)) {		//	Found a Valid SetLocale
		break;
	}
}
###	Search and Replace \n \r in the INSERT Statement	###
###	for each records									###
$search       = array("\x00", "\x0a", "\x0d", "\x1a"); //\x08\\x09, not required
$replace      = array('\0', '\n', '\r', '\Z');

$DataCreation	= strftime("%d %B %Y", @mktime());
$Time			= date("H:i:s");
###	Save to Server	###
	$content	= "";
	$content	.= $crlf;
	$content	.= "# --------------------------------------------------------".$crlf."";
	$content	.= "#".$crlf."";
	$content	.= "# Yedeklenen Veritabani '".$dbname."' ".$crlf."";
	$content	.= "#".$crlf."";
	$content	.= "# Host: ".$host."".$crlf."";
	$content	.= "#".$crlf."";
	$content	.= "# Yedek Tarihi ".$DataCreation." at ".$Time."".$crlf."";
	$content	.= "#".$crlf."";
	$content	.= $crlf;
	$content	.= "# --------------------------------------------------------".$crlf."";
	while($i < $num_tables)	{
		$table	= mysql_tablename($tables, $i);
		$content	.= $crlf;
		$content	.= "# --------------------------------------------------------".$crlf."";
		$content	.= "#".$crlf."";
		$content	.= "# Tablo '".$table."' ".$crlf."";
		$content	.= "#".$crlf."";
		$content	.= $crlf;
		#################################################
		#	Build Table Structure			#
		#################################################
		/*	Table Structure	*/
		$schema_create = "";
		$schema_create .= "DROP TABLE IF EXISTS `".$table."`;".$crlf;
		$schema_create .= "CREATE TABLE `".$table."` (".$crlf;
		$result			= mysql_db_query($dbname, "SHOW FIELDS FROM `".$table."`") or die("error select database");
		while($row = mysql_fetch_array($result))	{
			$schema_create .= "   `$row[Field]` $row[Type]";
			$schema_create .= ($row["Null"] != "YES")	? " NOT NULL" : "";
			$schema_create .= (isset($row["Default"]) && (!empty($row["Default"]) || $row["Default"] == "0"))
							? " default '$row[Default]'" : "";
			$schema_create .= ($row["Extra"] != "")		? " ".$row["Extra"] : "";
			$schema_create .= ",".$crlf;
		}
		$schema_create		= ereg_replace(",".$crlf."$", "", $schema_create);
		/*	Table Keys	*/
		$index		= array();
		$result		= mysql_db_query($dbname, "SHOW KEYS FROM `".$table."`") or die();
		while($row = mysql_fetch_array($result))	{
			if($row['Key_name'] == "PRIMARY")
				$kname			= "PRIMARY KEY";
			elseif($row['Non_unique'] == 0)
				$kname			= "UNIQUE `".$row['Key_name']."`";
			else
				$kname			= "KEY `".$row['Key_name']."`";
			if(!isset($index[$kname]))
				$index[$kname] = array();
			$index[$kname][]	= "`".$row['Column_name']."`".(isset($row['Sub_part']) ? "(".$row['Sub_part'].")" : "");
		}
		foreach($index as $x => $columns)	{
			$schema_create .= ",".$crlf;
			$schema_create .= "   ".$x." (" . implode($columns, ", ") . ")";
		}
		$schema_create .= $crlf.") ";

		#	DataBase Type								#
		$result		= mysql_db_query($dbname, "SHOW TABLE STATUS FROM ".$dbname." LIKE '".$table."'") or die();
		$row		= mysql_fetch_array($result);
		$schema_create	.= "Type=".$row['Type'];
		$schema_create	.= (!empty($row['Auto_increment']) ? " AUTO_INCREMENT=".$row['Auto_increment'] : "");
		$schema_create	.= ";".$crlf.$crlf;
		$content	.= $schema_create;
		$schema_create	= "";
		#################################################
		#	Build Table Content (INSERT)		#
		#################################################
		$content	.= "#".$crlf."";
		$content	.= "# Tablo Icerigi '".$table."'".$crlf."";
		$content	.= "#$crlf";
		$content	.= $crlf;
		$result = mysql_db_query($dbname, "SELECT * FROM `$table`") or die();
		$a		= 0;
		while($row = mysql_fetch_row($result))	{
			$table_list = "(";
			for($j=0; $j<mysql_num_fields($result); $j++)
				$table_list .= "`".mysql_field_name($result,$j)."`, ";
				$table_list = substr($table_list,0,-2);
				$table_list .= ")";
			if(isset($GLOBALS["showcolumns"]))
				$schema_insert .= "INSERT INTO `".$table."` ".$table_list." VALUES (";
			else
				$schema_insert .= "INSERT INTO `".$table."` VALUES (";
			for($j=0; $j<mysql_num_fields($result); $j++)	{
				if(!isset($row[$j]))
					$schema_insert .= " NULL,";
				elseif($row[$j] != "")
					$schema_insert .= " '".Str_Replace($search,$replace,addslashes($row[$j]))."',";
				else
					$schema_insert .= " '',";
			}
			$schema_insert = ereg_replace(",$", "", $schema_insert);
			$schema_insert .= ");".$crlf;
			//$handler(trim($schema_insert));
			$a++;
		}
		$content	.= $schema_insert."".$crlf."";
		$schema_insert	= "";
		$i++;
	}
	##	Open file for writing	##
	$filename ='yedek/backup_'.$dbname.'-'.date("Y-m-d#H_m_s").'.gz';
	$gz = gzopen($filename,'w9');
	gzwrite($gz, $content);
	gzclose($gz);
	return $filename;
} 

if($islem == "mahirix"){

	global $host, $user, $sifre, $database;
	
	$file = DBMakeBackup($host,3306,$user,$sifre,$database);
	$size = filesize($file);
	$size = round($size / 1024);
	if($file){
		echo "<p align=left>Veritabani Yedekleme Tamamlandi..<br><br>"
		."Dosya : $file <br><br>"
		."Boyut : $size Kb<br><br>";
	}
		

}
else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Veritabaný Yedekle | <? echo _AD; ?></title>
	<meta http-equiv="Content-Language" content="tr">
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-9" />
	<style media="all" type="text/css">@import "css/all.css";</style>
	<script type="text/javascript" src="../inc/jquery.js"></script>
	<script type="text/javascript" src="../inc/mahirix.js"></script>
<script type="text/javascript">

	function yedek(){
		
		$("#sonuc").html("<img src='img/loading.gif' /> Bekleyin ...");
		
		jQuery.ajax({
			type: 'POST',
			url: 'index.php?sayfa=yedek&islem=mahirix',
			data: 'gonder=tamam',
			success: function(sonuc){
				$("#sonuc").html(sonuc);
			}
		
		})
	
	}
</script>
</head>
<body>
<div id="main">
	<div id="header">
<? include("menu/bakim.php"); ?>
		<div id="center-column">
		<form action="javascript:void(0)" method="post">
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full">Veritabaný Yedeðini Oluþtur</th>
					</tr>
					<tr>
						<td class="last"><input type="submit" value=" Veritabanýný Yedekle " onclick="yedek()" /> * Yedek yonetim klasöründeki yedek isimli klasöre kaydedilmektedir. <p><span id="sonuc"></span></p></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</form>
		</div>
		<div id="right-column">
			<strong class="h">Bilgi</strong>
			<div class="box">Bu alandan tablolarý optimize edebilirsiniz.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
<?php
}
?>