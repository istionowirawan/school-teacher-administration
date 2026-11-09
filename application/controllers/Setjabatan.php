<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setjabatan extends CI_Controller {

	public function index()
	{
		$this->load->model('Setjabatan_model');
		$data['data_jabatan'] = $this->Setjabatan_model->data_jabatan();
		$data['data_guru'] = $this->Setjabatan_model->data_guru();
		$data['data_kelas'] = $this->Setjabatan_model->data_kelas();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Setjabatan_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function simpan_setjabatan() {
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		$this->load->model('Setjabatan_model');
		$hasil = $this->Setjabatan_model->simpan_setjabatan($_POST);
		echo $hasil;
	}
	
}
?>