<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrxKD extends CI_Controller {

	public function index()
	{
		$this->load->model('TrxKD_model');
		$data['kelas_guru'] = $this->TrxKD_model->kelas_guru();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('TrxKD_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function load_ms_ranah() {
		$this->load->model('TrxKD_model');
		$msRanah = $this->TrxKD_model->load_ms_ranah($_POST);
		echo json_encode($msRanah->result());
	}
	
	public function cari_mapel_guru() {
		$this->load->model('TrxKD_model');
		$mapel_guru = $this->TrxKD_model->mapel_guru($_POST);
		echo json_encode($mapel_guru->result());
	}
	
	public function cari_ki_input() {
		$this->load->model('TrxKD_model');
		$cari_ki_input = $this->TrxKD_model->cari_ki_input($_POST);
		echo json_encode($cari_ki_input->result());
	}
	
	public function simpan() {
		//print_r($_POST);
		$this->load->model('TrxKD_model');
		$hasil = $this->TrxKD_model->simpan($_POST);
		echo $hasil;
	}
	public function update() {
		//print_r($_POST);
		$this->load->model('TrxKD_model');
		$hasil = $this->TrxKD_model->update($_POST);
		echo $hasil;
	}
	
	public function cari_isi_ki() {
		$this->load->model('TrxKD_model');
		$cari_isi_ki = $this->TrxKD_model->cari_isi_ki($_POST);
		echo json_encode($cari_isi_ki->result());
	}
	
	public function cari_data_kd() {
		$this->load->model('TrxKD_model');
		$cari_isi_kd = $this->TrxKD_model->cari_data_kd($_POST);
		echo json_encode($cari_isi_kd->result());
	}
	
	public function cek_data_kd() {
		$this->load->model('TrxKD_model');
		$cek_data_kd = $this->TrxKD_model->cek_data_kd($_POST);
		echo json_encode($cek_data_kd->result());
	}
	
	public function detail_indi() {
		$this->load->model('TrxKD_model');
		$detail_indi = $this->TrxKD_model->detail_indi($_POST);
		echo json_encode($detail_indi->result());
	}
	
	public function detail_ruang() {
		$this->load->model('TrxKD_model');
		$detail_ruang = $this->TrxKD_model->detail_ruang($_POST);
		echo json_encode($detail_ruang->result());
	}
	
}
?>