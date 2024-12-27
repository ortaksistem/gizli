<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$sayfaadi = "haftaninuyeleri";

$islem = $_GET["islem"];

if($islem == "ol"){

    $hafta = date("W");

    $yil = date("Y");

    $result = mysql_query("select durum from "._MX."uye_hafta where uye='$uyeid' and hafta='$hafta' and yil='$yil'");

    // echo mysql_num_rows($result);

    list($warmi, $durum) = mysql_fetch_row($result);


    if($warmi >= 1){
        if($durum == 3) die("red");
        else die("var");
    }

        $uyeadi = uyeadi();
        $cinsiyet = uyebilgi("cinsiyet");
        $sehir = uyebilgi("sehir");
        $dogum = uyebilgi("dogum");
        $img = uyebilgi("img");
        $oncelik = uyebilgi("oncelik");


        if(!$img or $img == "img_uye/avatar/null.jpg"){
                die("bulunamaz");
        }

        $result = mysql_query("insert into "._MX."uye_hafta values(NULL, '$uyeid', '$uyeadi', '$cinsiyet', '$dogum', '$sehir', '$img', '$oncelik', '$hafta', '$yil', '2')");

        if($result) die("ok");
        else die("hata");




} else {
?>
<h1 class="title">Haftanın Üyeleri</h1>

<div class="container-fluid populeruyeler">
    <div class="listeleme text-center">
        <?php
        $limit = 15;

        $p = $_POST["p"];

        if($p == 1 or !$p){
            $where = NULL;
        } else {
            if($p == 11) $where = "cinsiyet=1 and ";
            if($p == 22) $where = "cinsiyet=2 and ";
            if($p == 33) $where = "cinsiyet=3 and ";
        }


        $hafta = date("W");

        $yil = date("Y");

        $result = mysql_query("select uye, uyead, cinsiyet, dogum, sehir, img from "._MX."uye_hafta where ".$where."hafta='$hafta' and yil='$yil' and durum='1' order by cinsiyet asc limit $limit");


        $i = 1;

        while(list($id, $kullanici, $cinsiyet, $dogum, $sehir, $img) = mysql_fetch_row($result)){


            $kullanici = turkcejquery($kullanici);

            $img = uyeavatar($img, $cinsiyet);

            $seviyerenk = "red";
            $seviyead = "Large";

            $yas = (date("Y")-date("Y", $dogum));

            ?>
            <div class="kutu">
                <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><img src="<?=$img?>"></a>
                <?=$seviyead?><br />
                <a href="javascript:void (0)" onclick="$.profil(<?= $id ?>)"><font color="<?=$seviyerenk?>"><?=$kullanici?></font></a><br /><br />
                <?=$yas?> Yaşında<br />
                <?=turkcejquery($sehir)?><br />
            </div>
            <?php
        }
        ?>
    </div>

</div>
<p>&nbsp;</p>
<p class="text-center"><button class="btn btn-default btn-block" onclick="$.haftaninuyesi()">Haftanın Üyesi Ol</button> </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
}