<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Mapel_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function data_mapel() {
		$q = "SELECT * FROM ms_mapel WHERE jenjang='".$this->session->userdata('adm_jenjang')."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function cek_kode_mapel($data) {
		$q = "SELECT id FROM ms_mapel WHERE kode='".$data['kodemapel']."'";
		$query = $this->db->query($q);
		return $query->num_rows();
	}
	
	public function simpan_mapel($data) {
		$q = "INSERT INTO ms_mapel 
		(jenjang,kode,nama,tipe,aktif)
		VALUES (
		'".$this->session->userdata('adm_jenjang')."',
		'".$data['txtKodeMapel']."',
		'".$data['txtNamaMapel']."',
		'".$data['txtJenisMapel']."',
		'1'
		)";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function update_mapel($data) {
		$q = "UPDATE ms_mapel SET
		nama='".$data['txtNamaMapel']."',
		jenis='".$data['txtJenisMapel']."'
		WHERE kode='".$data['txtKodeMapel']."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function update_aktif($data) {
		$aktif = 0;
		if($data['nilai']==0) {
			$aktif = 1;
		} else {
			$aktif = 0;
		}
		
		$q = "UPDATE ms_mapel SET aktif='".$aktif."' WHERE kode='".$data['kode']."'";
		$query = $this->db->query($q);
		return $query;	
	}
	
	
}
?>