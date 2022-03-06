<?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['mobile'] == ''  or $data['password'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $mobile = strip_tags(mysqli_real_escape_string($mysqli,$data['mobile']));
    $password = strip_tags(mysqli_real_escape_string($mysqli,$data['password']));
    
$chek = $mysqli->query("select * from vendor where (mobile='".$mobile."' or email='".$mobile."') and status = 1 and password='".$password."'");
$status = $mysqli->query("select * from vendor where status = 1");
if($status->num_rows !=0)
{
if($chek->num_rows != 0)
{
    $c = $mysqli->query("select * from vendor where (mobile='".$mobile."' or email='".$mobile."')  and status = 1 and password='".$password."'")->fetch_assoc();
    $curr = $mysqli->query("select * from setting")->fetch_assoc();
    $returnArr = array("storedata"=>$c,"currency"=>$curr['currency'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Login successfully!");
}
else
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Invalid Email/Mobile No or Password!!!");
}
}
else  
{
	 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Your Status Deactivate!!!");
}
}

echo json_encode($returnArr);