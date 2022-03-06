 <?php
require 'db.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
 header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$status = $data['status'];


if ($id =='' or $status =='')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{

	
	$table="tbl_product";
  $field = array('mstatus'=>$status);
  $where = "where id=".$id."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");
	
         
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>