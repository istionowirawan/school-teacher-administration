<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Closing extends CI_Controller {

	public function index()
	{
		$this->load->model('Closing_model');
		$data['history_closing'] = $this->Closing_model->history_closing();
		
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Closing_view',$data);
		$this->load->view('Footer_view');
	}
	
	public function update_closing() {
		$this->load->model('Closing_model');
		$hasil = $this->Closing_model->update_closing($_POST);
		echo $hasil;
	}
	
}
?>