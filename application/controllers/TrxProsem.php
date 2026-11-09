<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TrxProsem extends CI_Controller {

	public function index()
	{
		$this->load->model('TrxProsem_model');
		$data['kelas_guru'] = $this->TrxProsem_model->kelas_guru();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('TrxProsem_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function cari_mapel_guru() {
		$this->load->model('TrxProsem_model');
		$mapel_guru = $this->TrxProsem_model->mapel_guru($_POST);
		echo json_encode($mapel_guru->result());
	}
	
	public function load_detail_Prosem() {
		//print_r($_POST);
		$this->load->model('TrxProsem_model');
		$data['detail_prosem'] = $this->TrxProsem_model->load_detail_prosem($_POST);
		$data['smstr_pilih'] = $_POST['txtSemester'];
		$this->load->view('TrxProsem_detail',$data);
	}
	
	public function simpan() {
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		$this->load->model('TrxProsem_model');
		$hasil = $this->TrxProsem_model->simpan($_POST);
		echo $hasil;
	}
	
	public function load_isi_prosem() {
		$this->load->model('TrxProsem_model');
		$isiprosem = $this->TrxProsem_model->load_isi_prosem($_POST);
		//print_r($isiprosem);
		echo json_encode($isiprosem->result());
	}
	
	
}
?>