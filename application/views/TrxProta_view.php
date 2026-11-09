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
.row {
	margin-bottom:7px;
}
</style>

<script>
//Untuk Aktif Default Menu
$(".sidebar-menu .treeview").removeClass("active");
$(".sidebar-menu .treeview ul li").removeClass("active");

$(".mnTransaksi").addClass("active");
$("#mnInputProta").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		
		<div class="box-body" >
			<div class='row'>
				
				<div class='col-md-12 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Program Tahunan   
						<?php
						echo $this->session->userdata('adm_tahunajaran') . " " . $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" id='btnForm' ><i class="fa fa-plus"></i></button>
						 </div>
						 
					
					 </div>
					 
					 	
					 <form class="form-horizontal" name='frmTrxProta' id='frmTrxProta' >
					  <div class="box-body"  id='divInputKelas' >
						  
						  <div class='row'>
							  <label class="col-sm-2 col-md-2 control-label">Tahun Ajaran: </label>
							  <div class="col-sm-10 col-md-10" style='padding-top:7px;' >
								<label><?php echo $this->session->userdata('adm_tahunajaran'); ?>
								<input type="hidden" class="form-control" id="txtTa" name='txtTa' value='<?php echo $this->session->userdata('adm_tahunajaran'); ?>' >
							  </div>
						  </div>						  
						  
						
						  <div class='row'>
							  <label class="col-sm-2 col-md-2 control-label">Teacher Name: </label>
							  <div class="col-sm-10 col-md-10" style='padding-top:7px;' >
								<label><?php echo $this->session->userdata('adm_username'); ?>
							  </div>
						  </div>	
						  
						  
						 
						  <div class='row'>
							  <label class="col-sm-2 col-md-2 control-label">Kelas: </label>
							  <div class="col-sm-10 col-md-10" >
								<?php
								echo "<select class='form-control input-sm' id='txtKelas' name='txtKelas' required >";
								echo "<option value='' >= Pilih Kelas =</option>";
								foreach($kelas_guru->result() as $kls) {
									echo "<option value='".$kls->id_kelas."' >".$kls->kelas."</option>";
								}
								echo "</select>";				
								?>
							  </div>
						  </div>
						  
						  <div class='row' id='rowMapel' style='display:none;' >
							  <label class="col-sm-2 col-md-2 control-label">Mapel: </label>
							  <div class="col-sm-10 col-md-10" >
								<select class="form-control input-sm" id="txtMapel" name="txtMapel" onchange="mapel_changed('new',-999)" required >
								<?php
								echo "<option value='' >= Pilih Mapel =</option>";
								?>
								</select>
							  </div>
						  </div>
						  
						  
						  <div id='rowDetailProta' ></div>
						  
						  <div class="box-footer"  id='rowSubmit' style='display:none;' >
							<button type="submit" id='btnSimpanForm' class="btn btn-primary btn-block">
							<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
							Simpan
							</button>
						  </div>
						  
					  </div>
					 </form>
					 
					
					
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

$("#txtKelas").change(function() {
	if($(this).val()=="") {
		$("#rowMapel").slideUp(100);
		$("#rowDesc").slideUp(100);
		$("#rowSubmit").slideUp(100);
	} else {
		var dataform = "txtKelas="+$(this).val();
		$("#loadingBox").show();
		$("#loadingInfo").text("Search Mapel");
		
		load_mapel_guru(dataform,"simpan","","");
	}
});

function load_mapel_guru(dataform,jns,kelasid,kino) {
	$("#rowDetailProta").hide();
	$("#rowSubmit").hide();
	
	$.ajax({
		url: "TrxProta/cari_mapel_guru/",
		type: "POST",
		data: dataform,
		success: function(data) 
		{
			//alert(data);
			var obj = jQuery.parseJSON( data );
			if(obj.length>0) {
				$("#txtMapel").empty();
				$("#txtMapel").append("<option value=''>= Pilih Mapel =</option>");
				for(var c=0; c < obj.length; c++) {
					$("#txtMapel").append("<option value='"+obj[c].id_mapel+"'>"+ obj[c].nama+"</option>");
				}
				$("#rowMapel").slideDown(100);
			}
			
			if(jns=="edit") {
				$("#txtMapel").val(kelasid);
				
				$("#rowMapel").slideDown(100);
				$("#rowKI").slideDown(100);
				$("#rowKD").slideDown(100);
				$("#rowDesc").slideDown(100);
				
				$("#rowRanah").slideDown(100);
				$("#rowIndikator").slideDown(150);
				$("#rowMateri").slideDown(200);
				$("#rowRuang").slideDown(250);
				
				$("#rowSubmit").slideDown(100);
				mapel_changed("edit",kino);
					
				//remove option mapel Kelas
				$('#txtMapel option').each(function() {
					if ($(this).val()!=kelasid) {
						$(this).remove();
					}
				});
			} else {
				$("#loadingBox").hide();
			}
		}
	});
}

function mapel_changed(stat,kino) {
	if($("#txtMapel").val()=="") {
		$("#rowDetailProta").slideUp(100);
		$("#rowSubmit").hide();
	} else {
		$("#loadingBox").show();
		$("#loadingInfo").text("Load Detail Prota");
		$("#rowDetailProta").load("TrxProta/load_detail_prota/", {txtKelas:$("#txtKelas").val(), txtMapel:$("#txtMapel").val()}, function() {
			$("#loadingBox").hide();
			$("#rowDetailProta").show();
			$("#rowSubmit").slideDown(100);
		});		
	}
}	

$("#frmTrxProta").submit(function() {
	var dataform = $(this).serialize();
	$("#loadingBox").show();
	$("#loadingInfo").text("Saving...");
	
	$.ajax({
		url: "TrxProta/simpan/",
		type: "POST",
		data: dataform,
		success: function(data)  
		{
			//alert(data);
			if(data==1) {
				$("#btnModal").click();
				$(".modal-body").html("Data Prota berhasil disimpan");
				$(".modal-footer").html("");
			} else {
				$("#btnModal").click();
				$(".modal-body").html("Data Prota Gagal disimpan <br>"+data);
				$(".modal-footer").html("");
			}
			$("#loadingBox").hide();
			//location.reload();
		}
	});

	
	
	return false;
});


$("#btnLihatData").click(function() {
	window.location.href='RptKD';
});



</script>
