<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");

?>
<h1 class="title">Resim Yükle</h1>

<br><p><span style="font-size: 11pt;">Lütfen size ait olmayan, sadece göz ve benzeri eklemeyin.
    Porno sitelerinden alınma, çiçek, böcek, araba, manzara,
    birbirine benzer resimler kısaca sizin kendi fotoğrafınız
    olmayan resimleri eklemeyiniz.</span></p>

<p><span style="font-size: 11pt;">Sadece çiftler ve bayanlar partnerleri ile birlikte olarak
    resim gönderebilirler. Erkek üyelerimiz partnerleri ile olan
    resimleri gönderemez, gönderilse dahi onay almadan
    silinecektir.</span></p>
<p><span style="font-size: 11pt;">

Teşekkür Ederiz.<br />
    Site Yönetimi</span></p>

<div class="container-fluid resimyukle">
    <?php
    $avatar = uyebilgi("img");
    $cinsiyet = uyebilgi("cinsiyet");

    $avatar = uyeavatar($avatar, $cinsiyet);

    ?>
    <div class="resim"><img src="<?=$avatar?>"></div>
    <div class="yazi">
        - Çiçek böcek kalp vs gibi resimler<br />
        - Pornografik resimler<br />
        - 1MB üzeri resimler kabul edilmez.
    </div>
    <div class="yukle">
        <form action="javascript:void(0)" id="resimyukle" enctype="multipart/form-data">
            <div class="yukledosya"><input type="file" class="form-control" name="resim" accept="image/*"></div>
            <div class="yuklebuton yuklebuton2">
                <button class="btn btn-danger" onclick="$.resimyukle()"><i class="fas fa-camera"></i> &nbsp;Resmi Yükle</button>
            </div>
        </form>
    </div>

</div>
<h2 class="title title2">Resimler</h2>
<div class="resimyukle2 text-center">

    <?php

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
            <button class="btn siyah" onclick="$.resimsil(<?=$id?>, 0)"><i class="fa fa-trash-alt"></i> Resmi Sil</button>
            <?=$durum?>
        </div>
    <?php



    } // end while
    ?>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>