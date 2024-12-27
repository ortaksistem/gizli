<?php

$uye = $_POST["uye"];
$uyeid = $_POST["uyeid"];

?>
<form id="formsikayetet" action="javascript:void (0)">
    <div class="form-group">
        <label>Şikayet Konusu</label>
        <input class="form-control" name="konu" placeholder="Şikayet konusu">
    </div>
    <div class="form-group">
        <label>Şikayet Mesajı</label>
        <textarea class="form-control" name="mesaj" placeholder="Şikayet Mesajı"></textarea>
    </div>
    <button type="submit" class="btn btn-danger" onclick="$.sikayetetgonder(<?=$uye?>, <?=$uyeid?>)"><i class="fas fa-share"></i> Şikayeti Gönder</button>
    <button class="btn btn-danger" onclick="$.popboxkapat()"><i class="fas fa-window-close"></i> Pencereyi Kapat</button>
    <span>&nbsp;</span>
    <p>&nbsp;</p>
</form>