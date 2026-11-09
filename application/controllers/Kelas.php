<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	public function index()
	{
		$this->load->model('Kelas_model');
		$data['data_kelas'] = $this->Kelas_model->data_kelas();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Kelas_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function simpan_kelas() {
		//print_r($_POST);
		$this->load->model('Kelas_model');
		$hasil = $this->Kelas_model->simpan_kelas($_POST);
		echo $hasil;
	}
	
}
?>