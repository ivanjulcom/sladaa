 <?php
require 'db.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';

$getkey = $mysqli->query("select * from setting")->fetch_assoc();
define('r_key',$getkey['r_key']);
define('r_hash',$getkey['r_hash']);


 header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$oid = $data['oid'];
$rid = $data['rid'];
if ($oid =='' or $rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	
	
	$table="tbl_order";
  $field = array('rid'=>$rid,'order_status'=>3);
  $where = "where id=".$oid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
	  $timestamp = date("Y-m-d H:i:s");
						


 $table="tbl_rnoti";
  $field_values=array("rid","msg","date"); 
  $data_values=array("$rid",'You have an order assigned to you.',"$timestamp");
  
$hs = new Common();
	   $hs->InsertData_Api($field_values,$data_values,$table);
	  
											$content = array(
"en" => 'You have an order assigned to you.'//mesaj burasi
);
$fields = array(
'app_id' => r_key,
'included_segments' =>  array("Active Users"),
'filters' => array(array('field' => 'tag', 'key' => 'rider_id', 'relation' => '=', 'value' => $rid)),
'contents' => $content
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.r_hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);

	  
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>