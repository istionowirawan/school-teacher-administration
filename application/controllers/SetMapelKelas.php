<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetMapelKelas extends CI_Controller {

	public function index()
	{
		$this->load->model('SetMapelKelas_model');
		$data['kelas_jenjang'] = $this->SetMapelKelas_model->kelas_jenjang();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('SetMapelKelas_view',$data);
		$this->load->view('Footer_view');
	}
	 
	public function SetMapelKelas_detail() {
		$kelas = $this->uri->segment(3);
		$this->load->model('SetMapelKelas_model');
		$data['data_kelas_paralel'] = $this->SetMapelKelas_model->data_kelas_paralel($kelas);
		$data['data_mapel'] = $this->SetMapelKelas_model->data_mapel();
		$data['data_setMapelKelas'] = $this->SetMapelKelas_model->data_setMapelKelas($kelas);
		$data['kelas_pilih'] = $kelas;
		
		$this->load->view('SetMapelKelas_detail',$data);
	}
	
	public function simpan_mapelkelas() {
		$this->load->model('SetMapelKelas_model');
		$hasil = $this->SetMapelKelas_model->simpan_mapelkelas($_POST);
		echo $hasil;
	}
	
}
?>