  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="images/guest_male_256.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
			<?php
			if($this->session->userdata('adm_userid')) {
				echo $this->session->userdata('adm_username');
			} else {
				echo "User";
			}
			?>
		  </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Active :
			<?php
			if($this->session->userdata('adm_tahunajaran')) {
				echo "<b>";
				echo $this->session->userdata('adm_tahunajaran');
				echo " Smst ". $this->session->userdata("adm_sms");
				echo "<b>";
			}
			?>

		  </a>
        </div>
      </div>
     
	 
	 
      <ul class="sidebar-menu">
        <li class="header">Teacher Administration <?php echo $this->session->userdata('adm_jenjang'); ?></li>
        
		<?php if($this->session->userdata('adm_mn_user')==1) { ?>
		<!-- ############################# MENU USER ############################# -->
		<li class="treeview mnUser">
          <a href="#">
            <i class="fa fa-user"></i> <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li id='mnInformation' data-toggle="tooltip" data-placement="right" title='Publish atau cari info di sistem nilai' >
				<a href="Home"><i class="fa fa-angle-right"></i> Information</a>
			</li>
		  </ul>
        </li>
		<?php } ?>
		
		<!-- ############################# MENU MASTER ############################# -->
		<?php if($this->session->userdata('adm_mn_msguru')==1) { ?>
		<?php if($this->session->userdata('adm_closing')==1 || 
		($this->session->userdata('adm_closing')==0 && 
			($this->session->userdata('adm_jabguru')=="Admin" || 
			$this->session->userdata('adm_jabguru')=="PKS" || 
			$this->session->userdata('adm_jabguru')=="TU" || 
			$this->session->userdata('adm_jabguru')=="kepsek"))) { ?>
		<li class="treeview mnMaster">
          <a href="#">
            <i class="fa fa-suitcase"></i> <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li id='mnClosing' data-toggle="tooltip" data-placement="right" title='Untuk membuka atau menutup Sistem Administrasi Ini' >
				<a href="Closing"><i class="fa fa-circle-o"></i> Closing System</a>
			</li>
			<li id='mnTa' data-toggle="tooltip" data-placement="right" title='Tentukan Tahun Ajaran Aktif disini' >
				<a href="Tahunajaran"><i class="fa fa-circle-o"></i> Tahun Ajaran</a>
			</li>
            <li id='mnGuru' data-toggle="tooltip" data-placement="right" title='Digunakan untuk memilih Guru dan karyawan yang aktif di jenjang Setiap Tahun Ajaran' >
				<a href="Gurukaryawan"><i class="fa fa-circle-o"></i> Guru & Karyawan</a>
			</li>
			<li id='mnKelas' >
				<a href="Kelas"><i class="fa fa-circle-o"></i> Kelas</a>
			</li>
			<li id='mnMapel' >
				<a href="Mapel"><i class="fa fa-circle-o"></i> Mata Pelajaran</a>
			</li>
			
		  </ul>	
        </li>
		<?php } ?>
		<?php } ?>
		
		
		<!-- ############################# MENU SETTING ############################# -->
		<?php if($this->session->userdata('adm_mn_setting')==1) { ?>
		<?php if($this->session->userdata('adm_closing')==1 || 
		($this->session->userdata('adm_closing')==0 && 
			($this->session->userdata('adm_jabguru')=="Admin" || 
			$this->session->userdata('adm_jabguru')=="PKS" || 
			$this->session->userdata('adm_jabguru')=="TU" || 
			$this->session->userdata('adm_jabguru')=="kepsek"))) { ?>
		<li class="treeview mnSetting">
          <a href="#">
            <i class="fa fa-pencil"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li id='mnSetJabatan' data-toggle="tooltip" data-placement="right" title='Digunakan untuk mensetting Jabatan Guru' >
				<a href="Setjabatan"><i class="fa fa-square-o"></i> Guru -Jabatan</a>
			</li>
			<li id='mnSetMapelKelas' data-toggle="tooltip" data-placement="right" title='Digunakan untuk mensetting kelas mata pelajaran' >
				<a href="SetMapelKelas"><i class="fa fa-square-o"></i> Mapel -Kelas</a>
			</li>
			<li id='mnSetMapelGuru' data-toggle="tooltip" data-placement="right" title='Digunakan untuk mensetting Mata pelajaran diajar oleh guru siapa di kelas yang dipilih' >
				<a href="SetMapelGuru"><i class="fa fa-square-o"></i> Mapel -Guru perKelas</a>
			</li>
			
		  </ul>
        </li>
		<?php } ?>
		<?php } ?>
		
		
		
		
		
		<!-- ############################# MENU TRANSACTION ############################# -->
		<li class="treeview mnTransaksi">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Input Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li id='mnInputKI' data-toggle="tooltip" data-placement="right" title='Input Kompetensi Inti'  >
				<a href="TrxKI"><i class="fa fa-circle-o"></i> Input KI</a>
			</li>
			
			<li id='mnInputKD' data-toggle="tooltip" data-placement="right" title='Input Kompetensi Dasar'  >
				<a href="TrxKD"><i class="fa fa-circle-o"></i> Input KD</a>
			</li>
			
			<li id='mnInputProta' data-toggle="tooltip" data-placement="right" title='Input Program Tahunan'  >
				<a href="TrxProta"><i class="fa fa-circle-o"></i> Input Prota</a>
			</li>
			
			<li id='mnInputProsem' data-toggle="tooltip" data-placement="right" title='Input Program Semester'  >
				<a href="TrxProsem"><i class="fa fa-circle-o"></i> Input Prosem</a>
			</li>
			
			<li id='mnInputSilabus' data-toggle="tooltip" data-placement="right" title='Input Silabus'  >
				<a href="TrxSilabus"><i class="fa fa-circle-o"></i> Input Silabus</a>
			</li>
			
			<li id='mnInputKKM' data-toggle="tooltip" data-placement="right" title='Input Kriteria Ketuntasan Minimal'  >
				<a href="TrxKKM"><i class="fa fa-circle-o"></i> Input KKM</a>
			</li>
			
			<li id='mnInputRPP' data-toggle="tooltip" data-placement="right" title='Input Rencana Pelaksanaan Pembelajaran'  >
				<a href="TrxRPP"><i class="fa fa-circle-o"></i> Input RPP</a>
			</li>
			
          </ul>
        </li>
		
		
		<!-- ############################# MENU LAPORAN ############################# -->
		<?php if($this->session->userdata('adm_mn_laporan')==1) { ?>
        <li class="treeview mnLaporan">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Laporan</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			
			<li id='mnRptKIKD' data-toggle="tooltip" data-placement="right" title='Laporan Kompetensi Inti'  >
				<a href="RptKI"><i class="fa fa-circle-o"></i> Report KI</a>
			</li>
			
			<li id='mnReportKD' data-toggle="tooltip" data-placement="right" title='Laporan Kompetensi Dasar'  >
				<a href="RptKD"><i class="fa fa-circle-o"></i> Report KD</a>
			</li>
			
			<li id='mnReportProta' data-toggle="tooltip" data-placement="right" title='Laporan Program Tahunan'  >
				<a href="RptProta"><i class="fa fa-circle-o"></i> Report Prota</a>
			</li>
			
			<li id='mnReportProsem' data-toggle="tooltip" data-placement="right" title='Laporan Program Semester'  >
				<a href="RptProsem"><i class="fa fa-circle-o"></i> Report Prosem</a>
			</li>
			
			<li id='mnReportSilabus' data-toggle="tooltip" data-placement="right" title='Laporan Silabus'  >
				<a href="RptSilabus"><i class="fa fa-circle-o"></i> Report Silabus</a>
			</li>
			
			<li id='mnReportKKM' data-toggle="tooltip" data-placement="right" title='Laporan Kriteria Ketuntasan Minimal'  >
				<a href="RptKKM"><i class="fa fa-circle-o"></i> Report KKM</a>
			</li>
			
			<li id='mnReportRPP' data-toggle="tooltip" data-placement="right" title='Laporan Rencana Pelaksanaan Pembelajaran'  >
				<a href="RptRPP"><i class="fa fa-circle-o"></i> Report RPP</a>
			</li>
			
		  </ul>
        </li>
		<?php } ?>
        
		
      </ul>
    </section>
  </aside>