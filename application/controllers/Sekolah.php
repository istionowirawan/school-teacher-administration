<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

	public function index()
	{
		$this->load->model('Sekolah_model');
		$data['data_sekolah'] = $this->Sekolah_model->data_sekolah();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Sekolah_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function update_sekolah() {
		$this->load->model('Sekolah_model');
		$hasil = $this->Sekolah_model->update_sekolah($_POST);
		echo $hasil;
	}
	
}
?>