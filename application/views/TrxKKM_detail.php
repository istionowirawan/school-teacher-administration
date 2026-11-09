<?php

echo "<table border='1' class='table table-bordered' >";

echo "<tr align='center' >";
echo "<td rowspan='2' >KI</td>";
echo "<td rowspan='2' width='170' >Kompetensi Inti</td>";
echo "<td rowspan='2' >KD</td>";
echo "<td rowspan='2' width='170' >Kompetensi Dasar</td>";
echo "<td rowspan='2' width='170' >Indikator</td>";
echo "<td rowspan='2' width='60' data-toggle='tooltip' data-placement='top' title='Kompleksitas' >KP</td>";
echo "<td rowspan='2' width='60' data-toggle='tooltip' data-placement='top' title='Daya dukung meliputi kompetensi guru, sarana, fasilitas, biaya, media, dll' >DD</td>";
echo "<td rowspan='2' width='60' data-toggle='tooltip' data-placement='top' title='Tingkat kemampuan Rata-rata Peserta Didik 
(Kelas X dapat didasarkan pada hasil seleksi Penerimaan siswa baru, Nilai UN, Raport kelas 3 SMP, tes seleksi masuk atau Psikotest,
Kelas XII dan XII didasarkan pada tingkat pencapaian KKM peserta didik pada semester atau kelas sebelumnya, keterkaitan
indikator dengan indikator sebelumnya yang telah dicapai oleh peserta didik)' >Intake</td>";
echo "<td colspan='4' >Rata</td>";
echo "</tr>";

echo "<tr align='center'>";
echo "<td>ID</td>";
echo "<td>KD</td>";
echo "<td>KI</td>";
echo "<td>MP</td>";
echo "</tr>";

$idki_awal = -999;
$idkd_awal = -999;
$statKI = false;
$statKD = false;
$statMP = false;

foreach($detail_kkm->result() as $row) {
	echo "<tr>";
	
	if($idki_awal!=$row->id) {
		$idki_awal=$row->id;
		
		echo "<td title='".$row->id."' >".$row->ki."</td>";
		echo "<td>".$row->deskripsi."</td>";
		$statKI=true;
	} else {
		echo "<td></td>";
		echo "<td></td>";
		$statKI=false;
	}
	
	if($idkd_awal!=$row->kd_id) {
		$idkd_awal=$row->kd_id;
		
		echo "<td>".$row->kd."</td>";
		echo "<td>".$row->kd_desc."</td>";
		$statKD=true;
	} else {
		echo "<td></td>";
		echo "<td></td>";
		$statKD=false;
	}
	
	echo "<td>".$row->indi_no . ". " . $row->indi_pencapaian ."</td>";
	echo "<td><input type='number' class='form-control input-sm clsKP' alt='".$row->indi_id."' idkd='".$row->kd_id."' idki='".$row->id."' name='txtKP[]' id='txtKP".$row->indi_id."' ></td>";
	echo "<td><input type='number' class='form-control input-sm clsDD' alt='".$row->indi_id."' idkd='".$row->kd_id."' idki='".$row->id."' name='txtDD[]' id='txtDD".$row->indi_id."' ></td>";
	echo "<td><input type='number' class='form-control input-sm clsIntake' alt='".$row->indi_id."' idkd='".$row->kd_id."' idki='".$row->id."' name='txtIntake[]' id='txtIntake".$row->indi_id."' ></td>";
	
	echo "<td align='center'><label name='txtID[]' title='".$row->kd_id."' class='indi_kd".$row->kd_id."' id='txtID".$row->indi_id."' >0</label></td>";
	
	if($statKD==true) {
		echo "<td align='center'><label name='txtKD[]' title='".$row->kd_id."' class='indi_ki".$row->id."' id='txtKD".$row->kd_id."' >0</label></td>";
	} else {
		echo "<td></td>";
	}
	if($statKI==true) {
		echo "<td align='center'><label name='txtKI[]' title='".$row->id."' class='tot_mp' id='txtKI".$row->id."' >0</label></td>";
	} else {
		echo "<td></td>";
	}
	if($statMP==false) {
		echo "<td align='center'><label name='txtMP' title='".$row->id."' id='txtMP' >0</label></td>";
		$statMP=true;
	} else {
		echo "<td></td>";
	}
	echo "</tr>";
}

echo "</table>";
?>

<script>
$(".clsKP, .clsDD, .clsIntake").change(function() {
	var idindi = $(this).attr("alt");
	var idkd = $(this).attr("idkd");
	var idki = $(this).attr("idki");
	
	var jml = 0;
	jml += Number($("#txtKP"+idindi).val()); 
	jml += Number($("#txtDD"+idindi).val());
	jml += Number($("#txtIntake"+idindi).val());
	jml = Math.round(jml/3);
	
	$("#txtID"+idindi).text(jml);
	
	cek_perhitungan_kd(idkd);
	cek_perhitungan_ki(idki);
	cek_perhitungan_mp();
});

function cek_perhitungan_kd(idkd) {
	var jml = 0;
	var banyak = 0;
	$('.indi_kd'+idkd).each(function(){
		jml += parseFloat($(this).text());
		banyak+=1;
	});
	jml = Math.round(jml/banyak);
	$("#txtKD"+idkd).text(jml);
}

function cek_perhitungan_ki(idki) {
	var jml = 0;
	var banyak = 0;
	$('.indi_ki'+idki).each(function(){
		jml += parseFloat($(this).text());
		banyak+=1;
	});
	jml = Math.round(jml/banyak);
	$("#txtKI"+idki).text(jml);
}

function cek_perhitungan_mp() {
	var jml = 0;
	var banyak = 0;
	$('.tot_mp').each(function(){
		jml += parseFloat($(this).text());
		banyak+=1;
	});
	jml = Math.round(jml/banyak);
	$("#txtMP").text(jml);
}
</script>