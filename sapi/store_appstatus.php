 <?php
require 'db.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
 header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$sid = $data['sid'];
$status = $data['status'];
if ($sid =='')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	if($status != '')
	{
	$table="vendor";
  $field = array('vstatus'=>$status);
  $where = "where id=".$sid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");  
	}
	else 
	{
	    $pok = array();
	  $data = $mysqli->query("select * from vendor where id=".$sid."")->fetch_assoc();
	  $pok['rider_status'] = $data['vstatus'];
     $returnArr = array("order_data"=>$pok,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");  
	
	}
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>