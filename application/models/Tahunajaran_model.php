<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Tahunajaran_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function data_ta() {
		$q = "SELECT * FROM ms_tahunajaran";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function update_tahunajaran($data) {
		$q2 = "UPDATE ms_tahunajaran SET aktif='0'";
		$query2 = $this->db->query($q2);
		
		if($query2) {
			$q = "UPDATE ms_tahunajaran SET aktif='1' WHERE id='".$data['idTA']."'";
			$query = $this->db->query($q);
			
			$this->session->set_userdata("adm_tahunajaran",$data['ta']);
			$this->session->set_userdata("adm_sms",$data['sms']);
			
			return $query;
		} else {
			return $query2;
		}
	}
	
	
}
?>