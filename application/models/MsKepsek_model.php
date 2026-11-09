<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class MsKepsek_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function data_kepsek() {
		$q = "SELECT * FROM ms_kepala_sekolah 
		WHERE tahun_ajaran='".$this->session->userdata('nilaismp_tahunajaran')."'";
		
		$query = $this->db->query($q);
		return $query;
	}
	
	public function simpan_kepsek($data) {
		$q = "INSERT INTO ms_kepala_sekolah (nama_kepsek, tahun_ajaran)
		VALUES ('".$data['txtKepsek']."','".$this->session->userdata('nilaismp_tahunajaran')."')";
		
		$query = $this->db->query($q);
		return $query;
	}
	
	public function update_kepsek($data) {
		$q = "UPDATE ms_kepala_sekolah SET nama_kepsek='".$data['txtNama']."'
		WHERE id='".$data['id']."'";
		
		$query = $this->db->query($q);
		return $query;
	}
	
}
?>