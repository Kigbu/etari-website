<?php
class Admin {
		
	// time function	
	public static function moment(){
	$dt = time();
	$mysql_datetime = strftime("%Y-%m-%d %H:%M:%S", $dt);
	$newDateTime = date('d-M-Y h:i A', strtotime($mysql_datetime));
	return $newDateTime;
	}


}