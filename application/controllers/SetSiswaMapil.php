<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetSiswaMapil extends CI_Controller {

	public function index()
	{
		$this->load->model('SetSiswaMapil_model');
		$data['data_subkelas'] = $this->SetSiswaMapil_model->data_subkelas();
		$data['data_mapil'] = $this->SetSiswaMapil_model->data_mapil();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('SetSiswaMapil_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function data_siswa_kelas() {
		$kelas = $this->uri->segment(3);
		$mapil = $this->uri->segment(4);
		//echo "==> ".$mapil;
		
		$this->load->model('SetSiswaMapil_model');
		$data['data_siswa_kelas'] = $this->SetSiswaMapil_model->data_siswa_kelas($kelas,$mapil);
		$data['data_mapel_guru'] = $this->SetSiswaMapil_model->data_mapel_guru($kelas,$mapil);
		$data['data_siswa_mapil'] = $this->SetSiswaMapil_model->data_siswa_mapil($kelas,$mapil);
		$data['kelas_pilih'] = $kelas;
		$data['mapil_pilih'] = $mapil;
		$this->load->view('SetSiswaMapil_detail',$data);
	}
	
	public function simpan_siswamapil() {
		$this->load->model('SetSiswaMapil_model');
		$hasil = $this->SetSiswaMapil_model->simpan_siswamapil($_POST);
		echo $hasil;
	}
	
}
?>