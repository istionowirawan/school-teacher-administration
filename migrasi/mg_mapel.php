<?php
require_once("koneksi.php");

$q = "SELECT kode, mapel, tipe, alias FROM sistem_nilai_smp_2013.temp_pelajaran GROUP BY kode";
$query = mysql_query($q,$db1);
while($row = mysql_fetch_array($query)) {	
	
	$q2 = "INSERT INTO nilai_smp.ms_mapel (kode, nama, tipe, aktif)
	VALUES
	('".$row['alias']."',
	'".$row['mapel']."',
	'".$row['tipe']."',
	'1')";
	$query2 = mysql_query($q2,$db2);
	
	if($query2) {
		echo "Sukses<br>";
	} else {
		echo mysql_error();
	}
}

?>