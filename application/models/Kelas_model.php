<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Kelas_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function data_kelas() {
		$q = "SELECT * FROM ms_kelas WHERE tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."' AND jenjang='".$this->session->userdata('adm_jenjang')."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function simpan_kelas($data) {
		$q = "INSERT INTO ms_kelas 
		(tahun_ajaran,jenjang,kelas,jurusan)
		VALUES (
		'".$data['txtTa']."',
		'".$this->session->userdata('adm_jenjang')."',
		'".$data['txtKelas']."',
		'".$data['txtJurusan']."'
		)";
		$query = $this->db->query($q);
		return $query;
	}
	
	
	
}
?>