 <?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['sid'] == '')
{ 
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
 $sid =  strip_tags(mysqli_real_escape_string($mysqli,$data['sid']));
 $pop = array();
 $meidicine = $mysqli->query("select * from tbl_product where  sid=".$sid." order by id desc");
$section = array();
while($rowkpo = $meidicine->fetch_assoc())
{
    $mattributes = $mysqli->query("select * from tbl_product_attribute where pid=".$rowkpo['id']." and sid=".$sid."");
      if($mattributes->num_rows != 0)
	  {
        $section['id'] = $rowkpo['id'];
    $section['product_name'] = $rowkpo['mtitle'];
    $img = explode(',','sladaa/'.$rowkpo['m_img']);
	
	$section['product_image'] = $img;
	$section['product_status'] = $rowkpo['mstatus']; 
	
	$cdata = $mysqli->query("SELECT cat_name FROM `category` where id=".$rowkpo['mcat']."")->fetch_assoc();
	$section['product_category'] = $cdata['cat_name'];
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
$returnArr = array("product_data"=>$pop,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Product List Get successfully!");
}
echo json_encode($returnArr);