<?php 
require 'db.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
$getkey = $mysqli->query("select * from setting")->fetch_assoc();
define('ONE_KEY',$getkey['one_key']);
define('ONE_HASH',$getkey['one_hash']);
define('s_key',$getkey['s_key']);
define('s_hash',$getkey['s_hash']);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
 header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$oid = $data['oid'];
$status = $data['status'];
$rid = $data['rid'];

function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

if ($oid =='' or $status =='' or $rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
    
    $oid = strip_tags(mysqli_real_escape_string($mysqli,$oid));
	$rid = strip_tags(mysqli_real_escape_string($mysqli,$rid));
    $status = strip_tags(mysqli_real_escape_string($mysqli,$status));
	
	$checks = $mysqli->query("select * from tbl_order where id=".$oid."")->fetch_assoc();
	$store_id = $checks['sid'];
            $udata = $mysqli->query("select * from tbl_user where id=".$checks['uid']."")->fetch_assoc();
$name = $udata['fname'].' '.$udata['lname'];			
		
		$uid = $checks['uid'];
		
	$check = $mysqli->query("select *  from tbl_order where rid=".$rid." and id=".$oid."")->num_rows;
	if($check != 0)
	{
if($status == 'accept')
{
	
	
	$riderdata = $mysqli->query("select * from rider where id=".$rid."")->fetch_assoc();
	$accept = $riderdata['accept'] + 1;
	$table="tbl_order";
  $field = array('o_status'=>'Processing','order_status'=>4);
  $where = "where id=".$oid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	  $table="rider";
  $field = array('accept'=>$accept);
  $where = "where id=".$rid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	
		

$timestamp = date("Y-m-d H:i:s");

$title_main = "Order Processed!!";
$description = $name.', Your Order #'.$oid.' Has Been Processed.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Common();
	   $h->Insertdata($field_values,$data_values,$table);
	   
	   

$content = array(
       "en" => $name.', Your Order #'.$oid.' Has Been Processed.'
   );
$heading = array(
   "en" => "Order Processed!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/process.png'
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


$content = array(
       "en" => 'Order #'.$oid.' Has Been Processed.'
   );
$heading = array(
   "en" => "Order Processed!!"
);

$fields = array(
'app_id' => s_key,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid,"type"=>'normal'),
'filters' => array(array('field' => 'tag', 'key' => 'storeid', 'relation' => '=', 'value' => $store_id)),
'contents' => $content,
'headings' => $heading
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.s_hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
$timestamp = date("Y-m-d H:i:s");

$title_mains = "Order Processed!!";
$descriptions = 'Order #'.$oid.' Has Been Processed.';

	   $table="tbl_snoti";
	   
  $field_values=array("sid","datetime","title","description");
  $data_values=array("$store_id","$timestamp","$title_mains","$descriptions");
  
    $h = new Common();
	   $h->InsertData_Api($field_values,$data_values,$table);

	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Accepted Successfully!!!!!","Next_step"=>"pickup");    
	
}
else if($status == 'pickup')
{
	
	
	
	$table="tbl_order";
  $field = array('o_status'=>'On Route','order_status'=>6);
  $where = "where id=".$oid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	
	
	
	
	$content = array(
       "en" => $name.', Your Order #'.$oid.' Out For Delivery.'
   );
$heading = array(
   "en" => "Order On Route!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/onroute.png'
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


$content = array(
       "en" => 'Order #'.$oid.' Out For Delivery.'
   );
$heading = array(
   "en" => "Order On Route!!"
);

$fields = array(
'app_id' => s_key,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid,"type"=>'normal'),
'filters' => array(array('field' => 'tag', 'key' => 'storeid', 'relation' => '=', 'value' => $store_id)),
'contents' => $content,
'headings' => $heading
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.s_hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
$timestamp = date("Y-m-d H:i:s");

$title_mains = "Order On Route!!";
$descriptions = 'Order #'.$oid.' Out For Delivery.';

	   $table="tbl_snoti";
	   
  $field_values=array("sid","datetime","title","description");
  $data_values=array("$store_id","$timestamp","$title_mains","$descriptions");
  
    $h = new Common();
	   $h->InsertData_Api($field_values,$data_values,$table);
	   

	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Pickup Successfully!!!!!","Next_step"=>"Deliverey");    
	
}
else if($status == 'reject')
{
	
	$riderdata = $mysqli->query("select * from rider where id=".$rid."")->fetch_assoc();
	$reject = $riderdata['reject'] + 1;
	$table="tbl_order";
  $field = array('order_status'=>5);
  $where = "where id=".$oid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	   $table="rider";
  $field = array('reject'=>$reject);
  $where = "where id=".$rid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	
$content = array(
       "en" => 'Order #'.$oid.' Rejected.'
   );
$heading = array(
   "en" => "Order Rejected!!"
);

$fields = array(
'app_id' => s_key,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid,"type"=>'normal'),
'filters' => array(array('field' => 'tag', 'key' => 'storeid', 'relation' => '=', 'value' => $store_id)),
'contents' => $content,
'headings' => $heading
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.s_hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
$timestamp = date("Y-m-d H:i:s");

$title_mains = "Order Rejected!!";
$descriptions = 'Order #'.$oid.' Rejected.';

	   $table="tbl_snoti";
	   
  $field_values=array("sid","datetime","title","description");
  $data_values=array("$store_id","$timestamp","$title_mains","$descriptions");
  
    $h = new Common();
	   $h->InsertData_Api($field_values,$data_values,$table);
	   
	   
	  
	$returnArr = array("ResponseCode"=>"200","Result"=>"false","ResponseMsg"=>"Order Rejected Successfully!!!!!");    
}
else if($status == 'cancle')
{
	$comment = $data['comment'];
	
	
	$table="tbl_order";
  $field = array('order_status'=>9,'o_status'=>'Cancelled','comment_reject'=>$comment);
  $where = "where id=".$oid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	

$content = array(
       "en" => 'Order #'.$oid.' Cancelled.'
   );
$heading = array(
   "en" => "Order Cancelled!!"
);

$fields = array(
'app_id' => s_key,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid,"type"=>'normal'),
'filters' => array(array('field' => 'tag', 'key' => 'storeid', 'relation' => '=', 'value' => $store_id)),
'contents' => $content,
'headings' => $heading
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.s_hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
$timestamp = date("Y-m-d H:i:s");

$title_mains = "Order Cancelled!!";
$descriptions = 'Order #'.$oid.' Cancelled.';

	   $table="tbl_snoti";
	   
  $field_values=array("sid","datetime","title","description");
  $data_values=array("$store_id","$timestamp","$title_mains","$descriptions");
  
    $h = new Common();
	   $h->InsertData_Api($field_values,$data_values,$table);
	   
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Cancelled Successfully!!!!!");
}
else if($status == 'complete')
{
	$riderdata = $mysqli->query("select * from rider where id=".$rid."")->fetch_assoc();
	$complete = $riderdata['complete'] + 1;
	
	$sign = $data['sign'];
	
	
	
	
	$table="tbl_order";
  $field = array('o_status'=>'Completed','order_status'=>7,'sign'=>$sign);
  $where = "where id=".$oid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	  $checkcomplete = $mysqli->query("select * from tbl_order where uid=".$uid." and o_status='Completed'")->num_rows;
	if($checkcomplete == 1)
	{
	$wallet = $mysqli->query("select * from setting")->fetch_assoc();
		$fin = $wallet['refercredit'];
	$uinfo = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	$refercode = $uinfo['refercode'];
	if($refercode != 0)
	{
		$getm = $mysqli->query("select * from tbl_user where code=".$refercode."")->fetch_assoc();
		$fuid = $getm['id'];
		$mysqli->query("insert into wallet_report(`uid`,`message`,`status`,`amt`)values(".$fuid.",'Refer User Credit Added!!','Credit',".$fin.")");
		$mysqli->query("update tbl_user set wallet= wallet+".$fin." where code=".$refercode."");
	}
	}
	
	  $table="rider";
  $field = array('complete'=>$complete);
  $where = "where id=".$rid."";
$h = new Common();
	  $h->UpdateData_Api($field,$table,$where);
	  
	  
	    $timestamp = date("Y-m-d H:i:s");

$title_main = "Order Delivered!!";
$description = $name.', Your Order #'.$oid.' Has Been Delivered.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
      $h = new Common();
	   $h->Insertdata($field_values,$data_values,$table);
	   
	   
	 $content = array(
       "en" => $name.', Your Order #'.$oid.' Has Been Delivered.'
   );
$heading = array(
   "en" => "Order Delivered!!"
);

$fields = array(
'app_id' => ONE_KEY,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $checks['uid'])),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/complete.png'
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
	

$content = array(
       "en" => 'Order #'.$oid.' Has Been Delivered.'
   );
$heading = array(
   "en" => "Order Delivered!!"
);

$fields = array(
'app_id' => s_key,
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid,"type"=>'normal'),
'filters' => array(array('field' => 'tag', 'key' => 'storeid', 'relation' => '=', 'value' => $store_id)),
'contents' => $content,
'headings' => $heading
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.s_hash));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);
$timestamp = date("Y-m-d H:i:s");

$title_mains = "Order Delivered!!";
$descriptions = 'Order #'.$oid.' Has Been Delivered.';

	   $table="tbl_snoti";
	   
  $field_values=array("sid","datetime","title","description");
  $data_values=array("$store_id","$timestamp","$title_mains","$descriptions");
  
    $h = new Common();
	   $h->InsertData_Api($field_values,$data_values,$table);
	   
	   
	   
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Delivered Successfully!!!!!");    
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Sorry This Order Assign to Other Rider Or Cancelled!");
	}
}
echo json_encode($returnArr);
mysqli_close($mysqli);
?>