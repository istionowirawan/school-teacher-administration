<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Jabatan_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function data_jabatan() {
		//$q = "SELECT * FROM ms_jabatan WHERE tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
		$q = "SELECT * FROM ms_jabatan";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function simpan_jabatan($data) {
		$mnUser = 0;
		$mnGuru = 0;
		$mnSiswa = 0;
		$mnSetting = 0;
		$mnTrx = 0;
		$mnLaporan = 0;
		
		if(isset($data['cbMnUser'])) {
			$mnUser = 1;
		}
		if(isset($data['cbMnGuru'])) {
			$mnGuru = 1;
		}
		if(isset($data['cbMnSiswa'])) {
			$mnSiswa = 1;
		}
		if(isset($data['cbMnSetting'])) {
			$mnSetting = 1;
		}
		if(isset($data['cbMnTrx'])) {
			$mnTrx = 1;
		}
		if(isset($data['cbMnLaporan'])) {
			$mnLaporan = 1;
		}
		
		$q = "INSERT INTO ms_jabatan 
		(tahun_ajaran,jabatan,jabatan_alias,mn_user,mn_msguru,mn_mssiswa,mn_setting,mn_trx,mn_laporan)
		VALUES (
		'".$data['txtTa']."',
		'".$data['txtJabatan']."',
		'".$data['txtAlias']."',
		'".$mnUser."',
		'".$mnGuru."',
		'".$mnSiswa."',
		'".$mnSetting."',
		'".$mnTrx."',
		'".$mnLaporan."'
		)";
		$query = $this->db->query($q);
		return $query;
	}
	
	
	public function update_jabatan($data) {
		$mnUser = 0;
		$mnGuru = 0;
		$mnSiswa = 0;
		$mnSetting = 0;
		$mnTrx = 0;
		$mnLaporan = 0;
		
		if(isset($data['cbMnUser'])) {
			$mnUser = 1;
		}
		if(isset($data['cbMnGuru'])) {
			$mnGuru = 1;
		}
		if(isset($data['cbMnSiswa'])) {
			$mnSiswa = 1;
		}
		if(isset($data['cbMnSetting'])) {
			$mnSetting = 1;
		}
		if(isset($data['cbMnTrx'])) {
			$mnTrx = 1;
		}
		if(isset($data['cbMnLaporan'])) {
			$mnLaporan = 1;
		}
		
		$q = "UPDATE ms_jabatan SET
		mn_user='".$mnUser."',
		mn_msguru='".$mnGuru."',
		mn_mssiswa='".$mnSiswa."',
		mn_setting='".$mnSetting."',
		mn_trx='".$mnTrx."',
		mn_laporan='".$mnLaporan."'
		WHERE id='".$data['txtId']."'";
		$query = $this->db->query($q);
		return $query;
	}
	
}
?>