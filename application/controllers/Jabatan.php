<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	public function index()
	{
		$this->load->model('Jabatan_model');
		$data['data_jabatan'] = $this->Jabatan_model->data_jabatan();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Jabatan_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function simpan_jabatan() {
		//print_r($_POST);
		$this->load->model('Jabatan_model');
		$hasil = $this->Jabatan_model->simpan_jabatan($_POST);
		echo $hasil;
	}
	
	public function update_jabatan() {
		//print_r($_POST);
		$this->load->model('Jabatan_model');
		$hasil = $this->Jabatan_model->update_jabatan($_POST);
		echo $hasil;
	}
	
}
?>