<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetMapelGuru extends CI_Controller {

	public function index()
	{
		$this->load->model('SetMapelGuru_model');
		$data['data_subkelas'] = $this->SetMapelGuru_model->data_subkelas();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('SetMapelGuru_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function detail_MapelGuru() {
		$idkelas = $this->uri->segment(3);
		$this->load->model('SetMapelGuru_model');
		$data['data_setMapelKelas'] = $this->SetMapelGuru_model->data_setMapelKelas($idkelas);
		$data['data_guru'] = $this->SetMapelGuru_model->data_guru();
		//$data['data_setMapelGuru'] = $this->SetMapelGuru_model->data_setMapelGuru($idkelas);
		$this->load->view('SetMapelGuru_detail',$data);
	}
	
	public function simpan_mapelguru() {
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		
		$this->load->model('SetMapelGuru_model');
		$hasil = $this->SetMapelGuru_model->simpan_mapelguru($_POST);
		echo $hasil;
	}
	
}
?>