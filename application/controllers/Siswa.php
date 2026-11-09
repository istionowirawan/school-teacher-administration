<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function index()
	{
		$this->load->model('Siswa_model');
		$data['data_siswa_psb'] = $this->Siswa_model->data_siswa_psb();
		$data['data_siswa_aktif'] = $this->Siswa_model->data_siswa_aktif();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Siswa_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function tambah_siswa() {
		//print_r($_POST);
		$this->load->model('Siswa_model');
		$hasil = $this->Siswa_model->tambah_siswa($_POST);
		echo $hasil;
	}
	
	public function active_siswa() {
		//print_r($_POST);
		$this->load->model('Siswa_model');
		$hasil = $this->Siswa_model->active_siswa($_POST);
		echo $hasil;
	}
	
	public function tampil_siswa_aktif() {
		$this->load->model('Siswa_model');
		$data['data_siswa_aktif'] = $this->Siswa_model->data_siswa_aktif();
		$this->load->view('Siswa_aktif',$data);
	}
	
	public function posting_guru() {
		$this->load->model('Gurukaryawan_model');
		$hasil = $this->Gurukaryawan_model->posting_guru($_POST);
		echo $hasil;
	}
	
	
}
?>