<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['uid'] == '' or $data['order_id'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	 $order_id = $mysqli->real_escape_string($data['order_id']);
 $uid =  $mysqli->real_escape_string($data['uid']);
 
  $sel = $mysqli->query("select * from pkg_order where uid=".$uid." and id=".$order_id."");
  
  
  $result = array();
  $pp = array();
  while($row = $sel->fetch_assoc())
    {
		$pp['order_id'] = $row['id'];
		$pp['order_date'] = $row['odate'];
		$pname = $mysqli->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
		
		$pp['p_method_name'] = $pname['title'];
		$pp['customer_paddress'] = $row['paddress'];
		$pp['customer_pmobile'] = $row['pmobile'];
		$pp['customer_daddress'] = $row['daddress'];
		$pp['customer_dmobile'] = $row['dmobile'];
		$pp['description'] = $row['description'];
		$pp['distance'] = $row['distance'];
		$pp['Delivery_charge'] = $row['d_charge'];
		$pp['photos'] = explode(',',$row['photos']);
		$pp['Order_Transaction_id'] = $row['trans_id'];
		$pp['Order_Status'] = $row['o_status'];
		$pp['comment_reject'] = $row['comment_reject'];
		$pp['category'] = $row['category'];
		$pp['Order_flow_id'] = $row['order_status'];
		$result[] = $pp;
	}
	
    $returnArr = array("OrderProductList"=>$result,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Product Get successfully!");
}
echo json_encode($returnArr);

?>