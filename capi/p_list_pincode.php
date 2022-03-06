<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';

    $mobile = strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
    
    
$check = $mysqli->query("select * from tbl_pincode");
$op = array();
while($row = $check->fetch_assoc())
{
	$count = $mysqli->query("select * from vendor where aid REGEXP  '[[:<:]]".$row['id']."[[:>:]]' ")->num_rows;
	if($count != 0)
	{
$op[] = $row;
	}	
}

$check = $mysqli->query("select * from tbl_pincode where is_primary=1");
 
while($row = $check->fetch_assoc())
{
	$count = $mysqli->query("select * from vendor where aid REGEXP  '[[:<:]]".$row['id']."[[:>:]]' ")->num_rows;
	if($count != 0)
	{
$ops = $row;
	}	
}
$returnArr = array("PincodeData"=>$op,"defaultpin"=>$ops,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Pincode Get Successfully!!");

echo json_encode($returnArr);