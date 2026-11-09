<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class SetMapelKelas_model extends CI_Model {
	
	function __construct() {
		parent::__construct(); 
	}
	
	public function data_mapel() {
		$q = "SELECT * FROM ms_mapel WHERE aktif='1' AND jenjang='".$this->session->userdata('adm_jenjang')."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function kelas_jenjang() {
		$q = "SELECT * FROM ms_kelas_jenjang WHERE jenjang='".$this->session->userdata('adm_jenjang')."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function data_kelas_paralel($kelas) {
		$q="SELECT id,kelas,paralel,jurusan FROM ms_kelas 
		WHERE kelas='".$kelas."' 
		AND jenjang='".$this->session->userdata('adm_jenjang')."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function data_setMapelKelas($kelas) {
		$q="SELECT *
		FROM set_mapel_kelas
		WHERE kelas_id IN (SELECT id FROM ms_kelas WHERE kelas='".$kelas."')
		AND tahunajaran='".$this->session->userdata('adm_tahunajaran')."'
		AND jenjang='".$this->session->userdata('adm_jenjang')."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function simpan_mapelkelas($data) {
		
		$d = "DELETE FROM set_mapel_kelas 
		WHERE kelas_id IN (SELECT id FROM ms_kelas WHERE kelas='".$data['txtKelasPilih']."')
		AND tahunajaran='".$this->session->userdata('adm_tahunajaran')."'
		AND jenjang='".$this->session->userdata('adm_jenjang')."'";
		$query2 = $this->db->query($d);
		
		
		for($c=0; $c< count($data['txtKelas']); $c++) {
			$str = explode("#",$data['txtKelas'][$c]);
			
			$q = "INSERT INTO set_mapel_kelas (tahunajaran, mapel_id, kelas_id, jenjang, user_input, date_input)
			VALUES (
			'".$this->session->userdata('adm_tahunajaran')."',
			'".$str[0]."',
			'".$str[1]."',
			'".$this->session->userdata('adm_jenjang')."',
			'".$this->session->userdata('adm_userid')."',
			now()
			)";
			$query = $this->db->query($q);
		}
		
		return $query;
	}
	
	
	
	
}
?>