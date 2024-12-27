<?php

echo @mktime();
echo "<br />";
echo date("d.m.Y", @mktime(0,0,0,8,8,2000));
echo "<br />";

?>