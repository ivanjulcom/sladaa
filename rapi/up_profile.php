<?php 
require 'db.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['name'] == '' or $data['email'] == '' or $data['mobile'] == ''   or $data['password'] == ''  or $data['address'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $name = strip_tags(mysqli_real_escape_string($mysqli,$data['name']));
    $email = strip_tags(mysqli_real_escape_string($mysqli,$data['email']));
    $mobile = strip_tags(mysqli_real_escape_string($mysqli,$data['mobile']));
    
    $address = strip_tags(mysqli_real_escape_string($mysqli,$data['address']));
     $password = strip_tags(mysqli_real_escape_string($mysqli,$data['password']));
$uid =  strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
$checkimei = mysqli_num_rows(mysqli_query($mysqli,"select * from rider where  `id`=".$uid.""));

if($checkimei != 0)
    {
		
        date_default_timezone_set('Asia/Kolkata');
        $timestamp = date("Y-m-d H:i:s");
       
	   
	   $table="rider";
  $field = array('name'=>$name,'address'=>$address,'email'=>$email,'mobile'=>$mobile,'password'=>$password);
  $where = "where id=".$uid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
            $c = $mysqli->query("select * from rider where id='".$uid."'");
            $c = $c->fetch_assoc();
        $returnArr = array("dboydata"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Update successfully!");
        
    
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"This Rider Not Exists!!!!");  
    }
    
}

echo json_encode($returnArr);