<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if($data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
	$uid = $data['uid'];
	$cartdata = $data['cartdata'];
	$cid = array();
	for($i=0;$i<count($cartdata);$i++)
{
$price = $cartdata[$i]['price'];
$discount = $cartdata[$i]['discount'];
$pincode = $cartdata[$i]['pincode'];
$check = $mysqli->query("select * from tbl_product_attribute where id=".$cartdata[$i]['aid']."");
$count = $check->num_rows;
$fetch = $check->fetch_assoc();
$pdata = $mysqli->query("select * from tbl_product where pincode=".$pincode."")->num_rows;
$checkv = $mysqli->query("select * from vendor where id=".$fetch['sid']." and (vstatus=0 or status=0)")->num_rows;

if($count == 0 or $fetch['ostock'] == 1 or $fetch['price'] != $price or $fetch['discount'] != $discount or $pdata == 0 or $checkv == 1)
{
	$cid[] = array("aid"=>$cartdata[$i]['aid']); 
}
else 
{
	
}
}
$cy = $mysqli->query("select * from tbl_address where uid=".$uid."");
	$p = array();
	$q = array();
	while($adata = $cy->fetch_assoc())
	{
		$p['id'] = $adata['id'];
		$p['uid'] = $adata['uid'];
		$p['hno'] = $adata['houseno'];
		$p['address'] = $adata['address'];
		$p['lat_map'] = $adata['lat_map'];
		$p['long_map'] = $adata['long_map'];
		$charge = $mysqli->query("select * from tbl_pincode where pincode='".$adata['pincode']."'")->fetch_assoc();
		$charges = $mysqli->query("select * from tbl_pincode where pincode='".$adata['pincode']."'");
		if($charges->num_rows !=0)
		{
			$p['IS_UPDATE_NEED'] = FALSE;
		}
		else 
		{
			$p['IS_UPDATE_NEED'] = TRUE;
		}
		$p['delivery_charge'] = $charge['d_charge'];
		$p['pincode'] = $adata['pincode'];
		$p['landmark'] = $adata['landmark'];
		$p['type'] = $adata['type'];
		$q[] = $p;
	}
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Validation Get Successfully!!!","CartValidateData"=>$cid,"AddressList"=>$q);	
}
echo json_encode($returnArr);
?>