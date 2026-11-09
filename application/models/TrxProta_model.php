<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class TrxProta_model extends CI_Model {
	
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
	
	public function load_ms_ranah($data) {
		$ranah = "Afektif";
		
		if($data['txtKI']==1 || $data['txtKI']==2) {
			$ranah = "Afektif";
		} else if ($data['txtKI']==3) {
			$ranah = "Kognitif";
		} else if ($data['txtKI']==4) {
			$ranah = "Psikomotorik";
		} else {
			$ranah = "Afektif";
		}
		$q = "SELECT * FROM ms_ranah WHERE ranah_jenis='".$ranah."'";
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
	
	
	public function load_detail_prota($data) {
		
		$q = "SELECT a.id, a.semester, a.ki, a.kelas_id, a.mapel_id, 
		a.deskripsi, a.jenjang, a.tahun_ajaran, c.tm_sm1, c.tm_sm2,
		(SELECT COUNT(*) as jml_kd FROM trx_kd b WHERE a.id=b.ki_id) as jml_kd 
		FROM `trx_ki` a 
		LEFT JOIN trx_prota c
		ON a.id=c.ki_id
		WHERE a.jenjang='".$this->session->userdata('adm_jenjang')."'
		AND a.kelas_id='".$data['txtKelas']."'
		AND a.mapel_id='".$data['txtMapel']."'
		AND a.tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'
		ORDER BY a.semester ASC, a.ki ASC";
		$query = $this->db->query($q);
		return $query;
		
	}
	
	
	
	
	
	
	
	
	
	
	public function simpan($data) {
		
		$query=0;
		for($a=0; $a<count($data['txtKi']); $a++) {
			
			$c = "SELECT id FROM trx_prota 
			WHERE kelas_id='".$data['txtKelas']."'
			AND mapel_id='".$data['txtMapel']."'
			AND tahun_ajaran='".$data['txtTa']."'
			AND ki_id='".$data['txtKi'][$a]."'";
			$cQuery = $this->db->query($c);
			
			if($cQuery->num_rows()>0) {
				
				$q = "UPDATE trx_prota SET 
				tm_sm1='".$data['txtHitungSm1'][$a]."', 
				tm_sm2='".$data['txtHitungSm2'][$a]."', 
				user_input='".$this->session->userdata('adm_userid')."', 
				date_input=now()
				WHERE kelas_id='".$data['txtKelas']."'
				AND mapel_id='".$data['txtMapel']."'
				AND tahun_ajaran='".$data['txtTa']."'
				AND ki_id='".$data['txtKi'][$a]."'";
				$query = $this->db->query($q);
				
			} else {
				$q = "INSERT INTO trx_prota (kelas_id, mapel_id, ki_id, tm_sm1, tm_sm2, tahun_ajaran, user_input, date_input)
				VALUES (
				'".$data['txtKelas']."',
				'".$data['txtMapel']."',
				'".$data['txtKi'][$a]."',
				'".$data['txtHitungSm1'][$a]."',
				'".$data['txtHitungSm2'][$a]."',
				'".$this->session->userdata('adm_tahunajaran')."',
				'".$this->session->userdata('adm_userid')."',
				now()
				)";
				$query = $this->db->query($q);
			}
		}
		
		return $query;
	}
	
	public function update($data) {
		
		$q = "UPDATE trx_kd SET 
		ki_id='".$data['txtKI']."', 
		kd='".$data['txtKD']."', 
		kd_desc='".addslashes($data['txtDescKD'])."', 
		ranah_kd='".addslashes($data['txtRanahKD'])."', 
		materi_pokok='".addslashes($data['txtMateri'])."', 
		tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."', 
		user_input='".$this->session->userdata('adm_userid')."', 
		date_input=now()
		WHERE id='".$data['txtId']."'";
		$query = $this->db->query($q);
		
			
		return $query;
	}
	
	public function cari_isi_ki($data) {
		$q = "SELECT * FROM trx_ki 
		WHERE ki='".$data['txtKI']."' 
		AND mapel_id='".$data['txtMapel']."'
		AND kelas_id='".$data['txtKelas']."'
		AND jenjang='".$this->session->userdata('adm_jenjang')."'
		AND tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'";
		$query = $this->db->query($q);
		
		return $query;
	}
	
	public function data_trx_kd() {
		$q = "SELECT a.id, b.semester, c.kelas, c.paralel, c.jurusan, (d.nama) as nama_mapel, b.ki, a.kd, a.kd_desc, a.ranah_kd, a.materi_pokok, a.tahun_ajaran 
		FROM trx_kd a
		JOIN trx_ki b
		ON a.ki_id=b.id
		JOIN ms_kelas c
		ON b.kelas_id=c.id
		JOIN ms_mapel d
		ON b.mapel_id=d.id
		WHERE a.tahun_ajaran='".$this->session->userdata('adm_tahunajaran')."'
		ORDER BY a.tahun_ajaran DESC, b.semester ASC, b.kelas_id ASC, b.mapel_id ASC";
		
		//echo $q;
		$query = $this->db->query($q);
		
		return $query;
	}
	
	public function detail_indi($data) {
		$q = "SELECT a.*, b.ranah_ket, b.ranah_jenis 
		FROM trx_kd_indi a
		LEFT JOIN ms_ranah b
		ON a.indi_ranah=b.ranah_kode
		WHERE a.kd_id='".$data['id']."' 
		ORDER BY a.indi_no ASC";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function detail_ruang($data) {
		$q = "SELECT a.*
		FROM trx_kd_ruang a
		WHERE a.kd_id='".$data['id']."' 
		ORDER BY a.ruang_no ASC";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function cari_data_kd($data) {
		$q = "SELECT a.*, b.semester, (b.ki) as ki_no, b.kelas_id, b.mapel_id, b.tahun_ajaran  
		FROM trx_kd a
		JOIN trx_ki b
		ON a.ki_id=b.id
		WHERE a.id='".$data['id']."'";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function cek_data_kd($data) {
		$q = "SELECT a.*, b.semester, (b.ki) as ki_no, b.kelas_id, b.mapel_id, b.tahun_ajaran  
		FROM trx_kd a
		JOIN trx_ki b
		ON a.ki_id=b.id
		WHERE a.ki_id='".$data['txtKIid']."'
		AND a.kd='".$data['txtKD']."'";
		$query = $this->db->query($q);
		return $query;
	}
}
?>