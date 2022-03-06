<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['fname'] == ''   or $data['lname']==''  or $data['password'] == '' or $data['uid'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $fname = strip_tags(mysqli_real_escape_string($mysqli,$data['fname']));
   
    $lname = strip_tags(mysqli_real_escape_string($mysqli,$data['lname']));
     $password = strip_tags(mysqli_real_escape_string($mysqli,$data['password']));
	 
$uid =  strip_tags(mysqli_real_escape_string($mysqli,$data['uid']));
$checkimei = $mysqli->query("select * from tbl_user where  `id`=".$uid."")->num_rows;

if($checkimei == 0)
    {
		     $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Pengguna tidak ada!!!!");  
	}

else 
{	
	   $table="tbl_user";
  $field = array('fname'=>$fname,'lname'=>$lname,'password'=>$password);
  $where = "where id=".$uid."";
$h = new Common();
	  $check = $h->UpdateData_Api($field,$table,$where);
	  
            $c = $mysqli->query("select * from tbl_user where  `id`=".$uid."")->fetch_assoc();
        $returnArr = array("user"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Pembaruan Profil berhasil!");
        
    
	}
    
}

echo json_encode($returnArr);