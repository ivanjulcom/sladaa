<?php 
require dirname( dirname(__FILE__) ).'/include/dbconfig.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);

$uid = $data['uid'];
$pincode = $data['pincode'];
$store_id = $data['store_id'];
if($uid == '' or $pincode == '' or $store_id == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$v = array();
	$cp = array(); 
	$d = array();
	$pop = array();
	$sec = array();
	
	
	
	$banner = $mysqli->query("select * from banner where status=1");
$vbanner = array();
while($row = $banner->fetch_assoc())
{
	$vbanner['id'] = $row['id'];
	$vbanner['img'] = 'sladaa/'.$row['img'];
	$position =  $mysqli->query("SELECT
       (SELECT COUNT(*) FROM `category` WHERE `id` <= '".$row['cid']."') AS `position`
FROM `category`
WHERE `id` = '".$row['cid']."'")->fetch_assoc();
     if($position['position'] == '')
	 {
		 $vbanner['cid'] = 0;
	 }
	 else 
	 {
     $vbanner['cid'] = $position['position'];
	 }
    $v[] = $vbanner;
}




$sdata = $mysqli->query("select * from vendor where id='".$store_id."' and status=1 and vstatus=1")->fetch_assoc();
$cat = $mysqli->query("select * from category where cat_status = 1 and id IN(".$sdata['scat'].") limit 6");
while($rows = $cat->fetch_assoc())
{
    $p['id'] = $rows['id'];
		$p['catname'] = $rows['cat_name'];
		$p['catimg'] = 'sladaa/'.$rows['cat_img'];
		$p['count'] = $mysqli->query("select * from tbl_product where mcat=".$rows['id']." and mstatus=1 and pincode IN(".$pincode.") and sid=".$store_id."")->num_rows;
		$cp[] = $p;
}

$brand = $mysqli->query("select * from vendor where status=1 and vstatus=1 and aid REGEXP  '[[:<:]]".$pincode."[[:>:]]'");
while($rowsp = $brand->fetch_assoc())
{
    $d[] = $rowsp;
}

$meidicine = $mysqli->query("select * from tbl_product where pincode IN(".$pincode.") and mstatus=1 and sid=".$store_id." order by id desc limit 6");
$section = array();
while($rowkpo = $meidicine->fetch_assoc())
{
    $mattributes = $mysqli->query("select * from tbl_product_attribute where pid=".$rowkpo['id']." and sid=".$store_id."");
      if($mattributes->num_rows != 0)
	  {
        $section['id'] = $rowkpo['id'];
    $section['product_name'] = $rowkpo['mtitle'];
    $img = explode(',','sladaa/'.$rowkpo['m_img']);
	
	$section['product_image'] = $img;
	$bname = $mysqli->query("select * from vendor where id=".$rowkpo['sid']."")->fetch_assoc();
	
    $section['Brand_name'] = $bname['name'];
    $section['short_desc'] = $rowkpo['mdesc'];
	
	
	
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

$slist = $mysqli->query("select * from tbl_home_section where sid=".$store_id." and status = 1")->num_rows;
if($slist !=0)
{
    $plist = $mysqli->query("select * from tbl_home_section where sid=".$store_id." and  status = 1");
    
 $sev = array();
 $sec_home = array();
    while($rp = $plist->fetch_assoc())
    {
      $rpq =  $mysqli->query("select * from tbl_product where pincode IN(".$pincode.") and  mstatus=1 and sid=".$rp['sid']." and mcat=".$rp['cid']."  order by id desc");
      
	  $section = array();
	  $pop_home = array();
while($rowkpo = $rpq->fetch_assoc())
{
    $mattributes = $mysqli->query("select * from tbl_product_attribute where pid=".$rowkpo['id']." and sid=".$store_id."");
      if($mattributes->num_rows != 0)
	  {
        $section['id'] = $rowkpo['id'];
    $section['product_name'] = $rowkpo['mtitle'];
    $img = explode(',','sladaa/'.$rowkpo['m_img']);
	
	$section['product_image'] = $img;
	$bname = $mysqli->query("select * from vendor where id=".$rowkpo['sid']."")->fetch_assoc();
	
    $section['Brand_name'] = $bname['name'];
    $section['short_desc'] = $rowkpo['mdesc'];
	
	
	
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
	 
 $pop_home[] = $section; 
	  } 
}
 $sev['title'] = $rp['title'];
 $sev['product_data'] =  $pop_home;
 $sec_home[] = $sev;
    }
}
else 
{
    
}

$testi = $mysqli->query("select * from tbl_happy_user  order by rand() limit 6");
while($rowk = $testi->fetch_assoc())
{
    $sec[] = $rowk;
}

$main_data = $mysqli->query("select * from setting")->fetch_assoc();

$kp = array('Banner'=>$v,'Catlist'=>$cp,'Brand'=>$d,"Medicine"=>$pop,"Main_Data"=>$main_data,"testimonial"=>$sec,"HomeData"=>$sec_home);
	
	$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Home Data Get Successfully!","ResultData"=>$kp);
}
echo json_encode($returnArr);