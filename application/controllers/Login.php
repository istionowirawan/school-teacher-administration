<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('Header_view');
		$this->load->view('Menu_left');
		$this->load->view('Login_view');
		$this->load->view('Footer_view');
	}
	
	public function cek_username() {
		$this->load->model('Login_model');
		$hasilcek = $this->Login_model->cek_username($_POST);
		echo json_encode($hasilcek->result());
	}
	
	public function cek_login() {
		$this->load->model('Login_model');
		$hasilcek = $this->Login_model->cek_login($_POST);
		//print_r($hasilcek);
		
		if($hasilcek->num_rows()>0) {
			$nikguru = "";
			
			foreach ($hasilcek->result() as $row)
			{
				$newdata = array(
					'adm_userid'  =>  $row->emp_id,
					'adm_username'  =>  $row->emp_name,
					'adm_photo'  =>  $row->photo,
					'adm_sex'  =>  $row->sex,
					'adm_password'  =>  $row->password
				);
				$nikguru = $row->emp_id;
			}
			$this->session->set_userdata($newdata);
			
			//CEK TAHUN AJARAN
			$cek_ta = $this->Login_model->cek_ta();
			$this->session->set_userdata("adm_tahunajaran", $cek_ta->row(0)->tahunajaran);
			$this->session->set_userdata("adm_sms", $cek_ta->row(0)->semester);
			$this->session->set_userdata("adm_jenjang", $_POST['txtJenjang']);
			
			//CEK CLOSING SYSTEM
			$cek_closing = $this->Login_model->cek_closing();
			$this->session->set_userdata("adm_closing",$cek_closing->row(0)->status);
			
			//CEK JABATAN
			$cek_jabatan = $this->Login_model->cek_jabatan($nikguru);
			$jabatanPilih = "Guru";
			$statWali = 0;
			$kelasWali = 0;
			if($cek_jabatan->num_rows()>0) {
				$jabatanPilih = $cek_jabatan->row(0)->jabatan_alias;
				$statWali = $cek_jabatan->row(0)->wali_kelas;
				$kelasWali = $cek_jabatan->row(0)->kelas_wali;
			}
			$this->session->set_userdata("adm_jabguru",$jabatanPilih);
			$this->session->set_userdata("adm_statwali",$statWali);
			$this->session->set_userdata("adm_kelaswali",$kelasWali);
			
			//CEK JABATAN
			$cek_hak_akses = $this->Login_model->cek_hak_akses($jabatanPilih);
			if($cek_hak_akses->num_rows()>0) {
				$this->session->set_userdata("adm_mn_user",$cek_hak_akses->row(0)->mn_user);
				$this->session->set_userdata("adm_mn_msguru",$cek_hak_akses->row(0)->mn_msguru);
				$this->session->set_userdata("adm_mn_mssiswa",$cek_hak_akses->row(0)->mn_mssiswa);
				$this->session->set_userdata("adm_mn_setting",$cek_hak_akses->row(0)->mn_setting);
				$this->session->set_userdata("adm_mn_trx",$cek_hak_akses->row(0)->mn_trx);
				$this->session->set_userdata("adm_mn_laporan",$cek_hak_akses->row(0)->mn_laporan);
			} else {
				$this->session->set_userdata("adm_mn_user",0);
				$this->session->set_userdata("adm_mn_msguru",0);
				$this->session->set_userdata("adm_mn_mssiswa",0);
				$this->session->set_userdata("adm_mn_setting",0);
				$this->session->set_userdata("adm_mn_trx",0);
				$this->session->set_userdata("adm_mn_laporan",0);
			}
			
			echo "1";
		} else {
			echo "Password Anda salah";
		}
		
		/*$newdata = array(
			'adm_userid'  =>  '1',
			'adm_username'  =>  'admin',
			'adm_photo'  =>  'user.jpg',
			'adm_sex'  =>  '1',
			'adm_password'  =>  '123',
			'adm_tahunajaran' => '2017-2018',
			'adm_sms' => '1',
			'adm_closing' => '1',
		);
		$this->session->set_userdata($newdata);
		echo "1";
		*/
		
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}
	
}
?>