<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);

if($data['uid'] == '' or $data['pincode'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $pincode = strip_tags(mysqli_real_escape_string($mysqli,$data['pincode']));
    
    
$check = $mysqli->query("select * from vendor where status=1 and vstatus=1 and aid REGEXP  '[[:<:]]".$pincode."[[:>:]]'");
$op = array();
$p =array();
while($row = $check->fetch_assoc())
{
$p['id'] = $row['id'];
$p['title'] = $row['name'];
$p['store_image'] = 'sladaa/'.$row['v_img'];
if($row['vstatus'] == 1)
{
	$p['IS_OPEN'] = 'Open';
}
else 
{
	$p['IS_OPEN'] = 'Close';
}
$p['address'] = $row['address'];
$p['mobile'] = $row['mobile'];
$p['star'] = $row['star'];
$p['Total_Items'] = $mysqli->query("select * from tbl_product where mstatus=1  and pincode=".$pincode." and sid=".$row['id']."")->num_rows;
$op[] = $p;	
}
$returnArr = array("StoreData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Brand Get Successfully!!");
}
echo json_encode($returnArr);