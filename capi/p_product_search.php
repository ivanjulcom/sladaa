<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
if($data['keyword'] != '' or $data['pincode'] != '' or $data['store_id'] != '')
{
    
    $cid = $data['keyword'];
    $pincode = $data['pincode'];
	$store_id = $data['store_id'];
     $counter = $mysqli->query("select * from tbl_product where pincode IN(".$pincode.") and mtitle like '%".$cid."%' and mstatus = 1 and sid=".$store_id."");
    if($counter->num_rows != 0)
    {
    $query = $mysqli->query("select * from tbl_product where pincode IN(".$pincode.") and mtitle like '%".$cid."%' and mstatus = 1 and sid=".$store_id."");
    $result = array();
    
    while($row = $query->fetch_assoc())
    {
        
    $mattributes = $mysqli->query("select * from tbl_product_attribute where pid=".$row['id']."");
      if($mattributes->num_rows != 0)
	  {
        $section['id'] = $row['id'];
    $section['product_name'] = $row['mtitle'];
    $img = explode(',','sladaa/'.$row['m_img']);
	
	$section['product_image'] = $img;
	$bname = $mysqli->query("select * from vendor where id=".$row['sid']."")->fetch_assoc();
	
    $section['Brand_name'] = $bname['name'];
    $section['short_desc'] = $row['mdesc'];
	
	$mattributes = $mysqli->query("select * from tbl_product_attribute where pid=".$row['id']."");
	$pattr = array();
	$k = array();
	while($rattr = $mattributes->fetch_assoc())
	{
		$pattr['attribute_id'] = $rattr['id'];
		$pattr['product_price'] = $rattr['price'];
		$pattr['product_type'] = $rattr['title'];
		$pattr['product_discount'] = $rattr['discount'];
		$pattr['Product_Out_Stock'] = $rattr['ostock'];
		
		$k[] = $pattr;
		
	}
	
	$section['product_info'] = $k; 
	  
 $pop[] = $section;   
}
    }
	$returnArr = array("SearchData"=>$pop,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Product List Get successfully!");
	}
    else
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Product List Not Found!");
    }
echo json_encode($returnArr);
}
else
{
echo "dont touch";
}