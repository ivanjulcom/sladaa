<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function generate_random()
{
	require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
	$six_digit_random_number = mt_rand(100000, 999999);
	$c_refer = $mysqli->query("select * from tbl_user where code=".$six_digit_random_number."")->num_rows;
	if($c_refer != 0)
	{
		generate_random();
	}
	else 
	{
		return $six_digit_random_number;
	}
}


if($data['fname'] == '' or $data['email'] == '' or $data['mobile'] == '' or $data['lname']==''  or $data['password'] == '' or $data['ccode'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $fname = strip_tags(mysqli_real_escape_string($mysqli,$data['fname']));
    $email = strip_tags(mysqli_real_escape_string($mysqli,$data['email']));
    $mobile = strip_tags(mysqli_real_escape_string($mysqli,$data['mobile']));
	$ccode = strip_tags(mysqli_real_escape_string($mysqli,$data['ccode']));
    $lname = strip_tags(mysqli_real_escape_string($mysqli,$data['lname']));
     $password = strip_tags(mysqli_real_escape_string($mysqli,$data['password']));
      $refercode = strip_tags(mysqli_real_escape_string($mysqli,$data['rcode']));
     
     
    $checkmob = $mysqli->query("select * from tbl_user where mobile=".$mobile."");
    $checkemail = $mysqli->query("select * from tbl_user where email='".$email."'");
   
    if($checkmob->num_rows != 0)
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Nomor Telepon Sudah Digunakan!");
    }
     else if($checkemail->num_rows != 0)
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Alamat Email Sudah Digunakan!");
    }
    else
    {
        if($refercode != '')
	   {
		 $c_refer = $mysqli->query("select * from tbl_user where code=".$refercode."")->num_rows;
		 if($c_refer != 0)
		 {
			 
        
        $prentcode = generate_random();
		$wallet = $mysqli->query("select * from setting")->fetch_assoc();
		$fin = $wallet['signupcredit'];
        $timestamp = date("Y-m-d H:i:s");
        
		$table="tbl_user";
  $field_values=array("fname","lname","email","mobile","rdate","password","ccode","refercode","wallet","code");
  $data_values=array("$fname","$lname","$email","$mobile","$timestamp","$password","$ccode","$refercode","$fin","$prentcode");
  
      $h = new Common();
	  $check = $h->InsertData_Api_Id($field_values,$data_values,$table);
	  
 $table="wallet_report";
  $field_values=array("uid","message","status","amt");
  $data_values=array("$check",'Sign up Credit Added!!','Credit',"$fin");
   
      $h = new Common();
	  $checks = $h->InsertData_Api($field_values,$data_values,$table);
	  
 $c = $mysqli->query("select * from tbl_user where id=".$check."")->fetch_assoc();
    
        $returnArr = array("UserLogin"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Daftar Selesai Berhasil!");
    }
	else 
		 {
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Refer Code Not Found Please Try Again!!");
	   }
	   }
	    else 
	   {
		   $timestamp = date("Y-m-d H:i:s");
		   $prentcode = generate_random();
		   $table="tbl_user";
  $field_values=array("fname","lname","mobile","rdate","password","ccode","code","email");
  $data_values=array("$fname","$lname","$mobile","$timestamp","$password","$ccode","$prentcode","$email");
   $h = new Common();
	  $check = $h->InsertData_Api_Id($field_values,$data_values,$table);
  $c = $mysqli->query("select * from tbl_user where id=".$check."")->fetch_assoc();
  $returnArr = array("UserLogin"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Daftar Selesai Berhasil!");
  
	   }
	}
    
    
}

echo json_encode($returnArr);