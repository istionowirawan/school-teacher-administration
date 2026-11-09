<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class TrxKKM_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function kelas_guru() {
		$q = "SELECT a.id, a.tahunajaran, a.id_kelas, b.jenjang, b.kelas, b.paralel, b.jurusan, a.id_mapel, a.nik_guru 
		FROM set_mapel_guru a
		JOIN ms_kelas b
		ON a.id_kelas=b.id
        WHERE a.tahunajaran='".$this->session->userdata('adm_tahunajaran')."' 
		AND a.nik_guru='".$this->session->userdata('adm_userid')."'
		AND b.jenjang='".$this->session->userdata('adm_jenjang')."'
		GROUP BY a.id_kelas";
		
		$query = $this->db->query($q);
		return $query;
	}
	
	public function mapel_guru($data) {
		$q = "SELECT a.id, a.tahunajaran, a.id_kelas, a.id_mapel, c.kode, c.nama, a.nik_guru 
		FROM set_mapel_guru a
		JOIN ms_mapel c
        ON a.id_mapel=c.id
		WHERE a.tahunajaran='".$this->session->userdata('adm_tahunajaran')."' 
		AND a.nik_guru='".$this->session->userdata('adm_userid')."'
		AND c.aktif='1'
		AND a.id_kelas='".$data['txtKelas']."'
		GROUP BY a.id_mapel";
		
		$query = $this->db->query($q);
		return $query;
	}
	
	
	public function cari_ki_kd_indi($data) {
		$q = "SELECT a.id, a.semester, a.ki, a.kelas_id, a.mapel_id, a.deskripsi, a.jenjang, a.tahun_ajaran,
		(b.id) as kd_id, b.kd, b.kd_desc, (c.id) as indi_id, c.indi_no, c.indi_pencapaian
		FROM `trx_ki` a 
		JOIN trx_kd b
		ON a.id=b.ki_id
		JOIN trx_kd_indi c
		ON b.id=c.kd_id
		WHERE a.jenjang='".$this->session->userdata('adm_jenjang')."'
		AND a.semester='".$data['txtSemester']."'
		AND a.kelas_id='".$data['txtKelas']."'
		AND a.mapel_id='".$data['txtMapel']."'
		AND a.tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'
		ORDER BY a.semester ASC, a.kelas_id ASC, a.mapel_id ASC, a.ki ASC, b.kd ASC, c.indi_no ASC";
		$query = $this->db->query($q);
		return $query;
	}
	
	
	public function simpan($data) {
		
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		// die();
		
	}
	
	
}
?>