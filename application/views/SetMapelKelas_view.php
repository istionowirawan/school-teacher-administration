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
$("#mnSetMapelKelas").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		<div class="box-body">
			<div class='row'>
				
				<div class='col-md-9 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Setting Mata Pelajaran Kelas
						<?php
						echo $this->session->userdata('adm_tahunajaran');
						echo " Jenjang " . $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						 </div>
					 </div>
					 
					 <div class="box-body">
						<div class="row">
							<div class='col-md-1' style='text-align:right;margin-top:5px;' >Kelas : </div>
							<div class='col-md-11' >
								<select class='form-control input-sm' id='txtKelasPilih' name='txtKelasPilih' >
								<option value='' >= Pilih Kelas =</option>
								<?php
								foreach($kelas_jenjang->result() as $row1) {
									echo "<option value='".$row1->kelas."' >".$row1->kelas."</option>";
								}
								?>
								</select>
							</div>
						</div>
						
						<div class="row" style='margin-top:30px;' >
							<div id='detailMapelKelas' ></div>
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
	var kelas = $(this).val();
	
	$("#detailMapelKelas").html("<center><img src='images/img_loading.gif' width='70px' height='70px' ></center>");
	$("#detailMapelKelas").load("SetMapelKelas/SetMapelKelas_detail/"+kelas,function() {
		
	});
});

</script>
