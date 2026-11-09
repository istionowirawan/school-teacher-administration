<form action='' method='POST' id='frmSetMapelKelas' name='frmSetMapelKelas' >
<table class="table table-bordered table-hover table-striped" id="tbl_SetMapelGuru" >
						
<thead>
<tr align='center' style='font-weight:bold;background-color:#3C8DBC;color:#ffffff;' >
	<?php
	echo "<tr style='background-color:#3C8DBC;color:#ffffff;' align='center' >";
	echo "<td width='50' >No.</td>";
	echo "<td width='100' >Kode Mapel</td>";
	echo "<td>Nama Mapel</td>";
	foreach($data_kelas_paralel->result() as $row) {
		$namakelas = $row->kelas . $row->paralel . $row->jurusan;
		echo "<td>".$namakelas."</td>";
	}
	echo "</tr>";
	?>
</tr>
</thead>
 
<tbody>
<?php
echo "<input type='hidden' value='".$kelas_pilih."' name='txtKelasPilih' id='txtKelasPilih' >";

$no=1;
foreach($data_mapel->result() as $row) {
	echo "<tr class='trMapelKelas' alt='".$row->id."' title='Double klik untuk pilih semua kelas pada mapel ini' data-toggle='tooltip' data-placement='top' style='cursor:pointer;' >";
	echo "<td align='center' >".$no."</td>";
	echo "<td align='center' >".$row->kode."</td>";
	echo "<td>";
		echo $row->nama;
		//echo "<input type='text' id='txtMapelId".$row->id."' name='txtMapelId[]' >";
	echo "</td>";
	
	foreach($data_kelas_paralel->result() as $row2) {
		$namaTextBox = "txtKelas";
		$nilaikelas = $row->id."#".$row2->id;
		echo "<td>";
			
			$statChecked = "";
			foreach($data_setMapelKelas->result() as $row3) {
				if($row3->mapel_id==$row->id && $row3->kelas_id==$row2->id) {
					$statChecked="checked";					
					break;
				}
			}
			
			echo "<input type='checkbox' class='chxKelas".$row->id." chxBoxKelas' name='".$namaTextBox."[]' id='".$namaTextBox."' title='".$namaTextBox."' alt='".$row->id."' value='".$nilaikelas."' ".$statChecked." >";
			
		echo "</td>";
	}
	
	echo "</tr>";
	$no++;
}

//foreach($data_kelas_paralel->result() as $row3) {
//	echo "<input type='text' value='".$row3->id."' name='txtKelasId[]' >";
//}

$jmlcol=3;
$jmlcol+=$data_kelas_paralel->num_rows();
?>
</tbody>

<tfoot>
	<tr>
	<td colspan='<?php echo $jmlcol; ?>' >
		<input type='submit' value='Update' class='btn btn-sm form-control btn-warning' title='Simpan' data-toggle='tooltip' data-placement='top' >
	</td>
	</tr>
</tfoot>

</table>


</form>

<script>
$('input[type="checkbox"]').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue'
});

$(".trMapelKelas").dblclick(function() {
	var idrow = $(this).attr("alt");
	$(".chxKelas"+idrow).iCheck("check");
	$("#txtMapelId"+idrow).val(idrow);
});

$(".chxBoxKelas").on("ifChanged", function() {
	var idrow = $(this).attr("alt");
	
	if(this.checked==true) {
		$("#txtMapelId"+idrow).val(idrow);
	} else {
		if($(".chxKelas"+idrow).filter(":checked").length<=0) {
			$("#txtMapelId"+idrow).val('');
		}
	}
});

$("#frmSetMapelKelas").submit(function() {
	var dataform = $(this).serialize();
	//alert(dataform);
	
	$.ajax({
		url: "SetMapelKelas/simpan_mapelkelas/",
		type: "POST",
		data: dataform,
		success: function(data)  
		{
			//alert(data);
			if(data==1) {
				$("#btnModal").click();
				$(".modal-body").html("Simpan Mapel Kelas Berhasil");
				$(".modal-footer").html("");
			} else {
				$("#btnModal").click();
				$(".modal-body").html("Simpan Mapel Kelas Gagal <br>"+data);
				$(".modal-footer").html("");
			}
			location.reload();
		}
	});
	
	return false;
});
</script>