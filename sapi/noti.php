<?php 
 
 require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$sid = $data['sid'];

if ($sid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
	{
$sel = $mysqli->query("select * from tbl_snoti where sid=".$sid." order by id desc");
if($sel->num_rows != 0)
{
$myarray = array();
$p = array();
while($row = $sel->fetch_assoc())
{
    
    $myarray['id'] = $row['id'];
    $myarray['sid'] = $row['sid'];
    $myarray['msg'] = $row['description'];
    $myarray['date'] = $row['datetime'];
    
    $p[] = $myarray;
}
$returnArr = array("data"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Notification List Founded!");
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Notification Not Founded!!");
}
	}
echo json_encode($returnArr);
?>