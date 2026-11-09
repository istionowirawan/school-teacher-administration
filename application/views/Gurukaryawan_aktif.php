<form method='POST' name='frmGuruKarAktif' id='frmGuruKarAktif' >
<table class="table table-bordered table-hover" id="tbl_gurukaryawan_aktif" >
						
<thead>
<tr align='center' style='font-weight:bold;background-color:#3C8DBC;color:#ffffff;' >
<td>Nik</td>
<td>Nama Guru Karyawan</td>
<td width='50' >Active</td>
</tr>
</thead>

<tbody>
<?php
foreach($data_guru_aktif->result() as $row2) {
	echo "<tr>";
	echo "<td><input type='hidden' name='txtNik[]' value='".$row2->nik."' >".$row2->nik."</td>";
	echo "<td><input type='hidden' name='txtNama[]' value='".$row2->nama."' >".$row2->nama."</td>";
	
	echo "<td align='center' >";
		if($row2->active==0) {
			echo "<button type='button' class='btn btn-default btn-sm btnActive' onclick='active_guru(\"$row2->nik\",\"$row2->nama\",\"$row2->active\");' style='font-size:7px;' title='Klik untuk mengaktifkan kembali guru/karyawan ini' data-toggle='tooltip' data-placement='bottom' >
			  <span class='glyphicon glyphicon-remove' aria-hidden='true'></span>
			</button>";
		} else {
			echo "<button type='button' class='btn btn-info btn-sm btnActive' onclick='active_guru(\"$row2->nik\",\"$row2->nama\",\"$row2->active\");' style='font-size:7px;' title='Klik untuk menonaktifkan guru/karyawan ini' data-toggle='tooltip' data-placement='bottom' >
			  <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
			</button>";
		}
	echo "</td>";
	echo "</tr>";
}

$ketpost = "Posting digunakan jika sudah ada keputusan tetap, \ndan tidak akan bisa dilakukan perubahan lagi";
?>
</tbody>

</table>

<!--<input type='submit' value='POSTING' class='btn btn-danger btn-sm' style='width:100%;' title='' >-->

</form>


<script>
$("#tbl_gurukaryawan_aktif").DataTable({
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  "dom": '<lf<t>ip>'
});

function active_guru(id, nama, aktif) {
	var dataform = "nik="+id;
	dataform += "&nama="+nama;
	dataform += "&aktif="+aktif;
	
	$.ajax({
		url: "Gurukaryawan/active_guru/",
		type: "POST",
		data: dataform,
		success: function(data) 
		{
			//alert(data);
			if(data==1) {
				$("#body_guru_aktif").html("<center><img src='images/img_loading.gif' width='70px' height='70px' ></center>");
				$("#body_guru_aktif").load("Gurukaryawan/tampil_gurukaryawan_aktif");
			} else {
				$("#btnModal").click();
				$(".modal-body").html("Gagal rubah aktif Guru/Karyawan " + data);
				$(".modal-footer").html("");
			}
		}
	});
	
	
	return false;
}

$("#frmGuruKarAktif").submit(function() {
	var dataform = $(this).serialize();
	
	$("#btnModal").click();
	$(".modal-body").html("Semua guru dan karyawan yang belum di POSTING, akan di posting<br>Apakah Anda yakin?");
	$(".modal-footer").html("<input type='button' value='Ya' class='btn btn-primary' id='btnYaAktif' ><input type='button' value='Batal' class='btn btn-danger' id='btnBatalAktif' >");
	
	$("#btnYaAktif").click(function() {
		$.ajax({
			url: "Gurukaryawan/posting_guru/",
			type: "POST",
			data: dataform,
			success: function(data) 
			{
				//alert(data);
				if(data==1) {
					$("#body_guru_aktif").html("<center><img src='images/img_loading.gif' width='70px' height='70px' ></center>");
					$("#body_guru_aktif").load("Gurukaryawan/tampil_gurukaryawan_aktif");
				} else {
					$("#btnModal").click();
					$(".modal-body").html("Gagal Kurangi Guru/Karyawan " + data);
					$(".modal-footer").html("");
				}
			}
		});
		
		$("#myModal").modal('toggle');
	});
	
	$("#btnBatalAktif").click(function() {
		$("#myModal").modal('toggle');
	});
	
	return false;
});
</script>