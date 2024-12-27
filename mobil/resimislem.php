<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

$islem = $_GET["islem"];

if(!$islem) die("he he amk");

if($islem == "anaresim"){

    $id = $_POST["id"];

    mysql_query("update "._MX."uye_resim set ana='0' where uye='$uyeid'");

    list($resimurl, $durum) = mysql_fetch_row(mysql_query("select resim, durum from "._MX."uye_resim where id='$id' and uye='$uyeid'"));

    if($durum == 1){

        $uzanti = explode(".", $resimurl);

        $uzanti = $uzanti[1];


        $resimurl = str_replace("resim/", "resimthumb/", $resimurl);

        @copy($resimurl, "img_uye/avatar/$uyeid.$uzanti");

        mysql_query("update "._MX."uye set img='img_uye/avatar/$uyeid.$uzanti' where id='$uyeid'");

        mysql_query("update "._MX."uye_resim set ana='1' where id='$id'");

    }

}

if($islem == "guncelle"){

    $result = mysql_query("select id, resim, ana, durum from "._MX."uye_resim where uye='$uyeid'");

    $i = 1;

    while(list($id, $resim, $ana, $durum) = mysql_fetch_row($result)) {

        $resimthumb = str_replace("resim/", "resimthumb/", $resim);

        if($ana == 1){
            $anaresim = '<button class="btn btn-danger"><i class="fa fa-book"></i> Ana Resminiz</button>';
        } else {
            $anaresim = '<button class="btn btn-danger" onclick="$.resimanaresim('.$id.', '.$durum.')"><i class="fa fa-book-medical"></i> Ana Resim Yap</button>';
        }

        if ($durum == 1) {
            $durum = '<button class="btn btn-success"><i class="fa fa-check-double"></i> Onaylandı</button>';
        } else {
            $durum = '<button class="btn btn-danger"><i class="fa fa-check"></i> Onay Bekliyor</button>';
        }

        ?>
        <div class="kutu" style="height: 200px;" id="resim<?=$id?>">
            <img src="<?=$resimthumb?>">
            <?=$anaresim?>
            <button class="btn siyah" onclick="$.resimsil(<?=$id?>)"><i class="fa fa-trash-alt"></i> Resmi Sil</button>
            <?=$durum?>
        </div>
        <?php



    } // end while
?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
<?php
    die();
}