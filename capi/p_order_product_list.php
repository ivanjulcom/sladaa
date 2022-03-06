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
 
  $sel = $mysqli->query("select * from tbl_order where uid=".$uid." and id=".$order_id."");
  
  
  $result = array();
  $pp = array();
  while($row = $sel->fetch_assoc())
    {
		$pp['order_id'] = $row['id'];
		$pp['order_date'] = $row['odate'];
		$pname = $mysqli->query("select * from tbl_payment_list where id=".$row['p_method_id']."")->fetch_assoc();
		
		$pp['p_method_name'] = $pname['title'];
		$pp['customer_address'] = $row['address'];
		$pp['Delivery_charge'] = $row['d_charge'];
		$pp['Coupon_Amount'] = $row['cou_amt'];
		$pp['Order_Total'] = $row['o_total'];
		$pp['Order_SubTotal'] = $row['subtotal'];
		$pp['Order_Transaction_id'] = $row['trans_id'];
		$pp['Additional_Note'] = $row['a_note'];
		$pp['Order_Status'] = $row['o_status'];
		$pp['Order_flow_id'] = $row['order_status'];
		$pp['comment_reject'] = $row['comment_reject'];
		$fetchpro = $mysqli->query("select *  from tbl_order_product where oid=".$row['id']."");
		$kop = array();
		$pdata = array();
		while($jpro = $fetchpro->fetch_assoc())
		{
			$kop['Product_quantity'] = $jpro['pquantity'];
			$kop['Product_name'] = $jpro['ptitle'];
			$kop['Product_discount'] = $jpro['pdiscount'];
			$kop['Product_image'] = $jpro['pimg'];
			$kop['Product_price'] = $jpro['pprice'];
			$kop['Product_variation'] = $jpro['ptype'];
			$discount = $jpro['pprice'] * $jpro['pdiscount']*$jpro['pquantity'] /100;
			
			$kop['Product_total'] = ($jpro['pprice'] * $jpro['pquantity']) - $discount;
			$pdata[] = $kop;
		}
		$pp['Order_Product_Data'] = $pdata;
		$result[] = $pp;
	}
	
    $returnArr = array("OrderProductList"=>$result,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Product Get successfully!");
}
echo json_encode($returnArr);

?>