<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Gurukaryawan_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function data_guru_hris() {
		$hris = $this->load->database('hris', TRUE);
		$q = "SELECT emp_id, emp_name, photo, sex FROM msemployee 
		WHERE emp_status='1'
		AND emp_id!='01123456'
		AND emp_id!='admin_pa'
		ORDER BY emp_id ASC";
		$query = $hris->query($q);
		return $query;
	}
	
	public function data_guru_aktif() {
		$q = "SELECT * FROM ms_guru";
		
		if($this->session->userdata('adm_jenjang')=="SD") {
			$q .= " WHERE jenjang_sd='1'";
		} else if($this->session->userdata('adm_jenjang')=="SMP") {
			$q .= " WHERE jenjang_smp='1'";
		} else if($this->session->userdata('adm_jenjang')=="SMA") {
			$q .= " WHERE jenjang_sma='1'";
		}
		
		$query = $this->db->query($q);
		return $query;
	}
	
	public function tambah_guru($data) {
		$c = "SELECT id FROM ms_guru 
		WHERE nik='".$data['nik']."'";
		
		if($this->session->userdata('adm_jenjang')=="SD") {
			$c .= " AND jenjang_sd='1'";
		} else if($this->session->userdata('adm_jenjang')=="SMP") {
			$c .= " AND jenjang_smp='1'";
		} else if($this->session->userdata('adm_jenjang')=="SMA") {
			$c .= " AND jenjang_sma='1'";
		}
		
		$cQuery = $this->db->query($c);
		
		if($cQuery->num_rows()>0) {
			return 2;
		} else {
			$q = "INSERT INTO ms_guru (nik,nama,active,jenjang_sd,jenjang_smp,jenjang_sma)
			VALUES (
			'".$data['nik']."',
			'".$data['nama']."',
			'1',";
			
			if($this->session->userdata('adm_jenjang')=="SD") {
				$q .= "1,0,0";
			} else if($this->session->userdata('adm_jenjang')=="SMP") {
				$q .= "0,1,0";
			} else if($this->session->userdata('adm_jenjang')=="SMA") {
				$q .= "0,0,1";
			}
			
			$q.=")";
			$query = $this->db->query($q);
			return $query;
		}
	}
	
	public function active_guru($data) {
		//print_r($data);
		$aktif = 0;
		if($data['aktif']==0) {
			$aktif = 1;
		} else {
			$aktif = 0;
		}
		
		$q = "UPDATE ms_guru SET active='".$aktif."' WHERE nik='".$data['nik']."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function posting_guru($data) {
		$query=0;
		for($a=0; $a < count($data['txtNik']); $a++) {
			$q="UPDATE ms_guru SET stat_posted='1' WHERE nik='".$data['txtNik'][$a]."' AND tahun_ajaran='".$data['txtTa'][$a]."'";
			$query = $this->db->query($q);
		}		
		return $query;
	}
	
}
?>