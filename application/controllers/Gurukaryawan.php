<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gurukaryawan extends CI_Controller {

	public function index()
	{
		$this->load->model('Gurukaryawan_model');
		$data['data_guru_hris'] = $this->Gurukaryawan_model->data_guru_hris();
		$data['data_guru_aktif'] = $this->Gurukaryawan_model->data_guru_aktif();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Gurukaryawan_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function tambah_guru() {
		//print_r($_POST);
		$this->load->model('Gurukaryawan_model');
		$hasil = $this->Gurukaryawan_model->tambah_guru($_POST);
		echo $hasil;
	}
	
	public function active_guru() {
		//print_r($_POST);
		$this->load->model('Gurukaryawan_model');
		$hasil = $this->Gurukaryawan_model->active_guru($_POST);
		echo $hasil;
	}
	
	public function tampil_gurukaryawan_aktif() {
		$this->load->model('Gurukaryawan_model');
		$data['data_guru_aktif'] = $this->Gurukaryawan_model->data_guru_aktif();
		$this->load->view('Gurukaryawan_aktif',$data);
	}
	
	public function posting_guru() {
		$this->load->model('Gurukaryawan_model');
		$hasil = $this->Gurukaryawan_model->posting_guru($_POST);
		echo $hasil;
	}
	
}
?>