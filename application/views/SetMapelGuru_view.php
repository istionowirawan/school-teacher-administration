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

$(".mnSetting").addClass("active");
$("#mnSetMapelGuru").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		<div class="box-body">
			<div class='row'>
				
				<div class='col-md-9 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Setting Mata Pelajaran Guru per Kelas
						<?php
						echo $this->session->userdata('adm_tahunajaran');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						 </div>
					 </div>
					 
					 <div class="box-body">
						<div class="row">
							<div class='col-md-1' style='text-align:right;margin-top:5px;' >Kelas:</div>
							<div class='col-md-11' >
								<select class='form-control input-sm' id='txtKelasPilih' name='txtKelasPilih' >
								<option value='' >= Pilih Kelas =</option>
								<?php
								foreach($data_subkelas->result() as $row) {
									$kelas = $row->kelas . $row->jurusan . " " . $row->paralel;
									echo "<option value='".$row->id."' >".$kelas."</option>";
								}
								?>
								</select>
							</div>
						</div>
						
						<div class="row" style='margin-top:30px;' >
							<div id='detailGuruMapel' ></div>
						</div>
					 </div>
					</div>
					
				</div>
			</div>
		</div>
		
    </section>
    
  </div>

<script>
$("#txtKelasPilih").change(function() {
	var idkelas = $(this).val();
	
	$("#detailGuruMapel").html("<center><i class='fa fa-refresh fa-spin'></i></center>");
	$("#detailGuruMapel").load("SetMapelGuru/detail_MapelGuru/"+idkelas);
});
</script>
