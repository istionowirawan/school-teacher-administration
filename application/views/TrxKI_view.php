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
						Kompetensi Inti (KI)   
						<?php
						echo $this->session->userdata('adm_tahunajaran') . " " . $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" id='btnForm' ><i class="fa fa-plus"></i></button>
						 </div>
						 
					
					 </div>
					 
					 	
					 <form class="form-horizontal" name='frmTrxKI' id='frmTrxKI' >
					  <div class="box-body"  id='divInputKelas' >
						  <div class='row' >
							<div class="col-sm-12 col-md-12" >
								<button type="button" id='btnLihatData' class="btn btn-warning pull-right" >
								<span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
								Lihat Data
								</button>
							</div>
						  </div>
						
						
						  <div class='row'>
							  <label class="col-sm-2 col-md-2 control-label">Tahun Ajaran: </label>
							  <div class="col-sm-10 col-md-10" style='padding-top:7px;' >
								<label><?php echo $this->session->userdata('adm_tahunajaran'); ?>
								<input type="hidden" class="form-control" id="txtTa" name='txtTa' value='<?php echo $this->session->userdata('adm_tahunajaran'); ?>' >
								<input type="hidden" class="form-control" id="txtId" name='txtId'>
							  </div>
						  </div>						  
						  
						  <div class='row'>
							  <label class="col-sm-2 col-md-2 control-label">Teacher Name: </label>
							  <div class="col-sm-10 col-md-10" style='padding-top:7px;' >
								<label><?php echo $this->session->userdata('adm_username'); ?>
							  </div>
						  </div>	
						 
						 
						 <div class='row' id='rowSemester' >
							<label class="col-sm-2 col-md-2 control-label">Semester: </label>
							  <div class="col-sm-10 col-md-10" >
								<select class="form-control input-sm" id="txtSemester" name='txtSemester' required >
								<?php
								echo "<option value='' >= Pilih Semester =</option>";
								for($a=1; $a<=2; $a++) {
									echo "<option value='".$a."' >".$a."</option>";
								}
								?>
								</select>
							  </div>
						  </div>
						  
						  <div class='row' id='rowKelas' style='display:none;' >
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
								<select class="form-control input-sm" id="txtMapel" name='txtMapel' required >
								<?php
								echo "<option value='' >= Pilih Mapel =</option>";
								?>
								</select>
							  </div>
						  </div>
						  
						  <div class='row' id='rowKI' style='display:none;' >
							<label class="col-sm-2 col-md-2 control-label">KI: </label>
							  <div class="col-sm-10 col-md-10" >
								<select class="form-control input-sm" id="txtKI" name='txtKI' required >
								<?php
								echo "<option value='' >= Pilih KI =</option>";
								for($a=1; $a<=4; $a++) {
									echo "<option value='".$a."' > KI".$a."</option>";
								}
								?>
								</select>
							  </div>
						  </div>
						  
						  
						  <div class='row' id='rowDesc' style='display:none;' >
							  <label class="col-sm-2 col-md-2 control-label">Deskripsi KI: </label>
							  <div class="col-sm-10 col-md-10" >
								<textarea class='form-control input-sm' id='txtDescKI' name='txtDescKI' rows='6' style='resize:none;' required ></textarea>
							  </div>
						  </div>
						  
						  
					  <div class="box-footer"  id='rowSubmit' style='display:none;' >
						<button type="submit" id='btnSimpanForm' class="btn btn-primary btn-block">
						<span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>
						Simpan
						</button>
					  </div>
					  
					</form>
					 
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
var url_string = window.location.href
var url = new URL(url_string);
var editid = url.searchParams.get("editid");
if(editid!=null) {
	$("#loadingBox").show();
	
	var dataform = "id="+editid;
	$.ajax({
		url: "TrxKI/cari_data_ki/",
		type: "POST",
		data: dataform,
		success: function(data) 
		{
			//alert(data);
			
			var obj = jQuery.parseJSON( data );
			if(obj.length>0) {
				for(var c=0; c < obj.length; c++) {
					
					$("#txtId").val(obj[c].id);
					$("#txtSemester").val(obj[c].semester);
					$("#txtKelas").val(obj[c].kelas_id);
					$("#txtKI").val(obj[c].ki);
					$("#txtDescKI").text(obj[c].deskripsi);
					
					var dtKelas = "txtKelas="+obj[c].kelas_id;
					load_mapel_guru(dtKelas,"edit",obj[c].mapel_id);

					//remove option item KI
					$('#rowKI option').each(function() {
						if ($(this).val()!=obj[c].ki) {
							$(this).remove();
						}
					});
					
					//remove option item Kelas
					$('#txtKelas option').each(function() {
						if ($(this).val()!=obj[c].kelas_id) {
							$(this).remove();
						}
					});
				}
				
			}
		}
	});
}

$('input[type="checkbox"]').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass: 'iradio_minimal-blue'
});

$("#rowSemester").change(function() {
	$("#rowKelas").show();
});

$("#txtSemester").change(function() {
	$('#txtKelas').prop('selectedIndex',0);
	$('#txtKI').prop('selectedIndex',0);
	$("#btnSimpanForm").text("Simpan");
	
	$("#rowMapel").slideUp(100);
	$("#rowDesc").slideUp(100);
	$("#rowSubmit").slideUp(100);
	$("#rowKI").slideUp(100);
});

$("#txtKelas").change(function() {
	$('#txtKI').prop('selectedIndex',0);
	$("#rowMapel").slideUp(100);
	$("#rowDesc").slideUp(100);
	$("#rowSubmit").slideUp(100);
	
	if($(this).val()!="") {
		var dataform = "txtKelas="+$(this).val();
		$("#loadingBox").show();
		$("#loadingInfo").text("Search Mapel");
		
		load_mapel_guru(dataform,"simpan","");
	}
});

function load_mapel_guru(dataform,jns,kelasid) {
	$.ajax({
		url: "TrxKI/cari_mapel_guru/",
		type: "POST",
		data: dataform,
		success: function(data) 
		{
			//alert(data);
			$("#loadingBox").hide();
			
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
				$("#rowDesc").slideDown(100);
				$("#rowSubmit").slideDown(100);
				$("#btnSimpanForm").text("Update");
				
				//remove option mapel Kelas
				$('#txtMapel option').each(function() {
					if ($(this).val()!=kelasid) {
						$(this).remove();
					}
				});
			}
		}
	});
}

$("#txtMapel").change(function() {
	if($(this).val()=="") {
		$("#rowKI").slideUp(100);
	} else {
		$("#rowKI").slideDown(100);
	}
});

$("#txtKI").change(function() {
	$("#rowDesc").slideUp(100);
	$("#rowSubmit").slideUp(100);
	
	if($(this).val()!="") {
		
		$("#loadingBox").show();
		$("#loadingInfo").text("KI Data Checking...");
		
		var dataform = "txtKelas="+$("#txtKelas").val();
		dataform += "&txtMapel="+$("#txtMapel").val();
		dataform += "&txtKI="+$("#txtKI").val();
		dataform += "&txtSemester="+$("#txtSemester").val();
		
		$.ajax({
			url: "TrxKI/cari_isi_ki/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//alert(data);
				$("#txtDescKI").text("");
				
				var obj = jQuery.parseJSON( data );
				if(obj.length>0) {
					for(var c=0; c < obj.length; c++) {
						$("#txtId").val(obj[c].id);
						$("#txtDescKI").text(obj[c].deskripsi);
					}
					$("#btnSimpanForm").text("Update");
				}
				
				$("#loadingBox").hide();
				$("#rowDesc").slideDown(100);
				$("#rowSubmit").slideDown(100);
			}
		});
		
	}
});

$("#frmTrxKI").submit(function() {
	var dataform = $(this).serialize();
	$("#loadingBox").show();
	$("#loadingInfo").text("Saving...");
	
	//if($("#btnSimpanForm").text().includes("Simpan")==true) {
	if($("#btnSimpanForm").text()=="Update") {
		$.ajax({
			url: "TrxKI/update/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//alert(data);
				if(data==1) {
					$("#btnModal").click();
					$(".modal-body").html("Data KI berhasil diupdate");
					$(".modal-footer").html("");
				} else {
					$("#btnModal").click();
					$(".modal-body").html("Data KI Gagal diupdate <br>"+data);
					$(".modal-footer").html("");
				}
				$("#loadingBox").hide();
				
				window.location.href='TrxKi';
			}
		});
		
	} else {
		$.ajax({
			url: "TrxKI/simpan/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//alert(data);
				if(data==1) {
					$("#btnModal").click();
					$(".modal-body").html("Data KI berhasil disimpan");
					$(".modal-footer").html("");
				} else {
					$("#btnModal").click();
					$(".modal-body").html("Data KI Gagal disimpan <br>"+data);
					$(".modal-footer").html("");
				}
				$("#loadingBox").hide();
				location.reload();
			}
		});
	}
	
	
	return false;
});


$("#btnLihatData").click(function() {
	window.location.href='RptKI';
});

</script>
