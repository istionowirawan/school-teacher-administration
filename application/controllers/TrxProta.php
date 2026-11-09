<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrxProta extends CI_Controller {

	public function index()
	{
		$this->load->model('TrxProta_model');
		$data['kelas_guru'] = $this->TrxProta_model->kelas_guru();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('TrxProta_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function load_ms_ranah() {
		$this->load->model('TrxProta_model');
		$msRanah = $this->TrxProta_model->load_ms_ranah($_POST);
		echo json_encode($msRanah->result());
	}
	
	public function cari_mapel_guru() {
		$this->load->model('TrxProta_model');
		$mapel_guru = $this->TrxProta_model->mapel_guru($_POST);
		echo json_encode($mapel_guru->result());
	}
	
	public function load_detail_prota() {
		//print_r($_POST);
		$this->load->model('TrxProta_model');
		$data['detail_prota'] = $this->TrxProta_model->load_detail_prota($_POST);
		$this->load->view('TrxProta_detail',$data);
	}
	
	public function simpan() {
		//print_r($_POST);
		$this->load->model('TrxProta_model');
		$hasil = $this->TrxProta_model->simpan($_POST);
		echo $hasil;
	}
	public function update() {
		//print_r($_POST);
		$this->load->model('TrxProta_model');
		$hasil = $this->TrxProta_model->update($_POST);
		echo $hasil;
	}
	
	
}
?>