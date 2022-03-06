<?php 
require 'db.php';
 ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);


$rid = $data['rid'];
if ($rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$pok = array();
	$p =0 ;
	$riderdata = $mysqli->query("select * from rider where id=".$rid."")->fetch_assoc();
	$pok['total_complete_order'] = $riderdata['complete'];
	$pok['total_receive_order'] = $mysqli->query("select * from tbl_order where rid=".$riderdata['id']."")->num_rows;
	$pok['total_reject_order'] = $riderdata['reject'];
	$sale = $mysqli->query("select sum(`o_total`) as total_earn from tbl_order where rid=".$rid." and o_status='completed'")->fetch_assoc();
     if($sale['total_earn'] == '')
	 {
		 $p =0;
	 }
	 else 
	 {
		$p = number_format((float)$sale['total_earn'], 2, '.', '');
	 }
	 $pok['total_sale'] = $p;
	 $returnArr = array("order_data"=>$pok,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Status Get Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>
