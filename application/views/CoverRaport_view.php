<?php
if(!$this->session->userdata('nilaismp_userid')) {
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

$(".mnLaporan").addClass("active");
$("#mnCoverRaport").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		<div class="box-body">
			<div class='row'>
				
				<div class='col-md-12 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Cetak Cover Raport   
						<?php
						echo $this->session->userdata('nilaismp_tahunajaran');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						 </div>
					 </div>
					 
					 <div class="box-body">
						
						<label class='col-md-1 col-sm-12 col-xs-12' style='vertical-align:middle;' >Pilih Kelas:</label>
						<select name='txtKelas' id='txtKelas' class='input-sm col-md-11 col-sm-12 col-xs-12' >
						<?php
						foreach($data_kelas->result() as $row) {
							echo "<option value='".$row->id."' >".$row->kelas . " " . $row->paralel . " " . $row->jurusan ."</option>";
						}
						?>
						</select>
						<br><br>
						<label class='col-md-1 col-sm-0 col-xs-0' ></label>
						<input type='button' id='btnCetak' value='Cetak PDF' class='btn btn-sm btn-warning btn-block' >
						
						
					 </div>
					</div>
					
				</div>
			</div>
		</div>
		
    </section>
    
  </div>

<script>
$("#btnCetak").click(function() {
	var idkelas = $("#txtKelas").val();
	
	window.open(
	  'CoverRaport/cetak_pdf/'+idkelas,
	  '_blank'
	);
	
	return false;
});
</script>
