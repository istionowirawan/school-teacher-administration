<script>
var noTujuan=1;
</script>


<div class='row' id='rowTujuan' >
  <label class="col-sm-2 col-md-2 control-label">Tujuan Pembelajaran: </label>
  <div class="col-sm-10 col-md-10" >
	<div id='lblTujuan' >
		<?php
		$isiTujuan = "";
		if($silabus_tujuan->num_rows()>0) {
			$nourut = 1;
			foreach($silabus_tujuan->result() as $rowTujuan) {
				$isiTujuan = $rowTujuan->tujuan;
				
				echo "<div class='input-group' id='rowTujuan".$nourut."' >";
					echo "<div class='input-group-addon'>".$nourut;
					echo "<input type='hidden' class='form-control input-sm' name='txtNoTuj[]' id='txtNoTuj".$nourut."' value='".$nourut."' >";
					echo "</div>";
					
					echo "<input type='text' class='form-control input-sm' value='".$isiTujuan."' name='txtTujuan[]' id='txtTujuan".$nourut."' placeholder='contoh : Siswa dapat mengidentifikasikan / menentukan ...' >";
				echo "</div>";
				$nourut++;
			}
			
			echo "<script>";
			echo "noTujuan=".$nourut.";";
			echo "</script>";
		}
		?>
	</div>
  
	<button id='btnTambahTujuan' type="button" class="btn btn-sm btn-default" aria-label="Left Align" title='Tambah Tujuan' data-toggle="tooltip" data-placement="right" >
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
	</button>
	
	<button id='btnKurangTujuan' type="button" class="btn btn-sm btn-default" aria-label="Left Align" title='Kurang Tujuan' data-toggle="tooltip" data-placement="right" >
		<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
	</button>
  </div>
</div>



<div class='row' id='rowLifeSkill' >
  <label class="col-sm-2 col-md-2 control-label">Life Skill: </label>
  <div class="col-sm-10 col-md-10" >
	<div id='lblLifeSkill' >
		<div class='col-md-12' > 
		Melalui pelajaran ini, siswa diharapkan dapat ...
		</div>
		<?php
		$isiLifeSkill = array();
		if($silabus_detail->num_rows()>0) {
			$isiLifeSkill = explode(",",$silabus_detail->row(0)->life_skill);
		}
		
		foreach($db_life_skill->result() as $row) {
			$ketLifeSkill = "<u>Learning:</u><br>".$row->learning;
			$ketLifeSkill .= "<br><br><u>Keterampilan:</u><br>" . $row->keterampilan;
			$ketLifeSkill .= "<br><br><u>Deskripsi:</u><br>" . $row->deskripsi;
			
			$statLS = "";
			if($silabus_detail->num_rows()>0) {
				for($a=0; $a<count($isiLifeSkill); $a++) {
					if($isiLifeSkill[$a]==$row->kode) {
						$statLS = "checked";
						break;
					}
				}
			}
			
			echo "<div class='col-md-2 col-sm-4 col-xs-6'>";
				echo "<input type='checkbox' name='txtSkillLife[]' id='txtSkillLife".$row->kode."' value='".$row->kode."' style='cursor:pointer;' ".$statLS." >";
				echo "<label for='txtSkillLife".$row->kode."' style='cursor:pointer;' title='".$ketLifeSkill."' data-html='true' data-toggle='tooltip' data-placement='top' >&nbsp;".$row->kode."</label>";
			echo "</div>";
		}
		?>
	</div>
  </div>
</div>


<div class='row' id='rowMoral' >
  <label class="col-sm-2 col-md-2 control-label">Nilai Moral ajaran Confucius: </label>
  <div class="col-sm-10 col-md-10" >
	<select id='txtMoral' name='txtMoral' class='form-control input-sm' required >
		<option value=''>= Pilih Nilai Moral Confucius =</option>
		<?php
		foreach($db_confucius->result() as $row) {
			$stat="";
			if($silabus_detail->num_rows()>0) {
				if($row->id==$silabus_detail->row(0)->moral_id) {
					$stat="selected";
				}
			}
			
			echo "<option value='".$row->id."' ".$stat." >".$row->dizigui . "(".$row->indo.")" ."</option>";
		}
		?>
	</select>
  </div>
</div>



<div class='row' id='rowPendKar' >
  <label class="col-sm-2 col-md-2 control-label">Pendidikan Karakter: </label>
  <div class="col-sm-10 col-md-10" >
	<?php
	$isiPendKar = array();
	if($silabus_detail->num_rows()>0) {
		$isiPendKar = explode(",",$silabus_detail->row(0)->pend_kar_id);
	}
	
	foreach($db_pendkar->result() as $row) {
		$statPK = "";
		if($silabus_detail->num_rows()>0) {
			for($a=0; $a<count($isiPendKar); $a++) {
				if($isiPendKar[$a]==$row->id) {
					$statPK = "checked";
					break;
				}
			}
		}
		
		echo "<div class='col-md-3 col-sm-6 col-xs-6'>";
			echo "<input type='checkbox' name='txtPendKar[]' id='txtPendKar".$row->id."' value='".$row->id."' style='cursor:pointer;' title='".$row->id."' ".$statPK." >";
			echo "<label for='txtPendKar".$row->id."' style='cursor:pointer;' title='".$row->id."' >&nbsp;".$row->keterangan."</label>";
		echo "</div>";
	}
	?>
  </div>
</div>



<div class='row' id='rowKegBel' >
  <label class="col-sm-2 col-md-2 control-label">Kegiatan Pembelajaran: </label>
  <div class="col-sm-10 col-md-10" >
	<textarea id='txtKegBel' name='txtKegBel' rows='5' class='form-control input-sm' required 
	placeholder='contoh: &#10; 1.Tatap Muka &#10; 2.Penugasan Terstruktur &#10; ...' ><?php echo ($silabus_detail->num_rows()>0?$silabus_detail->row(0)->keg_belajar:'');?></textarea>
  </div>
</div>


<div class='row' id='rowIndiCapai' >
  <label class="col-sm-2 col-md-2 control-label">Indikator Pencapaian Kompetensi: </label>
  <div class="col-sm-10 col-md-10" >
	<?php
	foreach($db_indi->result() as $row) {
		$isiIndi = "";
		if($silabus_indi->num_rows()>0) {
			foreach($silabus_indi->result() as $rowIndi) {
				if($row->id==$rowIndi->indi_id) {
					$isiIndi = $rowIndi->indi_detail;
					break;
				}
			}
		}
		
		echo $row->indi_pencapaian ." (".$row->indi_ranah.")<br>";
		echo "<input type='hidden' id='txtIndiId".$row->id."' name='txtIndiId[]' value='".$row->id."' >";
		echo "<textarea title='".$row->id."' id='txtIndiCapai".$row->id."' name='txtIndiCapai[]' rows='4' class='form-control input-sm' required placeholder='Penilaian Indi ".$row->indi_no." &#10 Contoh: &#10 1. Penilaian Jenis Tagihan &#10 2. Test tertulis &#10 3. ...' >".$isiIndi."</textarea>";
	}
	?>
	<hr style='margin:5px 0px 5px 0px;' >
  </div>
</div>



<div class='row' id='rowSumBel' >
  <label class="col-sm-2 col-md-2 control-label">Sumber Belajar: </label>
  <div class="col-sm-10 col-md-10" >
	<textarea id='txtSumBel' name='txtSumBel' rows='5' class='form-control input-sm' required 
	placeholder='contoh: &#10; 1.Buku Matematika 2A &#10; 2.Pesona Edukasi Matematika &#10; ...' ><?php echo ($silabus_detail->num_rows()>0?$silabus_detail->row(0)->sumber_belajar:'');?></textarea>
  </div>
</div>



<div class='row' id='rowBtnSubmit' >
  <label class="col-sm-2 col-md-2 control-label"></label>
  <div class="col-sm-10 col-md-10" >
	<input type='submit' value='Simpan Silabus' class='btn-block btn-sm btn-primary' >
  </div>
</div>


<script>

	// ++++++++++++++++++++++++++++++++++++++++++++ BEGIN TUJUAN PEMBELAJARAN ++++++++++++++++++++++++++++++++++++++++++++
	if(noTujuan==1) {
		buat_tujuan_pembelajaran();
	}
	function buat_tujuan_pembelajaran() {
		var str = "";
		str += "<div class='input-group' id='rowTujuan"+noTujuan+"' >";
			str += "<div class='input-group-addon'>"+noTujuan;
			str += "<input type='hidden' class='form-control input-sm' name='txtNoTuj[]' id='txtNoTuj"+noTujuan+"' value='"+noTujuan+"' >";
			str += "</div>";
		
			str += "<input type='text' class='form-control input-sm' name='txtTujuan[]' id='txtTujuan"+noTujuan+"' placeholder='contoh : Siswa dapat mengidentifikasikan / menentukan ...' >";
		str += "</div>";
		
		$("#lblTujuan").append(str);
		noTujuan++;
	}
	
	$("#btnTambahTujuan").click(function() {
		buat_tujuan_pembelajaran();
	});
	$("#btnKurangTujuan").click(function() {
		if(noTujuan>2) {
			noTujuan--;
			$("#rowTujuan"+noTujuan).remove();
		}
	});
	
	// ++++++++++++++++++++++++++++++++++++++++++++ END TUJUAN PEMBELAJARAN ++++++++++++++++++++++++++++++++++++++++++++
	
	
	
	$("#frmTrxSilabus").submit(function() {
		var dataform = $(this).serialize();
		$("#loadingBox").show();
		$("#loadingInfo").text("Saving...");
		
		$.ajax({
			url: "TrxSilabus/simpan/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//alert(data);
				//$("#btnModal").click();
				//$(".modal-body").html(data);
				
				if(data==1) {
					$("#btnModal").click();
					$(".modal-body").html("Data Silabus berhasil disimpan");
					$(".modal-footer").html("");
				} else {
					$("#btnModal").click();
					$(".modal-body").html("Data Silabus Gagal disimpan <br>"+data);
					$(".modal-footer").html("");
				}
				$("#loadingBox").hide();
				//location.reload();
			}
		});

		
		
		return false;
	});


	
</script>