<?php
foreach($data_information->result() as $row) {
	echo "<div class='row'>";
		echo "<div class='col-md-1 col-sm-2 col-xs-3' >";
		if($row->photo=="") {
			echo "<img src='images/guest_male_256.png' class='img-responsive img-circle' alt='Photo System'>";
		} else {
			echo "<img src='../HRIS/asset/employee_photos/".$row->photo."' class='img-responsive' alt='User Image' >";
		}
		echo "</div>";
		
		echo "<div class='col-md-11 col-sm-10 col-xs-9' >";
		echo "<div style='font-size:16px;font-weight:bold;' >".$row->username."</div>";
		echo "<div>".nl2br($row->info)."</div>";
		
		echo "<div style='color:#bbbdbf;' >".date("d F Y h:m:s", strtotime($row->date_input))."</div>";
		echo "</div>";
	echo "</div>";
	
	echo "<hr>";
}

?>

