<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class TrxProsem_model extends CI_Model {
	
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
	
	
	
	public function load_detail_prosem($data) {
		
		$q = "SELECT a.id, a.ki_id, b.ki, a.kd, a.kd_desc, b.semester, a.tahun_ajaran, b.jenjang,
		b.kelas_id, b.mapel_id,		
		(SELECT Count(indi_no) FROM trx_kd_indi WHERE kd_id=a.id) as jml_indi 
		FROM `trx_kd` a
		JOIN trx_ki b
		ON a.ki_id=b.id
		WHERE b.jenjang='".$this->session->userdata('adm_jenjang')."'
		AND b.semester='".$data['txtSemester']."'
		AND b.kelas_id='".$data['txtKelas']."'
		AND b.mapel_id='".$data['txtMapel']."'
		AND a.tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
		
		$query = $this->db->query($q);
		return $query;
		
	}
	
	
	public function simpan($data) {
		
		$query1=0;
		$lastid=1;
		
		// ======================= SEARCH DATA EXIST ======================= 
		$d = "SELECT id FROM trx_prosem 
		WHERE jenjang='".$this->session->userdata('adm_jenjang')."'
		AND kelas_id='".$data['txtKelas']."'
		AND mapel_id='".$data['txtMapel']."'
		AND semester='".$data['txtSemester']."'
		AND tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
		$dQuery = $this->db->query($d);
		
		if($dQuery->num_rows()>0) {
			
			$lastid = $dQuery->row(0)->id;
			
		} else {
			
			// ======================= SEARCH LAST ID ======================= 
			$c = "SELECT id FROM trx_prosem ORDER BY id DESC LIMIT 1";
			$cQuery = $this->db->query($c);
			
			if($cQuery->num_rows()>0) {
				$lastid = $cQuery->row(0)->id;
				$lastid += 1;
			}
			
			// ----------------------------- INSERT TABLE HEADER -----------------------------
			$q1 = "INSERT INTO trx_prosem (id, jenjang, kelas_id, mapel_id, semester, tahun_ajaran, user_input, date_input)
			VALUES (
			'".$lastid."',
			'".$this->session->userdata('adm_jenjang')."',
			'".$data['txtKelas']."',
			'".$data['txtMapel']."',
			'".$data['txtSemester']."',
			'".$this->session->userdata('adm_tahunajaran')."',
			'".$this->session->userdata('adm_userid')."',
			now()
			)";
			$query1 = $this->db->query($q1);
			
		}
		
		
		// ----------------------------- INSERT/UPDATE TABLE DETAIL -----------------------------
		for($a=0; $a<count($data['txtKD']); $a++) {
			$c3 = "SELECT id FROM trx_prosem_detail
			WHERE id_head='".$lastid."'
			AND bulan='".$data['txtProsemBulan']."'
			AND kd_id='".$data['txtKD'][$a]."'";
			$c3Query = $this->db->query($c3);
			
			if($c3Query->num_rows()>0) {
				
				$q2 = "UPDATE trx_prosem_detail SET 
				week1=".$this->cek_null($data['txtProsemW1'][$a]).", 
				week2=".$this->cek_null($data['txtProsemW2'][$a]).", 
				week3=".$this->cek_null($data['txtProsemW3'][$a]).", 
				week4=".$this->cek_null($data['txtProsemW4'][$a]).", 
				week5=".$this->cek_null($data['txtProsemW5'][$a]).", 
				user_input='".$this->session->userdata('adm_userid')."', 
				date_input=now()
				WHERE id_head='".$lastid."'
				AND bulan='".$data['txtProsemBulan']."'
				AND kd_id='".$data['txtKD'][$a]."'";
				$query2 = $this->db->query($q2);
				
				
			} else {
				
				// ----------------------------- INSERT TABLE DETAIL 2 -----------------------------
				$q2 = "INSERT INTO trx_prosem_detail (id_head, bulan, kd_id, week1, week2, week3, week4, week5, user_input, date_input)
				VALUES (
				'".$lastid."',
				'".$data['txtProsemBulan']."',
				'".$data['txtKD'][$a]."',
				".$this->cek_null($data['txtProsemW1'][$a]).",
				".$this->cek_null($data['txtProsemW2'][$a]).",
				".$this->cek_null($data['txtProsemW3'][$a]).",
				".$this->cek_null($data['txtProsemW4'][$a]).",
				".$this->cek_null($data['txtProsemW5'][$a]).",
				'".$this->session->userdata('adm_userid')."',
				now()
				)";
				$query2 = $this->db->query($q2);
					
				
			}
			
		}
		
		return $query2;
	}
	
	public function load_isi_prosem($data) {
		//print_r($data);
		$q = "SELECT a.id, a.jenjang, a.kelas_id, a.mapel_id, a.semester, a.tahun_ajaran, b.bulan, b.kd_id, b.week1, b.week2, b.week3, b.week4, b.week5  
		FROM `trx_prosem` a
		JOIN trx_prosem_detail b
		ON a.id=b.id_head
		WHERE a.jenjang='".$this->session->userdata('adm_jenjang')."'
		AND a.kelas_id='".$data['txtKelas']."'
		AND a.mapel_id='".$data['txtMapel']."'
		AND a.semester='".$data['txtSemester']."'
		AND a.tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'
		AND b.bulan='".$data['txtBulan']."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	private function cek_null($nilai) {
		$hasil = $nilai;
		if(empty($nilai)) {
			$hasil = "NULL";
		}
		return $hasil;
	}
	
}
?>