<style>
body {
	overflow-y: hidden;
}
</style>

<?php
if($this->session->userdata('adm_userid')) {
	echo "<script>window.location.href='Home';</script>";
}
?>

  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content">
		
		<div class="login-box" style='margin-top:0px;'>
		  <div class="login-logo">
			<img src='images/logo_icon.png' class='' >
		  </div>
		  
		  <div class="login-box-body">
			<p class="login-box-msg">Login Teacher Admistration</p>

			<form action="" method="POST" id='frmLogin' name='frmLogin' >
			  
			  <div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Your Nik" id='txtNik' name='txtNik' required >
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			  </div>
			  
			  <div class="form-group has-feedback" id='contLoading' style='display:none;text-align:center;' >
				<i class="fa fa-refresh fa-spin"></i>
			  </div>
			  
			  <div class="form-group has-feedback" id='contJenjang' style='display:none;' >
				<select class="form-control" placeholder="Jenjang" id='txtJenjang' name='txtJenjang' required >
				<option value=''>= Pilih Jenjang =</option>
				</select>
			  </div>
			  
			  <div class="form-group has-feedback" id='contPass' style='display:none;' >
				<input type="password" class="form-control" placeholder="Password" name='txtPassword' required >
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			  </div>
			  
			  <div class="row">
				<div class="col-xs-12">
				  <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
			  </div>
			  
			</form>
			
		  </div>
		</div>
		
    </section>
    <!-- /.content -->
	
	
	
	
  </div>

<script>
	$("#frmLogin").submit(function() {
		var dataform = $(this).serialize();
		
		$.ajax({
			type: "POST",
			url: "Login/cek_login/",
			data: dataform,
			success: function(data, status) {
				//alert(data);
				if(data==1) {
					window.location.href='Home';
				} else {
					$(".modal-title").html("Login Information");
					$(".modal-body").html(data);
					$("#btnModal").click();
					$("#txtPassword").val('');
				}
			}
		});
		
		return false;
	});
	
	$("#txtNik").blur(function() {
		var dataform = "username="+$(this).val();
		
		$("#contJenjang").hide();
		$("#contPass").hide();
		$("#contLoading").show();
		
		$.ajax({
			type: "POST",
			url: "Login/cek_username/",
			data: dataform,
			success: function(data, status) {
				$("#contLoading").hide();
					
				var obj = jQuery.parseJSON(data);
				$("#txtJenjang").empty();
				$("#txtJenjang").append("<option value=''>= Pilih Jenjang =</option>");
				
				if(obj.length>0) {
					
					$("#contJenjang").slideDown(500);
					$("#contPass").slideDown(500);
					
					for(var d=0; d < obj.length; d++) {
						if(obj[d].jenjang_sd==1) {
							$("#txtJenjang").append("<option value='SD' >SD</option>");
						}
						if(obj[d].jenjang_smp==1) {
							$("#txtJenjang").append("<option value='SMP' >SMP</option>");
						}
						if(obj[d].jenjang_sma==1) {
							$("#txtJenjang").append("<option value='SMA' >SMA</option>");
						}
					}
				} else {					
					$(".modal-title").html("Login Information");
					$(".modal-body").html("NIK tidak ditemukan");
					$("#txtNik").val('');
					$("#btnModal").click();
				}
				
			}
		});
		
		return false;
	});
</script>
