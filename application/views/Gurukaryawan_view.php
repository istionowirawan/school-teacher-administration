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

$(".mnMaster").addClass("active");
$("#mnGuru").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		<div class="box-body">
			<div class='row'>
				
				<div class='col-md-6 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Pilih Guru Dan Karyawan Tahun Ajaran 
						<?php
						echo $this->session->userdata('adm_tahunajaran') . " ";
						echo $this->session->userdata('adm_jenjang');
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
						<td>Nik</td>
						<td>Nama Guru Karyawan</td>
						<td>JK</td>
						<td width='50' >Add</td>
						</tr>
						</thead>
						
						<tbody>
						<?php
						$guru_pernah_dipilih=0;
						foreach($data_guru_hris->result() as $row) {
							$guru_pernah_dipilih=0;
							
							foreach($data_guru_aktif->result() as $row2) {
								if($row->emp_id==$row2->nik) {
									$guru_pernah_dipilih=1;
									break;
								}
							}
							
							if($guru_pernah_dipilih==0) {
								echo "<tr>";
								echo "<td>".$row->emp_id."</td>";
								echo "<td>".$row->emp_name."</td>";
								echo "<td>".($row->sex==1?"Pria":"Wanita")."</td>";
								echo "<td>
									<button type='button' class='btn btn-default btn-sm btnTambah' onclick='tambah_guru(\"$row->emp_id\",\"$row->emp_name\");' style='font-size:7px;' title='Klik untuk mengaktifkan guru/karyawan ini di Tahun Ajaran ".$this->session->userdata('nilaismp_tahunajaran')."' >
									  <span class='glyphicon glyphicon-plus' aria-hidden='true'></span>
									</button>
								</td>";
								echo "</tr>";
							}
						}
						?>
						</tbody>
						
						</table>
					 </div>
					</div>
					
				</div>
				
				
				<div class='col-md-6 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Guru Dan Karyawan Aktif Tahun Ajaran 
						<?php
						echo $this->session->userdata('nilaismp_tahunajaran') . " ";
						echo $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
						 </div>
					 </div>
					 
					 <div class="box-body" id='body_guru_aktif' >
						
					 </div>
					</div>
					
				</div>
				
				
				
			</div>
			  
		  
		</div>
		
    </section>
    
  </div>

<script>

$('#tbl_gurukaryawan').DataTable({
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": false,
  "dom": '<lf<t>ip>'
});

$("#body_guru_aktif").html("<center><img src='images/img_loading.gif' width='70px' height='70px' ></center>");
$("#body_guru_aktif").load("Gurukaryawan/tampil_gurukaryawan_aktif");

function tambah_guru(id, nama) {
	var dataform = "nik="+id;
	dataform += "&nama="+nama;
	
	var nomor = 0;
	$('#tbl_gurukaryawan').find('tr').click( function(){
		//alert('You clicked row '+ ($(this).index()+1));
		nomor=($(this).index()+1);
		$("#tbl_gurukaryawan tr").eq(nomor).hide(500);
	});
	
	//$("#tbl_gurukaryawan tr").eq(nomor).hide(500);
	
	$.ajax({
		url: "Gurukaryawan/tambah_guru/",
		type: "POST",
		data: dataform,
		success: function(data)  
		{
			//alert(data);
			if(data==2) {
				$("#btnModal").click();
				$(".modal-body").html("Guru sudah aktif");
				$(".modal-footer").html("");
			} else if (data==1) {
				$("#body_guru_aktif").html("<center><img src='images/img_loading.gif' width='70px' height='70px' ></center>");
				$("#body_guru_aktif").load("Gurukaryawan/tampil_gurukaryawan_aktif");
			} else {
				$("#btnModal").click();
				$(".modal-body").html("Gagal tambah guru atau karyawan <br>"+data);
				$(".modal-footer").html("");
			}
			//location.reload();
		}
	});
}
</script>
