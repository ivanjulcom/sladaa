<?php 
require 'db.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);
if($data['rid'] == '' or $data['status'] == '')
{ 
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
 $rid =  strip_tags(mysqli_real_escape_string($mysqli,$data['rid']));
 $status =  strip_tags(mysqli_real_escape_string($mysqli,$data['status']));
 
 if($status == 'Pending')
 {
  $sel = $mysqli->query("select * from pkg_order where rid=".$rid." and o_status !='Completed' and o_status !='Cancelled' order by id desc");
 }
 else if($status == 'Complete')
 {
	 $sel = $mysqli->query("select * from pkg_order where rid=".$rid." and o_status ='Completed'  order by id desc");
 }
 else 
 {
	 $sel = $mysqli->query("select * from pkg_order where rid=".$rid." and o_status ='Cancelled'  order by id desc");
 }
  if($sel->num_rows != 0)
  {
  $result = array();
  $pp = array();
  while($row = $sel->fetch_assoc())
    {
		$pp['order_id'] = $row['id'];
		$pp['order_date'] = $row['odate'];
		$pname = $mysqli->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
		
		$pp['Order_Total'] = $row['d_charge'];
		$pp['p_method_name'] = $pname['title'];
		$pp['customer_paddress'] = $row['paddress'];
		$pp['customer_pmobile'] = $row['pmobile'];
		$pp['customer_daddress'] = $row['daddress'];
		$pp['customer_dmobile'] = $row['dmobile'];
		$pp['description'] = $row['description'];
		$pp['distance'] = $row['distance'];
		$pp['sign'] = $row['sign'];
		$pp['Delivery_charge'] = $row['d_charge'];
		$pp['photos'] = explode(',',$row['photos']);
		$pp['Order_Transaction_id'] = $row['trans_id'];
		$pp['Order_Status'] = $row['o_status'];
		$pp['comment_reject'] = $row['comment_reject'];
		$pp['category'] = $row['category'];
		$result[] = $pp;
	}
   
   
      
            
    $returnArr = array("order_data"=>$result,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Package Order Get successfully!");
  }
  else 
  {
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"No ".$status." Package Order Found!");   
  }
}
echo json_encode($returnArr);