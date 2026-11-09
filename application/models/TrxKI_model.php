<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class TrxKI_model extends CI_Model {
	
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
	
	public function simpan($data) {
		
		$q = "INSERT INTO trx_ki (semester, ki, kelas_id, mapel_id, deskripsi, jenjang, tahun_ajaran, user_input, date_input)
		VALUES (
		'".$data['txtSemester']."',
		'".$data['txtKI']."',
		'".$data['txtKelas']."',
		'".$data['txtMapel']."',
		'".addslashes($data['txtDescKI'])."',
		'".$this->session->userdata('adm_jenjang')."',
		'".$this->session->userdata('adm_tahunajaran')."',
		'".$this->session->userdata('adm_userid')."',
		now()
		)";
		$query = $this->db->query($q);
		
		return $query;
	}
	
	public function update($data) {
		
		$q = "UPDATE trx_ki SET 
		semester='".$data['txtSemester']."',
		ki='".$data['txtKI']."', 
		kelas_id='".$data['txtKelas']."', 
		mapel_id='".$data['txtMapel']."', 
		deskripsi='".addslashes($data['txtDescKI'])."', 
		jenjang='".$this->session->userdata('adm_jenjang')."', 
		tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."', 
		user_input='".$this->session->userdata('adm_userid')."', 
		date_input=now()
		WHERE id='".$data['txtId']."'";
		$query = $this->db->query($q);
		
		return $query;
	}
	
	public function cari_isi_ki($data) {
		$q = "SELECT * FROM trx_ki 
		WHERE semester='".$data['txtSemester']."'
		AND ki='".$data['txtKI']."' 
		AND mapel_id='".$data['txtMapel']."'
		AND kelas_id='".$data['txtKelas']."'
		AND jenjang='".$this->session->userdata('adm_jenjang')."'
		AND tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
		$query = $this->db->query($q);
		
		return $query;
	}
	
	public function data_trx_ki() {
		$q = "
		SELECT * FROM (
			SELECT a.id, a.semester, a.ki, a.kelas_id, b.kelas, b.paralel, b.jurusan, a.mapel_id, (c.nama) as nama_mapel, a.deskripsi, a.jenjang, a.tahun_ajaran, a.user_input, a.date_input 
			FROM `trx_ki` a
			JOIN ms_kelas b
			ON a.kelas_id=b.id
			JOIN ms_mapel c
			ON a.mapel_id=c.id
			WHERE a.jenjang='".$this->session->userdata('adm_jenjang')."'
			AND a.tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'
		) as t1
		WHERE t1.kelas_id IN (SELECT x.id_kelas FROM set_mapel_guru x WHERE x.nik_guru='".$this->session->userdata('adm_userid')."')
		AND t1.mapel_id IN (SELECT y.id_mapel FROM set_mapel_guru y WHERE y.nik_guru='".$this->session->userdata('adm_userid')."')
		ORDER BY t1.tahun_ajaran ASC, t1.semester ASC, t1.kelas ASC, t1.ki ASC";
		//echo $q;
		$query = $this->db->query($q);
		
		return $query;
	}
	
	public function cari_data_ki($data) {
		$q = "SELECT * FROM trx_ki WHERE id='".$data['id']."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	
}
?>