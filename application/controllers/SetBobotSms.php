<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetBobotSms extends CI_Controller {

	public function index()
	{
		$this->load->model('SetBobotSms_model');
		$data['data_bobotNilai'] = $this->SetBobotSms_model->data_bobotNilai();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('SetBobotSms_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function simpan_setBobot() {
		$this->load->model('SetBobotSms_model');
		$hasil = $this->SetBobotSms_model->simpan_setBobot($_POST);
		echo $hasil;
	}
	
}
?>