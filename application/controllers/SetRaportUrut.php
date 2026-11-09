<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetRaportUrut extends CI_Controller {

	public function index()
	{
		$this->load->model('SetRaportUrut_model');
		$data['kelas_jenjang'] = $this->SetRaportUrut_model->kelas_jenjang();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('SetRaportUrut_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function SetRaportUrut_detail() {
		$kelas = $this->uri->segment(3);
		
		$this->load->model('SetRaportUrut_model');
		$data['data_mapel'] = $this->SetRaportUrut_model->data_mapel($kelas);
		$data['data_kelompok'] = $this->SetRaportUrut_model->data_kelompok();
		$data['data_set_raport_urut'] = $this->SetRaportUrut_model->data_set_raport_urut($kelas);
		$data['kelas_pilih'] = $kelas;
		
		$this->load->view('SetRaportUrut_detail',$data);
	}
	
	public function updateRaportUrut() {
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		
		$this->load->model('SetRaportUrut_model');
		$hasil = $this->SetRaportUrut_model->updateRaportUrut($_POST);
		echo $hasil;
		
	}
	
}