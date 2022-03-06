 <?php 
require 'db.php';

    $mobile = strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
    
    
$check = $mysqli->query("select * from tbl_pincode");
$op = array();
while($row = $check->fetch_assoc())
{
$op[] = $row;	
}
$returnArr = array("PincodeData"=>$op,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Pincode Get Successfully!!");

echo json_encode($returnArr);