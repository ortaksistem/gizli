<?php
//olusturulmus resmi tarayiciya gonderir

$pass = $_GET["sifre"];
create_image($pass);
exit(); 

function create_image($pass)
{
    //resmin boyutlarini ayarliyoruz
    $width = 100;
    $height = 20;  

    //resim kaynagini olusturuyoruz
    $image = ImageCreate($width, $height);  

    //Beyaz siyah ve gri renklerini olusturuyoruz
    $white = ImageColorAllocate($image, 255, 255, 255);
    $black = ImageColorAllocate($image, 0, 0, 0);
    $grey = ImageColorAllocate($image, 204, 204, 204); 

    //Zemini siyah yapiyoruz
    ImageFill($image, 0, 0, $black); 

    //Rastgele sayiyi resmin uzerine yaziyoruz
    ImageString($image, 3, 30, 3, $pass, $white); 

    //resme birkac cizgi koyuyoruz
    ImageRectangle($image,0,0,$width-1,$height-1,$grey);

    //sunucuya resmin turunu belirtiyoruz
    header("Content-Type: image/jpeg");  

    //Yeni jpeg formatindaki resmin ciktisini aliyoruz
    ImageJpeg($image); 

    //Kaynagi temizliyoruz
    ImageDestroy($image);
}
?>