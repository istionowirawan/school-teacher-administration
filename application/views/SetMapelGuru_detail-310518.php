<div class='col-md-12'>

<?php
if($data_setMapelKelas->num_rows()>0) {
?>

<form action='' method='POST' id='frmSetMapelGuru' name='frmSetMapelGuru' >
	<table class="table table-bordered table-hover table-striped" id="tbl_SetMapelGuru" >

		<tr style='background-color:#3C8DBC;color:#ffffff;text-align:center;' >
		<td>Kode</td>
		<td>Mapel</td>
		<td>Guru</td>
		</tr>
		
		<?php
		foreach($data_setMapelKelas->result() as $row) {
			echo "<tr>";
			echo "<td>".$row->kode."<input type='hidden' name='txtMapelId[]' value='".$row->mapel_id."' ></td>";
			echo "<td>".$row->nama."<input type='hidden' name='txtNamaMapel[]' value='".$row->nama."' ></td>";
			echo "<td>";
				echo "<select name='txtGuru[]' id='txtGuru".$row->mapel_id."' class='form-control input-sm selectpicker' data-live-search='true' data-size='5' data-style='input-sm btn-default' >";
				echo "<option value=''>=  Pilih Guru =</option>";
				foreach($data_guru->result() as $gur) {
					if($row->nik_guru!=NULL) {
						if($row->nik_guru==$gur->nik) {
							echo "<option selected value='".$gur->nik."'>".$gur->nama."</option>";
						} else {
							echo "<option value='".$gur->nik."'>".$gur->nama."</option>";
						}
					} else {
						echo "<option value='".$gur->nik."'>".$gur->nama."</option>";
					}
				}
				echo "</select>";
			echo "</td>";
			echo "</tr>";
		}
		?>
		
		<tr>
		<td colspan='3'><input type='submit' value='Simpan' class='form-control btn btn-sm btn-info' ></td>
		</tr>
		
	</table>
</form>


<?php
} else {
	echo "Anda belum memberikan Mapel untuk kelas ini pada menu, <b><a href='SetMapelKelas'>Setting Mapel Kelas</a></b>";
}
?>

</div>

<script>
$('.selectpicker').selectpicker();

$("#frmSetMapelGuru").submit(function() {
	var dataform = $(this).serialize();
	dataform += "&txtKelasPilih="+$("#txtKelasPilih").val();
	
	$.ajax({
		url: "SetMapelGuru/simpan_mapelguru/",
		type: "POST",
		data: dataform,
		success: function(data)  
		{
			//alert(data);
			if(data==1) {
				$("#btnModal").click();
				$(".modal-body").html("Simpan Mapel Guru Berhasil");
				$(".modal-footer").html("");
			} else {
				$("#btnModal").click();
				$(".modal-body").html("Simpan Mapel Guru Gagal <br>"+data);
				$(".modal-footer").html("");
			}
			location.reload();
		}
	});
	
	return false;
});
</script>