<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
  $mysqli = new mysqli("localhost", "root", "", "dbsladaa");
  $mysqli->set_charset("utf8mb4");
} catch(Exception $e) {
  error_log($e->getMessage());
  //Should be a message a typical user could understand
}
    
    $set = $mysqli->query("SELECT * FROM `setting`")->fetch_assoc();
	$main = $mysqli->query("SELECT * FROM `tbl_include`")->fetch_assoc();
	date_default_timezone_set($set['timezone']);
	if(isset($_SESSION['ltype']))
	{
	if($_SESSION['ltype'] == 'Vendor')
	{
		$sdata = $mysqli->query("select * from vendor where email='".$_SESSION['username']."'")->fetch_assoc();
	}
	
	if($_SESSION['ltype'] == 'D_boy')
	{
		$ddata = $mysqli->query("select * from rider where email='".$_SESSION['username']."'")->fetch_assoc();
	}
	}
?>