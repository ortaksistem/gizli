<?php

function mobiltarihdon($data){

    list($gun, $ay, $yil) = explode(",", date("d,m,Y", $data));

    $aylar = array("0", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");

    if(strstr($ay, "0")) $ay = str_replace("0", "", $ay);

    $ay = $aylar[$ay];

    return "$gun $ay $yil";
}