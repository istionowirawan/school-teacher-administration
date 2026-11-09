<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MsKepsek extends CI_Controller {

	public function index()
	{
		$this->load->model('MsKepsek_model');
		$data['data_kepsek'] = $this->MsKepsek_model->data_kepsek();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('MsKepsek_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function simpan_kepsek() {
		$this->load->model('MsKepsek_model');
		$hasil = $this->MsKepsek_model->simpan_kepsek($_POST);
		echo $hasil;
	}
	
	public function update_kepsek() {
		$this->load->model('MsKepsek_model');
		$hasil = $this->MsKepsek_model->update_kepsek($_POST);
		echo $hasil;
	}
	
	
}
?>