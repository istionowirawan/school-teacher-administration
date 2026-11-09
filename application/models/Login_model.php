<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function cek_login($data) {
		$hris = $this->load->database('hris', TRUE);
		$q = "SELECT emp_id, emp_name, photo, password, sex FROM msemployee 
		WHERE emp_id='".$data['txtNik']."' AND password='".sha1($data['txtPassword'])."' AND emp_status='1' ORDER BY emp_id ASC";
		$query = $hris->query($q);
		return $query;
	}
	
	public function cek_closing() {
		$q = "SELECT status FROM ms_closing ORDER BY id DESC LIMIT 1";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function cek_ta() {
		$q = "SELECT * FROM ms_tahunajaran WHERE aktif='1'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function cek_jabatan($nikguru) {
		$q = "SELECT a.id, a.nik, a.nama, b.jabatan_alias, b.wali_kelas, b.kelas_wali, b.tahun_ajaran, a.active 
		FROM ms_guru a
		LEFT JOIN 
		(SELECT * FROM set_guru_jabatan WHERE tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."') as b
		ON a.nik=b.nik_guru
		WHERE a.active='1' AND a.nik='".$nikguru."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function cek_hak_akses($jabatan) {
		$q = "SELECT id, tahun_ajaran, jabatan, jabatan_alias, mn_user, mn_msguru, mn_mssiswa, mn_setting, mn_trx, mn_laporan 
		FROM ms_jabatan WHERE jabatan_alias='".$jabatan."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function cek_username($data) {
		$q = "SELECT id, nik, nama, jenjang_sd, jenjang_smp, jenjang_sma FROM ms_guru WHERE active='1' AND nik='".$data['username']."'";
		$query = $this->db->query($q);
		return $query;
	}
	
}
?>