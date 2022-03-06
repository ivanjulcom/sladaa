<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
 
$uid = $data['uid'];
if($uid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	$pkgc = array();
	$pkgb = array();
	
	
	


$banners = $mysqli->query("select * from pkg_banner");
while($row = $banners->fetch_assoc())
{
    $pkgb[] = $row;
}

$car = $mysqli->query("select * from pkg_category");
while($row = $car->fetch_assoc())
{
    $pkgc[] = $row;
}



$main_data = $mysqli->query("select ukms,utprice,afprice from setting")->fetch_assoc();

$kp = array("PriceData"=>$main_data,"Package_Category"=>$pkgc,"Package_Banner"=>$pkgb);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Package Delivery Data Get Successfully!","ResultData"=>$kp);
}
echo json_encode($returnArr);