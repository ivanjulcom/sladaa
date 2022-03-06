<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

if($data['pincode'] != '' or $data['sid'] != '' or $data['pid'] != '')
{
    
    
	$sid = $data['sid'];
    $pid = $data['pid'];
	$pincode = $data['pincode'];
	$getcid = $mysqli->query("select * from tbl_product where pincode IN(".$pincode.")  and sid=".$sid." and id =".$pid." and mstatus=1")->fetch_assoc();
     $counter = $mysqli->query("select * from tbl_product where pincode IN(".$pincode.") and mcat=".$getcid['mcat']." and sid=".$sid." and id!=".$pid." and mstatus=1");
    if($counter->num_rows != 0)
    {
    $meidicine = $mysqli->query("select * from tbl_product where pincode IN(".$pincode.") and mcat=".$getcid['mcat']." and sid=".$sid." and id!=".$pid." and mstatus=1");
$section = array();
$pop = array();
while($rowkpo = $meidicine->fetch_assoc())
{
    
      $mattributes = $mysqli->query("select * from tbl_product_attribute where pid=".$rowkpo['id']."");
      if($mattributes->num_rows != 0)
	  {
        $section['id'] = $rowkpo['id'];
    $section['product_name'] = $rowkpo['mtitle'];
    $img = explode(',','sladaa/'.$rowkpo['m_img']);
	
	$section['product_image'] = $img;
	$bname = $mysqli->query("select * from vendor where id=".$rowkpo['sid']."")->fetch_assoc();
	
    $section['Brand_name'] = $bname['name'];
    $section['short_desc'] = $rowkpo['mdesc'];
	
	$mattributes = $mysqli->query("select * from tbl_product_attribute where pid=".$rowkpo['id']."");
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
    $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Related Product List Get Successfully!!","BrandProductList"=>$pop);
    }
    else
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Related Product  Not Found!");
    }
echo json_encode($returnArr);
}
else
{
echo "dont touch";
}