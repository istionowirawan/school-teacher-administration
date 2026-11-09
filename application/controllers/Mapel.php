<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

	public function index()
	{
		$this->load->model('Mapel_model');
		$data['data_mapel'] = $this->Mapel_model->data_mapel();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Mapel_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function cek_kode_mapel() {
		$this->load->model('Mapel_model');
		$hasil = $this->Mapel_model->cek_kode_mapel($_POST);
		echo $hasil;
	}
	
	public function simpan_mapel() {
		//print_r($_POST);
		$this->load->model('Mapel_model');
		$hasil = $this->Mapel_model->simpan_mapel($_POST);
		echo $hasil;
	}
	
	public function update_mapel() {
		//print_r($_POST);
		$this->load->model('Mapel_model');
		$hasil = $this->Mapel_model->update_mapel($_POST);
		echo $hasil;
	}
	
	public function update_aktif() {
		$this->load->model('Mapel_model');
		$hasil = $this->Mapel_model->update_aktif($_POST);
		echo $hasil;
	}
	
}
?>