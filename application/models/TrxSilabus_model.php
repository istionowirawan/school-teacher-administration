<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class TrxSilabus_model extends CI_Model {
	
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
	
	public function cari_ki_input($data) {
		$q = "SELECT id, semester, ki, kelas_id, mapel_id, deskripsi, jenjang, tahun_ajaran 
		FROM trx_ki
		WHERE tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'
		AND kelas_id='".$data['txtKelas']."'
		AND mapel_id='".$data['txtMapel']."'
		ORDER BY semester ASC, ki ASC";
		$query = $this->db->query($q);
		return $query;
	}
	
	
	public function cari_ki($data) {
		
		$q = "SELECT a.id, a.semester, a.ki, a.kelas_id, a.mapel_id, a.deskripsi, a.jenjang, a.tahun_ajaran 
		FROM trx_ki a
		WHERE a.jenjang='".$this->session->userdata('adm_jenjang')."'
		AND a.kelas_id='".$data['txtKelas']."'
		AND a.mapel_id='".$data['txtMapel']."'
		AND a.tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'
		AND a.semester='".$data['txtSemester']."'
		ORDER BY a.semester ASC, a.ki ASC";
		$query = $this->db->query($q);
		return $query;
		
	}
	
	
	public function cari_kd($data) {
		
		$q = "SELECT id, ki_id, kd, kd_desc, materi_pokok 
		FROM `trx_kd`
		WHERE ki_id='".$data['txtKI']."'
		ORDER BY kd ASC";
		$query = $this->db->query($q);
		return $query;
		
	}
	
	
	
	
	
	
	
	public function simpan($data) {
		
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();
		
		// ================================== CHECK ==================================
		$c = "SELECT id FROM trx_silabus 
		WHERE kelas_id='".$data['txtKelas']."'
		AND mapel_id='".$data['txtMapel']."'
		AND semester='".$data['txtSemester']."'
		AND ki_id='".$data['txtKI']."'
		AND kd_id='".$data['txtKD']."'
		AND tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
		$cQuery = $this->db->query($c);
		
		
		//--- LIFE SKILL ---
		$isiLifeSkill = "";
		for($a=0; $a<count($data['txtSkillLife']); $a++) {
			$isiLifeSkill .= $data['txtSkillLife'][$a].",";
		}
		$isiLifeSkill = rtrim($isiLifeSkill,",");
		
		//--- PEND KARAKTER ---
		$isiPendKar = "";
		for($b=0; $b<count($data['txtPendKar']); $b++) {
			$isiPendKar .= $data['txtPendKar'][$b].",";
		}
		$isiPendKar = rtrim($isiPendKar,",");
		
		$lastid = -999;
		if($cQuery->num_rows()>0) {
			// ================================== UPDATE ==================================
			$lastid = $cQuery->row(0)->id;
			
			$q1 = "UPDATE trx_silabus SET 
			life_skill='".$isiLifeSkill."', 
			moral_id='".$data['txtMoral']."', 
			pend_kar_id='".$isiPendKar."',
			keg_belajar='".$data['txtKegBel']."', 
			sumber_belajar='".$data['txtSumBel']."',
			user_input='".$this->session->userdata('adm_userid')."',
			date_input=now()
			WHERE id='".$lastid."'";
			$query1 = $this->db->query($q1);
			
			$d1 = "DELETE FROM trx_silabus_tujuan WHERE id_header='".$lastid."'";
			$dQuery1 = $this->db->query($d1);
			
			$d2 = "DELETE FROM trx_silabus_indi WHERE id_header='".$lastid."'";
			$dQuery2 = $this->db->query($d2);
			
		} else {
			// ================================== INSERT ==================================
			
			// ++++ SEARCH LAST ID ++++
			$s = "SELECT id FROM trx_silabus ORDER BY id DESC LIMIT 1";
			$sQuery = $this->db->query($s);
			
			$lastid=1;
			if($sQuery->num_rows()>0) {
				$lastid = $sQuery->row(0)->id;
				$lastid += 1;
			}
			
			// ++++ INSERT SILABUS ++++
			$q1 = "INSERT INTO trx_silabus (id, kelas_id, mapel_id, semester, ki_id, kd_id, life_skill, moral_id, 
			pend_kar_id, keg_belajar, sumber_belajar, tahun_ajaran, user_input, date_input)
			VALUES (
			'".$lastid."',
			'".$data['txtKelas']."',
			'".$data['txtMapel']."',
			'".$data['txtSemester']."',
			'".$data['txtKI']."',
			'".$data['txtKD']."',
			'".$isiLifeSkill."',
			'".$data['txtMoral']."',
			'".$isiPendKar."',
			'".$data['txtKegBel']."',
			'".$data['txtSumBel']."',
			'".$this->session->userdata('adm_tahunajaran')."',
			'".$this->session->userdata('adm_userid')."',
			now()
			)";
			$query1 = $this->db->query($q1);
			
		}
		
		
		// ++++ INSERT SILABUS INDI ++++
			
		for($d=0; $d<count($data['txtNoTuj']); $d++) {
			$q2 = "INSERT INTO trx_silabus_tujuan (id_header, no_tujuan, tujuan)
			VALUES (
			'".$lastid."',
			'".$data['txtNoTuj'][$d]."',
			'".$data['txtTujuan'][$d]."'
			)";
			$query2 = $this->db->query($q2);
		}
		
		
		// ++++ INSERT SILABUS TUJUAN ++++
		
		for($c=0; $c<count($data['txtIndiId']); $c++) {
			$q3 = "INSERT INTO trx_silabus_indi (id_header, indi_id, indi_detail)
			VALUES (
			'".$lastid."',
			'".$data['txtIndiId'][$c]."',
			'".$data['txtIndiCapai'][$c]."'
			)";
			$query3 = $this->db->query($q3);
		}
		
		return $query1;
	}
	
	
	
	
	public function load_silabus_detail($data) {
		$q = "SELECT * from trx_silabus
		WHERE kelas_id='".$data['txtKelas']."'
		AND mapel_id='".$data['txtMapel']."'
		AND semester='".$data['txtSemester']."'
		AND ki_id='".$data['txtKI']."'
		AND kd_id='".$data['txtKD']."'
		AND tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
		$query = $this->db->query($q);
		return $query;
	}
	public function load_silabus_indi($data) {
		$q = "SELECT a.id, b.indi_id, b.indi_detail 
		FROM trx_silabus a
		JOIN trx_silabus_indi b
		ON a.id=b.id_header
		WHERE a.kelas_id='".$data['txtKelas']."'
		AND a.mapel_id='".$data['txtMapel']."'
		AND a.semester='".$data['txtSemester']."'
		AND a.ki_id='".$data['txtKI']."'
		AND a.kd_id='".$data['txtKD']."'
		AND a.tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
		
		$query = $this->db->query($q);
		return $query;
	}
	public function load_silabus_tujuan($data) {
		$q = "SELECT a.id, b.no_tujuan, b.tujuan 
		FROM trx_silabus a
		JOIN trx_silabus_tujuan b
		ON a.id=b.id_header
		WHERE a.kelas_id='".$data['txtKelas']."'
		AND a.mapel_id='".$data['txtMapel']."'
		AND a.semester='".$data['txtSemester']."'
		AND a.ki_id='".$data['txtKI']."'
		AND a.kd_id='".$data['txtKD']."'
		AND a.tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
		
		$query = $this->db->query($q);
		return $query;
	}
	
	
	public function db_life_skill() {
		$q = "SELECT id, kode, learning, keterampilan, deskripsi FROM ms_lifeskill";
		$query = $this->db->query($q);
		return $query;
	}

	public function db_confucius() {
		$q = "SELECT id, dizigui, indo FROM ms_confucius";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function db_pendkar() {
		$q = "SELECT id, keterangan FROM ms_pend_kar";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function db_indi($data) {
		//return $data;
		$q = "SELECT id, kd_id, indi_no, indi_pencapaian, indi_ranah 
		FROM trx_kd_indi 
		WHERE kd_id='".$data['txtKD']."'
		ORDER BY indi_no ASC";
		$query = $this->db->query($q);
		return $query;
	}
	
}
?>