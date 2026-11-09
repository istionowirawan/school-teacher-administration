<?php
$db1 = mysql_connect("localhost","root","pahoa");
$db2 = mysql_connect("localhost","root","pahoa");

mysql_select_db("sistem_nilai_smp_2013",$db1);
mysql_select_db("nilai_smp",$db2);
?>