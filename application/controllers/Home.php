<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model('Home_model');
		$data['jml_information'] = $this->Home_model->jml_information();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Home_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function data_information()
	{
		$hal = $_GET['hal'];
		
		$this->load->model('Home_model');
		$data['data_information'] = $this->Home_model->data_information($hal);
		$this->load->view('Home_info',$data);
	}
	
	public function simpan_information() {
		$this->load->model('Home_model');
		$hasil = $this->Home_model->simpan_information($_POST);
		echo $hasil;
	}
	
	
	public function closing() {
		$this->load->model('Home_model');
		$data['jml_information'] = $this->Home_model->jml_information();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Home_closing',$data);
		$this->load->view('Footer_view');
	}
	
}
?>