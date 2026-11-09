<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>.:: PAHOA Teacher Adm</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  
  <link rel="stylesheet" href="css/bootstrap-select.min.css">
  <link rel="stylesheet" href="css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/buttons.dataTables.min.css">
  
  <link rel="stylesheet" href="css/wira-style.css">
</head>
<?php
if($this->session->userdata('adm_userid')) {
	echo '<body class="hold-transition skin-blue">';
} else {
	echo '<body class="hold-transition skin-blue sidebar-collapse">';
}
?>
<div class="wrapper">
	<header class="main-header">
    <a href="#" class="logo">
      <span class="logo-mini"><img src='images/logo_icon40x40.png'></span>
      <span class="logo-lg"><img src='images/logo_icon40x40.png'> <b>ADM</b>teacher</span>
    </a>
    <nav class="navbar navbar-static-top">
	
	
	<?php
	if($this->session->userdata('adm_userid')) {
		echo '<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
		</a>';		
	}
	?>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
		  <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="images/guest_male_256.png" class="user-image" alt="User Image">
              <span class="hidden-xs">
				<?php
				if($this->session->userdata('adm_userid')) {
					echo $this->session->userdata('adm_username');
					echo " (" . $this->session->userdata('adm_jabguru') . " " . $this->session->userdata('adm_jenjang') . ")";
				} else {
					echo "Guest";
					//echo "<script>window.location.href='login';</script>";
				}
				?>
			  </span>
            </a>
			

			
            <ul class="dropdown-menu">
              <li class="user-header">
                <p>
				<?php
				if($this->session->userdata('adm_userid')) {
					echo $this->session->userdata('adm_username');
					//echo "<img src='../HRIS/employee_photos/".$this->session->userdata('adm_photo')."' class='img-circle img-responsive' alt='User Image' style='height:100px;width:100px;margin-left:auto;margin-right:auto;' >";
					echo "<img src='../HRIS/asset/employee_photos/".$this->session->userdata('adm_photo')."' class='img-circle img-responsive' alt='User Image' style='height:100px;width:100px;margin-left:auto;margin-right:auto;' >";
				} else {
					echo "Guest";
					echo "<img src='images/guest_male_256.png' class='img-circle img-responsive' alt='User Image'  style='height:100px;width:100px;margin-left:auto;margin-right:auto;' >";
				}
				?>
                  <small>User PAHOA system</small>
                </p>
              </li>
              
              
              <!-- Menu Footer-->
              <li class="user-footer">  
                <div class="pull-right">
					<?php
					if($this->session->userdata('adm_userid')) {
						echo "<a href='Login/logout' class='btn btn-default btn-flat'>Sign out</a>";
					}
					?>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </li>
        </ul>
      </div>
    </nav>
  </header>

<!-- Button trigger modal -->
<button type="button" id='btnModal' class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" style='display:none;'>
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-default" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Information</h4>
	  </div>
	  <div class="modal-body">
		
	  </div>
	  <div class="modal-footer">
		<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
	  </div>
	</div>
  </div>
</div>
	
	
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="plugins/jQueryUI/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="plugins/knob/jquery.knob.js"></script>
<script src="plugins/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/chartjs/Chart.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/app.min.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="plugins/bootstrap-select.min.js"></script>

<script src="datatables/media/js/jquery.dataTables.js"></script>
<script src="datatables/media/js/dataTables.buttons.min.js"></script>

<script src="datatables/media/js/buttons.flash.min.js"></script>
<script src="datatables/media/js/jszip.min.js"></script>
<script src="datatables/media/js/pdfmake.min.js"></script>
<script src="datatables/media/js/vfs_fonts.js"></script>
<script src="datatables/media/js/buttons.html5.min.js"></script>
<script src="datatables/media/js/buttons.print.min.js"></script>
