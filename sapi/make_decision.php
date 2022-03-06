 <?php
require 'db.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
 header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$getkey = $mysqli->query("select * from setting")->fetch_assoc();
define('ONE_KEY',$getkey['one_key']);
define('ONE_HASH',$getkey['one_hash']);
define('r_key',$getkey['r_key']);
define('r_hash',$getkey['r_hash']);

function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

$oid = $data['oid'];
$comment = $data['comment'];
$status = $data['status'];
if ($oid =='' or $status =='' or $status == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
		
	$table="tbl_order";
	if($status == 1)
	{
  $field = array('a_status'=>$status,'order_status'=>$status,'comment_reject'=>$comment);
	}
	else 
	{
		 $field = array('a_status'=>$status,'order_status'=>$status,'comment_reject'=>$comment,'o_status'=>'Cancelled');
	} 
  $where = "where id=".$oid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
	  if($status == 1)
	  {
		   $checks = $mysqli->query("select * from tbl_order where id=".$oid."")->fetch_assoc(); 
	  $uid = $checks['uid'];
			$udata = $mysqli->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['fname'].' '.$udata['lname'];

	  
	  $timestamp = date("Y-m-d H:i:s");

$title_main = "Order Confirmed!!";
$description = $name.', Your Order #'.$oid.' Has Been Confirmed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Common();
	   $h->Insertdata($field_values,$data_values,$table);
	   
	   
$content = array(
       "en" => $name.', Your Order #'.$oid.' Has Been Confirmed.'
   );
$heading = array(
   "en" => "Order Confirmed!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/multistore/order_process_img/confirmed.png'
);

$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.ONE_HASH));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
	  }
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>