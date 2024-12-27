<?php

$uye = $_POST["uye"];
$uyeid = $_POST["uyeid"];

?>
<form id="formmesajgonder" action="javascript:void (0)">
    <div class="form-group">
        <label>Konu</label>
        <input class="form-control" name="konu" placeholder="Mesajın konusu">
    </div>
    <div class="form-group">
        <label>Mesaj</label>
        <textarea class="form-control" name="mesaj" placeholder="Mesajın İçeriği"></textarea>
    </div>
    <button type="submit" class="btn btn-danger" onclick="$.mesajgonder(<?=$uye?>, <?=$uyeid?>)"><i class="fas fa-envelope"></i> Mesajı Gönder</button>
    <button class="btn btn-danger" onclick="$.popboxkapat()"><i class="fas fa-window-close"></i> Pencereyi Kapat</button>
    <span>&nbsp;</span>
    <p>&nbsp;</p>
</form>