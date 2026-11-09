<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetSiswaKelas extends CI_Controller {

	public function index()
	{
		$this->load->model('SetSiswaKelas_model');
		$data['data_subkelas'] = $this->SetSiswaKelas_model->data_subkelas();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('SetSiswaKelas_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function data_siswa_aktif() {
		$kelas = $this->uri->segment(3);
		
		$this->load->model('SetSiswaKelas_model');
		$data['data_siswa_aktif'] = $this->SetSiswaKelas_model->data_siswa_aktif($kelas);
		$data['data_kelas'] = $this->SetSiswaKelas_model->data_kelas();
		$data['kelas_pilih'] = $kelas;
		$this->load->view('SetSiswaKelas_detail',$data);
	}
	
	public function simpan_siswakelas() {
		$this->load->model('SetSiswaKelas_model');
		$hasil = $this->SetSiswaKelas_model->simpan_siswakelas($_POST);
		echo $hasil;
	}
	
}
?>