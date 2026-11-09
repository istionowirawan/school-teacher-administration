<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function jml_information() {
		$q = "SELECT COUNT(id) as jml FROM trx_information";
		$query = $this->db->query($q);
		return $query;
	}
	
	
	public function data_information($hal) {
		$hal = ($hal-1) * 5;
		
		$q = "SELECT * FROM trx_information ORDER BY date_input DESC LIMIT ".$hal.",5";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function simpan_information($data) {
		$q="INSERT INTO trx_information (info, user_input, username, photo, date_input)
		VALUES 
		('".addslashes($data['txtInfoDesc'])."',
		'".$this->session->userdata('nilaismp_userid')."',
		'".$this->session->userdata('nilaismp_username')."',
		'".$this->session->userdata('nilaismp_photo')."',
		now())";
		$query = $this->db->query($q);
		return $query;
	}
	
}
?>