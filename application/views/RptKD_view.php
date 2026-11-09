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
$("#mnInputKD").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		
		<div class="box-body" >
			<div class='row'>
				
				<div class='col-md-12 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Data KD  
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
								<td title='Semester' >Smstr</td>
								<td>Kelas</td>
								<td>Mapel</td>
								<td>KI</td>
								<td>KD</td>
								<td>Deskripsi</td>
								<td>Ranah KD</td>
								<td>Materi Pokok</td>
								<td>Detail Indi</td>
								<!--<td>Detail Ruang</td>-->
								<td>Edit</td>
							</tr>
							</thead>
							
							<tbody>
								<?php
								foreach($data_trx_kd->result() as $row) {
									echo "<tr align='center'>";
									echo "<td>".$row->semester."</td>";
									echo "<td>".$row->kelas . " " . $row->jurusan ."</td>";
									echo "<td>".$row->nama_mapel."</td>";
									echo "<td>KI".$row->ki."</td>";
									echo "<td>KD".$row->kd."</td>";
									echo "<td>".$row->kd_desc."</td>";
									echo "<td>".$row->ranah_kd."</td>";
									echo "<td>".$row->materi_pokok."</td>";
									echo "<td><input type='button' value='Indi' onclick='btnIndiClick(\"$row->id\")' class='btn btn-sm btn-warning btn-block' ></td>";
									//echo "<td><input type='button' value='Ruang' onclick='btnRuangClick(\"$row->id\")' class='btn btn-sm btn-warning btn-block' ></td>";
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
	window.location.href='TrxKD';
}

function btnIndiClick(id) {
	var dataform = "id="+id;
	$.ajax({
		url: "RptKD/detail_indi/",
		type: "POST",
		data: dataform,
		success: function(data) 
		{
			$(".modal-body").html("<i class='fa fa-refresh fa-spin'></i>");
			
			var isi = "";
			isi += "<table class='table table-bordered table-striped' >";
			isi += "<tr align='center' class='info' >";
			isi += "<td>No.Indi</td>";
			isi += "<td>Indikator Pencapaian</td>";
			isi += "<td>Ranah</td>";
			isi += "</tr>";
			
			var obj = jQuery.parseJSON( data );
			if(obj.length>0) {
				for(var c=0; c < obj.length; c++) {
					isi += "<tr align='center' >";
					isi += "<td>"+obj[c].indi_no+"</td>";
					isi += "<td>"+obj[c].indi_pencapaian+"</td>";
					isi += "<td>"+obj[c].indi_ranah + " ("+obj[c].ranah_ket+")" +"</td>";
					isi += "</tr>";
				}
			}
			isi += "</table>";
			
			$("#btnModal").click();
			$(".modal-body").html(isi);
		}
	});
}

function btnRuangClick(id) {
	var dataform = "id="+id;
	$.ajax({
		url: "RptKD/detail_ruang/",
		type: "POST",
		data: dataform,
		success: function(data) 
		{
			$(".modal-body").html("<i class='fa fa-refresh fa-spin'></i>");
			
			var isi = "";
			isi += "<table class='table table-bordered table-striped' >";
			isi += "<tr align='center' class='info' >";
			isi += "<td width='80' >No R.Lingkup</td>";
			isi += "<td>Ranah</td>";
			isi += "</tr>";
			
			var obj = jQuery.parseJSON( data );
			if(obj.length>0) {
				for(var c=0; c < obj.length; c++) {
					isi += "<tr align='center' >";
					isi += "<td>"+obj[c].ruang_no+"</td>";
					isi += "<td>"+obj[c].ruang_desc+"</td>";
					isi += "</tr>";
				}
			}
			isi += "</table>";
			
			$("#btnModal").click();
			$(".modal-body").html(isi);
		}
	});
}

function btnEditClick(id) {
	window.location.href='TrxKD?editid='+id
}
</script>
