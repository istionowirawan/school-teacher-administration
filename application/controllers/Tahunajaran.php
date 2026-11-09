<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahunajaran extends CI_Controller {

	public function index()
	{
		$this->load->model('Tahunajaran_model');
		$data['data_ta'] = $this->Tahunajaran_model->data_ta();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Tahunajaran_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function update_tahunajaran() {
		$this->load->model('Tahunajaran_model');
		$hasil = $this->Tahunajaran_model->update_tahunajaran($_POST);
		echo $hasil;
	}
	
}
?>