<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrxSilabus extends CI_Controller {

	public function index()
	{
		$this->load->model('TrxSilabus_model');
		$data['kelas_guru'] = $this->TrxSilabus_model->kelas_guru();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('TrxSilabus_view',$data);
		$this->load->view('Footer_view');
	}
	
	
	public function cari_mapel_guru() {
		$this->load->model('TrxSilabus_model');
		$mapel_guru = $this->TrxSilabus_model->mapel_guru($_POST);
		echo json_encode($mapel_guru->result());
	}
	
	public function cari_ki() {
		//print_r($_POST);
		$this->load->model('TrxSilabus_model');
		$hasil_ki = $this->TrxSilabus_model->cari_ki($_POST);
		echo json_encode($hasil_ki->result());
	}
	
	public function cari_kd() {
		//print_r($_POST);
		$this->load->model('TrxSilabus_model');
		$hasil_kd = $this->TrxSilabus_model->cari_kd($_POST);
		echo json_encode($hasil_kd->result());
	}
	
	
	public function load_detail_silabus() {
		$this->load->model('TrxSilabus_model');
		$data['db_life_skill'] = $this->TrxSilabus_model->db_life_skill();
		$data['db_confucius'] = $this->TrxSilabus_model->db_confucius();
		$data['db_pendkar'] = $this->TrxSilabus_model->db_pendkar();
		$data['db_indi'] = $this->TrxSilabus_model->db_indi	($_POST);
		
		$data['silabus_detail'] = $this->TrxSilabus_model->load_silabus_detail($_POST);
		$data['silabus_indi'] = $this->TrxSilabus_model->load_silabus_indi($_POST);
		$data['silabus_tujuan'] = $this->TrxSilabus_model->load_silabus_tujuan($_POST);
		
		$this->load->view('TrxSilabus_detail',$data);
	}
	
	
	public function simpan() {
		//print_r($_POST);
		$this->load->model('TrxSilabus_model');
		$hasil = $this->TrxSilabus_model->simpan($_POST);
		echo $hasil;
	}
	
	
}
?>