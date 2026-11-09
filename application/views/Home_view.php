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

$(".mnUser").addClass("active");
$("#mnInformation").addClass("active");
</script>

  <div class="content-wrapper">
	
    <section class="content">
		
		<div class="box-body">
		  <form role="form" name='frmInformation' id='frmInformation' method='POST' >
			<h3 style='margin-top:0px;' >Information</h3>
			
			<div class='row'>
				<div class='col-md-12 col-sm-12 col-xs-12' >
				<textarea class='form-control' id='txtInfoDesc' name='txtInfoDesc' rows='3' maxlength='500' required style='resize: none;' ></textarea>
				<input type='submit' value='Submit' class='btn btn-primary' style='border-radius:0px;float:right;margin-top:5px;' >
				</div>
			</div>
		  </form>
		  
		  <hr>
		  
		  <div id='content_info' ></div>
		  
		  <center>
			<?php
			$banyak_row = $jml_information->row(0)->jml;
			$tampildata = 5;
			$mulaidari = 0;
			$jmlPaging = ceil($banyak_row/$tampildata);
			
			echo "<nav aria-label='Page navigation'>";
			  echo "<ul class='pagination'>";
				for($a=1; $a<=$jmlPaging; $a++) {
					echo "<li><a href='#' alt='".$a."' class='btnHal' >".$a."</a></li>";
				}
			  echo "</ul>";
			echo "</nav>";
			?>
		  </center>

		</div>
		
    </section>
    
  </div>

<script>
	$("#content_info").html("<center><img src='images/img_loading.gif' width='70px' height='70px' ></center>");
	$("#content_info").load("home/data_information?hal=1");
	
	$("#frmInformation").submit(function() {
		var dataform = $(this).serialize();
		
		$.ajax({
			url: "Home/simpan_information/",
			type: "POST",
			data: dataform,
			success: function(data)  
			{
				//alert(data);
				if(data==1) {
					$("#content_info").html("<center><img src='images/img_loading.gif' width='70px' height='70px' ></center>");
					$("#content_info").load("home/data_information?hal=1");
					$("#frmInformation")[0].reset();
				} else {
					$("#btnModal").click();
					$(".modal-body").html("Posting Information Gagal <br>"+data);
				}
			}
		});
		
		return false;
	});
	
	$(".btnHal").click(function() {
		var hal = $(this).attr("alt");
		$("#content_info").html("<center><img src='images/img_loading.gif' width='70px' height='70px' ></center>");
		$("#content_info").load("home/data_information?hal="+hal);
	});
</script>
