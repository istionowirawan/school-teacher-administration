<?php
if(!$this->session->userdata('adm_userid')) {
	echo "<script>window.location.href='login';</script>";
}
?>

<style>

</style>

<script>
//Untuk Aktif Default Menu
$(".sidebar-menu .treeview").removeClass("active");
$(".sidebar-menu .treeview ul li").removeClass("active");

$(".mnMaster").addClass("active");
$("#mnTa").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		<div class="box-body">
			<div class='row'>
				
				<div class='col-md-6 col-sm-9 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">Tahun Ajaran</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						 </div>
					 </div>
					 
					 <div class="box-body">
						<table class="table table-bordered table-hover" id="tbl_ta" >
						
						<thead>
						<tr align='center' style='font-weight:bold;background-color:#3C8DBC;color:#ffffff;' >
						<td>Tahun Ajaran</td>
						<td>Semester</td>
						<td>Aktif</td>
						</tr>
						</thead>
						
						<tbody>
						<?php
						foreach($data_ta->result() as $row) {
							echo "<tr align='center' >";
							echo "<td>".$row->tahunajaran."</td>";
							echo "<td>".$row->semester."</td>";
							echo "<td>";
								if($row->aktif==1) {
									echo "<input type='button' class='btn btn-info' value='Active' style='width:100%' >";
								} else {
									echo "<input type='button' class='btn btn-danger btnChangeTa' value='Nonactive' style='width:100%' alt='".$row->id."' title='".$row->tahunajaran."' sms='".$row->semester."' >";
								}
							echo "</td>";
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

$('#tbl_ta').DataTable({
  "paging": false,
  "lengthChange": false,
  "searching": false,
  "ordering": true,
  "info": false,
  "autoWidth": false,
  "dom": '<lf<t>ip>'
});

$(".btnChangeTa").click(function() {
	var dataform = "idTA="+$(this).attr("alt");
	dataform += "&ta="+$(this).attr("title");
	dataform += "&sms="+$(this).attr("sms");
	
	$.ajax({
		url: "Tahunajaran/update_tahunajaran/",
		type: "POST",
		data: dataform,
		success: function(data)  
		{
			//alert(data);
			if(data==1) {
				$("#btnModal").click();
				$(".modal-body").html("Tahun ajaran berhasil dirubah");
			} else {
				$("#btnModal").click();
				$(".modal-body").html("Tahun ajaran gagal dirubah <br>"+data);
			}
			location.reload();
		}
	});
	
	return false;
});
</script>
