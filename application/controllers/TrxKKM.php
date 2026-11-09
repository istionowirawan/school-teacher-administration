<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrxKKM extends CI_Controller {

	public function index()
	{
		$this->load->model('TrxKKM_model');
		$data['kelas_guru'] = $this->TrxKKM_model->kelas_guru();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('TrxKKM_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function cari_mapel_guru() {
		$this->load->model('TrxKKM_model');
		$mapel_guru = $this->TrxKKM_model->mapel_guru($_POST);
		echo json_encode($mapel_guru->result());
	}
	
	
	public function cari_ki_kd_indi() {
		//print_r($_POST);
		$this->load->model('TrxKKM_model');
		$data['detail_kkm'] = $this->TrxKKM_model->cari_ki_kd_indi($_POST);
		$this->load->view('TrxKKM_detail',$data);
	}
	
	
	public function simpan() {
		//print_r($_POST);
		$this->load->model('TrxKKM_model');
		$hasil = $this->TrxKKM_model->simpan($_POST);
		echo $hasil;
	}
	
	
}
?>