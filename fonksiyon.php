<?php

// UTF-8 karakter setini tanımla
header('Content-Type: text/html; charset=utf-8');

// Veritabanı bağlantısı için mysqli kullanımı
$servername = "localhost";
$username = "gizlicom_arkadas";
$password = "Dali.1978";
$dbname = "gizlicom_arkadas";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}

// POST ve GET verilerini al
foreach($_POST as $key => $value) {
    ${$key} = $value;
}
foreach($_GET as $key => $value) {
    ${$key} = $value;
}

// Fonksiyonlar

function suz($param, $conn) {
    return mysqli_real_escape_string($conn, $param);
}

function ayar($param, $conn) {
    $result = mysqli_query($conn, "SELECT $param FROM "._MX."ayarlar");
    $row = mysqli_fetch_array($result);
    return $row[$param];
}

function seviye($seviye, $param, $conn) {
    if (!$seviye) {
        list($seviye) = mysqli_fetch_row(mysqli_query($conn, "SELECT seviye FROM "._MX."ayarlar"));
    }
    $result = mysqli_query($conn, "SELECT $param FROM "._MX."seviye WHERE id='$seviye'");
    list($param) = mysqli_fetch_row($result);
    return $param;
}

function sifrele($param) {
    return $param; // Şifreleme işlevini buraya ekleyebilirsiniz
}

function cinsiyet($param) {
    $cinsiyet = array("", "Bayan", "Çift", "Erkek");
    if ($param) {
        return $cinsiyet[$param];
    } else {
        $sayi = count($cinsiyet);
        for ($i = 1; $i < $sayi; $i++) {
            echo "<option value=\"$i\">$cinsiyet[$i]</option>";
        }
    }
}

function turkce($string) {
    return iconv("ISO-8859-9", "UTF-8", $string);
}

function turkcejquery($param) {
    $turkce_karakterler = array(
        "Ç" => "&#199;", "ç" => "&#231;",
        "İ" => "&#304;", "ı" => "&#305;",
        "Ğ" => "&#286;", "ğ" => "&#287;",
        "Ö" => "&#214;", "ö" => "&#246;",
        "Ü" => "&#220;", "ü" => "&#252;",
        "Ş" => "&#350;", "ş" => "&#351;"
    );

    foreach ($turkce_karakterler as $key => $value) {
        $param = str_replace($key, $value, $param);
    }
    return $param;
}

function uyeid() {
    $data = $_SESSION[_COOKIE];
    if ($data) {
        $data = base64_decode($data);
        list($id, $kullanici, $sifre) = explode(";;;", $data);
        return $id;
    } else {
        return false;
    }
}

function uyeadi() {
    $data = $_SESSION[_COOKIE];
    if ($data) {
        $data = base64_decode($data);
        list($id, $kullanici, $sifre) = explode(";;;", $data);
        return $kullanici;
    } else {
        return false;
    }
}

function uyebilgi($param, $conn) {
    $data = $_SESSION[_COOKIE];
    if ($data) {
        $data = base64_decode($data);
        $data = explode(";;;", $data);

        if ($param == "cinsiyet") {
            return $data[3];
        } elseif ($param == "dogum") {
            return $data[4];
        } elseif ($param == "sehir") {
            return $data[5];
        } elseif ($param == "avatar") {
            return $data[6];
        } else {
            $uyeid = $data[0];
            $result = mysqli_query($conn, "SELECT $param FROM "._MX."uye WHERE id='$uyeid'");
            list($param) = mysqli_fetch_row($result);
            return $param;
        }
    } else {
        return false;
    }
}

function uyeavatar($avatar, $cinsiyet) {
    if (!$avatar || $avatar == 'img_uye/avatar/null.jpg') {
        $avatar = "img_uye/$cinsiyet.gif";
    }
    return $avatar;
}

function seviyeal($param) {
    $data = $_SESSION[_COOKIE."seviye"];
    if ($data) {
        preg_match('#!'.$param.'=(.*?)&#si', $data, $seviye);
        if ($seviye[1]) {
            return $seviye[1];
        } else {
            return 0;
        }
    } else {
        return false;
    }
}

function tarihdon($data) {
    list($gun, $ay, $yil) = explode(",", date("d,m,Y", $data));
    $aylar = array("0", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");
    if (strstr($ay, "0")) $ay = str_replace("0", "", $ay);
    $ay = $aylar[$ay];
    return "$gun $ay $yil";
}

function begeniler($param, $param2) {
    $begeniler = array("", "Dudaklarına Hayranım", "Çok yakışıklı", "Gözlerine hayranım", "Fiziğine hayranım", "Kalçalarına hayranım", "Göğüslerine hayranım", "Her şeyine hayranım", "Çok güzel", "Çok seksi", "Çok karizmatik", "Çok sempatik", "Çok uyumlu çift", "Çok güzel çift", "Güzel bacaklar", "Güzel ayaklar");

    if ($param2 == "say") {
        return count($begeniler);
    } else {
        if ($param) {
            return $begeniler[$param];
        } else {
            $sayi = count($begeniler);
            for ($i = 1; $i < $sayi; $i++) {
                echo "<option value=\"$i\">$begeniler[$i]</option>";
            }
        }
    }
}

function mobilcihazmi() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function yonlendir($u) {
    echo "<script language=javascript>location='$u'</script>";
}

?>
