<?php
@session_start();
include("../ayarlar.php");
include("../fonksiyon.php");

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) die("Olmaz böyle şey");


$neresi = $_GET["neresi"];

if(!$neresi) die("Hata olmalı galiba");


if($neresi == "kisiselbilgiler"){

    $ad = $_POST["ad"];
    $soyad = $_POST["soyad"];
    $d1 = $_POST["d1"];
    $d2 = $_POST["d2"];
    $d3 = $_POST["d3"];
    $no1 = $_POST["no1"];
    $no2 = $_POST["no2"];
    $sehir = $_POST["sehir"];
    $ulke = $_POST["ulke"];

    if($d1 and $d2 and $d3 and $sehir and $ulke){

        $ad = strip_tags(addslashes($ad));
        $soyad = strip_tags(addslashes($soyad));
        $no1 = strip_tags(addslashes($no1));
        $no2 = strip_tags(addslashes($no2));

        $ad = turkce($ad);
        $soyad = turkce($soyad);
        $sehir = turkce($sehir);
        $ulke = turkce($ulke);

        $dogum = @mktime(0,0,0, $d2, $d1, $d3);

        $no = $no1 ."-". $no2;

        $result = mysql_query("update "._MX."uye set ad='$ad', soyad='$soyad', tel='$no', dogum='$dogum', ulke='$ulke', sehir='$sehir' where id='$uyeid'");

        if($result) die("ok");
        else die("hata");



    }
    else {
        die("bos");
    }

}

if($neresi == "tanitimyazisi"){

    $tanitim = trim($_POST["tanitim"]);

    if($tanitim){

        $tanitim = suz(turkce($tanitim));

        $result = mysql_query("update "._MX."uye set tanitim='$tanitim', tanitimonay='2' where id='$uyeid'");

        if($result) die("ok");
        else die("hata");
    }
    else die("bos");
}

if($neresi == "ilgialanlari"){

    $tipler = $_POST["tipler"];
    $tipler = turkce($tipler);
    if($tipler)	foreach($tipler as $t) $tipler2 .= $t .";";

    $filmler = $_POST["filmler"];
    $filmler = turkce($filmler);
    if($filmler) foreach($filmler as $f) $filmler2 .= $f .";";

    $hobiler = $_POST["hobiler"];
    $hobiler = turkce($hobiler);
    if($hobiler) foreach($hobiler as $h) $hobiler2 .= $h .";";

    $begeniler = $_POST["begeniler"];
    $begeniler = turkce($begeniler);
    if($begeniler) foreach($begeniler as $b) $begeniler2 .= $b .";";


	$result = mysql_query("update "._MX."uye set hobiler='$hobiler2', begeniler='$begeniler2', filmler='$filmler2', tipler='$tipler2', tanitim='$tanitim' where id='$uyeid'");

    if($result) die("ok");
    else die("hata");

}

if($neresi == "profilbilgileri"){

    $cinsiyet = uyebilgi("cinsiyet");

    $medenidurum = $_POST["medenidurum"];
    $kiminle = $_POST["kiminle"];
    $webcam = $_POST["webcam"];
    $webcamsohbet = $_POST["webcamsohbet"];
    $boy = $_POST["boy"];
    $kilo = $_POST["kilo"];
    $goz = $_POST["goz"];
    $vucut = $_POST["vucut"];
    $sac = $_POST["sac"];
    $deneyim = $_POST["deneyim"];
    $egitim = $_POST["egitim"];
    $calisma = $_POST["calisma"];
    $meslek = $_POST["meslek"];
    $bakim = $_POST["bakim"];


    $medenidurum = turkce(suz($medenidurum));
    $kiminle = turkce(suz($kiminle));
    $webcam = turkce(suz($webcam));
    $webcamsohbet = turkce(suz($webcamsohbet));
    $boy = turkce(suz($boy));
    $kilo = turkce(suz($kilo));
    $goz = turkce(suz($goz));
    $vucut = turkce(suz($vucut));
    $sac = turkce(suz($sac));
    $deneyim = turkce(suz($deneyim));
    $egitim = turkce(suz($egitim));
    $calisma = turkce(suz($calisma));
    $meslek = turkce(suz($meslek));
    $bakim = turkce(suz($bakim));


    $karakter = turkce($_POST["karakter"]);
    if($karakter){
        foreach($karakter as $k){
            $karakter2 .= $k .";";
        }
    }

    $iliski = turkce($_POST["iliski"]);
    if($iliski){
        foreach($iliski as $i){
            $iliski2 .= $i .";";
        }
    }

    $aracinsiyet = turkce($_POST["aracinsiyet"]);
    if($aracinsiyet){
        foreach($aracinsiyet as $arac){
            $aracinsiyet2 .= $arac .";";
        }
    }

        if($cinsiyet == 2){

            $boyes = turkce($_POST["boyes"]);
            $kiloes = turkce($_POST["kiloes"]);
            $saces = turkce($_POST["saces"]);
            $gozes = turkce($_POST["gozes"]);
            $vucutes = turkce($_POST["vucutes"]);
            $deneyimes = turkce($_POST["deneyimes"]);
            $bakimes = turkce($_POST["bakimes"]);

            $boyes = suz($boyes);
            $kiloes = suz($kiloes);
            $saces = suz($saces);
            $gozes = suz($gozes);
            $vucutes = suz($vucutes);
            $deneyimes = suz($deneyimes);
            $bakimes = suz($bakimes);



            $boy = $boy ."::". $boyes;
            $kilo = $kilo ."::". $kiloes;
            $sac = $sac ."::". $saces;
            $goz = $goz ."::". $gozes;
            $vucut = $vucut ."::". $vucutes;
            $deneyim = $deneyim ."::". $deneyimes;
            $bakim = $bakim ."::". $bakimes;

        }

    $result = mysql_query("update "._MX."uye set medenidurum='$medenidurum', kiminle='$kiminle', webcam='$webcam', webcamsohbet='$webcamsohbet', boy='$boy', kilo='$kilo', goz='$goz', vucut='$vucut', sac='$sac', bakim='$bakim', deneyim='$deneyim', egitim='$egitim', calisma='$calisma', meslek='$meslek', karakter='$karakter2', iliski='$iliski2', aracinsiyet='$aracinsiyet2' where id='$uyeid'");

    if($result) die("ok");
    else die("hata");


}