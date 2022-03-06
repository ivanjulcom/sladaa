<?php 
require 'db.php';
 
$data = json_decode(file_get_contents('php://input'), true);


$sid = $data['sid'];
if ($sid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	$p =0 ;
	$riderdata = $mysqli->query("select * from vendor where id=".$sid."")->fetch_assoc();
	$total_pending_order = $mysqli->query("select * from tbl_order where o_status='Pending' and sid=".$sid."")->num_rows;
	$total_process_order = $mysqli->query("select * from tbl_order where o_status='Processing' and sid=".$sid."")->num_rows;
	$total_on_route_order = $mysqli->query("select * from tbl_order where o_status='On Route' and sid=".$sid."")->num_rows;
	$total_complted_order= $mysqli->query("select * from tbl_order where o_status='Completed' and sid=".$sid."")->num_rows;
	$total_Cancelled_order = $mysqli->query("select * from tbl_order where o_status='Cancelled' and sid=".$sid."")->num_rows;
	$total_order = $mysqli->query("select * from tbl_order where sid=".$sid."")->num_rows;
	$total_dboy = $mysqli->query("select * from rider where aid=".$sid."")->num_rows;
	$total_home_section = $mysqli->query("select * from tbl_home_section where sid=".$sid."")->num_rows;
	$sales  = $mysqli->query("select sum(o_total) as full_total from tbl_order where o_status='completed' and  sid=".$sid."")->fetch_assoc();
             $payout =   $mysqli->query("select sum(amt) as full_payout from payout_setting where vid=".$sid."")->fetch_assoc();
			 
	$bs = 0;
				 if($sales['full_total'] == '')
				 {
					 $p = $bs;
					 }
					 else 
					 {
						 $p = number_format((float)($sales['full_total'] - ($sdata['commission']/100)) - $payout['full_payout'], 2, '.', ''); 
						 }
						 
	 $total_sale = $p;
	 
	 $papi = array(array("title"=>"Total Pending Order","report_data"=>$total_pending_order,"imgurl"=>$url),array("title"=>"Total Process Order","report_data"=>$total_process_order,"imgurl"=>$url),array("title"=>"Total On Route Order","report_data"=>$total_on_route_order,"imgurl"=>$url),array("title"=>"Total Completed Order","report_data"=>$total_complted_order,"imgurl"=>$url),array("title"=>"Total Cancelled Order","report_data"=>$total_Cancelled_order,"imgurl"=>$url),array("title"=>"Total Order","report_data"=>$total_order,"imgurl"=>$url),array("title"=>"Total Delivery Boy","report_data"=>$total_dboy,"imgurl"=>$url),array("title"=>"Total Home Section","report_data"=>$total_home_section,"imgurl"=>$url),array("title"=>"Total Sales","report_data"=>floatval($total_sale),"imgurl"=>$url));
	 $returnArr = array("store_report_data"=>$papi,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Status Get Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>
