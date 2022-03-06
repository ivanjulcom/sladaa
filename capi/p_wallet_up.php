<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$data = json_decode(file_get_contents('php://input'), true);

if($data['uid'] == '' or $data['wallet'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $wallet = strip_tags(mysqli_real_escape_string($mysqli,$data['wallet']));
$uid =  strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
$checkimei = mysqli_num_rows(mysqli_query($mysqli,"select * from tbl_user where  `id`=".$uid.""));

if($checkimei != 0)
    {
		
		
      $vp = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
	  
  $table="tbl_user";
  $field = array('wallet'=>$vp['wallet']+$wallet);
  $where = "where id=".$uid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
	   
	   
	   $table="wallet_report";
  $field_values=array("uid","message","status","amt");
  $data_values=array("$uid",'Wallet Balance Added!!','Credit',"$wallet");
   
      $h = new Common();
	  $checks = $h->InsertData_Api($field_values,$data_values,$table);
	  
	  
	   $wallet = $mysqli->query("select * from tbl_user where id=".$uid."")->fetch_assoc();
        $returnArr = array("wallet"=>$wallet['wallet'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Wallet Update successfully!");
        
    
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Deactivate By Admin!!!!");  
    }
    
}

echo json_encode($returnArr);