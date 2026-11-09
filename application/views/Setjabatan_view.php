<?php
if(!$this->session->userdata('adm_userid')) {
	echo "<script>window.location.href='login';</script>";
}
?>

<style>
thead tr {
	cursor:pointer;
}
</style>

<script>
//Untuk Aktif Default Menu
$(".sidebar-menu .treeview").removeClass("active");
$(".sidebar-menu .treeview ul li").removeClass("active");

$(".mnSetting").addClass("active");
$("#mnSetJabatan").addClass("active");
</script>
 
  <div class="content-wrapper">

    <section class="content">
		
		<div class="box-body">
			<div class='row'>
				
				<div class='col-md-9 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Set Jabatan Guru  
						<?php
						echo $this->session->userdata('adm_tahunajaran');
						echo " Jenjang " . $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						 </div>
					 </div>
					
					<form method='POST' id='frmSetJabatan' name='frmSetJabatan' >					
					 <div class="box-body">
						<table class="table table-bordered table-hover" id="tbl_setjabatan" >
						
						<thead>
							<tr align='center' style='font-weight:bold;background-color:#3C8DBC;color:#ffffff;' >
							<td>Nik</td>
							<td>Nama</td>
							<td>Jabatan</td>
							<!--<td>Wali Kelas</td>
							<td>Kelas Wali <br>(Jika Wali Kelas)</td>-->
							</tr>
						</thead>
						
						<tbody>
							<?php
							$noar = 0;
							foreach($data_guru->result() as $row) {
								echo "<tr>";
								echo "<td align='center' >".$row->nik."<input type='hidden' value='".$row->nik."' name='txtNik[]' id='txtNik".$noar."' ></td>";
								echo "<td>".$row->nama."<input type='hidden' value='".$row->nama."' name='txtNama[]' id='txtNama".$noar."' ></td>";
								echo "<td>";
									echo "<select name='txtJabatan[]' id='txtJabatan".$noar."' class='form-control input-sm' style='width:100%;' >";
									echo "<option value=''>== Pilih Jabatan ==</option>";
									foreach($data_jabatan->result() as $jb) {
										if($row->jabatan_alias==$jb->jabatan_alias) {
											echo "<option value='".$jb->jabatan_alias."' selected >".$jb->jabatan."</option>";
										} else {
											echo "<option value='".$jb->jabatan_alias."'>".$jb->jabatan."</option>";
										}
									}
									echo "</select>";
								echo "</td>";
								
								
								echo "</tr>";						
							}
							?>
						</tbody>
						
						</table>
					  </div>
					 
					  <div class="box-footer">
						<input type="submit" id='btnSimpanForm' class="btn btn-info pull-right form-control" value='Simpan' >
					  </div>
					 </form>
					 
					 <div class="overlay" id='loadingBox' style='display:none;' >
					 <i class="fa fa-refresh fa-spin"></i>
					 </div> 
					
					</div>
					
				</div>
				
			</div>
		</div>
		
    </section>
    
  </div>

<script>
$("#tbl_setjabatan").DataTable({
	"paging": false,
	"lengthChange": true,
	"searching": true,
	"ordering": true,
	"info": true,
	"autoWidth": false,
	"dom": '<lf<t>ip>'
});

$(".chxBoxWali").on("ifChanged", function() {
	var idrow = $(this).attr("alt");
	if(this.checked==true) {
		$("#txtWaliKls"+idrow).val(1);
		$("#txtKelasWali"+idrow).slideDown(100);
	} else {
		$("#txtWaliKls"+idrow).val(0);
		$("#txtKelasWali"+idrow).slideUp(100);
	}
});

$('input[type="checkbox"]').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue'
});

$("#frmSetJabatan").submit(function() {
	var dataform = $(this).serialize();
	$("#loadingBox").show();
	
	$.ajax({
		url: "Setjabatan/simpan_setjabatan/",
		type: "POST",
		data: dataform,
		success: function(data)  
		{
			//alert(data);
			$("#loadingBox").hide();
			if(data==1) {
				$("#btnModal").click();
				$(".modal-body").html("Setting Jabatan guru berhasil disimpan");
				$(".modal-footer").html("");
				location.reload();
			} else {
				$("#btnModal").click();
				$(".modal-body").html("Setting Jabatan guru gagal disimpan <br>"+data);
				$(".modal-footer").html("");
			}
		}
	});
	
	return false;
});
</script>
