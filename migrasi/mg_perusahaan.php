<?php
require_once("koneksi.php");

$q = "SELECT * FROM dalnetv3.perusahaan";
$query = mysql_query($q,$db1);
while($row = mysql_fetch_array($query)) {	
	
	$q2 = "INSERT INTO dalnet.ms_perusahaan (id, no_pelanggan, nomor_po, nama_perusahaan, npwp, alamat_npwp, tanggal_aktif, 
	alamat, produk, harga_produk, telp, email, contact, billing, sales, tipe_tarif, materai, ttd_invoice, user_input, date_input)
	VALUES
	('".$row['kodeperusahaan']."',
	'".$row['nomor']."',
	'',
	'".$row['nama']."',
	'".$row['npwp']."',
	'".$row['alamat_npwp']."',
	'".$row['tgl_aktif_ymd']."',
	'".$row['alamat']."',
	'',
	'',
	'".$row['telepon']."',
	'".$row['email']."',
	'".$row['cp']."',
	'',
	'".$row['sales']."',
	'".$row['tipetarif']."',
	'".$row['materai']."',
	'".$row['ttd_invoice']."',
	'migration',
	now()
	)
	";
	$query2 = mysql_query($q2,$db2);
	
	if($query2) {
		echo "Sukses<br>";
	} else {
		echo mysql_error();
	}
}

?>