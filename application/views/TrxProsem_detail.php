<?php
echo "<div class='table-responsive'>";
echo "<table class='table table-bordered table-striped' >";

echo "<tr class='info' align='center' >";
echo "<td rowspan='3' style='vertical-align:middle;width:50px;' >No.KI</td>";
echo "<td rowspan='3' style='vertical-align:middle;width:50px;' >No.KD</td>";
echo "<td rowspan='3' style='vertical-align:middle;width:300px;' >Kompetensi Dasar</td>";
echo "<td rowspan='3' style='vertical-align:middle;width:60px;' >Jml Indikator</td>";
echo "<td rowspan='3' style='vertical-align:middle;width:60px;' >Jam Tatap Muka</td>";
echo "<td colspan='5' >Bulan dan minggu efektif belajar</td>";
echo "</tr>";

echo "<tr class='info' align='center' >";
echo "<td colspan='5' >";
	echo "<select class='input-sm form-control' id='txtProsemBulan' name='txtProsemBulan' >";
	echo "<option value=''>= Pilih Bulan =</option>";
	
	if($smstr_pilih==2) {
		echo "<option value='1'>Januari</option>";
		echo "<option value='2'>Februari</option>";
		echo "<option value='3'>Maret</option>";
		echo "<option value='4'>April</option>";
		echo "<option value='5'>Mei</option>";
		echo "<option value='6'>Juni</option>";
	} else {
		echo "<option value='7'>July</option>";
		echo "<option value='8'>Agustus</option>";
		echo "<option value='9'>September</option>";
		echo "<option value='10'>Oktober</option>";
		echo "<option value='11'>November</option>";
		echo "<option value='12'>Desember</option>";
	}
	
	echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr class='info' align='center' >";
echo "<td title='Minggu 1' data-toggle='tooltip' data-placement='bottom' >W1</td>";
echo "<td title='Minggu 2' data-toggle='tooltip' data-placement='bottom' >W2</td>";
echo "<td title='Minggu 3' data-toggle='tooltip' data-placement='bottom' >W3</td>";
echo "<td title='Minggu 4' data-toggle='tooltip' data-placement='bottom' >W4</td>";
echo "<td title='Minggu 5' data-toggle='tooltip' data-placement='bottom' >W5</td>";
echo "</tr>";

echo "<script>var arId=[];</script>";
$jmlIndi = 0;
foreach($detail_prosem->result() as $row) {
	echo "<tr>";
	
	echo "<td align='center' title='".$row->ki_id."' >";
		echo $row->ki;
		echo "<input type='hidden' name='txtKi[]' value='".$row->ki_id."' >";
	echo "</td>";
	
	echo "<td align='center' title='".$row->id."' >";
		echo $row->kd;
		echo "<input type='hidden' name='txtKD[]' value='".$row->id."' >";
	echo "</td>";
	
	echo "<td align='left' >".$row->kd_desc."</td>";
	echo "<td align='center' >".$row->jml_indi."</td>";
	echo "<td align='center' title='lblTMkd".$row->id."' id='lblTMkd".$row->id."' >0</td>";
	
	echo "<td><input type='number' class='input-sm form-control clsInputProsem' id='W1_".$row->id."' kolom='W1' baris='".$row->id."' name='txtProsemW1[]' min='1' ></td>";
	echo "<td><input type='number' class='input-sm form-control clsInputProsem' id='W2_".$row->id."' kolom='W2' baris='".$row->id."' name='txtProsemW2[]' min='1' ></td>";
	echo "<td><input type='number' class='input-sm form-control clsInputProsem' id='W3_".$row->id."' kolom='W3' baris='".$row->id."' name='txtProsemW3[]' min='1' ></td>";
	echo "<td><input type='number' class='input-sm form-control clsInputProsem' id='W4_".$row->id."' kolom='W4' baris='".$row->id."' name='txtProsemW4[]' min='1' ></td>";
	echo "<td><input type='number' class='input-sm form-control clsInputProsem' id='W5_".$row->id."' kolom='W5' baris='".$row->id."' name='txtProsemW5[]' min='1' ></td>";
	
	echo "</tr>";
	
	$jmlIndi += $row->jml_indi;
	echo "<script>arId.push(".$row->id.");</script>";
}

echo "<tr align='center' style='background-color:#9090f9;color:white;' >";
echo "<td colspan='3' >Jumlah KD dan Tatap Muka</td>";
echo "<td>".$jmlIndi."</td>";
echo "<td id='lblJmlTMbln' >0</td>";
echo "<td id='lblJmlW1' >0</td>";
echo "<td id='lblJmlW2' >0</td>";
echo "<td id='lblJmlW3' >0</td>";
echo "<td id='lblJmlW4' >0</td>";
echo "<td id='lblJmlW5' >0</td>";
echo "</tr>";

echo "</table>";
echo "</div>";
?>

<script>
$(".clsInputProsem").hide();

$("#txtProsemBulan").change(function() {
	$(".clsInputProsem").hide();
	$("#rowSubmit").hide();
	
	if($(this).val()!="") {
		
		var dataform = "txtBulan="+$(this).val();
		dataform += "&txtKelas="+$("#txtKelas").val();
		dataform += "&txtMapel="+$("#txtMapel").val();
		dataform += "&txtSemester="+$("#txtSemester").val();
			
		$.ajax({
			url: "TrxProsem/load_isi_prosem/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//Reset textbox Prosem perWeek
				for(var a=0; a<arId.length; a++) {
					$("#W1_"+arId[a]).val('');
					$("#W2_"+arId[a]).val('');
					$("#W3_"+arId[a]).val('');
					$("#W4_"+arId[a]).val('');
					$("#W5_"+arId[a]).val('');
				}
				
				//alert(data);
				var obj = jQuery.parseJSON( data );
				if(obj.length>0) {
					for(var c=0; c < obj.length; c++) {
						$("#W1_"+obj[c].kd_id).val(cek_nol(obj[c].week1));
						$("#W2_"+obj[c].kd_id).val(cek_nol(obj[c].week2));
						$("#W3_"+obj[c].kd_id).val(cek_nol(obj[c].week3));
						$("#W4_"+obj[c].kd_id).val(cek_nol(obj[c].week4));
						$("#W5_"+obj[c].kd_id).val(cek_nol(obj[c].week5));
					}
				}
				
				$(".clsInputProsem").slideDown(300);
				$("#rowSubmit").show();
		
				function cek_nol(nilai) {
					var hasil = nilai;
					if(nilai==0) {
						hasil = "";
					}
					return hasil;
				}
			}
		});
		
	} else {
		$(".clsInputProsem").hide();
		$("#rowSubmit").hide();
	}
});

$(".clsInputProsem").change(function() {
	var jmlPerCol = 0;
	var pilihWeek = $(this).attr("kolom");
	
	for(var a=0; a<arId.length; a++) {
		var namaTeks = "#"+pilihWeek+arId[a];
		jmlPerCol += Number($("#"+pilihWeek+"_"+arId[a]).val());
	}
	$("#lblJml"+pilihWeek).html(jmlPerCol);
});
</script>