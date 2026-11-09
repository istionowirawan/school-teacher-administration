<?php
echo "<div class='table-responsive'>";
echo "<table class='table table-bordered table-striped table-hover' >";

echo "<tr class='info' align='center' >";
echo "<td rowspan='2' >No.KI</td>";
echo "<td rowspan='2' >Kompetensi Inti</td>";
echo "<td rowspan='2' >Jumlah KD</td>";
echo "<td rowspan='2' >Semester</td>";
echo "<td colspan='2' >Jumlah Tatap Muka</td>";
echo "</tr>";

echo "<tr class='info' align='center' >";
echo "<td>Semester1</td>";
echo "<td>Semester2</td>";
echo "</tr>";

$jmlKD = 0;
foreach($detail_prota->result() as $row) {
	echo "<tr>";
	echo "<td align='center' title='".$row->id."' >";
		echo $row->ki;
		echo "<input type='hidden' name='txtKi[]' value='".$row->id."' >";
	echo "</td>";
	echo "<td>".$row->deskripsi."</td>";
	echo "<td align='center' >".$row->jml_kd."</td>";
	echo "<td align='center' >".$row->semester."</td>";
	
	if($row->semester==1) {
		echo "<td><input type='number' class='input-sm clsInputProta1' value='".$row->tm_sm1."' name='txtHitungSm1[]' onChange='hitung_sm1()' ></td>";
		echo "<td align='center' >0<input type='hidden' value='".$row->tm_sm2."' name='txtHitungSm2[]' ></td>";
	} else {
		echo "<td align='center' >0<input type='hidden' value='".$row->tm_sm1."' name='txtHitungSm1[]' ></td>";
		echo "<td><input type='number' class='input-sm clsInputProta2' value='".$row->tm_sm2."' name='txtHitungSm2[]' onChange='hitung_sm2()' ></td>";
	}
	echo "</tr>";
	
	$jmlKD += $row->jml_kd;
}

echo "<tr align='center' >";
echo "<td colspan='2' >Jumlah KD dan Tatap Muka</td>";
echo "<td>".$jmlKD."</td>";
echo "<td></td>";
echo "<td id='lblJmlSm1' ></td>";
echo "<td id='lblJmlSm2' >0</td>";
echo "</tr>";

echo "</table>";
echo "</div>";
?>

<script>

hitung_sm1();
function hitung_sm1() {
	var totalSm1 = 0;

	$('.clsInputProta1').each(function() {
		var num = parseInt(this.value, 10);
		if (!isNaN(num)) {
			totalSm1 += num;
		}
		$("#lblJmlSm1").html(totalSm1);
	});
}

hitung_sm2();
function hitung_sm2() {
	var totalSm2 = 0;

	$('.clsInputProta2').each(function() {
		var num = parseInt(this.value, 10);
		if (!isNaN(num)) {
			totalSm2 += num;
		}
		$("#lblJmlSm2").html(totalSm2);
	});
}
</script>