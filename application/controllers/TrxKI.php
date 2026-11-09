<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrxKI extends CI_Controller {

	public function index()
	{
		$this->load->model('TrxKI_model');
		$data['kelas_guru'] = $this->TrxKI_model->kelas_guru();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('TrxKI_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function cari_mapel_guru() {
		$this->load->model('TrxKI_model');
		$mapel_guru = $this->TrxKI_model->mapel_guru($_POST);
		echo json_encode($mapel_guru->result());
	}
	
	public function simpan() {
		//print_r($_POST);
		$this->load->model('TrxKI_model');
		$hasil = $this->TrxKI_model->simpan($_POST);
		echo $hasil;
	}
	public function update() {
		//print_r($_POST);
		$this->load->model('TrxKI_model');
		$hasil = $this->TrxKI_model->update($_POST);
		echo $hasil;
	}
	
	public function cari_isi_ki() {
		$this->load->model('TrxKI_model');
		$cari_isi_ki = $this->TrxKI_model->cari_isi_ki($_POST);
		echo json_encode($cari_isi_ki->result());
	}
	
	public function cari_data_ki() {
		$this->load->model('TrxKI_model');
		$cari_data_ki = $this->TrxKI_model->cari_data_ki($_POST);
		echo json_encode($cari_data_ki->result());
	}
	
}
?>