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
						Kompetensi Dasar (KD)   
						<?php
						echo $this->session->userdata('adm_tahunajaran') . " " . $this->session->userdata('adm_jenjang');
						?>
						</h3>
						
						 <div class="pull-right box-tools">
							<button type="button" class="btn btn-default btn-sm" data-widget="collapse" id='btnForm' ><i class="fa fa-plus"></i></button>
						 </div>
						 
					
					 </div>
					 
					 	
					 <form class="form-horizontal" name='frmTrxKD' id='frmTrxKD' >
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
								<select class="form-control input-sm" id="txtMapel" name="txtMapel" onchange="mapel_changed('new',-999,-999)" required >
								<?php
								echo "<option value='' >= Pilih Mapel =</option>";
								?>
								</select>
							  </div>
						  </div>
						  
						  <div class='row' id='rowKI' style='display:none;' >
							<label class="col-sm-2 col-md-2 control-label">KI: </label>
							  <div class="col-sm-10 col-md-10" >
								<select class="form-control input-sm" id="txtKI" name='txtKI' onchange='ki_change(-999)' required >
								<?php
								echo "<option value='' >= Pilih KI =</option>";
								for($a=1; $a<=4; $a++) {
									echo "<option value='".$a."' > KI".$a."</option>";
								}
								?>
								</select>
							  </div>
						  </div>
						  
						  
						  <!--<div class='row' id='rowSemester' >
							<label class="col-sm-2 col-md-2 control-label">Semester: </label>
							  <div class="col-sm-10 col-md-10" >
								<input type='text' class="form-control input-sm" id="txtSemester" name='txtSemester' required >
							  </div>
						  </div>-->
						  
						  
						  <div class='row' id='rowKD' style='display:none;' >
							<label class="col-sm-2 col-md-2 control-label">KD : </label>
							  <div class="col-sm-10 col-md-10" >
								<select class="form-control input-sm" id="txtKD" name='txtKD' required >
								<?php
								echo "<option value='' >= Pilih KD =</option>";
								//for($a=1; $a<=20; $a++) {
								//	echo "<option value='".$a."' >".$a."</option>";
								//}
								?>
								</select>
							  </div>
						  </div>
						  
						   <div class='row' id='rowDesc' style='display:none;' >
							  <label class="col-sm-2 col-md-2 control-label">Deskripsi KD: </label>
							  <div class="col-sm-10 col-md-10" >
								<textarea class='form-control input-sm' id='txtDescKD' name='txtDescKD' rows='6' style='resize:none;' required ></textarea>
							  </div>
						  </div>
						  
						  <div class='row' id='rowRanah' style='display:none;' >
							<label class="col-sm-2 col-md-2 control-label">Tingkat Ranah KD:</label>
							  <div class="col-sm-10 col-md-10" >
								<select class="form-control input-sm" id="txtRanahKD" name='txtRanahKD' required >
								</select>
							  </div>
						  </div>
						  
						  
						  <div class='row' id='rowIndikator' style='display:none;' >
							<label class="col-sm-2 col-md-2 control-label">Indikator Pencapaian:</label>
							  <div class="col-sm-10 col-md-10" >
								<table class='table table-bordered' style='margin-bottom:5px;' >
									<tr class='info' align='center' >
										<th width='40'>No</th>
										<th>Indikator Pencapaian</th>
										<th>Tingkat Ranah KD</th>
									</tr>
									
									<tbody id='tbodyIndi' >
									</tbody>
								</table>
								<input type='button' class='btn btn-warning btn-sm' value='Tambah Indikator' onclick='tambah_tbody_indi()' >
								<input type='button' class='btn btn-danger btn-sm' value='Hapus Indikator' onclick='kurang_tbody_indi()' >
							  </div>
						  </div>
						  
						  <div class='row' id='rowMateri' style='display:none;' >
							  <label class="col-sm-2 col-md-2 control-label">Materi Pokok: </label>
							  <div class="col-sm-10 col-md-10" >
								<input type='text' class='form-control input-sm' id='txtMateri' name='txtMateri' rows='6' style='resize:none;' required
									placeholder='Diisi hanya inti dari materi saja (tidak perlu penjelasan yang mendetail - max 50 char)' >
							  </div>
						  </div>
						  
						  
						  <div class='row' id='rowRuang' style='display:none;' >
							<label class="col-sm-2 col-md-2 control-label">Ruang Lingkup</label>
							  <div class="col-sm-10 col-md-10" >
								<table class='table table-bordered' style='margin-bottom:5px;' >
									<tr class='info' align='center' >
										<th width='40'>No</th>
										<th>Deskripsi Ruang Lingkup</th>
									</tr>
									
									<tbody id='tbodyRuang' >
									</tbody>
								</table>
								<input type='button' class='btn btn-warning btn-sm' value='Tambah R.Lingkup' onclick='tambah_tbody_ruang()' >
								<input type='button' class='btn btn-danger btn-sm' value='Hapus R.Lingkup' onclick='kurang_tbody_ruang()' >
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
		url: "TrxKD/cari_data_kd/",
		type: "POST",
		data: dataform,
		success: function(data) 
		{
			//alert(data);
			
			var obj = jQuery.parseJSON( data );
			if(obj.length>0) {
				for(var c=0; c < obj.length; c++) {
					
					$("#txtId").val(obj[c].id);
					$("#txtKelas").val(obj[c].kelas_id);
					$("#txtKI").val(obj[c].ki);
					
					$("#txtDescKD").text(obj[c].kd_desc);
					$('#txtMateri').val(obj[c].materi_pokok);
					
					var dtKelas = "txtKelas="+obj[c].kelas_id;
					load_mapel_guru(dtKelas,"edit",obj[c].mapel_id,obj[c].ki_id,obj[c].kd);
					$('#txtRanahKD').val(obj[c].ranah_kd);
					
					
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


// +++++++++++++++++++++++++++++++++++++ BEGIN TABLE INDIKATOR +++++++++++++++++++++++++++++++++++++
var arRanah = [];
var rowIndi = 1;
function tambah_tbody_indi() {
	
	var str = "";
	str += "<tr align='center' id='rowBodyIndi"+rowIndi+"' >";
	str += "<td>"+rowIndi+"<input type='hidden' name='txtIndiNo[]' value='"+rowIndi+"' ></td>";
	str += "<td><input type='text' name='txtIndiPencapaian[]' id='txtIndiPencapaian"+rowIndi+"' class='form-control input-sm' required ></td>";
	str += "<td>";
		str += "<select name='txtIndiRanah[]' id='txtIndiRanah"+rowIndi+"' class='form-control input-sm' required >";
		str += "<option value=''>= Ranah PK =</option>";
		for(var a=0; a<arRanah.length; a++) {
			str += "<option value='"+arRanah[a].kode+"'>"+arRanah[a].kode + "(" + arRanah[a].ket+") </option>";
		}
		str += "</select>";
	str += "</td>";
	str += "</tr>";
	
	$("#tbodyIndi").append(str);
	rowIndi++;
}

function kurang_tbody_indi() {
	if(rowIndi>2) {
		rowIndi--;
		$("#rowBodyIndi"+rowIndi).remove();
	}
}
// +++++++++++++++++++++++++++++++++++++ END TABLE INDIKATOR +++++++++++++++++++++++++++++++++++++



// +++++++++++++++++++++++++++++++++++++ BEGIN TABLE RUANG LINGKUP +++++++++++++++++++++++++++++++++++++
var rowRuang = 1;
tambah_tbody_ruang();
function tambah_tbody_ruang() {
	
	var str = "";
	str += "<tr align='center' id='rowBodyRuang"+rowRuang+"' >";
	str += "<td>"+rowRuang+"<input type='hidden' name='txtRuangNo[]' value='"+rowRuang+"' ></td>";
	str += "<td><input type='text' name='txtRuangDesc[]' id='txtRuangDesc"+rowRuang+"' class='form-control input-sm' ></td>";
	str += "</tr>";
	
	$("#tbodyRuang").append(str);
	rowRuang++;
}

function kurang_tbody_ruang() {
	if(rowRuang>2) {
		rowRuang--;
		$("#rowBodyRuang"+rowRuang).remove();
	}
}
// +++++++++++++++++++++++++++++++++++++ END TABLE RUANG LINGKUP +++++++++++++++++++++++++++++++++++++


$("#txtSemester").change(function() {
	$('#txtKelas').prop('selectedIndex',0);
	$('#txtKI').prop('selectedIndex',0);
	$('#txtKD').prop('selectedIndex',0);
	$("#btnSimpanForm").text("Simpan");
	
	$("#rowMapel").slideUp(100);
	$("#rowDesc").slideUp(100);
	$("#rowSubmit").slideUp(100);
	$("#rowKI").slideUp(100);
	$("#rowKD").slideUp(100);
	
	$("#rowRanah").slideUp(100);
	$("#rowIndikator").slideUp(150);
	$("#rowMateri").slideUp(200);
	$("#rowRuang").slideUp(250);
});

$("#txtKelas").change(function() {
	if($(this).val()=="") {
		$("#rowMapel").slideUp(100);
		$("#rowDesc").slideUp(100);
		$("#rowSubmit").slideUp(100);
	} else {
		var dataform = "txtKelas="+$(this).val();
		$("#loadingBox").show();
		$("#loadingInfo").text("Search Mapel");
		
		load_mapel_guru(dataform,"simpan","","","");
	}
});

function load_mapel_guru(dataform,jns,kelasid,kino,kdno) {
	$.ajax({
		url: "TrxKD/cari_mapel_guru/",
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
				//$("#rowRuang").slideDown(250);
				
				$("#rowSubmit").slideDown(100);
				mapel_changed("edit",kino,kdno);
					
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

function mapel_changed(stat,kino,kdno) {
	if($("#txtMapel").val()=="") {
		$("#rowKI").slideUp(100);
	} else {
		$("#loadingBox").show();
		$("#loadingInfo").text("Search KI");
		
		var dataform = "";
		dataform += "txtKelas="+$("#txtKelas").val();
		dataform += "&txtMapel="+$("#txtMapel").val();
		
		$.ajax({
			url: "TrxKD/cari_ki_input/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				var obj = jQuery.parseJSON( data );
				if(obj.length>0) {
					$("#txtKI").empty();
					$("#txtKI").append("<option value=''>= Pilih KI =</option>");
					for(var c=0; c < obj.length; c++) {
						$("#txtKI").append("<option alt='"+obj[c].ki+"' title='"+obj[c].id+"' value='"+obj[c].id+"'>Semester"+obj[c].semester+": KI"+obj[c].ki + " ("+obj[c].deskripsi+") "+"</option>");
					}
					$("#rowKI").slideDown(100);
					
					if(editid!=null) {
						$('#txtKI').val(kino);
						ki_change(kdno);
						
						//remove option item KI
						$('#txtKI option').each(function() {
							if ($(this).val()!=kino) {
								$(this).remove();
							}
						});
					} else {
						$("#loadingBox").hide();
					}
				}
			}
		});
		
	}
}

function ki_change(kdno) {
	var noki = $('#txtKI option:selected').attr('alt');
	
	//Isi Nomor KD
	$("#txtKD").empty();
	$("#txtKD").append("<option value=''>= Pilih KD =</option>");
	for(var c=1; c < 15; c++) {
		$("#txtKD").append("<option value='"+c+"'>"+noki+"."+c+"</option>");
	}
	
	$("#loadingBox").show();
	$("#loadingInfo").text("Search KD");
	
	$("#rowDesc").slideUp(100);
	$("#rowSubmit").slideUp(100);
	
	$("#txtKD").val($("#txtKD option:first").val());
	$("#rowRanah").slideUp();
	$("#rowDesc").slideUp();
	$("#rowIndikator").slideUp();
	$("#rowMateri").slideUp();
	$("#rowRuang").slideUp();
	$("#rowSubmit").slideUp();
	
	if($("#txtKI").val()!="") {
		var dataform = "txtKI="+$("#txtKI").val();
		dataform += "&txtNoKi="+$('#txtKI option:selected').attr('alt');
		arRanah = [];
		
		//load_ms_ranah
		$.ajax({
			url: "TrxKD/load_ms_ranah/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				var obj = jQuery.parseJSON( data );
				if(obj.length>0) {
					for(var c=0; c < obj.length; c++) {
						$("#txtRanahKD").empty();
						$("#txtRanahKD").append("<option value=''>= Pilih Ranah KD =</option>");
						for(var c=0; c < obj.length; c++) {
							$("#txtRanahKD").append("<option value='"+obj[c].ranah_kode+"'>"+ obj[c].ranah_kode + " ("+obj[c].ranah_ket+")"+"</option>");
							arRanah.push({kode:obj[c].ranah_kode,ket:obj[c].ranah_ket});
						}
						$("#rowKD").slideDown(100);
					}
					
					//bersihkan table indi
					console.log("kurangi : " + rowIndi);
					while(rowIndi>1) {
						rowIndi--;
						$("#rowBodyIndi"+rowIndi).remove();
					}
					tambah_tbody_indi();
					
					if(editid!=null) {
						$("#loadingBox").show();
						$("#txtKD").val(kdno);
						
						//remove option item KD
						$('#txtKD option').each(function() {
							if ($(this).val()!=kdno) {
								$(this).remove();
							}
						});
						kd_change();
					} else {
						$("#loadingBox").hide();
					}
				}
			}
		});
		
	}
}

$("#txtKD").change(kd_change);
function kd_change() {
	$("#rowRanah").slideUp();
	$("#rowDesc").slideUp();
	$("#rowIndikator").slideUp();
	$("#rowMateri").slideUp();
	$("#rowRuang").slideUp();
	$("#rowSubmit").slideUp();
	
	$("#loadingBox").show();
	$("#loadingInfo").text("Search Detail KD");
	
	if($("#txtKD").val()!="") {
		var dataform = "txtKIid="+$("#txtKI").val();
		dataform += "&txtKD="+$("#txtKD").val()
		
		//load_ms_ranah
		$.ajax({
			url: "TrxKD/cek_data_kd/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//console.log(data);
				var obj = jQuery.parseJSON( data );
				if(obj.length>0) {
					var kd_id = "";
					for(var c=0; c < obj.length; c++) {
						kd_id = obj[c].id;
						$("#txtDescKD").val(obj[c].kd_desc);
						$("#txtRanahKD").val(obj[c].ranah_kd);
						$("#txtMateri").val(obj[c].materi_pokok);
					}
					
					//CARI INDIKATOR
					var dtfm = "id="+kd_id;
					$.ajax({
						url: "TrxKD/detail_indi/",
						type: "POST",
						data: dtfm,
						success: function(data)  
						{
							rowIndi=1;
							$("#tbodyIndi").empty();
							tambah_tbody_indi();
							
							var obj = jQuery.parseJSON(data);
							for(var d=0; d < obj.length; d++) {
								$("#txtIndiPencapaian"+obj[d].indi_no).val(obj[d].indi_pencapaian);
								$("#txtIndiRanah"+obj[d].indi_no).val(obj[d].indi_ranah);
								tambah_tbody_indi();
							}
							kurang_tbody_indi();
						}
					});
					
					//CARI RUANG LINGKUP
					var dtfm2 = "id="+kd_id;
					$.ajax({
						url: "TrxKD/detail_ruang/",
						type: "POST",
						data: dtfm2,
						success: function(data)  
						{
							rowRuang=1;
							$("#tbodyRuang").empty();
							tambah_tbody_ruang();
							
							var obj = jQuery.parseJSON(data);
							for(var e=0; e < obj.length; e++) {
								$("#txtRuangDesc"+obj[e].ruang_no).val(obj[e].ruang_desc);
								tambah_tbody_ruang();
							}
							kurang_tbody_ruang();
						}
					});
					
					$("#loadingBox").hide();
					$("#btnSimpanForm").text("Update");
				} else {
					$("#txtDescKD").val("");
					$("#txtRanahKD").val("");
					$("#txtMateri").val("");
					
					$("#loadingBox").hide();
					
					rowIndi=1;
					$("#tbodyIndi").empty();
					tambah_tbody_indi();
					
					rowRuang=1;
					$("#tbodyRuang").empty();
					tambah_tbody_ruang();
					
					$("#btnSimpanForm").text("Simpan");
				}
				
				$("#rowRanah").slideDown(100);
				$("#rowDesc").slideDown(100);
				$("#rowIndikator").slideDown(150);
				$("#rowMateri").slideDown(200);
				//$("#rowRuang").slideDown(250);
				$("#rowSubmit").slideDown(300);
				
				$("#loadingBox").hide();
			}
		});
		
	} else {
		$("#rowRanah").slideUp(100);
		$("#rowDesc").slideUp(100);
		$("#rowIndikator").slideUp(150);
		$("#rowMateri").slideUp(200);
		$("#rowRuang").slideUp(250);
		$("#rowSubmit").slideUp(300);
	}
}

$("#frmTrxKD").submit(function() {
	var dataform = $(this).serialize();
	$("#loadingBox").show();
	$("#loadingInfo").text("Saving...");
	
	//if($("#btnSimpanForm").text().includes("Simpan")==true) {
	if($("#btnSimpanForm").text()=="Update") {
		$.ajax({
			url: "TrxKD/update/",
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
				
				window.location.href='TrxKD';
			}
		});
		
	} else {
		$.ajax({
			url: "TrxKD/simpan/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//alert(data);
				if(data==1) {
					$("#btnModal").click();
					$(".modal-body").html("Data KD berhasil disimpan");
					$(".modal-footer").html("");
				} else {
					$("#btnModal").click();
					$(".modal-body").html("Data KD Gagal disimpan <br>"+data);
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
	window.location.href='RptKD';
});



</script>
