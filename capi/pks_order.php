<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
function siteURL() {
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || 
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $domainName = $_SERVER['HTTP_HOST'];
  return $protocol.$domainName;
}

if($_POST['uid'] == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
$uid =  $_POST['uid'];

$p_method_id = $_POST['p_method_id'];
$paddress =  mysqli_real_escape_string($mysqli,$_POST['paddress']);
$daddress =  mysqli_real_escape_string($mysqli,$_POST['daddress']);
$pmobile =  $_POST['pmobile'];
$dmobile =  $_POST['dmobile'];
$d_charge = number_format((float)$_POST['d_charge'], 2, '.', '');
$timestamp = date("Y-m-d");
$transaction_id = $_POST['transaction_id'];
$description = mysqli_real_escape_string($mysqli,$_POST['description']);
$distance = $_POST['distance'];
$category = $_POST['category'];
$size = $_POST['size'];
	$target_path = dirname(dirname(__FILE__)).'/assets/img/';
	$url = 'assets/img/';
$v = array();
    for ($x = 0; $x < $size; $x++) {
       
            $newname = uniqid().date('YmdHis',time()).mt_rand().'.jpg';
			$v[] =  $url.$newname;
            // Throws exception incase file is not being moved
            move_uploaded_file($_FILES['image'.$x]['tmp_name'], $target_path .$newname);
    }
$multifile = implode(',',$v);

$table="pkg_order";
  $field_values=array("uid","odate","p_method_id","paddress","daddress","pmobile","dmobile","d_charge","trans_id","description","photos","o_status","distance","category");
  $data_values=array("$uid","$timestamp","$p_method_id","$paddress","$daddress","$pmobile","$dmobile","$d_charge","$transaction_id","$description","$multifile","pending","$distance","$category");
  
      $h = new Common();
	  $oid = $h->InsertData_Api_Id($field_values,$data_values,$table);
	



$udata = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
$name = $udata['fname'].' '.$udata['lname'];

	   


$content = array(
       "en" => $name.', Your Package Order #'.$oid.' Has Been Received.'
   );
$heading = array(
   "en" => "Pesanan diterima"
);

$fields = array(
'app_id' => $set['one_key'],
'included_segments' =>  array("Active Users"),
'data' => array("order_id" =>$oid,"type"=>'normal'),
'filters' => array(array('field' => 'tag', 'key' => 'userid', 'relation' => '=', 'value' => $uid)),
'contents' => $content,
'headings' => $heading,
'big_picture' => siteURL().'/order_process_img/received.png'
);
$fields = json_encode($fields);

 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, 
array('Content-Type: application/json; charset=utf-8',
'Authorization: Basic '.$set['one_hash']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 
$response = curl_exec($ch);
curl_close($ch);



$timestamp = date("Y-m-d H:i:s");

$title_main = "Pesanan diterima";
$description = $name.', Pesanan Anda #'.$oid.' Sudah diterima.';

$table="tbl_notification";
  $field_values=array("uid","datetime","title","description");
  $data_values=array("$uid","$timestamp","$title_main","$description");
  
  
  
      $h = new Common();
	   $h->InsertData_Api($field_values,$data_values,$table);
	   
	   
	   
	   
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Package Order Placed Successfully!!!");
}

echo json_encode($returnArr);