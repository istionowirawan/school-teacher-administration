<div class='col-md-12'>

<?php
if($data_setMapelKelas->num_rows()>0) {
?>

<form action='' method='POST' id='frmSetMapelGuru' name='frmSetMapelGuru' >
	<table class="table table-bordered table-hover table-striped" id="tbl_SetMapelGuru" >

		<tr style='background-color:#3C8DBC;color:#ffffff;text-align:center;' >
		<td>Nik</td>
		<td>Guru</td>
		<td>Mapel</td>
		</tr>
		
		<?php
		foreach($data_guru->result() as $row) {
			echo "<tr>";
			echo "<td>".$row->nik."<input type='hidden' name='txtNikGuru[]' value='".$row->nik."' ></td>";
			echo "<td>".$row->nama."<input type='hidden' name='txtNamaGuru[]' value='".$row->nama."' ></td>";
			echo "<td>";
				echo "<select name='txtMapel[]' id='txtMapel".$row->nik."' class='form-control input-sm selectpicker' data-live-search='true' data-size='5' data-style='input-sm btn-default' >";
				echo "<option value=''>=  Pilih Mapel =</option>";
				foreach($data_setMapelKelas->result() as $mpl) {
					if($mpl->nik_guru!=NULL) {
						if($row->nik==$mpl->nik_guru) {
							echo "<option selected value='".$mpl->mapel_id."'> " . "(".$mpl->kode.") ".$mpl->nama."</option>";
						} else {
							echo "<option value='".$mpl->mapel_id."'> " . "(".$mpl->kode.") ".$mpl->nama."</option>";
						}
					} else {
						echo "<option value='".$mpl->mapel_id."'> " . "(".$mpl->kode.") ".$mpl->nama."</option>";
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
			// $("#btnModal").click();
			// $(".modal-body").html(data);
				
			if(data==1) {
				$("#btnModal").click();
				$(".modal-body").html("Simpan Mapel untuk Guru Berhasil");
				$(".modal-footer").html("");
			} else {
				$("#btnModal").click();
				$(".modal-body").html("Simpan Mapel untuk Guru Gagal <br>"+data);
				$(".modal-footer").html("");
			}
			location.reload();
		}
	});
	
	return false;
});
</script>