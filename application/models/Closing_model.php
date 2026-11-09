<?php
function madSafety($string) {
	$string = stripslashes($string);
	$string = strip_tags($string);
	//$string = mysql_real_escape_string($string);
	return $string;
}

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Closing_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function history_closing() {
		$q = "SELECT * FROM ms_closing ORDER BY date_input DESC";
		$query = $this->db->query($q);
		return $query;
	}
	
	public function update_closing($data) {
		$stat = 0;
		if($data['status']==0) {
			$stat=1;
		}
		
		$q = "INSERT INTO ms_closing (status, user_input, date_input)
		VALUES (
		'".$stat."',
		'".$this->session->userdata('nilaismp_userid')."',
		now()
		)";
		$query = $this->db->query($q);
		
		if($query) {
			$kata = "System Nilai <b>DIBUKA</b> <br>Oleh : ".$this->session->userdata('nilaismp_username');
			if($stat==0) {
				$kata = "System Nilai telah <b>DITUTUP</b> <br>Oleh : ".$this->session->userdata('nilaismp_username');
			}
			
			$q2 = "INSERT INTO trx_information (info, user_input, username, photo, date_input)
			VALUES (
			'".$kata."',
			'System',
			'System',
			'',
			now()
			)";
			$query2 = $this->db->query($q2);
		}
		$this->session->set_userdata("nilaismp_closing",$stat);
		
		return $query;
	}
	
}
?>