<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class SetMapelGuru_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function data_subkelas() {
		$q = "SELECT * FROM ms_kelas 
		WHERE tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'
		AND jenjang='".$this->session->userdata('adm_jenjang')."'";
		
		$query = $this->db->query($q);
		return $query;
	}
	
	public function data_setMapelKelas($idkelas) {
		$q = "SELECT t1.*, c.nik_guru FROM
(SELECT a.id, a.tahunajaran, a.mapel_id, b.kode, b.nama, b.tipe, a.kelas_id
FROM set_mapel_kelas a
JOIN ms_mapel b
ON a.mapel_id=b.id
WHERE a.kelas_id='".$idkelas."'
AND a.tahunajaran='".$this->session->userdata('adm_tahunajaran')."'
AND a.jenjang='".$this->session->userdata('adm_jenjang')."') as t1
LEFT JOIN set_mapel_guru c
ON t1.kelas_id=c.id_kelas
AND t1.mapel_id=c.id_mapel
ORDER BY t1.kode ASC";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function data_guru() {
		$q = "SELECT nik, nama FROM ms_guru WHERE active='1'";
		
		if($this->session->userdata('adm_jenjang')=="SD") {
			$q .= " AND jenjang_sd='1'";
		} else if ($this->session->userdata('adm_jenjang')=="SMP") {
			$q .= " AND jenjang_smp='1'";
		} else {
			$q .= " AND jenjang_sma='1'";
		}
		
		$query = $this->db->query($q);
		return $query;
	}
	
	public function simpan_mapelguru($data) {
		
		for($a=0; $a<count($data['txtGuru']); $a++) {
			$c = "SELECT id FROM set_mapel_guru 
			WHERE tahunajaran='".$this->session->userdata('adm_tahunajaran')."'
			AND id_kelas='".$data['txtKelasPilih']."'
			AND id_mapel='".$data['txtMapelId'][$a]."'
			LIMIT 1";
			$cuery = $this->db->query($c);
			
			if($cuery->num_rows()>0) {
				$q="UPDATE set_mapel_guru SET
				nik_guru='".$data['txtGuru'][$a]."', 
				user_input='".$this->session->userdata('adm_userid')."', 
				date_input=now()
				WHERE tahunajaran='".$this->session->userdata('adm_tahunajaran')."'
				AND id_kelas='".$data['txtKelasPilih']."' 
				AND id_mapel='".$data['txtMapelId'][$a]."'";
				$query = $this->db->query($q);
			} else {
				if(!empty($data['txtGuru'][$a])) {
					$q="INSERT INTO set_mapel_guru (tahunajaran, id_kelas, id_mapel, nik_guru, user_input, date_input)
					VALUES (
					'".$this->session->userdata('adm_tahunajaran')."',
					'".$data['txtKelasPilih']."',
					'".$data['txtMapelId'][$a]."',
					'".$data['txtGuru'][$a]."',
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