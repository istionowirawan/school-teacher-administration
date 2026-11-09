<?php
if(!$this->session->userdata('adm_userid')) {
	echo "<script>window.location.href='login';</script>";
}
?>

<style>
hr {
	background-color:#bbbbbb;
	height:1px;
	margin-top:3px;
	opacity:0.5;
}
</style>

<script>
//Untuk Aktif Default Menu
$(".sidebar-menu .treeview").removeClass("active");
$(".sidebar-menu .treeview ul li").removeClass("active");

$(".mnMaster").addClass("active");
$("#mnClosing").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		<div class="box-body">
			<div class='row'>
				<div class='col-md-6 col-sm-9 col-xs-12' >

					<form role="form" name='frmClosing' id='frmClosing' method='POST' >
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Current Status</h3>
								
								<div class="pull-right box-tools">
								<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
								</div>
							</div>
							 
							<div class="box-body">
								<?php
								if($history_closing->row(0)->status==1) {
									echo "<div class='alert alert-success' role='alert'>Opened</div>";
									echo "<input type='button' alt='".$history_closing->row(0)->status."' value='Close system now !!!' class='btn btn-primary btnOpenClose' style='border-radius:0px;' >";
								} else {
									echo "<div class='alert alert-danger' role='alert'>Closed</div>";
									echo "<input type='button' alt='".$history_closing->row(0)->status."' value='Open system now !' class='btn btn-default btnOpenClose' style='border-radius:0px;' >";
								}
								?>
							</div>
						</div>
					</form>
					
				</div>
			
			
				<div class='col-md-6 col-sm-9 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">Closing History</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						 </div>
					 </div>
					 
					 <div class="box-body">
						<table class="table table-bordered" id="tbl_history_closing" >
						
						<thead>
						<tr align='center' style='font-weight:bold;' >
						<td>Status Closing</td>
						<td>User Closing/Open</td>
						<td>Tanggal</td>
						</tr>
						</thead>
						
						<tbody>
						<?php
						foreach($history_closing->result() as $row){
							echo "<tr align='center' >";
							echo "<td>";
								if($row->status==1) {
									echo "<span class='label label-success' >Opened</span>";
								} else {
									echo "<span class='label label-danger'>Closed</span>";
								}
							echo "</td>";
							echo "<td>".$row->user_input."</td>";
							echo "<td>".date("d F Y h:m:s", strtotime($row->date_input))."</td>";
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
$(".btnOpenClose").click(function() {
	var dataform = "status="+$(this).attr("alt");
	
	$.ajax({
		url: "Closing/update_closing/",
		type: "POST",
		data: dataform,
		success: function(data)  
		{
			//alert(data);
			if(data==1) {
				$("#btnModal").click();
				$(".modal-body").html("System Status Update Sucess");
			} else {
				$("#btnModal").click();
				$(".modal-body").html("Posting Information Gagal <br>"+data);
			}
			location.reload();
		}
	});
	
	return false;
});	

$('#tbl_history_closing').DataTable({
  "paging": true,
  "lengthChange": false,
  "searching": false,
  "ordering": true,
  "order": [[ 2, "desc" ]],
  "info": false,
  "autoWidth": false,
  "dom": '<lf<t>ip>'
});
</script>
