<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Setjabatan_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function data_jabatan() {
		$q = "SELECT * FROM ms_jabatan WHERE tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function data_guru() {
		$q = "SELECT a.id, a.nik, a.nama, b.jabatan_alias, b.wali_kelas, b.kelas_wali, b.tahun_ajaran, a.active 
		FROM ms_guru a
		LEFT JOIN 
		(
			SELECT * FROM set_guru_jabatan 
			WHERE tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."' 
			AND jenjang='".$this->session->userdata('adm_jenjang')."'
		) as b
		ON a.nik=b.nik_guru
		WHERE a.active='1'";
		
		if($this->session->userdata('adm_jenjang')=="SD") {
			$q .= " AND a.jenjang_sd='1'";
		} else if($this->session->userdata('adm_jenjang')=="SMP") {
			$q .= " AND a.jenjang_smp='1'";
		} else {
			$q .= " AND a.jenjang_sma='1'";
		}
		
		$query = $this->db->query($q);
		return $query;
	}
	
	public function data_kelas() {
		$q = "SELECT id, tahun_ajaran, jenjang, kelas, paralel, jurusan FROM ms_kelas 
		WHERE tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'
		AND jenjang='".$this->session->userdata('adm_jenjang')."'
		ORDER BY id ASC";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function simpan_setjabatan($data) {
		
		$query=0;
		for($a=0; $a<count($data['txtNik']); $a++) {
			if(!empty($data['txtJabatan'][$a])) {
				
				$c = "SELECT id FROM set_guru_jabatan 
				WHERE nik_guru='".$data['txtNik'][$a]."'
				AND jenjang='".$this->session->userdata('adm_jenjang')."'
				AND tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."' LIMIT 1";
				$cQuery = $this->db->query($c);
				
				if($cQuery->num_rows()>0) {
					$q = "UPDATE set_guru_jabatan SET 
					jabatan_alias='".$data['txtJabatan'][$a]."'
					WHERE nik_guru='".$data['txtNik'][$a]."'
					AND jenjang='".$this->session->userdata('adm_jenjang')."'
					AND tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
					$query = $this->db->query($q);
				} else {
					$q = "INSERT INTO set_guru_jabatan (nik_guru, jabatan_alias, jenjang, tahun_ajaran, user_input, date_input)
					VALUES (
					'".$data['txtNik'][$a]."',
					'".$data['txtJabatan'][$a]."',
					'".$this->session->userdata('adm_jenjang')."',
					'".$this->session->userdata('adm_tahunajaran')."',
					'".$this->session->userdata('adm_userid')."',
					now()
					)";
					$query = $this->db->query($q);
				}
				
				
			}
		}
		return $query;
	}
}
?>