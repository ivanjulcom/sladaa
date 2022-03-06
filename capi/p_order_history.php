<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
header('Content-type: text/json');
if($data['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$uid =  $mysqli->real_escape_string($data['uid']);
  $sel = $mysqli->query("select * from tbl_order where uid=".$uid." order by id desc limit 50 "); 
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
	  $sdata = $mysqli->query("select * from vendor where id='".$row['sid']."'")->fetch_assoc();
	  $g['store_img'] = 'sladaa/'.$sdata['v_img'];
      $po[] = $g;
	  
      
  }
  $returnArr = array("OrderHistory"=>$po,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Riwayat Pesanan Berhasil!!!");
  }
  else 
  {
	  $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Order  Not Found!!!");
  }
}
echo json_encode($returnArr);
?>