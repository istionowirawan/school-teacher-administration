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

$(".mnTransaksi").addClass("active");
$("#mnInputKI").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		
		<div class="box-body" >
			<div class='row'>
				
				<div class='col-md-12 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Data KI  
						<?php
						echo $this->session->userdata('adm_tahunajaran') . " " . $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" id='btnForm' ><i class="fa fa-plus"></i></button>
						 </div>
						 
					 </div>
					 
					 <div class="box-body"  id='divInputKelas' >
						<span class="glyphicon glyphicon-arrow-left" aria-hidden="true" style='font-size:30px;cursor:pointer;color:orange;' title='Kembali Input KI' onclick='backToInputKI()' ></span>
						
						<table class="table table-bordered table-hover table-striped" id="tblDataKI" >
			
							<thead>
							<tr style='background-color:#3C8DBC;color:#ffffff;text-align:center;' >
								<td width='10' title='Semester' >Smstr</td>
								<td>Kelas</td>
								<td>KI</td>
								<td>Mapel</td>
								<td>Deskripsi</td>
								<td>Jenjang</td>
								<td>Tahun Ajaran</td>
								<td>Edit</td>
							</tr>
							</thead>
							
							<tbody>
								<?php
								foreach($data_trx_ki->result() as $row) {
									echo "<tr align='center'>";
									echo "<td>".$row->semester."</td>";
									echo "<td>".$row->kelas . " " . $row->jurusan ."</td>";
									echo "<td>KI".$row->ki."</td>";
									echo "<td>".$row->nama_mapel."</td>";
									echo "<td>".$row->deskripsi."</td>";
									echo "<td>".$row->jenjang."</td>";
									echo "<td>".$row->tahun_ajaran."</td>";
									echo "<td><input type='button' value='edit' onclick='btnEditClick(\"$row->id\")' class='btn btn-sm btn-primary btn-block' ></td>";
									echo "</tr>";
								}
								?>
							</tbody>
							
						</table>
					 </div>
					 
					 
					</div>
					
						<div class="overlay" id='loadingBox' style='display:none;' >
						<i class="fa fa-refresh fa-spin"></i>
						<h5 id='loadingInfo' style="position:relative;top:60%;text-align:center;" >Loading</h5>
						</div> 
					
				</div>
			</div>
		</div>
		
    </section>
    
  </div>

<script>
$("#tblDataKI").dataTable();

function backToInputKI() {
	window.location.href='TrxKI';
}

function btnEditClick(id) {
	window.location.href='TrxKI?editid='+id
}
</script>
