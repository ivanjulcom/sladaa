<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];
$pincode = $data['pincode'];
$store_id = $data['store_id'];
if($uid == '' or $pincode == '' or $store_id == '')
{
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
	$sdata = $mysqli->query("select * from vendor where id='".$store_id."' and status=1 and vstatus=1")->fetch_assoc();
$sel = $mysqli->query("select * from category where cat_status=1 and id IN(".$sdata['scat'].") ");
$k = array();
$p = array();
while($row = $sel->fetch_assoc())
{
	$k['id'] = $row['id'];
	$k['category_name'] = $row['cat_name'];
	$k['category_img'] = 'sladaa/'.$row['cat_img'];
	$meidicine = $mysqli->query("select * from tbl_product where pincode IN(".$pincode.") and mcat=".$row['id']." and mstatus = 1 and sid=".$store_id." order by rand() ");
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
	$kps = array();
	while($rattr = $mattributes->fetch_assoc())
	{
		$pattr['attribute_id'] = $rattr['id'];
		$pattr['product_price'] = $rattr['price'];
		$pattr['product_type'] = $rattr['title'];
		$pattr['product_discount'] = $rattr['discount'];
		$pattr['Product_Out_Stock'] = $rattr['ostock'];
		
		$kps[] = $pattr;
		
	}
	
	$section['product_info'] = $kps; 
	  
 $pop[] = $section;   
}
}
	$k['productlist'] = $pop; 
	$p[] = $k;
	}
	if(empty($p))
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Kategori Tidak Ditemukan!!","CategoryProduct"=>$p);
	}
	else 
	{
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Category List Get Successfully!!","CategoryProduct"=>$p);
	}
}
echo json_encode($returnArr);
mysqli_close($mysqli);	