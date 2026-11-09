<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RptKI extends CI_Controller {

	public function index()
	{
		$this->load->model('TrxKI_model');
		$data['data_trx_ki'] = $this->TrxKI_model->data_trx_ki();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('RptKi_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function cari_mapel_guru() {
		$this->load->model('TrxKI_model');
		$mapel_guru = $this->TrxKI_model->mapel_guru($_POST);
		echo json_encode($mapel_guru->result());
	}
	
	
}
?>