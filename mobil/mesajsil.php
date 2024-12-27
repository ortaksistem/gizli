<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$islem = $_POST["islem"];

if(!$islem) die("nereye");

$id = $_POST["mesaj"];

list($gonderen, $gonderilen) = @mysql_fetch_row(@mysql_query("select gonderen, gonderilen from "._MX."uye_mesaj where id='$id'"));

if($gonderilen != $uyeid) die("hata");

$result = @mysql_query("update "._MX."uye_mesaj set masaustusil='1', gonderilensil='1' where gonderen='$gonderen' and gonderilen='$gonderilen'");

$result = @mysql_query("update "._MX."uye_mesaj set gonderensil='1' where gonderen='$gonderilen' and gonderilen='$gonderen'");

die("ok");