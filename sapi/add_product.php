 <?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
require dirname( dirname(__FILE__) ).'/include/Common.php';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
header('Content-type: text/json');


$sid = $_POST['sid'];
if($sid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$target_path = dirname(dirname(__FILE__)).'/assets/product/';
	$url = 'assets/product/';
	$size = $_POST['size'];
$v = array();
    for ($x = 0; $x < $size; $x++) {
       
            $newname = date('YmdHis',time()).mt_rand().'.jpg';
			$v[] =  $url.$newname;
            // Throws exception incase file is not being moved
            move_uploaded_file($_FILES['image'.$x]['tmp_name'], $target_path .$newname);
    }
$multifile = implode(',',$v);
$mcat = $_POST['cid'];
$pincode = $_POST['pid'];
$mstatus = $_POST['status'];
$mdesc =  mysqli_real_escape_string($mysqli,$_POST['description']);
$title =  mysqli_real_escape_string($mysqli,$_POST['title']);
$rdate = date("Y-m-d H:i:s");


  $table="tbl_product";
  $field_values=array("m_img","mtitle","mstatus","mcat","pincode","mdesc","rdate","sid");
  $data_values=array("$multifile","$title","$mstatus","$mcat","$pincode","$mdesc","$rdate","$sid");
  $h = new Common();
	  $proid = $h->InsertData_Api_Id($field_values,$data_values,$table);
	  $pname = json_decode($_POST['productData'],true);
	  for($i=0;$i<count($pname);$i++)
{
 
 $price =  $pname[$i]['price'];
 $ptype = mysqli_real_escape_string($mysqli,$pname[$i]['type']);
 $discount = $pname[$i]['discount'];

 $table="tbl_product_attribute";
  $field_values=array("pid","price","title","discount","ostock","sid");
  $data_values=array("$proid","$price","$ptype","$discount",0,"$sid");
  $check = $h->InsertData_Api($field_values,$data_values,$table);
}  
	  $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Add Product Successfully!!!!!"); 
	  
}
echo json_encode($returnArr); 