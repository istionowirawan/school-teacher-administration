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
.tooltip-inner {
    text-align: left;
} 
textarea {
  resize: none;
}
</style>

<script>
//Untuk Aktif Default Menu
$(".sidebar-menu .treeview").removeClass("active");
$(".sidebar-menu .treeview ul li").removeClass("active");

$(".mnTransaksi").addClass("active");
$("#mnInputSilabus").addClass("active");
</script>

  <div class="content-wrapper">

    <section class="content">
		
		
		<div class="box-body" >
			<div class='row'>
				
				<div class='col-md-12 col-sm-12 col-xs-12' >
					
					<div class="box">
					 <div class="box-header with-border">
						<h3 class="box-title">
						Silabus   
						<?php
						echo $this->session->userdata('adm_tahunajaran') . " " . $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" id='btnForm' ><i class="fa fa-plus"></i></button>
						 </div>
						 
					
					 </div>
					 
					 	
					 <form class="form-horizontal" name='frmTrxSilabus' id='frmTrxSilabus' >
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
								<select class="form-control input-sm" id="txtMapel" name="txtMapel" onchange="mapel_changed()" required >
								<?php
								echo "<option value='' >= Pilih Mapel =</option>";
								?>
								</select>
							  </div>
						  </div>
						  
						  
						  <div class='row' id='rowSemester' style='display:none;' >
							  <label class="col-sm-2 col-md-2 control-label">Semester: </label>
							  <div class="col-sm-10 col-md-10" >
								<select class="form-control input-sm" id="txtSemester" name="txtSemester" onchange="semester_changed()" required >
								<option value='' >= Pilih Semester =</option>";
								<option value='1' >1 (Satu)</option>";
								<option value='2' >2 (Dua)</option>";
								</select>
							  </div>
						  </div>
						  
						  <div class='row' id='rowKI' style='display:none;' >
							  <label class="col-sm-2 col-md-2 control-label">Pilih KI: </label>
							  <div class="col-sm-10 col-md-10" >
								<select class="form-control input-sm" id="txtKI" name="txtKI" required >
								<?php
								echo "<option value='' >= Pilih KI =</option>";
								?>
								</select>
							  </div>
						  </div>
						  
						  
						   <div class='row' id='rowKD' style='display:none;' >
							  <label class="col-sm-2 col-md-2 control-label">Pilih KD: </label>
							  <div class="col-sm-10 col-md-10" >
								<select class="form-control input-sm" id="txtKD" name="txtKD" required >
								<?php
								echo "<option value='' >= Pilih KD =</option>";
								?>
								</select>
							  </div>
						  </div>
						  
						  <div class='row' id='rowMapok' style='display:none;' >
							  <label class="col-sm-2 col-md-2 control-label">Materi Pokok: </label>
							  <div class="col-sm-10 col-md-10" id='lblMapok' >
							  </div>
						  </div>
						  
						  <div id='rowDetailSilabus' ></div>
						  
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
	$("#rowDetailSilabus").hide();
	$("#rowSubmit").hide();
	
	$.ajax({
		url: "TrxSilabus/cari_mapel_guru/",
		type: "POST",
		data: dataform,
		success: function(data) 
		{
			//alert(data);
			var obj = jQuery.parseJSON( data );
			$("#txtMapel").empty();
			$("#txtMapel").append("<option value=''>= Pilih Mapel =</option>");
			if(obj.length>0) {
				for(var c=0; c < obj.length; c++) {
					$("#txtMapel").append("<option value='"+obj[c].id_mapel+"'>"+ obj[c].nama+"</option>");
				}
				$("#rowMapel").slideDown(100);
			}
			
			$("#loadingBox").hide();
			
		}
	});
}

function mapel_changed() {
	if($("#txtMapel").val()=="") {
		$("#rowDetailSilabus").slideUp(100);
		$("#rowSubmit").hide();
	} else {
		$("#rowSemester").show();
	}
}

function semester_changed() {
	if($("#txtSemester").val()=="") {
		$("#rowDetailSilabus").slideUp(100);
		$("#rowSubmit").hide();
	} else {
		$("#loadingBox").show();
		$("#loadingInfo").text("Searching Kompetensi Inti");
		$("#rowKD").slideUp(100);
		$("#rowDetailSilabus").hide();
		
		var dataform = "txtKelas="+$("#txtKelas").val();
		dataform +=  "&txtMapel="+$("#txtMapel").val();
		dataform +=  "&txtSemester="+$("#txtSemester").val();
		
		$.ajax({
			url: "TrxSilabus/cari_ki/",
			type: "POST",
			data: dataform,
			success: function(data) 
			{
				//alert(data);
				var obj = jQuery.parseJSON( data );
				$("#txtKI").empty();
				$("#txtKI").append("<option value=''>= Pilih KI =</option>");
				
				if(obj.length>0) {
					for(var c=0; c < obj.length; c++) {
						$("#txtKI").append("<option value='"+obj[c].id+"'>"+ obj[c].ki + " ("+obj[c].deskripsi+")" +"</option>");
					}
					$("#rowKI").slideDown(100);
				}
				
				$("#loadingBox").hide();
				
			}
		});		
	}
}	

$("#txtKI").change(function() {
	if($("#txtKI").val()=="") {
		$("#rowDetailSilabus").slideUp(100);
		$("#rowKD").slideUp(100);
		$("#rowSubmit").hide();
	} else {
		
		$("#loadingBox").show();
		$("#loadingInfo").text("Searching Kompetensi Dasar");
		$("#rowDetailSilabus").hide();
		
		var dataform = "txtKelas="+$("#txtKelas").val();
		dataform +=  "&txtMapel="+$("#txtMapel").val();
		dataform +=  "&txtSemester="+$("#txtSemester").val();
		dataform +=  "&txtKI="+$("#txtKI").val();
		
		$.ajax({
			url: "TrxSilabus/cari_kd/",
			type: "POST",
			data: dataform,
			success: function(data) 
			{
				//alert(data);
				var obj = jQuery.parseJSON( data );
				$("#txtKD").empty();
				$("#txtKD").append("<option value=''>= Pilih KD =</option>");
					
				if(obj.length>0) {
					for(var c=0; c < obj.length; c++) {
						$("#txtKD").append("<option alt='"+obj[c].materi_pokok+"' title='"+obj[c].ki_id+"' value='"+obj[c].id+"'>"+ obj[c].kd + " ("+obj[c].kd_desc+")" +"</option>");
					}
					$("#rowKD").slideDown(100);
				}
				
				$("#loadingBox").hide();
				
			}
		});		
	}
});

$("#txtKD").change(function() {
	
	if($("#txtKD").val()=="") {
		$("#rowDetailSilabus").slideUp(100);
		$("#rowSubmit").hide();
	} else {
		
		$("#loadingBox").show();
		$("#loadingInfo").text("Searching Detail Silabus");
		
		$("#lblMapok").text($('option:selected', this).attr('alt'));
		$("#rowMapok").show();
		
		$("#rowDetailSilabus").load("TrxSilabus/load_detail_silabus/",{
			txtKelas:$("#txtKelas").val(),
			txtMapel:$("#txtMapel").val(),
			txtSemester:$("#txtSemester").val(),
			txtKI:$("#txtKI").val(),
			txtKD:$("#txtKD").val()
		},function() {
			$("#rowDetailSilabus").show();
			
			$("#loadingBox").hide();
		});
	}
});



$("#btnLihatData").click(function() {
	window.location.href='RptKD';
});



</script>
