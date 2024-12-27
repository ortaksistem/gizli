<?php

@mysql_query("SET NAMES latin1");
$uyeid = uyeid();

if(!is_numeric($uyeid)) header("Location: index.php");


?>
<h1 class="title">Mesaj Yaz</h1>
<div class="container-fluid">
<form id="formmesajgonder" action="javascript:void (0)">
    <div class="form-group">
        <label>Kime</label>
        <select name="uye" class="form-control">
            <option value="">Seçim Yapın</option>
            <?php
            $result = mysql_query("select uye, uyead, arkadas, arkadasad from "._MX."uye_arkadas where (uye='$uyeid' or arkadas='$uyeid') and durum='1'");
            while(list($arkadas, $arkadasad, $arkadas1, $arkadasad1) = mysql_fetch_row($result)){

                if($arkadas == $uyeid){

                    echo "<option value=$arkadas1>$arkadasad1</option>";
                }
                else {
                    echo "<option value=$arkadas>$arkadasad</option>";
                }

            }


            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Konu</label>
        <input class="form-control" name="konu" placeholder="Mesajın konusu">
    </div>
    <div class="form-group">
        <label>Mesaj</label>
        <textarea class="form-control" name="mesaj" placeholder="Mesajın İçeriği"></textarea>
    </div>
    <?php

    if(seviyeal("mesaj") == 1) {

        ?>
        <button type="submit" class="btn btn-danger" onclick="$.mesajgonder3(<?= $uyeid ?>)"><i class="fas fa-envelope"></i> Mesajı Gönder</button>
        <span>&nbsp;</span>
        <?php
    } else {
        ?>
        <p class="text-center">Mesaj gönderebilmek için üyelik yükseltmeniz gerekmektedir.
            Üyelik yükseltmek için <a href="javascript:void(0)" onclick="$.yukle('uyelikyukselt', 1)" style="color:red">TIKLAYINIZ.</a>
        </p>
    <?php
    }

    ?>
    <p>&nbsp;</p>
</form>
</div>