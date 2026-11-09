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
$("#mnKelas").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		
		<div class="box-body" >
			<div class='row'>
				
				<div class='col-md-8 col-sm-12 col-xs-12' >
					
					<div class="box collapsed-box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Tambah Kelas  
						<?php
						echo $this->session->userdata('adm_tahunajaran') . " " . $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" id='btnForm' ><i class="fa fa-plus"></i></button>
						 </div>
					 </div>
					 
					 <form class="form-horizontal" name='frmKelas' id='frmKelas' >
					  <div class="box-body"  id='divInputKelas' >
						
						<div class="form-group">
						  <label class="col-sm-3 control-label">Tahun Ajaran : </label>
						  <div class="col-sm-9" style='padding-top:7px;' >
							<label><?php echo $this->session->userdata('adm_tahunajaran'); ?>
							<input type="hidden" class="form-control" id="txtTa" name='txtTa' value='<?php echo $this->session->userdata('adm_tahunajaran'); ?>' >
							<input type="hidden" class="form-control" id="txtId" name='txtId'>
						  </div>
						</div>
						
						
						<div class="form-group">
						  <label class="col-sm-3 control-label">Kelas : *</label>
						  <div class="col-sm-9">
							<?php
							$cthKelas = "";
							if($this->session->userdata('adm_jenjang')=="SD") {
								$cthKelas = "1 | 2 | 3";
							} else if ($this->session->userdata('adm_jenjang')=="SMP") {
								$cthKelas = "VII | VIII | IX";
							} else if ($this->session->userdata('adm_jenjang')=="SMA") {
								$cthKelas = "X | XI | XII";
							}
							?>
							<input type="text" class="form-control input-sm" id="txtKelas" name='txtKelas' placeholder="(contoh : <?php echo $cthKelas; ?>)" required >
						  </div>
						</div>
						
						
						<!--<div class="form-group">
						  <label class="col-sm-3 control-label">Paralel : *</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control input-sm" id="txtParalel" name='txtParalel' placeholder="(contoh : A | 1 | 3)" >
						  </div>
						</div>-->
						
						
						<div class="form-group">
						  <label class="col-sm-3 control-label">Jurusan : </label>
						  <div class="col-sm-9">
							<input type="text" class="form-control input-sm" id="txtJurusan" name='txtJurusan' placeholder="(contoh : IPA | IPS | Bahasa)" >
						  </div>
						</div>
						
					  
					  <div class="box-footer">
						<button type="submit" id='btnSimpanForm' class="btn btn-info pull-right">Simpan</button>
					  </div>
					  
					</form>
					 
					</div>
				</div>
			</div>
		</div>
		
		
		
		<div class="box-body">
			<div class='row'>
				
				<div class='col-md-12 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Master Kelas  
						<?php
						echo $this->session->userdata('adm_tahunajaran') . " " . $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						 </div>
					 </div>
					 
					 <div class="box-body">
						<table class="table table-bordered table-hover" id="tbl_gurukaryawan" >
						
						<thead>
						<tr align='center' style='font-weight:bold;background-color:#3C8DBC;color:#ffffff;' >
							<td>Tahun Ajaran</td>
							<td>Jenjang</td>
							<td>Kelas</td>
							<!--<td>Paralel</td>-->
							<td>Jurusan</td>
						</tr>
						</thead>
						
						<tbody>
						<?php
						foreach($data_kelas->result() as $row) {
							echo "<tr align='center' >";
							echo "<td>".$row->tahun_ajaran."</td>";
							echo "<td>".$row->jenjang."</td>";
							echo "<td>".$row->kelas."</td>";
							//echo "<td>".$row->paralel."</td>";
							echo "<td>".$row->jurusan."</td>";
							echo "</tr>";
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
$("#txtKelas, #txtJurusan, #txtParalel").keypress(function (evt) {
	var keycode = evt.charCode || evt.keyCode;
	if (keycode  == 32) { 
		return false;
	}
});

$("#frmKelas").submit(function() {
	var dataform = $(this).serialize();
	
	//alert($("#btnSimpanForm").text());
	if($("#btnSimpanForm").text()=='Simpan') {
		$.ajax({
			url: "Kelas/simpan_kelas/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//alert(data);
				if(data==1) {
					$("#btnModal").click();
					$(".modal-body").html("Data Kelas berhasil ditambahkan");
					$(".modal-footer").html("");
				} else {
					$("#btnModal").click();
					$(".modal-body").html("Data Kelas gagal ditambahkan <br>"+data);
					$(".modal-footer").html("");
				}
				location.reload();
			}
		});
	} else {
		
	}
	return false;
});


</script>
