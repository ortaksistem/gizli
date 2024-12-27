<?php

$islem = $_GET["islem"];

$uyeid = uyeid();

if($islem == "degistir"){

    $eski = $_POST["eski"];
    $yeni = $_POST["yeni"];

    if(!$eski or !$yeni) die("sie");

    $result = @mysql_query("select sifre from "._MX."uye where id='$uyeid'");

    list($sifre) = @mysql_fetch_row($result);

    if(sifrele($eski) == $sifre){

        $yeni = sifrele($yeni);

        $result = @mysql_query("update "._MX."uye set sifre='$yeni' where id='$uyeid'");

        if($result) die("ok");
        else die("hata");

    } else {
        die("eskihatali");
    }


} else {
    ?>
    <form id="formsifredegistir" action="javascript:void (0)">
        <div class="form-group">
            <label>Eski Şifreniz</label>
            <input class="form-control" name="eski" type="password" placeholder="Eski Şifreniz">
        </div>
        <div class="form-group">
            <label>Yeni Şifreniz</label>
            <input class="form-control" name="yeni" type="password" placeholder="Yeni Şifreniz">
        </div>
        <div class="form-group">
            <label>Yeni Şifre (Tekrarı)</label>
            <input class="form-control" name="yeni1" type="password" placeholder="Yeni Şifreniz (Tekrarı)">
        </div>
        <button type="submit" class="btn btn-danger" onclick="$.sifredegistir(1)"><i
                    class="fas fa-share"></i> Şifre Değiştir
        </button>
        <button class="btn btn-danger" onclick="$.popboxkapat()"><i class="fas fa-window-close"></i> Pencereyi Kapat</button>
        <p><span>&nbsp;</span></p>
        <p>&nbsp;</p>
    </form>
    <?php
}