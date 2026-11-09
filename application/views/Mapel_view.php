<?php
if(!$this->session->userdata('adm_userid')) {
	echo "<script>window.location.href='login';</script>";
}
?>

<style>
body {
	font-size:12px;
}
thead tr {
	cursor:pointer;
}
.btnEdit {
	cursor:pointer;
}
</style>

<script>
//Untuk Aktif Default Menu
$(".sidebar-menu .treeview").removeClass("active");
$(".sidebar-menu .treeview ul li").removeClass("active");

$(".mnMaster").addClass("active");
$("#mnMapel").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		
		<div class="box-body" >
			<div class='row'>
				
				<div class='col-md-8 col-sm-12 col-xs-12' >
					
					<div class="box collapsed-box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Tambah Mapel
						<?php
						echo $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" id='btnForm' ><i class="fa fa-plus"></i></button>
						 </div>
					 </div>
					 
					 <form class="form-horizontal" name='frmMapel' id='frmMapel' >
					  <div class="box-body"  id='divInputKelas' >
						
						
						<div class="form-group">
						  <label class="col-sm-3 control-label">Kode Mapel : *</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control input-sm" id="txtKodeMapel" name='txtKodeMapel' placeholder="(contoh format : Jenjang#mapel#submapel, contoh : P#AG#Kat)" required >
						  </div>
						</div>
						
						
						<div class="form-group">
						  <label class="col-sm-3 control-label">Nama Mapel : *</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control input-sm" id="txtNamaMapel" name='txtNamaMapel' placeholder="(contoh : Teknologi Informasi Komunikasi)" required >
						  </div>
						</div>
						
						
						<div class="form-group">
						  <label class="col-sm-3 control-label">Jenis Mapel : </label>
						  <div class="col-sm-9">
							<select class="form-control input-sm" id="txtJenisMapel" name='txtJenisMapel' required >
							<option value='' >== Pilih Mapel ==</option>
							<option value='Akademik' >Akademik</option>
							<option value='Non Akademik' >Non Akademik</option>
							<option value='Akademikpilihan' >Akademik Pilihan</option>
							</select>
						  </div>
						</div>
						
					  
					  <div class="box-footer">
						<input type="submit" id='btnSimpanForm' class="btn btn-info pull-right" value='Simpan' >
					  </div>
					  
					</form>
					 
					</div>
				</div>
			</div>
		</div>
		
		
		
		<div class="box-body">
			<div class='row'>
				
				<div class='col-md-9 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Master Mata Pelajaran  
						<?php
						echo $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						 </div>
					 </div>
					 
					 <div class="box-body">
						<table class="table table-bordered table-hover" id="tbl_Mapel" >
						
						<thead>
						<tr align='center' style='font-weight:bold;background-color:#3C8DBC;color:#ffffff;' >
							<td>Kode</td>
							<td>Nama</td>
							<td>Tipe Mapel</td>
							<td><span class='glyphicon glyphicon-pencil' aria-hidden='true' title='Edit' data-toggle='tooltip' data-placement='top' ></td>
							<td>Aktif</td>
						</tr>
						</thead>
						
						<tbody>
						<?php
						echo "<script>var arKodeMapel=new Array();</script>";
						foreach($data_mapel->result() as $row) {
							echo "<tr align='center' >";
							echo "<td>".$row->kode."</td>";
							echo "<td>".$row->nama."</td>";
							echo "<td>".$row->tipe."</td>";
							echo "<td>
								<span class='glyphicon glyphicon-pencil btnEdit' aria-hidden='true' style='cursor:pointer;' title='Edit' data-toggle='tooltip' data-placement='left' onclick='btnEditClick(\"$row->kode\",\"$row->nama\",\"$row->tipe\")' >
								</span>
							</td>";
							echo "<td>";
								if($row->aktif==1) {
									echo "<input type='button' value='Aktif' class='btn btn-info btn-sm btnAktif' style='width:100%;' alt='1' kode='".$row->kode."' >";
								} else {
									echo "<input type='button' value='Non-aktif' class='btn btn-danger btn-sm btnAktif' style='width:100%;' alt='0' kode='".$row->kode."' >";
								}
							echo "</td>";
							echo "</tr>";
							
							echo "<script>
							arKodeMapel.push('".$row->kode."');
							</script>";
						}
						?>
						</tbody>
						
						</table>
					 </div>
					</div>
					
				</div>
			</div>
		</div>
		
    </section>
    
  </div>

<script>
$("#tbl_Mapel").DataTable();

$("#txtKodeMapel").keypress(function (evt) {
	var keycode = evt.charCode || evt.keyCode;
	if (keycode  == 32) { 
		return false;
	}
});

$("#txtKodeMapel").blur(function (evt) {
	var dataform = "kodemapel="+$(this).val();
	
	$.ajax({
		url: "Mapel/cek_kode_mapel/",
		type: "POST",
		data: dataform,
		success: function(data)  
		{
			if(data==1) {
				$("#btnModal").click();
				$(".modal-body").html("Kode Mapel Sudah Pernah digunakan");
				$(".modal-footer").html("");
				
				$("#txtKodeMapel").val("");
			}			
		
		}
	});
});

$("#frmMapel").submit(function() {
	var dataform = $(this).serialize();
	
	alert($("#btnSimpanForm").val());
	if($("#btnSimpanForm").val()=='Simpan') {
		$.ajax({
			url: "Mapel/simpan_mapel/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//alert(data);
				if(data==1) {
					$("#btnModal").click();
					$(".modal-body").html("Data Mapel berhasil ditambahkan");
					$(".modal-footer").html("");
				} else {
					$("#btnModal").click();
					$(".modal-body").html("Data Mapel gagal ditambahkan <br>"+data);
					$(".modal-footer").html("");
				}
				location.reload();
			}
		});
	} else {
		$.ajax({
			url: "Mapel/update_mapel/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//alert(data);
				if(data==1) {
					$("#btnModal").click();
					$(".modal-body").html("Data Mapel berhasil diupdate");
					$(".modal-footer").html("");
				} else {
					$("#btnModal").click();
					$(".modal-body").html("Data Mapel gagal diupdate <br>"+data);
					$(".modal-footer").html("");
				}
				location.reload();
			}
		});
	}
	return false;
});

$(".btnAktif").click(function() {
	var kode = $(this).attr("kode");
	var nilai = $(this).attr("alt");
	
	var dataform = "kode="+kode;
	dataform += "&nilai="+nilai;
	
	$.ajax({
		url: "Mapel/update_aktif/",
		type: "POST",
		data: dataform,
		success: function(data)  
		{
			//alert(data);
			if(data==1) {
				$("#btnModal").click();
				$(".modal-body").html("Data Mapel aktif berhasil dirubah");
				$(".modal-footer").html("");
			} else {
				$("#btnModal").click();
				$(".modal-body").html("Data Mapel aktif gagal dirubah <br>"+data);
				$(".modal-footer").html("");
			}
			location.reload();
		}
	});
});


function btnEditClick(kode, nama, jenis) {
	$("#txtKodeMapel").val(kode);
	$("#txtNamaMapel").val(nama);
	$("#txtJenisMapel").val(jenis);
	
	$("#divInputKelas").hide();
	$("#divInputKelas").slideDown(500);
	$(".box-footer").show();
	
	$("#btnSimpanForm").val('Update');
	$("#txtKodeMapel").attr('readonly','readonly');
}
</script>
