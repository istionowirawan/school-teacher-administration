<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RptKD extends CI_Controller {

	public function index()
	{
		$this->load->model('TrxKD_model');
		$data['data_trx_kd'] = $this->TrxKD_model->data_trx_kd();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('RptKD_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function cari_mapel_guru() {
		$this->load->model('TrxKD_model');
		$mapel_guru = $this->TrxKD_model->mapel_guru($_POST);
		echo json_encode($mapel_guru->result());
	}
	
	public function detail_indi() {
		$this->load->model('TrxKD_model');
		$detail_indi = $this->TrxKD_model->detail_indi($_POST);
		echo json_encode($detail_indi->result());
	}
	
	public function detail_ruang() {
		$this->load->model('TrxKD_model');
		$detail_ruang = $this->TrxKD_model->detail_ruang($_POST);
		echo json_encode($detail_ruang->result());
	}
	
}
?>