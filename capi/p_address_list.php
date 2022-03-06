<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];
if($uid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$count = $mysqli->query("select * from tbl_address where uid=".$uid."")->num_rows;
	if($count != 0)
	{
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
		$p['pincode_id'] = $charge['id'];
		$p['landmark'] = $adata['landmark'];
		$p['type'] = $adata['type'];
		if($adata['type'] == 'Office')
		{
			$p['address_image'] = 'sladaa/assets/category/catimg/1643527835.png';
		}
		else if($adata['type'] == 'Rumah')
		{
			$p['address_image'] = 'sladaa/assets/category/catimg/1643527835.png';
		}
		else
		{
			$p['address_image'] = 'sladaa/assets/category/catimg/1643527835.png';
		}
		$q[] = $p;
	}
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Address List Get Successfully!!!","AddressList"=>$q);
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Address List Not Found!!");
	}
}
echo json_encode($returnArr);
?>