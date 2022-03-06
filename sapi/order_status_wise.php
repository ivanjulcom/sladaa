 <?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['sid'] == '' or $data['status'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$sid =  $mysqli->real_escape_string($data['sid']);
	$status =  $mysqli->real_escape_string($data['status']);
	if($status == 'Pending')
	{
  $sel = $mysqli->query("select * from tbl_order where sid=".$sid." and o_status !='Completed' and o_status !='Cancelled' order by id desc "); 
	}
	else if($status == 'Complete')
	{
  $sel = $mysqli->query("select * from tbl_order where sid=".$sid." and o_status ='Completed'  order by id desc "); 
	}
	else 
	{
		$sel = $mysqli->query("select * from tbl_order where sid=".$sid." and o_status ='Cancelled'  order by id desc "); 
	}
	
  $g=array();
  $po= array();
  if($sel->num_rows != 0)
  {
  while($row = $sel->fetch_assoc())
  {
      $g['id'] = $row['id'];
      $g['status'] = $row['o_status'];
      $g['order_date'] = $row['odate'];
	  $g['total'] = $row['o_total'];
	  $g['cust_add'] = $row['address'];
      $po[] = $g;
	  
      
  }
  $returnArr = array("OrderHistory"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order History  Get Successfully!!!");
  }
  else 
  {
	  $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order  Not Found!!!");
  }
}
echo json_encode($returnArr);
?>